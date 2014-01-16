<?php

  class Admin extends CI_Controller {

    public function __construct() {
      parent::__construct();
      if ($this->session->userdata('user_type') != "super admin") {
        redirect('/session/index');
      }
      $this->load->model("values_model", "values");
      $this->load->model("alumni_model", "alumni");
    }

    public function index() {      
      $data = array('countries' => $this->values->getCountries(),
                    'employer_types'=>$this->values->getEmployerTypes(), 
                    'programs'=>$this->values->getPrograms(),
                    'ge_courses'=>$this->values->getGECourses(),
                    'social_networks' => $this->values->getSocialNetworks());
      $this->load->view('admin/index', $data);
    }

    public function alumni($program_id = 0, $cleaned = 2) {      
      if (($cleaned > 1 || $cleaned < 0) && $program_id <= 0) {
        $alumni = $this->alumni->getAllAlumni();        
      } else if (($cleaned <= 1 && $cleaned >= 0) && $program_id <= 0) {
        $alumni = $this->alumni->getAlumniByCleanStatus($cleaned);        
      } else if (($cleaned > 1 || $cleaned < 0) && $program_id > 0) {
        $alumni = $this->alumni->getAlumniByProgram($program_id);        
      } else {
        $alumni = $this->alumni->getAlumniByCleanStatusAndProgram($cleaned, $program_id);        
      }      
      $data = array('alumni'=>$alumni);
      $this->load->view('admin/alumni', $data);
    }

    public function clean($id) {
      $this->load->model("values_model", "values");
      $data = array('countries'=>$this->values->getCountries(),
                    'programs'=>$this->values->getPrograms(),
                    'salaries'=>$this->values->getMonthlySalaries(),
                    'employer_types'=>$this->values->getEmployerTypes(),                    
                    'ge_courses'=>$this->values->getGECourses(),
                    'user_info'=> $this->alumni->getUserInfoById($id),
                    'user_social_networks'=>$this->alumni->getUserSocialNetworksById($id),
                    'social_networks'=>$this->alumni->getOtherSocialNetworksById($id),
                    'jobs'=>$this->alumni->getUserAllJobs($id),
                    'user_id'=>$id
                    );
      $this->load->helper('edit_info_helper.php');
      $this->load->helper('inflector');
      $this->load->view('admin/clean', $data);
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

    public function deleteSocialNetwork($id) {
        if ($this->values->deleteSocialNetwork($id)) {
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
            if ($res) {
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
            if ($res) {
                $this->session->set_flashdata("notice", "The GE course has been updated!");
            }   else {
                $this->session->set_flashdata("alert", "The GE name or code is not available!");
            }
        }
        redirect('/admin/index');
    }

    public function deleteGECourse($id) {
        if ($this->values->deleteGECourse($id)) {
            $this->session->set_flashdata("notice", "GE course deleted!");
        }   else {
            $this->session->set_flashdata("alert", "GE course NOT deleted!");
        }
        redirect('/admin/index');
    }

    public function deleteAlumni($id) {
      $this->alumni->deleteAlumni($id);
      $this->session->set_flashdata("notice", "Alumni moved!");
      redirect('admin/alumni');
    }


  }

?>