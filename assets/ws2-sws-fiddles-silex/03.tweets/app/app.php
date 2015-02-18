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

// Home
$app->get('/', function(Silex\Application $app) {

	// Redirect to Tweets overview
	return $app->redirect($app['request']->getBaseUrl() . '/tweets');

});

// Tweets overview
$app->get('/tweets/', function(Silex\Application $app) use ($tweets) {

	// Loop all tweets and output them in a list
	$output = '<ul>';
	foreach ($tweets as $tweet) {
		$output .= '<li><a href="' . $app['request']->getBaseUrl(). '/tweets/' . $app->escape($tweet['id']) . '">&para;</a> ' . $app->escape($tweet['text']) . '<br />&mdash; by ' . $app->escape($tweet['author'])  .' <i>' . $app->escape($tweet['created_at']) . '</i></li>';
	}
	$output .= '</ul>';
	return $output;

});

// Tweet detail
$app->get('/tweets/{id}/', function (Silex\Application $app, $id) use ($tweets) {

	// Make sure the given tweet id exists
	if (!in_array($id, array_column($tweets, 'id'))) {
		$app->abort(404, "Tweet $id does not exist");
	}

	// Extract the tweet by filtering the tweets array based on the value of the id key
	$tweet = array_pop(array_filter($tweets, function($tweet) use ($id) { return $tweet['id'] == $id; }));

	// Build and return the HTML representing the tweet
	return  '<p>On ' . $tweet['created_at'] . ' ' . $app->escape($tweet['author']) . ' tweeted:</p><blockquote>' . $app->escape($tweet['text']) . '</blockquote><p><a href="' . $app['request']->getBaseUrl(). '/tweets">&larr; Back to overview</a></p>';

})->assert('id', '\d+');

// EOF