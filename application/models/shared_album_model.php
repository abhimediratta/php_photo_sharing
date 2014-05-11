<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Shared_Album_model extends CI_Model {
	public function add_shared_album($album_id='')
	{
		$query="INSERT INTO shared_albums (album_id) VALUES (?)";
		$query_result=$this->db->query($query,array($album_id));
	}

	public function get_album_id($shared_album_id='')
	{
		$query="SELECT album_id FROM shared_albums WHERE id = ? LIMIT 1";
		$query_result=$this->db->query($query,array($shared_album_id))->row();
		return $query_result->album_id;
	}
}