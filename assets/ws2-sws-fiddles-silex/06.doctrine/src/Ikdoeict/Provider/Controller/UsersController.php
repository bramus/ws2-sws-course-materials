<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class UsersController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];
		$controllers->get('/', array($this, 'overview'));
		$controllers->get('/{id}/', array($this, 'detail'))->assert('id', '\d+');
		$controllers->get('/{id}/links/', array($this, 'links'))->assert('id', '\d+');
		return $controllers;
	}

	public function overview(Application $app) {
		$users = $app['db']->fetchAll('SELECT * FROM users');
		return $app['twig']->render('users/overview.twig', array('users' => $users));
	}


	public function detail(Application $app, $id) {
		$user = $app['db']->fetchAssoc('SELECT * FROM users WHERE id = ?', array($id));
		if (!$user) {
			$app->abort(404, 'The requested user (id #' . $app->escape($id) . ') does not exist');
		}
		$linkcount = $app['db']->fetchColumn('SELECT COUNT(*) FROM links WHERE added_by = ?', array($id));
		return $app['twig']->render('users/detail.twig', array('user' => $user, 'linkcount' => $linkcount));
	}


	public function links(Application $app, $id) {
		$user = $app['db']->fetchAssoc('SELECT * FROM users WHERE id = ?', array($id));
		if (!$user) {
			$app->abort(404, 'The requested user (id #' . $app->escape($id) . ') does not exist');
		}
		$links = $app['db']->fetchAll('SELECT * FROM links WHERE added_by = ?', array($id));
		return $app['twig']->render('users/links.twig', array('user' => $user, 'links' => $links));
	}

}