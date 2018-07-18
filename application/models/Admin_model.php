<?php 
class Admin_model extends CI_Model {

	public function getAll($table)
		{
			$this->db->from($table);
			$query = $this->db->get();

			return $query->result();
		}

		public function get($table, $type, $sclass)
		{
			$this->db->select($sclass);
			$query = $this->db->get_where($table,['agri_id'=>$type]);

			$val = $query->row();
			if(!empty($val))
				return $val->$sclass;
		}

		public function get_improve($plant_id)
		{
			$this->db->select('value');
			$query = $this->db->get_where('tbl_sfmv_improvements',['plant_id'=>$plant_id]);

			$val = $query->row();
			if(!empty($val))
				return $val->value;
		}

		public function add_market_value($table, $data){
		
		if($table == 'tbl_sfmv_rci_land'){
			$id = substr($data['kind'], 0, 3);
			
			$val = [
				'rci_id' => $data['rci_id'],
				'kind'	=> $data['kind'],
				'first' => $data['first'],
				'second' => $data['second'],
				'third' => $data['third'],
				'fourth' => $data['fourth'],
				'fifth' => $data['fifth'],
				'revision' => $this->session->current_revision
			];
		}else if($table == 'tbl_sfmv_agri_land'){
			// print_r($data);
			
			$val = [
				'agri_id' => $data['agri_id'],
				'agri_Land' => $data['agri_land'],
				'first' => $data['first'],
				'second' => $data['second'],
				'third' => $data['third'],
				'revision' => $this->session->current_revision
			];
		}else if($table == 'tbl_sfmv_improvements'){
			$val = [
				'plant_id' => $data['plant_id'],
				'kind' => $data['kind'],
				'value' => $data['value'],
				'revision' => $this->session->current_revision

			];
		}else if($table == 'tbl_sfmv_building'){
			$val = [
				'sbuv_id' => $data['sbuv_id'],
				'building_type' => $data['building_type'],
				'name_building' => $data['name_building'],
				'value' => $data['value'],
				'revision' => $this->session->current_revision

			];
		}
			$query = $this->db->query("SELECT * from tbl_market_value_update WHERE tbl_name = '$table'");
			if($query->num_rows() == 0){
				$this->db->insert('tbl_market_value_update', ['tbl_name'=>$table]);//revision update here!!!!!!
			}
			return $this->db->insert($table, $val);

			
		}

		public function update_market_value($table,$id,$data)
		{
			if($table == 'tbl_sfmv_rci_land'){
				$val = [
					'first' => $data['first'],
					'second' => $data['second'],
					'third' => $data['third'],
					'fourth' => $data['fourth'],
					'fifth' => $data['fifth']
				];
				$this->db->where('kind', $id);
			}else if($table == 'tbl_sfmv_agri_land'){
				$val = [
					'first' => $data['first'],
					'second' => $data['second'],
					'third' => $data['third']
				];
				$this->db->where('agri_land', $id);
			}else if($table == 'tbl_sfmv_improvements'){
				$val = [
					'value' => $data['value']
				];
				$this->db->where('kind', $id);
			}else if($table == 'tbl_sfmv_building'){
				$val = [
					'value' => $data['value']
				];
				$this->db->where('building_type', $data['building_type']);
				$this->db->where('name_building', $data['name_building']);
			}
			
			return $this->db->update($table, $val);
		}

