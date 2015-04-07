<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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


//if (file_exists(APPPATH . 'modules/lang')) {
//    $route['default_controller'] = "lang";
//    $route['(ru|en)'] = $this->config->item('default_controller');
//    $route['(ru|en)/(:any)'] = "front/$2";
//} else {
//    $route['default_controller'] = $this->config->item('default_controller');
//}
$route['default_controller'] = "front/main";
//~~~~~~~~~~~~~~~~~~~~~~admin routes~~~~~~~~~~~~~~~~~~~~~

$route['admin/login'] = 'admin/login';
$route['admin/logout'] = 'admin/logout';

$route['(:any)/savemail'] = '$1/savemail';
$route['(:any)/read'] = '$1/setread';

$route['admin/tag_del'] = 'admin/tag_del';
$route['admin/goods/subcategory/(:num)'] = 'admin/view/goods/$1';
$route['admin/goods/good_data_save'] = 'goods/good_data_save';
$route['admin/(:any)/up/(:any)'] = '$1/up/$2';
$route['admin/(:any)/down/(:any)'] = '$1/down/$2';
$route['admin/(:any)/image_delete'] = '$1/image_delete';
$route['admin/(:any)/images_upload/(:num)'] = '$1/images_upload/$2';
$route['admin/(:any)/get_images/(:num)'] = '$1/get_images/$2';
$route['admin/(:any)/delete/(:num)'] = '$1/delete/$2';
$route['admin/(:any)/(:any)/(:any)'] = 'admin/$2/$1/$3';
$route['admin/(:any)/(:any)'] = 'admin/$2/$1';
$route['admin/(:any)'] = 'admin/view/$1';
$route['admin'] = 'admin/view/main';

//~~~~~~~~~~~~~~~~~~~~~~front routes~~~~~~~~~~~~~~~~~~~~~
$route['news'] = 'front/news';
$route['news/(:any)'] = 'front/new/$1';

$route['getCategoriesAjax'] = 'goods/getCategoriesAjax';
$route['getCategoriesAccessorsAjax'] = 'accessors/getCategories';
$route['news/(:any)'] = 'front/onenew/$1';
$route['blog/(:any)'] = 'front/post/$1';
$route['vises/(:any)'] = 'front/vises/$1';
$route['accessors/(:any)/(:any)'] = 'front/accessor/$1/$2';
$route['accessors/(:any)'] = 'front/accessors/$1';
$route['(:any)/(:any)/(:any)'] = 'front/good/$1/$2/$3';
$route['(:any)/(:any)'] = 'front/goods/$1/$2';
$route['(:any)'] = 'front/subcategories/$1';
$route['contacts'] ='front/contacts';
$route['about'] ='front/about/$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */