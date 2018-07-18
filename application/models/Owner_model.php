<?php 
class Owner_model extends CI_Model {

	public function add($data)
	{
		return $this->db->insert('tbl_owner', $data);
	}

	public function send($data)
	{
		return $this->db->insert('tbl_message', $data);;
	}

	public function get_properties($owner_id)
	{
		$query = "SELECT r.pin, cadastral_lot_no, area, barangay_name, classification, sub_class, sub_type, appraised_value, pay_date, assessment_value, a.revision, tax_amount, status, date_appraised, agri_land, due_date, amount_received, base_value FROM tbl_owner LEFT JOIN tbl_real_property as r using(owner_id) LEFT JOIN tbl_barangay using(brgy_id) LEFT JOIN tbl_appraisal as a using(pin) LEFT JOIN tbl_assessment using(appraisal_id) LEFT JOIN tbl_tax AS t using(assess_id) LEFT JOIN tbl_sfmv_agri_land as s ON  r.sub_class=s.agri_id LEFT JOIN tbl_tax_payment using (tax_id) WHERE owner_id= $owner_id";

		$res = $this->db->query($query);

		return $res->result();
	}

	public function update_pass($id, $pass)
	{
		$this->db->where('user_id', $id);
		return $this->db->update('tbl_user', ['password' => sha1($pass)]);
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
		$query = "SELECT message_id, barangay_name, classification, pin, m.owner_id as owner_id, visitor_name, visitor_contact, visitor_message, status, date_received FROM tbl_message as m LEFT JOIN tbl_real_property as r using(pin) LEFT JOIN tbl_barangay as b  ON r.brgy_id=b.brgy_id where m.owner_id = $user_id ORDER BY status, date_received DESC";
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

	public function search($data)
	{
		$query = $this->db->query("SELECT * FROM tbl_owner WHERE fname LIKE '%$data%' OR lname LIKE '%$data%' OR mname LIKE '%$data%' LIMIT 10");

		return $query->result();
	}

	public function get_payments($owner_id)
	{
		$query = "SELECT * FROM tbl_tax_payment LEFT JOIN tbl_real_property using(pin) LEFT JOIN tbl_tax using(tax_id) LEFT JOIN tbl_barangay using(brgy_id) LEFT JOIN tbl_staff using(staff_id) WHERE owner_id = $owner_id" ;
		$result = $this->db->query($query);
		return $result->result();

		// $query = "SELECT status FROM tbl_tax_payment LEFT JOIN tbl_real_property using(pin) LEFT JOIN tbl_tax using(tax_id) LEFT JOIN tbl_barangay using(brgy_id) WHERE owner_id = $owner_id" ;
		// $result = $this->db->query($query);

		// $row = $result->row();

		// if($row->status == 1){
		// 	$query = "SELECT status FROM tbl_tax_payment LEFT JOIN tbl_real_property using(pin) LEFT JOIN tbl_tax using(tax_id) LEFT JOIN tbl_barangay using(brgy_id) WHERE owner_id = $owner_id" ;
			
		// }else{

		// }
		// $result = $this->db->query($query);
		// return $result->result();
	}

	public function getQuarterlyPayCount($tax_id)
	{
		$query = $this->db->query("SELECT pay_count FROM tbl_quarterly WHERE tax_id = $tax_id");
		$row = $query->row();
		return $row->pay_count;
	}

	public function getEmail($id)
	{
		$query = $this->db->query("SELECT email FROM tbl_owner WHERE owner_id='$id'");
		$row = $query->row();
		return $row->email;
	}

	public function getEmailStaff($id)
	{
		$query = $this->db->query("SELECT email FROM tbl_staff WHERE staff_id=$id");
		$row = $query->row();
		return $row->email;
	}

	public function check_old_pass($id, $oldpass)
	{
		$pass = sha1($oldpass);
		$query = $this->db->query("SELECT COUNT(*) as count FROM tbl_user WHERE password = '$pass' AND user_id =$id");
		$row = $query->row();
		if($row->count > 0)
			return true;

		return false;
	}

	public function getOwnername($id)
	{
		$query = $this->db->query("SELECT fname, mname, lname FROM tbl_owner WHERE owner_id=$id");
		$row = $query->row();

		$name = $row->fname.' '.substr($row->mname, 0, 1).'. '.$row->lname;
		return $name;
	}

	public function getContactNumber($id)
	{
		$query = $this->db->query("SELECT contact FROM tbl_owner WHERE owner_id = $id");

		$row = $query->row();
		return $row->contact;
	}
	public function saveOldContact($id, $data)
	{
		// $this->db->where('owner_id', $id);
		return $this->db->insert('tbl_old_contacts', ['owner_id' => $id, 'contact_no' => $data]);
	}

	public function update_contact($id, $data)
	{
		$this->db->where('owner_id', $id);
		return $this->db->update('tbl_owner', ['contact' => $data]);
	}
}

