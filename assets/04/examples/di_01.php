<?php

require_once 'di_bootstrap.php';

// Without DI
class Router {

	protected $request;
	protected $response;

	public function __construct($path) {
		$this->request = new Request();
		$this->response = new Response();
		$this->path = $path;
		// &hellip;
	}

}

$router = new Router('/hello');

echo '<pre>';
var_dump($router);