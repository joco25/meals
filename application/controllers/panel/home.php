<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		//check if admin is logged in
		is_admin_logged_in();
		
		//load models
		$this->load->model('order_model', 'order');
		$this->load->model('restaurant_model', 'rest');
		
		$data['pending_orders'] = $this->order->getOrderCount('pending');
		$data['in_progress_orders'] = $this->order->getOrderCount('in_progress');
		$data['completed_orders'] = $this->order->getOrderCount('completed');
		$data['reg_restaurants'] = $this->rest->numRestaurants();
		
		if($data['pending_orders'] > 0)
		{
			$data['pending'] = $this->order->getOrders('pending');
		}
		$data['processed'] = $this->order->getProcessedOrders('pending');
		
		$data['active_page'] = 'home';
		$this->load->view('panel/header', $data);
		$this->load->view('panel/home');
		$this->load->view('panel/footer');
	}
}