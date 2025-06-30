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
$routes->get('/catalogo', 'ProductoController::catalogo');
$routes->get('/gestion_usuarios', 'UsuarioController::gestion_usuarios');

// Rutas usuarios (Admin) 
$routes->get('/panel_admin', 'UsuarioController::panel');
$routes->get('/panel', 'UsuarioController::panel');
$routes->get('/admin/usuarios', 'UsuarioController::gestion_usuarios');
$routes->get('/Usuario/editar_usuario/(:num)', 'UsuarioController::editar_usuario/$1');
$routes->post('/admin/usuarios/actualizar/(:num)', 'UsuarioController::actualizar_usuario/$1');
$routes->get('/admin/usuarios/activar/(:num)', 'UsuarioController::activar_usuario/$1');
$routes->get('/admin/usuarios/desactivar/(:num)', 'UsuarioController::desactivar_usuario/$1');
$routes->get('/admin/ventas', 'VentaController::gestion_ventas');

//Rutas de Categoría (Admin)
$routes->get('/categorias', 'CategoriaController::index');
$routes->get('/categorias/crear', 'CategoriaController::crear');
$routes->post('/categorias/guardar', 'CategoriaController::guardar');
$routes->get('/categorias/editar/(:num)', 'CategoriaController::editar/$1');
$routes->post('/categorias/actualizar/(:num)', 'CategoriaController::actualizar/$1');
$routes->get('/categorias/desactivar/(:num)', 'CategoriaController::desactivar/$1');
$routes->get('/categorias/activar/(:num)', 'CategoriaController::activar/$1');
// ventas administrador
$routes->post('/admin/ventas/actualizar_estado/(:num)', 'VentaController::actualizar_estado/$1');

//Rutas de Producto (Admin)
$routes->get('/index_producto', 'ProductoController::index'); 
$routes->get('/crear', 'ProductoController::crear');
$routes->post('/productos/guardar', 'ProductoController::guardar');
$routes->get('productos/detalles_productos/(:num)', 'ProductoController::detalle/$1');
$routes->get('/productos/editar/(:num)', 'ProductoController::editar/$1');
$routes->post('/productos/actualizar/(:num)', 'ProductoController::actualizar/$1');
$routes->get('/productos/desactivar/(:num)', 'ProductoController::desactivar/$1');
$routes->get('/productos/activar/(:num)', 'ProductoController::activar/$1'); 

// --- Rutas para el Carrito de Compras ---
$routes->get('/carrito', 'CarritoController::index');
$routes->post('/carrito/agregar', 'CarritoController::agregar');
$routes->post('/carrito/actualizar', 'CarritoController::actualizar'); // Ruta para el botón "Actualizar Cantidades"
$routes->get('/carrito/eliminar/(:num)', 'CarritoController::eliminar/$1');

// --- Rutas para Favoritos ---
$routes->get('/favoritos', 'FavoritoController::index');
$routes->get('/favoritos/agregar/(:num)', 'FavoritoController::agregar/$1');
$routes->get('/favoritos/eliminar/(:num)', 'FavoritoController::eliminar/$1');
$routes->get('/favoritos/agregar_todo_al_carrito', 'FavoritoController::agregarTodoAlCarrito');

// --- Rutas para Ventas usuario ---
$routes->get('/checkout', 'VentaController::checkout');
$routes->get('/ventas', 'VentaController::index'); // Ruta para el historial de compras del usuario
$routes->post('/venta/procesar', 'VentaController::procesar_venta');
$routes->get('ventas/ticket/(:num)', 'VentaController::ticket/$1');

// Rutas para las consultas públicas
$routes->get('/consultas', 'ConsultaController::index'); // Muestra el formulario
$routes->post('/consultas/guardar', 'ConsultaController::guardar'); // Procesa el envío del formulario

// Rutas para el panel de administración de consultas (ajustadas a tu estilo existente)
$routes->get('/admin/consultas', 'ConsultaController::verConsultasAdmin');
$routes->get('/admin/consultas/cambiar-estado/(:num)', 'ConsultaController::cambiarEstado/$1');


$routes->setAutoRoute(false);//permite que CodeIgniter maneje las rutas automáticamente