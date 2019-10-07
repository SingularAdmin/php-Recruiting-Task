<?php 
	class User_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function create_user(){ //inserting new users
			$data = $this->input->post("selectedRoles");
			return json_encode($data);

			/*
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
			$data = $this->db->insert('dv_users',$data);

			$roledata = setUserRoles($lastID);

			$this->db->trans_complete();
			return json_encode($data)+json_encode($roledata);
			*/
		}

		private function setUserRoles($lastID){
			$JSONdata = $this->input->post('selectedRoles');
			$data = json_decode($JSONdata);
			foreach($data as $role){
				$data = $this->db->insert('dv_users_roles_has_dv_users',array('dv_users_roles_id' => $role+1 ,
				'dv_users_id' => $lastID) );

			}
			return var_dump($data);
			
		}

		public function read_user($id){
			$this->db->trans_start();
			$data = $this->db->query('SELECT * FROM dv_users');
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
			$this->db->trans_start();
			$Usersdata = $this->db->select('name')->FROM("dv_users")->get_compiled_select();
			$Rolesdata = $this->db->select('name')->FROM("dv_users_roles")->get_compiled_select();

			$query = $this->db->query($Usersdata . ' UNION ' .$Rolesdata);
			if($query->num_rows() > 0){
				return json_encode($query->result());
			}else{
				return json_encode("No data in the table");
			}
			$this->db->trans_complete();
		}
}