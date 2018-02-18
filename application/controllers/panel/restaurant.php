<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Restaurant extends CI_Controller {

	public function index()
	{
		//check if admin is logged in
		is_admin_logged_in();
		
		//load models
		$this->load->model('order_model', 'order');
		$this->load->model('restaurant_model', 'rest');
		
		$data['restaurants'] = $this->rest->getActiveRestaurants();
		
		$data['active_page'] = 'restaurant';
		$this->load->view('panel/header', $data);
		$this->load->view('panel/restaurants');
		$this->load->view('panel/footer');
	}
	public function new_rest()
	{
		//check if admin is logged in
		is_admin_logged_in();
		
		//load models
		$this->load->model('order_model', 'order');
		$this->load->model('restaurant_model', 'rest');
		
		$data['restaurants'] = $this->rest->getNewRestaurants();
		
		$data['active_page'] = 'restaurant';
		$this->load->view('panel/header', $data);
		$this->load->view('panel/new_restaurants');
		$this->load->view('panel/footer');
	}
	public function edit($slug)
	{
		//check if admin is logged in
		is_admin_logged_in();
		
		//load models
		$this->load->model('order_model', 'order');
		$this->load->model('restaurant_model', 'rest');
		$cat_del = $this->input->get('cat_del');
		$item_del = $this->input->get('item_del');
		if(!empty($cat_del))
		{
			if($this->db->query("DELETE FROM kyd_categories WHERE id = ?", $cat_del))
			{
				$data['success'] = "Category deleted successfully!";
			}
			else {
				$data['error'] = "An error Occured!";
			}
		}
		if(!empty($item_del))
		{
			if($this->db->query("DELETE FROM kyd_menu_items WHERE id = ?", $item_del))
			{
				$data['success'] = "Menu Item deleted successfully!";
			}
			else {
				$data['error'] = "An error Occured!";
			}
		}
		$data['restaurant'] = $this->rest->getRestaurant($slug);
		$data['menu'] = $this->rest->getMenu($data['restaurant']->id);
		$data['categories'] = $this->rest->getMenuCategories($data['restaurant']->id);
		$data['hours'] = $this->rest->getHours($data['restaurant']->id);
		$query = $this->db->query("SELECT * FROM kyd_states");
		$data["states"] = $query->result();
		$id = $data['restaurant']->id;
		
		
		
		
		$name = mysql_escape_string($this->input->post('rest_name'));
		$address = ($this->input->post('rest_address'));
		$city = $this->input->post('rest_city');
		$state = $this->input->post('rest_state');
		$rest_email = $this->input->post('rest_email');
		$contact_person = mysql_escape_string($this->input->post('contact_person'));
		$phone_no = $this->input->post('phone_no');
		$cuisines = $this->input->post('cuisines');
		$your_email = $this->input->post('your_email');
		$delivery_fee = $this->input->post('delivery_fee');
		$service_fee = $this->input->post('service_fee');
		$delivery_time = $this->input->post('delivery_time');
		$minimum_order = $this->input->post('minimum_order');
		$status = $this->input->post('status');
		$rest_type = $this->input->post('rest_type');
		
		//Button Categories
		$save_hours = $this->input->post('save_hours');
		$add_item = $this->input->post('add_item');
		$add_category = $this->input->post('add_category');
		$change_logo = $this->input->post('change_logo');
		$change_banner = $this->input->post('change_banner');
		
		if(!empty($name))
		{
			if($this->rest->updateRestDetails($id, $name, $address, $city, $state, $rest_email, $contact_person, $phone_no, $cuisines, $your_email, $delivery_fee, $service_fee, $delivery_time, $minimum_order, $status, $rest_type))
			{
				$data['success'] = "Restaurant Details Updated successfully!";
				$data['restaurant'] = $this->rest->getRestaurant($slug);
				$data['menu'] = $this->rest->getMenu($data['restaurant']->id);
				$data['categories'] = $this->rest->getMenuCategories($data['restaurant']->id);
				$data['hours'] = $this->rest->getHours($data['restaurant']->id);
			}
			else $data['error'] = "An error Occured!";
		}
		
		if(!empty($save_hours))
		{
			
			$days = array(0,1,2,3,4,5,6,);
			$query = $this->db->query("SELECT * FROM kyd_rest_hours WHERE rest_id = '".$id."'");
			if($query->num_rows() > 0)
			{
				
				$sql = "UPDATE kyd_rest_hours SET ";
				foreach($days as $time)
				{
					$open = "open_".$time;
					$close = "close_".$time;
					$closed = "closed_".$time;
					if($this->input->post($closed))
					{
						$open_time = "00:00:00";
						$close_time = "00:00:00";
					}
					else {
						$open_time = $this->input->post($open);
						$close_time = $this->input->post($close);
					}
					$sql .= $open." = '".$open_time."', ".$close." = '".$close_time."'";
					if($time!=6)
					{
						$sql.=", ";
					}
				}
				$sql.= " WHERE rest_id = '".$id."'";
				if($this->db->query($sql))
				{
					$data['success'] = "Restaurant Hours Updated successfully!";
					$data['restaurant'] = $this->rest->getRestaurant($slug);
					$data['menu'] = $this->rest->getMenu($data['restaurant']->id);
					$data['categories'] = $this->rest->getMenuCategories($data['restaurant']->id);
					$data['hours'] = $this->rest->getHours($data['restaurant']->id);
				}
				else $data['error'] = "An error Occured!";
			}
			else 
			{
				$sql = "INSERT INTO kyd_rest_hours (rest_id, open_0, close_0, open_1, close_1, open_2, close_2, open_3, close_3, open_4, close_4, open_5, close_5, open_6, close_6) VALUES ('$id',";
				foreach($days as $time)
				{
					$open = "open_".$time;
					$close = "close_".$time;
					$closed = "closed_".$time;
					if($this->input->post($closed))
					{
						$open_time = "00:00:00";
						$close_time = "00:00:00";
					}
					else {
						$open_time = $this->input->post($open);
						$close_time = $this->input->post($close);
					}
					$sql .= "'".$open_time."', '".$close_time."'";
					if($time!=6)
					{
						$sql.=", ";
					}
					else $sql.=")";
				}
				if($this->db->query($sql))
				{
					$data['success'] = "Restaurant Hours Updated successfully!";
					$data['restaurant'] = $this->rest->getRestaurant($slug);
					$data['menu'] = $this->rest->getMenu($data['restaurant']->id);
					$data['categories'] = $this->rest->getMenuCategories($data['restaurant']->id);
					$data['hours'] = $this->rest->getHours($data['restaurant']->id);
				}
				else $data['error'] = "An error Occured!";
			}
		}
		if(!empty($add_item))
		{
			$name = $this->input->post('name');
			$description = $this->input->post('description');
			$category = $this->input->post('category');
			$price = $this->input->post('price');
			foreach($name as $key => $value)
			{
				if(!empty($name[$key]) && !empty($description[$key]) && !empty($price[$key]))
				{
					$sql = "INSERT INTO kyd_menu_items (rest_id, category, name, description, price) VALUES ('$id', '$category[$key]', '$name[$key]', '$description[$key]', '$price[$key]')";
					if($this->db->query($sql))
					{
						$success = "Menu items have been successfully added!";
					}
					else $data['error'] = "An error occured while adding some items!";
					
					$data['success'] = $success;
					$data['restaurant'] = $this->rest->getRestaurant($slug);
					$data['menu'] = $this->rest->getMenu($data['restaurant']->id);
					$data['categories'] = $this->rest->getMenuCategories($data['restaurant']->id);
					$data['hours'] = $this->rest->getHours($data['restaurant']->id);
				}
				else $data['error'] = "An error Occured";
				
			}
		}
		if(!empty($add_category))
		{
			$name = $this->input->post('category_name');
			foreach($name as $key => $value)
			{
				if(!empty($name[$key]))
				{
					$sql = "INSERT INTO kyd_categories (rest_id, cat_name) VALUES ('$id', '$name[$key]')";
					if($this->db->query($sql))
					{
						$success = "Categories have been successfully added!";
					}
					else $data['error'] = "An error occured while adding some categories!";
					
					$data['success'] = $success;
					$data['restaurant'] = $this->rest->getRestaurant($slug);
					$data['menu'] = $this->rest->getMenu($data['restaurant']->id);
					$data['categories'] = $this->rest->getMenuCategories($data['restaurant']->id);
					$data['hours'] = $this->rest->getHours($data['restaurant']->id);
				}
				else $data['error'] = "An error Occured";
				
			}
		}
		if(!empty($change_logo))
		{
			$config['upload_path'] = './assets/images/restaurants/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']	= '400';
			$config['width']	= 160;
			$config['height']	= 100;
			$filename = $config['file_name'] = time().".png";
	
			$this->load->library('upload', $config);
			
			
			if ( ! $this->upload->do_upload('logo'))
			{
				$data['error'] = $this->upload->display_errors();
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				if($this->rest->updateRestPicture($id, $data['upload_data']['orig_name']))
				{
					$config['image_library'] = 'gd2';
					$config['source_image']	= './assets/images/restaurants/'.$filename;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width']	= 160;
					$config['height']	= 100;
					$this->load->library('image_lib', $config); 
					
					if ( ! $this->image_lib->resize())
					{
						$data['error'] =  $this->image_lib->display_errors();
					}
					else $data['success'] = "Restaurant Logo Changed Successfully";
					$data['restaurant'] = $this->rest->getRestaurant($slug);
					$data['menu'] = $this->rest->getMenu($data['restaurant']->id);
					$data['categories'] = $this->rest->getMenuCategories($data['restaurant']->id);
					$data['hours'] = $this->rest->getHours($data['restaurant']->id);
				}
				else $data['error'] = "An error occured!";
			}
		}
		if(!empty($change_banner))
		{
			$config['upload_path'] = './assets/images/restaurants/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']	= '1000';
			$config['width']	= 160;
			$config['height']	= 100;
			$filename = $config['file_name'] = time()."-banner.png";
	
			$this->load->library('upload', $config);
			
			
			if ( ! $this->upload->do_upload('banner'))
			{
				$data['error'] = $this->upload->display_errors();
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				if($this->rest->updateRestBanner($id, $data['upload_data']['orig_name']))
				{
					$config['image_library'] = 'gd2';
					$config['source_image']	= './assets/images/restaurants/'.$filename;
					$config['create_thumb'] = FALSE;
					$config['maintain_ratio'] = FALSE;
					$config['width']	= 500;
					$config['height']	= 300;
					$this->load->library('image_lib', $config); 
					
					if ( ! $this->image_lib->resize())
					{
						$data['error'] =  $this->image_lib->display_errors();
					}
					else $data['success'] = "Restaurant Banner Changed Successfully";
					$data['restaurant'] = $this->rest->getRestaurant($slug);
					$data['menu'] = $this->rest->getMenu($data['restaurant']->id);
					$data['categories'] = $this->rest->getMenuCategories($data['restaurant']->id);
					$data['hours'] = $this->rest->getHours($data['restaurant']->id);
				}
				else $data['error'] = "An error occured!";
			}
		}
		
		$data['active_page'] = 'restaurant';
		$this->load->view('panel/header', $data);
		$this->load->view('panel/restaurant_details');
		$this->load->view('panel/footer');
	}
}