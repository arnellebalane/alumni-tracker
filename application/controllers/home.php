<?php

  class Home extends CI_Controller {

  	public function index() {  		
  		$this->load->view("index");
  	}

  	public function questionnaire() {
  		$this->load->model("values_model", "model");
  		$data = array('countries'=>$this->model->getCountries(),
  									'programs'=>$this->model->getPrograms(),
                    'salaries'=>$this->model->getMonthlySalaries()
  									);
  		$this->load->view("questionnaire.php", $data);
  	}

    public function saved() {
      $this->load->view('alumni_saved');
    }

    public function login() {
      $this->load->view('login');
    }

  }

?>