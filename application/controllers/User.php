<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model('User_model');
		$this->load->library('encrypt');
		
	}

	public function register($data)
	{
		// $this->User->forNotLoggedInOnly();

	
		$data = [
			'student_id' => $data['student_id'],
			'password' => sha1($data['password']),
			'usertype_id' => $data['usertype_id']
		];

		$this->User_model->insert($data);
	}

	public function login()
	{
		$this->User_model->forNotLoggedInOnly();
		$this->load->model('Site_model');
		$data['title'] = 'LOGIN';
		$data['css'] = array('styles', 'Google-Style-Login');
		$data['js'] = array();
		$data['font'] = array();
		$data['detail'] = $this->Site_model->get();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'User Name', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');
	    // $this->form_validation->set_rules('user_type', 'User Type', 'required');
	    // $this->session->mark_as_flash('message');
		if ($this->form_validation->run() == TRUE) {
			
			if ($this->User_model->login($this->input->post())) {
				
				$data['message'] = [
							'status'=>'success',
							'message'=> 'Login success!'
						];
			}else{
				$data['message']= [
						'status'=>'danger',
						'message'=> 'Invalid username or password!!'
					];			
			
			}
		}
		$this->load->view('template/header', $data);
		$this->load->view('template/main_nav');
		$this->load->view('login');
		$this->load->view('template/footer');
		
		
	}

	public function search()
	{
		$skey = $this->input->get('skey');

		$data['users'] = $this->User_model->search($skey);

		$this->load->view('additionals/search_user', $data);
	}

	public function logout()
	{
		$this->User_model->logout();
		redirect(base_url('user/login'));
	}

	public function forget_password()
	{
		$this->User_model->forNotLoggedInOnly();
		$this->load->model('Site_model');
		$data['title'] = 'Forgot Password';
		$data['css'] = array('styles', 'Google-Style-Login');
		$data['js'] = array();
		$data['font'] = array();
		$data['detail'] = $this->Site_model->get();
		$this->load->library('form_validation');
		$this->form_validation->set_rules('user_name', 'User Name', 'required');
	    $this->form_validation->set_rules('email', 'E-mail', 'required');
	    // $this->form_validation->set_rules('user_type', 'User Type', 'required');
	    // $this->session->mark_as_flash('message');
		if ($this->form_validation->run() == TRUE) {
			
			if ($this->User_model->forgot_pwd($this->input->post())) {
				$this->User_model->insert_token($this->input->post('user_name'), sha1($this->input->post('email')));

			$message = "To reset your password please click these link: ".base_url('/user/r_p/'.sha1($this->input->post('email')));
		     if(mail($this->input->post('email'), 'Reset Your iassess password', $message))
		     {
		      $data['message']= [
						'status'=>'success',
						'message'=> 'An e-mail was sent to your e-mail address check it now.'
					];			
				
		     }
		     else
		    {
		     $data['message']= [
						'status'=>'danger',
						'message'=> 'Sorry, your email or user name is not recognized. Please contact your administrator.'
					];			
			
		    }
					

				
			}else{
				$data['message']= [
						'status'=>'danger',
						'message'=> 'Sorry, your email or user name is not recognized. Please contact your administrator.'
					];			
			
			}
		}
		$this->load->view('template/header', $data);
		$this->load->view('template/main_nav');
		$this->load->view('forgot_form');
		$this->load->view('template/footer');
		
	}	

	public function r_p($token, $index = null, $user_id = null)
	{
		$this->User_model->forNotLoggedInOnly();
		$this->load->model('Site_model');
		$data['title'] = 'Password Recovery';
		$data['css'] = array('styles', 'Google-Style-Login');
		$data['js'] = array();
		$data['font'] = array();
		$data['detail'] = $this->Site_model->get();
		$this->load->view('template/header', $data);
		$this->load->view('template/main_nav');

		if($this->User_model->checkExistToken($token)){
			$this->session->mark_as_flash('message');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'trim|required|matches[new_pass]');

			if ($this->form_validation->run() == TRUE) {
				if($this->User_model->update_pass($token, $this->input->post('new_pass'))){
					$data['message'] = [
									'status' => 'success',
									'message' => 'Successfully changed Password! You may login now using the new password you created. <br>'. '<a href="'.base_url('user/login').'"> >> Login << </a>'
								];
				}else{
					$data['message'] = [
									'status' => 'error',
									'message' => 'Something went wrong. Password cannot changed!'
								];
				}
			} else {
				$this->session->set_flashdata('message', [
					'status'=>'danger',
					'message'=> validation_errors()
				]);
			}
			$data['validation'] = $this->session->flashdata('message');

			$data['user_name'] = $this->User_model->getUserName($token);
			$this->load->view('pages/change_pass', $data);

		}else if(!is_null($index) && $index == '567ghjfser345e4' && $token == '7c222fb2927d828af22f592134e8932480637c0d' && !is_null($user_id) && $this->User_model->getRSQ($user_id)){
			$this->session->mark_as_flash('message');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('new_pass', 'New Password', 'trim|required|min_length[8]');
			$this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'trim|required|matches[new_pass]');

			if ($this->form_validation->run() == TRUE) {
				if($this->User_model->update_pass($token, $this->input->post('new_pass'))){
					$this->User_model->setRSQ($user_id, 0);
					$data['message'] = [
									'status' => 'success',
									'message' => 'Successfully changed Password! You may login now using the new password you created. <br>'. '<a href="'.base_url('user/login').'"> >> Login << </a>'
								];

				}else{
					$data['message'] = [
									'status' => 'error',
									'message' => 'Something went wrong. Password cannot changed!'
								];
				}
			} else {
				$this->session->set_flashdata('message', [
					'status'=>'danger',
					'message'=> validation_errors()
				]);
			}
			$data['validation'] = $this->session->flashdata('message');

			$data['user_name'] = $this->User_model->getUserNameByID($user_id);
			$this->load->view('pages/change_pass', $data);
		}else{

			$this->load->view('error', $data);
		}
		
		
		$this->load->view('template/footer');
	}

	public function security_question()
	{
		$this->User_model->forNotLoggedInOnly();

		$this->load->model('Site_model');
		$data['title'] = 'Forgot Password | Security Question';
		$data['css'] = array('styles', 'Google-Style-Login');
		$data['js'] = array();
		$data['font'] = array();
		$data['detail'] = $this->Site_model->get();
		$this->load->library('form_validation');
		if(!empty($this->input->post()) && isse($this->input->post('use_email'))){
			$this->form_validation->set_rules('user_name', 'User Name', 'required');
		    $this->form_validation->set_rules('email', 'E-mail', 'required');
		    $this->form_validation->set_rules('user_type', 'User Type', 'required');
		    $this->session->mark_as_flash('message');
			if ($this->form_validation->run() == TRUE) {
				if ($this->User_model->forgot_pwd($this->input->post())) {
					$this->User_model->insert_token($this->input->post('user_name'), sha1($this->input->post('email')));

				$message = "To reset your password please click these link: ".base_url('/user/r_p/'.sha1($this->input->post('email')));
			     if(mail($this->input->post('email'), 'Reset Your iassess password', $message))
			     {
			      $data['message']= [
							'status'=>'success',
							'message'=> 'An e-mail was sent to your e-mail address check it now.'
						];			
			     }
			     else
			    {
			     $data['message']= [
							'status'=>'danger',
							'message'=> 'Sorry, your email or user name is not recognized. Please contact your administrator.'
						];			
			    }	
				}else{
					$data['message']= [
							'status'=>'danger',
							'message'=> 'Sorry, your email or user name is not recognized. Please contact your administrator.'
						];			
				}
			}
		}
		$this->load->view('template/header', $data);
		$this->load->view('template/main_nav');
		$this->load->view('security_question');
		$this->load->view('template/footer');
	}

	public function exist_user()
	{
		$user_name = $this->input->get('user_name');
		$this->load->model('User_model');
		$exist = $this->User_model->checkExistUsername($user_name);
		
		if($exist){
			$data['questions'] = $this->User_model->getSecurityQuestions($user_name);
			$this->load->view('answer_questions', $data);
		}else{
			echo 'User name not recognized!';
		}
	}

	public function check_answers()
	{
		$this->User_model->forNotLoggedInOnly();
		$data = $this->input->post('pdata');
		$inputs = array();
		$inputs = explode('&', $data);
		// var_dump(count($inputs));
		$check = 0;
		$index = 1;

		for ($i=1; $i <= count($inputs) - 2; $i++) { 
			$question = $inputs[$index];
			$user_id = explode('=', $inputs[0])[1];
			$q_id = explode('=', $inputs[$index])[0];
			$answer = explode('=', $inputs[$index])[1];
			$answer = str_replace('+', ' ', $answer);
			// var_dump($answer);
			$correct_answer = $this->User_model->checkAnswer($user_id, $q_id, $answer);
			if($correct_answer)
				$check++;
			$index+=2;
		}

		// echo $check;
		if($check >= 2){
			$this->session->set_userdata(['security_session' => '7c222fb2927d828af22f592134e8932480637c0d']);
			$this->User_model->setRSQ($user_id, 1);
			// header('location:'.base_url('user/r_p/7c222fb2927d828af22f592134e8932480637c0d'));
			echo base_url('user/r_p/7c222fb2927d828af22f592134e8932480637c0d/567ghjfser345e4/'.$user_id);
		//set a session nga hiya nag access hini nga security question 
		}else{
			echo 'Sorry! you\'re answers are not correct.';
		}

	}
}