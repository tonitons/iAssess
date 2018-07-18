<?php 
class Home_model extends CI_Model {

	public function getAll($table)
		{
			$this->db->from($table);
			$query = $this->db->get();

			return $query->result();
		}
}