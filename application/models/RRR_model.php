<?php 
class RRR_model extends CI_Model {

	public function getagribasevalue($sub_class, $sub_type, $revision)
	{
		
		$query = $this->db->query("SELECT $sub_type FROM tbl_sfmv_agri_land WHERE agri_id='$sub_class'");

		$row = $query->row();
		// print_r( $query);

		return $row->$sub_type;
	}

	public function getresidentialbasevalue($sub_type, $type, $revision)
	{
		$query = $this->db->query("SELECT $sub_type FROM tbl_sfmv_rci_land WHERE kind='$type'");

		$row = $query->row();
		// print_r( $query);

		return $row->$sub_type;
	}

	public function getbuildingbasevalue($sub_class, $sub_type, $revision)
	{
		
		$query = $this->db->query("SELECT value FROM tbl_sfmv_building WHERE sbuv_id='$sub_class' AND building_type='$sub_type'");

		$row = $query->row();
		// print_r( $query);

		return $row->value;
	}

	public function getAssessLevel($pin)
	{
		$query = $this->db->query("SELECT assess_level FROM tbl_appraisal as t LEFT JOIN tbl_assessment as u ON t.appraisal_id=u.appraisal_id WHERE pin='$pin' LIMIT 1");
		$row = $query->row();
		return $row->assess_level;
	}

	public function check_date_appraisal($date)
	{
		$year = date('Y');
		$query = $this->db->query("SELECT COUNT(*) as cnt FROM tbl_appraisal WHERE date_appraised BETWEEN '$year-01-01' AND '$year-01-31'");

		$row = $query->row();
		if($row->cnt > 10)
			return false;
		else 
			return true;
	}
}