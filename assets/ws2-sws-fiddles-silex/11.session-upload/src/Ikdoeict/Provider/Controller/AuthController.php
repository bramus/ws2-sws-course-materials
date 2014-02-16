<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\Validator\Constraints as Assert;

class AuthController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];

		$controllers->get('/', function(Application $app) {
			return $app->redirect($app['url_generator']->generate('auth.login'));
		});

		$controllers->match('/login/', array($this, 'login'))->method('GET|POST')->bind('auth.login');

		$controllers->get('/logout/', array($this, 'logout'))->assert('id', '\d+')->bind('auth.logout');

		return $controllers;
	}

	public function login(Application $app) {

		// Already logged in
		if ($app['session']->get('user')) {
			return $app->redirect($app['url_generator']->generate('home'));
		}

		// Create Form
		$loginform = $app['form.factory']->createNamed('loginform')
			->add('username', 'text', array(
				'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5)))
			))
			->add('password', 'password', array(
				'constraints' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5)))
			));

		// Form was submitted: process it
		if ('POST' == $app['request']->getMethod()) {
			$loginform->bind($app['request']);

			if ($loginform->isValid()) {
				$data = $loginform->getData();

				if ($data['username'] == strrev($data['password'])) { // Oh no, he didn't?!

					$app['session']->set('user', array(
						'id' => 666,
						'username' => $data['username']
					));

					return $app->redirect($app['url_generator']->generate('home'));

				} else {
					$loginform->get('password')->addError(new \Symfony\Component\Form\FormError('Invalid password'));
				}
			}
		}

		return $app['twig']->render('auth/login.twig', array('loginform' => $loginform->createView()));
	}


	public function logout(Application $app) {
		$app['session']->remove('user');
		return $app->redirect($app['url_generator']->generate('auth.login') . '?loggedout');
	}

}