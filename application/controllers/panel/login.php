<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	

	public function index()
	{
		$this->load->helper(array('form', 'url'));		
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
		
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|callback_login_check');
		$this->form_validation->set_rules('password', 'Password', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view('panel/login');
		}
		else
		{
			redirect('/panel/home/', 'refresh');
		}
	}
	
	
	public function login_check($username) {
			$username = $this->input->post('username');
			$password = md5($this->input->post('password'));
			
			$query = $this->db->query("SELECT * FROM kyd_admin WHERE username = '$username'");
			if($query->num_rows() == 1)
			{
				$row = $query->row();
				if($password == $row->password)
				{
					$newdata = array(
					   'admin'  => $username,
					   'name'     => $row->name,
					   'admin_id' => $row->id
				   );
				$this->session->set_userdata($newdata);
				return TRUE;
					
				}
				else 
				{
					$this->form_validation->set_message('login_check', 'Incorrect username or password!');
					return false;
				}
			}
			else {
				$this->form_validation->set_message('login_check', 'Incorrect username or password!');
				return false;
			}
			
	}
	public function logout()
	{
		$array_items = array('admin' => '', 'name' => '', 'admin_id' => '');
		$this->session->unset_userdata($array_items);
		redirect('/panel/home/', 'refresh');
	}
}