<?php 
class Site_model extends CI_Model {

 public function get()
 {
 	$query = $this->db->get('tbl_site_details');

 	return $query->row();
 }

 public function insert($data)
 {
 	return $this->db->update('tbl_site_details', $data);
 }

 public function getSecurityQuestions()
 {
 	$query = $this->db->query("SELECT q_id, question, user_id FROM tbl_security_question LEFT JOIN tbl_answers using(q_id) LEFT JOIN  tbl_user using(user_id) WHERE q_id <> 3");
 	return $query->result();
 }

  public function getSecurityQuestionsExcept($id)
 {
 	$query = $this->db->query("SELECT q_id, question, user_id FROM tbl_security_question LEFT JOIN tbl_answers using(q_id) LEFT JOIN  tbl_user using(user_id) WHERE user_id <> $id");

		// return $query->result();
 	return $query->result();
 }

 public function get_mySecurityQuestions($id)
 {
		$query = $this->db->query("SELECT id, q_id, question, answer, user_id FROM tbl_security_question LEFT JOIN tbl_answers using(q_id) LEFT JOIN  tbl_user using(user_id) WHERE user_id = $id");

		return $query->result();
 }

 public function getCountQs($id)
 {
		$query = $this->db->query("SELECT COUNT(*) as cnt FROM tbl_security_question LEFT JOIN tbl_answers using(q_id) LEFT JOIN  tbl_user using(user_id) WHERE user_id = $id");
		$row = $query->row();
		return $row->cnt;
 }

 public function add_securityQuestion($data)
 {
 	return $this->db->insert('tbl_security_question', ['question' => $data]);
 }

 public function update_securityQuestion($id, $data)
 {
 	$this->db->where('q_id', $id);
 	return $this->db->update('tbl_security_question', ['question' => $data]);
 }

 public function add_myQuestion($data)
 {
 	return $this->db->insert('tbl_answers', $data);
 }

 public function update_myQuestion($id, $data)
 {
 	$this->db->where('id', $id);
 	return $this->db->update('tbl_answers', $data);
 }

 public function questionExist($user_id, $q_id)
 {
 	$query = $this->db->query("SELECT COUNT(*) as cnt FROM tbl_answers WHERE user_id=$user_id AND q_id=$q_id");

 	$row = $query->row();
 	if($row->cnt > 0)
 		return true;
 	
 	return false;
 }

 public function getSignatories()
 {
 	$query = $this->db->query("SELECT s.id, staff_id, report_name, fname, mname, lname, position  FROM tbl_signatories as s LEFT JOIN tbl_staff using(staff_id) order by s.id DESC");

 	return $query->result();
 }

 public function getTreasurers()
 {
 	$query = $this->db->query("SELECT * FROM tbl_staff WHERE position LIKE '%treasurer'");

 	return $query->result();
 }
 public function getAssessors()
 {
 	$query = $this->db->query("SELECT * FROM tbl_staff WHERE position LIKE '%assessor'");

 	return $query->result();
 }

 public function updateTreasurerSignatory($id, $staff_id)
 {
 	$this->db->where('id', $id);
 	return $this->db->update('tbl_signatories', ['staff_id' => $staff_id]);
 }

 public function addKind($data)
 {
 	$post_data = [
 		'table_name' => $data['table_name'],
 		'description' => $data['description'],
 		'no_of_classes' => $data['no_of_classes']
 	];
 	$cnt = $data['no_of_classes'];
 	$tblname = strtolower(str_replace(' ', '_', $data['table_name']));
 	$query = "CREATE TABLE tbl_sfmv_{$tblname} ({$tblname}_id int PRIMARY KEY NOT NULL, ";
 	for ($i=1; $i <= $cnt; $i++) { 
 		if($i == 1) $class = 'first';
 		else if ($i == 2) $class = 'second';
 		else if($i == 3) $class = 'third';
 		else if($i == 4) $class = 'fourth';
 		else if($i == 5) $class = 'fifth';
 		$query .= "{$class} double,";
 	}
 	$query.= "revision tinyint)";

 	$this->db->query($query);
 	return $this->db->insert('tbl_kinds_mgt', $post_data);
 }

 public function getKinds()
 {
 	$query = $this->db->query("SELECT * FROM tbl_kinds_mgt WHERE deleted_at is NULL");
 	return $query->result();
 }

}
