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

//admin routes
$route['default_controller'] = 'Login';
$route['admin/home'] = 'admin/Home';
$route['admin'] = 'admin/adminmaster/Adminmaster_login';
$route['admin/masterlogin'] = 'admin/adminmaster/Adminmaster_login';
$route['admin/adminmaster'] = 'admin/adminmaster/AdminMaster';
$route['admin/role'] = 'admin/role/Role';
$route['admin/login_history'] = 'admin/Login_History';
$route['admin/role_rights'] = 'admin/Role_Rights';
$route['admin/smme'] = 'admin/smme/Smme';
$route['admin/incubators'] = 'admin/incubators/Incubators';
$route['admin/bdsps'] = 'admin/bdsps/Bdsps';
$route['admin/smme/application'] = 'admin/smme/Application';
$route['admin/profile'] = 'admin/Home/profile';
$route['admin/edit_profile'] ='admin/Home/edit_profile';
$route['admin/change_password'] ='admin/Home/change_password';
$route['admin/activity_log'] ='admin/Home/login_history';
$route['admin/to_do_task'] ='admin/todo_n_task/Todo_n_task';
$route['admin/faq'] ='admin/Faq';
$route['admin/blog'] ='admin/Blog';
$route['admin/calendar'] ='admin/Calendar';

//PACKAGE ROUTE
//*****************************************************************************
$route['package/entry'] = 'admin/package/PackageController';
$route['package/create'] = 'admin/package/PackageController/createPackage';
$route['package/add'] = 'admin/package/PackageController/addPackage';
$route['(package/edit/:any)'] = 'admin/package/PackageController/editPackage';
$route['package/update'] = 'admin/package/PackageController/updatePackage';
$route['(package/delete/:any)'] = 'admin/package/PackageController/deletePackage';
$route['package/assign'] = 'admin/package/PackageController/assignPackage';
$route['(package/assign/up/:any)'] = 'admin/package/PackageController/assignPackToInc';
//******************************************************************************
//
//COMPETITIONS ROUTE
//*******************************************************************************
$route['admin/competition'] = 'admin/competitions/CompetitionController';
$route['admin/comp/create'] = 'admin/competitions/CompetitionController/createCompetition';
$route['admin/comp/load'] = 'admin/competitions/CompetitionController/addCompetition';
$route['(admin/comp/del/(:any))']= "admin/competitions/CompetitionController/deleteCompetition";
$route['(admin/comp/edit/(:any))']= "admin/competitions/CompetitionController/editCompetition";
$route['admin/comp/up']= "admin/competitions/CompetitionController/updateCompetition";
    //*******************************************************************************
//INCUBATOR COMPETITIONS ROUTE
//*******************************************************************************
$route['inc/competition'] = 'incubator/competition/Inc_Competition';
$route['inc/comp/create'] = 'incubator/competition/Inc_Competition/createCompetition';
$route['inc/comp/load'] = 'incubator/competition/Inc_Competition/addCompetition';
$route['(inc/comp/del/(:any))']= "incubator/competition/Inc_Competition/deleteCompetition";
$route['(inc/comp/edit/(:any))']= "incubator/competition/Inc_Competition/editCompetition";
$route['inc/comp/up']= "incubator/competition/Inc_Competition/updateCompetition";
    //*******************************************************************************

//MSME COMPETITIONS ROUTE
//*******************************************************************************
$route['msme/competition'] = 'user/smme/competition/Msme_CompetitionController';
$route['msme/comp/create'] = 'user/smme/competition/Msme_CompetitionController/createCompetition';
$route['msme/comp/load'] = 'user/smme/competition/Msme_CompetitionController/addCompetition';
//$route['(inc/comp/del/(:any))']= "incubator/competition/Inc_Competition/deleteCompetition";
//$route['(inc/comp/edit/(:any))']= "incubator/competition/Inc_Competition/editCompetition";
//$route['inc/comp/up']= "incubator/competition/Inc_Competition/updateCompetition";
    //*******************************************************************************
//SMME Routes

$route['Registration'] = 'Registration';
$route['login'] = 'Login';
$route['forgotpassword'] = 'ForgotPassword';
$route['user/smme/Application'] = 'user/smme/Application';
$route['user/smme/BusinessDetails'] = 'user/smme/BusinessDetails';
$route['user/smme/change_password'] = 'Registration/change_password';
$route['change_password'] = 'Registration/change_password';
$route['user/smme/Incubators'] = 'user/smme/Incubator';
$route['user/smme/Bdsp'] = 'user/smme/Bdsp';
$route['user/activity_log'] = 'Home/login_history';
$route['user/profile'] = 'Profile';
$route['user/smme/Faqs'] = 'user/smme/Faqs';
$route['user/smme/Blogs'] = 'user/smme/Blogs';
$route['user/smme/Feedbacks'] = 'user/smme/Feedback';
$route['user/smme/Calender'] = 'user/smme/Calender';
$route['bdsp'] = 'bdsp/Login';
// $route['home'] = 'incubator/Home';

$route['404_override'] = 'PageNotFound/index';