<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photos extends CI_Controller {
	


	public function index()
	{
		if (($this->user_model->is_logged_in())) {
			$this->load->model('photo_model');
			$photo_details=$this->photo_model->find_photos($this->session->userdata('id'));
			$data['title'] = 'Details';  
			$data['user']=$user;
			$data['main_content'] = 'photos/index';
			$this->load->view('view_template',$data);
		}
		else{
			redirect('sessions');
		}
	}

	public function add_photos()
	{
		Cloudinary::config(array( 
  			"cloud_name" => "photo-sharing", 
  			"api_key" => "633887252945579", 
  			"api_secret" => "nFJuO5ToNUai_7e9S9LXgr78RFs" 
		));	
		if (($this->user_model->is_logged_in())) {
			$user=$this->user_model->getUserData($this->session->userdata('id'));

			$this->load->model('photo_model');
			$photo_details=$this->photo_model->find_photos($this->session->userdata('id'));

			$data['title'] = 'Details';  
			$data['user']=$user;
			$data['main_content'] = 'photos/new';
			$this->load->view('view_template',$data);
		}
		else{
			redirect('sessions');
		}	
	}

	public function upload()
	{
		# code...
	}

}