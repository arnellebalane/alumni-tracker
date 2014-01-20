<?php

  class Mailer extends CI_Controller {

    public function __construct() {
      parent::__construct();

      $config['protocol'] = 'smtp';
      $config['smtp_host'] = 'ssl://gator4052.hostgator.com';
      $config['smtp_port'] = 465;
      $config['smtp_user'] = 'alumnitracker@wefoundyou.org';
      $config['smtp_pass'] = '@alumnitracker123';
      $config['mailtype'] = 'text';
      $this->load->library('email', $config);
    }

    public function test($type = 'alumni', $email = 'arnellebalane@gmail.com') {
      $message = $this->load->view('welcome_' . $type . '.php', array(), true);
      $this->email->from('alumnitracker@wefoundyou.org', 'Alumni Tracker');
      $this->email->to(urldecode($email));
      $this->email->subject('Test Email');
      $this->email->message($message);
      if ($this->email->send()) {
        echo '<pre>MESSAGE SENT</pre>';
      } else {
        echo '<pre>MESSAGE SENDING FAILED</pre>';
      }
    }

  }

?>