<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;

class UsersController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];
		$controllers->get('/', array($this, 'overview'))->bind('users');
		$controllers->get('/{id}/', array($this, 'detail'))->assert('id', '\d+')->bind('user.detail');
		$controllers->get('/{id}/links/', array($this, 'links'))->assert('id', '\d+')->bind('user.links');
		return $controllers;
	}

	public function overview(Application $app) {
		$users = $app['users']->findAll();
		return $app['twig']->render('users/overview.twig', array('users' => $users));
	}


	public function detail(Application $app, $id) {
		$user = $app['users']->find($id);
		if (!$user) {
			$app->abort(404, 'The requested user (id #' . $app->escape($id) . ') does not exist');
		}
		$linkcount = $app['users']->getNumLinks($id);
		return $app['twig']->render('users/detail.twig', array('user' => $user, 'linkcount' => $linkcount));
	}


	public function links(Application $app, $id) {
		$user = $app['users']->find($id);
		if (!$user) {
			$app->abort(404, 'The requested user (id #' . $app->escape($id) . ') does not exist');
		}
		$links = $app['users']->getLinks($id);
		return $app['twig']->render('users/links.twig', array('user' => $user, 'links' => $links));
	}

}