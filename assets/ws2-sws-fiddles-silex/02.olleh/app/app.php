<?php

// Bootstrap
require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

// Catch faulty requests (think 404)
$app->error(function (\Exception $e, $code) {
	if ($code == 404) {
		return 'Please visit <code>/olleh/<em>name</em></code> to get your hello world mojo on!';
	} else {
		return 'Shenanigans! Something went horribly wrong';
	}
});

// Routing
$app->get('/', function(Silex\Application $app) {
	return $app->redirect($app['request']->getBaseUrl() . '/olleh');
});

// Dynamic Routing: Catch requests to /olleh and /olleh/{name}
$app->get('/olleh/{name}', function(Silex\Application $app, $name) {
	return '!' . $app->escape($name) . ' olleH';
})
->assert('name', '\w+') // Routing Requirements (only allow alphanumeric characters) - @see http://silex.sensiolabs.org/doc/usage.html#requirements
->convert('name', function($name) { return strrev($name); }) // Route variable converters (convert value before usage) - @see http://silex.sensiolabs.org/doc/usage.html#route-variables-converters
->value('name', 'stranger'); // Default Values - @see http://silex.sensiolabs.org/doc/usage.html#default-values