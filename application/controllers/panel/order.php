<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Order extends CI_Controller {

	public function get_order($id)
	{
		
		//check if admin is logged in
		is_admin_logged_in();
		
		//load models
		$this->load->model('order_model', 'order');
		$this->load->model('restaurant_model', 'rest');
		$data['id'] = $id;
		
		$new_status = $this->input->post('new_status');
		$handler = $this->session->userdata('admin_id');
		
		if(!empty($new_status) && $new_status != 'null')
		{
			if($this->order->updateOrder($new_status, $handler, $id))
			{
				$data['success'] = "Updated successfully!";
			}
			else $data['error'] = "Updated successfully!";
		}
		
		$data['order'] = $this->order->getOrder($id);
		
		$data['active_page'] = 'home';
		$this->load->view('panel/header', $data);
		$this->load->view('panel/order');
		$this->load->view('panel/footer');
	}
}