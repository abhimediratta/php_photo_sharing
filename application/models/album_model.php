<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Album_model extends CI_Model {
	public function create()
	{
		$user_id=$user_id=$this->session->userdata('id');
		$title=$this->input->post('title');
		$query="INSERT INTO albums (user_id,title) VALUES (?,?)";
		$query_result=$this->db->query($query,array($user_id,$title));

		return $query_result;
	}

	public function find_album_photos($album_id='')
	{
		$user_id=$user_id=$this->session->userdata('id');
		$query="SELECT * FROM photos WHERE user_id = ? and album_id = ?";
		$query_result=$this->db->query($query,array($user_id,$album_id))->result_array();

		return $query_result;
	}

	public function find_albums()
	{
		$user_id=$this->session->userdata('id');
		$query="SELECT id,title FROM albums WHERE user_id = ?";
		$query_result=$this->db->query($query,array($user_id));
		if ($query_result->num_rows() > 0) {
			foreach ($query_result->result() as $row) {
				$query="SELECT * FROM photos WHERE album_id = ? LIMIT 5";
				$query_photos=$this->db->query($query,array($row->id))->result_array();
				$row->photos=$query_photos;
			}
		}
		return $query_result;
	}

	public function add_photo()
	{
		$result=\Cloudinary\Uploader::upload($_FILES['file']['tmp_name'],array(
  					'width' => 400, 'height' => 450, 
                                'crop' => 'fit', 'format' => 'png'
  				));
		$query="INSERT INTO photos (user_id,photo_url,album_id) VALUES (?,?,?)";
		$album_id=$this->input->post('album_id');
		$user_id=$this->session->userdata('id');
		$result=$this->db->query($query,array($user_id,$result['url'],$album_id));
	}

	public function get_title($album_id='')
	{
		$query="SELECT title FROM albums WHERE id = ? LIMIT 1";
		$query_result=$this->db->query($query,array($album_id))->row();
		return $query_result->title;
	}

}

