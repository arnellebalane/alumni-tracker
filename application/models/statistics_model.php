<?php
class statistics_model extends CI_Model{
  function __construct() {
    parent::__construct();
  }

  function gender() {
    $query = $this->db->query("SELECT SUM(CASE WHEN personal_infos.gender = 'male' then 1 else 0 end) males, 
                               SUM(CASE WHEN personal_infos.gender = 'female' then 1 else 0 end) females
                               FROM personal_infos LEFT JOIN users ON users.id = personal_infos.user_id
                               WHERE users.user_type='alumni' AND users.created_at >= 
                               (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission')");
    return $query->result();
  }

  function countries() {
    $query = $this->db->query("SELECT countries.name, SUM(CASE WHEN personal_infos.present_country_id= countries.id then 1 else 0 end) count, SUM(CASE WHEN personal_infos.gender = 'male' then 1 else 0 end) males,
                               SUM(CASE WHEN personal_infos.gender = 'female' then 1 else 0 end) females
                               FROM countries LEFT JOIN personal_infos ON personal_infos.present_country_id = countries.id LEFT JOIN users ON users.id = personal_infos.user_id
                               WHERE users.user_type='alumni' AND users.created_at >= 
                               (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') GROUP BY countries.id");
    return $query->result();
  }

  function programs() {
    $query = $this->db->query("SELECT programs.name, SUM(CASE WHEN educational_backgrounds.program_id = programs.id then 1 else 0 end)count 
                               FROM programs LEFT JOIN educational_backgrounds ON educational_backgrounds.program_id = programs.id 
                               LEFT JOIN users on users.id = educational_backgrounds.user_id WHERE users.user_type='alumni' 
                               AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') 
                               AND users.created_at <= (SELECT value FROM params WHERE key_name='end_submission') GROUP BY programs.id");
    return $query->result();
  }

  function honorsReceived() {
    $query = $this->db->query("SELECT SUM(CASE WHEN educational_backgrounds.honor_received ='summa cum laude' then 1 else 0 end) suma, 
                               SUM(CASE WHEN educational_backgrounds.honor_received='magna cum laude' then 1 else 0 end) magna,
                               SUM(CASE WHEN educational_backgrounds.honor_received='cum laude' then 1 else 0 end) cum,
                               SUM(CASE WHEN educational_backgrounds.honor_received='none' then 1 else 0 end) none
                               FROM educational_backgrounds LEFT JOIN users ON users.id = educational_backgrounds.user_id WHERE users.user_type='alumni'
                               AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') 
                               AND users.created_at <= (SELECT value FROM params WHERE key_name='end_submission')");
    return $query->result();
  }

  function businessType($program_id) {
    $query= $this->db->query("SELECT employer_types.name, SUM(CASE WHEN employment_details.employer_type_id= employer_types.id AND user_employment_histories.current_job = '1' then 1 else 0 end) curJobCount,
                              SUM(CASE WHEN employment_details.employer_type_id= employer_types.id AND user_employment_histories.first_job = '1' then 1 else 0 end) firstJobCount FROM employer_types RIGHT JOIN employment_details
                              ON employment_details.employer_type_id = employer_types.id RIGHT JOIN user_employment_histories ON user_employment_histories.employment_details_id = employment_details.id
                              RIGHT JOIN users ON users.id = user_employment_histories.user_id RIGHT JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE (user_employment_histories.current_job = '1'
                              OR user_employment_histories.first_job = '1') AND educational_backgrounds.program_id = '".addslashes($program_id)."' AND users.user_type='alumni'
                              AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') 
                              AND users.created_at <= (SELECT value FROM params WHERE key_name='end_submission') GROUP BY employer_types.id");
    return $query->result();
  }

  function monthlySalary($program_id) {
    $query= $this->db->query("SELECT monthly_salaries.minimum, monthly_salaries.maximum, SUM(CASE WHEN employment_details.monthly_salary_id= monthly_salaries.id AND user_employment_histories.current_job = '1' then 1 else 0 end) curJobCount,
                              SUM(CASE WHEN employment_details.monthly_salary_id= monthly_salaries.id AND user_employment_histories.first_job = '1' then 1 else 0 end) firstJobCount FROM monthly_salaries LEFT JOIN employment_details
                              ON employment_details.monthly_salary_id = monthly_salaries.id LEFT JOIN user_employment_histories ON user_employment_histories.employment_details_id = employment_details.id
                              LEFT JOIN users ON users.id = user_employment_histories.user_id LEFT JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE (user_employment_histories.current_job = '1'
                              OR user_employment_histories.first_job = '1') AND educational_backgrounds.program_id = '".addslashes($program_id)."' AND users.user_type='alumni'
                              AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') 
                              AND users.created_at <= (SELECT value FROM params WHERE key_name='end_submission') GROUP BY monthly_salaries.id");
    return $query->result();
  }

  function selfEmployed() {
    $query = $this->db->query("SELECT SUM(CASE WHEN employment_details.self_employed = '1' AND user_employment_histories.first_job = '1' then 1 else 0 end) yesFirst, 
                               SUM(CASE WHEN employment_details.self_employed = '0' AND user_employment_histories.first_job = '1' then 1 else 0 end) noFirst, 
                               SUM(CASE WHEN employment_details.self_employed = '1' AND user_employment_histories.current_job  ='1' then 1 else 0 end) yesCurrent, 
                               SUM(CASE WHEN employment_details.self_employed = '0' AND user_employment_histories.current_job  ='1' then 1 else 0 end) noCurrent 
                               FROM user_employment_histories LEFT JOIN employment_details ON employment_details.id = user_employment_histories.employment_details_id 
                               INNER JOIN users ON users.id = user_employment_histories.user_id 
                               WHERE (user_employment_histories.first_job = 1 OR user_employment_histories.current_job = 1) AND users.user_type='alumni' 
                               AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') 
                               AND users.created_at <= (SELECT value FROM params WHERE key_name='end_submission')");
    return $query->result();
  } 
}

?>