<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//front
$route['default_controller'] = 'welcome/index';
$route['404_override'] = 'welcome/not_found';
$route['translate_uri_dashes'] = FALSE;
//AUTH
$route['checkwebtoken'] = 'authentication/authentication/checkwebtoken';
$route['auth/submit_login'] = 'authentication/authentication/submit_login';
// $route['admin/logout'] = 'authentication/authentication/logout';
$route['login'] = 'front/front/login';
$route['admin/logout'] = 'admin/admin/logout';

//DASHBOARD
$route['admin'] = 'admin/admin/dashboard';
$route['admin/dashboard'] = 'admin/admin/dashboard';
$route['admin/login'] = 'authentication/authentication/login';
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
$route['admin/tpq/change_password'] = 'admin/tpq/change_password';
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
$route['admin/student/search_page'] = 'admin/student/search_page';
$route['admin/student/search_submit'] = 'admin/student/search_submit';
$route['admin/student/(:any)'] = 'admin/student/detail';

//socmed
$route['admin/socmed'] = 'admin/socmed/index';
$route['admin/socmed/json'] = 'admin/socmed/json';
$route['admin/socmed/add'] = 'admin/socmed/add';
$route['admin/socmed/post'] = 'admin/socmed/post';
$route['admin/socmed/update'] = 'admin/socmed/update';
$route['admin/socmed/delete'] = 'admin/socmed/delete';
$route['admin/socmed/(:any)'] = 'admin/socmed/detail';


// pengurus PPG
$route['admin/position'] = 'admin/position/index';
$route['admin/position/json'] = 'admin/position/json';
$route['admin/position/add'] = 'admin/position/add';
$route['admin/position/post'] = 'admin/position/post';
$route['admin/position/update'] = 'admin/position/update';
$route['admin/position/delete'] = 'admin/position/delete';
$route['admin/position/(:any)'] = 'admin/position/detail';

//pengurus TPQ
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
$route['about_us'] = 'front/info/about_us';
$route['not_found'] = 'welcome/not_found';
$route['search'] = 'front/info/search';
// $route['category/(:any)/(:any)'] = 'front/front/merchant';

// $route['home2'] = 'front/front/home';

// TPQ ROLE
$route['tpq/logout'] = 'tpq/tpq/logout';
$route['tpq'] = 'tpq/tpq/dashboard';
$route['tpq/dashboard'] = 'tpq/tpq/dashboard';
$route['tpq/login'] = 'authentication/authentication/login';
$route['tpq/404'] = 'tpq/tpq/notfound';
$route['tpq/teacher'] = 'tpq/teacher/index';
$route['tpq/teacher/json'] = 'tpq/teacher/json';
$route['tpq/teacher/add'] = 'tpq/teacher/add';
$route['tpq/teacher/post'] = 'tpq/teacher/post';
$route['tpq/teacher/update'] = 'tpq/teacher/update';
$route['tpq/teacher/delete'] = 'tpq/teacher/delete';
$route['tpq/teacher/search_page'] = 'tpq/teacher/search_page';
$route['tpq/teacher/search_submit'] = 'tpq/teacher/search_submit';
$route['tpq/teacher/(:any)'] = 'tpq/teacher/detail';

//tpq student
$route['tpq/student'] = 'tpq/student/index';
$route['tpq/student/json'] = 'tpq/student/json';
$route['tpq/student/add'] = 'tpq/student/add';
$route['tpq/student/post'] = 'tpq/student/post';
$route['tpq/student/update'] = 'tpq/student/update';
$route['tpq/student/delete'] = 'tpq/student/delete';
$route['tpq/student/search_page'] = 'tpq/student/search_page';
$route['tpq/student/search_submit'] = 'tpq/student/search_submit';
$route['tpq/student/(:any)'] = 'tpq/student/detail';

//TPQ position
$route['tpq/position'] = 'tpq/position/detail';
$route['tpq/position/update'] = 'tpq/position/update';


//TPQ Kegiatan & Galeri
$route['tpq/activity'] = 'tpq/activity/index';
$route['tpq/activity/json'] = 'tpq/activity/json';
$route['tpq/activity/add'] = 'tpq/activity/add';
$route['tpq/activity/post'] = 'tpq/activity/post';
$route['tpq/activity/update'] = 'tpq/activity/update';
$route['tpq/activity/delete'] = 'tpq/activity/delete';
$route['tpq/activity/(:any)'] = 'tpq/activity/detail';

//TPQ setting$route['admin/setting'] = 'admin/setting/index';
$route['tpq/setting'] = 'tpq/setting/detail';
$route['tpq/setting/update'] = 'tpq/setting/update';
$route['tpq/setting/change_password'] = 'tpq/setting/change_password';
