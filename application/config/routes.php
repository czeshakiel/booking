<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
|	https://codeigniter.com/userguide3/general/routing.html
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
#
$route['view_available/(:any)'] = 'pages/view_available/$1';
$route['delete_booking_time/(:any)'] = 'pages/delete_booking_time/$1';
$route['save_booking_time'] = 'pages/save_booking_time';
$route['manage_time'] = 'pages/manage_time';
$route['get_booking_time/(:any)'] = 'pages/get_booking_time/$1';
$route['delete_court/(:any)'] = 'pages/delete_court/$1';
$route['save_court'] = 'pages/save_court';
$route['get_court/(:any)'] = 'pages/get_court/$1';
$route['manage_court'] = 'pages/manage_court';
$route['adminlogout'] = 'pages/adminlogout';
$route['manage_settings'] = 'pages/manage_settings';
$route['adminmain'] = 'pages/adminmain';
$route['admin_authenticate'] = 'pages/admin_authenticate';
$route['admin'] = 'pages/admin';
$route['logout'] = 'pages/logout';
$route['registration'] = 'pages/registration';
$route['signup'] = 'pages/signup';
$route['user_authenticate'] = 'pages/user_authenticate';
$route['main'] = 'pages/main';
$route['default_controller'] = 'pages/index';
$route['(:any)'] = 'pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
