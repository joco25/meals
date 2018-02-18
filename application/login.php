<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
  function __construct() {
    parent::__construct();
  }
  public function index(){
    if (isset($_GET['code']) AND !empty($_GET['code'])) {
      $code = $_GET['code'];
      // parsing the result to getting access token.
      parse_str($this->get_fb_contents("https://graph.facebook.com/oauth/access_token?client_id=1564758173778600&redirect_uri=" . urlencode(base_url('login')) ."&client_secret=1e0f06213416a2cd0e771f02006d61a6&code=" . urlencode($code)));
      redirect('login?access_token='.$access_token);
    }
    if(!empty($_GET['access_token'])) {
      // getting all user info using access token.
      $fbuser_info = json_decode($this->get_fb_contents("https://graph.facebook.com/me?access_token=".$_GET['access_token']), true);
      // you can get all user info from print_r($fbuser_info);
      if(!empty($fbuser_info['email'])) {
		  $fname = $fbuser_info['first_name'];
		  $lname = $fbuser_info['last_name'];
		  $email = $fbuser_info['email'];
		  $gender = $fbuser_info['gender'];
		  $name = $fbuser_info['name'];
		  $id = $fbuser_info['id'];
    // do your stuff.
    //save the data in db save session and redirect.
	$newdata = array(
			   'email'  => $email,
			   'name'     => $fname." ".$lname,
			   'user_id' => $id,
			   'fname' => $fname,
			   'gender' => $gender
		   );
		$this->session->set_userdata($newdata);
		redirect(base_url());
       }
       else{
         $this->session->set_flashdata('message', 'Error while facebook user information.');
     redirect(base_url());
       }
    }
    if ($this->form_validation->run() == FALSE) {
      //$this->load->view('login'); // loading default view.
	  echo "Login failed!";
    }
  }
   
/**
  * calling facebook api using curl and return response.
  */
  function get_fb_contents($url) {
    $curl = curl_init();
    curl_setopt( $curl, CURLOPT_URL, $url );
    curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1 );
    curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
    $response = curl_exec( $curl );
    curl_close( $curl );
    return $response;
  }
}
