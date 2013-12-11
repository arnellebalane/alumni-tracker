<?php
class alumni_model extends CI_Model {

	function __construct() {
		parent::__construct();
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