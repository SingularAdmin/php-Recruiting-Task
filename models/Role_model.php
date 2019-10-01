<?php 
	class Role_model extends CI_Model{
		public function __construct(){
			$this->load->database();
		}
		//reading roles to display
		public function read_role(){
			$this->db->trans_start();
			$data = $this->db->get('dv_users_roles');
			$this->db->trans_complete();
			return json_encode($data->result());		
		}
	}
