<?php

// Bootstrap
require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

$app->error(function (\Exception $e, $code) use ($app) {
	if ($code == 404) {
		return $app['twig']->render('errors/404.twig', array('error' => $e->getMessage()));
	} else {
		return 'Shenanigans! Something went horribly wrong // ' . $e->getMessage();
	}
});

// Define routes for our static pages
$pages = array(
	'/' => 'home',
	'/about' => 'about'
);
foreach ($pages as $route => $view) {
	$app->get($route, function () use ($app, $view) {
		return $app['twig']->render('static/' . $view . '.twig');
	})->bind($view);
}

// Mount our controllers (dynamic routes)
// @note: in essence nothing has changed to our controllers, except for binding a name to the route
$app->mount('/users', new Ikdoeict\Provider\Controller\UsersController());
$app->mount('/links', new Ikdoeict\Provider\Controller\LinksController());