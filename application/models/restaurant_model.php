<?php
class Restaurant_model extends CI_Model {

	private $search_count = 0;
	private $rest_rating;
	private $rating_no;
    function __construct()
    {
        parent::__construct();
    }
	
	function search($keyword, $location = '', $sort_by = 'rating')
	{
		$sql = "SELECT DISTINCT kyd_restaurants.*, ROUND(AVG(kyd_reviews.rating)) AS avg_rating FROM kyd_restaurants
				LEFT JOIN kyd_reviews
				ON kyd_restaurants.id=kyd_reviews.rest_id";
				$where_list = array();
				$where_clause = '';
				$clean_search = str_replace(',', ' ', $keyword);
				$search_words = explode(' ', $clean_search);
				if (count($search_words) > 0) {
					foreach ($search_words as $word) {
						if (!empty($word)) {
							$final_search_words[] = $word;
						}
					}
				}
				
				foreach ($final_search_words as $word) {
					$where_list[] = "(rest_name LIKE '%".$word."%' OR rest_address LIKE '%".$word."%' OR cuisines LIKE '%".$word."%')";
				}
				$where_clause = implode(' OR ', $where_list);
				if (!empty($where_clause)) {
					$sql .= " WHERE ($where_clause)";
				}
				//WHERE (rest_name LIKE '%".$keyword."%' OR rest_address LIKE '%".$keyword."%' OR cuisines LIKE '%".$keyword."%') AND rest_state LIKE '%".$location."%' GROUP BY kyd_restaurants.id";
				
				$sql .= " AND rest_state LIKE '%".$location."%' AND status = 1 GROUP BY kyd_restaurants.id";
				
		switch ($sort_by)
		{
			case 'rating' : $sql.= " ORDER BY avg_rating DESC";
							break;
			case 'delivery_fee' : $sql.= " ORDER BY kyd_restaurants.delivery_fee ASC";
							break;
			case 'minimum_order' : $sql.= " ORDER BY kyd_restaurants.minimum_order ASC";
							break;
			default : $sql."";
							break;
		}
		$query = $this->db->query($sql);
		$this->search_count = $query->num_rows;
		return $query->result();
		
	}
	function getSearchCount()
	{
		return $this->search_count;
	}
	function getRating($id) 
	{
		$total = 0;
		$average;
		$query = $this->db->query("SELECT * FROM kyd_reviews WHERE rest_id = '".$id."'");
		$counter = $query->num_rows;
		if($counter < 1)
		{
			$rest_rating = 0;
			$rating_no = 0;
		}
		else {
			foreach($query->result() as $row)
			{
				$total += $row->rating;
			}
			$average = $total / $counter;
			$average = round($average);
			$rest_rating = $average;
			
		}
		return $rest_rating;
	}
	function getNoOfRating($id)
	{
		$query = $this->db->query("SELECT * FROM kyd_reviews WHERE rest_id = '".$id."'");
		return $query->num_rows;
	}
	function getApprovedReviews($id)
	{
		$query = $this->db->query("SELECT * FROM kyd_reviews WHERE rest_id = '".$id."' ORDER BY id DESC");
		return $query->result();
	}
	function getPicture($id)
	{
		$query = $this->db->query("SELECT * FROM kyd_restaurants WHERE id = '".$id."'");
		$row = $query->row();
		return asset_url()."images/restaurants/".$row->rest_image;
	}
	function getBanner($id)
	{
		$query = $this->db->query("SELECT * FROM kyd_restaurants WHERE id = '".$id."'");
		$row = $query->row();
		return asset_url()."images/restaurants/".$row->rest_banner;
	}
	function getRestaurant($slug)
	{
		$sql = "SELECT * FROM kyd_restaurants WHERE slug = '".$slug."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function getRestDetail($id, $detail)
	{
		$sql = "SELECT * FROM kyd_restaurants WHERE id = '".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->$detail;
	}
	function addReview($id, $name, $email, $title, $review, $rating)
	{
		$date = date('Y-m-d');
		if(empty($id) || empty($name) || empty($email) || empty($title) || empty($review) || empty($rating))
		{
			return false;
		}
		$sql = "INSERT INTO kyd_reviews (rest_id, name, email, title, review, rating, date) VALUES ('$id','$name','$email','$title','$review','$rating','$date')";
		if($this->db->query($sql))
		{
			return true;
		}
		else return false;
	}
	function addHit($slug)
	{
		$sql = "UPDATE kyd_restaurants SET hits = hits + 1 WHERE slug = '$slug'";
		if($this->db->query($sql))
		{
			return true;
		}
		else return false;
	}
	function getSimilarSpots($slug, $city, $state = '')
	{
		$sql = "SELECT * FROM kyd_restaurants WHERE (rest_city = '$city' OR rest_state = '$state') AND slug != '$slug' AND status=1 ORDER BY hits DESC LIMIT 0, 3";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getPopularRestaurants($max = 8)
	{
		$sql = "SELECT * FROM kyd_restaurants WHERE status=1 ORDER BY hits DESC LIMIT 0, $max";
		$query = $this->db->query($sql);
		return $query->result();
	}

	function getStateRestaurants($state){
		$sql = "SELECT * FROM kyd_restaurants WHERE rest_state='".$state."' AND status=1 ORDER BY hits DESC";
		$query = $this->db->query($sql);
		
		return $query->result();
	}


	function addRestaurant($name, $address, $city, $state, $rest_email, $contact_person, $phone_no, $cuisines, $y_email, $date_added, $slug, $image = 'default.png' )
	{
		$sql = "INSERT INTO kyd_restaurants (rest_name, rest_address, contact_person, phone_no, rest_email, your_email, cuisines, slug, rest_city, rest_state, date_added, rest_image) VALUES ('$name', '$address', '$contact_person', '$phone_no', '$rest_email', '$y_email', '$cuisines', '$slug', '$city', '$state', '$date_added', '$image')";
		if($this->db->query($sql))
		{
			return true;
		}
		else return false;
		
	}
	function generateSlug($url)
	{
		# Prep string with some basic normalization
		$url = strtolower($url);
		$url = strip_tags($url);
		$url = stripslashes($url);
		$url = html_entity_decode($url);
	
		# Remove quotes (can't, etc.)
		$url = str_replace('\'', '', $url);
	
		# Replace non-alpha numeric with hyphens
		$match = '/[^a-z0-9]+/';
		$replace = '-';
		$url = preg_replace($match, $replace, $url);
	
		$url = trim($url, '-');
		return $url.$this->random_num(3);;
	}
	function getMenu($id)
	{
		$sql = "SELECT * FROM kyd_menu_items WHERE rest_id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getMenuFromCategory($id)
	{
		$sql = "SELECT * FROM kyd_menu_items WHERE category = '".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getMenuCategories($id)
	{
		$sql = "SELECT * FROM kyd_categories WHERE rest_id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getMenuCategoryDetail($id, $detail)
	{
		$sql = "SELECT * FROM kyd_categories WHERE id = '".$id."'";
		$query = $this->db->query($sql);
		$row = $query->row();
		return $row->$detail;
	}
	function getMenuItemDetails($id)
	{
		$sql = "SELECT * FROM kyd_menu_items WHERE id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	function random_num($count, $rm_similar = false)
	{
			// create list of characters
			$chars = array_flip(array_merge(range(0, 9), range(0, 9)));

			// remove similar looking characters that might cause confusion
			if ($rm_similar)
			{
				unset($chars[0], $chars[1], $chars[2], $chars[5], $chars[8],
					$chars['B'], $chars['I'], $chars['O'], $chars['Q'],
					$chars['S'], $chars['U'], $chars['V'], $chars['Z']);
			}

			// generate the string of random text
			for ($i = 0, $text = ''; $i < $count; $i++)
			{
				$text .= array_rand($chars);
			}

			return $text;
	}
	function addOrder($name, $address, $email, $phone_no, $rest_id, $add_info, $raw_order, $customOrder, $delivery_fee, $service_fee, $total, $preorder, $payment_type, $payment_status, $timestamp, $ip)
	{
		$query = $this->db->query("SELECT * FROM kyd_deals WHERE rest_id = '".$rest_id."'");
		if($query->num_rows() == 1)
		{
			$row = $query->row();
			$percent = $row->percent;
		}
		else $percent = 0;
		$sql = "INSERT INTO kyd_orders (client_name, client_email, client_address, client_phone, rest_id, add_info, menu_item_ids, custom_order, delivery_fee, service_fee, total_price, preorder, payment_type, payment_status, timestamp, ip_address, deal_percent) VALUES ('$name', '$email', '$address', '$phone_no', '$rest_id', '$add_info', '$raw_order', '$customOrder', '$delivery_fee', '$service_fee', '$total', '$preorder', '$payment_type', '$payment_status', '$timestamp', '$ip', '$percent')";
		if($this->db->query($sql))
		{
			return true;
		}
		else return false;
		
	}
	function numRestaurants()
	{
		$sql = "SELECT * FROM kyd_restaurants WHERE status = 1";
		$query = $this->db->query($sql);
		return $query->num_rows();
	}
	function getActiveRestaurants()
	{
		$sql = "SELECT * FROM kyd_restaurants WHERE status = 1";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function getAllActiveByType($type)
	{
		$sql = "SELECT * FROM kyd_restaurants WHERE status = 1 AND rest_type = ?";
		$query = $this->db->query($sql, $type);
		return $query->result();
	}
	function getNewRestaurants()
	{
		$sql = "SELECT * FROM kyd_restaurants WHERE status != 1";
		$query = $this->db->query($sql);
		return $query->result();
	}
	function statusMessage($id)
	{
		if($this->getOpenStatus($id))
		{
			return '<span class="label label-success pull-right">Open</span>';
		}
		else {
			return '<span class="label label-warning pull-right">Closed</span>';
		}
	}
	function getOpenStatus($id)
	{
		$day = date('w');
		$sql = "SELECT * FROM kyd_rest_hours WHERE rest_id = '".$id."'";
		$query = $this->db->query($sql);
		$num = $query->num_rows();
		$row = $query->row();
		
		if($num > 0)
		{
			//time
			$open_time = "open_".$day;
			$close_time = "close_".$day;
			$current = date("H:i");
			$open = $row->$open_time;
			$close = $row->$close_time;
			
			if(!($open == "00:00:00" && $close == "00:00:00"))
			{
				if( strtotime($current)>=strtotime($open) && strtotime($current)<=strtotime($close) )
				{
				return true;
				}
				else
				{
				 return false;
				}
			}
			else return false;
		}
		else 
		{
			return false;
		}
	}
	function getHours($id)
	{
		$sql = "SELECT * FROM kyd_rest_hours WHERE rest_id = '".$id."'";
		$query = $this->db->query($sql);
		return $query->row();
	}
	
	function dayOfWeek($day)
	{
		$days = array('Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat');
		return $days[$day];
	}
	
	function updateRestDetails($id, $name, $address, $city, $state, $rest_email, $contact_person, $phone_no, $cuisines, $your_email, $delivery_fee, $service_fee, $delivery_time, $minimum_order, $status, $rest_type)
	{
		$sql = "UPDATE kyd_restaurants SET rest_name = '$name', rest_address = '$address', contact_person = '$contact_person', phone_no = '$phone_no', rest_email = '$rest_email', your_email = '$your_email', cuisines = '$cuisines', delivery_fee = '$delivery_fee', service_fee = '$service_fee', delivery_time = '$delivery_time', minimum_order = '$minimum_order', rest_city = '$city', rest_state = '$state', status = '$status', rest_type = '$rest_type' WHERE id = '$id'";
		if($this->db->query($sql))
		{
			return true;
		}
		else return false;
	}
	function updateRestPicture($rest_id, $name)
	{
		$sql = "UPDATE kyd_restaurants SET rest_image = '".$name."' WHERE id = '".$rest_id."'";
		if($this->db->query($sql))
		{
			return true;
		}
		return false;
	}
	function updateRestBanner($rest_id, $name)
	{
		$sql = "UPDATE kyd_restaurants SET rest_banner = '".$name."' WHERE id = '".$rest_id."'";
		if($this->db->query($sql))
		{
			return true;
		}
		return false;
	}
	function sendOrderConfirmEmail($email, $data)
	{
		$this->load->library('email');
		
		$this->email->from('info@mealdeal.com.ng', 'MealDeal');
		$this->email->to($email); 
		
		$this->email->subject('Your Order has been received!');
		$this->email->message($this->load->view('order_email', $data, true));	
		
		$this->email->send();
		
		//echo $this->email->print_debugger();
	}
	function sendOrderConfirmSms($rest_id, $user_order, $total, $number)
	{
		$user_sms = "Your have made an order from ".$this->rest->getRestDetail($rest_id, 'rest_name').". Order: ".$user_order." Total Price: NGN".$total.". Thank you for using mealdeal.com.ng.
		
		";
		//echo $user_sms;
		$status = $this->sms->sendEbulkSms("Mealdeal", $number, $user_sms);
		//echo $status;
		
	}
	function sendRestOrderConfirmSms($rest_id, $user_order, $total, $name, $address, $phone_no, $add_info)
	{
		$rest_sms = "New Order on ".$this->rest->getRestDetail($rest_id, 'rest_name').". Order: ".$user_order.". Total Price: NGN".$total.". Name: ".$name.". Address: ".$address.". Phone: ".$phone_no.". Add.Info: ".$add_info.". - mealdeal.com.ng";
						//echo $rest_sms;
		$number = $this->rest->getRestDetail($rest_id, 'phone_no');
		$status = $this->sms->sendEbulkSms("Mealdeal", $number, $rest_sms);
		//echo $status;
		return true;
		
	}
	
}
?>
