<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Rutas Publica
$routes->get('/', 'Home::index');
$routes->get('/quienes_somos', 'Home::quienes_somos');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('/informacion_contacto', 'Home::informacion_contacto');
$routes->get('/gracias', 'Home::gracias');
$routes->get('/terminos_uso', 'Home::terminos_uso');
$routes->get('/consultas', 'Home::consultas');

//Rutas de Usuario
$routes->get('/login', 'UsuarioController::login');
$routes->post('/usuario/autenticar', 'UsuarioController::autenticar');
$routes->get('/registrar', 'UsuarioController::registro');
$routes->post('/usuario/guardarRegistro', 'UsuarioController::guardarRegistro');
$routes->get('/usuario/logout', 'UsuarioController::logout');
$routes->get('/usuario/panel', 'UsuarioController::panel');

//Rutas del Admin
$routes->get('/admin', 'UsuarioController::adminPanel');

//Rutas de Producto (Admin)
$routes->get('/productos', 'ProductoController::index'); // index_producto
$routes->get('/productos/crear', 'ProductoController::crear');
$routes->post('/productos/guardar', 'ProductoController::guardar');
$routes->get('/productos/editar/(:num)', 'ProductoController::editar/$1');
$routes->get('/productos/eliminar/(:num)', 'ProductoController::eliminar/$1');

//Rutas del Usuario 
$routes->get('catalogo', 'ProductoController::catalogo');
$routes->get('detalle/(:num)', 'ProductoController::detalle/$1');
//Ruta Carrito

//Favorito

//Ventas

$routes->setAutoRoute(true); //permite que CodeIgniter maneje las rutas automáticamente