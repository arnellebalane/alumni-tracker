<?php

  class Statistics extends CI_Controller {

    public function __construct() {
      parent::__construct();          
      $this->load->model("enumerator_model", "enumerator");
      if (!$this->session->userdata('user_id')) {
        redirect('/session/index');
      }
      if ($this->session->userdata('user_type') == "alumni") {
        redirect('/session/index');
      } else if ($this->session->userdata('user_type') == "moderator") {   
        $stat = $this->enumerator->getEnumeratorStatistics($this->session->userdata('user_id'));                
        if (!$stat || $stat[0]->statistics == 0) {
          $this->session->set_flashdata("alert", "You are not allowed to view the statistical data!");
          redirect('/enumerator/index');
        }
      }
      $this->load->model("values_model", "values");
      $this->load->model("alumni_model", "alumni");
      $this->load->model("statistics_model", "stat");
    }

    public function index() {
      $this->load->view('statistics/index');
    }

    public function gender() {
      $genders = null;
      if ($this->session->userdata('user_type') == "super admin") {
        $genders = $this->stat->gender();
      } else {
        $genders = $this->stat->genderEnumerator($this->session->userdata('user_id'));
      }
      $total = $genders[0]->males + $genders[0]->females;
      $data = array('genders'=>$genders,
                    'total'=>$total);
      $this->load->view('statistics/gender', $data);
    }

    public function country() {
      $countries = null;
      if ($this->session->userdata('user_type') == "super admin") {
        $countries = $this->stat->countries();
      } else {
        $countries = $this->stat->countriesEnumerator($this->session->userdata('user_id'));
      }
      $total = 0;
      $males = 0;
      $females = 0;
      foreach ($countries as $country) {
        $total += $country->count;
        $males += $country->males;
        $females += $country->females;
      }
      $data = array('countries'=>$countries,
                    'total'=>$total,
                    'males'=>$males,
                    'females'=>$females);
      $this->load->view('statistics/country', $data);
    }

    public function employer_type() {
      $programs = null;
      if ($this->session->userdata('user_type') == "super admin") {
        $programs = $this->values->getPrograms();
      } else {
        $programs = $this->enumerator->getEnumeratorPrograms($this->session->userdata('user_id'));
      }
      $data = array();
      foreach ($programs as $prog) {
        $types = $this->stat->businessType($prog->id);
        $data['programs'][$prog->name] = $types;
        $totalCur = 0;
        $totalFir = 0;
        foreach ($types as $type) {
          $totalCur += $type->curJobCount;
          $totalFir += $type->firstJobCount;
        }
        $data['total'][$prog->name]['first'] = $totalFir;
        $data['total'][$prog->name]['current'] = $totalCur;
      }
      $this->load->view('statistics/employer_type', $data);
    }

    public function salary() {
      $programs = null;
      if ($this->session->userdata('user_type') == "super admin") {
        $programs = $this->values->getPrograms();
      } else {
        $programs = $this->enumerator->getEnumeratorPrograms($this->session->userdata('user_id'));
      }
      $data = array();
      foreach ($programs as $prog) {
        $salary = $this->stat->monthlySalary($prog->id);
        $data['programs'][$prog->name] = $salary;
        $totalCur = 0;
        $totalFir = 0;
        foreach ($salary as $salary) {
          $totalCur += $salary->curJobCount;
          $totalFir += $salary->firstJobCount;
        }
        $data['total'][$prog->name]['first'] = $totalFir;
        $data['total'][$prog->name]['current'] = $totalCur;
      }
      $this->load->view('statistics/salary', $data);
    }

    public function job_title() {
      $programs = null;
      if ($this->session->userdata('user_type') == "super admin") {
        $programs = $this->values->getPrograms();
      } else {
        $programs = $this->enumerator->getEnumeratorPrograms($this->session->userdata('user_id'));
      }
      $data = array();      
      foreach ($programs as $prog) {
        $first = $this->stat->jobTitleFirstJob($prog->id);
        $first_total = 0;
        foreach ($first as $job) {
          $first_total += $job->count;
        }
        $data['programs'][$prog->name]['first_job'] = $first;
        $data['programs'][$prog->name]['first_total'] = $first_total;
        $current = $this->stat->jobTitleCurrentJob($prog->id);
        $current_total = 0;
        foreach($current as $cur_job) {
          $current_total += $cur_job->count;
        }
        $data['programs'][$prog->name]['current_job'] = $current;
        $data['programs'][$prog->name]['current_total'] = $current_total;
      }
      $this->load->view('statistics/job_title', $data);
    }

    public function degree_program() {
      $programs = null;
      if ($this->session->userdata('user_type') == "super admin") {
        $programs = $this->stat->programs();
      } else {
        $programs = $this->stat->programsEnumerator($this->session->userdata('user_id'));
      }
      $total = 0;
      foreach ($programs as $prog) {
        $total += $prog->count;
      }
      $data = array('programs'=>$programs,
                    'total'=>$total);
      $this->load->view('statistics/degree_program',$data);
    }

    public function honor_received() {
      $honors = null;
      if ($this->session->userdata('user_type') == "super admin") {
        $honors = $this->stat->honorsReceived();
      } else {
        $honors = $this->stat->honorsReceivedEnumerator($this->session->userdata('user_id'));
      }
      $total = $honors[0]->suma + $honors[0]->magna + $honors[0]->cum + $honors[0]->none;
      $data = array('honors'=>$honors, 'total'=>$total);
      $this->load->view('statistics/honor_received', $data);
    }

    public function self_employed() {
      $employment = null;
      if ($this->session->userdata('user_type') == "super admin") {
        $employment = $this->stat->selfEmployed();
      } else {
        $employment = $this->stat->selfEmployedEnumerator($this->session->userdata('user_id'));
      }
      $data = array("employment" => $employment);
      $this->load->view('statistics/self_employed', $data);
    }

    public function employment_gap() {
      $programs = null;
      if ($this->session->userdata('user_type') == "super admin") {
        $programs = $this->values->getPrograms();
      } else {
        $programs = $this->enumerator->getEnumeratorPrograms($this->session->userdata('user_id'));
      }
      $data = array();
      $data['programs'] = null;
      foreach ($programs as $prog) {
        $first = $this->stat->employmentGap($prog->id);
        $data['total'][$prog->name] = 0;
        foreach ($first as $job) {
          $dif = 0;
          $month_grad = 0;
          $year_grad = 0;          
          if ($job->semester_graduated == 1) {
            $month_grad = 9;
            $year_grad = substr($job->year_graduated, 0, 4);            
          } else if ($job->semester_graduated == 2) {
            $month_grad = 4;
            $year_grad = substr($job->year_graduated, 5);
          } else {
            $year_grad = substr($job->year_graduated, 5);
            $month_grad = 5;
          }
          $gap = (($job->year_started - $year_grad) * 12) + ($job->month_started - $month_grad);
          $gap += ($gap > 0) ? -1 : 0;
          if (isset($data['programs'][$prog->name][$gap])) {
            $data['programs'][$prog->name][$gap]++;
          } else {
            $data['programs'][$prog->name][$gap] = 1;
          }
          ksort($data['programs'][$prog->name]);          
          $data['total'][$prog->name]++;
        }
      }

      $this->load->view('statistics/employment_gap', $data);
    }

    public function job_satisfaction() {
      $programs = null;
      if ($this->session->userdata('user_type') == "super admin") {
        $programs = $this->values->getPrograms();
      } else {        
        $programs = $this->enumerator->getEnumeratorPrograms($this->session->userdata('user_id'));
      }
      $data = array();
      $data['programs'] = null;
      foreach ($programs as $prog) {
        $totalFirst = 0;
        $totalCur = 0;
        $jobsF = $this->stat->jobSatisfactionFirstJob($prog->id);
        foreach ($jobsF as $job) {
          $data['programs'][$prog->name]['first'][$job->job_satisfaction] = $job->count;
          $totalFirst += $job->count;
        }
        $data['total'][$prog->name]['first'] = $totalFirst;
        $jobsC = $this->stat->jobSatisfactionCurrentJob($prog->id);
        foreach ($jobsC as $job) {
          $data['programs'][$prog->name]['current'][$job->job_satisfaction] = $job->count;
          $totalCur += $job->count;
        }
        $data['total'][$prog->name]['current'] = $totalCur;
      }

      $this->load->view('statistics/job_satisfaction', $data);
    }

    public function course_suggestions() {
      $programs = null;
      if ($this->session->userdata('user_type') == "super admin") {
        $programs = $this->values->getPrograms();
      } else {
        $programs = $this->enumerator->getEnumeratorPrograms($this->session->userdata('user_id'));
      }
      $data = array();
      foreach ($programs as $prog) {
        $topics = $this->stat->suggestions($prog->id);
        $data['total'][$prog->name] = 0;
        foreach ($topics as $topic) {
          $data['programs'][$prog->name][$topic->name] = $topic->count;
          $data['total'][$prog->name] += $topic->count;
        }
      }
      $this->load->view('statistics/course_suggestions', $data);
    }

    public function generate_pdf() {
      $this->load->add_package_path(APPPATH . 'libraries/mpdf');
      $this->load->library('mpdf');
      $pdf = new mPDF();
      $pdf->WriteHTML($_POST['html']);
      $pdf->Output(uniqid() . '.pdf', 'D');
      $this->load->remove_package_path(APPPATH . 'libraries/mpdf');
      redirect($_SERVER['HTTP_REFERER']);
    }

  }

?>