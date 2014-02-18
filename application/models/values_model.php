<?php
class values_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function getCountries() {
		$query = $this->db->query("SELECT * from countries order by countries.name");
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

	function addSocialNetwork($name) {
		$test = $this->db->query("SELECT * FROM social_networks WHERE name = '".addslashes($name)."'");
		$res = $test->result();
		if ($res) {
			return $res[0]->id;
		}	else {
			$this->db->query("INSERT INTO social_networks (name) VALUES ('".addslashes($name)."')");
			return mysql_insert_id();
		}
	}

	function updateSocialNetwork($id, $name) {
		$test = $this->db->query("SELECT * FROM social_networks WHERE name = '".addslashes($name)."'");
		$res = $test->result();
		if (!$res) {
			$this->db->query("UPDATE social_networks SET name = '".addslashes($name)."' WHERE id = '".addslashes($id)."'");
		}
	}

	function deleteSocialNetwork($id) {
		$test = $this->db->query("SELECT * FROM social_networks WHERE id = '".addslashes($id)."'");
		$res = $test->result();
		if ($res) {
			$this->db->query("DELETE FROM social_networks WHERE id='".addslashes($id)."'");
			return true;
		}
		return false;		
	}

	function getGECourses() {
		$query = $this->db->query("SELECT * from ge_courses");
		return $query->result();
	}

	function addGECourse($name, $code, $description) {		
		$test = $this->db->query("SELECT * FROM ge_courses WHERE name = '".addslashes($name)."' OR code = '".addslashes($code)."'");
		$res = $test->result();
		if ($res) {
			return false;
		}	else {
			$this->db->query("INSERT INTO ge_courses(name, code, description) VALUES ('".addslashes($name)."', '".addslashes($code)."', '".addslashes($description)."')");
			return true;
		}		
	}

	function updateGECourse($name, $code, $description, $id) {
		$test = $this->db->query("SELECT * FROM ge_courses WHERE name = '".addslashes($name)."' OR code = '".addslashes($code)."'");
		$res = $test->result();
		if (($res) && ((count($res) > 1) || ($res[0]->id != $id))) {
			return false;
		}	else {
			$this->db->query("UPDATE ge_courses SET name='".addslashes($name)."', code='".addslashes($code)."', description='".addslashes($description)."' WHERE id='".addslashes($id)."'");
			return true;			
		}		
	}

	function deleteGECourse($id) {
		$test = $this->db->query("SELECT * FROM ge_courses WHERE id='".addslashes($id)."'");
		$res = $test->result();
		if ($res) {
			$this->db->query("DELETE FROM ge_courses WHERE id='".addslashes($id)."'");
			return true;
		}
		return false;
	}

	function getEmployerTypes() {
		$query = $this->db->query("SELECT * from employer_types");
		return $query->result();
	}

	function addEmployerType($type) {
		$test = $this->db->query("SELECT * FROM employer_types WHERE name = '".addslashes($type)."'");
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

	function getMetaData($key) {
		$query = $this->db->query("SELECT * FROM params WHERE key_name = '$key'");
		return $query->result();
	}

	function toggleSubmission() {
		$query = $this->db->query("SELECT * FROM params WHERE key_name = 'submission'");
		$result = $query->result();
		if ($result[0]->value == 'true') {
			$this->db->query("UPDATE params SET value = 'false' WHERE key_name = 'submission'");
			return false;
		} else {
			$this->db->query("UPDATE params SET value = 'true' WHERE key_name = 'submission'");
			return true;
		}
	}

	function toggleCleaning() {
		$query = $this->db->query("SELECT * FROM params WHERE key_name = 'cleaning'");
		$result = $query->result();
		if ($result[0]->value == 'true') {
			$this->db->query("UPDATE params SET value = 'false' WHERE key_name = 'cleaning'");
			return false;
		} else {
			$this->db->query("UPDATE params SET value = 'true' WHERE key_name = 'cleaning'");
			return true;
		}
	}

	function updateMetadata($start_submission, $end_submission, $start_cleaning, $end_cleaning) {
		$this->db->query("UPDATE params SET value = '$start_submission' WHERE key_name = 'start_submission'");
		$this->db->query("UPDATE params SET value = '$end_submission' WHERE key_name = 'end_submission'");
		$this->db->query("UPDATE params SET value = '$start_cleaning' WHERE key_name = 'start_cleaning'");
		$this->db->query("UPDATE params SET value = '$end_cleaning' WHERE key_name = 'end_cleaning'");
	}

}
?>