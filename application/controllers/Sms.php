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

	public function send($id) {
		$this->load->model('sms_user');
		//print_r($_POST['hp']);
		//$this->load->view('welcome');
	}

}
