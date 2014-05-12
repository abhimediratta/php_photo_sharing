<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	function index()
	{
		//$this->load->view('sign_up');
	}
	public function getUserData($id='')
	{
		$query="SELECT name,id,email FROM users WHERE id = ? LIMIT 1";
		$result=$this->db->query($query,array($id));
		if ($result->num_rows() > 0) {
			$user=$result->row();
			return $user;
		}
		else{
			return false;
		}
	}

	public function is_logged_in(){
		$is_logged_in = $this->session->userdata('is_logged_in');
		if(!isset($is_logged_in) || $is_logged_in != true)
		{				
			return false;
		}else{
			return true;
		}		
	}


	function add_new_user()
	{
		$this->load->library('bcrypt');
		$password=$this->input->post('password');
		$hash = $this->bcrypt->hash($password);
		
 		$name=$this->input->post('name');
 		$email=$this->input->post('email');
 		$query="INSERT INTO users (name,email,password_digest) VALUES(?,?,?)";
 		$result=$this->db->query($query,array($name,$email,$hash));
 		
 		if ($result) {
 			$check_email_query="SELECT id FROM users WHERE email = ? LIMIT 1";
 			$check_email=$this->db->query($check_email_query,array($email))->row();
 			$data=array('id'=>$check_email->id,
 						'is_logged_in'=> true,
 						'name' => $name
 						);
 			$this->session->set_userdata($data);
 			return true;
 		}
 		else{
 			return false;
 		}
 		
	}

	public function update()
	{
		$this->load->library('bcrypt');
		
		$password=$this->input->post('password');
		$hash = $this->bcrypt->hash($password);
		$user_id=$this->input->post('id');
 		$name=$this->input->post('name');
 		$email=$this->input->post('email');
 		
 		$query="UPDATE users SET name = ?,email = ?,password_digest = ? WHERE id = ?";
 		$result=$this->db->query($query,array($name,$email,$hash,$user_id));

 		if ($result) {
 			return true;
 		}
 		else{
 			return false;
 		}
	}

	public function check_unique()
	{
		$email=$this->input->post('email');
 		$check_email_query="SELECT email FROM users WHERE email = ? LIMIT 1";
 		$check_email=$this->db->query($check_email_query,array($email));
 		
 		if ($check_email->num_rows() > 0) {
 			return false;
 		}
 		else
 			return true;
	}

	public function check_credentials()
	{
		$email=$this->input->post('email');
		$password=$this->input->post('password');
		$this->load->library('bcrypt');
		
 		$check_email_query="SELECT * FROM users WHERE email = ? LIMIT 1";
 		$check_email=$this->db->query($check_email_query,array($email));
 		
 		if ($check_email->num_rows() > 0) {
 			$row=$check_email->row();	
 			if ($this->bcrypt->compare($password,$row->password_digest)) {
 				return $row;
 			}
 			else
 				return false;
 		}
 		else{
 			return false;
 		}
	}

	public function get_session_cookie()
	{
		$cookie_data = get_cookie('ph');		
		$value = unserialize($cookie_data);
		$user_id = $value['id'];
		$data=array(
					'id'=>$user_id,
					'is_logged_in'=> true
				);
		if(!$this->session->set_userdata($data)){					
			$this->session->set_userdata($data);
		}
	}



}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */