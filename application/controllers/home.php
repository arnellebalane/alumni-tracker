<?php

  class Home extends CI_Controller {

  	public function index() {  		
  		$this->load->view("index");
  	}

  	public function questionnaire() {
  		$this->load->model("values_model", "model");
  		$data = array('countries'=>$this->model->getCountries());
  		$this->load->view("questionnaire", $data);
  	}

    public function saved() {
      $this->load->view('alumni_saved');
    }

  }

?>