<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\Validator\Constraints as Assert;

class LinksController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];
		$controllers->match('/', array($this, 'overview'))->method('GET|POST')->bind('links');
		$controllers->get('/{id}', array($this, 'detail'))->assert('id', '\d+')->bind('link.detail');
		return $controllers;
	}

	public function overview(Application $app) {

		// Create “Add Link” Form
		$addlinkform = $app['form.factory']->createNamed('loginform')
			->add('title', 'text', array(
				'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5)))
			))
			->add('url', 'url', array(
				'constraints' => array(new Assert\NotBlank(), new Assert\Url())
			));

		// “Add Link” form was submitted: process it
		if ('POST' == $app['request']->getMethod()) {
			$addlinkform->bind($app['request']);

			if ($addlinkform->isValid()) {
				$data = $addlinkform->getData();

				// inject extra fields needed for database
				$data['added_by'] = '1'; // @todo: fetch this from the session
				$data['added_on'] = date('Y-m-d');

				$app['links']->insert($data);

				return $app->redirect($app['url_generator']->generate('links') . '?added');
			}
		}

		$links = $app['links']->findAll();
		return $app['twig']->render('links/overview.twig', array('links' => $links, 'addlinkform' => $addlinkform->createView()));
	}


	public function detail(Application $app, $id) {
		$link = $app['links']->find($id);
		if (!$link) {
			$app->abort(404, 'The requested link (id #' . $app->escape($id) . ') does not exist');
		}
		return $app->redirect($link['url']);
	}

}