<?php

// Bootstrap
require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

// Catch faulty requests (think 404) - @see http://silex.sensiolabs.org/doc/usage.html#error-handlers
$app->error(function (\Exception $e, $code) {
	if ($code == 404) {
		return 'Please visit <code>/hello/<em>name</em></code> to get your hello world mojo on!';
	} else {
		return 'Shenanigans! Something went horribly wrong';
	}
});

// Basic Routing
$app->get('/', function(Silex\Application $app) {
	return $app->redirect($app['request']->getBaseUrl() . '/hello');
});

// Dynamic Routing: Catch requests to /hello/{name} - @see http://silex.sensiolabs.org/doc/usage.html#dynamic-routing
$app->get('/hello/{name}/', function(Silex\Application $app, $name) {
	return 'Hello ' . $app->escape($name) . '!';
});

// Not demonstrated: other request methods
// ->post() - matches POST - @see http://silex.sensiolabs.org/doc/usage.html#example-post-route
// ->match() - matches *all* types of requests. May be combined with ->method() - @see http://silex.sensiolabs.org/doc/usage.html#other-methods