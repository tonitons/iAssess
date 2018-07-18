<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	public function __construct()
	{
		parent::__construct();
		//Do your magic here
		$this->load->model('Site_model');
	}
	
	
	public function index()
	{
		$data['title'] = 'HOME';
		$data['css'] = array('Google-Style-Login','index');
		$data['js'] = array();
		$data['font'] = array();
		
		$data['detail'] = $this->Site_model->get();
		
		$this->load->view('template/header', $data);
		$this->load->view('template/hero');
		if($this->session->user_type == 'admin')
			$this->load->view('template/admin_nav');
		else
			$this->load->view('template/main_nav');
		$this->load->view('index');
		$this->load->view('template/footer', $data);
	}

	
	public function search()
	{

		$data['title'] = 'SEARCH PROPERTY';
		$data['css'] = array('land_mgt','Pretty-Registration-Form', 'modal');
		$data['js'] = array('search');
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		$searchQuery = $this->input->get('searchQuery');
		if(!empty($searchQuery)){
		
			$this->load->model('RealProperty_model');

			$data['property_data'] = $this->RealProperty_model->search($searchQuery);
		}

		$this->session->mark_as_flash('message');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('visitor_name', 'Name', 'required');
		$this->form_validation->set_rules('visitor_contact', 'Contact Number', 'required');
		$this->form_validation->set_rules('visitor_message', 'Message', 'required|min_length[15]');
		if ($this->form_validation->run() == TRUE) {
			// print_r($this->input->post());
			$this->load->model('RealProperty_model');
			$ownerid = $this->RealProperty_model->get_ownerid($this->input->post('pin'));

			$p_message = [
				'pin' 			=> $this->input->post('pin'),
				'owner_id'		=> $ownerid,
				'visitor_name' 	=> $this->input->post('visitor_name'),
				'visitor_contact' => $this->input->post('visitor_contact'),
				'visitor_message' => $this->input->post('visitor_message')
			];
			$this->load->model('Owner_model');
			if($this->Owner_model->send($p_message)){
				$data['message'] = [
					'status' => 'success',
					'message' => ' Message Sent :)'
				];
			}else{
				$data['message'] = [
					'status' => 'danger',
					'message' => ' Message not Sent :('
				];
			}
		} else {
			$this->session->set_flashdata('message', [
							'status'=>'danger',
							'message'=> validation_errors()
						]);
		}
		$data['validation'] = $this->session->flashdata('message');
		$this->load->view('template/header', $data);
		// $this->load->view('template/hero');
		$this->load->view('template/main_nav');
		$this->load->view('search', $data);
		$this->load->view('template/footer', $data);
	}

	public function view($pin)
	{
		
		$data['title'] = 'VIEW PROPERTY';
		$data['css'] = array('land_mgt','Pretty-Registration-Form');
		$data['js'] = array();
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		$this->load->model('RealProperty_model');
		$data['property_data'] = $this->RealProperty_model->view_property($pin);
		$this->load->view('template/header', $data);
		// $this->load->view('template/hero');
		$this->load->view('template/main_nav');
		$this->load->view('view_property', $data);
		$this->load->view('template/footer', $data);	
	}

	public function faq()
	{
		$data['title'] = "Frequently Asked Questions";
		$data['css'] = array('faq','land_mgt','Pretty-Registration-Form');
		$data['js'] = array();
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		$this->load->view('template/header', $data);
		// $this->load->view('template/hero');
		$this->load->view('template/main_nav');
		$this->load->view('faq', $data);
		$this->load->view('template/footer', $data);
	}

	public function message($pin)
	{
		
		$data['title'] = 'CREATE MESSAGE';
		$data['css'] = array('land_mgt','Pretty-Registration-Form');
		$data['js'] = array();
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();

		$this->session->mark_as_flash('message');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('visitor_name', 'Name', 'required');
		$this->form_validation->set_rules('visitor_contact', 'Contact Number', 'required');
		$this->form_validation->set_rules('visitor_message', 'Message', 'required|min_length[15]');
		if ($this->form_validation->run() == TRUE) {
			// print_r($this->input->post());
			$this->load->model('RealProperty_model');
			$ownerid = $this->RealProperty_model->get_ownerid($pin);

			echo '<h1>'.$ownerid->owner_id.'</h1>';
			$p_message = [
				'pin' 			=> $pin,
				'owner_id'		=> $ownerid->owner_id,
				'visitor_name' 	=> $this->input->post('visitor_name'),
				'visitor_contact' => $this->input->post('visitor_contact'),
				'visitor_message' => $this->input->post('visitor_message')
			];
			$this->load->model('Owner_model');
			// if($this->Owner_model->send($p_message)){
			// 	$data['message'] = [
			// 		'status' => 'success',
			// 		'message' => ' Message Sent :)'
			// 	];
			// }else{
			// 	$data['message'] = [
			// 		'status' => 'danger',
			// 		'message' => ' Message not Sent :('
			// 	];
			// }
		} else {
			$this->session->set_flashdata('message', [
							'status'=>'danger',
							'message'=> validation_errors()
						]);
		}
		$data['validation'] = $this->session->flashdata('message');
		// $this->load->model('RealProperty_model');
		// $data['property_data'] = $this->RealProperty_model->view_property($pin);
		$this->load->view('template/header', $data);
		// $this->load->view('template/hero');
		$this->load->view('template/main_nav');
		$this->load->view('message', $data);
		$this->load->view('template/footer', $data);	
	}

	public function calculator($type)
	{

		$data['detail'] = $this->Site_model->get();

		$data['css'] = array('Pretty-Registration-Form', 'calculator');
		
		$data['font'] = array();

		if($type == 'agricultural')
		{
			$this->load->model('Home_model');	
			$data['title'] = 'Calculator';
			$data['js'] = array('calc_agri');
			$view = 'agri';
			$data['market_values'] = $this->Home_model->getAll('tbl_sfmv_agri_land');
		}else if($type == 'improvements'){
			$this->load->model('Home_model');	
			$data['title'] = 'Calculator';
			$data['js'] = array('calc_imp');
			$view = 'imp';
			$data['market_values'] = $this->Home_model->getAll('tbl_sfmv_improvements');
		}else if($type == 'land'){
			$this->load->model('Home_model');	
			$data['title'] = 'Calculator';
			$data['js'] = array('calc_imp');
			$view = 'land';
			$data['market_values'] = $this->Home_model->getAll('tbl_sfmv_rci_land');
		}

		$this->load->view('template/header', $data);
		$this->load->view('template/main_nav');
		$this->load->view('calculator/'.$view, $data);
		$this->load->view('template/footer', $data);
	}

}
