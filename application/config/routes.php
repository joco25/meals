<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "home";
$route['404_override'] = '';
$route['restaurant/(:any)/review'] = "restaurant/review/$1";
$route['restaurant/(:any)/order'] = "restaurant/order/$1";
$route['restaurant/(:any)/confirm'] = "restaurant/confirm/$1";
$route['restaurant/(:any)/add_cart_item'] = "restaurant/add_cart_item/$1";
$route['restaurant/(:any)/show_cart'] = "restaurant/show_cart/$1";
$route['restaurant/(:any)/update_cart'] = "restaurant/update_cart/$1";
$route['restaurant/(:any)/empty_cart'] = "restaurant/empty_cart/$1";
$route['restaurant/(:any)'] = "restaurant/get_restaurant/$1";
$route['panel/order/(:any)'] = "panel/order/get_order/$1";
$route['add-restaurant'] = 'add_restaurant';
$route['panel/restaurants/new'] = "panel/restaurant/new_rest";
$route['panel/restaurant/(:any)/edit'] = "panel/restaurant/edit/$1";


/* End of file routes.php */
/* Location: ./application/config/routes.php */