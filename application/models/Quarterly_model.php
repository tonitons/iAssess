<?php 
class Quarterly_model extends CI_Model {

	public function num_real_property_unit($classification, $taxable, $quarter, $year)
	{
		$first = "$year-01-01";
		if($quarter == 'Jan-Mar') $second = "$year-03-31";
		else if($quarter == 'Apr-Jun') $second = "$year-06-30";
		else if($quarter == 'Jul-Sep') $second = "$year-09-31";
		else if($quarter == 'Oct-Dec') $second = "$year-12-31";
		else{
			$first = NULL;
			$second = NULL;
		}

		$query = $this->db->query("SELECT COUNT(*) as count FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) WHERE classification='$classification' AND taxable=$taxable AND date_appraised BETWEEN '$first' AND '$second'");
		$row = $query->row();
		return $row->count;
	}


	public function sum_real_property_unit_area($classification, $taxable, $quarter, $year)
	{
		$first = "$year-01-01";
		if($quarter == 'Jan-Mar') $second = "$year-03-31";
		else if($quarter == 'Apr-Jun') $second = "$year-06-30";
		else if($quarter == 'Jul-Sep') $second = "$year-09-31";
		else if($quarter == 'Oct-Dec') $second = "$year-12-31";
		else{
			$first = NULL;
			$second = NULL;
		}

		$query = $this->db->query("SELECT SUM(area) as totalarea FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) WHERE classification='$classification' AND type_of_property = 'land' AND taxable=$taxable AND date_appraised BETWEEN '$first' AND '$second'");
		$row = $query->row();
		return $row->totalarea;
	}

	public function mv_sum_land($classification, $taxable, $quarter, $year)
	{
		$first = "$year-01-01";
		if($quarter == 'Jan-Mar') $second = "$year-03-31";
		else if($quarter == 'Apr-Jun') $second = "$year-06-30";
		else if($quarter == 'Jul-Sep') $second = "$year-09-31";
		else if($quarter == 'Oct-Dec') $second = "$year-12-31";
		else{
			$first = NULL;
			$second = NULL;
		}

		$query = $this->db->query("SELECT SUM(appraised_value) as totalappraisedvalue FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) WHERE classification='$classification' AND type_of_property = 'land' AND date_appraised BETWEEN '$first' AND '$second' AND taxable=$taxable");
		$row = $query->row();
		return $row->totalappraisedvalue;
	}
	
	public function mv_sum_building($classification, $condition, $taxable, $quarter, $year)
	{
		$first = "$year-01-01";
		if($quarter == 'Jan-Mar') $second = "$year-03-31";
		else if($quarter == 'Apr-Jun') $second = "$year-06-30";
		else if($quarter == 'Jul-Sep') $second = "$year-09-31";
		else if($quarter == 'Oct-Dec') $second = "$year-12-31";
		else{
			$first = NULL;
			$second = NULL;
		}

		$query = $this->db->query("SELECT SUM(appraised_value) as buildingappraisedvalue FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) WHERE classification= '$classification' AND appraised_value $condition 175000 AND taxable=$taxable AND date_appraised BETWEEN '$first' AND '$second' ");
		$row = $query->row();
		return $row->buildingappraisedvalue;
	}

	public function mv_sum_machinery($classification, $taxable, $quarter, $year)
	{
		$first = "$year-01-01";
		if($quarter == 'Jan-Mar') $second = "$year-03-31";
		else if($quarter == 'Apr-Jun') $second = "$year-06-30";
		else if($quarter == 'Jul-Sep') $second = "$year-09-31";
		else if($quarter == 'Oct-Dec') $second = "$year-12-31";
		else{
			$first = NULL;
			$second = NULL;
		}

		$query = $this->db->query("SELECT SUM(appraised_value) as machineryappraisedvalue FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) WHERE classification= '$classification' AND type_of_property = 'machinery' AND taxable=$taxable AND date_appraised BETWEEN '$first' AND '$second'");
		$row = $query->row();
		return $row->machineryappraisedvalue;
	}

	public function mv_sum_others($classification, $taxable, $quarter, $year)
	{
		$first = "$year-01-01";
		if($quarter == 'Jan-Mar') $second = "$year-03-31";
		else if($quarter == 'Apr-Jun') $second = "$year-06-30";
		else if($quarter == 'Jul-Sep') $second = "$year-09-31";
		else if($quarter == 'Oct-Dec') $second = "$year-12-31";
		else{
			$first = NULL;
			$second = NULL;
		}

		$query = $this->db->query("SELECT SUM(appraised_value) as othersappraisedvalue FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) WHERE classification= '$classification' AND type_of_property = 'others' AND taxable=$taxable AND date_appraised BETWEEN '$first' AND '$second' ");
		$row = $query->row();
		return $row->othersappraisedvalue;
	}

	public function av_sum_land($classification, $taxable, $quarter, $year)
	{
		$first = "$year-01-01";
		if($quarter == 'Jan-Mar') $second = "$year-03-31";
		else if($quarter == 'Apr-Jun') $second = "$year-06-30";
		else if($quarter == 'Jul-Sep') $second = "$year-09-31";
		else if($quarter == 'Oct-Dec') $second = "$year-12-31";
		else{
			$first = NULL;
			$second = NULL;
		}

		$query = $this->db->query("SELECT SUM(assessment_value) as totalassessedvalue FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) WHERE classification='$classification' AND type_of_property = 'land' AND taxable=$taxable AND date_appraised BETWEEN '$first' AND '$second' ");
		$row = $query->row();
		return $row->totalassessedvalue;
	}

