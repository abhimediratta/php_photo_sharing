<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sessions extends CI_Controller {
	var $current_user;

	public function index()
	{
		$data['title'] = 'Photo Sharing';  
		$data['main_content'] = 'sessions/sign_in';
		$this->load->view('view_template',$data);
	}

	public function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="bg-danger mrgn_bottom">', '</div>');

		if ($this->form_validation->run()) {
			$data=array(
					'id'=> $this->current_user->id,
					'is_logged_in'=> true
				);
			$this->session->set_userdata($data);
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
		$this->load->model('user_model');
		$this->current_user=$this->user_model->check_credentials();
		if ($this->current_user) {
			return true;
		}
		else{
			$this->form_validation->set_message('_authenticate_user', 'Invalid username/password!');
			return false;
		}
	}
}