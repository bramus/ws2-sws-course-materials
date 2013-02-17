<?php

$stmt = $db->executeQuery('SELECT * FROM users WHERE id = ?', array(1));
$item = $stmt->fetch();

dump($item);