<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restaurant extends CI_Controller {
	
	public function index()
	{
		redirect('/search', 'refresh');
	}

	public function get_restaurant($slug)
    {
		$this->load->model('restaurant_model', 'rest');
        $data['restaurant'] = $this->rest->getRestaurant($slug);
		$data['similar_spots'] = $this->rest->getSimilarSpots($slug, $data['restaurant']->rest_city, $data['restaurant']->rest_state);
		if($this->rest->getNoOfRating($data['restaurant']->id) > 0)
		{
			$data['reviews'] = $this->rest->getApprovedReviews($data['restaurant']->id);
		}
		if($this->session->userdata('rest_slug') == $slug)
		{
			
		}
		else {
			if($this->rest->addHit($slug))
			{
				$newdata = array(
                   'rest_slug'  => $slug
               );
				$this->session->set_userdata($newdata);
			}
		}
		$data['menu'] = $this->rest->getMenu($data['restaurant']->id);
		$data['categories'] = $this->rest->getMenuCategories($data['restaurant']->id);
		$data['hours'] = $this->rest->getHours($data['restaurant']->id);
		$this->load->view('header', $data);
		$this->load->view('restaurant');
		$this->load->view('footer');
    }
	public function review($slug)
	{
		$this->load->model('restaurant_model', 'rest');
        $data['restaurant'] = $this->rest->getRestaurant($slug);
		$data['similar_spots'] = $this->rest->getSimilarSpots($slug, $data['restaurant']->rest_city, $data['restaurant']->rest_state);
		if($this->rest->getNoOfRating($data['restaurant']->id) > 0)
		{
			$data['reviews'] = $this->rest->getApprovedReviews($data['restaurant']->id);
		}
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$title = $this->input->post('title');
		$review = $this->input->post('review');
		$rating = $this->input->post('rating');
		$id = $data['restaurant']->id;
		$review_status = $this->rest->addReview($id, $name, $email, $title, $review, $rating);
		if($review_status)
		{
			$data['message'] = "Thank you for reviewing this restaurant. Review Submitted!";
		}
		else {
			$data['message'] = "An error occured while submitting your review. Pls try again!";
		}
		$data['hours'] = $this->rest->getHours($data['restaurant']->id);
		$this->load->view('header', $data);
		$this->load->view('restaurant_review');
		$this->load->view('footer');
	}
	public function order($slug)
	{
		$this->load->model('restaurant_model', 'rest');
        $data['restaurant'] = $this->rest->getRestaurant($slug);
		$data['similar_spots'] = $this->rest->getSimilarSpots($slug, $data['restaurant']->rest_city, $data['restaurant']->rest_state);
		if($this->rest->getNoOfRating($data['restaurant']->id) > 0)
		{
			$data['reviews'] = $this->rest->getApprovedReviews($data['restaurant']->id);
		}
		
		$menu = $this->rest->getMenu($data['restaurant']->id);
		$order = array();
		foreach($menu as $item)
		{
			if($this->input->post('quantity'.$item->id) > 0)
			{
				$order[$item->id] = $this->input->post('quantity'.$item->id);
			}
		}
		
		/*foreach($order as $key => $value)
		{
			echo $key;
		}*/
		$id = $data['restaurant']->id;
		$data['customOrder'] = $this->input->post('customOrder');
		$data['order'] = $order;
		$this->session->set_userdata(array('order'  => $order));
		$data['hours'] = $this->rest->getHours($data['restaurant']->id);
		
		$this->load->view('header', $data);
		$this->load->view('restaurant_order');
		$this->load->view('footer');
	}
	public function confirm($slug)
	{
		$this->load->model('restaurant_model', 'rest');
		$this->load->model('order_model', 'order');
        $data['restaurant'] = $this->rest->getRestaurant($slug);
		$data['similar_spots'] = $this->rest->getSimilarSpots($slug, $data['restaurant']->rest_city, $data['restaurant']->rest_state);
		$data['hours'] = $this->rest->getHours($data['restaurant']->id);
		if($this->rest->getNoOfRating($data['restaurant']->id) > 0)
		{
			$data['reviews'] = $this->rest->getApprovedReviews($data['restaurant']->id);
		}
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$phone_no = $this->input->post('phone_no');
		$address = $this->input->post('address');
		$total = $this->input->post('total');
		$s_order = $this->session->userdata('s_order');
		$customOrder = $this->input->post('customOrder');
		$order = array();
		foreach($this->cart->contents() as $items)
		{
			$order[$items['id']] = $items['qty'];
		}
		$menu = $this->rest->getMenu($data['restaurant']->id);
		$rest_id = $data['restaurant']->id;
		$add_info = $this->input->post('add_info');
		$preorder = $this->input->post('preorder');
		$payment_type = $this->input->post('payment');
		$timestamp = time();
		$ip = $this->session->userdata('ip_address');
		$pre_name = $this->input->post('name');
		
		if($order && $order != $s_order)
		{
			$this->session->set_userdata('s_order', $order);
			$con_total = 0;
			foreach($order as $key => $value)
			{
				$item = $this->rest->getMenuItemDetails($key);
				$cost = $item->price * $value;
				$con_total += $cost;
			}
			$service_fee = $data['restaurant']->service_fee * $con_total / 100;
			$con_total = $data['restaurant']->delivery_fee + $service_fee + $con_total; 
			if($total == $con_total)
			{
				$raw_order = serialize($order);
				if($payment_type == 'delivery')
				{
					$payment_status = 1;
					if($this->rest->addOrder($name, $address, $email, $phone_no, $rest_id, $add_info, $raw_order, $customOrder, $data['restaurant']->delivery_fee, $service_fee, $total, $preorder, $payment_type, $payment_status, $timestamp, $ip))
					{
						$order_id = $this->db->insert_id();
						$data['name'] = $name;
						$data['address'] = $address;
						$data['email'] = $email;
						$data['phone_no'] = $phone_no;
						$data['add_info'] = $add_info;
						$data['order'] = $order;
						$data['total'] = $total;
						$data['customOrder'] = $customOrder;
						$data['service_fee'] = $service_fee;
						$data['payment_type'] = $payment_type;
						$data['message'] = "Your order has been received and would be processed shortly. Here are your order details. Your Order ID is <b>#".$order_id."</b>";
						
						
						$this->rest->sendOrderConfirmEmail($email, $data);
						$user_order = "";
						foreach($order as $key => $value)
						{
							$item = $this->rest->getMenuItemDetails($key);
							$cost = $item->price * $value;
							$user_order .= $item->name.'(NGN'.number_format($item->price).') x '.$value.'= NGN'.number_format($cost).' [Service fee and Delivery fee inclusive] ';
						}
						
						$this->rest->sendOrderConfirmSms($data['restaurant']->id, $user_order, $total, $phone_no);
						$this->rest->sendRestOrderConfirmSms($data['restaurant']->id, $user_order, $total, $name, $address, $phone_no, $add_info);
						$this->order->updateOrder("messaged", 0, $order_id);
						$this->cart->destroy(); // Destroy all cart data
					}
				}
			}
			else {
				$data['error'] = "An error occured! Please try again!";
			}
		}
		elseif(!empty($customOrder))
		{
			$raw_order = serialize($order);
			if($payment_type == 'delivery')
				{
					$service_fee = 0;
					$total = 0;
					$payment_status = 1;
					if($this->rest->addOrder($name, $address, $email, $phone_no, $rest_id, $add_info, $raw_order, $customOrder, $data['restaurant']->delivery_fee, $service_fee, $total, $preorder, $payment_type, $payment_status, $timestamp, $ip))
					{
						$order_id = $this->db->insert_id();
						$data['name'] = $name;
						$data['address'] = $address;
						$data['email'] = $email;
						$data['phone_no'] = $phone_no;
						$data['add_info'] = $add_info;
						$data['order'] = $order;
						$data['total'] = $total;
						$data['customOrder'] = $customOrder;
						$data['service_fee'] = $service_fee;
						$data['payment_type'] = $payment_type;
						$data['message'] = "Your order has been received and would be processed shortly. Here are your order details. Your Order ID is <b>#".$order_id."</b>";
						
						
						$this->rest->sendOrderConfirmEmail($email, $data);
						$user_order = "";
						foreach($order as $key => $value)
						{
							$item = $this->rest->getMenuItemDetails($key);
							$cost = $item->price * $value;
							$user_order .= $item->name.'(NGN'.number_format($item->price).') x '.$value.'= NGN'.number_format($cost).' [Service fee and Delivery fee inclusive] ';
						}
						
						$this->rest->sendOrderConfirmSms($data['restaurant']->id, $user_order, $total, $phone_no);
						$this->rest->sendRestOrderConfirmSms($data['restaurant']->id, $user_order, $total, $name, $address, $phone_no, $add_info);
						$this->order->updateOrder("messaged", 0, $order_id);
						$this->cart->destroy(); // Destroy all cart data
					}
				}
		}
		else 
		{
			$data['error'] = "An error has occured! Your order may have been processed already. Please try again!";
		}
		
		$this->load->view('header', $data);
		$this->load->view('restaurant_confirm');
		$this->load->view('footer');
	}
	function add_cart_item($slug){
     	$this->load->model('cart_model');
		if($this->cart_model->validate_add_cart_item() == TRUE){
			 
			// Check if user has javascript enabled
			if($this->input->post('ajax') != '1'){
				redirect('restaurant/'.$slug.'/'); // If javascript is not enabled, reload the page with new data
			}else{
				echo 'true'; // If javascript is enabled, return true, so the cart gets updated
			}
		}
		 
	}
	function show_cart($slug){
		$data['slug'] = $slug;
		$this->load->view('shopping_cart', $data);
	}
	function update_cart($slug){
		$this->load->model('cart_model');
		$this->cart_model->validate_update_cart();
		redirect('restaurant/'.$slug.'/order');
	}
	function empty_cart($slug){
		$this->cart->destroy(); // Destroy all cart data
		redirect('restaurant/'.$slug.'/'); // Refresh te page
	}
}