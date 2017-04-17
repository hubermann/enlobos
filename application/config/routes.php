<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['turismo'] = 'front/turismo/$';
$route['turismo/(:num)'] = 'front/turismo/$';
$route['turismo/(:any)/(:num)'] = 'front/show_turismo';

$route['terminos-y-condiciones-de-uso'] =  "frontend/terminos";
$route['sobre-trabajo-ya'] =  "frontend/about";

#$route['(:any)'] = "front/switcher";
$route['trabajo'] = 'publicaciones/index';
$route['trabajo/(:any)/(:num)'] = 'publicaciones/show';
$route['publicaciones'] = 'publicaciones/index';
$route['categoria/(:any)/(:num)'] = 'publicaciones/por_categoria';

$route['mis-publicaciones'] = 'publicaciones/mis_publicaciones';
$route['publicaciones/(:num)'] = 'publicaciones/detail';
$route['publicaciones/nueva'] = 'publicaciones/nueva';
$route['publicaciones/create'] = 'publicaciones/create';
$route['publicaciones/editar/(:num)'] = 'publicaciones/editar';
$route['publicaciones/eliminar/(:num)'] = 'publicaciones/delete_comfirm';
$route['publicaciones/delete/(:num)'] = 'publicaciones/delete';
#$route['(:any)/(:num)'] = 'publicaciones/show';
$route['by-tag/(:any)'] = 'publicaciones/by_tag';
$route['user/(:any)'] = 'publicaciones/by_user';
$route['buscar'] = 'publicaciones/busqueda';

/* LOGIN */
$route['registro'] = 'users_front/registro';
$route['ingreso'] = 'users_front/ingreso';
$route['desconectar'] = 'users_front/desconectar';
$route['perfil'] = 'users_front/perfil';
$route['perfil-editar'] = 'users_front/perfil_modificar';
$route['perfil-imagen'] = 'users_front/perfil_modificar_imagen';
$route['perfil-cargar-imagen'] = 'users_front/upload_imagen';
$route['perfil-modificar-acceso'] = 'users_front/perfil_modificar_password';
$route['reset_password'] = 'users_front/reset_password';
$route['solicitud_reset_password'] = 'users_front/solicitud_reset_password';
$route['callback_reset_validation/(:any)'] = 'users_front/callback_reset_password';
$route['create_new_pass'] = 'users_front/create_new_pass';


/* SHORTLINKS */
$route['sh/(:any)'] = 'Shortlinks/index';
$route['sh/new'] = 'Shortlinks/create';

$route['contacto'] = 'frontend/contacto';
$route['process_contact'] = 'frontend/process_contact';

/* SUSCRIPCION NEWSLETTER */
$route['suscripcion_newsletter'] = 'front/suscripcion_newsletter';






$route['control'] = 'dashboard';
$route['control/logout'] = 'dashboard/logout';
$route['migrate/(:num)'] = 'migrate/index/$';

$route['control/publicaciones/(:num)'] = 'control/publicaciones/index/$';
$route['control/categorias_publicaciones/(:num)'] = 'control/categorias_publicaciones/index/$';
$route['control/publicaciones/(:num)'] = 'control/publicaciones/index/$';
$route['control/shortlinks/(:num)'] = 'control/shortlinks/index/$';

$route['control/lugares/(:num)'] = 'control/lugares/index/$';
$route['control/categoria_comercios/(:num)'] = 'control/categoria_comercios/index/$';
$route['control/comercios/(:num)'] = 'control/comercios/index/$';
$route['control/eventos/(:num)'] = 'control/eventos/index/$';
$route['control/categorias_eventos/(:num)'] = 'control/categorias_eventos/index/$';
$route['control/sliders/(:num)'] = 'control/sliders/index/$';
/* append */
$route['default_controller'] = 'front';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
