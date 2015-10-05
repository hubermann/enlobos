<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['control'] = 'dashboard';
$route['control/logout'] = 'dashboard/logout';
$route['migrate/(:num)'] = 'migrate/index/$';
$route['control/lugares/(:num)'] = 'control/lugares/index/$';
$route['control/categoria_comercios/(:num)'] = 'control/categoria_comercios/index/$';
$route['control/comercios/(:num)'] = 'control/comercios/index/$';
$route['control/eventos/(:num)'] = 'control/eventos/index/$';
$route['control/categorias_eventos/(:num)'] = 'control/categorias_eventos/index/$';
/* append */
$route['default_controller'] = 'front';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
