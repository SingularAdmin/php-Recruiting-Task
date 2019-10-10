<?php 
	class User_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function create_user(){ //inserting new users with roles
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
			return json_encode($arrayName = array('UserError' => $data,'RoleError' => $dataR));
		}

		

		public function read_user(){
			$users = array();
			$this->db->trans_start();
			$this->db->SELECT("id , name");
			$this->db->FROM("dv_users");
			$dataU = $this->db->get();
			$this->db->trans_complete();
			return json_encode($dataU->result_array()); 
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


		public function read_All(){ //displaing dv_user name and dv_user_role name /relational data 1 -> *
			$this->db->trans_start();
				$query = $this->db->query("SELECT dvu.name as dvuName, dvr.name as  dvrName FROM dv_users as dvu JOIN dv_users_roles_has_dv_users as uhasr ON dvu.id = uhasr.dv_users_id JOIN dv_users_roles as dvr ON
					uhasr.dv_users_roles_id = dvr.id");
				$data = array();
				foreach ($query->result_array() as $index=>$row) {
					$data[$index] = array('dvuName' => $row['dvuName'] , 'dvrName' => $row['dvrName']);
				}

			$this->db->trans_complete();
			return json_encode($data);
		}
}