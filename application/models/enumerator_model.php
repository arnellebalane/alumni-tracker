<?php
class enumerator_model extends CI_Model {

  function __construct() {
    parent::__construct();
  }

  function getAllEnumerators() {
    $query = $this->db->query("SELECT users.*, personal_infos.firstname, personal_infos.email FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id WHERE users.user_type='moderator' ORDER BY users.id DESC");
    return $query->result();
  }

  function getEnumeratorPrograms($id) {
    $query = $this->db->query("SELECT programs.* FROM programs INNER JOIN enumerator_programs ON enumerator_programs.program_id = programs.id WHERE enumerator_programs.user_id = '".addslashes($id)."'");
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
    $query = $this->db->query("SELECT * FROM enumerator_programs WHERE user_id='".addslashes($user_id)."' AND program_id = '".addslashes($user_id)."'");
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
    $test = $this->db->query("SELECT * FROM users WHERE username='$username'");
    $res = $test->result();
    $ctr = 0;
    while ($res) {
      $username = $username . $ctr;
      $test = $this->db->query("SELECT * FROM users WHERE username='$username'");
      $res = $test->result();
    }
    $this->db->query("UPDATE users SET username='".addslashes(trim($username))."' WHERE id = '$id'");
    $this->db->query("INSERT INTO personal_infos (user_id, firstname, email) VALUES ('$id', '".addslashes(trim($firstname))."', '".addslashes(trim($email))."')");
    return $id;
  }

  function countAllAlumni($user_id) {
    $query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds 
                               ON educational_backgrounds.user_id = users.id WHERE users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
    return $query->result();
  }

  function getAllAlumni($user_id) {
    $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds 
                               ON educational_backgrounds.user_id = users.id WHERE users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
    return $query->result();
  }

  function getAllAlumniPaginate($user_id, $offset, $limit) {
    $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds 
                               ON educational_backgrounds.user_id = users.id WHERE users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                               order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
    return $query->result();
  }

  function countAlumniByProgram($program_id, $user_id) {
    $query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
                               AND users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
    return $query->result();
  }

  function getAlumniByProgram($program_id, $user_id) {
    $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
                               AND users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
    return $query->result();
  }

  function getAlumniByProgramPaginate($program_id, $user_id, $offset, $limit) {
    $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
                               AND users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                               order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
    return $query->result();
  }

  function countAlumniByCleanStatus($status, $user_id) {
    $query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON 
                               educational_backgrounds.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
                              users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
    return $query->result();
  }

  function getAlumniByCleanStatus($status, $user_id) {
    $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON 
                               educational_backgrounds.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
                              users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
    return $query->result();
  }

  function getAlumniByCleanStatusPaginate($status, $user_id, $offset, $limit) {
    $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON 
                               educational_backgrounds.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
                              users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                              order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
    return $query->result();
  }

  function countAlumniByCleanStatusAndProgram($status, $program_id, $user_id) {
    $query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
                               AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
    return $query->result();
  }

  function getAlumniByCleanStatusAndProgram($status, $program_id, $user_id) {
    $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
                               AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
    return $query->result();
  }

  function getAlumniByCleanStatusAndProgramPaginate($status, $program_id, $user_id, $offset, $limit) {
    $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
                               AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                               order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
    return $query->result();
  }

  function countAlumniByInclusion($included, $user_id) {
    if ($included == 1) {
      $query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id
                               WHERE users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query->result();
    } else {
      $query2 = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id
                               WHERE users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query2->result();
    }
  }

  function getAlumniByInclusion($included, $user_id) {
    if ($included == 1) {
      $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id
                               WHERE users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query->result();
    } else {
      $query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id
                               WHERE users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query2->result();
    }
  }

  function getAlumniByInclusionPaginate($included, $user_id, $offset, $limit) {
    if ($included == 1) {
      $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id
                               WHERE users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                               order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
      return $query->result();
    } else {
      $query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id
                               WHERE users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                               order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
      return $query2->result();
    }
  }

  function countAlumniByInclusionAndStatus($included, $status, $user_id) {
    if ($included == 1) {
      $query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
                              users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query->result();
    } else {
      $query2 = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
                              users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query2->result();
    }
  }

