<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Rutas Principales (las que ya tenías para Home)
$routes->get('/', 'Home::index');
$routes->get('/quienes_somos', 'Home::quienes_somos');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('/informacion_contacto', 'Home::informacion_contacto');
$routes->get('/gracias', 'Home::gracias'); // Asumo que esta es una página de "gracias"
$routes->get('/terminos_uso', 'Home::terminos_uso');
$routes->get('/consultas', 'Home::consultas'); // Para el formulario de consultas

// --- Rutas para Usuarios ---
// Mostrar formulario de login
$routes->get('/login', 'UsuarioController::login');
// Procesar el formulario de login
$routes->post('/autenticar', 'UsuarioController::autenticar'); // El form de login.php apunta aquí
// Mostrar formulario de registro
$routes->get('/registro', 'UsuarioController::registro');
// Procesar el formulario de registro
$routes->post('/guardarRegistro', 'UsuarioController::guardarRegistro'); // El form de registro.php apunta aquí
// Cerrar sesión
$routes->get('/logout', 'UsuarioController::logout');

// (Opcional) Panel de Administración de Usuarios - Añadiremos esto más adelante
// $routes->get('/usuarios/panel', 'UsuarioController::panel', ['filter' => 'authGuard:admin']); // Ejemplo con filtro

// --- Rutas para el Carrito ---
// Ver el carrito
$routes->get('/carrito', 'CarritoController::index');
// Agregar un producto al carrito (se envía desde un formulario, usualmente POST)
$routes->post('/carrito/agregar', 'CarritoController::agregar');
// Eliminar un producto del carrito (el :num es un placeholder para el ID del item del carrito)
$routes->get('/carrito/eliminar/(:num)', 'CarritoController::eliminar/$1');

$routes->get('/productos', 'ProductoController::index'); // Para el catálogo
$routes->get('/producto/(:num)', 'ProductoController::detalle/$1'); // Para el detalle

// --- Rutas para Favoritos ---
$routes->get('/favoritos', 'FavoritoController::index');

// En app/Config/Routes.php
$routes->get('/categorias', 'CategoriaController::index');

// Rutas de Admin para Categorías (ejemplo, necesitarás filtros)
$routes->group('admin', ['filter' => 'authGuard:admin'], function($routes) { // Ejemplo de filtro
    $routes->get('categorias/crear', 'CategoriaController::crear');
    $routes->post('categorias/guardar', 'CategoriaController::guardar');
    $routes->get('categorias/editar/(:num)', 'CategoriaController::editar/$1');
    $routes->post('categorias/actualizar/(:num)', 'CategoriaController::actualizar/$1'); // Usualmente POST o PUT
    // $routes->put('categorias/actualizar/(:num)', 'CategoriaController::actualizar/$1'); // Si usas PUT
    $routes->get('categorias/eliminar/(:num)', 'CategoriaController::eliminar/$1'); // O POST/DELETE

// En app/Config/Routes.php
$routes->get('/favoritos', 'FavoritoController::index', ['filter' => 'authGuard']); // 'authGuard' es un filtro de ejemplo para asegurar que el usuario esté logueado
$routes->post('/favoritos/agregar/(:num)', 'FavoritoController::agregar/$1', ['filter' => 'authGuard']); // (:num) es el producto_id
$routes->post('/favoritos/eliminar/(:num)', 'FavoritoController::eliminar/$1', ['filter' => 'authGuard']); // (:num) es el producto_id
// O si prefieres GET para eliminar (menos seguro para acciones que modifican datos):
// $routes->get('/favoritos/eliminar/(:num)', 'FavoritoController::eliminar/$1', ['filter' => 'authGuard']);    

});