<?php

// Bootstrap
require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

// Basic Routing
$app->get('/', function(Silex\Application $app) {
	return 'ohai';
});