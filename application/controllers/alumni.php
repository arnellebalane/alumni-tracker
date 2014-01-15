<?php
	class Alumni extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model("alumni_model", "model");
		}

		public function home() {
			if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') != 'alumni') {
				redirect('home/index');
			}  

			$this->load->model("values_model", "values");
  		$data = array('countries'=>$this->values->getCountries(),
  									'programs'=>$this->values->getPrograms(),
                    'salaries'=>$this->values->getMonthlySalaries(),
                    'employer_types'=>$this->values->getEmployerTypes(),                    
                    'ge_courses'=>$this->values->getGECourses(),
                    'user_info'=> $this->model->getUserInfoById($this->session->userdata('user_id')),
                    'user_social_networks'=>$this->model->getUserSocialNetworksById($this->session->userdata('user_id')),
                    'social_networks'=>$this->model->getOtherSocialNetworksById($this->session->userdata('user_id')),
                    'current_job'=>$this->model->getUserCurrentJob($this->session->userdata('user_id'))
  									);
      $this->load->helper('edit_info_helper.php');
      $this->load->helper('inflector');      
			$this->load->view('alumni_home', $data);
		}

		public function updateAccount() {
			if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') != 'alumni') {
				redirect('home/index');
			}  
			$old_password = $_POST['current_password'];
			$new_password = $_POST['new_password'];
			$re_password = $_POST['confirm_new_password'];
			if (($old_password == "") || ($new_password == "") || ($re_password == "")) {
				$this->session->set_flashdata("alert", "Please fill-up all the fields for the password!");
			}	else if ($new_password != $re_password) {
				$this->session->set_flashdata("alert", "Passwords does not match!");
			}	else if (strlen($new_password) < 5) {
				$this->session->set_flashdata("alert", "Password should have at least 5 characters!");
			}	else {
				$res = $this->model->getUserById($this->session->userdata('user_id'));
				if ($res[0]->password != $old_password) {
					$this->session->set_flashdata("alert", "Wrong password!");
				}	else {
					$this->model->updateUserPassword($this->session->userdata('user_id'), $new_password);
					$this->session->set_flashdata("notice", "Password updated successfully!");
				}
			}
			redirect('alumni/home');
		}

		public function add() {		
		  if (!$this->validateEducationalBackground($_POST['educational_background'])) {
				$this->session->set_flashdata('inputs', $_POST);
				redirect('/home/questionnaire');
			}	else if (!$this->validateEmploymentHistory($_POST['employment_history'])) {
				$this->session->set_flashdata('inputs', $_POST);
				redirect('/home/questionnaire');
			} else if (!$this->validatePersonalInformation($_POST['personal_information'])) {
				$this->session->set_flashdata('inputs', $_POST);
				redirect('/home/questionnaire');
			} else if (!$this->validateOthers($_POST['others'])) {
				$this->session->set_flashdata('inputs', $_POST);
				redirect('/home/questionnaire');
			}

			$user_id = $this->addEducationBackground($_POST['educational_background'], $_POST['personal_information']['email_address']);	
			$this->addPersonalInformation($user_id, $_POST['personal_information']);
			$this->addEmploymentHistory($user_id, $_POST['employment_history']);
			$this->addOthers($user_id, $_POST['others']);
			$this->session->set_userdata('saved', $user_id);
			redirect('/home/saved');
		}

		// UPDATE PERSONAL INFORMATION
		public function updatePersonalInfo() {
			if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') != 'alumni') {
				redirect('home/index');
			}  
			if (!$this->validatePersonalInformation($_POST['personal_information'])) {			
				redirect('alumni/home');
			}

			if ($_POST['personal_information']['country'] == 'others') {
				$_POST['personal_information']['country'] = $this->model->addCountry(addslashes($_POST['personal_information']['specified_country']));
			}
			$this->model->updatePersonalInfo($this->session->userdata('user_id'), $_POST['personal_information']);

			foreach ($_POST['personal_information']['social_networks'] as $key => $value) {				
				$this->model->addUserSocialNetwork($this->session->userdata('user_id'), $key, $value);
			}
			$this->session->set_flashdata('notice', 'Update successful!');
			redirect('alumni/home');
		}

		// ADD PERSONAL INFORMATION
		private function addPersonalInformation($user_id, $info) {
			if ($info['country'] == 'others') {
				$info['country'] = $this->model->addCountry(addslashes($info['specified_country']));
			}

			$this->model->addPersonalInfo($user_id, $info);

			foreach ($info['social_networks'] as $key => $value) {
				if ($value != '') {
					$this->model->addUserSocialNetwork($user_id, $key, $value);
				}
			}
		}
		

		// ADD OTHER COMMENTS
		private function addOthers($user_id, $info) {
			if ($info['jobs_related'] == 'yes') {
				$comment_id = $this->model->addComment($user_id);

				$useful_courses = explode(',', $info['useful_courses']);
				foreach ($useful_courses as $key => $value) {
					$this->model->addMajors($comment_id, $value);
				}

				$course_suggestions = explode(',', $info['course_suggestions']);
				foreach ($course_suggestions as $key => $value) {
					$this->model->addSuggestedCourses($comment_id, $value);
				}

				if (isset($info['useful_ge'])) {
					foreach ($info['useful_ge'] as $key => $value) {
						$this->model->addCommentGECourses($comment_id, $key);
					}
				}
			}
		}

		// ADD EDUCATIONAL BACKGROUND
		private function addEducationBackground($info, $email) {			
			$username = '';
			if ($info['student_number'] != '') {
				$username = $info['student_number'];
			}
			$pass = $this->generatePassword();
			$user_id = $this->model->addUser(addslashes($username), $pass);
			if ($user_id == null) {
				return null;
			}
			$this->model->addEducationalBackground($user_id, addslashes($info['student_number']), addslashes($info['degree_program']), 
				addslashes($info['graduated']['semester']), addslashes($info['graduated']['academic_year']), addslashes($info['honor_received']));
			return $user_id;
		}

		// UPDATE EDUCATIONAL BACKGROUND
		public function updateEducationalBackground() {		
			if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') != 'alumni') {
				redirect('home/index');
			}  

			if ($this->validateEducationalBackground($_POST['educational_background'])) {
				$addnote = '';
				$stud = $this->model->getEducationalBackground($this->session->userdata('user_id'));
				if (($stud != null && $stud[0]->student_number != '') && $_POST['educational_background']['student_number'] == '') {
					$_POST['educational_background']['student_number'] = $stud[0]->student_number;
					$addnote = ' (w/ student number unchanged)';
				}
			} else {
				$stud = $this->model->getUserByStudentNumber(addslashes($_POST['educational_background']['student_number']));
				if (($stud != null) && ($stud[0]->user_id != $this->session->userdata('user_id'))) {
					$this->session->set_flashdata('alert', "Student number not available!");
					redirect('alumni/home');
				}
			}

			$this->model->updateEducationalBackground($this->session->userdata('user_id'), $_POST['educational_background']);
			$this->model->updateUserStudentNumber($this->session->userdata('user_id'), $_POST['educational_background']['student_number']);
			$this->session->set_flashdata('notice', 'Update successful!'.$addnote);

			redirect('alumni/home');
		}

		private function generatePassword() {
			$values = "qwertyuioplkjhgfdsazxcvbnmQWERTYUIOPLKJHGFDSAZXCVBNM1234567890";
			$pass = "";
			do {
				$pass = "";
				for ($ctr = 0; $ctr < 6; $ctr++) {					
					$pass .= $values[rand(0,strlen($values))];
				}
			} while($this->model->getUsersByPassword($pass) != null);			
			return $pass;
		}

		// ADD EMPLOYMENT HISTORY
		private function addEmploymentHistory($user_id, $info) {
			$this->load->model("values_model", "values");
			if (count($info) == 2 && ($info[0]['business_name'] == $info[0]['employer'] && $info[0]['business_name'] == "") && 
				($info[1]['business_name'] == $info[1]['employer'] && $info[1]['business_name'] == "")) {
				return;
			}
			$ctr = 0;
			foreach ($info as $var) : 
				if (($var['business_name'] != "" || $var['employer'] != "") && (isset($var['satisfied_with_job']))) { 					
					if ($var['employer_type'] == "others") {
						$employer_id = $this->values->addEmployerType($var['specified_employer_type']);
					}	else {
						$employer_id = $var['employer_type'];
					}
					$history_id = $this->model->addEmploymentDetails($user_id, $employer_id, $var);
					print(isset($info['first_job']));
					if ($ctr == 0) {						
						$current_job = 1;
						if (isset($var['first_job']) && ($var['first_job'] == "no")) {							
							$first_job = 0;
						}	else {
							$first_job = 1;
						}					
					}	else if ($ctr == 1) {
						$current_job = 0;
						$first_job = 1;
					}	else {
						$first_job = 0;
						$current_job = 0;
					}
					$this->model->addUserEmploymentHistory($user_id, $history_id, $current_job, $first_job);					
				}
				$ctr++;
			endforeach;
		}

		// SET CURRENT JOB
		public function updateCurrentJob() {
			if (!$this->session->userdata('user_id') || $this->session->userdata('user_type') != 'alumni') {
				redirect('home/index');
			}  
			$info = $_POST['employment_history'][0];
			if (($info['business_name'] == "" && $info['employer'] == "") || (!isset($info['satisfied_with_job']) || ($info['employer_type'] == "others" && $info['specified_employer_type'] == ""))) {
				$this->session->set_flashdata('alert', 'Fill-up all of the fields in updating your current job!');
				redirect('/alumni/home');
			}
			if ($var['employer_type'] == "others") {
				$employer_id = $this->values->addEmployerType($info['specified_employer_type']);
			}	else {
				$employer_id = $info['employer_type'];
			}
			$history_id = $this->model->addEmploymentDetails($user_id, $employer_id, $info);
			$this->model->addUserEmploymentHistory($this->session->userdata('user_id'), $history_id, 1, 0);
			$this->session->set_flashdata('notice', 'Update successful!');
			redirect('/alumni/home');
		}

		// VALIDATE PERSONLAL INFORMATION
		private function validatePersonalInformation($info) {
			$this->load->model('values_model', 'values');
			if ($info['firstname'] == '' || $info['lastname'] == '' || $info['gender'] == '' || $info['present_address'] == '' || 
					!($info['gender'] == 'male' || $info['gender'] == 'female') ||
					($info['country'] == 'others' && $info['specified_country'] == '') ||
					($info['country'] != 'others' && !$this->values->isCountry(addslashes($info['country']))) ||
					$info['present_address_contact_number'] == '' || $info['permanent_address'] == '' || 
					$info['permanent_address_contact_number'] == '' || $info['email_address'] == '') {
				$this->session->set_flashdata('alert', "You are missing a field in your Personal Information.");
				return false;
			}
			return true;
		}

		// VALIDATE OTHER INFORMATION
		private function validateOthers($info) {
			$this->load->model('values_model', 'values');
			if (!isset($info['jobs_related'])) {
				return false;
			}
			if (isset($info['useful_ge'])) {
				foreach ($info['useful_ge'] as $key => $value) {
					if (!$this->values->isGECourse(addslashes($key))) {
						return false;
					}
				}
			}
			return true;
		}

		private function validateEducationalBackground($info) {
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
			if ($this->model->getUserByStudentNumber(addslashes($info['student_number']))) {
				$this->session->set_flashdata('alert', "Student number not available.");
				return false;
			}
			return true;
		}

		private function validateEmploymentHistory($info) {
			$job_count = count($info);
			if ($this->hasEmptyFieldInEmploymentHistory($info[0])) {					
				$this->session->set_flashdata('alert', "Please fill-up all the fields in your employment history!");
				return false;	
			}
			if ($info[0]['first_job'] == 'no' && $this->hasEmptyFieldInEmploymentHistory($info[1])) {
				$this->session->set_flashdata('alert', "Please fill-up all the fields in your employment history!");
				return false;	
			}
			for ($ctr = 2; $ctr < $job_count; $ctr++) {
				if ($this->hasEmptyFieldInEmploymentHistory($info[$ctr]) && $this->hasFilledFieldsInEmploymentHistory($info[$ctr])) {
					$this->session->set_flashdata('alert', "Please fill-up all the fields in your employment history!");
					return false;
				}	else {
					if ($this->hasFilledFieldsInEmploymentHistory($info[$ctr])) {
						if ($info[$ctr]['employer_type'] == 'none' && $info[$ctr]['specified_employer_type'] == "") {
							$this->session->set_flashdata('alert', "Please specify a new business type!");
							return false;
						}
						if ($info[$ctr]['employment_duration']['start_year'] > $info[$ctr]['employment_duration']['end_year']) {
							$this->session->set_flashdata('alert', "Invalid employment duration!");
							return false;
						}
					}
				}
			}
			return true;
		}

		private function isNumber($num) {
			if ($num == '0' || $num == '1' || $num == '2' || $num == '3' || $num == '4' || $num == '5' || $num == '6' || $num == '7' || $num == '8'
					|| $num == '9') 
				return true;
			return false;
		}

		private function hasEmptyFieldInEmploymentHistory($info) {
			if (($info['business_name'] == "" && $info['self_employed'] == '1') || ($info['employer'] == "" && $info['self_employed'] == '0') || ($info['job_title'] == "") || !isset($info['satisfied_with_job'])) {
				return true;
			}
			return false;
		}

		private function hasFilledFieldsInEmploymentHistory($info) {
			if (($info['business_name'] != "" && $info['self_employed'] == '1') || ($info['employer'] != "" && $info['self_employed'] == '0') || ($info['job_title'] != "")) {
				return true;
			}
		}
	}
?>