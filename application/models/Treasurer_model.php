<?php 
class Treasurer_model extends CI_Model {

	private $back_account = false;
	private $taxIDs = array();

	public function add($data)
	{
		return $this->db->insert('tbl_owner', $data);
	}

	public function send($data)
	{
		return $this->db->insert('tbl_message', $data);;
	}

	public function getPayments()
	{
		$query = "SELECT * FROM tbl_tax_payment LEFT JOIN tbl_real_property using(pin) LEFT JOIN tbl_owner using(owner_id) LEFT JOIN tbl_barangay using(brgy_id) LEFT JOIN tbl_tax using(tax_id)";

		$results = $this->db->query($query);

		return $results->result();
	}

	public function getDelinquents()
	{
		// $q = $this->db->query("SELECT due_date FROM tbl_tax LEFT JOIN tbl_assessment using(assess_id) LEFT JOIN tbl_appraisal using(appraisal_id) LEFT JOIN tbl_real_property using(pin) LEFT JOIN tbl_owner using(owner_id) LEFT JOIN tbl_barangay using(brgy_id) WHERE status = 0 AND pin='$pin'");

		$query = "SELECT * FROM tbl_tax LEFT JOIN tbl_assessment using(assess_id) LEFT JOIN tbl_appraisal using(appraisal_id) LEFT JOIN tbl_real_property using(pin) LEFT JOIN tbl_owner using(owner_id) LEFT JOIN tbl_barangay using(brgy_id) WHERE status = 0 GROUP BY pin ORDER BY tbl_owner.lname ASC";

		$results = $this->db->query($query);

		return $results->result();
	}

	public function update_email($id, $pass)
	{
		$this->db->where('owner_id', $id);
		return $this->db->update('tbl_owner', ['email' => $pass]);
	}

	public function feedback($data)
	{
		return $this->db->insert('tbl_feedback', $data);;
	}

	public function get_inbox($user_id)
	{
		// $pin = $this->_get_property_pin($user_id);
		$query = "SELECT message_id, barangay_name, classification, pin, m.owner_id as owner_id, visitor_name, visitor_contact, visitor_message, status FROM tbl_message as m LEFT JOIN tbl_real_property as r using(pin) LEFT JOIN tbl_barangay as b  ON r.brgy_id=b.brgy_id where m.owner_id = $user_id";
		$result = $this->db->query($query);
		return $result->result();
	}

	public function get_inbox_count($user_id)
	{
		$query = "SELECT COUNT(*) as count FROM tbl_message where owner_id = $user_id AND status = 0";
		$result = $this->db->query($query);
		return $result->row();	
	}
	

	public function get_message_count($user_id)
	{
		$query = "SELECT COUNT(*) as count FROM tbl_message where owner_id = $user_id";
		$result = $this->db->query($query);
		return $result->row();	
	}

	public function status_read($id)
	{
		$this->db->where('message_id', $id);
		$this->db->update('tbl_message', ['status' => 1]);
	}
	public function get_data_field($id, $field)
	{
		$this->db->select($field);
		$this->db->where('message_id', $id);
		$query = $this->db->get('tbl_message');

		return $query->row();
	}

	public function delete_message($delete)
	{
		$this->db->where('message_id', $delete);
		return $this->db->delete('tbl_message');
	}

	public function getTax($pin, $wba)
	{
		$year = date('Y');
		//check for back accounts
		$back_accounts = $this->db->query("SELECT COUNT(*) as back_accounts, due_date, tax_id FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) LEFT JOIN tbl_tax using(assess_id) WHERE pin='$pin' AND status=0");
		$row = $back_accounts->row();

		if(($row->back_accounts > 0) && (substr($row->due_date, 0, 4) < $year) && ($wba == true)){
			$query = $this->db->query("SELECT tax_amount, due_date, assessment_value, tax_id, status, taxable from tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) LEFT JOIN tbl_tax using(assess_id) WHERE pin='$pin' AND status = 0 LIMIT 1");
			$this->setBackAccount(true);
		}else{
			$query = $this->db->query("SELECT tax_amount, due_date, assessment_value, tax_id, status, taxable from tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) LEFT JOIN tbl_tax using(assess_id) WHERE pin='$pin' AND date_appraised BETWEEN '$year-01-01' AND '$year-12-31'");
			$this->setBackAccount(false);
			$this->setPinTaxID('');
		}
		// var_dump($query->result());
		return $query->result();

	}

	public function getTaxIDThisYear($pin)
	{
		$query = $this->db->query("SELECT tax_id, status from tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) LEFT JOIN tbl_tax using(assess_id) WHERE pin='$pin' AND status = 0 ORDER BY due_date ASC");
		$taxIDs = array();
		foreach ($query->result() as $value) {
			$taxIDs[] = $value->tax_id;
		}
		return $taxIDs[count($taxIDs) -1];
	}

	public function getBackAccount()
	{
		return $this->back_account;
	}

	public function setBackAccount($value='')
	{
		$this->back_account = $value;
	}

	public function setPinTaxID($value='')
	{
		$this->taxIDs = $value;
	}

	public function getPinTaxID()
	{
		return $this->taxIDs;
	}

	public function search($data)
	{
		$year =date('Y');
		$query = $this->db->query("SELECT * FROM tbl_owner JOIN tbl_real_property using(owner_id) JOIN tbl_barangay using(brgy_id) JOIN tbl_appraisal using(pin) WHERE date_appraised BETWEEN '$year-01-01' AND '$year-12-31' AND fname LIKE '%$data%' OR lname LIKE '%$data%' OR mname LIKE '%$data%' ORDER BY date_appraised DESC LIMIT 10");

		return $query->result();
	}

	public function update_tbltax($id, $data)
	{
		$this->db->where('tax_id', $id);
		return $this->db->update('tbl_tax', ['status' => $data['status'], 'payment_type' => $data['payment_type']]);
	}

	public function save_tax_payment($data)
	{
		return $this->db->insert('tbl_tax_payment', $data);
	}
	public function getCountPayQuarterly($id)
	{
		$query = $this->db->query("SELECT pay_count FROM tbl_quarterly WHERE tax_id = $id");

		$row = $query->row();
		if(empty($row->pay_count) || $row->pay_count == 0 || $row->pay_count == '' )
			return 0;
		else 
		 	return $row->pay_count; 
	}

	public function insert_quarterly($data)
	{
		return $this->db->insert('tbl_quarterly', $data);
	}

	public function update_quarterly_count($id, $data)
	{
		$this->db->where('tax_id', $id);
		return $this->db->update('tbl_quarterly', $data);
	}

	public function getTblQuarterlyById($id)
	{

		$query = $this->db->query("SELECT * FROM tbl_quarterly WHERE tax_id = $id");

		return $query->result();
	}

	public function getDiscount()
	{
		$query = $this->db->query("SELECT discount FROM tbl_discount LIMIT 1");
		$row = $query->row();

		return $row->discount;
	}

	public function updateDiscount($value)
	{
		return $this->db->update('tbl_discount', ['discount' => $value]);
	}

	public function update_email_staff($id, $pass)
	{
		$this->db->where('staff_id', $id);
		return $this->db->update('tbl_staff', ['email' => $pass]);
	}
}

