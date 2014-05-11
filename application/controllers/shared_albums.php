<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH.'libraries/Cloudinary.php';
require APPPATH.'libraries/Cloudinary_config.php';

class Shared_Albums extends CI_Controller {
	public function show($id='')
	{
		$this->load->model('shared_album_model');
		$decrypted=urldecode($id);
		$this->load->library('encrypt');
		$shared_album_id=base64_decode($decrypted);;
		
		$album_id=$this->shared_album_model->get_album_id($shared_album_id);
		$this->load->model('album_model');
		$album_photos=$this->album_model->find_album_photos($album_id);
		$album_title=$this->album_model->get_title($album_id);

		$data['album_photos']=$album_photos;
		$data['title'] = $album_title;
		$data['main_content'] = 'shared_albums/show';
		$this->load->view('view_template',$data);
	}
}