<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	function index()
	{
		//$this->load->view('sign_up');
	}

	function add_new_user()
	{
		$this->load->library('bcrypt');
		$password=$this->input->post('password');
		$hash = $this->bcrypt->hash($password);
		if ( strlen( $hash ) < 20 ) {
 			//exit("Failed to hash new password");
 		}
 		else{
 			
 			$name=$this->input->post('name');
 			$email=$this->input->post('email');
 			$query="INSERT INTO USERS (name,email,password_digest) VALUES(?,?,?)";
 			$result=$this->db->query($query,array($name,$email,$hash));
 			/*$new_user_data = array('email' => $this->input->post('email'),
		 			'name' => $this->input->post('name'),
		 			'password_digest' => $hash );
 			$result=$this->db->insert('users',$new_user_data);*/
 			if ($result) {
 				return true;
 			}
 			else{
 				return false;
 			}
 		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */