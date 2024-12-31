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
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['default_controller'] = 'login'; // Mặc định hiển thị trang login

$route['login'] = 'login/index'; // Hiển thị form login
$route['login/authenticate'] = 'login/authenticate'; // Xử lý đăng nhập
$route['logout'] = 'login/logout'; // Đăng xuất

$route['dashboard'] = 'dashboard/index'; // Trang chủ

$route['classrooms'] = 'classrooms/index';
$route['classrooms/add'] = 'classrooms/add';
$route['classrooms/store'] = 'classrooms/store';
$route['classrooms/edit/(:num)'] = 'classrooms/edit/$1';
$route['classrooms/update/(:num)'] = 'classrooms/update/$1';
$route['classrooms/delete/(:num)'] = 'classrooms/delete/$1';

$route['accounts'] = 'accounts/index';                // Danh sách tài khoản
$route['accounts/add'] = 'accounts/add';              // Thêm tài khoản (form)
$route['accounts/store'] = 'accounts/store';          // Lưu tài khoản mới
$route['accounts/edit/(:num)'] = 'accounts/edit/$1';  // Sửa tài khoản (form)
$route['accounts/update/(:num)'] = 'accounts/update/$1'; // Cập nhật tài khoản
$route['accounts/delete/(:num)'] = 'accounts/delete/$1'; // Xóa tài khoản
$route['accounts/detail/(:num)'] = 'accounts/detail/$1'; // Xem chi tiết tài khoản


$route['projects'] = 'projects/index';
$route['projects/add'] = 'projects/add';
$route['projects/store'] = 'projects/store';
$route['projects/edit/(:num)'] = 'projects/edit/$1';
$route['projects/update/(:num)'] = 'projects/update/$1';
$route['projects/delete/(:num)'] = 'projects/delete/$1';
$route['projects/detail/(:num)'] = 'projects/detail/$1';
$route['projects/search'] = 'projects/search';
$route['projects/statistics'] = 'projects/statistics';
$route['projects/view/(:num)'] = 'Projects/view/$1';



