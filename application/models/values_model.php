<?php
class values_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function getCountries() {
		$query = $this->db->query("SELECT * from countries");
		return $query->result();
	}

	function getPrograms() {
		$query = $this->db->query("SELECT * from programs");
		return $query->result();
	}

	function getSocialNetworks() {
		$query = $this->db->query("SELECT * from social_networks");
		return $query->result();
	}

	function getGECourses() {
		$query = $this->db->query("SELECT * from ge_courses");
		return $query->result();
	}

	function getEmployerTypes() {
		$query = $this->db->query("SELECT * from employer_types");
		return $query->result();
	}

	function addEmployerType($type) {
		$test = $this->db->query("SELECT * FROM employer_types WHERE name = '$type'");
		$result = $test->result();
		if ($result) {
			return $result[0]->id;
		}
		$query = $this->db->query("INSERT INTO employer_types (name) VALUES ('$type')");
		return mysql_insert_id();
	}

	function getMonthlySalaries() {
		$query = $this->db->query("SELECT * FROM monthly_salaries");
		return $query->result();
	}

	function isCountry($country_id) {
		$query = $this->db->query("SELECT * FROM countries WHERE id = '$country_id'");
		return count($query->result()) == 1;
	}

	function isGECourse($course_id) {
		$query = $this->db->query("SELECT * FROM ge_courses WHERE id = '$course_id'");
		return count($query->result()) == 1;
	}

}
?>