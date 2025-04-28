<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/nav_home', 'Home::nav_home');
$routes->get('/quienes_somos', 'Home::quienes_somos');
$routes->get('/comercializacion', 'Home::comercializacion');
$routes->get('/informacion_contacto', 'Home::informacion_contacto');
$routes->get('/terminos_uso', 'Home::terminos_uso');
