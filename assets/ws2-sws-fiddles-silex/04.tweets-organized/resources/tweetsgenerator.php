<?php

	$url = 'http://search.twitter.com/search.json?q=ikdoeict&count=100';
	
	$connectionSession = curl_init();
	curl_setopt($connectionSession, CURLOPT_URL, $url);
	curl_setopt($connectionSession, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
	curl_setopt($connectionSession, CURLOPT_HTTPGET, 1);
	curl_setopt($connectionSession, CURLOPT_HEADER, false);
	curl_setopt($connectionSession, CURLOPT_HTTPHEADER, array('Accept: application/json'));
	curl_setopt($connectionSession, CURLOPT_RETURNTRANSFER, true);
	$response = curl_exec($connectionSession);
	curl_close($connectionSession);

	$tweets = json_decode($response, true);
	
	$toReturn = array();
	
	foreach ($tweets['results'] as $tweet) {
		$toReturn[$tweet['id']] = array(
			'text' => $tweet['text'],
			'created_at' => $tweet['created_at'],
			'author' => $tweet['from_user_name']
		);
	}
	
	echo 'Place the contents below in `app/data.php`: ' . PHP_EOL . PHP_EOL;
	echo '$tweets = ';
	var_export($toReturn);
	echo ';';
	exit();