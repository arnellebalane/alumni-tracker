<?php

	class Session extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model("user_model", "model");
		}

		public function index() {
			if ($this->session->userdata('user_id')) {
				redirect('/session/home');
			}	else {
				$this->load->helper('questionnaire_helper');
				$this->load->view('login');
			}

		}

		public function login() {
			$user_data = $this->model->getUserByUsernamePassword(addslashes($_POST['username']), addslashes($_POST['password']));
			if ($user_data) {
				$this->session->set_userdata('user_id', $user_data[0]->id);				
				redirect('/session/home');
			}	else {
				$this->session->set_flashdata('alert', 'Incorrect username or password.');
				$this->session->set_flashdata('inputs', $_POST);
				redirect('/session/index');
			}
		}

		public function logout() {
      $this->session->sess_destroy();
      redirect('/session/index');
    }

    public function home() {
    	echo "success";
			echo anchor('session/logout', 'logout');
    }

	}

?>