<?php

class Sms_user extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function insert_sms() {
        /*
        $data = array(
            "hp"=>$_POST['hp']
        );
        */

        $this->db->insert('sms_send', array("ss_hp"=>'111'));
    }

}