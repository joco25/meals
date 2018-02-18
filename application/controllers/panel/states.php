<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class States extends CI_Controller {

	public function index()
	{
		
		//check if admin is logged in
		is_admin_logged_in();
		
		//load models
		$this->load->model('order_model', 'order');
		$this->load->model('restaurant_model', 'rest');
		$query = $this->db->query("SELECT * FROM kyd_states");
		$data["states"] = $query->result();
		$state = $this->input->post('state');
		if(!empty($state))
		{
		if($this->db->query("INSERT INTO kyd_states (name) VALUES ('$state')"))
		{
			$data['success'] = "State Added Successfully!";
		}
		else $data['error'] = "An error Occured!";
		}
		
		$query = $this->db->query("SELECT * FROM kyd_states");
		$data["states"] = $query->result();
		$data['restaurants'] = $this->rest->getActiveRestaurants();
		
		$data['active_page'] = 'states';
		$this->load->view('panel/header', $data);
		$this->load->view('panel/states');
		$this->load->view('panel/footer');
	}
	public function edit($id)
	{
		//check if admin is logged in
		is_admin_logged_in();
		
		//load models
		$this->load->model('order_model', 'order');
		$this->load->model('restaurant_model', 'rest');
		
		$state = $this->input->post('name');
		if(!empty($state))
		{
			if($this->db->query("UPDATE kyd_states SET name = '$state' WHERE id = '$id'"))
			{
				$data['success'] = "State Updated Successfully!";
			}
			else $data['error'] = "An error Occured!";
		}
		
		$query = $this->db->query("SELECT * FROM kyd_states WHERE id = '$id'");
		$data["state"] = $query->row();
		$data['restaurants'] = $this->rest->getActiveRestaurants();
		
		$data['active_page'] = 'states';
		$this->load->view('panel/header', $data);
		$this->load->view('panel/states_details');
		$this->load->view('panel/footer');
	}
	public function delete($id)
	{
		//check if admin is logged in
		is_admin_logged_in();
		
		//load models
		$this->load->model('order_model', 'order');
		$this->load->model('restaurant_model', 'rest');

		if($this->db->query("DELETE FROM kyd_states WHERE id = $id"))
		{
			$data['success'] = "State Deleted Successfully!";
		}
		else $data['error'] = "An error Occured!";
		
		$query = $this->db->query("SELECT * FROM kyd_states");
		$data["states"] = $query->result();
		$data['restaurants'] = $this->rest->getActiveRestaurants();
		
		$data['active_page'] = 'states';
		$this->load->view('panel/header', $data);
		$this->load->view('panel/states');
		$this->load->view('panel/footer');
	}
}