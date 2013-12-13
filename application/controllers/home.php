<?php

  class Home extends CI_Controller {

  	public function index() {  		
  		$this->load->view("index");
  	}

  	public function questionnaire() {      
  		$this->load->model("values_model", "model");
  		$data = array('countries'=>$this->model->getCountries(),
  									'programs'=>$this->model->getPrograms(),
                    'salaries'=>$this->model->getMonthlySalaries(),
                    'employer_types'=>$this->model->getEmployerTypes(),
                    'social_networks'=>$this->model->getSocialNetworks(),
                    'ge_courses'=>$this->model->getGECourses()
  									);
      $this->load->helper('questionnaire_helper.php');
  		$this->load->view("questionnaire.php", $data);
  	}

    public function saved() {
      $user_id = $this->session->userdata('saved');
      if (!$user_id) {
        redirect('/home/index');
      }
      $this->load->model("user_model", "model");
      $data = array('account_info' => $this->model->getUserById($user_id));
      $this->load->view('alumni_saved', $data);
    }
    

    

  }

?>