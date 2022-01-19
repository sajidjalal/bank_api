<?php
defined('BASEPATH') or exit('No direct script access allowed');

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
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// auhtentication route
$route['checkLogin'] = 'Auth/checkLogin';

$route['admin/profile'] = 'admin/Home/profile';
$route['admin/cust-list'] = 'admin/Home/customerList';
$route['admin/cust-create'] = 'admin/Home/createLead';
$route['makeLead'] = 'admin/Home/makeLead';
$route['admin/cust-details/(:any)'] = 'admin/Home/customerDetails/$1';
$route['admin/logout'] = 'admin/Home/logout';
$route['deposit'] = 'admin/Home/deposit';
$route['withdraw'] = 'admin/Home/withdraw';
$route['deposite-amount'] = 'admin/Home/amountDeposite';
$route['withdraw-amount'] = 'admin/Home/amountWithdraw';

$route['admin/itemlist'] = 'admin/Home/itemlist';
$route['admin/productlist'] = 'admin/Home/productlist';
$route['admin/projectList'] = 'admin/Home/projectList';
$route['productDetailsEditPost'] = 'admin/Home/productDetailsEditPost';

$route['admin/projectByItem/(:any)'] = 'admin/Home/projectByItem/$1';
$route['admin/projectByProduct/(:any)'] = 'admin/Home/projectByProduct/$1';
$route['admin/productDetails/(:any)'] = 'admin/Home/productDetails/$1';
$route['admin/productDetailsEdit/(:any)'] = 'admin/Home/productDetailsEdit/$1';
