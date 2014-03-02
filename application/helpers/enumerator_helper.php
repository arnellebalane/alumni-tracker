<?php 
      
  function getPrograms($id) {
    $CI =& get_instance();
    $CI->load->model('enumerator_model');
    return $CI->enumerator_model->getEnumeratorPrograms($id);
  }

  function getStatistics($id) {
    $CI =& get_instance();
    $CI->load->model('enumerator_model');
    return $CI->enumerator_model->getEnumeratorStatistics($id); 
  }

  function isEnumeratorProgram($id, $programs) {
    foreach ($programs as $prog) {
      if ($prog->id == $id) {
        return "checked";
      }
    }
    return "unselected";
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