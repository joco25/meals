<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class About extends CI_Controller {

	public function index()
	{
		$this->load->model('restaurant_model', 'rest');
		$query = $this->db->query("SELECT * FROM kyd_states");
		$data["states"] = $query->result();
		$data['pop_rest'] = $this->rest->getPopularRestaurants();

		$this->load->view('header', $data);
		$this->load->view('about_us');
		$this->load->view('footer', $data);
	}
}