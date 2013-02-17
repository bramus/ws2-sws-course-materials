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
$name = 'Bramus <script>alert("XSS Attempt");</script>';
$colleagues = array(
	array('firstname' => 'Davy', 'lastname' => 'De Winne', 'courses' => array('Webdesign & Usability', 'Web & Mobile')),
	array('firstname' => 'Kevin', 'lastname' => 'Picalausa', 'courses' => array('Webprogramming')),
	array('firstname' => 'Joske', 'lastname' => 'Vermeulen'),
);

// Load in the template and display it
$template = $twig->loadTemplate('01.twig');
echo $template->render(array( // alternative: $twig->display(...);
	'name' => $name,
	'colleagues' => $colleagues
));

// EOF