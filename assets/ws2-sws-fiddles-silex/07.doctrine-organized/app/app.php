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
// Mount our controllers
$app->mount('/users', new Ikdoeict\Provider\Controller\UsersController());
$app->mount('/links', new Ikdoeict\Provider\Controller\LinksController());
$app->mount('/', new Ikdoeict\Provider\Controller\HomeController());