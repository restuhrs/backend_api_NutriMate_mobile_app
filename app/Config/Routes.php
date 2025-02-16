<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

//handle auth dan route
$routes->post('user/login', 'UserController::index');
$routes->post('user/signup', 'UserController::create');
$routes->put('user/update/(:num)', 'UserController::update/$1'); 
$routes->delete('user/delete/(:num)', 'UserController::delete/$1'); 

$routes->post('anak/save', 'AnakController::save');
