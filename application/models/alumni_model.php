<?php
class alumni_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}
	
	function addPersonalInfo($user_id, $info) {
		$country_id = $info['country'];

		if ($country_id == 'others') {
			$query = $this->db->query("INSERT INTO countries(name) VALUES('".addslashes($info['specified_country'])."')");
			$country_id = $this->db->insert_id();
		}

		$query = $this->db->query("INSERT INTO personal_infos VALUES(
															'$user_id', '".addslashes($info['firstname'])."', '".addslashes($info['lastname'])."', 
															'".addslashes($info['gender'])."', '".addslashes($info['present_address'])."', '$country_id', 
															'".addslashes($info['present_address_contact_number'])."', '".addslashes($info['permanent_address'])."', 
															'".addslashes($info['permanent_address_contact_number'])."', '".addslashes($info['email_address'])."')");
	}

}

?>