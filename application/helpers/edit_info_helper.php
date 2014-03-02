<?php
	function is_selected($input, $value) {
		if (strcmp($input, $value) == 0) {
			return "selected";
		}		
	}

	function is_checked($input, $value) {
		if (strcasecmp($input, $value) == 0) {			
			return "checked";
		}
		return "unchecked";		
	}

	function pop_is_selected($field, $sub_field_1, $sub_field_2, $sub_field_3, $value) {
		$CI =& get_instance();
		$post = $CI->session->flashdata('inputs');
		if ($post) {
			if ($field != null) {
				if ($sub_field_1 != null) {
					if ($sub_field_2 != null) {						
						if ($sub_field_3 != null) {
							if (isset($post[$field][$sub_field_1][$sub_field_2][$sub_field_3]) && $post[$field][$sub_field_1][$sub_field_2][$sub_field_3] == $value) {
								return "selected";
							}
						}	else {
							if (isset($post[$field][$sub_field_1][$sub_field_2]) && $post[$field][$sub_field_1][$sub_field_2] == $value) {
								return "selected";
							}
						}
					}	else {
						if (isset($post[$field][$sub_field_1]) && $post[$field][$sub_field_1] == $value) {
							return "selected";
						}
					}

				}	else {
					if (isset($post[$field]) && $post[$field] == $value) {
						return "selected";
					}
				}
			}
		}
	}

	function pop_is_checked($field, $sub_field_1, $sub_field_2, $sub_field_3, $value) {
		$CI =& get_instance();
		$post = $CI->session->flashdata('inputs');
		if ($post) {
			if ($field != null) {
				if ($sub_field_1 != null) {
					if ($sub_field_2 != null) {						
						if ($sub_field_3 != null) {
							if (isset($post[$field][$sub_field_1][$sub_field_2][$sub_field_3]) && $post[$field][$sub_field_1][$sub_field_2][$sub_field_3] == $value) {
								return "checked";
							}
						}	else {
							if (isset($post[$field][$sub_field_1][$sub_field_2]) && $post[$field][$sub_field_1][$sub_field_2] == $value) {
								return "checked";
							}
						}
					}	else {
						if (isset($post[$field][$sub_field_1]) && $post[$field][$sub_field_1] == $value) {
							return "checked";
						}
					}

				}	else {
					if (isset($post[$field]) && $post[$field] == $value) {
						return "checked";
					}
				}
			}
		}
	}

	function pop_set_field_value($field, $sub_field_1, $sub_field_2, $sub_field_3) {
		$CI =& get_instance();
		$post = $CI->session->flashdata('inputs');
		if ($post) {
			if ($field != null) {
				if ($sub_field_1 != null) {
					if ($sub_field_2 != null) {						
						if ($sub_field_3 != null && isset($post[$field][$sub_field_1][$sub_field_2][$sub_field_3])) {
							return $post[$field][$sub_field_1][$sub_field_2][$sub_field_3];
						}	else if (isset($post[$field][$sub_field_1][$sub_field_2])) {
							return $post[$field][$sub_field_1][$sub_field_2];
						}
					}	else if (isset($post[$field][$sub_field_1])){
						return $post[$field][$sub_field_1];
					}
				}	else if (isset($post[$field])){
					return $post[$field];
				}
			}
		}
	}

	function to_month($i) {
		switch ($i) {
			case 1:
				return "January";				
			case 2:
				return "February";
			case 3:
				return "March";
			case 4:
				return "April";
			case 5:
				return "May";
			case 6:
				return "June";
			case 7:
				return "July";
			case 8:
				return "August";
			case 9:
				return "September";
			case 10:
				return "October";
			case 11:
				return "November";						
			default:
				return "December";
				break;
		}
	}

	function job_satisfaction_label($num) {
		switch($num) {
			case 1:
				return "1 - very unsatisfied";
			case 2:
				return "2 - unsatisfied";
			case 3:
				return "3 - a bit unsatisfied";
			case 4:
				return "4 - neutral";
			case 5:
				return "5 - a bit satisfied";
			case 6:
				return "6 - satisfied";
			default:
				return "7 - very satisfied";
		}			
	}

?>