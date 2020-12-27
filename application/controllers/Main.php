<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	// public function __construct() {
	// 	if($this->input->is_ajax_request()) {
			
	// 	} else {
	// 		alert("ajax");
	// 	}
	// }

	public function index()
	{
		$this->load->database();
		$this->load->model("main_model");
		$data = $this->main_model->gets();
		$this->load->view('main');
	}

	public function get()
	{
		//$data = array('id' => $id);
		//$this->load->view('main');

	}

}
