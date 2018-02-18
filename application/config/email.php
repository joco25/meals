<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*$config['protocol'] = 'smtp';
$config['mailpath'] = '/usr/sbin/sendmail';
$config['charset'] = 'iso-8859-1';
$config['smtp_user'] = 'info@mealdeal.com.ng'; // change it to yours
$config['smtp_pass'] = '@mealdeal01'; // change it to yours
$config['mailtype'] = 'html';
$config['wordwrap'] = TRUE;
$config['$smtp_host'] = "mail.mealdeal.com.ng";  
*/

$config['protocol'] = 'smtp';
$config['charset'] = 'iso-8859-1';
$config['smtp_user'] = 'info@mealdeal.com.ng'; // change it to yours
$config['smtp_pass'] = '@mealdeal01'; // change it to yours
$config['mailtype'] = 'html';
$config['smtp_port'] = 25;
$config['smtp_host'] = "localhost";  
//$this->email->initialize($config);
?>