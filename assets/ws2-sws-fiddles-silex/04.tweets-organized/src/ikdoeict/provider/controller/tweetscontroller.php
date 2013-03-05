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
		$controllers->get('/{id}', array($this, 'detail'))->assert('id', '\d+');

		return $controllers;

	}

	public function overview(Application $app) {
		$output = '<ul>';
		foreach ($this->data as $id => $tweet) {
			$output .= '<li><a href="' . $app['request']->getBaseUrl(). '/tweets/' . $app->escape($id) . '">&para;</a> ' . $app->escape($tweet['text']) . '<br />&mdash; by ' . $app->escape($tweet['author'])  .' <i>' . $app->escape($tweet['created_at']) . '</i></li>';
		}
		$output .= '</ul>';
		return $output;
	}


	public function detail(Application $app, $id) {
		if (!isset($this->data[$id])) {
			$app->abort(404, "Tweet $id does not exist");
		}
		$tweet = $this->data[$id];
		$output = '<p>On ' . $tweet['created_at'] . ' ' . $app->escape($tweet['author']) . ' tweeted:</p><blockquote>' . $app->escape($tweet['text']) . '</blockquote><p><a href="' . $app['request']->getBaseUrl(). '/tweets">&larr; Back to overview</a></p>';
		return $output;
	}

}