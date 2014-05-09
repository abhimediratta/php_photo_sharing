<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public function index()
	{
		
	}

	public function signup()
	{
		$data['title'] = 'Sign Up!';  
		$data['main_content'] = 'users/signup';
		$this->load->view('view_template',$data);
	}

	public function add_user(){
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="bg-danger mrgn_bottom">', '</div>');
		
		if ($this->form_validation->run()) {
			
			if ($this->user_model->add_new_user()) {
				redirect('users');
			}
			else{
				$data['title'] = 'Sign Up!';  
				$data['main_content'] = 'users/signup';
				$this->load->view('view_template',$data);	
			}
			
		}
		else{
			$data['title'] = 'Sign Up!';  
			$data['main_content'] = 'users/signup';
			$this->load->view('view_template',$data);
		}
	}

	public function _check_unique_email(){
		if ($this->user_model->check_unique()) {
			return true;
		}
		else{
			$this->form_validation->set_message('_check_unique_email', 'Seems you\'re already registered!');
			return false;
		}
		
	}

	

	public function show($id)
	{
		if (!($this->user_model->is_logged_in())) {
			redirect('sessions');
		}
		else if($id == $this->session->userdata('id')){
			$user=$this->user_model->getUserData($id);
			
			$data['title'] = 'Details';  
			$data['user']=$user;
			$data['main_content'] = 'users/show';
			$this->load->view('view_template',$data);
		}
		else{
			show_404();
		}
	}

	public function update($id='')
	{
		if (!($this->user_model->is_logged_in())) {
			redirect('sessions');
		}
		else if($id == $this->session->userdata('id')){
			$user=$this->user_model->getUserData($id);
			
			$data['title'] = 'Details';  
			$data['user']=$user;
			$data['main_content'] = 'users/edit';
			$this->load->view('view_template',$data);
		}
		else{
			show_404();
		}
	}

	public function update_user()
	{
		if (($this->user_model->is_logged_in()) && ($this->session->userdata('id') == $this->input->post('id'))) {
			$this->load->model('user_model');
			$this->load->library('form_validation');
			$this->form_validation->set_error_delimiters('<div class="bg-danger mrgn_bottom">', '</div>');
			if ($this->form_validation->run()) {
				$result=$this->user_model->update();
				$redirect_to='users/'.$this->session->userdata('id');
				redirect($redirect_to);	
			}
			else{
				/*$redirect_to='users/edit/'.$this->session->userdata('id');
				redirect($redirect_to);	*/
				$user=$this->user_model->getUserData($this->session->userdata('id'));
				$data['title'] = 'Sign Up!';
				$data['user']=$user;  
				$data['main_content'] = 'users/edit';
				$this->load->view('view_template',$data);
			}		
			
		}else{
			redirect('sessions');
		}
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */