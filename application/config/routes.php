<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//front
$route['default_controller'] = 'welcome/index';
$route['404_override'] = 'welcome/not_found';
$route['translate_uri_dashes'] = FALSE;
//AUTH
$route['checkwebtoken'] = 'authentication/authentication/checkwebtoken';
$route['auth/submit_login'] = 'authentication/authentication/submit_login';
$route['admin/logout'] = 'authentication/authentication/logout';
$route['login'] = 'authentication/authentication/login';
$route['logout'] = 'authentication/authentication/logout';

//DASHBOARD
$route['admin'] = 'admin/admin/dashboard';
$route['admin/dashboard'] = 'admin/admin/dashboard';
$route['admin/login'] = 'authentication/authentication/admin_login';
$route['admin/404'] = 'admin/admin/notfound';

// ADMIN PC
$route['admin/pc'] = 'admin/pc/index';
$route['admin/pc/json'] = 'admin/pc/json';
$route['admin/pc/add'] = 'admin/pc/add';
$route['admin/pc/post'] = 'admin/pc/post';
$route['admin/pc/update'] = 'admin/pc/update';
$route['admin/pc/delete'] = 'admin/pc/delete';
$route['admin/pc/(:any)'] = 'admin/pc/detail';


// ADMIN tpq
$route['admin/tpq'] = 'admin/tpq/index';
$route['admin/tpq/json'] = 'admin/tpq/json';
$route['admin/tpq/add'] = 'admin/tpq/add';
$route['admin/tpq/post'] = 'admin/tpq/post';
$route['admin/tpq/update'] = 'admin/tpq/update';
$route['admin/tpq/delete'] = 'admin/tpq/delete';
$route['admin/tpq/(:any)'] = 'admin/tpq/detail';

//ADMIN teacher
$route['admin/teacher'] = 'admin/teacher/index';
$route['admin/teacher/json'] = 'admin/teacher/json';
$route['admin/teacher/add'] = 'admin/teacher/add';
$route['admin/teacher/post'] = 'admin/teacher/post';
$route['admin/teacher/update'] = 'admin/teacher/update';
$route['admin/teacher/delete'] = 'admin/teacher/delete';
$route['admin/teacher/search_page'] = 'admin/teacher/search_page';
$route['admin/teacher/search_submit'] = 'admin/teacher/search_submit';
$route['admin/teacher/(:any)'] = 'admin/teacher/detail';

//ADMIN student
$route['admin/student'] = 'admin/student/index';
$route['admin/student/json'] = 'admin/student/json';
$route['admin/student/add'] = 'admin/student/add';
$route['admin/student/post'] = 'admin/student/post';
$route['admin/student/update'] = 'admin/student/update';
$route['admin/student/delete'] = 'admin/student/delete';
$route['admin/student/(:any)'] = 'admin/student/detail';

//socmed
$route['admin/socmed'] = 'admin/socmed/index';
$route['admin/socmed/json'] = 'admin/socmed/json';
$route['admin/socmed/add'] = 'admin/socmed/add';
$route['admin/socmed/post'] = 'admin/socmed/post';
$route['admin/socmed/update'] = 'admin/socmed/update';
$route['admin/socmed/delete'] = 'admin/socmed/delete';
$route['admin/socmed/(:any)'] = 'admin/socmed/detail';

$route['admin/tpq_position'] = 'admin/tpq_position/index';
$route['admin/tpq_position/json'] = 'admin/tpq_position/json';
$route['admin/tpq_position/add'] = 'admin/tpq_position/add';
$route['admin/tpq_position/post'] = 'admin/tpq_position/post';
$route['admin/tpq_position/update'] = 'admin/tpq_position/update';
$route['admin/tpq_position/delete'] = 'admin/tpq_position/delete';
$route['admin/tpq_position/(:any)'] = 'admin/tpq_position/detail';

//setting
$route['admin/setting'] = 'admin/setting/index';
$route['admin/setting/update'] = 'admin/setting/update';
$route['admin/setting/change_password'] = 'admin/setting/change_password';

//front
$route['notfound'] = 'front/front/notfound';
$route['home'] = 'front/front/home';

//front category
$route['category'] = 'front/category/all_category';
$route['category/(:any)'] = 'front/category/category';
$route['category/(:any)/(:any)'] = 'front/category/category';

//fornt merchant
$route['merchant'] = 'front/merchant/all_merchant';
$route['merchant/register'] = 'front/merchant/register';
$route['merchant/register_submit'] = 'front/merchant/register_submit';
$route['merchant/(:any)'] = 'front/merchant/all_merchant';
$route['merchant/detail/(:any)'] = 'front/merchant/detail';
$route['merchant/detail/(:any)/(:any)'] = 'front/merchant/detail';

//front product
$route['product'] = 'front/product/all_product';
$route['product/detail/(:any)'] = 'front/product/detail';
$route['product/(:any)'] = 'front/product/all_product';

//FRONT GAllery
$route['gallery/(:any)'] = 'front/gallery/all_gallery';
$route['gallery'] = 'front/gallery/all_gallery';

//front info
$route['about_us'] = 'front/info/about_us';
$route['not_found'] = 'front/info/not_found';
$route['search'] = 'front/info/search';
// $route['category/(:any)/(:any)'] = 'front/front/merchant';

// $route['home2'] = 'front/front/home';
