<?php 
	class User_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function create_user(){ //inserting new users
			$this->db->trans_start();
			$this->db->insert('wp_users', array('systemUsers' => 0));
			$lastID = $this->db->insert_id();
			$data = array(
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('passwd'),
				'email' => $this->input->post('email'),
				'wp_users_ID' => $lastID
			);
			$data = $this->db->insert('dv_users',$this->db->escape($data));//escape data for security

			$JSONdata = $this->input->post('selectedRoles');
			$dataR = json_decode($JSONdata);
			foreach($dataR as $roleID){
				$data = $this->db->insert('dv_users_roles_has_dv_users',array('dv_users_roles_id' => $roleID+1 ,
				'dv_users_id' => $lastID));

			}
			$this->db->trans_complete();
			return json_encode($data) . json_encode($dataR);
		}

		

		public function read_user($id){
			$this->db->trans_start();
			$data = $this->db->query('SELECT * FROM dv_users');
			$this->db->where("id",$id);
			$result = $data->result();
			$this->db->trans_complete();
			return json_encode($result);  
		}

		public function update_user($id){
			$data = array(
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email')
			);
			$this->db->trans_start();
			$data = $this->db->update('dv_users',$data)
									  ->where('id',$id);
			$this->db->trans_complete();
			return json_encode($data->result());
		}

		public function delete_user($id){
			$data = $this->db->delete('dv_users')
					   	    	->where('id',$id);
			return json_encode($data->result());
		}


		public function read_All(){ //displaing dv_user name and dv_user_role name
			/*SELECT dvu.name, dvr.name FROM dv_users as dvu JOIN dv_users_roles_has_dv_users as uhasr ON dvu.id = uhasr.dv_users_id JOIN dv_users_roles as dvr ON
			uhasr.dv_users_roles_id = dvr.id


			$Usersdata = $this->db->select('name')->FROM("dv_users")->get_compiled_select();
			$Rolesdata = $this->db->select('name')->FROM("dv_users_roles")->get_compiled_select();

			$query = $this->db->query($Usersdata . ' UNION ' .$Rolesdata);
			if($query->num_rows() > 0){
				return json_encode($query->result());
			}else{
				return json_encode("No data in the table");
			}
			*/
			$this->db->trans_start();
				$query = $this->db->query("SELECT dvu.name as dvuName, dvr.name as  dvrName FROM dv_users as dvu JOIN dv_users_roles_has_dv_users as uhasr ON dvu.id = uhasr.dv_users_id JOIN dv_users_roles as dvr ON
					uhasr.dv_users_roles_id = dvr.id");
				$data = array();
				foreach ($query->result_array() as $index=>$row) {
					$data[$index] = ($row['dvuName'] . $row['dvrName']);
				}

			$this->db->trans_complete();
			return json_encode($data);
		}
}