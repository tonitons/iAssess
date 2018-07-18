<?php 
class User_model extends CI_Model {
	public function getAll()
	{
		$this->db->from('tbl_user');
		$query = $this->db->get();

		return $query->result();
	}

	public function get($data)
	{
		// $this->db->where('user_name', $data['user_name']);
		$this->db->select('user_id');
		$query = $this->db->get_where('tbl_user',['user_name'=>$data['user_name']]);

		$row = $query->row();
		
		return $row->user_id;
	}
	public function get_userid($data)
	{
		// $this->db->where('user_name', $data['user_name']);
		$this->db->select('owner_id');
		$query = $this->db->get_where('tbl_owner',$data);

		$row = $query->row();
		
		return $row->owner_id;
	}

	public function getFullName($id, $field, $tbl)
	{
		// $query = ;

		$query = $this->db->query("SELECT concat_ws(' ', fname,mname,lname) as name FROM $tbl WHERE $field = $id");
		// print_r($query);
		$row = $query->row();

		return $row->name;
	}

	public function user($action, $user_name)
	{
		if($action == 'deactivate'){
			$field = [
				'active' => '0'
			];
			$this->activity_log('deactivated user:'.$user_name);

			$this->db->where('user_name', $user_name);
			return $this->db->update('tbl_user', $field);
		}else if($action == 'activate'){
			$field = [
				'active' => '1'
			];
			$this->activity_log('activated user:'.$user_name);
			$this->db->where('user_name', $user_name);
			
			return $this->db->update('tbl_user', $field);
		}
	}

	public function role($id, $data)
	{
		// echo $id;
		$this->db->where('user_id', $id);

		return $this->db->update('tbl_user', $data);
	}

	private function _getCurrentRevision(){
		$this->db->select('active');
		$query = $this->db->get('tbl_active_revision');

		return $query->row();
	}

	public function insert_token($user_name, $token)
	{
		$this->db->where('user_name', $user_name);
		return $this->db->update('tbl_user', ['token' => $token]);
	}

	public function add_user($data)
	{
		return $this->db->insert('tbl_user',$data);
	}

	public function add_staff($data)
	{
		return $this->db->insert('tbl_staff',$data);
	}

	public function login($data)
	{
		// echo '<h1>skjdf</h1>';
		// print_r($data);
		$this->db->where('user_name',$data['user_name']);
		$this->db->where('password',sha1($data['password']));
		$this->db->where('active', '1');
		// $this->db->where('user_type', $data['user_type']);

		$query = $this->db->get('tbl_user');

		$data = $query->row_array();
		// print_r($data);
		// $data['schoolyear'] = $sy;
		if (!empty($data)) {
			$this->setLoginSession($data, $sy);

			return TRUE;
		}


		return false;
	}

	public function setLoginSession($data, $sy)
	{
		// print_r($data);
		$revision = $this->_getCurrentRevision();
		
			$newdata = array(
				'user_id'	=> $data['user_id'],
		        'user_name'  => $data['user_name'],
		        'user_type'  => $data['user_type'],
		        'current_revision' => $revision->active,
		        'logged_in' => TRUE
			);
		
		$this->session->set_userdata($newdata);
		// print_r($newdata);
		$this->activity_log('logged in');

		if ($this->session->user_type == 'admin') {
			redirect(base_url('admin'));
		}else if($this->session->user_type == 'staff'){
			redirect(base_url('admin'));
		}else if($this->session->user_type == 'treasurer'){
			redirect(base_url('treasurer'));
		}else if($this->session->user_type == 'owner'){
			redirect(base_url('owner/my_properties'));
		}
		
	}

	public function activity_log($activity)
	{
		$activity = [
			'user_id'	=> $this->session->user_id,
			'activity'	=> $activity
		];
		$this->db->insert('tbl_activity_logs', $activity);
	}

	public function search($key)
	{
		$this->db->select("user_id, user_name, user_type, active, fname, mname, lname, concat_ws(' ', fname, mname, lname) as name");
		$this->db->from('tbl_user');
		$this->db->join('tbl_owner', 'tbl_owner.owner_id=tbl_user.user_id');
		$array = array('fname'=>$key, 'mname'=>$key, 'lname'=>$key);
		$this->db->or_like($array);
		$this->db->limit(10);
		$query = $this->db->get();

		return $query->result();
	}

	public function forgot_pwd($data)
	{
		$email = trim($data['email']);
		$user_name = trim($data['user_name']);
		if($this->checkUsertype($user_name) == 'owner'){
			$query = $this->db->query("SELECT COUNT(*) as count FROM tbl_owner as o LEFT JOIN tbl_user as u ON o.owner_id=u.user_id WHERE email='$email' AND user_name = '$user_name'");
		}else{
			$query = $this->db->query("SELECT COUNT(*) as count FROM tbl_staff as s LEFT JOIN tbl_user as u ON s.staff_id=u.user_id WHERE email='$email' AND user_name = '$user_name'");
		}

		$res = $query->row();

		if($res->count > 0){
			//success
			return true;
		}

		return false;
	}

