<?php
/**
 * @author		Bramus Van Damme <bramus@bram.us>
 * @copyright	Copyright (c), 2013 Bramus Van Damme
 * @license		GNU General Public License 3 (http://www.gnu.org/licenses/)
 *				Refer to the LICENSE file distributed within the package.
 *
 * @internal 	Inspired by JREAM Route @ https://github.com/JREAM/route — (c) 2012 Jesse Boyer
 * @internal	Inspired by Klein @ https://github.com/chriso/klein.php — (c) 2010 Chris O'Hara
 */

namespace Ikdoeict\Routing;

class Router {

	/**
	* @var array $routes List of URI's to match against
	*/
	private $routes = [], $befores = [];

	/**
	* @var array $routeHandlers List of closures to call
	*/
	private $routeHandlers = [], $beforeHandlers = [];

	/**
	 * 404 function
	 */
	private $notFound;

	/**
	* Before handlers
	*
	* @param string $methods Allowed methods, | delimited
	* @param string $uri A path such as about/system
	* @param object $function An anonymous function
	*/
	public function before($methods, $uri, $function) {

		$uri = trim($uri, '/');

		foreach (explode('|', $methods) as $method) {
			$this->befores[$method][] = $uri;
			$this->beforeHandlers[$method][] = $function;
		}
	}

	/**
	* Match - Store a route and a routehandler to be executed when accessed over one of the methods
	*
	* @param string $methods Allowed methods, | delimited
	* @param string $uri A path such as about/system
	* @param object $function An anonymous function
	*/
	public function match($methods, $uri, $function) {
		$uri = trim($uri, '/');
		foreach (explode('|', $methods) as $method) {
			$this->routes[$method][] = $uri;
			$this->routeHandlers[$method][] = $function;
		}
	}

	// Match shorthands
	public function get($uri, $function) {
		$this->match('GET', $uri, $function);
	}
	public function post($uri, $function) {
		$this->match('POST', $uri, $function);
	}
	public function delete($uri, $function) {
		$this->match('DELETE', $uri, $function);
	}
	public function put($uri, $function) {
		$this->match('PUT', $uri, $function);
	}
	public function options($uri, $function) {
		$this->match('OPTIONS', $uri, $function);
	}

	/**
	* submit - Looks for a match for the URI and runs the related function
	*/
	public function run($callback = null) {

		// Handle all before middlewares
		if (isset($this->befores[$_SERVER['REQUEST_METHOD']]))
			$this->handle($this->befores[$_SERVER['REQUEST_METHOD']], $this->beforeHandlers);

		// Handle all routes
		$numHandled = 0;
		if (isset($this->routes[$_SERVER['REQUEST_METHOD']]))
			$numHandled = $this->handle($this->routes[$_SERVER['REQUEST_METHOD']], $this->routeHandlers, true);

		// If no route was handled, trigger the 404 (if any)
		if (!$numHandled) {
			if ($this->notFound && is_callable($this->notFound)) call_user_func($this->notFound);
			else header('HTTP/1.1 404 Not Found');
		}
		// If a route was handled, perform the callback
		else {
			if ($callback) $callback();
		}
	}

	public function set404($func) {
		$this->notFound = $func;
	}

	/**
	 * Handle the passed in routes
	 */
	private function handle($routes, $routeHandlers, $quitAfterRun = false) {

		// Counter to keep track of the number of routes we've handled
		$numHandled = 0;

		// The current page URL
		$uri = $_SERVER['REQUEST_URI'];

		// remove rewrite basepath
		$basepath = implode('/', array_slice(explode('/', $_SERVER["SCRIPT_NAME"]), 0, -1)) . '/';
		$uri = substr($uri, strlen($basepath));

		// Don't take query params into account on the URL
		if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));

		// Remove trailing slash
		$uri = trim($uri, '/');

		// Variables in the URL
		$urlvars = [];

		// Loop all routes
		foreach ($routes as $listKey => $listUri) {

			// we have a match!
			if (preg_match("#^$listUri$#", $uri)) {

				// Split the request URL and the route URL
				$requestUri = explode('/', $uri);
				$routeUri = explode('/', $listUri);

				// Extract the dynamic parts from the route
				foreach ($routeUri as $key => $value) {
					if (in_array($value, array('.+', '.*', '\d+','\w+'))) {
						$urlvars[] = $requestUri[$key];
					}

				}

				// call the handling function with the urlvars
				call_user_func_array($routeHandlers[$_SERVER['REQUEST_METHOD']][$listKey], $urlvars);

				// yay!
				$numHandled++;

				// If we need to quit, then quit
				if ($quitAfterRun) break;

			}

		}

		// Return the number of routes handled
		return $numHandled;

	}

}