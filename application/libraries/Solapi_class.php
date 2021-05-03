<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solapi_class {

    private $apiKey		= "NCS50N4H7PXZINS8";
    private $apiSecret	= "KN9PZDE2ICXLPW3NU5ENWGM7GGMMLOLA";
    private $pfid		= "KA01PF200519061615961AhO9Hz8UDJ1"; //플러스친구아이디
    private $from		= "07088996797";

    private $appId		= "Zwk6yzx8kfhJ"; //레인아이 앱코드 변경, 삭제 절대금지!!!!

    /* 
    * Kakao 알림톡
    * templateId를 인자로 받는다.
    */
    public function set_groups(){

        global $config;

        $apiKey = $apiKey;
        $apiSecret = $apiSecret;

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d\TH:i:s.Z\Z', time());  // date must be ISO 8361 format
        $salt = uniqid(); // Any random strings with [0-9a-zA-Z]
        $signature = hash_hmac('sha256', $date.$salt, $apiSecret);

        $url = "https://api.solapi.com/messages/v4/groups";
        
        $fields = new stdClass();

        //$app = new stdClass();
        //$app->appId = $appId;
        $fields->appId = $appId;


        $header = "Authorization: HMAC-SHA256 apiKey={$apiKey}, date={$date}, salt={$salt}, signature={$signature}";

        //open connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header));
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //curl_setopt($ch, CURLOPT_POST, true);

        $result = curl_exec($ch);
        return json_decode($result,true);

    }


    public function set_groups_message(){
        
        $groupId = create_group();
        //echo $groupId;
        //$url = "http://api.solapi.com/messages/v4/groups/G4V20190607105937H3PFASXMNJG2JID/messages";
        //$messages = [];

        return $groupId;


    }


    public function send_one_alimtalk($tid,$to,$messageText,$set=0){

        $apiKey = $apiKey;
        $apiSecret = $apiSecret;

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d\TH:i:s.Z\Z', time());  // date must be ISO 8361 format
        $salt = uniqid(); // Any random strings with [0-9a-zA-Z]
        $signature = hash_hmac('sha256', $date.$salt, $apiSecret);

        $url = "https://api.solapi.com/messages/v4/send";
        $kakaoOptions = new stdClass();
        $kakaoOptions->pfId = $pfid;
        $kakaoOptions->templateId = $tid;
        //$kakaoOptions->disableSms = true; //카톡수신실패시 문자로 대신 발송되도록 함 true:발송off, false:발송on

        /*
            템플릿등록시 버튼설정에 모바일, pc에 모두 링크가 등록된경우 둘다 기입해야줘야 함.
        */
        $kakaoOptions->buttons = array();
        
        $buttons = new stdClass();
        $buttons->buttonType = "WL";
        $buttons->buttonName = "카카오채널 상담톡";
        $buttons->linkMo     = "http://pf.kakao.com/_epRUj/chat"; //모바일링크
        $buttons->linkPc     = "http://pf.kakao.com/_epRUj/chat"; //모바일링크
        array_push($kakaoOptions->buttons,$buttons);
        

        $fields = new stdClass();
        $message = new stdClass();
        $message->text = $messageText;
        $message->type = "ATA";
        $message->to = $to;
        $message->from = $from;
        $message->kakaoOptions = $kakaoOptions;

        //$agent = new stdClass();
        //$agent->appId = $appId;
        //$fields->agent   = $agent;
        
        $fields->message = $message;
        $fields_string = json_encode($fields);

        $header = "Authorization: HMAC-SHA256 apiKey={$apiKey}, date={$date}, salt={$salt}, signature={$signature}";

        //open connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header, "Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        return $result;
    }


    public function send_simple_message($to, $type, $messageText){

        // apiKey && apiSecret are acquired from solapi.com/credentials
        $apiKey = $this->apiKey;
        $apiSecret = $this->apiSecret;

        date_default_timezone_set('Asia/Seoul');
        $date = date('Y-m-d\TH:i:s.Z\Z', time());  // date must be ISO 8361 format
        $salt = uniqid(); // Any random strings with [0-9a-zA-Z]
        $signature = hash_hmac('sha256', $date.$salt, $apiSecret);

        $url = "https://api.solapi.com/messages/v4/send";
        $fields = new stdClass();
        $message = new stdClass();
        $message->text = $messageText;
        $message->type = $type;
        $message->to = $to;
        $message->from = $this->from;

        /*
        $agent = new stdClass();
        $agent->appId = $appId;
        $fields->agent   = $agent;
        */

        $fields->message = $message;
        $fields_string = json_encode($fields);
        $header = "Authorization: HMAC-SHA256 apiKey={$apiKey}, date={$date}, salt={$salt}, signature={$signature}";

        //open connection
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array($header, "Content-Type: application/json"));
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        return $result;

    }

























    /* 템플릿 목록조회 */
    public function get_templates_list()
    {
    global $config;

    $apiKey = $apiKey;
    $apiSecret = $apiSecret;

    date_default_timezone_set('Asia/Seoul');
    $date = date('Y-m-d\TH:i:s.Z\Z', time());  // date must be ISO 8361 format
    $salt = uniqid(); // Any random strings with [0-9a-zA-Z]
    $signature = hash_hmac('sha256', $date.$salt, $apiSecret);

    $url = "http://api.solapi.com/kakao/v1/templates";

    $options = array(
        'http' => array(
            'header'  => "Authorization: HMAC-SHA256 apiKey={$apikey}, date={$date}, salt={$salt}, signature={$signature}",
            'method'  => 'GET'
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    var_dump($result);

    }



    /* 메세지 통계조회 */
    public function get_messages_list()
    {
    global $config;

    $apiKey = $apiKey;
    $apiSecret = $apiSecret;

    date_default_timezone_set('Asia/Seoul');
    $date = date('Y-m-d\TH:i:s.Z\Z', time());  // date must be ISO 8361 format
    $salt = uniqid(); // Any random strings with [0-9a-zA-Z]
    $signature = hash_hmac('sha256', $date.$salt, $apiSecret);

    $url = "http://api.solapi.com/messages/v4/statistics";

    $options = array(
        'http' => array(
            'header'  => "Authorization: HMAC-SHA256 apiKey={$apikey}, date={$date}, salt={$salt}, signature={$signature}",
            'method'  => 'GET'
        )
    );

    $context  = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    return $result;

    }



    public function get_test()
    {

    global $config;

    $apiKey = $apiKey;
    $apiSecret = $apiSecret;

    date_default_timezone_set('Asia/Seoul');
    $date = date('Y-m-d\TH:i:s.Z\Z', time());  // date must be ISO 8361 format
    $salt = uniqid(); // Any random strings with [0-9a-zA-Z]
    $signature = hash_hmac('sha256', $date.$salt, $apiSecret);

    //$url = "https://api.solapi.com/cash/v1/balance/history";
    $url = "http://api.solapi.com/kakao/v1/templates"; //템플릿목록
    $url = "https://api.solapi.com/oauth2/v1/authorize";



    $header = "Authorization: HMAC-SHA256 apiKey={$apiKey}, date={$date}, salt={$salt}, signature={$signature}";

    //open connection
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array($header, "Content-Type: application/json"));
    curl_setopt($ch,CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);

    //$context  = stream_context_create($options);
    //$result = file_get_contents($url, false, $context);
    
    return json_decode($result,true);

    }











    public function get_header() {
    global $config;
    # apiKey && apiSecret are acquired from solapi.com/credentials
    $apiKey = $apiKey;
    $apiSecret = $apiSecret;
    date_default_timezone_set('Asia/Seoul');
    $date = date('Y-m-d\TH:i:s.Z\Z', time());
    $salt = uniqid();
    $signature = hash_hmac('sha256', $date.$salt, $apiSecret);
    return "Authorization: HMAC-SHA256 apiKey={$apiKey}, date={$date}, salt={$salt}, signature={$signature}";
    }



    public function create_group() {
        
        /*
            appId : 그룹메세지 전송시에는 appid를 그룹생성시에 BODY에 넣어줘야 함
            개별전송 api에 추가시 에러!
            jun
        */

        global $config;

        $url = "https://api.solapi.com/messages/v4/groups";
        
        $fields = new stdClass();
        $fields->appId = $appId;

        $result = request("POST", $url, $fields);
        
        $groupId = json_decode($result)->groupId;

        return $groupId;
    }







    public function add_message($groupId,$tid,$to,$messageText,$insertid="",$set=0) {

        global $config;

        $kakaoOptions = new stdClass();
        $kakaoOptions->pfId = $pfid;
        $kakaoOptions->templateId = $tid;


        $kakaoOptions->buttons = array();
        
        $buttons = new stdClass();
        $buttons->buttonType = "WL";
        $buttons->buttonName = "";
        $buttons->linkMo     = ""; //모바일링크
        array_push($kakaoOptions->buttons,$buttons);


        $fields = new stdClass();
        $message = new stdClass();
        $message->text = $messageText;
        $message->type = "ATA";
        $message->to = $to;
        $message->from = $config["from"];
        $message->kakaoOptions = $kakaoOptions;

        $fields->messages = json_encode(array($message));
        

        //$fields_string = $fields;
        
        $url = "https://api.solapi.com/messages/v4/groups/{$groupId}/messages";
        $result = request("PUT", $url, $fields);
        
        print_r("Group msg add : {$result}\n");

    }






    public function send_message($groupId) {
    $url = "https://api.solapi.com/messages/v4/groups/{$groupId}/send";
    $result = request("POST", $url);
    //print_r("Group msg send : {$result}\n");
    }


    public function get_group_info($groupId) {
    $url = "https://api.solapi.com/messages/v4/groups/{$groupId}";
    $result = request("GET", $url);
    //print_r("Group Info : {$result}\n");
    }

    public function request($method, $url, $data = false) {
    echo "{$method}  {$url}\n";
    try {
        $curl = curl_init();
        switch ($method) {
        case "POST":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
            if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
            if ($data) curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
            break;
        default:
            if ($data) $url = sprintf("%s?%s", $url, http_build_query($data));
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(get_header(), "Content-Type: application/json"));
        curl_setopt($curl, CURLOPT_URL, $url);
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if (curl_error($curl)) {
        print curl_error($curl);
        }
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    } catch (Exception $err) {
        echo $err;
    }
    }







    public function create_group_sms() {
        
        /*
            appId : 그룹메세지 전송시에는 appid를 그룹생성시에 BODY에 넣어줘야 함
            개별전송 api에 추가시 에러!
            jun
        */

        global $config;

        $url = "https://api.solapi.com/messages/v4/groups";
        
        $fields = new stdClass();
        //$fields->appId = $appId;

        $result = request("POST", $url, $fields);
        
        $groupId = json_decode($result)->groupId;

        return $groupId;
    }

    public function add_message_sms($groupId,$to,$from,$messageText, $subject = null, $imageId = null) {

        global $config;

        $fields = new stdClass();
        $message = new stdClass();
        $message->text = $messageText;
        $message->to = $to;
        $message->from = $from;
        

        $fields->messages = json_encode(array($message));
        
        $url = "https://api.solapi.com/messages/v4/groups/{$groupId}/messages";
        $result = request("PUT", $url, $fields);
        
        return json_decode($result)->resultList;
        //print_r($result);
        //print_r("Group msg add : {$result}\n");

    }

}