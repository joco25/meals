<?php 

function is_admin_logged_in() {
	//Get Current CI Instance
	$CI = & get_instance();
	//Use $CI instead of $this
	$user = $CI->session->userdata('admin');
	if(empty($user) ) {
		redirect('/panel/login/', 'refresh');
	}
	else {
		return true;
	}
}

?>