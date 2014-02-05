<?php

  class Enumerator extends CI_Controller {

    public function __construct() {
      parent::__construct();
      if ($this->session->userdata('user_type') != "moderator") {
        redirect('/session/index');
      }
      $this->load->model("values_model", "values");
      $this->load->model("alumni_model", "alumni");
      $this->load->model("enumerator_model", "model");      
    }

    public function index() {
      if (!$this->model->canClean()) {
        $this->session->set_flashdata("alert", "Cleaning is currently not allowed!");
        redirect('enumerator/cleaning_disabled');
      }
      $user_id = $this->session->userdata('user_id');
      if ($this->session->userdata('cleaned') == 0 || ($this->session->userdata('cleaned') == 1) || ($this->session->userdata('cleaned') == -1)) {
        $prev_cleaned = $this->session->userdata('cleaned');
      } else {
        $prev_cleaned = 1;
      }
      if ($this->session->userdata('program_id') > 0 || $this->session->userdata('program_id') == -1) {
        $prev_program_id = $this->session->userdata('program_id');
      } else {
        $prev_program_id = 0;
      } 
      if (($this->session->userdata('included') == 0) || ($this->session->userdata('included') == 1) || ($this->session->userdata('included') == -1)) {
        $prev_included = $this->session->userdata('included');
      } else {
        $prev_included = 1;
      }            
      $cleaned = isset($_GET['cleaned']) ? $_GET['cleaned'] : $prev_cleaned;
      $program_id = isset($_GET['program_id']) ? $_GET['program_id'] : $prev_program_id;
      $included = isset($_GET['included']) ? $_GET['included'] : $prev_included;      
      $this->session->set_userdata('cleaned', $cleaned);
      $this->session->set_userdata('program_id', $program_id);
      $this->session->set_userdata('included', $included);
      if (($cleaned > 1 || $cleaned < 0) && $program_id <= 0 && ($included < 0)) {
        $alumni = $this->model->getAllAlumni($user_id);
      } else if (($cleaned <= 1 && $cleaned >= 0) && $program_id <= 0 && ($included < 0)) {
        $alumni = $this->model->getAlumniByCleanStatus($cleaned, $user_id);        
      } else if (($cleaned > 1 || $cleaned < 0) && $program_id > 0 && ($included < 0)) {
        $alumni = $this->model->getAlumniByProgram($program_id, $user_id);    
      } else if (($cleaned <= 1 && $cleaned >= 0) && $program_id > 0 && ($included < 0)){
        $alumni = $this->model->getAlumniByCleanStatusAndProgram($cleaned, $program_id, $user_id);        
      } else if (($cleaned > 1 || $cleaned < 0) && $program_id <= 0 && ($included >= 0)) {
        $alumni = $this->model->getAlumniByInclusion($included, $user_id);
      } else if (($cleaned <= 1 && $cleaned >= 0) && $program_id <= 0 && ($included >= 0)) {
        $alumni = $this->model->getAlumniByInclusionAndStatus($included, $cleaned, $user_id);
      } else if (($cleaned > 1 || $cleaned < 0) && $program_id > 0 && ($included >= 0)) {
        $alumni = $this->model->getAlumniByInclusionAndProgram($included, $program_id, $user_id);
      } else {
        $alumni = $this->alumni->getAlumniByInclusionAndStatusAndProgram($included, $cleaned, $program_id);
      }

      $this->load->add_package_path(APPPATH . 'libraries/paginator');
      $this->load->library('paginator');
      $this->paginator->initialize(count($alumni));
      $data = array('alumni'=>$alumni,
                    'cleaned'=>$cleaned,
                    'program_id'=>$program_id,
                    'included'=>$included,
                    'programs'=>$this->model->getEnumeratorPrograms($user_id),
                    'paginator' => $this->paginator);
      $this->load->helper('edit_info_helper.php');
      $this->load->remove_package_path(APPPATH . 'libraries/paginator');
      $this->load->view('enumerator/index', $data);
    }

    public function cleaning_disabled() {
      if ($this->model->canClean()) {        
        redirect('enumerator/index');
      }
      $this->load->view('enumerator/cleaning_disabled');
    }

    public function clean($id) {
      if (!$this->model->canClean()) {
        $this->session->set_flashdata("alert", "Cleaning is currently not allowed!");
        redirect('enumerator/cleaning_disabled');
      }
      $user_id = $this->session->userdata('user_id');
      if (!$this->model->isAlumniUnderEnumerator($user_id, $id)) {
        $this->session->set_flashdata("alert", "The alumni is not under you scope!");        
        redirect('enumerator/index');
      } 
      // if (!$this->model->canClean()) {
      //   $this->session->set_flashdata("alert", "Cleaning is currently not allowed!");
      //   $this->load->view("enumerator/cleaning_disabled");
      // } 
      else {
        $alumni = $this->alumni->getUserById($id);
        if (!$alumni || $alumni[0]->user_type != "alumni") {
          redirect('admin/alumni');
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
                      'user_id'=>$id
                      );      
        $this->load->helper('edit_info_helper.php');
        $this->load->helper('inflector');      
        $this->load->view('enumerator/clean', $data);
      }
    }

    public function settings() {
      $this->load->view('enumerator/settings');
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
      redirect('enumerator/settings');
    }

    public function deleteAlumni($id) {
      if (!$this->model->canClean()) {
        $this->session->set_flashdata("alert", "Cleaning is currently not allowed!");
        redirect('enumerator/cleaning_disabled');
      }
      $user_id = $this->session->userdata('user_id');
      if (!$this->model->isAlumniUnderEnumerator($user_id, $id)) {
        $this->session->set_flashdata("alert", "The alumni is not under you scope!");        
        redirect('enumerator/index');
      } else {
        $this->alumni->deleteAlumni($id);
        $this->session->set_flashdata("notice", "Alumni removed!");
        redirect('enumerator/index');
      }
    }

    public function markAlumniClean($id) {
      if (!$this->model->canClean()) {
        $this->session->set_flashdata("alert", "Cleaning is currently not allowed!");
        redirect('enumerator/cleaning_disabled');
      }
      $user_id = $this->session->userdata('user_id');
      if (!$this->model->isAlumniUnderEnumerator($user_id, $id)) {
        $this->session->set_flashdata("alert", "The alumni is not under you scope!");        
        redirect('enumerator/index');
      } else {
        $this->alumni->markAlumniClean($id);
        $this->session->set_flashdata("notice", "The alumni was marked CLEAN successfully!");      
        redirect('enumerator/index');
      }
    } 

    public function markAlumniUnClean($id) {
      if (!$this->model->canClean()) {
        $this->session->set_flashdata("alert", "Cleaning is currently not allowed!");
        redirect('enumerator/cleaning_disabled');
      }
      $user_id = $this->session->userdata('user_id');
      if (!$this->model->isAlumniUnderEnumerator($user_id, $id)) {
        $this->session->set_flashdata("alert", "The alumni is not under you scope!");        
        redirect('enumerator/index');
      } else {
        $this->alumni->markAlumniUnClean($id);
        $this->session->set_flashdata("notice", "The alumni was marked UNCLEAN successfully!");
        redirect('enumerator/index');
      }
    }

    public function updateAlumni($id) {
      if (!$this->model->canClean()) {
        $this->session->set_flashdata("alert", "Cleaning is currently not allowed!");
        redirect('enumerator/cleaning_disabled');
      }
      $user_id = $this->session->userdata('user_id');
      if (!$this->model->isAlumniUnderEnumerator($user_id, $id)) {
        $this->session->set_flashdata("alert", "The alumni is not under you scope!");        
        redirect('enumerator/index');
      }
      if (!$this->validatePersonalInformation($_POST['personal_information'], $id)) {        
        $this->session->set_flashdata("alert", "There are errors in the new personal information!");
      } else if (!$this->validateEducationalBackground($id,$_POST['educational_background'])) {
        $this->session->set_flashdata("alert", "There are errors in the new educational background!");
      }  else if (!$this->validateJobs($_POST['jobs'])) {
        $this->session->set_flashdata("alert", "Some information about the jobs are missing!");
      } else if ((isset($_POST['another_job'])) && !$this->validateJobs($_POST['another_job'])) {
        $this->session->set_flashdata("alert", "Some information about the new jobs are missing!");
      } else {
        $this->updatePersonalInfo($id, $_POST['personal_information']);
        $this->updateEducationalBackground($id, $_POST['educational_background']);
        $this->updateJobs($_POST['jobs']);
        if (isset($_POST['another_job'])) {
          $this->addJobs($id, $_POST['another_job']);
        }      
        $res = $this->mailer($id, 'alumni');
        $message = "Update successful!" . (($res) ? " Email sent!" : " Failed to send email!");
        $this->session->set_flashdata("notice", $message);
      }
      redirect('enumerator/clean/'.$id);
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
          $info['permanent_address_contact_number'] == '' || $info['email_address'] == '' || (!$this->validateEmail($info['email_address'], $user_id))) {
        $this->session->set_flashdata('alert', "You are missing a field in your Personal Information or your email is invalid.");
        return false;
      }
      return true;
    }

    // VALIDATE EMAIL ADDRESS
    private function validateEmail($email, $user_id) {      
      $index = strpos($email, '@');     
      if ($index) {
        $index2 = strpos($email, '.');
        if ($index2 && ($index2 > $index)) {
          $user = $this->alumni->getUserByEmail($email);
          if (!$user || $user[0]->id == $user_id) {
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
    }

    // VALIDATE NEW ALUMNI EDUCATIONAL BACKGROUND
    private function validateEducationalBackground($user_id, $info) {
      $info['student_number'] = trim($info['student_number']);
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
          $this->alumni->updateEmploymentDetails($key, $value);          
        }
      }
    }

    public function deleteJob($user_id, $id) {
      $user_id2 = $this->session->userdata('user_id');
      if (!$this->model->isAlumniUnderEnumerator($user_id2, $user_id)) {
        $this->session->set_flashdata("alert", "The alumni is not under you scope!");        
        redirect('enumerator/index');
      }
      $this->alumni->deleteEmploymentDetails($id);
      $this->session->set_flashdata("notice", "Job deleted!");
      redirect('enumerator/clean/'.$user_id);
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
      if (($info['employer'] == "") || ($info['job_title'] == "") || !isset($info['satisfied_with_job'])) {
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
      $this->email->subject('Welcome' . (($type == "enumerator") ? "Alumni" : "Enumerator"));
      $this->email->message($message);
      if ($this->email->send()) {        
        // echo '<pre>MESSAGE SENT</pre>';
        return true;
      } else {        
        // echo '<pre>MESSAGE SENDING FAILED</pre>';
        return false;
      }
    }    

  }

?>