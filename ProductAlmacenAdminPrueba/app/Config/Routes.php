<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/consulta', 'Home::consulta');
$routes->post('/nuevo', 'Home::nuevo');
$routes->get('/producto', 'Home::producto');
$routes->post('/eliminar', 'Home::eliminar');
$routes->post('/actualizar', 'Home::actualizar');
$routes->get('/pagination', 'Home::pagination');