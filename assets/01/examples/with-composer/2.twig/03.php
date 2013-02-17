<?php

// Require autoloader
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

// Twig Bootstrap
$loader = new Twig_Loader_Filesystem(__DIR__ . DIRECTORY_SEPARATOR . 'templates');
$twig = new Twig_Environment($loader, array(
	'cache' => __DIR__ . DIRECTORY_SEPARATOR . 'cache',
	'auto_reload' => true // set to false in production mode
));

// Load in the template and display it (shorthand)
echo $twig->render('03.twig');

// EOF