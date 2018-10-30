<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

	function construct(){
		parent::__construct();
	}
	
	//Function to select all the questions from the database to recovery password proccess
	public function questions()
	{
		$query=$this->db->get('preguntas');
		return $query->result();
	}
}
