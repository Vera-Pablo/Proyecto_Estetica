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
$routes->get('/usuario/editar', 'UsuarioController::editar');
$routes->post('/usuario/actualizar', 'UsuarioController::actualizar');

// --- Rutas de Gestión de Usuarios para el Admin --
$routes->get('/panel_admin', 'UsuarioController::panel_admin');
$routes->get('/admin/usuarios', 'UsuarioController::gestion_usuarios');
$routes->get('/admin/usuarios/editar/(:num)', 'UsuarioController::editar_usuario/$1');
$routes->post('/admin/usuarios/actualizar/(:num)', 'UsuarioController::actualizar_usuario/$1');
$routes->get('/admin/usuarios/activar/(:num)', 'UsuarioController::activar_usuario/$1');
$routes->get('/admin/usuarios/desactivar/(:num)', 'UsuarioController::desactivar_usuario/$1');

//Rutas de Producto (Admin)
$routes->get('/productos', 'ProductoController::index'); 
$routes->get('/crear', 'ProductoController::crearProducto');
$routes->post('/productos/guardar', 'ProductoController::guardar');
$routes->get('/productos/editar/(:num)', 'ProductoController::editar/$1');
$routes->post('/productos/actualizar/(:num)', 'ProductoController::actualizar/$1');
$routes->get('/productos/desactivar/(:num)', 'ProductoController::desactivar/$1');
$routes->get('/productos/activar/(:num)', 'ProductoController::activar/$1'); 

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

// --- Rutas para la sección de Ventas (VERSIÓN CORRECTA) ---

    // Muestra el historial de compras del cliente
    $routes->get('/ventas', 'VentaController::index');

    // Muestra el detalle de una compra específica
    $routes->get('/ventas/ver/(:num)', 'VentaController::ver/$1');

    // Muestra el panel de gestión de TODAS las ventas para el admin
    $routes->get('/admin/ventas', 'VentaController::gestion_ventas');

$routes->setAutoRoute(true); //permite que CodeIgniter maneje las rutas automáticamente