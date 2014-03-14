<?php

	function is_selected($field, $sub_field_1, $sub_field_2, $sub_field_3, $value) {
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

	function is_phil($country) {
		$CI =& get_instance();
		$post = $CI->session->flashdata('inputs');
		if (!$post) {
			if (strcmp($country, "Philippines") == 0) {
				return "selected";
			}
		}
	}

	function is_checked($field, $sub_field_1, $sub_field_2, $sub_field_3, $value) {
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

	function set_field_value($field, $sub_field_1, $sub_field_2, $sub_field_3) {
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