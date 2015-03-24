<?php

require_once __DIR__ . '/ikdoeict/rest/response.php';

$response = new Ikdoeict\Rest\Response();

$response->setStatus(200);
$response->setContent(array(
	'firstname' => 'Bramus',
	'lastname'=> 'Van Damme'
));

// Be sure to call finish!
$response->finish();