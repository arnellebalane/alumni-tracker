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
								echo "selected";
							}
						}	else {
							if (isset($post[$field][$sub_field_1][$sub_field_2]) && $post[$field][$sub_field_1][$sub_field_2] == $value) {
								echo "selected";
							}
						}
					}	else {
						if (isset($post[$field][$sub_field_1]) && $post[$field][$sub_field_1] == $value) {
							echo "selected";
						}
					}

				}	else {
					if (isset($post[$field]) && $post[$field] == $value) {
						echo "selected";
					}
				}
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
								echo "checked";
							}
						}	else {
							if (isset($post[$field][$sub_field_1][$sub_field_2]) && $post[$field][$sub_field_1][$sub_field_2] == $value) {
								echo "checked";
							}
						}
					}	else {
						if (isset($post[$field][$sub_field_1]) && $post[$field][$sub_field_1] == $value) {
							echo "checked";
						}
					}

				}	else {
					if (isset($post[$field]) && $post[$field] == $value) {
						echo "checked";
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
							echo $post[$field][$sub_field_1][$sub_field_2][$sub_field_3];
						}	else if (isset($post[$field][$sub_field_1][$sub_field_2])) {
							echo $post[$field][$sub_field_1][$sub_field_2];
						}
					}	else if (isset($post[$field][$sub_field_1])){
						echo $post[$field][$sub_field_1];
					}
				}	else if (isset($post[$field])){
					echo $post[$field];
				}
			}
		}
	}



?>