	public function checkUsertype($user_name)
	{
		$query = $this->db->query("SELECT user_type FROM tbl_user WHERE user_name = '$user_name'");
		$row = $query->row();

		return $row->user_type;
	}

	public function check_id($id)
	{
		$q = $this->db->query("SELECT COUNT(*) as cnt FROM tbl_user where user_id=$id");

		$res = $q->row();
		if($res->cnt > 0){
			return true;
		}
		return false;
	}

	public function checkExistUsername($uname)
	{
		$q = $this->db->query("SELECT COUNT(*) AS cnt FROM tbl_user where user_name='$uname'");

		$res = $q->row();
		if($res->cnt > 0){
			return true;
		}
		return false;		
	}

	public function checkExistToken($token)
	{
		$q = $this->db->query("SELECT COUNT(*) AS cnt FROM tbl_user where token='$token'");

		$res = $q->row();
		if($res->cnt > 0){
			return true;
		}
		return false;		
	}	

	public function update_pass($token, $pass)
	{
		$this->db->where('token', $token);
		return $this->db->update('tbl_user', ['password' => sha1($pass)]);
	}

	public function getUserName($token)
	{
		$query = $this->db->query("SELECT user_name FROM tbl_user WHERE token = '$token'");
		$row = $query->row();
		return $row->user_name;

	}

	public function getUserNameByID($user_id)
	{
		$query = $this->db->query("SELECT user_name FROM tbl_user WHERE user_id = $user_id");
		$row = $query->row();
		return $row->user_name;

	}

	public function getUid($data)
	{
		$query = $this->db->query("SELECT user_id FROM tbl_user WHERE user_name = '$data'");
		$row = $query->row();
		return $row->user_id;
	}

	public function getSecurityQuestions($user_name)
	{
		$user_id = $this->getUid($user_name);
		$query = $this->db->query("SELECT q_id, question, user_id FROM tbl_security_question LEFT JOIN tbl_answers using(q_id) LEFT JOIN  tbl_user using(user_id) WHERE user_id = $user_id");

		return $query->result();
	}

	public function checkAnswer($user_id, $q_id, $answer)
	{
		$query = $this->db->query("SELECT COUNT(*) as cnt FROM tbl_answers WHERE user_id=$user_id AND q_id=$q_id AND answer='$answer'");

		$row = $query->row();
		// var_dump($query->row());
		if($row->cnt > 0)
			return true;
		return false;
	}

	public function setRSQ($user_id, $val)
	{
		$this->db->where('user_id', $user_id);
		$this->db->update('tbl_user', ['rsq' => $val]);
	}

	public function getRSQ($user_id)
	{
		$query = $this->db->query("SELECT rsq FROM tbl_user WHERE user_id = $user_id");
		$row = $query->row();
		if($row->rsq == 1)
			return true;

		return false;
	}

	public function isLoggedIn()
	{
		return $this->session->logged_in;
	}

	public function forLoggedInOnly()
	{
		if (!$this->isLoggedIn()) {
			redirect(base_url('users/login'));
		}
	}

	public function count()
	{
		$query = $this->db->get('users');
		return $query->num_rows();
	}

	public function forNotLoggedInOnly()
	{
		if ($this->isLoggedIn() == true) {
			redirect(base_url());
		}
	}
	public function forAdminOnly()
	{
		if (!$this->_isAdmin()) {
			redirect(base_url());
		}
	}

	public function forAdminAndStaffOnly()
	{
		if (!$this->_isAdmin() && !$this->_isStaff()) {
			redirect(base_url());
		}
	}

	public function forOwnerOnly()
	{
		if (!$this->_isOwner()) {
			redirect(base_url());
		}
	}

	public function forTreasurerOnly()
	{
		if (!$this->_isTreasurer()) {
			redirect(base_url());
		}
	}

	public function forSuperAdminOnly()
	{
		if (!$this->_isSuperAdmin()) {
			redirect(base_url());
		}
	}

	public function logout()
	{
		$this->activity_log('logged out');
		$this->session->unset_userdata('user_name');
		$this->session->unset_userdata('user_type');
		// $this->session->unset_userdata('schoolyear');
		$this->session->unset_userdata('logged_in');
		$this->session->sess_destroy();
	}

	private function _isAdmin(){
		if ($this->session->user_type == 'admin') {
			return true;
		}
	}

	private function _isStaff(){
		if ($this->session->user_type == 'staff') {
			return true;
		}
	}

	private function _isTreasurer(){
		if ($this->session->user_type == 'treasurer') {
			return true;
		}
	}	

	private function _isSuperAdmin(){
		if ($this->session->usertype_id == 1) {
			return true;
		}
		return false;
	}

	private function _isOwner(){
		if ($this->session->user_type == 'owner') {
			return true;
		}
	}

	
}