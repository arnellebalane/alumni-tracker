<?php

  class Enumerator extends CI_Controller {

    public function __construct() {
      parent::__construct();
      if ($this->session->userdata('user_type') != "moderator") {
        redirect('/session/index');
      }
      $this->load->model("values_model", "values");
      $this->load->model("alumni_model", "alumni");
      $this->load->model("enumerator_model", "model");      
    }

    public function index() {
      $user_id = $this->session->userdata('user_id');
      if ($this->session->userdata('cleaned') == 0 || ($this->session->userdata('cleaned') == 1) || ($this->session->userdata('cleaned') == -1)) {
        $prev_cleaned = $this->session->userdata('cleaned');
      } else {
        $prev_cleaned = 1;
      }
      if ($this->session->userdata('program_id') > 0 || $this->session->userdata('program_id') == -1) {
        $prev_program_id = $this->session->userdata('program_id');
      } else {
        $prev_program_id = 0;
      } 
      if (($this->session->userdata('included') == 0) || ($this->session->userdata('included') == 1) || ($this->session->userdata('included') == -1)) {
        $prev_included = $this->session->userdata('included');
      } else {
        $prev_included = 1;
      }            
      $cleaned = isset($_GET['cleaned']) ? $_GET['cleaned'] : $prev_cleaned;
      $program_id = isset($_GET['program_id']) ? $_GET['program_id'] : $prev_program_id;
      $included = isset($_GET['included']) ? $_GET['included'] : $prev_included;      
      $this->session->set_userdata('cleaned', $cleaned);
      $this->session->set_userdata('program_id', $program_id);
      $this->session->set_userdata('included', $included);
      if (($cleaned > 1 || $cleaned < 0) && $program_id <= 0 && ($included < 0)) {
        $alumni = $this->model->getAllAlumni($user_id);
      } else if (($cleaned <= 1 && $cleaned >= 0) && $program_id <= 0 && ($included < 0)) {
        $alumni = $this->model->getAlumniByCleanStatus($cleaned, $user_id);        
      } else if (($cleaned > 1 || $cleaned < 0) && $program_id > 0 && ($included < 0)) {
        $alumni = $this->model->getAlumniByProgram($program_id, $user_id);    
      } else if (($cleaned <= 1 && $cleaned >= 0) && $program_id > 0 && ($included < 0)){
        $alumni = $this->model->getAlumniByCleanStatusAndProgram($cleaned, $program_id, $user_id);        
      } else if (($cleaned > 1 || $cleaned < 0) && $program_id <= 0 && ($included >= 0)) {
        $alumni = $this->model->getAlumniByInclusion($included, $user_id);
      } else if (($cleaned <= 1 && $cleaned >= 0) && $program_id <= 0 && ($included >= 0)) {
        $alumni = $this->model->getAlumniByInclusionAndStatus($included, $cleaned, $user_id);
      } else if (($cleaned > 1 || $cleaned < 0) && $program_id > 0 && ($included >= 0)) {
        $alumni = $this->model->getAlumniByInclusionAndProgram($included, $program_id, $user_id);
      } else {
        $alumni = $this->alumni->getAlumniByInclusionAndStatusAndProgram($included, $cleaned, $program_id);
      }
      $data = array('alumni'=>$alumni,
                    'cleaned'=>$cleaned,
                    'program_id'=>$program_id,
                    'included'=>$included,
                    'programs'=>$this->model->getEnumeratorPrograms($user_id));
      $this->load->helper('edit_info_helper.php');
      $this->load->view('enumerator/index', $data);
    }

    public function cleaning_disabled() {
      $this->load->view('enumerator/cleaning_disabled');
    }

    public function clean($id) {
      $user_id = $this->session->userdata('user_id');
      if (!$this->model->isAlumniUnderEnumerator($user_id, $id)) {
        $this->session->set_flashdata("alert", "The alumni is not under you scope!");        
        redirect('enumerator/index');
      } else {
        $alumni = $this->alumni->getUserById($id);
        if (!$alumni || $alumni[0]->user_type != "alumni") {
          redirect('admin/alumni');
        }
        $this->load->model("values_model", "values");
        $data = array('countries'=>$this->values->getCountries(),
                      'programs'=>$this->values->getPrograms(),
                      'salaries'=>$this->values->getMonthlySalaries(),
                      'employer_types'=>$this->values->getEmployerTypes(),                    
                      'ge_courses'=>$this->values->getGECourses(),
                      'user_info'=> $this->alumni->getUserInfoById($id),
                      'user_social_networks'=>$this->alumni->getUserSocialNetworksById($id),
                      'social_networks'=>$this->alumni->getOtherSocialNetworksById($id),
                      'jobs'=>$this->alumni->getUserAllJobs($id),
                      'user_id'=>$id
                      );      
        $this->load->helper('edit_info_helper.php');
        $this->load->helper('inflector');      
        $this->load->view('enumerator/clean', $data);
      }
    }

    public function settings() {
      $this->load->view('enumerator/settings');
    }

    public function deleteAlumni($id) {
      $this->alumni->deleteAlumni($id);
      $this->session->set_flashdata("notice", "Alumni removed!");
      redirect('enumerator/index');
    }

    public function markAlumniClean($id) {
      $this->alumni->markAlumniClean($id);
      $this->session->set_flashdata("notice", "The alumni was marked CLEAN successfully!");      
      redirect('enumerator/index');
    } 

    public function markAlumniUnClean($id) {
      $this->alumni->markAlumniUnClean($id);
      $this->session->set_flashdata("notice", "The alumni was marked UNCLEAN successfully!");
      redirect('enumerator/index');
    }

  }

?>