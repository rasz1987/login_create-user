<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Createuser_controller extends CI_Controller {

	function construct(){
		parent __construct();

	}
	
	public function index()
	{
		$this->load->view('create_user');
	}
}
