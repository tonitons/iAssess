<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model('User_model');
		
	}

	public function index()
	{
		$data['title'] = 'ADMIN';
		$data['css'] = array('bootstrap.min', 'styleses', 'Pretty-Footer', 'Pretty-Footer-1');
		$data['js'] = array('jquery.min', 'bootstrap.min');
		$data['font'] = array('font-awesome.min');

		$this->load->view('template/main_nav', $data);
		$this->load->view('template/admin_nav', $data);
		$this->load->view('pages/admin', $data);
		$this->load->view('template/footer', $data);
	}

	public function market_value($type)
	{
		$data['title'] = 'ADMIN';
		$data['css'] = array('bootstrap.min', 'styleses', 'Pretty-Footer', 'Pretty-Footer-1');
		$data['js'] = array('jquery.min', 'bootstrap.min', 'mv_land');
		$data['font'] = array('font-awesome.min');
		$this->load->model('Admin_model');

		$this->load->view('template/main_nav', $data);
		$this->load->view('template/admin_nav', $data);
		###########################if land is to process#########################
		if($type == 'land'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('RCI_id', 'KIND', 'required|is_unique[SUMV_RCI_Land.RCI_id]');

			$this->session->mark_as_flash('message');
			if($this->input->post('action') == 'add'){
				if ($this->form_validation->run() == TRUE) {

					if(!empty($this->input->post())){
						if($this->Admin_model->add_market_value('SUMV_RCI_Land', $this->input->post())){
							$data['message'] = [
									'status' => 'success',
									'message' => $this->input->post('kind').' Market Value has been added. :)'
								];
						}else{
							$data['message'] = [
							'status' => 'error',
							'message' => 'Adding unsuccessful. Please try again. :('
							];
							}
					}

				} else {
					$this->session->set_flashdata('message', [
							'status'=>'danger',
							'message'=> 'Duplicate entry for \''.$this->input->post('kind').'\' update existing record instead.'
						]);
					$data['validation'] = $this->session->flashdata('message');
				}
			}else if($this->input->post('action') == 'update'){
				if(!empty($this->input->post())){
						if($this->Admin_model->update_mvland($this->input->post('kind'),$this->input->post())){
							$data['message'] = [
									'status' => 'success',
									'message' => $this->input->post('kind').' Market Value has been updated. :)'
								];
						}else{
							$data['message'] = [
							'status' => 'error',
							'message' => 'Error Updating, Please try again. :('
							];
							}
					}
			}else if($this->input->post('action') == 'increase'){
				//increase percentage of current market values
				if($this->Admin_model->increase_market_value('SUMV_RCI_Land', $this->input->post())){
					$data['message'] = [
									'status' => 'success',
									'message' => 'Market values updated to '.$this->input->post('percent').'%. :)'
								];
					}else{
						$data['message'] = [
						'status' => 'error',
						'message' => 'Error Updating, Please try again. :('
						];
					}
			}


			$data['mv_land'] = $this->Admin_model->getAll('SUMV_RCI_Land');
			$data['date'] = $this->Admin_model->get_date_updated('SUMV_RCI_Land');
			$this->load->view('market_value/land', $data);
			########################### end of land is to process #########################
		}else if($type == 'agricultural'){
			########################### if agricultural land is to process #########################

			$this->load->library('form_validation');
			$this->form_validation->set_rules('Agri_id', 'Type of Land', 'required|is_unique[BUMV_Agri_Land.Agri_id]');

			$this->session->mark_as_flash('message');
			if($this->input->post('action') == 'add'){
				if ($this->form_validation->run() == TRUE) {

					if(!empty($this->input->post())){
						if($this->Admin_model->add_market_value('BUMV_Agri_Land', $this->input->post())){
							$data['message'] = [
									'status' => 'success',
									'message' => $this->input->post('kind').' Market Value has been added. :)'
								];
						}else{
							$data['message'] = [
							'status' => 'error',
							'message' => 'Adding unsuccessful. Please try again. :('
							];
							}
					}

				} else {
					$this->session->set_flashdata('message', [
							'status'=>'danger',
							'message'=> 'Duplicate entry for \''.$this->input->post('kind').'\' update existing record instead.'
						]);
					$data['validation'] = $this->session->flashdata('message');
				}
			}else if($this->input->post('action') == 'update'){
				if(!empty($this->input->post())){
						if($this->Admin_model->update_market_value('BUMV_Agri_Land' ,$this->input->post('Agri_land'),$this->input->post())){
							$data['message'] = [
									'status' => 'success',
									'message' => $this->input->post('kind').' Market Value has been updated. :)'
								];
						}else{
							$data['message'] = [
							'status' => 'error',
							'message' => 'Error Updating, Please try again. :('
							];
							}
					}
			}else if($this->input->post('action') == 'increase'){
				//increase percentage of current market values
				if($this->Admin_model->increase_market_value('BUMV_Agri_Land' ,$this->input->post())){
					$data['message'] = [
									'status' => 'success',
									'message' => 'Market values updated to '.$this->input->post('percent').'%. :)'
								];
					}else{
						$data['message'] = [
						'status' => 'error',
						'message' => 'Error Updating, Please try again. :('
						];
					}
			}


			$data['mv_agri'] = $this->Admin_model->getAll('BUMV_Agri_land');
			$data['date'] = $this->Admin_model->get_date_updated('BUMV_Agri_land');
			$this->load->view('market_value/agri', $data);
			########################### end of agricultural land is to process #########################
		}else if($type == 'plantation'){
			############################# if plantation is to process ###########################

			$this->load->library('form_validation');
			$this->form_validation->set_rules('Plant_id', 'Kind', 'required|is_unique[SMV_Plantation.Plant_id]');

			$this->session->mark_as_flash('message');
			if($this->input->post('action') == 'add'){
				if ($this->form_validation->run() == TRUE) {

					if(!empty($this->input->post())){
						if($this->Admin_model->add_market_value('SMV_Plantation', $this->input->post())){
							$data['message'] = [
									'status' => 'success',
									'message' => $this->input->post('kind').' Market Value has been added. :)'
								];
						}else{
							$data['message'] = [
							'status' => 'error',
							'message' => 'Adding unsuccessful. Please try again. :('
							];
							}
					}

				} else {
					$this->session->set_flashdata('message', [
							'status'=>'danger',
							'message'=> 'Duplicate entry for \''.$this->input->post('kind').'\' update existing record instead.'
						]);
					$data['validation'] = $this->session->flashdata('message');
				}
			}else if($this->input->post('action') == 'update'){
				if(!empty($this->input->post())){
						if($this->Admin_model->update_market_value('SMV_Plantation' ,$this->input->post('Agri_land'),$this->input->post())){
							$data['message'] = [
									'status' => 'success',
									'message' => $this->input->post('kind').' Market Value has been updated. :)'
								];
						}else{
							$data['message'] = [
							'status' => 'error',
							'message' => 'Error Updating, Please try again. :('
							];
							}
					}
			}else if($this->input->post('action') == 'increase'){
				//increase percentage of current market values
				if($this->Admin_model->increase_market_value('BUMV_Agri_Land' ,$this->input->post())){
					$data['message'] = [
									'status' => 'success',
									'message' => 'Market values updated to '.$this->input->post('percent').'%. :)'
								];
					}else{
						$data['message'] = [
						'status' => 'error',
						'message' => 'Error Updating, Please try again. :('
						];
					}
			}else if($this->input->post('action') == 'revision'){
				if($this->Admin_model->revision('BUMV_Agri_Land' ,$this->input->post())){
					$data['message'] = [
									'status' => 'success',
									'message' => 'Market values updated to '.$this->input->post('percent').'%. :)'
								];
					}else{
						$data['message'] = [
						'status' => 'error',
						'message' => 'Error Updating, Please try again. :('
						];
					}
			}


			$data['mv_agri'] = $this->Admin_model->getAll('SMV_Plantation');
			$data['date'] = $this->Admin_model->get_date_updated('SMV_Plantation');
			$this->load->view('market_value/plantation', $data);			
			########################### end if plantation is to process #########################
		}else {
			###########################if building is to process #########################

			########################### end if building is to process #########################
		}

			
			
			$this->load->view('template/footer', $data);
		
	}
}