<?php 
class Backup_model extends CI_Model {

	public function getRevisionHistory($table)
	{
		$query = $this->db->query("SELECT * FROM $table");

		return $query->result();
	}
}

