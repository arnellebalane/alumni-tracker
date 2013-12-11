<?php
	class Alumni extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model("", "");
		}


		public function add() {
			echo '<pre>';
		  print_r($_POST);
		  echo '</pre>';
			$this->addPersonalInformation($_POST['personal_information']);
			$this->addEducationBackground($_POST['educational_background'], $_POST['personal_information']['email_address']);
		}

		public function addPersonalInformation($user_id, $info) {
			
		}
		
		public function addEducationBackground($info, $email) {
			print_r($email);
		}	
	}
?>