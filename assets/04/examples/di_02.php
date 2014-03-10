<?php

require_once 'di_bootstrap.php';

// With DI
class Router {

	protected $request;
	protected $response;

	public function __construct($request, $response, $path) {
		$this->request = $request;
		$this->response = $response;
		$this->path = $path;
		// &hellip;
	}

}

// Create Dependencies
$request = new Request();
$response = new Response();

// Create Router, and inject dependencies
$router = new Router($request, $response, '/hello');

echo '<pre>';
var_dump($router);