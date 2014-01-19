<?php

  class Enumerator extends CI_Controller {

    public function __construct() {
      parent::__construct();
    }

    public function index() {
      $this->load->view('enumerator/index');
    }

    public function cleaning_disabled() {
      $this->load->view('enumerator/cleaning_disabled');
    }

    public function clean() {
      $this->load->view('enumerator/clean');
    }

    public function settings() {
      $this->load->view('enumerator/settings');
    }

  }

?>