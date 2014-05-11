<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessions extends CI_Controller {
	var $current_user;

	public function index()
	{
		if (($this->user_model->is_logged_in())) {
			redirect('users/'.$this->session->userdata('id'));
		}
		else{
			$data['title'] = 'Photo Sharing';  
			$data['main_content'] = 'sessions/sign_in';
			$this->load->view('view_template',$data);
		}
	}

	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="bg-danger mrgn_bottom">', '</div>');

		if ($this->form_validation->run()) {
			
			$data=array(
					'id'=> $this->current_user->id,
					'is_logged_in'=> true,
					'name'=> $this->current_user->name
				);
			$check_box = $this->input->post('remember_me');
			$this->session->set_userdata($data);
			if ($check_box == "remember") {

				$this->load->helper('cookie');
				$cookie_data=serialize($data);
				$cookie = array(
						    'name' => 'ph',
						    'value'  => $cookie_data,
						    'expire' => '60*60*24*365',
						    'domain' => 'noobonline.com',
						    'path'   => '/',
						    'prefix' => '',		    
						    'secure' => false
						  );
				set_cookie($cookie);
			}
			$this->session->set_flashdata('success', 'Welcome!');
			redirect('users/'.$this->current_user->id);
		}
		else{
			$data['title'] = 'Photo Sharing';  
			$data['main_content'] = 'sessions/sign_in';
			$this->load->view('view_template',$data);
		}
	}

	public function _authenticate_user()
	{
		$this->current_user=$this->user_model->check_credentials();
		if ($this->current_user) {
			return true;
		}
		else{
			$this->form_validation->set_message('_authenticate_user', 'Invalid username/password!');
			return false;
		}
	}

	public function signout()
	{
		if ($this->user_model->is_logged_in()) {
			$this->session->sess_destroy();
			redirect('login');
		}	
	}
}