	public function av_sum_building($classification, $condition, $taxable, $quarter, $year)
	{
		$first = "$year-01-01";
		if($quarter == 'Jan-Mar') $second = "$year-03-31";
		else if($quarter == 'Apr-Jun') $second = "$year-06-30";
		else if($quarter == 'Jul-Sep') $second = "$year-09-31";
		else if($quarter == 'Oct-Dec') $second = "$year-12-31";
		else{
			$first = NULL;
			$second = NULL;
		}

		$query = $this->db->query("SELECT SUM(assessment_value) as totalassessedvalue FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) WHERE classification='$classification' AND type_of_property = 'building' AND appraised_value $condition 175000 AND taxable=$taxable AND date_appraised BETWEEN '$first' AND '$second' ");
		$row = $query->row();
		return $row->totalassessedvalue;
	}

	public function av_sum_machinery($classification, $taxable, $quarter, $year)
	{
		$first = "$year-01-01";
		if($quarter == 'Jan-Mar') $second = "$year-03-31";
		else if($quarter == 'Apr-Jun') $second = "$year-06-30";
		else if($quarter == 'Jul-Sep') $second = "$year-09-31";
		else if($quarter == 'Oct-Dec') $second = "$year-12-31";
		else{
			$first = NULL;
			$second = NULL;
		}

		$query = $this->db->query("SELECT SUM(assessment_value) as totalassessedvalue FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) WHERE classification='$classification' AND type_of_property = 'machinery' AND taxable=$taxable AND date_appraised BETWEEN '$first' AND '$second' ");
		$row = $query->row();
		return $row->totalassessedvalue;
	}

	public function av_sum_others($classification, $taxable, $quarter, $year)
	{
		$first = "$year-01-01";
		if($quarter == 'Jan-Mar') $second = "$year-03-31";
		else if($quarter == 'Apr-Jun') $second = "$year-06-30";
		else if($quarter == 'Jul-Sep') $second = "$year-09-31";
		else if($quarter == 'Oct-Dec') $second = "$year-12-31";
		else{
			$first = NULL;
			$second = NULL;
		}

		$query = $this->db->query("SELECT SUM(assessment_value) as totalassessedvalue FROM tbl_real_property LEFT JOIN tbl_appraisal using(pin) LEFT JOIN tbl_assessment using(appraisal_id) WHERE classification='$classification' AND type_of_property = 'others' AND taxable=$taxable AND date_appraised BETWEEN '$first' AND '$second' ");
	
		$row = $query->row();
		return $row->totalassessedvalue;
	}

	public function under_carp($classification)
	{
		return 0;
	}


	//get datas from the database
	public function getAllLand()
	{
		$query = "SELECT pin, cadastral_lot_no, concat_ws(' ', fname, mname,lname) AS name, barangay_name, classification from tbl_real_property As r JOIN tbl_owner AS o ON r.owner_id=o.owner_id JOIN tbl_barangay AS b ON r.brgy_id=b.brgy_id WHERE classification='residential' OR classification='agricultural' OR classification='commercial' OR classification='industrial'";

		$res = $this->db->query($query);

		return $res->result();
	}

	public function getAll()
	{
		$query = "SELECT pin, cadastral_lot_no, concat_ws(' ', fname, mname,lname) AS name, barangay_name, classification from tbl_real_property As r JOIN tbl_owner AS o ON r.owner_id=o.owner_id JOIN tbl_barangay AS b ON r.brgy_id=b.brgy_id WHERE classification='residential' OR classification='agricultural' OR classification='commercial' OR classification='industrial'";

		$res = $this->db->query($query);

		return $res->result();
	}

	public function getAllBuilding()
	{
		$query = $this->db->query("SELECT pin, cadastral_lot_no, concat_ws(' ', fname, mname,lname) AS name, barangay_name, classification from tbl_real_property As r JOIN tbl_owner AS o ON r.owner_id=o.owner_id JOIN tbl_barangay AS b ON r.brgy_id=b.brgy_id WHERE classification='building'");

		return $query->result();
	}

	public function get_building_properties()
	{
		
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
		$query = "SELECT pin, cadastral_lot_no, concat_ws(' ', fname, mname,lname) AS name, barangay_name, classification from tbl_real_property As r JOIN tbl_owner AS o ON r.owner_id=o.owner_id JOIN tbl_barangay AS b ON r.brgy_id=b.brgy_id WHERE $by LIKE '%$owner%'";

		$res = $this->db->query($query);

		return $res->result();
	}

	public function getPropertyByPin($pin)
	{
		$query = $this->db->query("SELECT * FROM tbl_real_property LEFT JOIN tbl_owner using(owner_id) LEFT JOIN tbl_barangay using(brgy_id) LEFT JOIN tbl_boundaries using(pin) WHERE pin = '$pin'");

		return $query->row();
	}

}
