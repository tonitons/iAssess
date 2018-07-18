<?php 
class Logs_model extends CI_Model {

	public function getAll($data)
	{
		$from = "'".$data['from']." 00:00:00'";
		$to = "'".$data['to']. " 23:59:59'";
		$q = "SELECT activity_id, a.user_id as user_id, user_name, user_type, activity, act_date FROM tbl_activity_logs AS a JOIN tbl_user AS u ON a.user_id=u.user_id WHERE act_date BETWEEN $from AND $to ORDER BY activity_id DESC";
		
		$query = $this->db->query($q);

		return $query->result();
	}

	public function delete_all($data)
	{
		$query = "TRUNCATE tbl_activity_logs";
		return $this->db->query($query);
	}
}