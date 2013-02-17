<?php

// Require autoloader
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Twig Bootstrap
$loader = new Twig_Loader_Filesystem(__DIR__ . DIRECTORY_SEPARATOR . 'templates');
$twig = new Twig_Environment($loader, array(
	'cache' => __DIR__ . DIRECTORY_SEPARATOR . 'cache',
	'auto_reload' => true // set to false in production mode
));

// Vars
$name = 'Bramus';

// Load in the template and display it
$template = $twig->loadTemplate('02.twig');
echo $template->render(array(
	'name' => $name,
	'myarray' => array(
		'JLW272' => 'WS1: Clientside Webscripten',
		'JLW274' => 'WS1: Serverside Webscripten',
		'JLW280' => 'WS2: Serverside Webscripten'
	)
));

// EOF