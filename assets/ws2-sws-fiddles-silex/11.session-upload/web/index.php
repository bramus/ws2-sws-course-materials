<?php

// Make it so that PHP 5.4's built-in server can server static files
// @see http://silex.sensiolabs.org/doc/web_servers.html#php-5-4
$filename = __DIR__ . preg_replace('#(\?.*)$#', '', $_SERVER['REQUEST_URI']);
if (php_sapi_name() === 'cli-server' && is_file($filename)) {
    return false;
}

// Require the app and run it
require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'app.php';

// Inject the current path onto the app
$app['photolog.base_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'files' . DIRECTORY_SEPARATOR . 'images';
$app['photolog.base_url'] = '/files/images';

$app->run();