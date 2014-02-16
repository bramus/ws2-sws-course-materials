<?php

// Bootstrap
require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

// Use Request from Symfony Namespace
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->error(function (\Exception $e, $code) use ($app) {
	if ($code == 404) {
		return $app['twig']->render('errors/404.twig', array('error' => $e->getMessage()));
	} else {
		return 'Shenanigans! Something went horribly wrong // ' . $e->getMessage();
	}
});

// Before Middleware: Define the first url part and make that available as a variable in Twig
// @note: Next to before() there's also after() — @see http://silex.sensiolabs.org/doc/middlewares.html
$app->before(function (Request $request) use ($app) {
	$app['twig']->addGlobal('first_url_part', explode('/', $request->getPathInfo())[1]);
});

// Finish Middleware: Log the request using Monolog - @see http://silex.sensiolabs.org/doc/providers/monolog.html
$app->finish(function (Request $request, Response $response) use ($app) {
	$app['monolog']->addDebug(sprintf('Served %s request to %s', $request->getMethod(), $request->getRequestUri()));
	// Also possible: addInfo(), addWarning() & addError()
});

// Define routes for our static pages
$pages = array(
	'/' => 'home',
	'/about/' => 'about'
);
foreach ($pages as $route => $view) {
	$app->get($route, function () use ($app, $view) {
		return $app['twig']->render('static/' . $view . '.twig');
	})->bind($view);
}

// Mount our controllers (dynamic routes)
$app->mount('/users', new Ikdoeict\Provider\Controller\UsersController());
$app->mount('/links', new Ikdoeict\Provider\Controller\LinksController());