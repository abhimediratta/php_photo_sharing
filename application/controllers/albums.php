<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require APPPATH.'libraries/Cloudinary.php';
require APPPATH.'libraries/Uploader.php';
require APPPATH.'libraries/Api.php';
require APPPATH.'libraries/Cloudinary_config.php';
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
		$this->load->model('album_model');
		$albums=$this->album_model->find_albums();
		$data['albums']=$albums;
		$data['title'] = 'Albums';  
		$data['main_content'] = 'albums/index';
		$this->load->view('view_template',$data);
	}

	public function new_album()
	{
		$data['title'] = 'New Album';
		$data['main_content'] = 'albums/new';
		$this->load->view('view_template',$data);
	}

	public function add_album()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="bg-danger mrgn_bottom">', '</div>');
		if ($this->form_validation->run()) {
			$this->load->model('album_model');
			$check=$this->album_model->create();
			if ($check) {
				$this->session->set_flashdata('success', 'Album created');
				redirect('/albums/'.$this->db->insert_id());
			}
			else{
				$this->session->set_flashdata('danger', 'Some error occurred');
			}
		}
		else{
			$data['title'] = 'New Album';
			$data['main_content'] = 'albums/new';
			$this->load->view('view_template',$data);
		}
	}

	public function upload()
	{
		if(isset($_FILES['file'])) {
	  		$this->load->model('album_model');
	  		$this->album_model->add_photo();
		}
	}

	public function show($album_id='')
	{
		$this->load->model('album_model');
		$album_photos=$this->album_model->find_album_photos($album_id);
		if ($album_photos || $this->album_model->check_album($album_id)) {
			$album_title=$this->album_model->get_title($album_id);
			$data['album_id']=$album_id;
			$data['album_photos']=$album_photos;
			$data['title'] = $album_title;
			$data['main_content'] = 'albums/show';
			$this->load->view('view_template',$data);	
		}
		else{
			$this->session->set_flashdata('danger', 'Album doesn\'t exist \\ is restricted');
			redirect('/albums');
		}
		
		
	}
}