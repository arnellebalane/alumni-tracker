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
}
?>