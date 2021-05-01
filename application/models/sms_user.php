<?php

class Sms_user extends CI_Model {

    public function __construct() {
        partent::__construct();
    }

    function insert_sms() {
        $this->db->insert('sms_send');
    }

}