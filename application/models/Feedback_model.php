<?php 
class Feedback_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function getAll()
	{
		$query = $this->db->query("SELECT concat_ws(' ', fname, mname, lname) as name, fb_id, owner_id, subject, contact, f_c, fb_date, status from tbl_feedback join tbl_owner using(owner_id) ORDER BY fb_date, status DESC");
		return $query->result();
	}

	public function feedback_count()
	{
		$query = $this->db->query("SELECT COUNT(*) as count FROM tbl_feedback");

		return $query->row();
	}

	public function get_feedback($id)
	{
		$this->db->select('f_c');
		$this->db->where('fb_id', $id);
		$query = $this->db->get('tbl_feedback');
		
		return $query->row();
	}

	public function delete_feedback($id)
	{
		$this->db->where('fb_id', $id);
		return $this->db->delete('tbl_feedback');
	}

	public function send_reply($data)
	{
		return $this->db->insert('tbl_message', $data);
	}

	public function status_read($id)
	{
		$this->db->where('fb_id', $id);
		$this->db->update('tbl_feedback', ['status' => 1]);
	}

}
