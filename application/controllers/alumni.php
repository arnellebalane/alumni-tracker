<?php
	class Alumni extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model("", "");
		}

		public function add() {						
			$this->addPersonalInformation($_POST['personal_information']);
			$this->addEducationBackground($_POST['educational_background'], $_POST['personal_information']['email_address']);
		}

		public function addPersonalInformation($info) {
			
		}	
		
		public function addEducationBackground($info, $email) {
			print_r($email);
		}	
	}
?>