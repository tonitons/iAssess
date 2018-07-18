<?php 
class RealProperty_model extends CI_Model {

	public function add($data)
	{
		return $this->db->insert('tbl_real_property', $data);
	}

	public function update($id, $data)
	{
		$this->db->where('owner_id', $id);
		return $this->db->update('tbl_owner', $data);
	}

	public function add_boundaries($data)
	{
		return $this->db->insert('tbl_boundaries', $data);
	}

	public function add_appraisal($data)
	{
		return $this->db->insert('tbl_appraisal', $data);
	}

	public function add_improvements($data)
	{
		return $this->db->insert('tbl_property_improvements', $data);
	}

	public function add_property_market_value($data)
	{
		return $this->db->insert('property_market_value', $data);
	}

	public function add_assessment($data)
	{
		return $this->db->insert('tbl_assessment', $data);
	}

	public function add_taxing($data)
	{
		return $this->db->insert('tbl_tax', $data);
	}


	//get datas from the database
	public function getAllLand()
	{
		$query = "SELECT pin, cadastral_lot_no, concat_ws(' ', fname, mname,lname) AS name, barangay_name, classification from tbl_real_property As r JOIN tbl_owner AS o ON r.owner_id=o.owner_id JOIN tbl_barangay AS b ON r.brgy_id=b.brgy_id WHERE type_of_property='land'";

		$res = $this->db->query($query);

		return $res->result();
	}

	public function getAllMachinery()
	{
		$query = $this->db->query("SELECT pin, concat_ws(' ', fname, mname,lname) AS name, barangay_name, classification, sub_class from tbl_real_property As r JOIN tbl_owner AS o ON r.owner_id=o.owner_id JOIN tbl_barangay AS b ON r.brgy_id=b.brgy_id WHERE type_of_property='machinery'");

		return $query->result();
	}

	public function getAll()
	{
		$query = "SELECT pin, cadastral_lot_no, concat_ws(' ', fname, mname,lname) AS name, barangay_name, classification from tbl_real_property As r JOIN tbl_owner AS o ON r.owner_id=o.owner_id JOIN tbl_barangay AS b ON r.brgy_id=b.brgy_id WHERE classification='residential' OR classification='agricultural' OR classification='commercial' OR classification='industrial'";

		$res = $this->db->query($query);

		return $res->result();
	}

	public function getAllBuilding()
	{
		$query = $this->db->query("SELECT pin, cadastral_lot_no, concat_ws(' ', fname, mname,lname) AS name, barangay_name, classification from tbl_real_property As r JOIN tbl_owner AS o ON r.owner_id=o.owner_id JOIN tbl_barangay AS b ON r.brgy_id=b.brgy_id WHERE type_of_property='building'");

		return $query->result();
	}

	public function get_building_properties()
	{
		
	}

	public function get_building_types()
	{
		$query = $this->db->query("SELECT * FROM tbl_sfmv_building");

		return $query->result();
	}
	
	public function search($data)
	{
		$query = "SELECT pin, cadastral_lot_no,  concat_ws(' ', fname, mname,lname) AS name, barangay_name, classification from tbl_real_property As r JOIN tbl_owner AS o ON r.owner_id=o.owner_id JOIN tbl_barangay AS b ON r.brgy_id=b.brgy_id WHERE fname LIKE '%$data%' OR lname LIKE '%$data%' OR mname LIKE '%$data%'";

		$res = $this->db->query($query);

		return $res->result();
	}

	public function view_property($pin)
	{
		$query = "";
	}

	public function getAppraisalId($data)
	{
		$this->db->select('appraisal_id');
		$query = $this->db->get_where('tbl_appraisal', $data);

		$row = $query->row();
		return $row->appraisal_id;
	}

	public function getAssessId($data)
	{
		$this->db->select('assess_id');
		$query = $this->db->get_where('tbl_assessment', $data);

		$row = $query->row();
		return $row->assess_id;
	}

	public function get_ownerid($pin)
	{
		$this->db->select('owner_id');
		// $this->db->where('pin', $pin);
		$query = $this->db->get_where('tbl_real_property', ['pin' => $pin]);

		$row =  $query->row();

		return $row->owner_id;
	}

	public function getAllBarangays()
	{
		$query = $this->db->query("SELECT * FROM tbl_barangay ORDER BY barangay_name ASC");

		return $query->result();
	}

	public function getAssessmentRoll($brgy_id, $yr)
	{
		// $yr = date('Y');
		$query = $this->db->query("SELECT * FROM tbl_real_property LEFT JOIN tbl_owner using(owner_id) LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_barangay using(brgy_id) LEFT JOIN tbl_assessment using(appraisal_id) WHERE brgy_id = '$brgy_id' AND date_appraised BETWEEN '$yr-01-01' AND '$yr-12-31' ORDER BY lname ASC");

		return $query->result();
	}

	public function getBarangayName($id)
	{
		$query = $this->db->query("SELECT barangay_name FROM tbl_barangay WHERE brgy_id='$id'");
		$row = $query->row();
		return $row->barangay_name;
	}	

	public function getLandWhere($owner, $by)
	{
		$query = "SELECT pin, cadastral_lot_no, concat_ws(' ', fname, mname,lname) AS name, barangay_name, classification from tbl_real_property As r JOIN tbl_owner AS o ON r.owner_id=o.owner_id JOIN tbl_barangay AS b ON r.brgy_id=b.brgy_id WHERE classification='residential' OR classification='agricultural' OR classification='commercial' OR classification='industrial' AND type_of_property='land' AND $by LIKE '%$owner%'";

		$res = $this->db->query($query);

		return $res->result();
	}

