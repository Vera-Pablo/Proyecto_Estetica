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
//Ruta para encriptar contraseñas
$routes->get('/encriptar', 'Home::encriptar');

//Rutas de Usuario
$routes->get('/login', 'UsuarioController::login');
$routes->post('/usuario/autenticar', 'UsuarioController::autenticar');
$routes->get('/registrar', 'UsuarioController::registro');
$routes->post('/usuario/guardarRegistro', 'UsuarioController::guardarRegistro');
$routes->get('/panel', 'UsuarioController::panel');
$routes->get('/usuario/logout', 'UsuarioController::logout');

//Rutas del Admin
$routes->get('/panel_admin', 'UsuarioController::panel_admin');

//Rutas de Producto (Admin)
$routes->get('/productos', 'ProductoController::index'); 
$routes->get('/crear', 'ProductoController::crearProducto');
$routes->post('/productos/guardar', 'ProductoController::guardar');
$routes->get('/productos/editar/(:num)', 'ProductoController::editar/$1');
$routes->post('/productos/actualizar/(:num)', 'ProductoController::actualizar/$1');
$routes->get('/productos/desactivar/(:num)', 'ProductoController::desactivar/$1');

//Rutas de Categoría (Admin)
$routes->get('/categorias', 'CategoriaController::index');
$routes->get('/categorias/crear', 'CategoriaController::crear');
$routes->post('/categorias/guardar', 'CategoriaController::guardar');
$routes->get('/categorias/editar/(:num)', 'CategoriaController::editar/$1');
$routes->post('/categorias/actualizar/(:num)', 'CategoriaController::actualizar/$1');
$routes->get('/categorias/desactivar/(:num)', 'CategoriaController::desactivar/$1');

//Rutas del Usuario 
$routes->get('catalogo', 'ProductoController::catalogo');
$routes->get('detalle/(:num)', 'ProductoController::detalle/$1');
//Ruta Carrito

//Favorito

//Ventas

$routes->setAutoRoute(true); //permite que CodeIgniter maneje las rutas automáticamente