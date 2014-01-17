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

    public function alumni() {
      $cleaned = isset($_GET['cleaned']) ? $_GET['cleaned'] : 2;
      $program_id = isset($_GET['program_id']) ? $_GET['program_id'] : 0;
      if (($cleaned > 1 || $cleaned < 0) && $program_id <= 0) {
        $alumni = $this->alumni->getAllAlumni();        
      } else if (($cleaned <= 1 && $cleaned >= 0) && $program_id <= 0) {
        $alumni = $this->alumni->getAlumniByCleanStatus($cleaned);        
      } else if (($cleaned > 1 || $cleaned < 0) && $program_id > 0) {
        $alumni = $this->alumni->getAlumniByProgram($program_id);        
      } else {
        $alumni = $this->alumni->getAlumniByCleanStatusAndProgram($cleaned, $program_id);        
      }      
      $data = array('alumni'=>$alumni,
                    'cleaned'=>$cleaned,
                    'program_id'=>$program_id,
                    'programs'=>$this->values->getPrograms());
      $this->load->helper('edit_info_helper.php');
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

    public function updateAlumni($id) {      
      if (!$this->validatePersonalInformation($_POST['personal_information'])) {        
        $this->session->set_flashdata("alert", "There are errors in the new personal information!");
      } else if (!$this->validateEducationalBackground($id,$_POST['educational_background'])) {
        $this->session->set_flashdata("alert", "There are errors in the new educational background!");
      }  else if (!$this->validateJobs($_POST['jobs'])) {
        print_r("asdas");
        $this->session->set_flashdata("alert", "Some information about the jobs are missing!");
      } else {            
        $this->updatePersonalInfo($id, $_POST['personal_information']);
        $this->updateEducationalBackground($id, $_POST['educational_background']);
        $this->updateJobs($_POST['jobs']);
      }
      $this->session->set_flashdata("notice", "Update successful!");
      redirect('admin/clean/'.$id);
    }

    // UPDATE PERSONAL INFORMATION
    private function updatePersonalInfo($id, $info) {        
      // if ($info['country'] == 'others') {
      //   $info['country'] = $this->model->addCountry(addslashes($info['specified_country']));
      // }
      $this->alumni->updatePersonalInfo($id, $info);

      foreach ($info['social_networks'] as $key => $value) {       
        $this->alumni->addUserSocialNetwork($id, $key, $value);
      }      
    }

    // VALIDATE PERSONLAL INFORMATION
    private function validatePersonalInformation($info) {      
      if ($info['firstname'] == '' || $info['lastname'] == '' || $info['gender'] == '' || $info['present_address'] == '' || 
          !($info['gender'] == 'male' || $info['gender'] == 'female') ||
          // ($info['country'] == 'others' && $info['specified_country'] == '') ||
          ($info['country'] != 'others' && !$this->values->isCountry(addslashes($info['country']))) ||
          $info['present_address_contact_number'] == '' || $info['permanent_address'] == '' || 
          $info['permanent_address_contact_number'] == '' || $info['email_address'] == '' || (!$this->validateEmail($info['email_address']))) {
        $this->session->set_flashdata('alert', "You are missing a field in your Personal Information or your email is invalid.");
        return false;
      }
      return true;
    }

    // VALIDATE EMAIL ADDRESS
    private function validateEmail($email) {      
      $index = strpos($email, '@');     
      if ($index) {
        $index2 = strpos($email, '.');
        if ($index2 && ($index2 > $index)) {
          return true;
        }
      }
      return false;
    }

    // UPDATE EDUCATIONAL BACKGROUND
    private function updateEducationalBackground($id, $info) {            
      $addnote = '';
      $stud = $this->alumni->getEducationalBackground($id);
      if (($stud != null && $stud[0]->student_number != '') && $info['student_number'] == '') {
        $info['student_number'] = $stud[0]->student_number;
        $addnote = ' (w/ student number unchanged)';
      }    

      $this->alumni->updateEducationalBackground($id, $info);
      $this->alumni->updateUserStudentNumber($id, $info['student_number']);      
    }

    // VALIDATE NEW ALUMNI EDUCATIONAL BACKGROUND
    private function validateEducationalBackground($user_id, $info) {
      if ((strlen($info['student_number']) != 10 && $info['student_number'] != '')) {    
        return false;
      }
      if ($info['student_number'] != '') {
        for($ctr = 0; $ctr < 10; $ctr++) {
          if ($ctr != 4) {
            if (!$this->isNumber($info['student_number'][$ctr])) {
              $this->session->set_flashdata('alert', "Invalid student number.");
              return false;
            }
          } else {
            if ($info['student_number'][4] != '-') {
              $this->session->set_flashdata('alert', "Invalid student number.");
              return false;
            }
          }
        }
      }
      $number = $this->alumni->getEducationalBackground($user_id);
      if ($number && ($number[0]->student_number != "") && ($info['student_number'] == "")) {
        $this->session->set_flashdata("alert", "Student number must not be black!");
        return false;
      }
      $stud = $this->alumni->getUserByStudentNumber(addslashes($info['student_number']));

      if ($stud && ($stud[0]->user_id != $user_id)) {
        $this->session->set_flashdata('alert', "Student number not available.");
        return false;
      }
      return true;
    }

    // CHECK IF INPUT IS A NUMBER
    private function isNumber($num) {
      if ($num == '0' || $num == '1' || $num == '2' || $num == '3' || $num == '4' || $num == '5' || $num == '6' || $num == '7' || $num == '8'
          || $num == '9') 
        return true;
      return false;
    }

    private function updateJobs($info) {            
      foreach ($info as $key => $value) {      
        if (!$this->hasFilledFieldsInEmploymentHistory($value)) {        
          $this->alumni->deleteEmploymentDetails($key);
        } else {
          print_r($value);
          $this->alumni->updateEmploymentDetails($key, $value);          
        }
      }
    }    

    private function validateJobs($jobs) {
      foreach ($jobs as $job) {
        if ($this->hasEmptyFieldInEmploymentHistory($job) && $this->hasFilledFieldsInEmploymentHistory($job)) {          
          return false;
        } 
      }
      return true;
    }

    private function hasEmptyFieldInEmploymentHistory($info) {
      if (($info['employer'] == "") || ($info['job_title'] == "") || !isset($info['satisfied_with_job'])) {
        return true;
      }
      return false;
    }

    private function hasFilledFieldsInEmploymentHistory($info) {
      if (($info['employer'] != "") || ($info['job_title'] != "")) {
        return true;
      }
      return false;
    }

    public function makeAlumniClean($id) {
      $this->alumni->markAlumniClean($id);
      redirect('admin/clean/'.$id);
    } 

    public function markAlumniUnClean($id) {
      $this->alumni->markAlumniUnClean($id);
      redirect('admin/clean/'.$id);
    }

  }

?>