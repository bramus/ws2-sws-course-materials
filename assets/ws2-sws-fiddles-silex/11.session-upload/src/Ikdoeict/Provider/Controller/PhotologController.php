<?php

namespace Ikdoeict\Provider\Controller;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Silex\ControllerCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;

class PhotologController implements ControllerProviderInterface {

	public function connect(Application $app) {
		$controllers = $app['controllers_factory'];

		$controllers
			->get('/', array($this, 'browse'))
			->bind('photolog.browse')
			->before(array($this, 'checkLogin'));

		$controllers
			->match('/upload/', array($this, 'upload'))
			->method('GET|POST')
			->bind('photolog.upload')
			->before(array($this, 'checkLogin'));

		return $controllers;
	}

	public function browse(Application $app) {

		$photos = [];
		$di = new \DirectoryIterator($app['photolog.base_path']);
		foreach ($di as $file) {
			if ($file->getExtension() == 'jpg') {
				$photos[] = array(
					'url' => $app['photolog.base_url'] . '/' . $file,
					'title' => $file->getFileName()
				);
			}
		}

		return $app['twig']->render('photolog/browse.twig', array('photos' => array_reverse($photos)));
	}


	public function upload(Application $app) {

		// Create Upload Form
		$uploadform = $app['form.factory']->createNamed('uploadform')
			->add('photo', 'file', array(
				'constraints' => new Assert\NotBlank()
			));

		// Form was submitted? Process it and start validation
		$uploadform->handleRequest($app['request']);

		// Check file extension. If it's invalid, we'll manually add an error the form so that isValid() ends up returning false later one
		$files = $app['request']->files->get($uploadform->getName());
		if (isset($files['photo']) && ('.jpg' !== substr($files['photo']->getClientOriginalName(), -4))) {
			$uploadform->get('photo')->addError(new \Symfony\Component\Form\FormError('Only .jpg allowed'));
		}

		// Form is valid
		if ($uploadform->isValid()) {

			// Extract form data (not really needed here as we don't do anything with it)
			$data = $uploadform->getData();

			// Define the new name for the file (in this example, files are named sequentially)
			$nextAvailableNumberInBasePath = 1;
			$di = new \DirectoryIterator($app['photolog.base_path']);
			foreach ($di as $file) {
				if ($file->getExtension() == 'jpg') $nextAvailableNumberInBasePath++;
			}

			// Move it to its new location
			$files['photo']->move($app['photolog.base_path'], $nextAvailableNumberInBasePath . '.jpg');

			// Redirec to the overview
			return $app->redirect($app['url_generator']->generate('photolog.browse'));

		}

		return $app['twig']->render('photolog/form.twig', array('uploadform' => $uploadform->createView()));
	}

	public function checkLogin(Request $request, Application $app) {
		if (!$app['session']->get('user')) {
			return $app->redirect($app['url_generator']->generate('auth.login'));
		}
	}

}