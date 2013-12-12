<?php

  class Home extends CI_Controller {

  	public function index() {  		
  		$this->load->view("index.php");
  	}

  	public function questionnaire() {
  		$this->load->model("values_model", "model");
  		$data = array('countries'=>$this->model->getCountries(),
  									'programs'=>$this->model->getPrograms(),
                    'social_networks'=>$this->model->getSocialNetworks()
  									);
  		$this->load->view("questionnaire.php", $data);
  	}

  }

?>