<?php

  class Statistics extends CI_Controller {

    public function __construct() {
      parent::__construct();
    }

    public function index() {
      $this->load->view('statistics/index');
    }

    public function gender() {
      $this->load->view('statistics/gender');
    }

    public function country() {
      $this->load->view('statistics/country');
    }

    public function employer_type() {
      $this->load->view('statistics/employer_type');
    }

    public function salary() {
      $this->load->view('statistics/salary');
    }

    public function job_title() {
      $this->load->view('statistics/job_title');
    }

    public function degree_program() {
      $this->load->view('statistics/degree_program');
    }

    public function honor_received() {
      $this->load->view('statistics/honor_received');
    }

    public function self_employed() {
      $this->load->view('statistics/self_employed');
    }

  }

?>