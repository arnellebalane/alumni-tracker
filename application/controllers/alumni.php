<?php
	class Alumni extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model("alumni_model", "model");
		}


		public function add() {
			echo '<pre>';
		  print_r($_POST);
		  echo '</pre>';
			// $this->addPersonalInformation($_POST['personal_information']);			
			$this->addEducationBackground($_POST['educational_background'], $_POST['personal_information']['email_address']);
		}


		public function addPersonalInformation($user_id, $info) {
			
		}
		
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


		private function addEmploymentHistory($user_id, $info) {

		}
	}
?>