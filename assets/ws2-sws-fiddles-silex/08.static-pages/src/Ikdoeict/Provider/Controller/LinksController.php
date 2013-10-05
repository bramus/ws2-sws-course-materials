<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class LinksController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];
		$controllers->get('/', array($this, 'overview'))->bind('links');
		$controllers->get('/{id}', array($this, 'detail'))->assert('id', '\d+')->bind('link.detail');
		return $controllers;
	}

	public function overview(Application $app) {
		$links = $app['links']->findAll();
		return $app['twig']->render('links/overview.twig', array('links' => $links));
	}


	public function detail(Application $app, $id) {
		$link = $app['links']->find($id);
		if (!$link) {
			$app->abort(404, 'The requested link (id #' . $app->escape($id) . ') does not exist');
		}
		return $app->redirect($link['url']);
	}

}