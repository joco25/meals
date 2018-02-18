<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Search extends CI_Controller {

	public function index()
	{
		$page = $this->uri->segment(3);
		$this->load->library('pagination');
		$this->load->model('restaurant_model', 'rest');
		$data['keyword'] = mysql_escape_string($this->input->post('keyword'));
		$data['location'] = mysql_escape_string($this->input->post('location'));
		
		if(empty($data['keyword']))
		{
			$data['keyword'] = $this->session->userdata('keyword');
			$data['location'] = $this->session->userdata('location');
			
		}
		else {
			$newdata = array(
                   'keyword'  => $data['keyword'],
                   'location'     => $data['location']
               );

			$this->session->set_userdata($newdata);
		}
		
		
		$data['sort_by'] = 'rating';
		$data['results'] = $this->rest->search($data['keyword'], $data['location'], $data['sort_by']);
		$data['search_count'] = $this->rest->getSearchCount();
		$query = $this->db->query("SELECT * FROM kyd_states");
		$data["states"] = $query->result();
		
		$this->load->view('header', $data);
		$this->load->view('search');
		$this->load->view('footer');
	}
	public function sort($sort_by)
	{
		$this->load->library('pagination');
		$this->load->helper(array('form', 'url'));	
		$this->load->model('restaurant_model', 'rest');
		$data['keyword'] = $this->session->userdata('keyword');
		$data['location'] = $this->session->userdata('location');
		$data['sort_by'] = $sort_by;
		$data['results'] = $this->rest->search($data['keyword'], $data['location'], $data['sort_by']);
		$data['search_count'] = $this->rest->getSearchCount();
		$query = $this->db->query("SELECT * FROM kyd_states");
		$data["states"] = $query->result();
		$this->load->view('header', $data);
		$this->load->view('search');
		$this->load->view('footer');
	}
	public function autocomplete()
	{
		$q = $this->input->post('search');
		$query =$this->db->query("SELECT id,rest_name,rest_address, cuisines, rest_image from kyd_restaurants WHERE (rest_name like '%$q%' or rest_address like '%$q%' or cuisines like '%$q%') AND status = 1 order by id LIMIT 5");
		$rows = $query->result();
		foreach($rows as $row)
		{
			$name = $row->rest_name;
			$address = $row->rest_address;
			$b_name='<strong>'.$q.'</strong>';
			$b_address='<strong>'.$q.'</strong>';
			$final_name = str_ireplace($q, $b_name, $name);
			$final_address = str_ireplace($q, $b_address, $address);
			?>
            <div class="show" align="left">
            <img src="<?php echo asset_url().'images/restaurants/'.$row->rest_image.'" alt="'.$row->rest_name.'" style="width:40px; height:25px; float:left; margin-right:6px;" />'?><span class="name"><?php echo $final_name; ?></span>&nbsp;<br/><?php echo $final_address; ?><br/>
            </div>
            <?php
         }
	}
}