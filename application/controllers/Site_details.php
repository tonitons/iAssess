<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Site_details extends CI_Controller {

	public function index()
	{
		$this->load->model('User_model');
		$this->load->model('Site_model');
		$this->User_model->forAdminOnly();
		$data['title'] = 'Site Details';
		$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal');
		$data['js'] = array();
		$data['font'] = array();
		$data['breadcrumbs'] = array('#' =>'Site Mgt.','site_details'=> 'Site Details');

		$config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']	= '2000';
        $config['max_width']  = '3000';
        $config['max_height']  = '3000';

        $this->session->flashdata('message');
        $this->load->library('upload', $config);
        $this->load->library('form_validation');
	    $this->form_validation->set_rules('municipality', 'Municipality', 'required');
	    $this->form_validation->set_rules('province', 'Province', 'required');
	    $this->form_validation->set_rules('vision', 'Vision', 'required');
	    $this->form_validation->set_rules('mission', 'Mission', 'required');
	    if(!empty($this->input->post('discount_amount'))){
	    	if($this->input->post('discount_amount') < 0)
	    		echo "<script>alert('Discount amount cannot be less than zero (0).')</script>";
	    	else{
	    		$this->load->model('Treasurer_model');
	    		if($this->Treasurer_model->updateDiscount($this->input->post('discount_amount'))){
	    			$data['message'] = [
											'status' => 'success',
											'message' => 'Discount percentage is now '.$this->input->post('discount_amount').'%. :)'
										];
				$this->User_model->activity_log('Updated Discount Percentage');
				}else{
					$data['message'] = [
											'status' => 'error',
											'message' => 'Error updating discount percentage, pls try again.'
										];
				}
	    	}
	    }else{
		    if($this->form_validation->run() == TRUE){
				if(!empty($this->input->post())){
					$file = $_FILES['logo']['name'];
			    	$site_detail = [
			    		'logo' 			=> $file,
			    		'municipality'	=> $this->input->post('municipality'),
			    		'province'		=> $this->input->post('province'),
			    		'contact'		=> $this->input->post('contact'),
			    		'email'			=> $this->input->post('email'),
			    		'vision'		=> $this->input->post('vision'),
			    		'mission'		=> $this->input->post('mission'),
			    		'description'	=> $this->input->post('description')
			    	];
			    	

	        		if ( ! $this->upload->do_upload('logo')){
	                        $data['message'] = array('status' => 'danger', 'message' => $this->upload->display_errors());
	                        // $this->load->view('upload_form', $error);
	                }else{
	                     
	                    if ($this->Site_model->insert($site_detail)) {
			
								$data['message'] = [
											'status' => 'success',
											'message' => 'Site details has been successfuly set. :)'
										];
								$this->User_model->activity_log('Updated Site Details');
						}else{
								$data['message'] = [
								'status' => 'error',
								'message' => 'Error Updating site details, Please try again. :('
								];
						}


	                }
					
				}
			}else{
				$this->session->set_flashdata('message', [
						'status'=>'danger',
						'message'=> validation_errors()
					]);
			}
		}
		$data['validation'] = $this->session->flashdata('message');

		$data['detail'] = $this->Site_model->get();
		$this->load->model('Treasurer_model');
		$data['discount_percent'] = $this->Treasurer_model->getDiscount();


		$this->load->view('template/header', $data);
		$this->load->view('template/admin_nav');
		// $this->load->view('template/breadcrumbs', $data);
		$this->load->view('admin/site', $data);
		$this->load->view('template/footer');

	}

	public function security_mgt()
	{
		$this->load->model('User_model');
		$this->load->model('Site_model');
		$this->User_model->forAdminOnly();
		$data['title'] = 'Secutiry Questions Management';
		$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal');
		$data['js'] = array('s_q');
		$data['font'] = array();
		$data['breadcrumbs'] = array('#' =>'Site Mgt.','security_mgt'=> 'Security Questions');

        $this->session->flashdata('message');
        $this->load->library('form_validation');
	    // $this->form_validation->set_rules('municipality', 'Municipality', 'required');
	    // $this->form_validation->set_rules('province', 'Province', 'required');
	    // $this->form_validation->set_rules('vision', 'Vision', 'required');
	    // $this->form_validation->set_rules('mission', 'Mission', 'required');
	    // if ($this->form_validation->run() == TRUE) {
	    	
	    	if(!empty($this->input->post('question'))){
	    		if($this->Site_model->add_securityQuestion($this->input->post('question'))){
	    			$data['message'] = [
											'status' => 'success',
											'message' => 'New question is now added!'
										];
				$this->User_model->activity_log('New Security question added: '. $this->input->post('question'));
				}else{
					$data['message'] = [
											'status' => 'error',
											'message' => 'Error adding new question, pls try again.'
										];
				}
	    	}else if(!empty($this->input->post('update_question'))){
	    		if($this->Site_model->update_securityQuestion($this->input->post('q_id'), $this->input->post('update_question'))){
	    			$data['message'] = [
											'status' => 'success',
											'message' => 'Question have been updated!'
										];
				$this->User_model->activity_log('Updated secuurity question now: '. $this->input->post('update_question'));
				}else{
					$data['message'] = [
											'status' => 'error',
											'message' => 'Error updating question, pls try again.'
										];
				}
	    	}
	 //    }else{
		// 		$this->session->set_flashdata('message', [
		// 				'status'=>'danger',
		// 				'message'=> validation_errors()
		// 			]);
		// }
		// $data['validation'] = $this->session->flashdata('message');

		$data['detail'] = $this->Site_model->get();
		$this->load->model('Treasurer_model');
		$data['questions'] = $this->Site_model->getSecurityQuestions();


		$this->load->view('template/header', $data);
		$this->load->view('template/admin_nav');
		$this->load->view('template/breadcrumbs', $data);
		$this->load->view('admin/s_q', $data);
		$this->load->view('template/footer');
	}

	public function signatories()
	{
		$this->load->model('User_model');
		$this->load->model('Site_model');
		$this->User_model->forAdminOnly();
		$data['title'] = 'Report Signatories Management';
		$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal');
		$data['js'] = array('s_q', 'signatory');
		$data['font'] = array();
		$data['breadcrumbs'] = array('#' =>'Site Mgt.','signatories'=> 'Reports Signatories');

        $this->session->flashdata('message');
        $this->load->library('form_validation');
	    // $this->form_validation->set_rules('municipality', 'Municipality', 'required');
	    // $this->form_validation->set_rules('province', 'Province', 'required');
	    // $this->form_validation->set_rules('vision', 'Vision', 'required');
	    // $this->form_validation->set_rules('mission', 'Mission', 'required');
	    // if ($this->form_validation->run() == TRUE) {
	    	
	    	if(!empty($this->input->post('staff_id'))){
	    		if($this->Site_model->updateTreasurerSignatory($this->input->post('sign_id') ,$this->input->post('staff_id'))){
	    			$data['message'] = [
											'status' => 'success',
											'message' => 'Signatory for Tax Reports have been updated!'
										];
				$this->User_model->activity_log('Change Signatory: ');
				}else{
					$data['message'] = [
											'status' => 'error',
											'message' => 'Error changing signatory report, pls try again.'
										];
				}
	    	}else if(!empty($this->input->post('staff_id2'))){
	    		if($this->Site_model->update_securityQuestion($this->input->post('q_id'), $this->input->post('update_question'))){
	    			$data['message'] = [
											'status' => 'success',
											'message' => 'Question have been updated!'
										];
				$this->User_model->activity_log('Updated secuurity question now: '. $this->input->post('update_question'));
				}else{
					$data['message'] = [
											'status' => 'error',
											'message' => 'Error updating question, pls try again.'
										];
				}
	    	}
	 //    }else{
		// 		$this->session->set_flashdata('message', [
		// 				'status'=>'danger',
		// 				'message'=> validation_errors()
		// 			]);
		// }
		// $data['validation'] = $this->session->flashdata('message');

		$data['detail'] = $this->Site_model->get();
		// $this->load->model('Treasurer_model');
		$data['signatories'] = $this->Site_model->getSignatories();
		$data['treasurer'] = $this->Site_model->getTreasurers();
		$data['assessor'] = $this->Site_model->getAssessors();

		$this->load->view('template/header', $data);
		$this->load->view('template/admin_nav');
		$this->load->view('template/breadcrumbs', $data);
		$this->load->view('admin/signatories', $data);
		$this->load->view('template/footer');
	}

	public function kinds_mgt()
	{
		$this->load->model('User_model');
		$this->load->model('Site_model');
		$this->User_model->forAdminOnly();
		$data['title'] = 'Kinds Management';
		$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal');
		$data['js'] = array('kinds');
		$data['font'] = array();
		$data['breadcrumbs'] = array('#' =>'Site Mgt.','kinds_mgt'=> 'Kinds Management');

        $this->session->flashdata('message');
        if(!empty($this->input->post())){
        	if($this->Site_model->addKind($this->input->post())){

        	}
        }
		$data['detail'] = $this->Site_model->get();
		// $this->load->model('Treasurer_model');
		$data['kinds'] = $this->Site_model->getKinds();

		$this->load->view('template/header', $data);
		$this->load->view('template/admin_nav');
		$this->load->view('template/breadcrumbs', $data);
		$this->load->view('admin/kinds', $data);
		$this->load->view('template/footer');
	}

	public function countExist()
	{
		$report_name = $this->input->get('report_name');
		$this->load->model('Signatory_model');
		if($this->Signatory_model->ifExist($report_name))
			echo 1;
		else
			echo 0;
	}
}