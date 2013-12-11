<?php
class values_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function getCountries() {
		$query = $this->db->query("SELECT * from countries");
		return $query->result();
	}	
}
?>