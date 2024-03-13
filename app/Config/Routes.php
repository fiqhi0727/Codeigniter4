<?php

use App\Controllers\Komik;
use App\Controllers\News;
use App\Controllers\Pages_tutor;

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// tutor static pages
// $routes->get('/', 'Home::index');
// $routes->get('pages', [Pages_tutor::class, 'index']);
// $routes->get('(:segment)', [Pages_tutor::class, 'view']);

$routes->get('/', 'pages::home');
$routes->get('coba', 'Coba::index');
//$routes->get('/home', 'pages::home');
$routes->get('/komik/index', 'Komik::index');
$routes->get('/komik/create', 'Komik::create');
$routes->delete('/komik/(:num)', 'Komik::delete/$1');
//kalo misalkan user akes komik/apapun, kita arahkan ke controller komik methodnya detail
$routes->get('/komik/(:any)', 'Komik::detail/$1');
$routes->setAutoRoute(true);
