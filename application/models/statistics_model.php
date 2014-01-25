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

}
?>