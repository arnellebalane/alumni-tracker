<?php
class alumni_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}


	function getUsersByPassword($pass) {
		$query = $this->db->query("SELECT * FROM users WHERE password = '$pass'");
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

	function addComment($user_id) {
		$query = $this->db->query("INSERT INTO comments(user_id) VALUES('$user_id')");
		return $this->db->insert_id();
	}

	function addMajors($comment_id, $name) {
		$name = addslashes(trim($name));
		$query = $this->db->query("INSERT INTO comment_majors VALUES('$comment_id', '$name')");
	}

	function addSuggestedCourses($comment_id, $name) {
		$name = addslashes(trim($name));
		$query = $this->db->query("INSERT INTO comment_suggested_courses VALUES('$comment_id', '$name')");
	}

	function addCommentGECourses($comment_id, $ge_id) {
		$ge_id = addslashes($ge_id);
		$query = $this->db->query("INSERT INTO comment_ge_courses VALUES('$comment_id', '$ge_id')");
	}

	function addEmploymentDetails($user_id, $employer_type_id, $info) {
		$query = $this->db->query("INSERT INTO employment_details (self_employed, business, employer, employer_type_id, job_title, monthly_salary_id, 
															job_satisfaction, reason, year_started, year_ended) VALUES ('".addslashes($info['self_employed'])."', '".addslashes($info['business_name'])."',
															'".addslashes($info['employer'])."', '".$employer_type_id."', '".addslashes($info['job_title'])."', 
															'".addslashes($info['monthly_salary'])."', '".addslashes($info['satisfied_with_job'])."', '".addslashes($info['satisfaction_reason'])."',
															'".addslashes($info['employment_duration']['start_year'])."', '".addslashes($info['employment_duration']['end_year'])."')");
		return mysql_insert_id();
	}

	function addUserEmploymentHistory($user_id, $employment_detail_id, $current_job, $first_job) {
		$query = $this->db->query("INSERT INTO user_employment_histories VALUES ('$user_id', '$employment_detail_id', '$current_job', '$first_job')");
	}
	
	function getUserByStudentNumber($student_number) {
		$query = $this->db->query("SELECT * FROM educational_backgrounds WHERE student_number = '$student_number'");
		return $query->result();
	}

}

?>