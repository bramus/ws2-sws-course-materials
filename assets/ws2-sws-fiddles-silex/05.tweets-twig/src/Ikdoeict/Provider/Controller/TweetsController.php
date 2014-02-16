<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class TweetsController implements ControllerProviderInterface {

	protected $data;

	function __construct($data) {
		$this->data = $data;
	}

	public function connect(Application $app) {

		//@note $app['controllers_factory'] is a factory that returns a new instance of ControllerCollection when used.
		//@see http://silex.sensiolabs.org/doc/organizing_controllers.html
		$controllers = $app['controllers_factory'];

		// Bind sub-routes
		$controllers->get('/', array($this, 'overview'));
		$controllers->get('/{id}/', array($this, 'detail'))->assert('id', '\d+');

		return $controllers;

	}

	public function overview(Application $app) {
		return $app['twig']->render('tweets/overview.twig', array('tweets' => $this->data));
	}


	public function detail(Application $app, $id) {
		if (!isset($this->data[$id])) {
			$app->abort(404, 'The requested tweet (id# ' . $app->escape($id) . ') does not exist');
		}
		return $app['twig']->render('tweets/detail.twig', array('tweet' => $this->data[$id]));
	}

}