<?php
	class Alumni extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model("alumni_model", "model");
		}


		public function add() {
			// echo '<pre>';
		 //  print_r($_POST);
		 //  echo '</pre>';

		  if (!$this->validateEducationalBackground($_POST['educational_background'])) {
				$this->session->set_flashdata('inputs', $_POST);
				redirect('/home/questionnaire');
			}	else if (!$this->validateEmploymentHistory($_POST['employment_history'])) {
				$this->session->set_flashdata('inputs', $_POST);
				redirect('/home/questionnaire');
			}
				
			$user_id = $this->addEducationBackground($_POST['educational_background'], $_POST['personal_information']['email_address']);	
			$this->addPersonalInformation($user_id, $_POST['personal_information']);		
			$this->addEmploymentHistory($user_id, $_POST['employment_history']);
			$this->session->set_userdata('saved', $user_id);
			redirect('/home/saved');
		}

		// ADD PERSONAL INFORMATION
		public function addPersonalInformation($user_id, $info) {
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
		public function addOthers($user_id, $info) {

		}

		// ADD EDUCATIONAL BACKGROUND
		private function addEducationBackground($info, $email) {			
			$username = $email;
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

		private function validateEducationalBackground($info) {
			if (strlen($info['student_number']) != 10 || $info['student_number'][4] != '-') {				
				return false;
			}
			for($ctr = 0; $ctr < 10; $ctr++) {
				if ($ctr != 4) {					
					if (!$this->isNumber($info['student_number'][$ctr])) {
						return false;
					}
				}
			}
			if ($this->model->getUserByStudentNumber(addslashes($info['student_number']))) {
				return false;
			}
			return true;	
		}

		private function validateEmploymentHistory($info) {
			$job_count = count($info);			
			for ($ctr = 0; $ctr < $job_count; $ctr++) {
				if (($info[$ctr]['business_name'] == "" && $info[$ctr]['employer'] == "") || ($info[$ctr]['job_title'] == "") ||
					  !isset($info[$ctr]['satisfied_with_job'])) {
					if ($ctr == 1 && $job_count == 2) {
						continue;
					}
					$this->session->set_flashdata('alert', "Please fill-up all the fields in your employment history!");
					return false;
				}
				if ($info[$ctr]['employer_type'] == 'none' && $info[$ctr]['specified_employer_type'] == "") {
					$this->session->set_flashdata('alert', "Please specify a new business type!");
					return false;
				}
				if ($info[$ctr]['employment_duration']['start_year'] > $info[$ctr]['employment_duration']['end_year']) {
					$this->session->set_flashdata('alert', "Invalid employment duration!");
					return false;
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
	}
?>