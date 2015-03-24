<?php

/**
 * BOOTSTRAP
 * ===============
 */

	// Requires
	require_once __DIR__ . '/ikdoeict/routing/router.php';

	// Create a router and a response
	$router = new Ikdoeict\Routing\Router();

	// Before middleware
	$router->before('GET|POST', '/admin/.*', function() {
		if (!isset($_SESSION['userId'])) {
			header('location: /assets/07/examples/router/admin');
			exit();
		}
	});

	// Override the 404
	$router->set404(function() {
		header('HTTP/1.1 404 Not Found');
		echo 'Uh oh - route not found!';
	});



/**
 * ROUTING
 * ===============
 */


	// Index
	$router->get('/', function() {
		echo 'Welcome to my website!<br />Allowed routes: /hello, /hello/{name}<br />Subresources of /admin only allowed if you are logged in';
	});

	// Hello
	$router->get('/hello', function() {
		echo 'Hello, what is your name?';
	});
	$router->post('/hello', function() {
		echo 'Hello POST, what is your name?';
	});

	// Hello name
	$router->get('/hello/\w+', function($name) {
		echo 'Hello ' . htmlentities($name);
	});

	// Admin index
	$router->get('/admin', function() {
		echo '(admin login form here)';
	});

	// Admin subpages
	$router->get('/admin/.*', function() {
		echo 'This should only be visible if you are logged in';
	});



/**
 * RUN FORREST RUN!
 * ===============
 */

	$router->run(function() {
		echo '<br /><br /><em>(we are done here)</em>';
	});