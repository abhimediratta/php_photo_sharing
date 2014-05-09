<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/Cloudinary.php';
require APPPATH.'libraries/Uploader.php';
require APPPATH.'libraries/Api.php';
require APPPATH.'libraries/Cloudinary_config.php';
class Photos extends CI_Controller {
	
	function __construct() {
 		if (!($this->user_model->is_logged_in())) {
 			redirect('sessions');
 		}

	}
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
		}else{
			redirect('sessions');
		}
		
	}

	public function delete_photo($id='')
	{
		if (($this->user_model->is_logged_in())) {
						
		}else{
			redirect('sessions');
		}
	}

	public function update($id='')
	{
		if (($this->user_model->is_logged_in())) {
			$this->load->model('photo_model');
			$data['photo']=$this->photo_model->get_photo_details($id);
			$data['title'] = 'Details';
			$data['user']=$user;
			$data['main_content'] = 'photos/edit';
			$this->load->view('view_template',$data);			
		}else{
			redirect('sessions');
		}
	}

	public function update_photo()
	{
		if (($this->user_model->is_logged_in())) {
			$this->load->model('photo_model');
			$result=$this->photo_model->update();
			redirect('photos');
		}else{
			redirect('sessions');
		}
	}

}