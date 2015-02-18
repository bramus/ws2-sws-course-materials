<?php

$stmt = $db->executeQuery('SELECT username FROM users WHERE id = "' . $db->quote('1; DROP TABLE users; --') . '"');
$value = $stmt->fetchColumn();

dump($value);