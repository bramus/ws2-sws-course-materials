<?php

// Connect to the database
$config = new \Doctrine\DBAL\Configuration();
$connectionParams = array(
	'dbname' => 'todo',
	'user' => 'root',
	'password' => 'Azerty123',
	'host' => 'localhost',
	'driver' => 'pdo_mysql',
	'charset' => 'utf8mb4'
);
$db = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);