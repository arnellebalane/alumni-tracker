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
                    'programs'=>$this->values->getPrograms(),
                    'ge_courses'=>$this->values->getGECourses(),
                    'social_networks' => $this->values->getSocialNetworks());
      $this->load->view('admin/index', $data);
    }

    public function alumni() {
      $this->load->view('admin/alumni');
    }

    public function clean($id) {
      $this->load->view('admin/clean');
    }

    public function addCountry() {
      if ($_POST['country_name'] == "") {
        $this->session->set_flashdata("alert", "The country name should not be blank!");      
      }  else {
          $this->values->addCountry($_POST['country_name']);
            $this->session->set_flashdata("notice", "New country added!");
        }
      redirect('/admin/index');
    }

    public function updateCountries() {
      if ($_POST['country_name'] == "") {
        $this->session->set_flashdata("alert", "The country name should not be blank!");        
      }  else {
          $id = $this->values->addCountry($_POST['country_name']);
          foreach($_POST['countries'] as $key => $value) {
            $this->values->replaceCountry($id, $key);
          }
          $this->session->set_flashdata("notice", "The countries where replaced successfully!");
        }
      redirect('/admin/index');
    }

    public function addEmployerType() {
      if ($_POST['employer_type'] == "") {
        $this->session->set_flashdata("alert", "The type name should not be blank!");        
      }  else {
          $this->values->addEmployerType($_POST['employer_type']);
          $this->session->set_flashdata("notice", "New employer type added!");
        }
      redirect('/admin/index');
    }

    public function updateEmployerTypes() {
      if ($_POST['employer_type'] == "") {
        $this->session->set_flashdata("alert", "The type name should not be blank!");        
      }  else {
          $id = $this->values->addEmployerType($_POST['employer_type']);
          foreach($_POST['employer_types'] as $key => $value) {
            $this->values->replaceEmployerType($id, $key);
          }
          $this->session->set_flashdata("notice", "The employer types were replaces successfully!");
        }
      redirect('/admin/index');
    }

    public function addDegreeProgram() {
      if ($_POST['degree_program'] == "") {
        $this->session->set_flashdata("alert", "The degree program should not be blank!");      
      }  else {
          $this->values->addProgram($_POST['degree_program']);
          $this->session->set_flashdata("notice", "New degree program added!");
        }
      redirect('/admin/index');
    }

    public function updateDegreeProgram() {
        if ($_POST['degree_program'] == "") {
            $this->session->set_flashdata("alert", "The degree program should not be blank!");            
        }  else {
            $id = $this->values->updateProgram($_POST['program_id'], $_POST['degree_program']);
            $this->session->set_flashdata("notice", "The degree program has been updated!");
        }
        redirect('/admin/index');
    }

    public function addSocialNetwork() {
        if ($_POST['social_network'] == "") {
            $this->session->set_flashdata("alert", "The social network should not be blank!");            
        }   else {
            $id = $this->values->addSocialNetwork($_POST['social_network']);
            $this->session->set_flashdata("notice", "The social network has been updated!");
        }        
        redirect('/admin/index');
    }

    public function updateSocialNetwork() {
        if ($_POST['social_network'] == "") {
            $this->session->set_flashdata("alert", "The social network should not be blank!");        
        }   else {
            $this->values->updateSocialNetwork($_POST['social_network_id'], $_POST['social_network']);
            $this->session->set_flashdata("notice", "The social network has been updated!");        
        }
        redirect('/admin/index');
    }

    public function deleteSocialNetwork() {
        if ($this->values->deleteSocialNetwork($_POST['social_network_id'])) {
            $this->session->set_flashdata("notice", "The social network has been deleted!"); 
        }   else {
            $this->session->set_flashdata("alert", "The social network was not found!"); 
        }
        redirect('/admin/index');
    }

    public function addGECourse() {
        if ($_POST['GE_name'] == "" || $_POST['GE_code'] == "" || $_POST['GE_description'] == "") {
            $this->session->set_flashdata("alert", "All information about the GE course must be filled-up!");
        }   else {
            $res = $this->values->addGECourse($_POST['GE_name'], $_POST['GE_code'], $_POST['GE_description']);
            if ($res->added) {
                $this->session->set_flashdata("notice", "New GE course added!");
            }   else {
                $this->session->set_flashdata("alert", "The GE name or code is not available!");
            }
        }
        redirect('/admin/index');
    }

    public function updateGECourse() {
        if ($_POST['GE_name'] == "" || $_POST['GE_code'] == "" || $_POST['GE_description'] == "") {
            $this->session->set_flashdata("alert", "All information about the GE course must be filled-up!");
        }   else {
            $res = $this->values->updateGECourse($_POST['GE_name'], $_POST['GE_code'], $_POST['GE_description'], $_POST['GE_id']);
            if ($res->updated) {
                $this->session->set_flashdata("notice", "The GE course has been updated!");
            }   else {
                $this->session->set_flashdata("alert", "The new GE name or code is not available!");
            }
        }
        redirect('/admin/index');
    }

  }

?>