<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model('User_model');
		$this->load->model('Site_model');
		
	}

	public function index()
	{
		$this->User_model->forAdminAndStaffOnly();
		$data['title'] = 'ADMIN';
		$data['css'] = array('modal');
		$data['js'] = array();
		$data['font'] = array();

		if($this->session->user_type == 'admin'){
			$nav = 'admin_nav';
		}else{
			$nav = 'staff_nav';
		}
		$datetoday = date('Y-m-d');
		$year = date('Y');
		if($datetoday >= "$year-01-01" && $datetoday <= "$year-01-31"){
			$this->_reassessment_reappraisal_retaxing();
			$this->define_tax_dec($datetoday);
		}

		// if()
		$this->load->model('Owner_model');
		$this->load->model('Treasurer_model');
		$this->session->mark_as_flash('message');
		$this->load->library('form_validation');
		
		if(!empty($this->input->post('email'))){
			if($this->Treasurer_model->update_email_staff($this->session->user_id, $this->input->post('email'))){
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
			
		}
		$data['email'] = $this->Owner_model->getEmailStaff($this->session->user_id);
		$data['validation'] = $this->session->flashdata('message');
		$data['detail'] = $this->Site_model->get();
		$this->load->view('template/header', $data);
		$this->load->view('template/'.$nav);
		$this->load->view('pages/admin', $data);
		$this->load->view('template/footer', $data);

	}

	public function market_value($type)
	{
		$this->User_model->forAdminOnly();
		$data['title'] = 'Schedule of Fair Market Values';
		$data['css'] = array('land_mgt','Pretty-Registration-Form', 'modal', 'datatables');
		$data['js'] = array('mv_land', 'building', 'datatables');
		$data['font'] = array('font-awesome.min');
		$this->load->model('Admin_model');

		$data['detail'] = $this->Site_model->get();
			

		$this->load->view('template/header', $data);
		$this->load->view('template/admin_nav', $data);
			###########################if land is to process#########################
		if($type == 'land'){
			$this->load->library('form_validation');
			$this->form_validation->set_rules('rci_id', 'KIND', 'required|is_unique[tbl_sfmv_rci_land.rci_id]');
			$table = 'tbl_sfmv_rci_land';
			$field = 'kind';
			$view = 'land';
			$data['breadcrumbs'] = array('#' =>'Market Value','land'=> 'Land');

			########################### end of land is to process #########################
		}else if($type == 'agricultural'){
			########################### if agricultural land is to process #########################

			$this->load->library('form_validation');
			$this->form_validation->set_rules('agri_id', 'Type of Land', 'required|is_unique[tbl_sfmv_agri_land.agri_id]');
			$table = 'tbl_sfmv_agri_land';
			$field = 'agri_land';
			$view = 'agri';
			$data['breadcrumbs'] = array('#' =>'Market Value','agricultural'=> 'Agricultral Land');

			########################### end of agricultural land is to process #########################
		}else if($type == 'plantation'){
			############################# if plantation is to process ###########################

			$this->load->library('form_validation');
			$this->form_validation->set_rules('plant_id', 'Kind', 'required|is_unique[tbl_sfmv_improvements.plant_id]');
			$table = 'tbl_sfmv_improvements';
			$field = 'kind';
			$view = 'plantation';
			$data['breadcrumbs'] = array('#' =>'Market Value','plantation'=> 'Plantation');

			########################### end if plantation is to process #########################
		}else if($type == 'building'){
			###########################if building is to process #########################
			$this->load->library('form_validation');
			$this->form_validation->set_rules('sbuv_id', 'Type of Building and Building', 'required|is_unique[tbl_sfmv_building.sbuv_id]');
			$table = 'tbl_sfmv_building';
			$field = 'name_building';
			$view = 'building';
			$data['breadcrumbs'] = array('#' =>'Market Value','building'=> 'Building');
			// echo $this->input->post('sbuv_id');
			########################### end if building is to process #########################
		}


			$this->session->mark_as_flash('message');
			if($this->input->post('action') == 'add'){
				if ($this->form_validation->run() == TRUE) {

					if(!empty($this->input->post())){
						// print_r($this->input->post());
						if($this->Admin_model->add_market_value($table, $this->input->post())){

							if($type == 'building'){
								$data['message'] = [
									'status'=>'success',
									'message'=> $this->input->post('building_type').' and '.$this->input->post($field).'\'  Market value has been added.'
								];
								$this->User_model->activity_log('Added Market value for '.$this->input->post('building_type').' and '.$this->input->post($field));
								}else{
									$data['message'] = [
											'status' => 'success',
											'message' => $this->input->post($field).' Market Value has been added. :)'
										];
									$this->User_model->activity_log('Added Market Value for'.$this->input->post($field));
								}

						}else{
							$data['message'] = [
							'status' => 'error',
							'message' => 'Adding unsuccessful. Please try again. :('
							];
						}
					}

				} else {
					if($type == 'building'){
						$this->session->set_flashdata('message', [
							'status'=>'danger',
							'message'=> 'Duplicate entry for \''.$this->input->post('building_type').' and '.$this->input->post($field).'\' update existing record instead.'
						]);
					}else{
						$this->session->set_flashdata('message', [
							'status'=>'danger',
							'message'=> 'Duplicate entry for \''.$this->input->post($field).'\' update existing record instead.'
						]);
					}
					$data['validation'] = $this->session->flashdata('message');
				}
			}else if($this->input->post('action') == 'update'){
				if(!empty($this->input->post())){
						if($type == 'building'){ $field = $this->input->post('sbuv_id');$col_update_id = $this->input->post('sbuv_id');}
						else if($type == 'land') $col_update_id = $this->input->post('rci_id');
						else if($type == 'agricultural') $col_update_id = $this->input->post('agri_id');

						if($this->Admin_model->update_market_value($table ,$this->input->post($field),$this->input->post())){
							$data['message'] = [
									'status' => 'success',
									'message' => $this->input->post($field).' Market Value has been updated. :)'
								];
							$this->User_model->activity_log('Updated Market Value for '.$this->input->post($field).'('.$view.')');

							//recompute property value
							// var_dump($col_update_id);
							$this->update_appraisal($table, $col_update_id);
						}else{
							$data['message'] = [
							'status' => 'error',
							'message' => 'Error Updating, Please try again. :('
							];
							}
					}
			}else if($this->input->post('action') == 'increase'){
				//increase percentage of current market values
				if($this->Admin_model->increase_market_value($table ,$this->input->post())){
					$data['message'] = [
									'status' => 'success',
									'message' => 'Market values updated to '.$this->input->post('percent').'%. :)'
								];
						$this->User_model->activity_log('Increased Market Values to '.$this->input->post('percent'). '%');

						//call recompute again
						$this->update_appraisal($table);
					}else{
						$data['message'] = [
						'status' => 'error',
						'message' => 'Error Updating, Please try again. :('
						];
					}
			}else if($this->input->post('action') == 'revise'){
				if($this->Admin_model->revision($table ,$this->input->post())){
					//$this->Admin_model->backup_sfmv();
					$this->Admin_model->update_revision_number($this->input->post('revision'));
					$this->session->current_revision = $this->input->post('revision');
					//call fnction to perform reassessment of all real properties including taxing
					$this->_reassessment_reappraisal_retaxing();
					$data['message'] = [
									'status' => 'success',
									'message' => 'Revision updated to '.$this->input->post('revision').'. :) <br> It is recommended that you must Increase Market Value by clicking the Increase Current Value Button',
									'referrer' => 'revision'
								];
						$this->User_model->activity_log('Updated Revision to '.$this->input->post($revision));
					}else{
						$data['message'] = [
						'status' => 'error',
						'message' => 'Error Updating, Please try again. :('
						];
					}
			}else if($type == 'history'){
				$table = 'tbl_sfmv_building';
				$view = 'history';
				$this->load->model('Backup_model');
				$data['agri_land_hx'] = $this->Backup_model->getRevisionHistory('tbl_sfmv_agri_land_hx');
				$data['rci_land_hx'] = $this->Backup_model->getRevisionHistory('tbl_sfmv_rci_land_hx');
				$data['building_hx'] = $this->Backup_model->getRevisionHistory('tbl_sfmv_building_hx');
				$data['improvements_hx'] = $this->Backup_model->getRevisionHistory('tbl_sfmv_improvements_hx');
				$data['breadcrumbs'] = array('#' =>'Market Value', ''=> 'Revision History');
			}


			$data['market_values'] = $this->Admin_model->getAll($table);
			$data['date'] = $this->Admin_model->get_date_updated($table);
			$this->load->view('template/breadcrumbs', $data);
			$this->load->view('admin/market_value/'.$view, $data);			
			$this->load->view('template/footer', $data);
		
	}

	public function real_property_mgt($type)
	{
		$this->load->model('Admin_model');
		$this->User_model->forAdminAndStaffOnly();
		$data['title'] = 'Real Property Management';
		$data['font'] = array();
		
		if($this->session->user_type == 'admin'){
			$nav = 'admin_nav';
		}else{
			$nav = 'staff_nav';
		}
		
	 	if($type == 'land_property'){
			$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal', 'datatables');
			$data['js'] = array('add_land', 'datatables');
			$data['breadcrumbs'] = array('#' =>'Real Property Mgt.','land_property'=> 'Land Property');
			$view = 'land';
			// $this->_land_mgt($this->input->post);
			$this->load->model('RealProperty_model');
			$query = !empty($_GET['s']) ? $_GET['s'] : '';
			$by = !empty($_GET['by']) ? $_GET['by'] : 'fname';
			if(!empty($_GET['s']) && !empty($_GET['by']))
				$data['list_land_property'] = $this->RealProperty_model->getLandWhere($query, $by);
			else
				$data['list_land_property'] = $this->RealProperty_model->getAllLand();


		}else if($type == 'building_property'){
			$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal', 'datatables');
			$data['js'] = array('add_building', 'datatables');
			$data['breadcrumbs'] = array('#' =>'Real Property Mgt.','building'=> 'Building Property');
			$view = 'building';

			$this->load->model('RealProperty_model');
			$query = !empty($_GET['s']) ? $_GET['s'] : '';
			$by = !empty($_GET['by']) ? $_GET['by'] : 'fname';
			if(!empty($_GET['s']) && !empty($_GET['by']))
				$data['list_building_property'] = $this->RealProperty_model->getBuildingWhere($query, $by);
			else
				$data['list_building_property'] = $this->RealProperty_model->getAllBuilding();

		}else if($type == 'machinery'){
			$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal', 'datatables');
			$data['js'] = array('add_land', 'datatables');
			$data['breadcrumbs'] = array('#' =>'Real Property Mgt.','machinery'=> 'Machinery');
			$this->load->model('RealProperty_model');
			$data['machineries'] = $this->RealProperty_model->getAllMachinery();
			$view = 'machinery';
		}else if($type == 'add_land'){

			$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal', 'datepicker');
			$data['js'] = array('add_land', 'mask', 'datatables', 'bootstrap-datepicker');
			$data['breadcrumbs'] = array('#' =>'Real Property Mgt.', 'land_property' => 'Land Property', 'add_land'=> 'Add New');
			$view = 'add_land';

			$this->session->mark_as_flash('message');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('taxable', 'Taxable Button Selection', 'required');
			$this->form_validation->set_rules('pin', 'PIN', 'required|is_unique[tbl_real_property.pin]');
			// $this->form_validation->set_rules('email', 'E-mail', 'required|is_unique[tbl_real_property.pin]');

			if ($this->form_validation->run() == TRUE) {
				//submit data to function for insertion
					if($user = $this->_do_add_land($this->input->post())){
					$this->User_model->activity_log('Added new land property with PIN: '.$this->input->post('pin'));
						$data['message'] = [
								'status' => 'success',
								'message' => 'Real Property Appraisal and Assessment has been saved. :) <br/><br/> Username generated: '.$user.' '
							];
					}else{
						$data['message'] = [
						'status' => 'error',
						'message' => 'Action not saved :( Please review your inputs.'
						];
					}
 
			}else{

				$this->session->set_flashdata('message', [
					'status'=>'danger',
					'message'=> validation_errors()
				]);
			}
					$data['validation'] = $this->session->flashdata('message');
		

			$data['brgys'] = $this->Admin_model->getAll('tbl_barangay');
			// $data['improvements'] = $this->Admin_model->getAll('tbl_sfmv_improvements');

		}else if($type == 'add_building'){
			$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal', 'datepicker');
			$data['js'] = array('datatables','add_land', 'mask', 'add_building',  'bootstrap-datepicker');
			$data['brgys'] = $this->Admin_model->getAll('tbl_barangay');
			$data['breadcrumbs'] = array('#' =>'Real Property Mgt.', 'building_property' => 'Building Property' ,'add_building'=> 'Add New');
			$view = 'add_building';		

			$this->session->mark_as_flash('message');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('taxable', 'Taxable Button Selection', 'required');
			$this->form_validation->set_rules('pin', 'PIN', 'required|is_unique[tbl_real_property.pin]');
			// $this->form_validation->set_rules('email', 'E-mail', 'required|is_unique[tbl_real_property.pin]');
			$this->load->model('RealProperty_model');
			$data['building_types'] = $this->RealProperty_model->get_building_types();


			if ($this->form_validation->run() == TRUE) {
				// var_dump($this->input->post());
				//submit data to function for insertion
					if($user = $this->_do_add_building($this->input->post())){
					$this->User_model->activity_log('Added new building property with PIN: '.$this->input->post('pin'));
						$data['message'] = [
								'status' => 'success',
								'message' => 'Real Property Appraisal and Assessment has been saved. :) <br/><br/> Username generated: '.$user.' '
							];
					}else{
						$data['message'] = [
						'status' => 'error',
						'message' => 'Action not saved :( Please review your inputs.'
						];
					}
 
			}else{

				$this->session->set_flashdata('message', [
					'status'=>'danger',
					'message'=> validation_errors()
				]);
			}
					$data['validation'] = $this->session->flashdata('message');


		}else if($type == 'add_machinery'){

			$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal', 'datepicker');
			$data['js'] = array('add_machinery', 'add_land','mask', 'datatables', 'bootstrap-datepicker');
			$data['breadcrumbs'] = array('#' =>'Real Property Mgt.', 'machinery' => 'Machinery', 'add_machinery'=> 'Add New');
			$view = 'add_machinery';

			$this->session->mark_as_flash('message');
			$this->load->library('form_validation');
			$this->form_validation->set_rules('taxable', 'Taxable Button Selection', 'required');
			$this->form_validation->set_rules('pin', 'PIN', 'required|is_unique[tbl_real_property.pin]');
			// $this->form_validation->set_rules('email', 'E-mail', 'required|is_unique[tbl_real_property.pin]');

			if ($this->form_validation->run() == TRUE) {
				//submit data to function for insertion
					if($user = $this->_do_add_machinery($this->input->post())){
					$this->User_model->activity_log('Added Machinery with PIN: '.$this->input->post('pin'));
						$data['message'] = [
								'status' => 'success',
								'message' => 'Machinery Appraisal and Assessment has been saved. :) <br/><br/> Username generated: '.$user.' '
							];
					}else{
						$data['message'] = [
						'status' => 'error',
						'message' => 'Action not saved :( Please review your inputs.'
						];
					}
 
			}else{

				$this->session->set_flashdata('message', [
					'status'=>'danger',
					'message'=> validation_errors()
				]);
			}
					$data['validation'] = $this->session->flashdata('message');
		

			$data['brgys'] = $this->Admin_model->getAll('tbl_barangay');

		}

		$data['detail'] = $this->Site_model->get();

		$this->load->view('template/header', $data);
		$this->load->view('template/'.$nav);
		$this->load->view('template/breadcrumbs', $data);
		$this->load->view('admin/rpm/'.$view, $data);
		$this->load->view('template/footer', $data);
		
	}

	public function _land_mgt($data)
	{
		# code...
	}

	public function users()
	{
		$this->User_model->forAdminOnly();
		$data['title'] = 'USERS';
		$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal', 'datatables');
		$data['js'] = array('datatables', 'users');
		$data['font'] = array();
		$data['breadcrumbs'] = array('#' =>'Site Mgt.','users'=> 'Users');

		if($this->input->post('action') == 'deactivate'){

			if(!empty($this->input->post())){
				if($this->User_model->user('deactivate', $this->input->post('user_name'))){
					$data['message'] = [
							'status' => 'success',
							'message' => $this->input->post('user_name').' Has been deactivated :)'
						];
				}else{
					$data['message'] = [
					'status' => 'error',
					'message' => 'Error Deactivating, Please try again. :('
					];
				}
			}
		}else if($this->input->post('action') == 'activate'){

			if(!empty($this->input->post())){
				if($this->User_model->user('activate', $this->input->post('user_name'))){
					$data['message'] = [
							'status' => 'success',
							'message' => $this->input->post('user_name').' Has been activated again:)'
						];
				}else{
					$data['message'] = [
					'status' => 'error',
					'message' => 'Error activating, Please try again. :('
					];
				}
			}
		}else if($this->input->post('action') == 'add'){
			if(!empty($this->input->post())){
				$id = 0;
				while($this->User_model->check_id($id)){
					$id--;
				}
				$user_data = [
					'user_id'	=> $id,
					'user_name'	=> $this->input->post('user_name'),
					'password'	=> sha1($this->input->post('password')),
					'user_type'	=> $this->input->post('user_type'),
					'active'	=> '1'
				];
				$staff_data = [
					'staff_id' 	=> $id,
					'fname'		=> $this->input->post('fname'),
					'mname'		=> $this->input->post('mname'),
					'lname'		=> $this->input->post('lname'),
					'email'		=> $this->input->post('email'),
					'position'	=> $this->input->post('position')
				];
				if($this->User_model->add_user($user_data)){
					$this->User_model->add_staff($staff_data);
					$this->User_model->activity_log('Added new user: '.$this->input->post('user_name'));
					$data['message'] = [
							'status' => 'success',
							'message' => 'New user has been created. :)'
						];
				}else{
					$data['message'] = [
					'status' => 'error',
					'message' => 'Error adding, Please try again. :('
					];
				}
			}
		}else if($this->input->post('action') == 'change_role') {
			$id = $this->input->post('user_id');
			$staff = ['user_type'=>$this->input->post('user_type')];
			if($this->User_model->role($id, $staff)){

			$this->User_model->activity_log('Changed role to '.$this->input->post('user_type'));
				$data['message'] = [
						'status' => 'success',
						'message' => 'Staff has been changed to '. $this->input->post('user_type').' :)'
						];
			}else{
				$data['message'] = [
				'status' => 'error',
				'message' => 'Error changing role, Please try again. :('
				];
			}
		}

		$data['users'] = $this->User_model->getAll('user');
		$data['detail'] = $this->Site_model->get();

		$this->load->view('template/header', $data);
		$this->load->view('template/admin_nav');
		$this->load->view('template/breadcrumbs', $data);
		$this->load->view('admin/users', $data);
		$this->load->view('template/footer', $data);
	}

	public function reports($report)
	{
		$this->User_model->forAdminOnly();
		
		$this->load->model('Signatory_model');
		$data['js'] = array('users');
		$data['font'] = array();		

		if($report == 'assessment_roll'){
			$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'quarterly', 'Pretty-Registration-Form-1');
			$brgy_id = !empty($_GET['brgy_id']) ? $_GET['brgy_id'] : '005';
			$year = !empty($_GET['year']) ? $_GET['year'] : date('Y');
			
			$this->load->model('RealProperty_model');
			$data['title'] = 'Assessment Roll';
			$view = 'assess_roll';
			$data['barangays'] = $this->RealProperty_model->getAllBarangays();
			$data['brgy_name'] = $this->RealProperty_model->getBarangayName($brgy_id);
			$data['assessment_roll'] = $this->RealProperty_model->getAssessmentRoll($brgy_id, $year);
			$data['ass_year'] = $year;
			$data['brgy_id'] = $brgy_id;
			$this->User_model->activity_log('Viewed Assessment Roll');
		}else if($report == 'quarterly'){
			$page = !empty($_GET['page']) ? $_GET['page'] : 1;
			$quarter = !empty($_GET['quarter']) ? $_GET['quarter'] : 'Jan-Mar';
			$year = !empty($_GET['year']) ? $_GET['year'] : date('Y');
			$data['css'] = array('Pretty-Registration-Form');
			$this->load->model('RealProperty_model');
			$this->load->model('Quarterly_model');
			$data['title'] = 'Quarterly Report';
			$page==1 ? $view = 'quarterly' : $view = 'quarterly2';
			$this->User_model->activity_log('Viewed Quarterly Report');
		}
		
		$data['detail'] = $this->Site_model->get();

		$this->load->view('template/header', $data);
		$this->load->view('template/admin_nav');
		$this->load->view('admin/'.$view, $data);
		$this->load->view('template/footer', $data);
	}

	public function logs()
	{
		$this->User_model->forAdminOnly();
		$this->load->model('Logs_model');
		$data['title'] = 'Activity Logs';
		$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal', 'datepicker', 'datatables');
		$data['js'] = array('logs', 'bootstrap-datepicker', 'datatables');
		$data['breadcrumbs'] = array('#' =>'Site Mgt.','logs'=> 'Activity Logs');
		$data['font'] = array();

		$month = date('M');
		$year = date('Y');
		// echo $month.$year;
    	$first_date = date('Y-m-d',strtotime("first day of $month $year"));
    	$last_date = date('Y-m-d',strtotime("last day of $month $year"));
  		$filter = [
					'from'	=> $first_date,
					'to'	=> $last_date
					];
		if(!empty($this->input->post('clear_log'))){
			$delete = $this->input->post('clear_log');
			if($this->Logs_model->delete_all($delete)){
				$data['message'] = [
								'status'	=> 'success',
								'message'	=> 'ALL logs has been successfully deleted! :)'
								];
			}else{
				$data['message'] = [
								'status'	=> 'danger',
								'message'	=> 'Sorry, logs were not deleted. Try again:('
								];
			}
		}
		// }else if(!empty($this->input->post('delete_log'))){
		// 	$delete = $this->input->post('delete_log');
		// 	if($this->Logs_model->delete_with_date($delete)){
		// 		$data['message'] = [
		// 						'status'	=> 'success',
		// 						'message'	=> 'Logs for the specified date has been successfully deleted! :)'
		// 						];
		// 	}else{
		// 		$data['message'] = [
		// 						'status'	=> 'danger',
		// 						'message'	=> 'Sorry, logs were not deleted. Try again:('
		// 						];
		// 	}
		// }

		if(!empty($this->input->post('from'))){
			$filter = [
					'from'	=> $this->input->post('from'),
					'to'	=> $this->input->post('to')
					];
		}

		$data['logs'] = $this->Logs_model->getAll($filter);
		$data['detail'] = $this->Site_model->get();

		$this->load->view('template/header', $data);
		$this->load->view('template/admin_nav');
		$this->load->view('template/breadcrumbs', $data);
		$this->load->view('admin/logs', $data);
		$this->load->view('template/footer', $data);	
	}

	public function feedback()
	{
		$this->User_model->forAdminAndStaffOnly();
		$this->load->model('Feedback_model');
		$data['title'] = 'Comments or Feedbacks';
		$data['css'] = array('land_mgt', 'Pretty-Registration-Form', 'modal', 'datatables');
		$data['js'] = array('datatables', 'feedback');
		$data['breadcrumbs'] = array('#' =>'Site Mgt.','feedback'=> 'Feedback');
		$data['font'] = array();

		if($this->session->user_type == 'admin'){
			$nav = 'admin_nav';
		}else{
			$nav = 'staff_nav';
		}

		if(!empty($this->input->post('fb_id'))){
			$delete = $this->input->post('fb_id');
			if($this->Feedback_model->delete_feedback($delete)){
				$data['message'] = [
								'status'	=> 'success',
								'message'	=> 'Selected feedback has been successfully deleted! :)'
								];
				$this->User_model->activity_log('Deleted Feedback');
			}else{
				$data['message'] = [
								'status'	=> 'danger',
								'message'	=> 'Sorry, fedback was not deleted. :('
								];
			}
		}else if(!empty($this->input->post('owner_id'))){
			$reply = [
					'pin' 		=> '',
					'owner_id'	=> $this->input->post('owner_id'),
					'visitor_name' => $this->session->user_name,
					'visitor_contact' => '',
					'visitor_message'	=> $this->input->post('fb_reply')
					];
			if($this->Feedback_model->send_reply($reply)){
				$this->load->model('Owner_model');
				$owner = $this->Owner_model->getOwnername($this->input->post('owner_id'));
				$data['message'] = [
								'status'	=> 'success',
								'message'	=> 'Message sent! :)'
								];
				$this->User_model->activity_log('Replied to a feedback from owner: '.$owner);
			}else{
				$data['message'] = [
								'status'	=> 'danger',
								'message'	=> 'Sorry, not sent. :('
								];
			}
		}


		$data['feedbacks'] = $this->Feedback_model->getAll();
		$data['detail'] = $this->Site_model->get();
		$data['feedback_cnt'] = $this->Feedback_model->feedback_count();

		$this->load->view('template/header', $data);
		$this->load->view('template/'.$nav);
		$this->load->view('template/breadcrumbs', $data);
		$this->load->view('admin/feedback', $data);
		$this->load->view('template/footer', $data);		
	}

	//####################################### functions for ajax

	public function get_data_field()
	{
		$id = $this->input->get('id');
		$this->load->model('Feedback_model');

		$fb = $this->Feedback_model->get_feedback($id);

		echo $fb->f_c;
	}

	public function status_read()
	{
		$this->load->model('Feedback_model');
		$fb_id = $this->input->get('id');
		$this->Feedback_model->status_read($fb_id);
	}

	public function get_lands()
	{
		$id = $this->input->get('id');
		$land_class = $this->input->get('land_class');
		$this->load->model('Admin_model');
		
		$market_value = $this->Admin_model->get_mv_land($id, $land_class);	

		echo number_format($market_value, 2);

	}

	public function get_agricultural_lands()
	{
		$this->load->model('Admin_model');
		
		$data['market_values'] = $this->Admin_model->getAll('tbl_sfmv_agri_land');
		$this->load->view('additionals/agri_add', $data);
	}

	public function get_unit_value()
	{
		$type = $this->input->get('agri_land');
		$sclass = $this->input->get('sub_class');
		$this->load->model('Admin_model');
		
		$data['unit'] = $this->Admin_model->get('tbl_sfmv_agri_land', $type, $sclass);
		$data['sclass'] = $sclass;
		$this->load->view('additionals/unit', $data);
	}
	public function get_calculator_unit_value()
	{
		$type = $this->input->get('agri_land');
		$sclass = $this->input->get('sub_class');
		$this->load->model('Admin_model');
		
		$unit = $this->Admin_model->get('tbl_sfmv_agri_land', $type, $sclass);
		
		echo number_format($unit, 2);
	}

	public function improve_unit_value()
	{
		$plant_id = $this->input->get('plant_id');
		$this->load->model('Admin_model');
		
		$data['unit'] = $this->Admin_model->get_improve($plant_id);
		// $data['sclass'] = $sclass;
		$this->load->view('additionals/unit', $data);
	}

	public function improve_calculator_unit_value()
	{
		$plant_id = $this->input->get('plant_id');
		$this->load->model('Admin_model');
		
		$unit = $this->Admin_model->get_improve($plant_id);
		// $data['sclass'] = $sclass;
		echo number_format($unit, 2);
	}


	public function get_market_value()
	{
		$area = str_replace(',', '', $this->input->get('area'));
		$unit = str_replace(',', '', $this->input->get('unit'));

		$mv = $area*$unit;

		$amv = round($mv, -1);
		echo number_format($amv, 2);
	}

	public function get_improvements()
	{
		$this->load->model('Admin_model');
		
		$data['improvements'] = $this->Admin_model->getAll('tbl_sfmv_improvements');
		$this->load->view('additionals/improve', $data);
	}
