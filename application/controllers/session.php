<?php

	class Session extends CI_Controller {

		public function __construct() {
			parent::__construct();
			$this->load->model("user_model", "model");
		}

		public function index() {			
			if ($this->session->userdata('user_id')) {
				if ($this->session->userdata('user_type') == 'alumni') {
					redirect('/alumni/home');
				}	else if ($this->session->userdata('user_type') == 'super admin') {
					redirect('/admin/index');
				}	else {
					redirect('/enumerator/index');
				}
			}	else {
				$this->load->helper('questionnaire_helper');
				$this->load->view('login');
			}

		}

		public function login() {
			$user_data = $this->model->getUserByUsernamePassword(addslashes($_POST['username']), addslashes($_POST['password']));
			if ($user_data) {
				$this->session->set_userdata('user_id', $user_data[0]->id);
				$this->session->set_userdata('user_type', $user_data[0]->user_type);
				$this->load->model("alumni_model");
				$info = $this->alumni_model->getUserInfoById($user_data[0]->id);
				if ($info) {
					$this->session->set_flashdata("notice", "Welcome, " . $info[0]->firstname . " " . $info[0]->lastname);
				}	else {
					$this->session->set_flashdata("notice", "Welcome");
				}
				if ($user_data[0]->user_type == "super admin") {
					redirect('/admin/index');
				}	else if ($user_data[0]->user_type == "moderator") {
					$enumerator_info = $this->alumni_model->getEnumeratorInfoById($user_data[0]->id);
					$this->session->set_flashdata("notice", "Welcome, " . $enumerator_info[0]->firstname);
					redirect('/enumerator/index');
				}
				redirect('/alumni/home');
			}	else {
				$this->session->set_flashdata('alert', 'Incorrect username or password.');
				$this->session->set_flashdata('inputs', $_POST);
				redirect('/session/index');
			}
		}

		public function logout() {
      $this->session->sess_destroy();
      redirect('/session/index');
    }

    public function retrieve_password() {
      $this->load->view('password_retrieval');
    }

    public function retrieveAccount() {    	
    	$email = trim($_POST['email']);

    	if (strlen($email) <= 0) {
    		$this->session->set_flashdata("alert", "Email should not be blank!");    		
    	}	else {
    		$userInfo = $this->model->getUserByEmail($email);
    		if ($userInfo) {
          foreach($userInfo as $u) {
      			if ($this->mailer($u->id, $u->user_type)) {
      				$this->session->set_flashdata("notice", "Your account information has been sent to your email!");
      			}	else {
      				$this->session->set_flashdata("alert", "Sorry! We were NOT able to send the email. Please try again later!");
      			}
          }
    		}	else {
    			$this->session->set_flashdata("alert", "Wrong email address!");		
    		}    		
    	}
    	redirect('session/retrieve_password');
    }

    private function mailer($user_id, $type) {
    	$this->load->model("alumni_model", "alumni");
      $config['protocol'] = 'smtp';
      $config['smtp_host'] = 'ssl://gator4052.hostgator.com';
      $config['smtp_port'] = 465;
      $config['smtp_user'] = 'alumnitracker@wefoundyou.org';
      $config['smtp_pass'] = '@alumnitracker123';
      $config['mailtype'] = 'html';
      $this->load->library('email', $config);
      $account_info = $this->alumni->getUserById($user_id);
      $personal_info = null;
      if ($type == "enumerator") {
        $personal_info = $this->alumni->getEnumeratorInfoById($user_id);
      } else {
        $personal_info = $this->alumni->getPersonalInfoById($user_id);
      }
      $programs = null;
      if ($type == 'enumerator') {
        $this->load->model('enumerator_model');
        $programs = $this->enumerator_model->getEnumeratorPrograms($user_id);
      }
      $data = array('account_info'=>$account_info, 
                    'personal_info'=>$personal_info,
                    'programs'=>$programs);     
      $message = $this->load->view('mailer/welcome_'.$type.'.php', $data, true);
      $this->email->from('alumnitracker@wefoundyou.org', 'Alumni Tracker');
      $this->email->to(urldecode($personal_info[0]->email));
      $this->email->subject('Welcome ' . (($type == "enumerator") ? "Enumerator" : "Alumni"));
      $this->email->message($message);
      if ($this->email->send()) {        
        // echo '<pre>MESSAGE SENT</pre>';
        return true;
      } else {        
        // echo '<pre>MESSAGE SENDING FAILED</pre>';
        return false;
      }
    }		
	}

?>