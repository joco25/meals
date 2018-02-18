<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class View extends CI_Controller {

	public function index()
	{
		redirect('view/restaurant');
	}
	public function restaurants()
	{
		$this->load->model('restaurant_model', 'rest');
		$data['results'] = $this->rest->getAllActiveByType('restaurant');
		$data['type'] = 'restaurants';
		$this->load->view('header', $data);
		$this->load->view('listings');
		$this->load->view('footer');
	}
	public function stores() 
	{
		$this->load->model('restaurant_model', 'rest');
		$data['results'] = $this->rest->getAllActiveByType('store');
		$data['type'] = 'stores';
		$this->load->view('header', $data);
		$this->load->view('listings');
		$this->load->view('footer');
	}

	public function stateRestaurants(){
		$state = $this->uri->segment(3);
		$this->load->model('restaurant_model','rest');
		$data['results']= $this->rest->getStateRestaurants($state);
		$data['type'] = 'restaurants';
		$data['heading']= $state;
		$this->load->view('header', $data);
		$this->load->view('listings');
		$this->load->view('footer');
	}
}