<?php 
	class Users extends CI_Controller{
		public function testinsert(){
			$this->User_model->insertwp();
		}
		public function create(){
			$data['title'] = 'Sign Up';

			$this->form_validation->set_rules('name','Name','required');
			$this->form_validation->set_rules('username','Username','required');
			$this->form_validation->set_rules('passwd','Password','required');
			$this->form_validation->set_rules('passconf','Password Confirmation', 'required');
			$this->form_validation->set_rules('email','Email','required');
		
			if($this->form_validation->run() === FALSE){
				$this->load->view('templates/header');
				$this->load->view('pages/register', $data);
				$this->load->view('templates/footer');
			}else{
				redirect("show_users");
				return $data = $this->User_model->create_user();
			}
		}

		public function read(){
			$data = $this->User_model->read_All();
			echo json_encode($data);
		}

		public function update(){
			echo $data = json_encode($this->User_model->update_user());
		}

		public function delete(){
			echo $data = json_encode($this->User_model->delete_user());
		}

		public function read_roles(){
			$data = json_encode($this->Role_model->read_role()); 
			echo $data;
		}
	}