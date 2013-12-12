<?php
class alumni_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


	function getUsersByPassword($pass) {
		$query = $this->db->query("SELECT * FROM users WHERE password = md5('$pass')");
		return $query->result();
	}

	function addUser($username, $password) {
		$test = $this->db->query("SELECT * FROM users WHERE username = '$username'");		
		if ($test->result()) {			
			return null;
		}
		$query = $this->db->query("INSERT INTO users(username, password, user_type) VALUES ('$username', '$password', 'alumni')");		
		return mysql_insert_id();
	}

	function addEducationalBackground($user_id, $student_number, $program, $semester, $year, $honor) {		
		$query = $this->db->query("INSERT INTO educational_backgrounds VALUES ('$user_id', '$student_number', '$program', 
															'$semester', '$year', '$honor')");
	}
	
	function addPersonalInfo($user_id, $info) {
		$country_id = $info['country'];

		if ($country_id == 'others') {
			$query = $this->db->query("INSERT INTO countries(name) VALUES('".$info['specified_country']."')");
			$country_id = $this->db->insert_id();
		}

		$query = $this->db->query("INSERT INTO personal_infos VALUES(
															'$user_id', '".$info['firstname']."', '".$info['lastname']."', '".$info['gender']."', 
															'".$info['present_address']."', '$country_id', '".$info['present_address_contact_number']."', 
															'".$info['permanent_address']."', '".$info['permanent_address_contact_number']."', 
															'".$info['email_address']."')");
	}

}

?>