  function getAlumniByInclusionAndStatus($included, $status, $user_id) {
    if ($included == 1) {
      $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
                              users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query->result();
    } else {
      $query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
                              users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query2->result();
    }
  }

  function getAlumniByInclusionAndStatusPaginate($included, $status, $user_id, $offset, $limit) {
    if ($included == 1) {
      $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
                              users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                              order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
      return $query->result();
    } else {
      $query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE users.cleaned = '".addslashes($status)."' AND
                              users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                               order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
      return $query2->result();
    }
  }

  function countAlumniByInclusionAndProgram($included, $program_id, $user_id) {
    if ($included == 1) {
      $query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
                               AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query->result();      
    } else {
      $query2 = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
                               AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query2->result();
    }
  }

  function getAlumniByInclusionAndProgram($included, $program_id, $user_id) {
    if ($included == 1) {
      $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
                               AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query->result();      
    } else {
      $query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
                               AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query2->result();
    }
  }

  function getAlumniByInclusionAndProgramPaginate($included, $program_id, $user_id, $offset, $limit) {
    if ($included == 1) {
      $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
                               AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                               order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
      return $query->result();      
    } else {
      $query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."'
                               AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                               order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
      return $query2->result();
    }
  }

  function countAlumniByInclusionAndStatusAndProgram($included, $status, $program_id, $user_id) {
    if ($included == 1) {
      $query = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
                               AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query->result();      
    } else {
      $query2 = $this->db->query("SELECT count(users.id) as count FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
                               AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query2->result();
    }
  }

  function getAlumniByInclusionAndStatusAndProgram($included, $status, $program_id, $user_id) {
    if ($included == 1) {
      $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
                               AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query->result();      
    } else {
      $query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
                               AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
      return $query2->result();
    }
  }

  function getAlumniByInclusionAndStatusAndProgramPaginate($included, $status, $program_id, $user_id, $offset, $limit) {
    if ($included == 1) {
      $query = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
                               AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND users.created_at >= (SELECT value FROM params WHERE key_name='start_submission') AND users.created_at <= (SELECT value 
                               FROM params WHERE key_name='end_submission') AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                               order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
      return $query->result();      
    } else {
      $query2 = $this->db->query("SELECT users.*, personal_infos.* FROM users INNER JOIN personal_infos ON personal_infos.user_id = users.id 
                               INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE educational_backgrounds.program_id = '".addslashes($program_id)."' 
                               AND users.cleaned = '".addslashes($status)."' AND users.user_type='alumni' AND (users.created_at < (SELECT value FROM params WHERE key_name='start_submission') OR users.created_at > (SELECT value 
                               FROM params WHERE key_name='end_submission')) AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                               order by users.id desc LIMIT ".addslashes($limit)." OFFSET ".addslashes($offset)."");
      return $query2->result();
    }
  }

  function isAlumniUnderEnumerator($user_id, $alumni) {
    $query = $this->db->query("SELECT users.* FROM users INNER JOIN educational_backgrounds ON educational_backgrounds.user_id = users.id WHERE users.id='".addslashes($alumni)."' 
                              AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')");
    $res = $query->result();
    if ($res) {
      return true;
    }
    return false;
  }

  function canClean() {
    $query = $this->db->query("SELECT value FROM params WHERE key_name='cleaning'");
    $res = $query->result();
    if ($res && $res[0]->value == "true") {
      $query2 = $this->db->query("SELECT value FROM params WHERE key_name='start_cleaning'");      
      $res2 = $query2->result();      
      if ($res2 && $res2[0]->value <= date('Y-m-d')) {
        $query3 = $this->db->query("SELECT value FROM params WHERE key_name='end_cleaning'");
        $res3 = $query3->result();        
        if ($res3 && $res3[0]->value >= date('Y-m-d')) {          
          return true;
        }
      }       
    }
    return false;
  }

  function seach($key, $user_id) {
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
                                OR ".$subquery.") AND educational_backgrounds.program_id IN (SELECT program_id FROM enumerator_programs WHERE user_id = '".addslashes($user_id)."')
                               order by users.id desc");
    return $query->result();
  }


}