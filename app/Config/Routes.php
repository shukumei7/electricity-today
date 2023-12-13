<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 // Group routes with 'admin' prefix
$routes->group('admin', function($routes)
{
    $routes->get('articles', 'Article::index');
    $routes->get('articles/create', 'Article::create');
    $routes->post('articles/store', 'Article::store');
    $routes->get('articles/edit/(:segment)', 'Article::edit/$1');
    $routes->post('articles/update/(:segment)', 'Article::update/$1');
    $routes->get('articles/delete/(:segment)', 'Article::delete/$1');
    $routes->get('categories/edit/(:segment)', 'Category::edit/$1');
    $routes->post('categories/update/(:segment)', 'Category::update/$1');
});

$routes->group('api', function($routes) 
{
    $routes->get('categories', 'Category::list');
    $routes->get('categories/(:segment)', 'Category::articles/$1');
    $routes->get('articles', 'Article::latest');
    $routes->get('articles/(:segment)', 'Article::view/$1');
});

$routes->get('(:any)', 'Home::index/$1');
