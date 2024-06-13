<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
$routes->get('/index', 'Home::default');
$routes->post('/login', 'Home::login');
$routes->get('/consulta', 'Home::consulta');
$routes->post('/nuevo', 'Home::nuevo');
$routes->get('/user', 'Home::userInfo');
$routes->post('/eliminar', 'Home::eliminar');
$routes->post('/actualizar', 'Home::actualizar');
$routes->get('/pagination', 'Home::pagination');