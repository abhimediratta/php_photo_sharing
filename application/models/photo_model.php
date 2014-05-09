<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_model extends CI_Model {
	public function find_photos()
	{
		$user_id=$this->session->userdata('id');
		$query="SELECT id,photo_url FROM photos WHERE user_id = ?";
		$query_result=$this->db->query($query,array($user_id));
		$result=$query_result->result_array();
		return $result;
	}

	public function add_photo()
	{
		$result=\Cloudinary\Uploader::upload($_FILES['file']['tmp_name'],array(
  					'width' => 400, 'height' => 450, 
                                'crop' => 'fit', 'format' => 'png'
  				));
		$query="INSERT INTO photos (user_id,photo_url) VALUES (?,?)";
		$user_id=$this->session->userdata('id');
		$result=$this->db->query($query,array($user_id,$result['url']));
	}

	public function get_photo_details($id='')
	{
		$query="SELECT id,photo_url,caption FROM photos WHERE id = ? LIMIT 1";
		$result=$this->db->query($query,array($user_id))->row();

		return $result;
	}

	public function update()
	{
		$query="UPDATE photos SET caption = ? WHERE id = ?";
		$id=$this->input->post('id');
		$result=$this->db->query($query,array($id));
		if ($result) {
			return true;
		}
		else{
			return false;
		}
	}
}