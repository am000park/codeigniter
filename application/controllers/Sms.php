<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sms extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->helper('url');
	}
	
	public function index() {
		$this->load->view('header');
		$this->load->view('sms');
		$this->load->view('footer');
	}

	public function send() {
		echo 'ddd';
		//echo $this->input->is_ajax_request();
		print_r($this->input->post("phone", true));
		print_r($this->input->get("phone"));
		//echo json_encode($_POST);
		//echo json_encode($_GET);

		$this->load->model('sms_user');
		$this->sms_user->insert_sms($_POST['hp']);
	}

}
