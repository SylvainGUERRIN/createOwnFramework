<?php
use Symfony\Component\Routing;

$routes = new Routing\RouteCollection();
$routes->add('home', new Routing\Route('/'));
$routes->add('hello', new Routing\Route('/hello/{name}', ['name' => 'World']));
$routes->add('bye', new Routing\Route('/bye'));

return $routes;
