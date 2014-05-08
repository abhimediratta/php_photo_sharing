<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/Cloudinary.php';
require APPPATH.'libraries/Uploader.php';
require APPPATH.'libraries/Api.php';
require APPPATH.'libraries/Cloudinary_config.php';
class Photos extends CI_Controller {
	
	public function index()
	{
		if (($this->user_model->is_logged_in())) {
			$user=$this->user_model->getUserData($this->session->userdata('id'));
			$this->load->model('photo_model');
			$photo_details=$this->photo_model->find_photos();
			$data['photos']=$photo_details;
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
		if (($this->user_model->is_logged_in())) {
			
			if(isset($_FILES['file'])) {
	  			$this->load->model('photo_model');
	  			$this->photo_model->add_photo();
			}
		}
		
	}

}