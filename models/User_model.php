<?php 
	class User_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}

		public function create_user(){
			$data = array(
				'name' => $this->input->post('name'),
				'username' => $this->input->post('username'),
				'password' => $this->input->post('password'),
				'email' => $this->input->post('email')
			);
			$this->db->trans_start();
			$data = $this->db->insert('dv_users',$data);
			$this->db->trans_complete();
			return json_encode($data->result());
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
		public function read_All(){
			$this->db->trans_start();
			$data = $this->db->query('SELECT * FROM dv_users');
			$this->db->trans_complete();
			return json_encode($data->result());
		}
}