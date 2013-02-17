<?php

$stmt = $db->executeQuery('SELECT username FROM users WHERE id = ?', array(1));
$value = $stmt->fetchColumn();

dump($value);