	public function getBuildingWhere($owner, $by)
	{
		$query = $this->db->query("SELECT pin, cadastral_lot_no, concat_ws(' ', fname, mname,lname) AS name, barangay_name, classification from tbl_real_property As r JOIN tbl_owner AS o ON r.owner_id=o.owner_id JOIN tbl_barangay AS b ON r.brgy_id=b.brgy_id WHERE type_of_property='building' AND $by LIKE '%$owner%'");

		return $query->result();
	}


	public function getPropertyByPin($pin)
	{
		$query = $this->db->query("SELECT * FROM tbl_real_property LEFT JOIN tbl_owner using(owner_id) LEFT JOIN tbl_barangay using(brgy_id) LEFT JOIN tbl_boundaries using(pin) LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) WHERE pin = '$pin'");

		return array('property_data' => $query->row(), 'appraisal_history' => $query->result());
	}

	public function getBuildingValue($id)
	{
		$this->db->select('value');
		$this->db->where('sbuv_id', $id);
		$query = $this->db->get('tbl_sfmv_building');

		$row = $query->row();

		return $row->value;
	}

	public function compute_RRR()
	{
		$query = $this->db->query("SELECT pin, area, type_of_property, classification, sub_class, sub_type, taxable FROM tbl_real_property");


		return $query->result();
	}

	public function getAllPropertyThisYear($yr)
	{
		$year = date('Y');
		$query = $this->db->query("SELECT * FROM tbl_owner RIGHT JOIN tbl_real_property using(owner_id) RIGHT JOIN tbl_appraisal using(pin) WHERE date_appraised BETWEEN '$year-01-01' AND '$year-12-31' ORDER BY lname ASC");

		return $query->result();
	}

	public function set_tax_dec($pin, $date_appraised, $tax_dec)
	{
		$this->db->where(['pin' => $pin, 'date_appraised' => $date_appraised]);
		$this->db->update('tbl_appraisal', ['tax_dec' => $tax_dec]);

		return true;

	}

	public function agricultralPropertyUpdate($table, $classification, $sub_class)
	{
		$year = date('Y');
		$query = $this->db->query("SELECT * FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) LEFT JOIN tbl_tax using(assess_id) WHERE classification='$classification' AND sub_class='$sub_class' AND date_appraised BETWEEN '$year-01-01' AND '$year-12-31' AND tax_id NOT IN(SELECT tax_id FROM tbl_tax_payment)");
		// var_dump($query);
		return $query->result();
	}

	public function agricultralPropertyUpdateAllClass()
	{
		$year = date('Y');
		$query = $this->db->query("SELECT * FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) LEFT JOIN tbl_tax using(assess_id) WHERE type_of_property='land' AND classification='agricultural' AND date_appraised BETWEEN '$year-01-01' AND '$year-12-31' AND tax_id NOT IN(SELECT tax_id FROM tbl_tax_payment)");
		// var_dump($query);
		return $query->result();
	}

	public function buildingPropertyUpdate($sub_class)
	{
		$year = date('Y');
		$query = $this->db->query("SELECT * FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) LEFT JOIN tbl_tax using(assess_id) WHERE sub_class='$sub_class' AND date_appraised BETWEEN '$year-01-01' AND '$year-12-31' AND tax_id NOT IN(SELECT tax_id FROM tbl_tax_payment)");
		// var_dump($query);
		return $query->result();
	}

	public function buildingPropertyUpdateAllClass()
	{
		$year = date('Y');
		$query = $this->db->query("SELECT * FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) LEFT JOIN tbl_tax using(assess_id) WHERE type_of_property='building' AND  date_appraised BETWEEN '$year-01-01' AND '$year-12-31' AND tax_id NOT IN(SELECT tax_id FROM tbl_tax_payment)");
		// var_dump($query);
		return $query->result();
	}

	public function RCILandPropertyUpdate($classification)
	{
		$year = date('Y');
		$query = $this->db->query("SELECT * FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) LEFT JOIN tbl_tax using(assess_id) WHERE type_of_property='land' AND classification='$classification' AND date_appraised BETWEEN '$year-01-01' AND '$year-12-31' AND tax_id NOT IN(SELECT tax_id FROM tbl_tax_payment)");
		// var_dump($query);
		return $query->result();
	}
	
	public function RCILandPropertyUpdateAllClass()
	{
		$year = date('Y');
		$query = $this->db->query("SELECT * FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) LEFT JOIN tbl_tax using(assess_id) WHERE type_of_property='land' AND classification IN('commercial','industrial','residential') AND date_appraised BETWEEN '$year-01-01' AND '$year-12-31' AND tax_id NOT IN(SELECT tax_id FROM tbl_tax_payment)");
		// var_dump($query);
		return $query->result();
	}

	public function update_appraisal($id, $data)
	{
		$this->db->where('appraisal_id', $id);		
		$this->db->update('tbl_appraisal', $data);
	}

	public function update_assessment($id, $data)
	{
		$this->db->where('assess_id', $id);		
		$this->db->update('tbl_assessment', $data);
	}

	public function update_taxing($id, $data)
	{
		$this->db->where('tax_id', $id);		
		$this->db->update('tbl_tax', $data);
	}

}
