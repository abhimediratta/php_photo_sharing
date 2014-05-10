<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/Cloudinary.php';
require APPPATH.'libraries/Uploader.php';
require APPPATH.'libraries/Api.php';
require APPPATH.'libraries/Cloudinary_config.php';
class Photos extends CI_Controller {
	
	function __construct() {
		parent::__construct();
 		if (!($this->user_model->is_logged_in())) {
 			$this->session->set_flashdata('danger', 'Please sign in!');
 			redirect('/');
 		}

	}
	
	public function delete_photo($id='')
	{
		$this->load->model('photo_model');
		$this->photo_model->delete($id);
		$this->session->set_flashdata('success', 'Deleted successfully');
		$ref = $_SERVER['HTTP_REFERER'];
		redirect($ref);
	}

	public function update($id='')
	{
			
		$this->load->model('photo_model');
		$photo=$this->photo_model->get_photo_details($id);
		if ($photo->user_id == $this->session->userdata('id')) {
			$user=$this->user_model->getUserData($this->session->userdata('id'));
			$data['photo']=$photo;
			$data['title'] = 'Edit Caption';
			$data['user']=$user;
			$data['main_content'] = 'photos/edit';
			$this->load->view('view_template',$data);
		}
		else{
			$ref = $_SERVER['HTTP_REFERER'];
			$this->session->set_flashdata('danger', 'Restricted');
			redirect($ref);
		}
						
	}

	public function update_photo()
	{
			$this->load->model('photo_model');
			$result=$this->photo_model->update();
			redirect('/albums');
	}


}