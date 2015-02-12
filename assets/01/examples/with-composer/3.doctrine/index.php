<html>
<head>
	<title>Doctrine DBAL</title>
	<meta charset="utf-8">
	<style>
		div { padding-left: 1em; margin-left: 1em; border-left: 0.125em solid #666; }
		pre { border: 0.125em dotted #333; padding: 1em; width: 80%; overflow: scroll; }
		a { text-decoration: none; color: #0066FF; font-size: 70%; vertical-align: top; padding: 1em; margin: -1em; }
	</style>
</head>
<body><?php

// helper functions (quick and dirty)
function title($title, $level) {
	echo '<h' . $level . '>' . $title . '</h' . $level . '>' . PHP_EOL;
}
function text($text) {
	echo '<p>' . $text . '</p>';
}
function codeblock($db, $file, $require = true) {
	$file = __DIR__ . DIRECTORY_SEPARATOR . 'parts' . DIRECTORY_SEPARATOR . $file . '.php';
	echo '<div>';
	echo '<pre class="source"><code>' . htmlentities(file_get_contents($file)) . '</code></pre>';
	if ($require) require_once $file;
	echo '</div>';
}
function dump($var) {
	echo '<pre class="result">';
	var_dump($var);
	echo '</pre>';
}


// Require autoloader
require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

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

// Test connection
try {
	$db->connect();
} catch (\PDOException $e) {
	exit('Could not connect to database:<br /><code>' . $e->getMessage() . '</code>');
}


// The real deal
title('Doctrine DBAL<a href="http://www.doctrine-project.org/projects/dbal.html">&#9873;</a>', 1);

	title('Establishing a Database Connection<a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/configuration.html">&#9873;</a>', 2);

		codeblock(null, '00.connection', false);

		text('Note: Doctrine\'s DBAL also works with SQLite, PostgreSQL, Oracle, and MSSQL!<a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/configuration.html#driver">&#9873;</a>');

	title('Doctrine DBAL Basics', 2);

		title('<code>SELECT</code> with <code>$db->executeQuery()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#executequery">&#9873;</a>. Retrieve first row using <code>->fetch()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#using-prepared-statements">&#9873;</a>', 3);

			codeblock($db, '01');

			text('Yes, that is an array you can immediately use!');


		title('<code>SELECT</code> with <code>$db->executeQuery()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#executequery">&#9873;</a>. Retrieve all rows using <code>->fetchAll()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#using-prepared-statements">&#9873;</a>', 3);

			codeblock($db, '02');

			text('Yes, that is an array you can immediately use!');


		title('<code>SELECT</code> with <code>$db->executeQuery()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#executequery">&#9873;</a>. Retrieve a single column (from the first row) using <code>->fetchColumn()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#using-prepared-statements">&#9873;</a>', 3);

			codeblock($db, '03');

		title('<code>INSERT</code>, <code>UPDATE</code>, and <code>DELETE</code> with <code>$db->executeUpdate()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#executeupdate">&#9873;</a>. Returned value is the number of affected rows.', 3);

			codeblock($db, '04');

	title('Doctrine DBAL Shorthands', 2);

		title('Fetch immediately with <code>$db->fetchArray()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#fetcharray">&#9873;</a>, <code>$db->fetchAssoc()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#fetchassoc">&#9873;</a>, <code>$db->fetchAll()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#fetchall">&#9873;</a>, or <code>$db->fetchColumn()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#fetchcolumn">&#9873;</a>', 3);

			title('<code>$db->fetchArray()</code>', 4);
				codeblock($db, '05a');
			title('<code>$db->fetchAssoc()</code>', 4);
				codeblock($db, '05b');
			title('<code>$db->fetchAll()</code>', 4);
				codeblock($db, '05c');
			title('<code>$db->fetchColumn()</code>', 4);
				codeblock($db, '05d');

		title('Insert with <code>$db->insert()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#insert">&#9873;</a>', 3);
			codeblock($db, '06');
			text('Note: the returned result of <code>$db->insert()</code> is NOT the generated AUTO_INCREMENT id but the number of inserted rows! If you want to get that, call <code>$db->lastInsertId()</code>');

		title('Update with <code>$db->update()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#update">&#9873;</a>', 3);
			codeblock($db, '07');
			text('Note: the returned result of <code>$db->update()</code> is the number of affected rows. No need to get that manually afterwards.');

		title('Delete with <code>$db->delete()</code><a href="https://doctrine-dbal.readthedocs.org/en/latest/reference/data-retrieval-and-manipulation.html#delete">&#9873;</a>', 3);
			codeblock($db, '08');
			text('Note: the returned result of <code>$db->delete()</code> is the number of affected rows. No need to get that manually afterwards.');

// EOF