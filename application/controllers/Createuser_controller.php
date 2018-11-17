<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Createuser_controller extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('login_model');
	}
	
	//Function to save the dat of users
	public function save()
	{
		if (isset($_POST['save'])) 
		{
			//Variable to configure the array for the form_validation
			$config = array(
				//Name
				array(
					'field'  => 'name',
					'label'  => 'Name',
					'rules'  => 'trim|required|min_length[4]|max_length[20]',
					'errors' => array(
									'required' => 'You must provide a correct %s.'
								),
				),
				//Lastname
				array(
					'field'  => 'lastname',
					'label'  => 'Lastname',
					'rules'  => 'trim|required|min_length[4]|max_length[20]',
					'errors' => array(
									'required' => 'You must provide a correct %s.'
								),
				),
				//Email
				array(
					'field'  => 'email',
					'label'  => 'Email',
					'rules'  => 'trim|required|min_length[4]|max_length[50]|valid_email|is_unique[usuario.correo]',
					'errors' => array(
									'required' => 'You must provide a correct %s.',
									'is_unique' => 'This %s already exist.'
								),
				),
				//User
				array(
					'field' => 'user',
					'label' => 'User',
					'rules' => 'trim|required|min_length[5]|max_length[50]|is_unique[usuario.usuario]',
					'errors' => array(
									'required' => 'You must provide a correct %s.',
									'is_unique' => 'The %s already exist.',
								),
				),
				//Password
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'callback_valid_password'
				),
				//Password confirmation
				array(
					'field' => 'passconf',
					'label' => 'Password Confirmation',
					'rules' => 'trim|required|matches[password]'
				),
				//First answer
				array(
					'field'  => 'firstA',
					'label'  => 'Fisrt Answer',
					'rules'  => 'callback_valid_answer'
					
				),
				//Second answer
				array(
					'field' => 'secondA',
					'label' => 'Second Answer',
					'rules' => 'callback_valid_answer'
				)
			);
			//Set rule for the form_validation
			$this->form_validation->set_rules($config);

			if ($this->form_validation->run()) 
			{	
				$data = array(
					'nombre'      => $this->input->post('name'),
					'apellido'    => $this->input->post('lastname'),
					'correo'      => $this->input->post('email'),
					'usuario'     => $this->input->post('user'),
					'password'    => do_hash($this->input->post('password'), 'sha256'),
					'nivel_id'    => 1
				);
				//Set user id
				$user_id = $this->login_model->saveUser($data);
				
				$ans1 = array(
					'respuestas' => do_hash($this->input->post('firstA', 'sha256'))
				);
				$ans2 = array(
					'respuestas' => do_hash($this->input->post('secondA', 'sha256'))
				);

				//Set answers id
				$ans1_id = $this->login_model->saveAnswer($ans1);
				$ans2_id = $this->login_model->saveAnswer($ans2);
				
				//Data fo the password recovery
				$data_recovery = array(
					'user_id' => $user_id,
					'firstQ_id' => $this->input->post('firstQ'),
					'firstA_id' => $ans1_id,
					'secondQ_id' => $this->input->post('secondQ'),
					'secondA_id' => $ans2_id);
				$this->login_model->createDataRecovery($data_recovery);

				$this->session->set_flashdata('success', '<div class="alert alert-success">The user has been created</div>');

				redirect('login_controller');
			}
			else
			{
				$data['questions'] = $this->login_model->questions();
				$this->load->view('login', $data);
			}
		}
		else{
			redirect('login_controller');
		}
	}

	//function to valid the first and second answer
	public function valid_answer($answer = '')
	{
		$answer = trim($answer);
		if (empty($answer))
		{
			$this->form_validation->set_message('valid_answer', 'The {field} field is required.');
			return FALSE;
		}
		if (strlen($answer)  < 10)
		{
			$this->form_validation->set_message('valid_answer', 'The {field} field must be at least 10 characters.');
			return FALSE;
		}
		return TRUE;
	}

	//Function to valid the password with a callback function
	public function valid_password($password = '')
    {
        $password = trim($password);
        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';
        if (empty($password))
        {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');
            return FALSE;
        }
        if (preg_match_all($regex_lowercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_uppercase, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');
            return FALSE;
        }
        if (preg_match_all($regex_number, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');
            return FALSE;
        }
        if (preg_match_all($regex_special, $password) < 1)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));
            return FALSE;
        }
        if (strlen($password) < 10)
        {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least 10 characters in length.');
            return FALSE;
        }
        return TRUE;
    }
}
