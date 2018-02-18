<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Reviews extends CI_Controller {

	public function index()
	{
		
		//check if admin is logged in
		is_admin_logged_in();
		
		//load models
		$this->load->model('order_model', 'order');
		$this->load->model('restaurant_model', 'rest');
		
		$query = $this->db->query("SELECT * FROM kyd_reviews ORDER BY id DESC");
		$data['reviews'] = $query->result();
		
		$data['active_page'] = 'reviews';
		$this->load->view('panel/header', $data);
		$this->load->view('panel/reviews');
		$this->load->view('panel/footer');
	}
}