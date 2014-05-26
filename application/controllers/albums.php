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
				$this->load->model('shared_album_model');
				$this->shared_album_model->add_shared_album($this->db->insert_id());
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
		log_message('debug',"asdbaksdbkasdbkajsbdkj");
		if(isset($_FILES['file'])) {
	  		$this->load->model('album_model');
	  		//system("file -bi $uploadedfile")
	  		//log_message('debug',"test".print_r($_FILES['file']['tmp_name']));
	  		$finfo = finfo_open(FILEINFO_MIME_TYPE);
	  		
  			$file_type=finfo_file($finfo, $_FILES['file']['tmp_name']);
	  		finfo_close($finfo);
	  		if (strpos($file_type,'image') !== false) {
    			$this->album_model->add_photo();
			}
			else{
				header('Content-Type: application/json');
				$respone_array=array('fail' => true,'message'=>'Please check if the file is an image!' );
				echo json_encode($respone_array);
			}
	  		//$test_file='';
	  		//system("file --mime-type ".escapeshellarg($_FILES['file']['tmp_name']),$test_file);
	  		//$file_type = @mime_content_type($_FILES['file']['tmp_name']);
	  		//$this->output->set_output(json_encode(array('foo' => $file_type)));
	  		//print_r($file_type);
	  		//$info = getimagesize($_FILES['file']['tmp_name']);
    		//print image_type_to_mime_type($info[2]);
    		//print_r($info[2]);
	  		//log_message('debug',print_r($test_file));
			//log_message('debug',print_r(IMAGETYPE_IFF));
			//if (strlen($this->file_type) > 0) return;
	  		//
		}
	}

	public function show($album_id='')
	{
		$this->load->model('album_model');
		$album_photos=$this->album_model->find_album_photos($album_id);
		if ($album_photos || $this->album_model->check_album($album_id)) {
			$shared_album_id=$this->album_model->get_shared_album_url($album_id);
			$album_title=$this->album_model->get_title($album_id);
			$data['shared_album_id']=$shared_album_id;
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