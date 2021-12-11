<?php

declare(strict_types=1);

namespace App;

require_once __DIR__ . '/../vendor/autoload.php';


use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Controller\ArgumentResolver;
use Symfony\Component\HttpKernel\Controller\ControllerResolver;
use Symfony\Component\HttpKernel\EventListener\RouterListener;
use Symfony\Component\HttpKernel\HttpKernel;
use Symfony\Component\Routing\Matcher\UrlMatcher;
use Symfony\Component\Routing\RequestContext;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

if (is_file(__DIR__ . '/.env.local')) {
    $env = new Dotenv();
    $env->load(__DIR__ . '/.env.local');
}

$routes = new RouteCollection();
$routes->add('index', new Route('/{botName}', ['_controller' => new WebhookController()]));

$matcher = new UrlMatcher($routes, new RequestContext());

$dispatcher = new EventDispatcher();
$dispatcher->addSubscriber(new RouterListener($matcher, new RequestStack()));

$controllerResolver = new ControllerResolver();
$argumentResolver = new ArgumentResolver();
$kernel = new HttpKernel($dispatcher, $controllerResolver, new RequestStack(), $argumentResolver);

$request = Request::createFromGlobals();

$response = $kernel->handle($request);
$response->send();