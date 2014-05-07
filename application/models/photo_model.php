<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Photo_model extends CI_Model {
	public function find_photos($user_id='')
	{
		$query="SELECT id,photo_url FROM photos WHERE email = ? LIMIT 1";
	}
}