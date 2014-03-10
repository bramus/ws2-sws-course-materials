<?php

require_once 'di_bootstrap.php';

// Very (very) simple SL
class ServiceLocator {

	protected $dependencies= [];

	public function get($name) {
		return isset($this->dependencies[$name]) ? (is_callable($this->dependencies[$name]) ? $this->dependencies[$name]() : $this->dependencies[$name]) : null;
	}

	public function set($name, $val) {
		$this->dependencies[$name] = $val;
	}

	// @note: yes, we could use __set() and __call here, I know.

}

class Router {

	protected $request;
	protected $response;

	public function __construct(ServiceLocator $sl, $path) {
		$this->request = $sl->get('request');
		$this->response = $sl->get('response');
		$this->path = $path;
		// &hellip;
	}

}

// Create SL
$sl = new ServiceLocator();

// Tell DiC how to create dependencies
$sl->set('request', function() {
	return new Request();
});
$sl->set('response', function() {
	return new Response();
});

// Create a router, injecting the dependencies
$router = new Router($sl, '/hello');

echo '<pre>';
var_dump($router);