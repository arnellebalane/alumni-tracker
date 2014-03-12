<?php
class alumni_model extends CI_Model {

	function __construct() {
		parent::__construct();
	}

	function getUsersByPassword($pass) {
		$query = $this->db->query("SELECT * FROM users WHERE password = '".addslashes($pass)."'");
		return $query->result();
	}

	function getusersByUsername($username) {
		$query = $this->db->query("SELECT * FROM users WHERE username = '".addslashes(trim($username))."'");
		return $query->result();
	}

	function addUser($username, $password) {
		$test = $this->db->query("SELECT * FROM users WHERE username = '$username'");		
		if ($test->result()) {
			return null;
		}
		$query = $this->db->query("INSERT INTO users(username, password, user_type) VALUES ('".addslashes(trim($username))."', '".addslashes($password)."', 'alumni')");	
		$user_id = 	mysql_insert_id();

		if ($username == '') {
			$username = 'alumni-' . $user_id;
			$this->db->query("UPDATE users SET username = '$username' WHERE id = $user_id");
		}

		return $user_id;
	}

	function addEducationalBackground($user_id, $student_number, $program, $semester, $year, $honor) {		
		$query = $this->db->query("INSERT INTO educational_backgrounds VALUES ('".addslashes(trim($user_id))."', '".addslashes(trim($student_number))."', '".addslashes(trim($program))."', 
															'".addslashes(trim($semester))."', '".addslashes(trim($year))."', '".addslashes(trim($honor))."')");
	}

	function addOtherDegree($user_id, $history) {
		$query = $this->db->query("INSERT INTO other_degree (user_id, degree, school_taken, year_finished) VALUES ('".addslashes($user_id)."', '".
			                         addslashes(trim($history['degree']))."' , '".addslashes(trim($history['school_taken']))."', '".addslashes(trim($history['year_finished']))."')");
	}

