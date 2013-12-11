<?php

  class Home extends CI_Controller {

  	public function index() {
  		$this->load->view("index.php");
  	}

  	public function questionnaire() {
  		$this->load->view("questionnaire.php");
  	}

  }

?>