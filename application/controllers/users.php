<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		//$this->load->view('sign_up');
	}

	public function add()
	{
		$this->load->view('users/add');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */