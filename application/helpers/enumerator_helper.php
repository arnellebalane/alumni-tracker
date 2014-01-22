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
?>