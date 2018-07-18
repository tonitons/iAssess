<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Treasurer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
		$this->load->model('User_model');
		$this->load->model('Site_model');
		$this->load->model('Signatory_model');
	}

	public function index()
	{
		$this->User_model->forTreasurerOnly();
		$data['title'] = 'TAX PAYMENTS';
		$data['css'] = array('land_mgt','Pretty-Registration-Form', 'modal', 'datepicker');
		$data['js'] = array('datatables','treasurer', 'bootstrap-datepicker');
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		$this->load->model('Owner_model');
		$datetoday = date('Y-m-d');
		$year = date('Y');
		
		$this->load->model('Treasurer_model');
		$this->session->mark_as_flash('message');
		if(!empty($this->input->post())){
			// var_dump($this->input->post());
			if($this->input->post('payment_type') == 'yearly'){
				$payment_type = 'yearly';
				$status = 2;
			}else {
				//quarterly
				$payment_type = 'quarterly';
				$status = 1;
				$first = $this->Treasurer_model->getCountPayQuarterly($this->input->post('tax_id'));
				$count = 0;
				$tbl_quarterly_data = [
						'tax_id' => $this->input->post('tax_id'),
						'pin' 	=> $this->input->post('pin'),
						'quarterly_payment' => str_replace(',', '', $this->input->post('amount_due')),
						'pay_count' => $count
					];
				if(empty($first) || $first == 0 || $first == ''){
					$count = 1;
					$tbl_quarterly_data['pay_count'] = $count;
					$this->Treasurer_model->insert_quarterly($tbl_quarterly_data);
				}else{
					$count = ++$first;
					$tbl_quarterly_data['pay_count'] = $count;
					$this->Treasurer_model->update_quarterly_count($this->input->post('tax_id'), $tbl_quarterly_data);
				}				

			}
			$tbl_tax_data = [
				'status' => $status,
				'payment_type' => $payment_type
			];
			$month_delinquency = !empty($this->input->post('month_delinquency')) ? $this->input->post('month_delinquency') : 0;
			$penalty_amount = !empty($this->input->post('penalty_amount')) ? $this->input->post('penalty_amount') : 0;

			
			if($this->Treasurer_model->update_tbltax($this->input->post('tax_id'), $tbl_tax_data)){
				$tbl_payment_data = [
					'tax_id' 	=> $this->input->post('tax_id'),
					'pin'		=> $this->input->post('pin'),
					'amount_received' => str_replace(',', '', $this->input->post('amount_due')),
					'pay_date'	=> $this->input->post('date_pay'),
					'month_delinquency' => $month_delinquency,
					'penalty_amount' 	=> $penalty_amount,
					'staff_id' 			=> $this->session->user_id
				];
				if($this->Treasurer_model->save_tax_payment($tbl_payment_data)){
					$this->session->set_flashdata('message', [
							'status'=>'success',
							'message'=> 'Tax Payment has been saved!'
						]);
					$this->User_model->activity_log('Accepted tax payment with PIN: '.$this->input->post('pin'));
				}else{
					$this->session->set_flashdata('message', [
							'status'=>'success',
							'message'=> 'Error saving tax payment. Please try again.'
						]);
				}
				//if payment for this year is included
				if($this->input->post('tax_this_year') == 1){
					$tax_id = $this->Treasurer_model->getTaxIDThisYear($this->input->post('pin'));
					$this->Treasurer_model->update_tbltax($tax_id, $tbl_tax_data);
					$tbl_payment_data = [
						'tax_id' 	=> $tax_id,
						'pin'		=> $this->input->post('pin'),
						'amount_received' => str_replace(',', '', $this->input->post('amount_due1')),
						'pay_date'	=> $this->input->post('date_pay'),
						'month_delinquency' => $this->input->post('month_delinquency1'),
						'penalty_amount' 	=> $this->input->post('penalty_amount1'),
						'staff_id'	=> $this->session->user_id
					];

					$this->Treasurer_model->save_tax_payment($tbl_payment_data);

				}
				
				$data['message'] = $this->session->flashdata('message');
				
			}


		}
		
		$this->load->view('template/header', $data);
		$this->load->view('template/treas_nav');
		$this->load->view('treasurer/index', $data);
		$this->load->view('template/footer', $data);
	}

	public function list()
	{
		$this->User_model->forTreasurerOnly();
		$data['title'] = 'TAX PAYMENTS';
		$data['css'] = array('land_mgt','Pretty-Registration-Form', 'datatables');
		$data['js'] = array('datatables', 'treasurer');
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		$this->load->model('Treasurer_model');

		$data['payment_list'] = $this->Treasurer_model->getPayments();

		$this->load->view('template/header', $data);
		$this->load->view('template/treas_nav');
		$this->load->view('treasurer/payment_list', $data);
		$this->load->view('template/footer', $data);
	}

	public function delinquent()
	{
		$this->User_model->forTreasurerOnly();
		$data['title'] = 'TAX PAYMENTS';
		$data['css'] = array('land_mgt','Pretty-Registration-Form','datatables');
		$data['js'] = array('datatables', 'mv_land', 'treasurer');
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		$this->load->model('Treasurer_model');

		$data['delinquent_list'] = $this->Treasurer_model->getDelinquents();

		$this->load->view('template/header', $data);
		$this->load->view('template/treas_nav');
		$this->load->view('treasurer/delinquent', $data);
		$this->load->view('template/footer', $data);
	}

	public function security()
	{
		$this->User_model->forTreasurerOnly();

		$data['title'] = 'Security';
		$data['css'] = array('land_mgt','Pretty-Registration-Form', 'modal');
		$data['js'] = array('owner');
		$data['font'] = array();

		$data['detail'] = $this->Site_model->get();
		$this->load->model('Treasurer_model');
		$this->load->model('Owner_model');
		$this->load->library('form_validation');

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
		}else if(!empty($this->input->post('email'))){
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

		// $data['delinquent_list'] = $this->Treasurer_model->getDelinquents();
		$data['validation'] = $this->session->flashdata('message');
		$data['my_questions'] = $this->Site_model->get_mySecurityQuestions($this->session->user_id);
		$data['email'] = $this->Owner_model->getEmailStaff($this->session->user_id);
		$data['questions'] = $this->Site_model->getSecurityQuestions($this->session->user_id);
		$data['count_qs'] = $this->Site_model->getCountQs($this->session->user_id);


		$this->load->view('template/header', $data);
		$this->load->view('template/treas_nav');
		$this->load->view('treasurer/security', $data);
		$this->load->view('template/footer', $data);
	}

	public function getTaxAmount()
	{
		// echo "NAK discount????";
		// check for back accounts
		$pin = $this->input->get('pin');

		$this->load->model('Treasurer_model');
		//$due_date = $this->getLastdayofFirstMonth();
		$taxamount = $this->Treasurer_model->getTax($pin, true);
		$back_accounts = $this->Treasurer_model->getBackAccount();
		$data['back_accounts'] = $back_accounts;
		// $duedate = strtotime('2017-01-31');
		$datetoday = strtotime(date('Y-m-d'));		
		$tax_this_year = 0;
		$year = date('Y');
		// var_dump($this->Treasurer_model->getTaxIDThisYear($pin));
		if($back_accounts){
			$tax_this_year = $this->getTaxThisYear($pin);	
		}

		$data['tax_this_year'] = $tax_this_year;
		foreach ($taxamount as $value) {
			$tax = $value->tax_amount;
			$due_date = strtotime($value->due_date);
			$datedue = $value->due_date;
			$assess_value = $value->assessment_value;
			$divisor = 2592000;
			if (date('Y-m-d') >= "$year-02-28")
				$divisor = $divisor - 86400;
			$datediff = intval(($due_date - $datetoday)/$divisor);
			
			$tax_id = $value->tax_id;
			$status = $value->status;
			$data['taxable'] = $value->taxable;
		}
		$year = date('Y');

		$add =0;
		// var_dump(strtotime("$year-01-31"));
		// var_dump(strtotime(date('Y-m-d')));
		if($datetoday > $due_date && strtotime(date('Y-m-d')) > strtotime("$year-01-31"))
			$add =1;

		$datediff1 = abs($datediff-$add);
		// var_dump($datediff1);
		// var_dump($add);
		$discount = $this->Treasurer_model->getDiscount();
		$data['discount_percent'] = ($discount/100);
		if(date('Y-m-d') >= "$year-01-01" && date('Y-m-d') <= "$year-03-31" && $datediff1 <= 3 && $back_accounts == false){
			$w_discount = true;
			$totaltax = $tax - ($tax * ($discount/100));
			$pen = 0;
			$datediff1 = 0;
			$data['discount_amt'] = number_format($tax * ($discount/100), 2);
		}
		else{
			$w_discount = false;
			if($datediff1 >= 72)
				$datediff1 = 72;

			$pen = ($tax * ($datediff1 * 0.02));
			$totaltax = ($pen + $tax);
		}
		if($tax_this_year['totaltax'] > 0)
			$totaltax = $totaltax + $tax_this_year['totaltax'];
		$data['datediff'] = $datediff1;		
		
		$data['penalty'] = number_format($pen, 2);
		$data['discounted'] = $w_discount;
		
		$data['totaltax'] = number_format($totaltax, 2);
		$data['tax'] = number_format($tax, 2);
		$data['duedate'] = $datedue;
		$data['assessment_value'] = number_format($assess_value, 2);
		$data['tax_id'] = $tax_id;
		$data['status'] = $status;

		// echo $data['totaltax'];
		if($status == 1){
			$payment_data = $this->Treasurer_model->getTblQuarterlyById($tax_id);
			foreach ($payment_data as $value) {
				$quarterly_payment = $value->quarterly_payment;
				$pay_count = $value->pay_count;
			}
			$data['quarterly_payment'] = $quarterly_payment;
			$data['pay_count'] = $pay_count;
 			$this->load->view('additionals/tax_view_quarterly', $data);
		}else
 			$this->load->view('additionals/tax_view_yearly', $data);
		// foreach ($taxamount as $key => $value) {
			
		// }
	}

	public function searchOwner()
	{
		$squery = $this->input->get('name');
		$this->load->model('Treasurer_model');
		$data['search_results'] = $this->Treasurer_model->search($squery);

		$this->load->view('additionals/search_owner_with_pin', $data);
	}

	private function getTaxThisYear($pin)
	{
		$tax_this_year = $this->Treasurer_model->getTax($pin, false);
		$datetoday = strtotime(date('Y-m-d'));	
		foreach ($tax_this_year as $value) {
			$tax = $value->tax_amount;
			$due_date = strtotime($value->due_date);
			$datedue = $value->due_date;
			$assess_value = $value->assessment_value;
			$datediff = intval(($due_date - $datetoday)/2635200);
			$tax_id = $value->tax_id;
			$status = $value->status;
		}
		$year = date('Y');

		$add =0;
		if($datetoday > $due_date)
			$add =1;
		$discount = $this->Treasurer_model->getDiscount();
		$datediff1 = abs($datediff-$add);
		if(date('Y-m-d') >= "$year-01-01" && date('Y-m-d') <= "$year-03-31" && $datediff1 <= 3){
			$w_discount = true;
			$totaltax = $tax - ($tax * ($discount/100));
			$pen = 0;
			$datediff1 = 0;
		}
		else{
			$w_discount = false;
			$pen = ($tax * ($datediff1 * 0.02));
			$totaltax = ($pen + $tax);
		}

		return array('totaltax' =>$totaltax, 'months' => $datediff1, 'penalty_amount' => $pen, 'w_discount' => $w_discount);

	}

	public function getLastdayofFirstMonth()
	{
		
	}

	public function Reassessment()
	{
		
	}
}