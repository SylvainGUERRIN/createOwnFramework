<?php
require_once __DIR__.'/../vendor/autoload.php';

use Logic\StringResponseListener;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpFoundation\Request;

$routes = include __DIR__.'/../src/app.php';
$container = include __DIR__.'/../src/container.php';

$container->register('listener.string_response', StringResponseListener::class);
$container->getDefinition('dispatcher')
    ->addMethodCall('addSubscriber', [new Reference('listener.string_response')])
;

$container->setParameter('debug', true);
echo $container->getParameter('debug');

$container->register('listener.response', HttpKernel\EventListener\ResponseListener::class)
    ->setArguments(['%charset%'])
;

$request = Request::createFromGlobals();

$response = $container->get('framework')->handle($request);

$response->send();