		public function increase_market_value($table,$data)
		{
			if($table == 'tbl_sfmv_rci_land'){
				$land = $this->getAll('tbl_sfmv_rci_land');
				// echo $land->num_rows();;
				foreach ($land as $key => $value) {
					// echo $value->RCI_id;
					$id = $value->rci_id;
					$first = (($value->first*($data['percent']/100))+$value->first);
					$second = (($value->second*($data['percent']/100))+$value->second);
					$third = (($value->third*($data['percent']/100))+$value->third);
					$fourth = (($value->fourth*($data['percent']/100))+$value->fourth);
					$fifth = (($value->fifth*($data['percent']/100))+$value->fifth);
					
					$val = [
					'first' => $first,
					'second' => $second,
					'third' => $third,
					'fourth' => $fourth,
					'fifth' => $fifth
					];
					$this->db->where('rci_id', $id);
					$this->db->update('tbl_sfmv_rci_land', $val);

				}
			}else if($table == 'tbl_sfmv_agri_land'){
				$land = $this->getAll('tbl_sfmv_agri_land');
				// echo $land->num_rows();;
				foreach ($land as $key => $value) {
					// echo $value->RCI_id;
					$id = $value->agri_id;
					$first = (($value->first*($data['percent']/100))+$value->first);
					$second = (($value->second*($data['percent']/100))+$value->second);
					$third = (($value->third*($data['percent']/100))+$value->third);
					// $fourth = (($value->fourth*($data['percent']/100))+$value->fourth);
					// $fifth = (($value->fifth*($data['percent']/100))+$value->fifth);
					
					$val = [
					'first' => $first,
					'second' => $second,
					'third' => $third
					];
					$this->db->where('agri_id', $id);
					$this->db->update('tbl_sfmv_agri_land', $val);				
				}
			}else if($table == 'tbl_sfmv_improvements'){
				$plant = $this->getAll('tbl_sfmv_improvements');
				foreach ($plant as $key => $value) {
					// echo $value->RCI_id;
					$id = $value->plant_id;
					$first = (($value->value*($data['percent']/100))+$value->value);
					// $second = (($value->second*($data['percent']/100))+$value->second);
					// $third = (($value->third*($data['percent']/100))+$value->third);
					// $fourth = (($value->fourth*($data['percent']/100))+$value->fourth);
					// $fifth = (($value->fifth*($data['percent']/100))+$value->fifth);
					
					$val = [
					'value' => $first
					];
					$this->db->where('plant_id', $id);
					$this->db->update('tbl_sfmv_improvements', $val);				
				}
			}else if($table == 'tbl_sfmv_building'){
				$building = $this->getAll('tbl_sfmv_building');

				foreach ($building as $key => $value) {
					// echo $value->RCI_id;
					$id = $value->sbuv_id;
					$inc_val = (($value->value*($data['percent']/100))+$value->value);
					
					$val = [
						'value' => $inc_val
					];
					$this->db->where('sbuv_id', $id);
					$this->db->update('tbl_sfmv_building', $val);				
				}
			}

			$updates = [
				'tbl_name' => $table,
				'increase' => $data['percent']
				];//revision pa dinhe!!!
				// print_r($updates);
			$this->db->where('tbl_name', $table);
			$this->db->update('tbl_market_value_update', $updates);
			return true;
			
		}

		public function get_date_updated($table){
			$this->db->where('tbl_name', $table);
			$query = $this->db->get('tbl_market_value_update');
			
			return $query->result();
			// foreach ($query as $value) {
			// 	// return $value->date_updated;	
			// }
			
		}

		public function revision($table, $data){
			// $this->db->where('tbl_name', $table);
			$this->session->set_userdata(['current_revision' => $data['revision']]);
			return $this->db->update('tbl_active_revision', ['active' => $data['revision']]);

		}

		public function get_mv_land($id, $land_class)
		{
			$this->db->select($land_class);
			$query = $this->db->get_where('tbl_sfmv_rci_land', ['rci_id'=> $id]);

			$val = $query->row();
			if(!empty($val))
				return $val->$land_class;

		}

		public function backup_sfmv()
		{
			//for tbl_sfmv_rci_land
			$query1 = $this->db->query("SELECT * FROM tbl_sfmv_rci_land");
			$rci_land = $query1->result();
			// var_dump($rci_land);
			foreach ($rci_land as $key => $value) {
				// var_dump($value->rci_id);
				$backupdata = array(
					'rci_id'	=> $value->rci_id,
					'kind'		=> $value->kind,
					'first'		=> $value->first,
					'second'	=> $value->second,
					'third'		=> $value->third,
					'fourth'	=> $value->fourth,
					'fifth'		=> $value->fifth,
					'revision'	=> $value->revision
					);
				$this->db->insert('tbl_sfmv_rci_land_hx', $backupdata);
			}

			$query2 = $this->db->query("SELECT * FROM tbl_sfmv_agri_land");
			$agri_land = $query2->result();

			foreach ($agri_land as $key => $value) {
				$backupdata = array(
					'agri_id'	=> $value->agri_id,
					'agri_land'		=> $value->agri_land,
					'first'		=> $value->first,
					'second'	=> $value->second,
					'third'		=> $value->third,
					'revision'	=> $value->revision
					);
				$this->db->insert('tbl_sfmv_agri_land_hx', $backupdata);
			}

			$query3 = $this->db->query("SELECT * FROM tbl_sfmv_building");
			$building = $query3->result();

			foreach ($building as $key => $value) {
				$backupdata = array(
					'sbuv_id'	=> $value->sbuv_id,
					'building_type'		=> $value->building_type,
					'name_building'		=> $value->name_building,
					'value'				=> $value->value,
					'revision'			=> $value->revision
					);
				$this->db->insert('tbl_sfmv_building_hx', $backupdata);
			}

			$query4 = $this->db->query("SELECT * FROM tbl_sfmv_improvements");
			$plants = $query4->result();

			foreach ($plants as $key => $value) {
				$backupdata = array(
					'plant_id'	=> $value->plant_id,
					'kind'		=> $value->kind,
					'value'		=> $value->value,
					'revision'	=> $value->revision
					);
				$this->db->insert('tbl_sfmv_improvements_hx', $backupdata);
			}

		}

		public function update_revision_number($revision)
		{
			$data = array('revision' => $revision);
			$this->db->update('tbl_sfmv_rci_land', $data);
			$this->db->update('tbl_sfmv_agri_land', $data);
			$this->db->update('tbl_sfmv_building', $data);
			$this->db->update('tbl_sfmv_improvements', $data);
		}
}