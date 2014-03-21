<?php

class user_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function getUserById($id) {
		$query = $this->db->query("SELECT * FROM users WHERE id = '$id'");
		return $query->result();
	}

	function getUserByUsernamePassword($username, $password) {
		$query = $this->db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
		return $query->result();
	}

	function getUserByEmail($email) {
		$query = $this->db->query("SELECT users.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE personal_infos.email = '".trim(addslashes($email))."'");
		return $query->result();
	}


}

?>