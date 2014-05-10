<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Albums extends CI_Controller {
	function __construct() {
		parent::__construct();
 		if (!($this->user_model->is_logged_in())) {
 			$this->session->set_flashdata('danger', 'Please sign in!');
 			redirect('/');
 		}

	}

	public function index()
	{
		
	}
}