	function updateEducationalBackground($user_id, $info) {
		$query = $this->db->query("UPDATE educational_backgrounds SET student_number = '".$info['student_number']."', 
															program_id='".addslashes(trim($info['degree_program']))."', semester_graduated='".addslashes(trim($info['graduated']['semester']))."',
															year_graduated='".addslashes(trim($info['graduated']['academic_year']))."', honor_received='".addslashes(trim($info['honor_received']))."'
															WHERE user_id='".addslashes(trim($user_id))."'");		
	}

	function updateUserStudentNumber($user_id, $student_number) {
		$query = $this->db->query("UPDATE users SET username = '".addslashes(trim($student_number))."' WHERE id = '$user_id'");
	}
	
	function addCountry($name) {
		$query = $this->db->query("INSERT INTO countries(name) VALUES('".addslashes(trim($name))."')");
		return $this->db->insert_id();
	}

	function addUserSocialNetwork($user_id, $social_network_id, $account_name) {
		$test = $this->db->query("SELECT * FROM user_social_networks WHERE user_id = '".addslashes($user_id)."' AND social_network_id = '".addslashes($social_network_id)."'");
		if ($test->result()) {
			$query = $this->db->query("UPDATE user_social_networks SET account_name = '".addslashes(trim($account_name))."' WHERE user_id = '".addslashes($user_id)."' 
																AND social_network_id='".addslashes($social_network_id)."'");
		}	else {
			$query = $this->db->query("INSERT INTO user_social_networks(user_id, social_network_id, account_name) 
															 VALUES('$user_id', '".addslashes($social_network_id)."', '".addslashes(trim($account_name))."')");
	  }
	}

	function addPersonalInfo($user_id, $info) {
		$query = $this->db->query("INSERT INTO personal_infos VALUES(
															'$user_id', '".addslashes(trim($info['firstname']))."', '".addslashes(trim($info['lastname']))."', 
															'".addslashes($info['gender'])."', '".addslashes(trim($info['present_address']))."', 
															'".addslashes($info['country'])."', '".addslashes(trim($info['present_address_contact_number']))."', 
															'".addslashes(trim($info['permanent_address']))."', '".addslashes(trim($info['permanent_address_contact_number']))."', 
															'".addslashes(trim($info['email_address']))."')");
	}

	function updatePersonalInfo($user_id, $info) {
		$query = $this->db->query("UPDATE personal_infos SET firstname='".addslashes(trim($info['firstname']))."', lastname='".addslashes(trim($info['lastname']))."', 
															gender='".addslashes($info['gender'])."', present_address='".addslashes(trim($info['present_address']))."', 
															present_country_id='".addslashes($info['country'])."', present_contact_number='".addslashes(trim($info['present_address_contact_number']))."', 
															premanent_address='".addslashes(trim($info['permanent_address']))."', permanent_contact_number='".addslashes(trim($info['permanent_address_contact_number']))."', 
															email='".addslashes(trim($info['email_address']))."' WHERE user_id = '$user_id'");
	}

	function addComment($user_id) {
		$query = $this->db->query("INSERT INTO comments(user_id) VALUES('$user_id')");
		return $this->db->insert_id();
	}

	function addMajors($comment_id, $name) {
		$name = addslashes(trim($name));
		$query = $this->db->query("INSERT INTO comment_majors VALUES('$comment_id', '$name')");
	}

	// function addSuggestedCourses($comment_id, $name) {
	// 	$name = addslashes(trim($name));
	// 	$query = $this->db->query("INSERT INTO comment_suggested_courses VALUES('$comment_id', '".addslashes(trim($name))."')");
	// }

	// function addCommentGECourses($comment_id, $ge_id) {
	// 	$ge_id = addslashes($ge_id);
	// 	$query = $this->db->query("INSERT INTO comment_ge_courses VALUES('$comment_id', '$ge_id')");
	// }

	function addEmploymentDetails($employer_type_id, $info) {
		$query = $this->db->query("INSERT INTO employment_details (self_employed, business, employer, employer_type_id, job_title, monthly_salary_id, 
															job_satisfaction, reason, year_started, month_started, year_ended, month_ended) VALUES ('".addslashes($info['self_employed'])."', '".addslashes(trim($info['business_name']))."',
															'".addslashes(trim($info['employer']))."', '".$employer_type_id."', '".addslashes(trim($info['job_title']))."', 
															'".addslashes($info['monthly_salary'])."', '".addslashes($info['job_satisfaction'])."', '".addslashes(trim($info['satisfaction_reason']))."',
															'".addslashes($info['employment_duration']['start_year'])."', '".addslashes($info['employment_duration']['start_month'])."' ,'".addslashes($info['employment_duration']['end_year'])."', '".addslashes($info['employment_duration']['end_month'])."')");
		return mysql_insert_id();
	}

	function updateEmploymentDetails($id, $info) {
		$employer="";
		$business="";
		if($info['self_employed'] == 1) {
			$business = $info['employer'];
			$employer = "";
		}	else {
			$employer = $info['employer'];
			$business = "";
		}
		$query = $this->db->query("UPDATE employment_details SET self_employed='".addslashes($info['self_employed'])."', business = '".addslashes(trim($business))."', 
			 												employer='".addslashes(trim($employer))."', employer_type_id='".addslashes($info['employer_type'])."', job_title='".addslashes(trim($info['job_title']))."',
			 												monthly_salary_id='".addslashes($info['monthly_salary'])."', job_satisfaction='".addslashes($info['job_satisfaction'])."',
			 												reason='".addslashes(trim($info['satisfaction_reason']))."', year_started='".$info['employment_duration']['start_year']."', month_started = '".addslashes($info['employment_duration']['start_month'])."',year_ended='".addslashes($info['employment_duration']['end_year'])."', month_ended='".addslashes($info['employment_duration']['end_month'])."' WHERE id='".addslashes($id)."'");
	}

	function deleteEmploymentDetails($id) {
		$query = $this->db->query("DELETE FROM user_employment_histories WHERE employment_details_id = '".addslashes($id)."'");
		$query2 = $this->db->query("DELETE FROM employment_details WHERE id = '".addslashes($id)."'");
	}

	function addUserEmploymentHistory($user_id, $employment_detail_id, $current_job, $first_job) {
		if ($current_job == 1) {
			$curJob = $this->getUserCurrentJob($user_id);
			foreach ($curJob as $job) {
				if ($job->year_ended == 100000) {
					$c = $this->db->query("UPDATE employment_details SET year_ended = '".date('Y')."' WHERE id = '".$job->id."'");
				}
			}			
			$q = $this->db->query("UPDATE user_employment_histories SET current_job = 0 WHERE user_id = '$user_id' AND current_job = 1");
		}
		if ($first_job == 1) {
			$q = $this->db->query("UPDATE user_employment_histories SET first_job = 0 WHERE user_id = '$user_id' AND first_job = 1");
		}
		$query = $this->db->query("INSERT INTO user_employment_histories VALUES ('$user_id', '$employment_detail_id', '$current_job', '$first_job')");
	}
	
	function getUserByStudentNumber($student_number) {
		$query = $this->db->query("SELECT * FROM educational_backgrounds WHERE student_number = '".addslashes(trim($student_number))."'");
		return $query->result();
	}

	function getEducationalBackground($id) {
		$query = $this->db->query("SELECT * FROM educational_backgrounds WHERE user_id = '$id'");
		return $query->result();
	}

	function getPersonalInfoById($user_id) {
		$query = $this->db->query("SELECT personal_infos.*, countries.name as 'country' FROM personal_infos INNER JOIN countries on countries.id = personal_infos.present_country_id
			                         WHERE personal_infos.user_id = '".addslashes($user_id)."'");		
		return $query->result();
	}

	function getEnumeratorInfoById($user_id) {
		$query = $this->db->query("SELECT firstname, email FROM personal_infos WHERE user_id = '".addslashes($user_id)."'");
		return $query->result();
	}

	function getUserById($id) {
		$query = $this->db->query("SELECT * FROM users WHERE id = '".addslashes($id)."'");
		return $query->result();
	}

	function getUserAndUserInfoById($user_id) {
		$query = $this->db->query("SELECT users.*, personal_infos.*, educational_backgrounds.*, programs.id as prog_id, programs.name as course, countries.id as 'country_id', countries.name as 'country' FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = personal_infos.user_id 
															 INNER JOIN countries ON countries.id = personal_infos.present_country_id 
															 INNER JOIN programs ON programs.id = educational_backgrounds.program_id WHERE users.id = '".addslashes($user_id)."'");
		return $query->result();
	}

	function getUserInfoById($user_id) {
		$query = $this->db->query("SELECT users.cleaned, users.created_at, personal_infos.*, educational_backgrounds.*, programs.id as prog_id, programs.name as course, countries.id as 'country_id', countries.name as 'country' FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = personal_infos.user_id 
															 INNER JOIN countries ON countries.id = personal_infos.present_country_id 
															 INNER JOIN programs ON programs.id = educational_backgrounds.program_id WHERE users.id = '".addslashes($user_id)."'");
		return $query->result();
	}

	function getOtherDegreeByUserId($user_id) {
		$query = $this->db->query("SELECT * FROM other_degree WHERE user_id = '".addslashes($user_id)."' order by year_finished desc");
		return $query->result();
	}

	function getUserSocialNetworksById($user_id) {
		$query = $this->db->query("SELECT social_networks.*, user_social_networks.account_name FROM user_social_networks 
			join social_networks on social_networks.id = user_social_networks.social_network_id WHERE user_social_networks.user_id = '".addslashes($user_id)."'");
		return $query->result();
	}

	function getOtherSocialNetworksById($user_id) {
		$query = $this->db->query("SELECT social_networks.* FROM social_networks WHERE id NOT IN (SELECT social_network_id FROM user_social_networks WHERE user_id = '".addslashes($user_id)."')");
		return $query->result();
	}

	function getUserCurrentJob($user_id) {
		$query = $this->db->query("SELECT employment_details.*, employer_types.name as employer_type, monthly_salaries.minimum, monthly_salaries.maximum FROM employment_details 
															 INNER JOIN user_employment_histories ON employment_details.id = 
															 user_employment_histories.employment_details_id INNER JOIN employer_types ON employer_types.id = employment_details.employer_type_id 
															 INNER JOIN monthly_salaries ON monthly_salaries.id = employment_details.monthly_salary_id 
															 WHERE user_employment_histories.current_job = 1 AND user_employment_histories.user_id = '".addslashes($user_id)."'");
		return $query->result();
	}

	function getUserFirstJob($user_id) {
		$query = $this->db->query("SELECT employment_details.*, employer_types.name as employer_type, monthly_salaries.minimum, monthly_salaries.maximum FROM employment_details 
															 INNER JOIN user_employment_histories ON employment_details.id = 
															 user_employment_histories.employment_details_id INNER JOIN employer_types ON employer_types.id = employment_details.employer_type_id 
															 INNER JOIN monthly_salaries ON monthly_salaries.id = employment_details.monthly_salary_id 
															 WHERE user_employment_histories.first_job = 1 AND user_employment_histories.user_id = '".addslashes($user_id)."'");
		return $query->result();
	}

	function getUserAllJobs($user_id) {
		$query = $this->db->query("SELECT user_employment_histories.current_job, user_employment_histories.first_job, employment_details.*, employer_types.name as employer_type, 
															 monthly_salaries.maximum, monthly_salaries.minimum FROM user_employment_histories INNER JOIN employment_details ON
															 employment_details.id = user_employment_histories.employment_details_id INNER JOIN employer_types ON employer_types.id = employment_details.employer_type_id
															 INNER JOIN monthly_salaries ON monthly_salaries.id = employment_details.monthly_salary_id WHERE user_employment_histories.user_id = '".addslashes($user_id)."'
															 ORDER BY user_employment_histories.current_job DESC, user_employment_histories.first_job DESC");
		return $query->result();
	}

	function updateUserPassword($user_id, $new_password) {
		$this->db->query("UPDATE users SET password = '".addslashes($new_password)."' WHERE id = '".addslashes($user_id)."'");
	}

	function updateUserName($user_id, $new_username) {
		$this->db->query("UPDATE users SET username = '".addslashes(trim($new_username))."' WHERE id = '".addslashes($user_id)."'");
	}

	function countAllAlumni() {
		$query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.user_type='alumni'");
		return $query->result();
	}

	function getAllAlumni() {
		$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.user_type='alumni'");
		return $query->result();
	}

	function getAllAlumniPaginate($offset, $limit) {
		$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.user_type='alumni' order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
		return $query->result();
	}

	function getAllAlumniInfo() {
		$query = $this->db->query("SELECT *, users.id AS u_id, countries.name AS country, programs.name AS program FROM users 
															INNER JOIN personal_infos ON users.id = personal_infos.user_id 
															INNER JOIN countries ON personal_infos.present_country_id = countries.id
															INNER JOIN educational_backgrounds ON users.id = educational_backgrounds.user_id
															INNER JOIN programs ON educational_backgrounds.program_id = programs.id
															WHERE users.user_type = 'alumni'
															ORDER BY personal_infos.lastname");
		return $query->result();
	}

	function countAlumniByProgram($program_id) {
		$query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
															 AND users.user_type='alumni'");
		return $query->result();
	}

	function getAlumniByProgram($program_id) {
		$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
															 AND users.user_type='alumni'");
		return $query->result();
	}

	function getAlumniByProgramPaginate($program_id, $offset, $limit) {
		$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
															 AND users.user_type='alumni' 
															 order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
		return $query->result();
	}

	function countAlumniByCleanStatus($status) { 
		$query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
															users.user_type='alumni'");
		return $query->result();
	}

	function getAlumniByCleanStatus($status) {
		$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
															users.user_type='alumni'");
		return $query->result();
	}

	function getAlumniByCleanStatusPaginate($status, $offset, $limit) {
		$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
															users.user_type='alumni'
															order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
		return $query->result();
	}

	function countAlumniByCleanStatusAndProgram($status, $program_id) {
		$query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
															 AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni'");
		return $query->result();
	}

	function getAlumniByCleanStatusAndProgram($status, $program_id) {
		$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
															 AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni'");
		return $query->result();
	}

	function getAlumniByCleanStatusAndProgramPaginate($status, $program_id, $offset, $limit) {
		$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
															 AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni'
															 order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
		return $query->result();
	}

	function countAlumniByInclusion($included) {
		if ($included == 1) {
			$query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 WHERE users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission')");
			return $query->result();
		}	else {
			$query2 = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 WHERE users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission'))");
			return $query2->result();
		}
	}

	function getAlumniByInclusion($included) {
		if ($included == 1) {
			$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 WHERE users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission')");
			return $query->result();
		}	else {
			$query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 WHERE users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission'))");
			return $query2->result();
		}
	}

	function getAlumniByInclusionPaginate($included, $offset, $limit) {
		if ($included == 1) {
			$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 WHERE users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission') 
															 order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
			return $query->result();
		}	else {
			$query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 WHERE users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission')) 
															 order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
			return $query2->result();
		}
	}

	function countAlumniByInclusionAndStatus($included, $status) {
		if ($included == 1) {
			$query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
															users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission')");
			return $query->result();
		}	else {
			$query2 = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
															users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission'))");
			return $query2->result();
		}
	}

	function getAlumniByInclusionAndStatus($included, $status) {
		if ($included == 1) {
			$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
															users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission')");
			return $query->result();
		}	else {
			$query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
															users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission'))");
			return $query2->result();
		}
	}

	function getAlumniByInclusionAndStatusPaginate($included, $status, $offset, $limit) {
		if ($included == 1) {
			$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
															users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission') 
															order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
			return $query->result();
		}	else {
			$query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
															users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission')) 
															order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
			return $query2->result();
		}
	}

	function countAlumniByInclusionAndProgram($included, $program_id) {
		if ($included == 1) {
			$query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
															 AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission')");
			return $query->result();			
		}	else {
			$query2 = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
															 AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission'))");
			return $query2->result();
		}
	}

	function getAlumniByInclusionAndProgram($included, $program_id) {
		if ($included == 1) {
			$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
															 AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission')");
			return $query->result();			
		}	else {
			$query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
															 AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission'))");
			return $query2->result();
		}
	}

	function getAlumniByInclusionAndProgramPaginate($included, $program_id, $offset, $limit) {
		if ($included == 1) {
			$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
															 AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission') 
															 order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
			return $query->result();			
		}	else {
			$query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
															 AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission')) 
															 order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
			return $query2->result();
		}
	}

	function countAlumniByInclusionAndStatusAndProgram($included, $status, $program_id) {
		if ($included == 1) {
			$query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
															 AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission')");
			return $query->result();			
		}	else {
			$query2 = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
															 AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission'))");
			return $query2->result();
		}
	}

	function getAlumniByInclusionAndStatusAndProgram($included, $status, $program_id) {
		if ($included == 1) {
			$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
															 AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission')");
			return $query->result();			
		}	else {
			$query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
															 AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission'))");
			return $query2->result();
		}
	}

	function getAlumniByInclusionAndStatusAndProgramPaginate($included, $status, $program_id, $offset, $limit) {
		if ($included == 1) {
			$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
															 AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
															 FROM params WHERE key_name='end_submission') 
															 order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
			return $query->result();			
		}	else {
			$query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
															 AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
															 FROM params WHERE key_name='end_submission')) 
																order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
			return $query2->result();
		}
	}

	
	function deleteAlumni($id) {
		$query = $this->db->query("SELECT id FROM comments WHERE user_id = '".addslashes($id)."'");
		$comments = $query->result();
		foreach ($comments as $comment) {
			$this->db->query("DELETE FROM comment_ge_courses WHERE comment_id = '".addslashes($comment->id)."'");
			$this->db->query("DELETE FROM comment_majors WHERE comment_id = '".addslashes($comment->id)."'");
			$this->db->query("DELETE FROM comment_suggested_courses WHERE comment_id = '".addslashes($comment->id)."'");
		}
		$this->db->query("DELETE FROm comments WHERE user_id = '".addslashes($id)."'");
		$query2 = $this->db->query("SELECT employment_details_id FROM user_employment_histories WHERE user_id='".addslashes($id)."'");
		$jobs = $query2->result();
		foreach ($jobs as $job) {
			$this->db->query("DELETE FROM employment_details WHERE id = '".addslashes($job->employment_details_id)."'");
		}
		$this->db->query("DELETE FROM user_employment_histories WHERE user_id='".addslashes($id)."'");
		$this->db->query("DELETE FROM educational_backgrounds WHERE user_id='".addslashes($id)."'");
		$this->db->query("DELETE FROM educational_backgrounds WHERE user_id='".addslashes($id)."'");
		$this->db->query("DELETE FROM user_social_networks WHERE user_id='".addslashes($id)."'");
		$this->db->query("DELETE FROM personal_infos WHERE user_id='".addslashes($id)."'");
		$this->db->query("DELETE FROM educational_backgrounds WHERE user_id='".addslashes($id)."'");
		$this->db->query("DELETE FROM users WHERE id='".addslashes($id)."'");
	}

	function markAlumniClean($id) {
		$query = $this->db->query("UPDATE users SET cleaned = 1 WHERE id='".addslashes($id)."'");
	}

	function markAlumniUnClean($id) {
		$this->db->query("UPDATE users SET cleaned = 0 WHERE id='".addslashes($id)."'");
	}

	function getUserByEmail($email) {
		$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id
															WHERE personal_infos.email = '".addslashes(trim($email))."'");
		return $query->result();
	}

	function canSubmit() {
		$query = $this->db->query("SELECT value FROM params WHERE key_name='submission'");
    $res = $query->result();
    if ($res && $res[0]->value == "true") {
    	return true;
    }
    return false;
	}

	function deleteOtherDegree($user_id, $degree_id) {		
		$this->db->query("DELETE FROM other_degree WHERE other_degree_id = '".addslashes($degree_id)."' AND user_id = '".addslashes($user_id)."'");		
	}

	function deleteAllOtherDegree($user_id) {
		$this->db->query("DELETE FROM other_degree WHERE user_id='".addslashes($user_id)."'");
	}

	function updateOtherDegree($degree_id, $history) {
		$query = $this->db->query("UPDATE other_degree SET degree = '".addslashes(trim($history['degree']))."', school_taken = '".addslashes(trim($history['school_taken']))."', 
			                         year_finished = '".addslashes(trim($history['year_finished']))."' WHERE other_degree_id = '".addslashes($degree_id)."'");
	}

	function seach($key) {
		$key = trim($key);
		$lastSpace = strrpos($key, ' ');		
		$keys = explode(" ", $key);
		$subquery = "";
		for ($ctr = 0; $ctr < count($keys); $ctr++) {
			$k = trim($keys[$ctr]);			
			if (strlen($k) > 0) {				
				$subquery .= "personal_infos.firstname LIKE '".addslashes($keys[$ctr])."%' OR personal_infos.firstname LIKE '% ".addslashes($keys[$ctr])."%'  OR personal_infos.lastname LIKE '".addslashes($keys[$ctr])."%' OR personal_infos.lastname LIKE '% ".addslashes($keys[$ctr])."%' ";
			}
			if ($ctr+1 != count($keys) && strlen($k) > 0) {
				$subquery .="OR ";
			}
		}
		$first = ($lastSpace) ? substr($key, 0, $lastSpace) : $key;
		$family = ($lastSpace) ? substr($key, $lastSpace+1) : $key;				
		$query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
															 INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE users.user_type='alumni' AND (educational_backgrounds.student_number LIKE '%".addslashes(trim($key))."%' 
															 	OR ".$subquery.")
															 order by users.id desc");
		return $query->result();
	}

}

?>