<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fax extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		//$this->session->unset_userdata(array('accNumber', 'smsAccess_in'));

	}

	public function index() {
		if($this->session->userdata('smsAccess_in') == false) {
			redirect(base_url(''));
			exit;
		}

		$phone = $this->input->post('phone');

		$this->load->model('sms_user');
		$ss_result = $this->sms_user->sms_last_data($phone);
	
		$ssIdx = $ss_result[0]->ss_idx;
		$data['ss_idx'] = $ssIdx;

		$this->load->view('header');
		$this->load->view('fax', $data);
		$this->load->view('footer');
	}

	public function fax_send() {

		//$this->load->library('');

		//$this->load->model('fax_user');

	}

}