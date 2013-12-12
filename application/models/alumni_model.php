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
	
	function addCountry($name) {
		$query = $this->db->query("INSERT INTO countries(name) VALUES('".addslashes($name)."')");
		return $this->db->insert_id();
	}

	function addUserSocialNetwork($user_id, $social_network_id, $account_name) {
		$query = $this->db->query("INSERT INTO user_social_networks(user_id, social_network_id, account_name) 
															VALUES('$user_id', '".addslashes($social_network_id)."', '".addslashes($account_name)."')");
	}

	function addPersonalInfo($user_id, $info) {
		$query = $this->db->query("INSERT INTO personal_infos VALUES(
															'$user_id', '".addslashes($info['firstname'])."', '".addslashes($info['lastname'])."', 
															'".addslashes($info['gender'])."', '".addslashes($info['present_address'])."', 
															'".addslashes($info['country'])."', '".addslashes($info['present_address_contact_number'])."', 
															'".addslashes($info['permanent_address'])."', '".addslashes($info['permanent_address_contact_number'])."', 
															'".addslashes($info['email_address'])."')");
	}

	function addEmploymentDetails($info) {

	}
	

}

?>