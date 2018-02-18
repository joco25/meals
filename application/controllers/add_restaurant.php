<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Add_restaurant extends CI_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('restaurant_model', 'rest');
	}

	public function index()
	{
			
		$this->load->library('form_validation');		
		$this->form_validation->set_rules('rest_email', 'Restaurant Email', 'trim|required|callback_add_rest');
		$this->form_validation->set_rules('y_email', 'Your Email', 'required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$query = $this->db->query("SELECT * FROM kyd_states");
			$data["states"] = $query->result();
			$this->load->view('header', $data);
			$this->load->view('add_restaurant');
			$this->load->view('footer');
		}
		else
		{
			redirect('/panel/home/', 'refresh');
		}
	}
	public function add_rest($rest_email) {
			$name = mysql_escape_string($this->input->post('name'));
			$address = mysql_escape_string($this->input->post('address'));
			$city = mysql_escape_string($this->input->post('city'));
			$state = mysql_escape_string($this->input->post('state'));
			$rest_email = mysql_escape_string($this->input->post('rest_email'));
			$contact_person = mysql_escape_string($this->input->post('contact_person'));
			$phone_no = mysql_escape_string($this->input->post('phone_no'));
			$cuisines = mysql_escape_string($this->input->post('cuisines'));
			$y_email = mysql_escape_string($this->input->post('y_email'));
			$date_added = date('Y-m-d');
			$slug = $this->rest->generateSlug($name);
			
			$config['upload_path'] = './assets/images/restaurants/';
			$config['allowed_types'] = 'jpg|png';
			$config['max_size']	= '400';
			$config['max_width']  = '160';
			$config['max_height']  = '100';
			$config['file_name'] = time().".png";
	
			$this->load->library('upload', $config);
			
			if ( ! $this->upload->do_upload('logo'))
			{
				$error = array('error' => $this->upload->display_errors());
				if($error['error'] == "<p>You did not select a file to upload.</p>")
				{
					$process = $this->rest->addRestaurant($name, $address, $city, $state, $rest_email, $contact_person, $phone_no, $cuisines, $y_email, $date_added, $slug );
					if($process)
					{
						$this->form_validation->set_error_delimiters('<div class="alert alert-success">', '</div>');
						$this->form_validation->set_message('add_rest', 'Your restaurants has been successfully added and awaiting approval!');
					return false;
					}
					else 
					{
						$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
						$this->form_validation->set_message('add_rest', 'An error occured!');
					return false;
					}
				}
				else 
					{
						$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
						$this->form_validation->set_message('add_rest', $error['error']);
					return false;
					}
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
	
				$process = $this->rest->addRestaurant($name, $address, $city, $state, $rest_email, $contact_person, $phone_no, $cuisines, $y_email, $date_added, $slug, $data['upload_data']['orig_name'] );
					if($process)
					{
						$this->form_validation->set_error_delimiters('<div class="alert alert-success">', '</div>');
						$this->form_validation->set_message('add_rest', 'Your restaurant has been successfully added and awaiting approval!');
					return false;
					}
					else 
					{
						$this->form_validation->set_error_delimiters('<div class="alert alert-danger">', '</div>');
						$this->form_validation->set_message('add_rest', 'An errors occured!');
					return false;
					}
			}
	}
}