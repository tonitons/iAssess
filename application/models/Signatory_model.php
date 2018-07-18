<?php 
class Signatory_model extends CI_Model {

	public function getSignPerson($report, $status)
	{
		$query = $this->db->query("SELECT * FROM tbl_signatories LEFT JOIN tbl_staff using(staff_id) WHERE report_name = '$report' AND status = $status LIMIT 1");

		return $query->result();
	}

	public function ifExist($report_name)
	{
		$query = $this->db->query("SELECT COUNT(*) as cnt FROM tbl_signatories WHERE report_name = '$report_name'");
		$row = $query->row();

		if($row->cnt > 0)
			return true;

		return false;
	}
}
