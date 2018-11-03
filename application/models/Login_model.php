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

	//Function to create an user
	public function saveUser($data)
	{
		$this->db->insert('usuario', $data);
		return $this->db->insert_id();
	}

	//function to save the answer and obtain the id
	public function saveAnswer($answer)
	{
		$this->db->insert('respuestas', $answer);
		return $this->db->insert_id();
	}

	//function to create data recovery
	public function createDataRecovery($data)
	{
		$this->db->insert('recovery', $data);
	}
}
