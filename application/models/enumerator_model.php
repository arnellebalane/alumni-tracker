<?php
class enumerator_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function getAllEnumerators() {
    $query = $this->db->query("SELECT users.*, personal_infos.firstname, personal_infos.email FROM users INNER JOIN personal_infos ON personal_infos.user_id =                         users.id WHERE users.user_type='moderator' ORDER BY users.id DESC");
    return $query->result();
  }

  function getEnumeratorPrograms($id) {
    $query = $this->db->query("SELECT programs.* FROM programs INNER JOIN enumerator_programs ON enumerator_programs.program_id =                         programs.id WHERE enumerator_programs.user_id = '".addslashes($id)."'");
    return $query->result();
  }

  function getOtherEnumeratorPrograms($id) {
    $query = $this->db->query("SELECT programs.* FROM programs WHERE programs.id NOT IN (SELECT program_id FROM enumerator_programs WHERE enumerator_programs.user_id='".addslashes($id)."')");
    return $query;
  }

  function getEnumeratorStatistics($id) {
    $query = $this->db->query("SELECT enumerator_statistics.* FROM enumerator_statistics WHERE user_id='".addslashes($id)."'");
    return $query->result();
  }

  function addEnumeratorProgram($user_id, $program_id) {
    $query = $this->db->query("SELECT * FROM enumerator_programs WHERE user_id='".addslashes($user_id)."' AND program_id = '".addslashes(                         $user_id)."'");
    $res = $query->result();
    if (!$res) {
      $this->db->query("INSERT INTO enumerator_programs VALUES('".addslashes($user_id)."', '".addslashes($program_id)."')");
    }
  }

  function deleteAllEnumeratorPrograms($id) {
    $this->db->query("DELETE FROM enumerator_programs WHERE user_id='".addslashes($id)."'");
  }

  function updateEnumeratorStatistics($id, $val) {
    $query = $this->db->query("SELECT * FROM enumerator_statistics WHERE user_id='".addslashes($id)."'");
    $res = $query->result();
    if (!$res) {
      $this->db->query("INSERT INTO enumerator_statistics VALUES ('".addslashes($id)."', '".addslashes($val)."')");
    } else {
      $this->db->query("UPDATE enumerator_statistics SET statistics = '".addslashes($val)."' WHERE user_id='".addslashes($id)."'");
    }
  }

  function deleteEnumerator($user_id) {
    $this->db->query("DELETE FROM personal_infos WHERE user_id = '".addslashes($user_id)."'");
    $this->db->query("DELETE FROM enumerator_statistics WHERE user_id = '".addslashes($user_id)."'");
    $this->db->query("DELETE FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."'");
    $this->db->query("DELETE FROM users WHERE id = '".addslashes($user_id)."'");
  }

  function addEnumerator($email, $password, $firstname) {
    $this->db->query("INSERT INTO users (password, user_type) VALUES ('".addslashes($password)."', 'moderator')");
    $id = mysql_insert_id();
    $username = "enumerator".$id;
    $this->db->query("UPDATE users SET username='".addslashes(trim($username))."' WHERE id = '$id'");
    $this->db->query("INSERT INTO personal_infos (user_id, firstname, email) VALUES ('$id', '".addslashes(trim($firstname))."', '".addslashes(trim($email))."')");
    return $id;
  }
}