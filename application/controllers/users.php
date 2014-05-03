<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		$data['title'] = 'Photo Sharing';  
		$data['main_content'] = 'users/login';
		$this->load->view('view_template',$data);
	}

	public function signup()
	{
		$data['title'] = 'Sign Up!';  
		$data['main_content'] = 'users/signup';
		$this->load->view('view_template',$data);
	}

	public function add_user(){
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="bg-danger mrgn_bottom">', '</div>');
		$this->form_validation->set_rules('name', 'name', 'trim|required');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
		$this->form_validation->set_rules('password_confirmation', 'password confirmation', 'trim|required|matches[password]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_valid_email');
		if ($this->form_validation->run()) {
			$this->load->model('user_model');
			
			if ($this->user_model->add_new_user()) {
				$data['title'] = 'Photo Sharing';  
				$data['main_content'] = 'users/login';
				$this->load->view('view_template',$data);
			}
			else{
				$data['title'] = 'Sign Up!';  
				$data['main_content'] = 'users/signup';
				$this->load->view('view_template',$data);	
			}
			
		}
		else{
			$data['title'] = 'Sign Up!';  
			$data['main_content'] = 'users/signup';
			$this->load->view('view_template',$data);
		}
	}

	public function check_valid_email(){
		$email=$this->input->post('email');
 		$check_email_query="SELECT email FROM USERS WHERE email = ?";
 		$check_email=$this->db->query($check_email_query,array($email));
 		
 		if ($check_email->num_rows() > 0) {
 			$this->form_validation->set_message('check_valid_email', 'Seems you\'re already registered!');
 			return false;
 		}
 		else
 			return true;
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */