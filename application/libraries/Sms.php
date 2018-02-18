<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Sms {

    public function getEbulksmsBalance() {
		$username = "info@mealdeal.com.ng";
		$api_key = "442bfb3034daf6cc83665b6bb54428fd79dc1316";
		$url = "http://api.ebulksms.com/balance/".$username."/".$api_key;
		$json = file_get_contents($url);
		$num_sms_left_ebulk = json_decode($json, true);
		
		return $num_sms_left_ebulk;
	}

	public function sendEbulkSms($sender_name, $recipients, $sms_body)
	{
		// return;
		
		$json_url = "http://api.ebulksms.com/sendsms.json";
		$username = 'info@mealdeal.com.ng';
		$apikey = '442bfb3034daf6cc83665b6bb54428fd79dc1316';
		$sendername = substr($sender_name, 0, 11);
		//$recipients = $_POST['telephone'];
		$message = $sms_body;
		$flash = 0;
		if (get_magic_quotes_gpc()) {
			$message = stripslashes($sms_body);
		}
		//$message = substr($_POST['message'], 0, 160);
		$result = $this->useJSON($json_url, $username, $apikey, $flash, $sendername, $message, $recipients);
		return $result;
	}
	public function useJSON($url, $username, $apikey, $flash, $sendername, $messagetext, $recipients) {
		$gsm = array();
		$country_code = '234';
		$arr_recipient = explode(',', $recipients);
		foreach ($arr_recipient as $recipient) {
			$mobilenumber = trim($recipient);
			if (substr($mobilenumber, 0, 1) == '0'){
				$mobilenumber = $country_code . substr($mobilenumber, 1);
			}
			elseif (substr($mobilenumber, 0, 1) == '+'){
				$mobilenumber = substr($mobilenumber, 1);
			}
			$generated_id = uniqid('int_', false);
			$generated_id = substr($generated_id, 0, 30);
			$gsm['gsm'][] = array('msidn' => $mobilenumber, 'msgid' => $generated_id);
		}
		$message = array(
						'sender' => $sendername,
						'messagetext' => $messagetext,
						'flash' => "{$flash}",
						);
		$request = array('SMS' => array(
									'auth' => array(
													'username' => $username,
													'apikey' => $apikey
													),
									'message' => $message,
									'recipients' => $gsm
										)
					);
		$json_data = json_encode($request);
		if ($json_data) {
					$response = $this->doPostRequest($url, $json_data, array('Content-Type: application/json'));
					if($result = json_decode($response))
						return $result->response->status;
					else return $response;
			} else {
				return false;
				}
	}
	
	//Function to connect to SMS sending server using HTTP POST
	public function doPostRequest($url, $data, $headers = array()) {
		$php_errormsg = '';
		if (is_array($data)) {
			$data = http_build_query($data, '', '&');
		}
		$params = array('http' => array(
							'method' => 'POST',
							'content' => $data)
					);
		if ($headers !== null) {
			$params['http']['header'] = $headers;
		}
		$ctx = stream_context_create($params);
		$fp = @fopen($url, 'rb', false, $ctx);
		if (!$fp) {
			return "Error: gateway is inaccessible";
		}
		//stream_set_timeout($fp, 0, 250);
		try {
			$response = stream_get_contents($fp);
			if ($response === false) {
				throw new Exception("Problem reading data from $url, $php_errormsg");
			}
			return $response;
		} catch (Exception $e) {
			$response = $e->getMessage();
			return $response;
		}
	}
}

/* End of file Sms.php */