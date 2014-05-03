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
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */