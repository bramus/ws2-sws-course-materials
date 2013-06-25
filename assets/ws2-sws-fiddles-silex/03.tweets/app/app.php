<?php

// Bootstrap
require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';

// Dummy Data
require __DIR__ . DIRECTORY_SEPARATOR . 'data.php';

$app->error(function (\Exception $e, $code) {
	if ($code == 404) {
		return '404 - Not Found! // ' . $e->getMessage();
	} else {
		return 'Shenanigans! Something went horribly wrong // ' . $e->getMessage();
	}
});

$app->get('/', function(Silex\Application $app) {
	return $app->redirect($app['request']->getBaseUrl() . '/tweets');
});

$app->get('/tweets', function(Silex\Application $app) use ($tweets) {
	$output = '<ul>';
	foreach ($tweets as $id => $tweet) {
		$output .= '<li><a href="' . $app['request']->getBaseUrl(). '/tweets/' . $app->escape($id) . '">&para;</a> ' . $app->escape($tweet['text']) . '<br />&mdash; by ' . $app->escape($tweet['author'])  .' <i>' . $app->escape($tweet['created_at']) . '</i></li>';
	}
	$output .= '</ul>';
	return $output;
});

$app->get('/tweets/{id}', function (Silex\Application $app, $id) use ($tweets) {
	if (!isset($tweets[$id])) {
		$app->abort(404, "Tweet $id does not exist");
	}
	$tweet = $tweets[$id];
	return  '<p>On ' . $tweet['created_at'] . ' ' . $app->escape($tweet['author']) . ' tweeted:</p><blockquote>' . $app->escape($tweet['text']) . '</blockquote><p><a href="' . $app['request']->getBaseUrl(). '/tweets">&larr; Back to overview</a></p>';
})->assert('id', '\d+');