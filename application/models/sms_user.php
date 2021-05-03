<?php
class Sms_user extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    function insert_sms($phone) {
        $this->db->insert('sms_send', array("ss_hp"=>$phone));
    }

	function sms_last_data($phone) {
		$this->db->select("ss_idx");
		$this->db->where("ss_hp = '{$phone}'");
		$this->db->order_by("ss_create_date desc");
		$this->db->limit(1);

		$query = $this->db->get("sms_send");

		return $query->result();


	}

}