<?php
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;

Router::prefix('admin', function (RouteBuilder $routes) {
	$routes->plugin('Trois/Blog', ['path' => '/blog'], function (RouteBuilder $routes) {
		$routes->connect('/', ['controller' => 'Posts', 'action' => 'index'], ['routeClass' => DashedRoute::class]);
		$routes->setExtensions(['json']);
		$routes->fallbacks(DashedRoute::class);
	});
});
