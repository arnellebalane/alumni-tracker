<?php
class values_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function getCountries() {
		$query = $this->db->query("SELECT * from countries");
		return $query->result();
	}

	function addCountry($name) {
		$in = $this->db->query("SELECT * FROM countries WHERE name = '".addslashes($name)."'");
		$res = $in->result();
		if ($res) {
			return $res[0]->id;
		}	else {
			$this->db->query("INSERT INTO countries (name) VALUES ('".addslashes($name)."')");
			return mysql_insert_id();
		}
	}

	function replaceCountry($toreplaceId, $replacedId) {
		if ($toreplaceId == $replacedId) {
			return;
		}
		$this->db->query("UPDATE personal_infos SET present_country_id = '".addslashes($toreplaceId)."' WHERE present_country_id = '".addslashes($replacedId)."'");
		$this->db->query("DELETE FROM countries WHERE id = '".addslashes($replacedId)."'");
	}

	function getPrograms() {
		$query = $this->db->query("SELECT * from programs");
		return $query->result();
	}

	function addProgram($name) {
		$test = $this->db->query("SELECT * FROM programs WHERE name = '".addslashes($name)."'");
		$res = $test->result();
		if ($res) {
			return $res[0]->id;
		}
		$this->db->query("INSERT INTO programs (name) VALUES ('".addslashes($name)."')");
		return mysql_insert_id();
	}

	function updateProgram($id, $name) {
		$test = $this->db->query("SELECT id FROM programs WHERE name = '".addslashes($name)."'");
		$res = $test->result();
		if ($res) {
			if (addslashes($id) != $res[0]->id) {						
				$this->db->query("UPDATE educational_backgrounds SET program_id = '".$res[0]->id."' WHERE program_id = '$id'");
				$this->db->query("DELETE FROM programs WHERE id = '".addslashes($id)."'");
			}
			return $res[0]->id;
		}	else {
			$this->db->query("UPDATE programs SET name = '".addslashes($name)."' WHERE id = '".addslashes($id)."'");
			return $id;
		}
	}

	function deleteProgram($id) {
		$query = $this->db->query("DELETE FROM programs WHERE id = '$id'");
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

	function replaceEmployerType($toreplaceId, $replacedId) {
		if ($toreplaceId == $replacedId) {
			return;
		}
		$this->db->query("UPDATE employment_details SET employer_type_id = '".addslashes($toreplaceId)."' WHERE employer_type_id = '".addslashes($replacedId)."'");
		$this->db->query("DELETE FROM employer_types WHERE id = '".addslashes($replacedId)."'");
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