<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;


$request = Request::createFromGlobals();
$routes = include __DIR__.'/../src/app.php';

$context = new Routing\RequestContext();
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new Logic\ContentLengthListener());
$dispatcher->addSubscriber(new Logic\GoogleListener());
//$dispatcher->addListener('response', [new Logic\ContentLengthListener(), 'onResponse'], -255);
//$dispatcher->addListener('response', [new Logic\GoogleListener(), 'onResponse']);

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();

$framework = new Logic\Framework($dispatcher, $matcher, $controllerResolver, $argumentResolver);
$framework = new HttpKernel\HttpCache\HttpCache(
    $framework,
    new HttpKernel\HttpCache\Store(__DIR__.'/../cache'),
    new HttpKernel\HttpCache\Esi(),
    ['debug' => true]
);

$framework->handle($request)->send();
