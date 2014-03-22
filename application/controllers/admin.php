<?php

  class Admin extends CI_Controller {

    public function __construct() {
      parent::__construct();
      if ($this->session->userdata('user_type') != "super admin") {
        redirect('/session/index');
      }
      $this->load->model("values_model", "values");
      $this->load->model("alumni_model", "alumni");
      $this->load->helper('inflector');
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
      if (($this->session->userdata('cleaned') == 2) || ($this->session->userdata('cleaned') == 1) || ($this->session->userdata('cleaned') == -1)) {
        $prev_cleaned = $this->session->userdata('cleaned');
      } else {
        $prev_cleaned = 2;
      }
      if ($this->session->userdata('program_id') > 0 || $this->session->userdata('program_id') == -1) {
        $prev_program_id = $this->session->userdata('program_id');
      } else {
        $prev_program_id = -1;
      } 
      if (($this->session->userdata('included') == 2) || ($this->session->userdata('included') == 1) || ($this->session->userdata('included') == -1)) {
        $prev_included = $this->session->userdata('included');
      } else {
        $prev_included = 2;
      }
      $limit = 20;
      if (isset($_GET['page'])) {
        $offset = ($_GET['page'] - 1) * $limit;
        $page = $_GET['page'];
      } else {
        $offset = 0;
        $page = 1;
      }                  
      $cleaned = isset($_GET['cleaned']) ? $_GET['cleaned'] : $prev_cleaned;
      $program_id = isset($_GET['program_id']) ? $_GET['program_id'] : $prev_program_id;
      $included = isset($_GET['included']) ? $_GET['included'] : $prev_included;   
      
      $this->session->set_userdata('cleaned', $cleaned);
      $this->session->set_userdata('program_id', $program_id);
      $this->session->set_userdata('included', $included);
      if (($cleaned < 0) && $program_id <= 0 && ($included < 0)) {
        $alumni = $this->alumni->getAllAlumniPaginate($offset,$limit);
        $count = $this->alumni->countAllAlumni();
        $count = ($count) ? $count[0]->count : 0;
      } else if (($cleaned > 0) && $program_id <= 0 && ($included < 0)) {
        $alumni = $this->alumni->getAlumniByCleanStatusPaginate($cleaned-1, $offset, $limit);
        $count = $this->alumni->countAlumniByCleanStatus($cleaned-1);
        $count = ($count) ? $count[0]->count : 0;
      } else if (($cleaned < 0) && $program_id > 0 && ($included < 0)) {
        $alumni = $this->alumni->getAlumniByProgramPaginate($program_id, $offset, $limit);    
        $count = $this->alumni->countAlumniByProgram($program_id);    
        $count = ($count) ? $count[0]->count : 0;
      } else if (($cleaned > 0) && $program_id > 0 && ($included < 0)){
        $alumni = $this->alumni->getAlumniByCleanStatusAndProgramPaginate($cleaned-1, $program_id, $offset, $limit);        
        $count = $this->alumni->countAlumniByCleanStatusAndProgram($cleaned-1, $program_id);
        $count = ($count) ? $count[0]->count : 0;
      } else if (($cleaned < 0) && $program_id < 0 && ($included > 0)) {
        $alumni = $this->alumni->getAlumniByInclusionPaginate($included-1, $offset, $limit);
        $count = $this->alumni->countAlumniByInclusion($included-1);
        $count = ($count) ? $count[0]->count : 0;
      } else if (($cleaned > 0) && $program_id < 0 && ($included > 0)) {
        $alumni = $this->alumni->getAlumniByInclusionAndStatusPaginate($included-1, $cleaned-1, $offset, $limit);
        $count = $this->alumni->countAlumniByInclusionAndStatus($included-1, $cleaned-1);
        $count = ($count) ? $count[0]->count : 0;
      } else if (($cleaned < 0) && $program_id > 0 && ($included > 0)) {
        $alumni = $this->alumni->getAlumniByInclusionAndProgramPaginate($included-1, $program_id, $offset, $limit);
        $count = $this->alumni->countAlumniByInclusionAndProgram($included-1, $program_id);
        $count = ($count) ? $count[0]->count : 0;
      } else {
        $alumni = $this->alumni->getAlumniByInclusionAndStatusAndProgramPaginate($included-1, $cleaned-1, $program_id, $offset, $limit);
        $count = $this->alumni->countAlumniByInclusionAndStatusAndProgram($included-1, $cleaned-1, $program_id);
        $count = ($count) ? $count[0]->count : 0;
      }      
      $this->load->add_package_path(APPPATH . 'libraries/paginator');
      $this->load->library('paginator', array('items_per_page'=>$limit));
      $this->paginator->initialize($count);
      $data = array('alumni'=>$alumni,
                    'cleaned'=>$cleaned,
                    'program_id'=>$program_id,
                    'included'=>$included,
                    'programs'=>$this->values->getPrograms(),
                    'paginator' => $this->paginator, 
                    'page' => $page);
      $this->load->helper('edit_info_helper.php');
      $this->load->remove_package_path(APPPATH . 'libraries/paginator');
      $this->load->view('admin/alumni', $data);
    }

    public function clean($id, $page = 1) {
      $alumni = $this->alumni->getUserById($id);
      if (!$alumni || $alumni[0]->user_type != "alumni") {
        redirect('admin/alumni?page='.$page);
      }
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
                    'user_id'=>$id,
                    'page' => $page,
                    'other_degree'=>$this->alumni->getOtherDegreeByUserId($id)
                    );
      $this->load->helper('edit_info_helper.php');
      $this->load->helper('inflector');
      $this->load->view('admin/clean', $data);
    }

    public function enumerators() {
      $this->load->model('enumerator_model', 'enumerator');
      $data = array('programs'=>$this->values->getPrograms(),
                    'enumerators'=>$this->enumerator->getAllEnumerators());
      $this->load->helper('inflector');
      $this->load->helper('enumerator_helper');
      $this->load->view('admin/enumerators', $data);
    }

    public function metas() {
      $data = array('submission'=>$this->values->getMetaData('submission'),
                    'cleaning'=>$this->values->getMetaData('cleaning'),
                    'start_submission'=>$this->values->getMetaData('start_submission'),
                    'end_submission'=>$this->values->getMetaData('end_submission'),
                    'start_cleaning'=>$this->values->getMetaData('start_cleaning'),
                    'end_cleaning'=>$this->values->getMetaData('end_cleaning'));
      $this->load->view('admin/metas', $data);
    }

    public function updateMeta() {
      $substr = $_POST['submission_period']['start'];
      $subend = $_POST['submission_period']['end'];
      $clnstr = $_POST['cleaning_period']['start'];
      $clnend = $_POST['cleaning_period']['end'];

      if (($substr != '' && $subend != '' && $subend < $substr) ||
          ($clnstr != '' && $clnend != '' && $clnend < $clnstr)) {
        $this->session->set_flashdata('alert', 'End dates should not be earlier than start dates.');
        redirect('admin/metas');
      }

      $this->values->updateMetadata(addslashes($substr), addslashes($subend), addslashes($clnstr), addslashes($clnend));
      $this->session->set_flashdata('notice', 'Meta Data updated.');
      redirect('admin/metas');
    }

    public function toggleCleaning() {
      $result = $this->values->toggleCleaning();
      echo $result;
      if ($result) {
        $this->session->set_flashdata('notice', 'Data Cleaning Enabled');
      } else {
        $this->session->set_flashdata('notice', 'Data Cleaning Disabled');
      }

      redirect('/admin/metas');
    }

    public function toggleSubmission() {
      $result = $this->values->toggleSubmission();
      echo $result;
      if ($result) {
        $this->session->set_flashdata('notice', 'Submissions Enabled');
      } else {
        $this->session->set_flashdata('notice', 'Submissions Disabled');
      }

      redirect('/admin/metas');
    }

    public function settings() {
      $this->load->view('admin/settings');
    }

    public function addCountry() {
      $_POST['country_name'] = trim($_POST['country_name']);
      if ($_POST['country_name'] == "") {
        $this->session->set_flashdata("alert", "The country name should not be blank!");      
      }  else {
          $this->values->addCountry($_POST['country_name']);
            $this->session->set_flashdata("notice", "New country added!");
        }
      redirect('/admin/index');
    }

    public function updateCountries() {
      $_POST['country_name'] = trim($_POST['country_name']);
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
      $_POST['employer_type'] = trim($_POST['employer_type']);
      if ($_POST['employer_type'] == "") {
        $this->session->set_flashdata("alert", "The type name should not be blank!");        
      }  else {
          $this->values->addEmployerType($_POST['employer_type']);
          $this->session->set_flashdata("notice", "New employer type added!");
        }
      redirect('/admin/index');
    }

    public function updateEmployerTypes() {
      $_POST['employer_type'] = trim($_POST['employer_type']);
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
      $_POST['degree_program'] = trim($_POST['degree_program']);
      if ($_POST['degree_program'] == "") {
        $this->session->set_flashdata("alert", "The degree program should not be blank!");      
      }  else {
          $this->values->addProgram($_POST['degree_program']);
          $this->session->set_flashdata("notice", "New degree program added!");
        }
      redirect('/admin/index');
    }

    public function updateDegreeProgram() {
      $_POST['degree_program'] = trim($_POST['degree_program']);
      if ($_POST['degree_program'] == "") {
          $this->session->set_flashdata("alert", "The degree program should not be blank!");            
      }  else {
          $id = $this->values->updateProgram($_POST['program_id'], $_POST['degree_program']);
          $this->session->set_flashdata("notice", "The degree program has been updated!");
      }
      redirect('/admin/index');
    }

    public function addSocialNetwork() {
        $_POST['social_network'] = trim($_POST['social_network']);
        if ($_POST['social_network'] == "") {
            $this->session->set_flashdata("alert", "The social network should not be blank!");            
        }   else {
            $id = $this->values->addSocialNetwork($_POST['social_network']);
            $this->session->set_flashdata("notice", "The social network has been updated!");
        }        
        redirect('/admin/index');
    }

    public function updateSocialNetwork() {
        $_POST['social_network'] = trim($_POST['social_network']);
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
        $_POST['GE_name'] = trim($_POST['GE_name']);
        $_POST['GE_code'] = trim($_POST['GE_code']);
        $_POST['GE_description'] = trim($_POST['GE_description']);
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
        $_POST['GE_name'] = trim($_POST['GE_name']);
        $_POST['GE_code'] = trim($_POST['GE_code']);
        $_POST['GE_description'] = trim($_POST['GE_description']);
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

    public function deleteAlumni($id, $page = 1) {
      $this->alumni->deleteAlumni($id);
      $this->session->set_flashdata("notice", "Alumni removed!");
      redirect('admin/alumni?page='.$page);
    }

    public function updateAlumni($id, $page = 1) {      
      if (!$this->validatePersonalInformation($_POST['personal_information'], $id)) {        
        $this->session->set_flashdata("alert", "There are errors in the new personal information!");
      } else if (!$this->validateEducationalBackground($id,$_POST['educational_background'])) {
        // $this->session->set_flashdata("alert", "There are errors in the new educational background!");
      }  else if ($_POST['jobs'] && !$this->validateJobs($_POST['jobs'])) {
        $this->session->set_flashdata("alert", "Some information about the jobs are missing!");
      } else if ((isset($_POST['another_job'])) && !$this->validateJobs($_POST['another_job'])) {
        $this->session->set_flashdata("alert", "Some information about the new jobs are missing!");
      } else {
        $this->updatePersonalInfo($id, $_POST['personal_information']);
        $this->updateEducationalBackground($id, $_POST['educational_background']);
        if (isset($_POST['jobs'])) {
          $this->updateJobs($_POST['jobs']);
        }
        if (isset($_POST['another_job'])) {
          $this->addJobs($id, $_POST['another_job']);
        }      
        $res = $this->mailer($id, 'alumni');
        $message = "Update successful!" . (($res) ? " Email sent!" : " Failed to send email!");
        $this->session->set_flashdata("notice", $message);
      }
      redirect('admin/clean/'.$id.'/'.$page);
    }

    // UPDATE PERSONAL INFORMATION
    private function updatePersonalInfo($id, $info) {        
      // if ($info['country'] == 'others') {
      //   $info['country'] = $this->model->addCountry(addslashes($info['specified_country']));
      // }
      $this->alumni->updatePersonalInfo($id, $info);

      foreach ($info['social_networks'] as $key => $value) {
        $value = trim($value);
        $this->alumni->addUserSocialNetwork($id, $key, $value);
      }      
    }

    // VALIDATE PERSONLAL INFORMATION
    private function validatePersonalInformation($info, $user_id) {
      $info['firstname'] = trim($info['firstname']);
      $info['lastname'] = trim($info['lastname']);
      $info['gender'] = trim($info['gender']);
      $info['present_address'] = trim($info['present_address']);
      $info['present_address_contact_number'] = trim($info['present_address_contact_number']);
      $info['permanent_address'] = trim($info['present_address']);
      $info['permanent_address_contact_number'] = trim($info['permanent_address_contact_number']);
      $info['email_address'] = trim($info['email_address']);      

      if ($info['firstname'] == '' || $info['lastname'] == '' || $info['gender'] == '' || $info['present_address'] == '' || 
          !($info['gender'] == 'male' || $info['gender'] == 'female') ||
          // ($info['country'] == 'others' && $info['specified_country'] == '') ||
          ($info['country'] != 'others' && !$this->values->isCountry(addslashes($info['country']))) ||
          $info['present_address_contact_number'] == '' || $info['permanent_address'] == '' || 
          $info['permanent_address_contact_number'] == '' || $info['email_address'] == '' || (!$this->validateAlumniEmail($info['email_address'], $user_id))) {
        $this->session->set_flashdata('alert', "You are missing a field in your Personal Information or your email is invalid.");
        return false;
      }
      return true;
    }

    // VALIDATE EMAIL ADDRESS
    private function validateEmail($email, $user_id) {      
      $index = strpos($email, '@');
      if ($index) {

        $index2 = strrpos($email, '.');
        if ($index2 && ($index2 > $index)) {
          $user = $this->alumni->getUserByEmail($email);
          if (!$user || $user[0]->id == $user_id) {
            return true;
          }
        }
      }
      return false;
    }

    private function validateAlumniEmail($email, $user_id) {      
      $index = strpos($email, '@');
      if ($index) {
        $index2 = strrpos($email, '.');
        if ($index2 && ($index2 > $index)) {
          $user = $this->alumni->getUserByEmail($email);
          if (!$user) {
            return true;
          } else {
            foreach ($user as $u) {
              if (($u->user_id != $user_id) && ($u->user_type == "alumni")) {
                return false;
              }              
            }
            return true;
          }
        }
      }
      return false;
    }

    private function validateEnumeratorEmail($email) {
      $index = strpos($email, '@');
      if ($index) {
        $index2 = strrpos($email, '.');
        if ($index2 && ($index2 > $index)) {
          $user = $this->alumni->getUserByEmail($email);
          if (!$user) {
            return true;
          } else {
            foreach ($user as $u) {
              if ($u->user_type == "moderator") {
                return false;
              }              
            }
            return true;
          }
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
      if (isset($info['educational_history'])) {
        foreach ($info['educational_history'] as $key => $value) {        
          $value['degree'] = trim($value['degree']);
          $value['school_taken'] = trim($value['school_taken']);
          if ($value['degree'] != '' && $value['school_taken'] != '') { 
            $this->alumni->updateOtherDegree($key, $value);
          }
        }
      }
      if (isset($info['new_educational_history'])) {
        foreach ($info['new_educational_history'] as $key => $value) {  
          $value['degree'] = trim($value['degree']);
          $value['school_taken'] = trim($value['school_taken']);      
          if ($value['degree'] != '' && $value['school_taken'] != '') { 
            $this->alumni->addOtherDegree($id, $value);
          }
        }
      }      
    }

    // VALIDATE NEW ALUMNI EDUCATIONAL BACKGROUND
    private function validateEducationalBackground($user_id, $info) {
      $info['student_number'] = trim($info['student_number']);
      if ((strlen($info['student_number']) != 10 && $info['student_number'] != '')) {    
        $this->session->set_flashdata('alert', "Invalid student number.");
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
        $this->session->set_flashdata("alert", "Student number must not be blank!");
        return false;
      }
      $stud = $this->alumni->getUserByStudentNumber(addslashes($info['student_number']));

      if ($stud && ($stud[0]->user_id != $user_id && $info['student_number'] != '')) {
        $this->session->set_flashdata('alert', "Student number not available.");
        return false;
      }
      if (isset($info['educational_history'])) {        
        foreach ($info['educational_history'] as $key => $value) {       
          $value['degree'] = trim($value['degree']);
          $value['school_taken'] = trim($value['school_taken']);
          if (($value['degree'] != '' && $value['school_taken'] == '') || ($value['degree'] == '' && $value['school_taken'] != '')) {
            $this->session->set_flashdata("alert", "Please fill-up all the fields for your other degree!");
            return false;
          }
        }
      }
      if (isset($info['new_educational_history'])) {
        foreach ($info['new_educational_history'] as $key => $value) {        
          if (($value['degree'] != '' && $value['school_taken'] == '') || ($value['degree'] == '' && $value['school_taken'] != '')) {
            $this->session->set_flashdata("alert", "Please fill-up all the fields for your other degree!");
            return false;
          }
        }
      }
      return true;
    }

    private function isStudentNumber($var) {
      if ((strlen($var) != 10)) {    
        return false;
      }      
      for($ctr = 0; $ctr < 10; $ctr++) {
        if ($ctr != 4) {
          if (!$this->isNumber($var[$ctr])) {              
            return false;
          }
        } else {
          if ($var[4] != '-') {              
            return false;
          }
        }
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
          $value['job_satisfaction'] = ($value['job_satisfaction'] <= 0) ? 1 : $value['job_satisfaction'];
          $value['job_satisfaction'] = ($value['job_satisfaction'] > 7) ? 7 : $value['job_satisfaction'];
          $this->alumni->updateEmploymentDetails($key, $value);          
        }
      }
    }

    public function deleteJob($user_id, $id, $page = 1) {
      $this->alumni->deleteEmploymentDetails($id);
      $this->session->set_flashdata("notice", "Job deleted!");
      redirect('admin/clean/'.$user_id.'/'.$page);
    }

    public function deleteOtherDegree($user_id, $degree_id, $page = 1) {      
      $this->alumni->deleteOtherDegree($user_id, $degree_id);       
      redirect('admin/clean/'.$user_id.'/'.$page);
    }

    private function validateJobs($jobs) {
      foreach ($jobs as $job) {        
        if ($this->hasEmptyFieldInEmploymentHistory($job) && $this->hasFilledFieldsInEmploymentHistory($job)) {          
          return false;
        }
      }
      return true;
    }

    private function addJobs($user_id, $info) {
      foreach ($info as $var) : 
        if (!$this->hasEmptyFieldInEmploymentHistory($var)) {
          $var['job_satisfaction'] = ($var['job_satisfaction'] <= 0) ? 1 : $var['job_satisfaction'];
          $var['job_satisfaction'] = ($var['job_satisfaction'] > 7) ? 7 : $var['job_satisfaction'];
          $history_id = $this->alumni->addEmploymentDetails($var['business_type'], $var);
          $current_job = isset($var['current_job']) ? 1 : 0;
          $first_job = isset($var['first_job']) ? 1 : 0;
          $this->alumni->addUserEmploymentHistory($user_id, $history_id, $current_job, $first_job);          
        }
      endforeach;
    }

    private function hasEmptyFieldInEmploymentHistory($info) {
      $info['employer'] = trim($info['employer']);
      $info['satisfaction_reason'] = trim($info['satisfaction_reason']);
      $info['job_title'] = trim($info['job_title']);      
      if (($info['employer'] == "") || ($info['job_title'] == "")) {
        return true;
      }
      return false;
    }

    private function hasFilledFieldsInEmploymentHistory($info) {
      $info['employer'] = trim($info['employer']);
      $info['job_title'] = trim($info['job_title']);
      $info['satisfaction_reason'] = trim($info['satisfaction_reason']);
      if (($info['employer'] != "") || ($info['job_title'] != "")) {
        return true;
      }
      return false;
    }

    public function markAlumniClean($id, $page = 1) {
      $this->alumni->markAlumniClean($id);
      $this->session->set_flashdata("notice", "The alumni was marked CLEAN successfully!");      
      redirect('admin/alumni?page='.$page);
    } 

    public function markAlumniUnClean($id, $page = 1) {
      $this->alumni->markAlumniUnClean($id);
      $this->session->set_flashdata("notice", "The alumni was marked UNCLEAN successfully!");
      redirect('admin/alumni?page='.$page);
    }

    public function updateAccount() {
      $cur_pass = $_POST['current_password'];
      $new_pass = $_POST['new_password'];
      $confirm = $_POST['confirm_new_password'];
      $username = $_POST['username'];
      if ($new_pass != $confirm && (!$new_pass && !$confirm)) {
        $this->session->set_flashdata("alert", "The passwords does not match!");
      } else if(strlen($new_pass) < 5 && $new_pass != "") {
        $this->session->set_flashdata("alert", "The password should contain at least 5 characters!");
      } else if ($this->isStudentNumber(trim($username))) {
        $this->session->set_flashdata("alert", "A student number cannot be a username!");
      } else {
        $res = $this->alumni->getUserById($this->session->userdata('user_id'));
        if ($res && $res[0]->password == addslashes($cur_pass)) {          
          if ($username != "" && $new_pass != "") {
            $u = $this->alumni->getUsersByUsername($username);
            if ($u && $u[0]->id != $this->session->userdata('user_id')) {
              $this->session->set_flashdata("alert", "Username not available!");
            } else {
              $this->alumni->updateUsername($this->session->userdata('user_id'), $username);
              $this->alumni->updateUserPassword($this->session->userdata('user_id'), $new_pass);
              $this->session->set_flashdata("notice", "Account successfully updated!");
            }
          } else if ($username != "") {
            $u2 = $this->alumni->getUsersByUsername($username);
            if ($u2 && $u2[0]->id != $this->session->userdata('user_id')) {
              $this->session->set_flashdata("alert", "Username not available!");
            } else {
              $this->alumni->updateUsername($this->session->userdata('user_id'), $username);
              $this->session->set_flashdata("notice", "Account successfully updated!");
            }
          } else if ($new_pass != "") {
            $this->alumni->updateUserPassword($this->session->userdata('user_id'), $new_pass);
            $this->session->set_flashdata("notice", "Account successfully updated!");
          } else {
            $this->session->set_flashdata("alert", "Please set a new username or password!");
          }
        } else {
          $this->session->set_flashdata("alert", "Wrong password!");
        }
      }
      redirect('admin/settings');
    }

    public function addEnumerator() {
      $_POST['name'] = trim($_POST['name']);
      $_POST['email'] = trim($_POST['email']);
      if ($_POST['name'] == "" || $_POST['email'] == "") {
        $this->session->set_flashdata("alert", "The name and email should not be blank!");
      } else if ($this->validateEnumeratorEmail($_POST['email'])) {
        $pass = $this->generatePassword();
        $this->load->model('enumerator_model');
        $id = $this->enumerator_model->addEnumerator($_POST['email'], $pass, $_POST['name']);        
        if (isset($_POST['degree_program'])) {
          foreach ($_POST['degree_program'] as $key => $value) {               
            $this->enumerator_model->addEnumeratorProgram($id, $key);
          }
        }
        $this->enumerator_model->updateEnumeratorStatistics($id, isset($_POST['analysis_access']) ? 1 : 0);        
        $res = $this->mailer($id, 'enumerator');
        $message = "New enumerator added!" . (($res) ? " Email sent!" : " Failed to send email!");
        $this->session->set_flashdata("notice", $message);
      } else {
        $this->session->set_flashdata("alert", "Email not available!");
      }
      redirect('admin/enumerators');
    }

    public function updateEnumerator($user_id) {
      $this->load->model('enumerator_model');
      $this->enumerator_model->deleteAllEnumeratorPrograms($user_id);
      foreach($_POST['degree_program'] as $key=>$value){
        $this->enumerator_model->addEnumeratorProgram($user_id, $key);
      } 
      $this->enumerator_model->updateEnumeratorStatistics($user_id, isset($_POST['analysis_access']) ? 1 : 0);
      $this->session->set_flashdata("notice", "Enumerator updated!");
      redirect('admin/enumerators');
    }

    public function deleteEnumerator($user_id) {
      $this->load->model('enumerator_model');
      $this->enumerator_model->deleteEnumerator($user_id);
      $this->session->set_flashdata("notice", "Enumerator successfully deleted!");
      redirect('admin/enumerators');
    }

    private function generatePassword() {
      $values = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM1234567890";
      $pass = "";
      do {
        $pass = "";
        for ($ctr = 0; $ctr < 6; $ctr++) {          
          $pass .= $values[rand(0,strlen($values) - 1)];
        }
      } while($this->alumni->getUsersByPassword($pass) != null);     
      return $pass;
    }

    private function mailer($user_id, $type) {
      $config['protocol'] = 'smtp';
      $config['smtp_host'] = 'ssl://gator4052.hostgator.com';
      $config['smtp_port'] = 465;
      $config['smtp_user'] = 'alumnitracker@wefoundyou.org';
      $config['smtp_pass'] = '@alumnitracker123';
      $config['mailtype'] = 'html';
      $this->load->library('email', $config);
      $account_info = $this->alumni->getUserById($user_id);
      $personal_info = null;
      if ($type == "enumerator") {
        $personal_info = $this->alumni->getEnumeratorInfoById($user_id);
      } else {
        $personal_info = $this->alumni->getPersonalInfoById($user_id);
      }
      $programs = null;
      if ($type == 'enumerator') {
        $this->load->model('enumerator_model');
        $programs = $this->enumerator_model->getEnumeratorPrograms($user_id);
      }
      $data = array('account_info'=>$account_info, 
                    'personal_info'=>$personal_info,
                    'programs'=>$programs);     
      $message = $this->load->view('mailer/welcome_'.$type.'.php', $data, true);
      $this->email->from('alumnitracker@wefoundyou.org', 'Alumni Tracker');
      $this->email->to(urldecode($personal_info[0]->email));
      $this->email->subject('Welcome ' . (($type == "enumerator") ? "Alumni" : "Enumerator"));
      $this->email->message($message);
      if ($this->email->send()) {        
        // echo '<pre>MESSAGE SENT</pre>';
        return true;
      } else {        
        // echo '<pre>MESSAGE SENDING FAILED</pre>';
        return false;
      }
    }

    public function generateExcel() {
      $alumni = $this->alumni->getAllAlumniInfo();
      $jobs = array();
      $otherDegrees = array();

      foreach ($alumni as $var) {
        array_push($jobs, $this->alumni->getUserAllJobs($var->u_id));
        array_push($otherDegrees, $this->alumni->getOtherDegreeByUserId($var->u_id));
      }

      $data = array('alumni'=>$alumni, 'jobs'=>$jobs, 'otherDegrees'=>$otherDegrees);
      
      // echo '<pre>';
      // print_r($data);
      // echo '</pre>';

      $this->load->view('excel', $data);
    }

    public function search() {
      $key = trim($_GET['query']);      
      if ($key == "") {
        redirect('admin/alumni');
      }
      $data = array('result' => $this->alumni->seach($key), 'key' => $key);      
      $this->load->view("admin/search_results", $data);
    }

    // public function addCountriesFromFile() {
    //   $file = fopen('countries.txt', 'r');
    //   while(!feof($file)) {
    //     $name = fgets($file);
    //     if (strlen(trim($name)) > 0) {
    //       $this->values->addCountry(trim($name));
    //     }
    //   }
    //   fclose($file);      
    // }

  }

?>