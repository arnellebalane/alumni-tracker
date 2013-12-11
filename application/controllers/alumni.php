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
		}

		public function addPersonalInformation($info) {
			
		}
		
	}
?>