//for adjustments ini hiya
	public function calculate_adj_mvalue()
	{
		$lbmv = str_replace(',', '', $this->input->get('base_value'));
		// $ibmv = $this->input->get('ibmv');
		$total_adj = $this->input->get('total_adj');
		// echo $total_adj;
		
		$percent = abs($total_adj/100);
		$amv = number_format($lbmv*$percent, 2);
		echo $amv;
	}
//ini hira nga duha up and down :)
	public function calculate_mvalue_2()
	{
		$lbmv = str_replace(',', '', $this->input->get('base_value'));
		$lav = str_replace(',', '', $this->input->get('lav'));
		$total_adj = $this->input->get('total_adj');
		if($total_adj > 0)
			$amv2 = number_format($lbmv+$lav, 2);
		else
			$amv2 = number_format($lbmv-$lav, 2);
		echo $amv2;
	}

	public function calculate_adjusted_marketvalue()
	{
		// $land = floatval(preg_replace('/[^\d]/', '', $this->input->get('land')));
		// $imp = floatval(preg_replace('/[^\d]/', '', $this->input->get('imp')));
		$land = str_replace(',', '', $this->input->get('land'));
		$imp = str_replace(',', '', $this->input->get('imp'));
		// echo $imp.'imp'.'-'.$land;
		if($imp == '.00')
			$imp = 0.00;
		// echo $imp;
		$total = $land + $imp;
		echo number_format($total, 2);

	}

	public function calculate_assess_value()
	{
		$value = str_replace(',', '', $this->input->get('value'));
		$assess_level = $this->input->get('assess_level');

		$assess_value = ($value * ($assess_level/100));

		echo number_format($assess_value, 2);
	}

	public function _do_add_land($data)
	{
		// print_r($data);
	$this->load->model('User_model');
	$u_name = strtolower(str_replace(' ', '', $data['fname']).'.'.str_replace(' ', '', $data['lname']));
	$exist = $this->User_model->checkExistUsername($u_name);
	if($exist){
		$pin = substr($data['pin'], 14);
		$u_name = $u_name.'.'.$pin;
	}
		$this->load->model('Owner_model');
		
		$this->load->model('RealProperty_model');
		if(!empty($data['owner_on'] == 'new')){
			$owner_data = [
				'fname' 	=> $data['fname'],
				'mname' 	=> $data['mname'],
				'lname' 	=> $data['lname'],
				'address' 	=> $data['address'],
				'contact' 	=> $data['contact'],
				'email'		=> $data['email'],
				'beneficial'=> $data['beneficial'],
				'ben_add'	=> $data['ben_add'],
				'ben_tel'	=> $data['ben_tel']
			];
			
		
			$this->Owner_model->add($owner_data);
		
			$user_id = $this->User_model->get_userid($owner_data);
			
			// $u_name = $data['fname'].'.'.$data['lname'].'.'.$pin;
			$user_data = [
				'user_id'	=> $user_id,
				'user_name'	=> $u_name,
				'password'	=> sha1('12345678'),
				'user_type'	=> 'owner',
				'active' => '1',
				'token'	=> sha1($this->input->post('email'))
			];
		
			$this->User_model->add_user($user_data);
			$owner_id = $this->User_model->get($user_data);
		}else{
			$owner_id = $data['owner_id'];
		}
		
		
		if($data['taxable'] == 'Taxable'){
			$AV = str_replace(',', '', $data['assessment_value']);
			$taxable = 1;
			$tax_amt = $AV*.02;
		}
		else{
			$taxable = 0;
		}
		if(!empty($_POST['sub_class'])){
			$real_property_data = [
				'pin'		=> $data['pin'],
				'cadastral_lot_no'	=> $data['cadastral_lot_no'],
				'type_of_property'	=> 'land',
				'owner_id'	=> $owner_id,
				'brgy_id'	=> $data['brgy_id'],
				'area'		=> $data['area'],
				'taxable'	=> $taxable,
				'classification' => $data['classification'],
				'sub_class'	=> $data['sub_type'],
				'sub_type'	=> $data['sub_class']
			];
		}else{
			$real_property_data = [
				'pin'		=> $data['pin'],
				'cadastral_lot_no'	=> $data['cadastral_lot_no'],
				'type_of_property'	=> 'land',
				'owner_id'	=> $owner_id,
				'brgy_id'	=> $data['brgy_id'],
				'area'		=> $data['area'],
				'taxable'	=> $taxable,
				'classification' => $data['classification'],
				'sub_type'	=> $data['sub_type']
				];
		}
		$this->RealProperty_model->add($real_property_data);

		$boundaries = [
			'pin'	=> $data['pin'],
			'north'	=> $data['north'],
			'south'	=> $data['south'],
			'east'	=> $data['east'],
			'west'	=> $data['west']
		];
		$this->RealProperty_model->add_boundaries($boundaries);

		$appraisal = [
			'pin'	=> $data['pin'],
			'appraised_value' => str_replace(',', '', $data['appraised_value']),
			'date_appraised'	=> $data['date_appraised'],
			'base_value' 	=> str_replace(',', '', $data['base_value']),
			'revision'	=> $this->session->current_revision
		];
		$this->RealProperty_model->add_appraisal($appraisal);		

		if(!empty($_POST['kind'])){
			$ctr = count($_POST['kind']);
	        for($i = 0; $i<$ctr; $i++){
				$improvements = ['pin' => $this->input->post('pin'),
					'kind' => $this->input->post("kind[$i]"),
					'total_number' =>  $this->input->post("total_number[$i]")
				];
			
				$this->RealProperty_model->add_improvements($improvements);
			}
		}

		// if(!empty($_POST['bmv'])){
		// 	$ctr = count($_POST['bmv']);
	 //        for($i = 0; $i<$ctr; $i++){
		// 		$property_mv = ['PIN' => $data['pin'],
		// 			'bmv' => $this->input->post("bmv[$i]"),
		// 			'adjustments' =>  $this->input->post("adjustments[$i]"),
		// 			'percent_adjustment' =>  $this->input->post("percent_adjustment[$i]"),
		// 			'value_adjustment' =>  $this->input->post("value_adjustment[$i]"),
		// 			'adj_market_value' =>  $this->input->post("adj_market_value[$i]")
		// 		];
			
		// 		$this->RealProperty_model->add_property_market_value($property_mv);
		// 	}
		// }
		$appraisal_id = $this->RealProperty_model->getAppraisalId($appraisal);
		$assessment = [
			'appraisal_id'	=> $appraisal_id,
			'assess_level' => $data['assess_level'],
			'assessment_value'	=> str_replace(',', '', $data['assessment_value'])
		];
		if($this->RealProperty_model->add_assessment($assessment)){
			$janend = date('Y-m-d', strtotime('last day of january this year'));
			if($data['taxable'] == 'Taxable'){
				$assess_id = $this->RealProperty_model->getAssessId($assessment);
				$tax_data = [
					'assess_id'	=> $assess_id,
					'tax_amount' => $tax_amt,
					'due_date'	=> $janend,
					'status'	=> 0,
					'payment_type' => 0
				];
				if($this->RealProperty_model->add_taxing($tax_data))

					return $u_name;
			}
			
		}

		return false;

	}

	public function _do_add_building($data)
	{
		// print_r($data);
	$this->load->model('User_model');
	$u_name = strtolower(str_replace(' ', '', $data['fname']).'.'.str_replace(' ', '', $data['lname']));
	$exist = $this->User_model->checkExistUsername($u_name);
	if($exist){
		$pin = substr($data['pin'], 14);
		$u_name = $u_name.'.'.$pin;
	}
		$this->load->model('Owner_model');
		
		$this->load->model('RealProperty_model');
		if(!empty($data['owner_on'] == 'new')){
			$owner_data = [
				'fname' 	=> $data['fname'],
				'mname' 	=> $data['mname'],
				'lname' 	=> $data['lname'],
				'address' 	=> $data['address'],
				'contact' 	=> $data['contact'],
				'email'		=> $data['email'],
				'beneficial'=> $data['beneficial'],
				'ben_add'	=> $data['ben_add'],
				'ben_tel'	=> $data['ben_tel']
			];
			
		
			$this->Owner_model->add($owner_data);
		
			$user_id = $this->User_model->get_userid($owner_data);
			
			// $u_name = $data['fname'].'.'.$data['lname'].'.'.$pin;
			$user_data = [
				'user_id'	=> $user_id,
				'user_name'	=> $u_name,
				'password'	=> sha1('12345678'),
				'user_type'	=> 'owner',
				'active' => '1',
				'token'	=> sha1($this->input->post('email'))
			];
		
			$this->User_model->add_user($user_data);
			$owner_id = $this->User_model->get($user_data);
		}else{
			$owner_id = $data['owner_id'];
		}
		
		
		if($data['taxable'] == 'Taxable'){
			$AV = str_replace(',', '', $data['assessed_value']);
			$taxable = 1;
			$tax_amt = $AV*.02;
		}
		else{
			$taxable = 0;
		}
	
			$real_property_data = [
				'pin'		=> $data['pin'],
				'cadastral_lot_no'	=> '',
				'type_of_property'	=> 'building',
				'owner_id'	=> $owner_id,
				'brgy_id'	=> $data['brgy_id'],
				'area'		=> $data['area'],
				'taxable'	=> $taxable,
				'classification' => $data['category'],
				'sub_class'	=> $data['sub_class'],
				'sub_type'	=> ''
			];
		
			$this->RealProperty_model->add($real_property_data);

		$appraisal = [
			'pin'	=> $data['pin'],
			'appraised_value' => str_replace(',', '', $data['adjusted_market_value']),
			'date_appraised'	=> $data['date_appraised'],
			'base_value'	=> str_replace(',', '', $data['base_value']),
			'revision'	=> $this->session->current_revision
		];
		$this->RealProperty_model->add_appraisal($appraisal);		

		$appraisal_id = $this->RealProperty_model->getAppraisalId($appraisal);
		$assessment = [
			'appraisal_id'	=> $appraisal_id,
			'assess_level' => $data['assess_level'],
			'assessment_value'	=> str_replace(',', '', $data['assessed_value'])
		];
		if($this->RealProperty_model->add_assessment($assessment)){
			$janend = date('Y-m-d', strtotime('last day of january this year'));
			if($data['taxable'] == 'Taxable'){
				$assess_id = $this->RealProperty_model->getAssessId($assessment);
				$tax_data = [
					'assess_id'	=> $assess_id,
					'tax_amount' => $tax_amt,
					'due_date'	=> $janend,
					'status'	=> 0,
					'payment_type' => 0
				];
				if($this->RealProperty_model->add_taxing($tax_data))

					return $u_name;
			}
			
		}

		return false;
	}

	public function _do_add_machinery($data)
	{
		// print_r($data);
	$this->load->model('User_model');
	
		$this->load->model('Owner_model');
		
		$this->load->model('RealProperty_model');
		if(!empty($data['owner_on'] == 'new')){
			$u_name = strtolower(str_replace(' ', '', $data['fname']).'.'.str_replace(' ', '', $data['lname']));
				$exist = $this->User_model->checkExistUsername($u_name);
				if($exist){
					$pin = substr($data['pin'], 14);
					$u_name = $u_name.'.'.$pin;
				}
			
			$owner_data = [
				'fname' 	=> $data['fname'],
				'mname' 	=> $data['mname'],
				'lname' 	=> $data['lname'],
				'address' 	=> $data['address'],
				'contact' 	=> $data['contact'],
				'email'		=> $data['email'],
				'beneficial'=> $data['beneficial'],
				'ben_add'	=> $data['ben_add'],
				'ben_tel'	=> $data['ben_tel']
			];
			
		
			$this->Owner_model->add($owner_data);
		
			$user_id = $this->User_model->get_userid($owner_data);
			
			// $u_name = $data['fname'].'.'.$data['lname'].'.'.$pin;
			$user_data = [
				'user_id'	=> $user_id,
				'user_name'	=> $u_name,
				'password'	=> sha1('12345678'),
				'user_type'	=> 'owner',
				'active' => '1',
				'token'	=> sha1($this->input->post('email'))
			];
		
			$this->User_model->add_user($user_data);
			$owner_id = $this->User_model->get($user_data);
		}else{
			$owner_id = $data['owner_id'];
		}
		
		
		if($data['taxable'] == 'Taxable'){
			$AV = str_replace(',', '', $data['assessed_value']);
			$taxable = 1;
			$tax_amt = $AV*.02;
		}
		else{
			$taxable = 0;
		}
	
			$real_property_data = [
				'pin'		=> $data['pin'],
				'cadastral_lot_no'	=> '',
				'type_of_property'	=> 'machinery',
				'owner_id'	=> $owner_id,
				'brgy_id'	=> $data['brgy_id'],
				'area'		=> '',
				'taxable'	=> $taxable,
				'classification' => $data['classification'],
				'sub_class'	=> $data['property_type'],
				'sub_type'	=> ''
			];
		
			$this->RealProperty_model->add($real_property_data);

		$appraisal = [
			'pin'	=> $data['pin'],
			'appraised_value' => str_replace(',', '', $data['appraised_value']),
			'date_appraised'	=> $data['date_appraised'],
			'base_value'	=> $data['original_cost'],
			'used_life'		=> $data['used_life'],
			'economic_life'	=> $data['economic_life'],
			'revision'	=> $this->session->current_revision
		];
		$this->RealProperty_model->add_appraisal($appraisal);		

		$appraisal_id = $this->RealProperty_model->getAppraisalId($appraisal);
		$assessment = [
			'appraisal_id'	=> $appraisal_id,
			'assess_level' => $data['assess_level'],
			'assessment_value'	=> str_replace(',', '', $data['assessed_value'])
		];
		if($this->RealProperty_model->add_assessment($assessment)){
			$janend = date('Y-m-d', strtotime('last day of january this year'));
			if($data['taxable'] == 'Taxable'){
				$assess_id = $this->RealProperty_model->getAssessId($assessment);
				$tax_data = [
					'assess_id'	=> $assess_id,
					'tax_amount' => $tax_amt,
					'due_date'	=> $janend,
					'status'	=> 0,
					'payment_type' => 0
				];
				if($this->RealProperty_model->add_taxing($tax_data))

					return $u_name;
			}
			
		}

		return false;
	}

	public function getOName($id, $tbl)
	{
		// $field = "concat_ws(' ', fname,mnane,lname) AS name";
		$name = $this->User_model->getFullName($id,  'owner_id',$tbl);

		return $name;
	}

	public function get_building_value(){
		$sbuv_id = $this->input->get('sbuv_id');
		$this->load->model('RealProperty_model');
		$value = $this->RealProperty_model->getBuildingValue($sbuv_id);
		
		echo $value;
	}

	public function _reassessment_reappraisal_retaxing()
	{
		//hhey don't forget to change the nmber in the condition at RRR model to much higher value in te future
		$this->load->model('RealProperty_model');
		$this->load->model('RRR_model');
		$properties = $this->RealProperty_model->compute_RRR();
		$date_appraised = date('Y-m-d');
		$revision = $this->session->current_revision;
		// check if reappraisal hhas been made already
		if($this->RRR_model->check_date_appraisal($date_appraised)){
			// echo 'TRUE';
		foreach ($properties as $key => $value) {
			if ($value->type_of_property == 'land') {
				if($value->classification == 'agricultural'){
					//parameters sub_class, sub_type
					//get base value for this type of property
					$base_value = $this->RRR_model->getagribasevalue($value->sub_class, $value->sub_type, $revision);

				}else if($value->classification == 'residential'){
					$base_value = $this->RRR_model->getresidentialbasevalue($value->sub_type, 'residential', $revision);

				}else if($value->classification == 'industrial'){
					$base_value = $this->RRR_model->getresidentialbasevalue($value->sub_type, 'industrial', $revision);
					
				}else if($value->classification == 'commercial'){
					$base_value = $this->RRR_model->getresidentialbasevalue($value->sub_type, 'commercial', $revision);

				}
			}else if($value->type_of_property == 'building'){
				//parameters sub_class, sub_type
				$base_value = $this->RRR_model->getbuildingbasevalue($value->sub_class, $value->sub_type, $revision);
				
			}else{
				$base_value = 0;
			}

			$appraised_value = 0;
			$appraised_value = round($value->area*$base_value, -1);

					$appraisal = [
						'pin'	=> $value->pin,
						'appraised_value' => $appraised_value,
						'date_appraised'	=> $date_appraised,
						'base_value'	=> $base_value,
						'revision'	=> $revision
					];
					//add appraisal
					$this->RealProperty_model->add_appraisal($appraisal);		

					$appraisal_id = $this->RealProperty_model->getAppraisalId($appraisal);
					$assess_level = $this->RRR_model->getAssessLevel($value->pin);
					$assessment_value = ($appraised_value*($assess_level/100));
					$assessment = [
						'appraisal_id'	=> $appraisal_id,
						'assess_level' => $assess_level,
						'assessment_value'	=> $assessment_value
					];
					//add assessment
					$this->RealProperty_model->add_assessment($assessment);
					$janend = date('Y-m-d', strtotime('last day of january this year'));
					$tax_amt = $assessment_value*0.02;
					if($value->taxable == 1){
						$assess_id = $this->RealProperty_model->getAssessId($assessment);
						$tax_data = [
							'assess_id'	=> $assess_id,
							'tax_amount' => $tax_amt,
							'due_date'	=> $janend,
							'status'	=> 0,
							'payment_type' => 0
						];

					//add taxing
					$this->RealProperty_model->add_taxing($tax_data);
					}


			}
			$this->define_tax_dec($date_appraised);
			$this->User_model->activity_log("Reassessment for the year $year");
		}
	}

	public function define_tax_dec($date_appraised)
	{
		$this->load->model('RealProperty_model');
		$realproperties = $this->RealProperty_model->getAllPropertyThisYear($date_appraised);
		$cnt = 1;
		foreach ($realproperties as $value) {
			if($cnt <99)
				$tax_dec = '00-00000-000'.$cnt;
			else
				$tax_dec = '00-00000-00'.$cnt;

			$cnt++;
			$this->RealProperty_model->set_tax_dec($value->pin, $value->date_appraised,$tax_dec);
		}
	}

	public function update_appraisal($table, $sub_class = '')
	{
		$this->load->model('RealProperty_model');
		if($table == 'tbl_sfmv_building'){
			if($sub_class != '')
				$properties = $this->RealProperty_model->buildingPropertyUpdate($sub_class);
			else
				$properties = $this->RealProperty_model->buildingPropertyUpdateAllClass();
			// var_dump($properties);
			$this->_do_update_appraisal($properties);
		}else if($table == 'tbl_sfmv_agri_land'){
			$classification = 'agricultural';
			if($sub_class != '')
				$properties = $this->RealProperty_model->agricultralPropertyUpdate($table, $classification, $sub_class);
			else
				$properties = $this->RealProperty_model->agricultralPropertyUpdateAllClass();
			// var_dump($properties);
			$this->_do_update_appraisal($properties);
		}else if($table == 'tbl_sfmv_rci_land'){
			if($sub_class != '')
				$properties = $this->RealProperty_model->RCILandPropertyUpdate($sub_class);
			else
				$properties = $this->RealProperty_model->RCILandPropertyUpdateAllClass();
			// var_dump($properties);
			$this->_do_update_appraisal($properties);
		}
	}

	public function _do_update_appraisal($properties)
	{
		$this->load->model('RRR_model');
		$revision = $this->session->current_revision;
		foreach ($properties as $key => $value) {
			if ($value->type_of_property == 'land') {
				if($value->classification == 'agricultural'){
					//parameters sub_class, sub_type
					//get base value for this type of property
					$base_value = $this->RRR_model->getagribasevalue($value->sub_class, $value->sub_type, $revision);

				}else if($value->classification == 'residential'){
					$base_value = $this->RRR_model->getresidentialbasevalue($value->sub_type, 'residential', $revision);

				}else if($value->classification == 'industrial'){
					$base_value = $this->RRR_model->getresidentialbasevalue($value->sub_type, 'industrial', $revision);
					
				}else if($value->classification == 'commercial'){
					$base_value = $this->RRR_model->getresidentialbasevalue($value->sub_type, 'commercial', $revision);

				}
			}else if($value->type_of_property == 'building'){
				//parameters sub_class, sub_type
				$base_value = $this->RRR_model->getbuildingbasevalue($value->sub_class, $value->sub_type, $revision);
				
			}else{
				$base_value = 0;
			}

			$appraised_value = 0;
			$appraised_value = round($value->area*$base_value, -1);

					$appraisal = [
						'appraised_value' => $appraised_value,
						'base_value'	=> $base_value
					];
					//add appraisal
					$this->RealProperty_model->update_appraisal($value->appraisal_id,$appraisal);		

					$assessment_value = ($appraised_value*($value->assess_level/100));
					$assessment = [
						'assessment_value'	=> $assessment_value
					];
					//add assessment
					$this->RealProperty_model->update_assessment($value->assess_id,$assessment);
					// $janend = date('Y-m-d', strtotime('last day of january this year'));
					$tax_amt = $assessment_value*0.02;
					if($value->taxable == 1){
						$assess_id = $this->RealProperty_model->getAssessId($assessment);
						$tax_data = [
							'tax_amount' => $tax_amt,
						];

					//add taxing
					$this->RealProperty_model->update_taxing($value->tax_id,$tax_data);
					}
			}
	}

}