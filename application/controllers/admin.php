<?php

  class Admin extends CI_Controller {

    public function __construct() {
      parent::__construct();
      if ($this->session->userdata('user_type') != "super admin") {
      	redirect('/session/index');
      }
      $this->load->model("values_model", "values");
    }

    public function index() {    	
    	$data = array('countries' => $this->values->getCountries(),
    								'employer_types'=>$this->values->getEmployerTypes(), 
    								'programs'=>$this->values->getPrograms());
      $this->load->view('admin/index', $data);
    }

    public function addCountry() {
    	if ($_POST['country_name'] == "") {
    		$this->session->set_flashdata("alert", "The country name should not be blank!");
    		redirect('/admin/index');
    	}
    	$this->values->addCountry($_POST['country_name']);
    	$this->session->set_flashdata("notice", "New country added!");
    	redirect('/admin/index');
    }

    public function updateCountries() {
    	if ($_POST['country_name'] == "") {
    		$this->session->set_flashdata("alert", "The country name should not be blank!");
    		redirect('/admin/index');
    	}
    	$id = $this->values->addCountry($_POST['country_name']);
    	foreach() {
    		
    	}
    }

    public function addEmployerType() {
    	if ($_POST['employer_type'] == "") {
    		$this->session->set_flashdata("alert", "The type name should not be blank!");
    		redirect('/admin/index');
    	}
    	$this->values->addEmployerType($_POST['employer_type']);
    	$this->session->set_flashdata("notice", "New employer type added!");
    	redirect('/admin/index');
    }

    public function addDegreeProgram() {
    	if ($_POST['degree_program'] == "") {
    		$this->session->set_flashdata("alert", "The degree program should not be blank!");
    		redirect('/admin/index');
    	}
    	$this->values->addProgram($_POST['degree_program']);
    	$this->session->set_flashdata("notice", "New degree program added!");
    	redirect('/admin/index');
    }

  }

?>