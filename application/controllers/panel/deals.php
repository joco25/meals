<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deals extends CI_Controller {

	public function index()
	{
		
		//check if admin is logged in
		is_admin_logged_in();
		
		//load models
		$this->load->model('order_model', 'order');
		$this->load->model('restaurant_model', 'rest');
		
		$rest_id = $this->input->post('restaurant');
		$percent = $this->input->post('percent');
		$date = date('Y-m-d');
		if(!empty($rest_id))
		{
		if($this->db->query("INSERT INTO kyd_deals (rest_id, percent, last_updated) VALUES ('$rest_id', '$percent', '$date')"))
		{
			$data['success'] = "Deal Added Successfully!";
		}
		else $data['error'] = "An error Occured!";
		}
		
		$query = $this->db->query("SELECT * FROM kyd_deals ORDER BY id DESC");
		$data['deals'] = $query->result();
		$data['restaurants'] = $this->rest->getActiveRestaurants();
		
		$data['active_page'] = 'deals';
		$this->load->view('panel/header', $data);
		$this->load->view('panel/deals');
		$this->load->view('panel/footer');
	}
	public function edit($id)
	{
		//check if admin is logged in
		is_admin_logged_in();
		
		//load models
		$this->load->model('order_model', 'order');
		$this->load->model('restaurant_model', 'rest');
		
		$percent = $this->input->post('percent');
		$date = date('Y-m-d');
		if(!empty($percent))
		{
		if($this->db->query("UPDATE kyd_deals SET percent = '$percent', last_updated = '$date' WHERE id = '$id'"))
		{
			$data['success'] = "Deal Updated Successfully!";
		}
		else $data['error'] = "An error Occured!";
		}
		
		$query = $this->db->query("SELECT * FROM kyd_deals WHERE id = '$id'");
		$data['deal'] = $query->row();
		$data['restaurants'] = $this->rest->getActiveRestaurants();
		
		$data['active_page'] = 'deals';
		$this->load->view('panel/header', $data);
		$this->load->view('panel/deal_details');
		$this->load->view('panel/footer');
	}
}