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


}

?>