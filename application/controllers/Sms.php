<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		//$this->session->unset_userdata(array('accNumber', 'smsAccess_in'));
	}
	
	public function index() {

		if($this->session->userdata('smsAccess_in') == true) {
			redirect(base_url('index.php/fax'));
			exit;
		}

		$this->load->view('header');
		$this->load->view('sms');
		$this->load->view('footer');
	}

	// 문자 발송
	public function send() {

		$response = array(
			'message'=>'',
			'status'=>''
		);

		if($this->input->is_ajax_request()) {

			$phone = $this->input->post('phone');

			if(empty($phone)) {
				
				$response['message'] = '핸드폰 번호가 넘어오지 않았습니다.';
				$response['error'] = 'error';

			} else {
			
				try {

					$accRandNumber = sprintf('%06d', rand(000000, 999999)); // 인증 번호 생성

					$session_data = array(
						'accNumber'=>$accRandNumber,
						'smsAccess_in'=>true
					);
					
					// 솔라피 문자 전송 BEGIN -----------------------------------
					/*
					$this->load->library("solapi_class");

					$messageText = "[FAX 인증번호]\n인증번호: {$accRandNumber}";

					$solApiRes = $this->solapi_class->send_simple_message($phone, 'SMS', trim($messageText));

					$solMessageRes = json_decode($solApiRes);
					
					if($solMessageRes->statusCode == '2000') {
						
						$this->session->set_userdata($session_data); // 세선 담기

						$this->load->model('sms_user');
						$this->sms_user->insert_sms($phone);

						$response['status'] = 'success';

					} else {
						
						$response['message'] = '문자 전송에 실패했습니다.';
						$response['status'] = 'error';

					} 
					*/
					// 솔라피 문자 전송 END -----------------------------------

					$this->session->set_userdata($session_data); // 세선 담기

					$this->load->model('sms_user');
					$this->sms_user->insert_sms($phone);

					$response['number'] = $accRandNumber;
					$response['status'] = 'success';

				} catch(Exception $e) {
					$response['message'] = $e->getMessage();
					$response['error'] = 'error';
				}
			
			}

		}

		echo json_encode($response);

	}

	// 문자 인증
	public function access() {

		$response = array(
			'message'=>'',
			'status'=>''
		);

		if($this->input->is_ajax_request()) {

			$accNumber = $this->input->post('acc_number');

			if($accNumber == $this->session->userdata('accNumber')) {
				
				$response['status'] = 'success';

			} else {

				//$response['number'] = $this->session->userdata('accNumber');
				$response['status'] = 'error';
				$response['message'] = '인증번호가 일치하지 않습니다.';
			}
		}

		echo json_encode($response);
	}

}
