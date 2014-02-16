<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class LinksController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];
		$controllers->get('/', array($this, 'overview'));
		$controllers->get('/{id}/', array($this, 'detail'))->assert('id', '\d+');
		return $controllers;
	}

	public function overview(Application $app) {
		$links = $app['db']->fetchAll('SELECT links.url, links.title, links.id, links.added_on, links.added_by, users.firstname FROM links INNER JOIN users ON links.added_by = users.id');
		return $app['twig']->render('links/overview.twig', array('links' => $links));
	}


	public function detail(Application $app, $id) {
		$link = $app['db']->fetchAssoc('SELECT * FROM links WHERE id = ?', array($id));
		if (!$link) {
			$app->abort(404, 'The requested link (id #' . $app->escape($id) . ') does not exist');
		}
		return $app->redirect($link['url']);
	}

}