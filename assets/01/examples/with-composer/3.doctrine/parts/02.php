<?php

$stmt = $db->executeQuery('SELECT * FROM users WHERE id = ? or username = ?', array(1, 'rogier'));
$items = $stmt->fetchAll();

dump($items);