<?php 

/**
* 
*/
class Land extends CI_Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('User_model');
		$this->load->model('Site_model');
	}



	public function view($pin)
	{
		if($pin == 'land_property')
			header('location:'.base_url('admin/real_property_mgt/land_property'));
		
		$data['title'] = 'VIEW PROPERTY';
		$data['css'] = array('land_mgt','Pretty-Registration-Form', 'modal');
		$data['js'] = array('view_property');
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		$this->load->model('RealProperty_model');
		$data['property_data'] = $this->RealProperty_model->view_property($pin);
		$data['breadcrumbs'] = array('#' =>'Real Property Mgt.', 'land_property' => 'Land Property', '#view'=> 'View');
		$this->load->view('template/header', $data);
		// $this->load->view('template/hero');
		$this->load->model('RealProperty_model');

		if(!empty($this->input->post())){
			$data = [
				'fname'		=> $this->input->post('fname'),
				'mname'		=> $this->input->post('mname'),
				'lname'		=> $this->input->post('lname'),
				'address'	=> $this->input->post('address'),
				'contact'	=> $this->input->post('contact'),
				'email'		=> $this->input->post('email'),
				'beneficial'=> $this->input->post('beneficial'),
				'ben_add'	=> $this->input->post('ben_add'),
				'ben_tel'	=> $this->input->post('ben_tel')
			];
			$id = $this->input->post('owner_id');
			if($this->RealProperty_model->update($id, $data)){
					$this->User_model->activity_log('Updated property record with PIN: '.$this->input->post('pin'));
						$data['message'] = [
								'status' => 'success',
								'message' => 'Property Record has been updated. :)'
							];
					}else{
						$data['message'] = [
						'status' => 'error',
						'message' => 'Action not saved :( Please try again.'
						];
					}
		}

		$data['property'] = $this->RealProperty_model->getPropertyByPin($pin);
		if ($this->session->user_type == 'admin')
			$this->load->view('template/admin_nav');
		else
			$this->load->view('template/staff_nav');
		$this->load->view('template/breadcrumbs', $data);
		$this->load->view('view_property', $data);
		$this->load->view('template/footer', $data);	
	}


}
 ?>

