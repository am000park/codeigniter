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

		$this->load->view('header');
		$this->load->view('fax');
		$this->load->view('footer');
	}

}