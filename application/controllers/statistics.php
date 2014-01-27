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
      $genders = $this->stat->gender();
      $total = $genders[0]->males + $genders[0]->females;
      $data = array('genders'=>$genders,
                    'total'=>$total);
      $this->load->view('statistics/gender', $data);
    }

    public function country() {
      $countries = $this->stat->countries();
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
      $programs = $this->values->getPrograms();
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
      $programs = $this->values->getPrograms();
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
      $this->load->view('statistics/job_title');
    }

    public function degree_program() {
      $programs = $this->stat->programs();
      $total = 0;
      foreach ($programs as $prog) {
        $total += $prog->count;
      }
      $data = array('programs'=>$programs,
                    'total'=>$total);
      $this->load->view('statistics/degree_program',$data);
    }

    public function honor_received() {
      $honors = $this->stat->honorsReceived();
      $total = $honors[0]->suma + $honors[0]->magna + $honors[0]->cum + $honors[0]->none;
      $data = array('honors'=>$honors, 'total'=>$total);
      $this->load->view('statistics/honor_received', $data);
    }

    public function self_employed() {
      $data = array("employment" => $this->stat->selfEmployed());
      $this->load->view('statistics/self_employed', $data);
    }

    public function employment_gap() {
      $this->load->view('statistics/employment_gap');
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