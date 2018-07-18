<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Owner extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model('User_model');
		$this->load->model('Site_model');
		
	}
	public function home()
	{
		$data['title'] = 'OWNER | HOME';
		$data['css'] = array('Google-Style-Login','index');
		$data['js'] = array();
		$data['font'] = array();
		
		$data['detail'] = $this->Site_model->get();
		
		$this->load->view('template/header', $data);
		$this->load->view('template/hero');
		$this->load->model('Owner_model');
		$data['inbox_cnt'] = $this->Owner_model->get_inbox_count($this->session->user_id);
		
		$this->load->view('template/owner_nav', $data);
		$this->load->view('index');
		$this->load->view('template/footer', $data);
	}

	public function my_properties()
	{

		$this->User_model->forOwnerOnly();
		$data['title'] = 'LIST OF PROPERTIES';
		$data['css'] = array('land_mgt','Pretty-Registration-Form', 'modal', 'datatables');
		$data['js'] = array('mask', 'inbox', 'datatables');
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();

		$this->load->model('Owner_model');
		$data['inbox_cnt'] = $this->Owner_model->get_inbox_count($this->session->user_id);
		$this->session->mark_as_flash('message');
		$this->load->library('form_validation');
		
		if(!empty($this->input->post('email'))){
			$this->form_validation->set_rules('email', 'New E-mail address', 'trim|required|is_unique[tbl_owner.email]');
			if ($this->form_validation->run() == TRUE) {
				if($this->Owner_model->update_email($this->session->user_id, $this->input->post('email'))){
					$data['message'] = [
									'status'	=> 'success',
									'message'	=> 'Your e-mail address has been updated successfully! :)'
									];
					$this->User_model->activity_log('Changed e-mail address');
				}else{
					$data['message'] = [
									'status'	=> 'danger',
									'message'	=> 'Updating e-mail address unsuccessful. Try agan. :('
									];
				}
			} else {
				# code...
				$this->session->set_flashdata('message',
					['status'	=> 'danger',
					'message'	=> validation_errors()
					]);
			}
		}else if(!empty($this->input->post('new_pass')) && !empty($this->input->post('confirm_pass'))){
			$this->form_validation->set_rules('old_pass', 'Old Password', 'required');
			$this->form_validation->set_rules('new_pass', 'New Password', 'required|min_length[8]');
			$this->form_validation->set_rules('confirm_pass', 'Confirm Password', 'required|min_length[8]|matches[new_pass]');
			if ($this->form_validation->run() == TRUE) {
				if($this->Owner_model->check_old_pass($this->session->user_id, $this->input->post('old_pass'))){

					if($this->Owner_model->update_pass($this->session->user_id, $this->input->post('new_pass'))){
						$data['message'] = [
										'status'	=> 'success',
										'message'	=> 'Your password has been updated successfully! :)'
										];
						$this->User_model->activity_log('Changed Password');
					}else{
						$data['message'] = [
										'status'	=> 'danger',
										'message'	=> 'Updating password unsuccessful. Try again. :('
										];
					}
				}else{
					$data['message'] = [
										'status'	=> 'danger',
										'message'	=> 'Updating password unsuccessful. Old password isn\'t correct. :('
										];
				}
			} else {
				# code...
				$this->session->set_flashdata('message',
					['status'	=> 'danger',
					'message'	=> validation_errors()
					]);
			}	
		}if(!empty($this->input->post('contact'))){
			// str_replace('_', '', $this->input->post('contact'));
			
			$contact = str_replace('_', '', $this->input->post('contact'));
			$_POST['contact'] = $contact;
			// var_dump($contact);
			if(count($contact) < 11){
				$this->form_validation->set_rules('contact', 'New Contact #', 'min_length[11]');
			}else{
				$this->form_validation->set_rules('contact', 'New Contact #', 'required');
			}
			if ($this->form_validation->run() == TRUE) {
				
				if($this->Owner_model->update_contact($this->session->user_id, $this->input->post('contact'))){
					$this->Owner_model->saveOldContact($this->session->user_id, $this->input->post('old_contact'));
					$data['message'] = [
									'status'	=> 'success',
									'message'	=> 'Your contact number has been updated successfully! :)'
									];
					$this->User_model->activity_log('Changed Contact Number');
				}else{
					$data['message'] = [
									'status'	=> 'danger',
									'message'	=> 'Updating contact number unsuccessful. Try again. :('
									];
				}
				
			} else {
				# code...
				$this->session->set_flashdata('message',
					['status'	=> 'danger',
					'message'	=> validation_errors()
					]);
			}
		}else if(isset($_POST['sub']) || isset($_POST['sub1']) || isset($_POST['sub2'])){
			$data['message'] = [
									'status'	=> 'danger',
									'message'	=> 'Please do not leave any field empty.'
									];
		}
		

		$data['validation'] = $this->session->flashdata('message');
		$data['properties'] = $this->Owner_model->get_properties($this->session->user_id);
		$data['email'] = $this->Owner_model->getEmail($this->session->user_id);
		$data['contact'] = $this->Owner_model->getContactNumber($this->session->user_id);
		$this->load->model('Treasurer_model');
		$data['discount_percent'] = $this->Treasurer_model->getDiscount();
		// print_r($properties);
		$this->load->view('template/header', $data);
		$this->load->view('template/owner_nav');
		$this->load->view('owner/properties', $data);
		$this->load->view('template/footer', $data);
	}

	public function my_payments()
	{
		$this->User_model->forOwnerOnly();
		$data['title'] = 'MY PAYMENTS';
		$data['css'] = array('land_mgt','Pretty-Registration-Form');
		$data['js'] = array();
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		
		$this->load->model('Owner_model');
		$data['inbox_cnt'] = $this->Owner_model->get_inbox_count($this->session->user_id);
		$data['payments'] = $this->Owner_model->get_payments($this->session->user_id);
		
		$this->load->view('template/header', $data);
		$this->load->view('template/owner_nav');
		$this->load->view('owner/payments', $data);
		$this->load->view('template/footer', $data);
	}

	public function c_f()
	{
		$this->User_model->forOwnerOnly();
		$data['title'] = 'COMMENTS';
		$data['css'] = array('land_mgt','Pretty-Registration-Form', 'modal');
		$data['js'] = array();
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		
		$this->load->model('Owner_model');
		$data['inbox_cnt'] = $this->Owner_model->get_inbox_count($this->session->user_id);
		$this->session->mark_as_flash('message');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('subject', 'SUBJECT', 'required');
		$this->form_validation->set_rules('feedback', 'FEEDBACK', 'required|min_length[15]');
		if ($this->form_validation->run() == TRUE) {
			$feedback = [
				'owner_id'	=> $this->session->user_id,
				'subject'	=> $this->input->post('subject'),
				'f_c'	=> $this->input->post('feedback')
			];
			if($this->Owner_model->feedback($feedback)){
				$data['message'] = [
								'status'	=> 'success',
								'message'	=> 'Your feedback has been submitted successfully! :)'
								];
			}else{
				$data['message'] = [
								'status'	=> 'danger',
								'message'	=> 'Submitting feedback unsuccessful. Try again. :('
								];
			}
		} else {
			# code...
			$this->session->set_flashdata('message',
				['status'	=> 'danger',
				'message'	=> validation_errors()
				]);
		}

		$data['validation'] = $this->session->flashdata('message');
		
		$this->load->view('template/header', $data);
		$this->load->view('template/owner_nav');
		$this->load->view('owner/comment', $data);
		$this->load->view('template/footer', $data);	
	}

	public function inbox()
	{
		$this->User_model->forOwnerOnly();
		$data['title'] = 'My Inbox';
		$data['css'] = array('land_mgt','Pretty-Registration-Form', 'inbox');
		$data['js'] = array('inbox');
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		$this->load->model('Owner_model');
		

		if(!empty($this->input->post('message_id'))){
			$delete = $this->input->post('message_id');
			if($this->Owner_model->delete_message($delete)){
				$data['message'] = [
								'status'	=> 'success',
								'message'	=> 'Selected message has been successfully deleted! :)'
								];
			}else{
				$data['message'] = [
								'status'	=> 'danger',
								'message'	=> 'Sorry, message was not deleted. :('
								];
			}
		}
		$data['inbox'] = $this->Owner_model->get_inbox($this->session->user_id);
		$data['inbox_cnt'] = $this->Owner_model->get_inbox_count($this->session->user_id);
		$data['message_cnt'] = $this->Owner_model->get_message_count($this->session->user_id);

		$this->load->view('template/header', $data);
		$this->load->view('template/owner_nav');
		$this->load->view('owner/inbox', $data);
		$this->load->view('template/footer', $data);	
	}

	public function status_read()
	{
		$this->load->model('Owner_model');
		$message_id = $this->input->get('id');
		$this->Owner_model->status_read($message_id);
	}

	public function get_data_field()
	{
		$this->load->model('Owner_model');
		$m_id = $this->input->get('id');
		$field = $this->input->get('field');

		$res = $this->Owner_model->get_data_field($m_id, $field);

		echo $res->$field;
	}

	public function searchOwner()
	{
		$squery = $this->input->get('name');
		$this->load->model('Owner_model');
		$data['search_results'] = $this->Owner_model->search($squery);

		$this->load->view('additionals/search_owner', $data);
	}

	public function security_question($value='')
	{
		$this->User_model->forOwnerOnly();
		$data['title'] = 'My Security Questions';
		$data['css'] = array('land_mgt','Pretty-Registration-Form', 'inbox');
		$data['js'] = array('owner');
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		$this->load->model('Owner_model');

		if(!empty($this->input->post('answer')) && $this->input->post('action') == 'add'){
			$q_a = [
				'user_id' 	=> $this->session->user_id,
				'q_id'		=> $this->input->post('q_id'),
				'answer'	=> $this->input->post('answer')
			];
			if($this->Site_model->add_myQuestion($q_a)){
				$this->User_model->activity_log('Added security question');
				$data['message'] = [
								'status'	=> 'success',
								'message'	=> 'New security question have been added :)'
								];
			}else{
				$data['message'] = [
								'status'	=> 'danger',
								'message'	=> 'Sorry, security question not save, pls try again. :('
								];
			}
		}else if(!empty($this->input->post('answer_update')) && $this->input->post('action') == 'update'){
			$update = [
				'answer'	=> $this->input->post('answer_update')
			];
			if($this->Site_model->update_myQuestion($this->input->post('q_id'), $update)){
				$this->User_model->activity_log('Updated answer for a security question');
				$data['message'] = [
								'status'	=> 'success',
								'message'	=> 'Security question updated :)'
								];
			}else{
				$data['message'] = [
								'status'	=> 'danger',
								'message'	=> 'Sorry, updating unsuccessful, pls try again. :('
								];
			}
		}
		$data['my_questions'] = $this->Site_model->get_mySecurityQuestions($this->session->user_id);
		$data['inbox_cnt'] = $this->Owner_model->get_inbox_count($this->session->user_id);
		$data['questions'] = $this->Site_model->getSecurityQuestions($this->session->user_id);
		$data['count_qs'] = $this->Site_model->getCountQs($this->session->user_id);

		$this->load->view('template/header', $data);
		$this->load->view('template/owner_nav');
		$this->load->view('owner/questions', $data);
		$this->load->view('template/footer', $data);
	}
}