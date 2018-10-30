<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		
		$this->load->model('login_model');
	}
	
	public function index()
	{
		//Load of all the questions in the database to recovery password.
		
		$data = array(
			'questions' => $this->login_model->questions()
		);
		$this->load->view('login', $data);
	}
}
