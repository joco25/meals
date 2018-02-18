<?php
 
class Cart extends CI_Controller { // Our Cart class extends the Controller class
	
	function index()
	{
		$this->load->model('cart_model');
		$data['products'] = $this->cart_model->retrieve_products(); // Retrieve an array with all products
		$this->load->view('header', $data);
		$this->load->view('cart');
		$this->load->view('footer');
	}
	function add_cart_item(){
     	$this->load->model('cart_model');
		if($this->cart_model->validate_add_cart_item() == TRUE){
			 
			// Check if user has javascript enabled
			if($this->input->post('ajax') != '1'){
				redirect('cart'); // If javascript is not enabled, reload the page with new data
			}else{
				echo 'true'; // If javascript is enabled, return true, so the cart gets updated
			}
		}
		 
	}
	function show_cart(){
		$this->load->view('shopping_cart');
	}
	function update_cart(){
		$this->load->model('cart_model');
		$this->cart_model->validate_update_cart();
		redirect('cart');
	}
	function empty_cart(){
		$this->cart->destroy(); // Destroy all cart data
		redirect('cart'); // Refresh te page
	}
}
/* End of file cart.php */
/* Location: ./application/controllers/cart.php */