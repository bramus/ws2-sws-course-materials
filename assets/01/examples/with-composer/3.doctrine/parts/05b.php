<?php

$item = $db->fetchAssoc('SELECT * FROM users WHERE id = ?', array(1));

dump($item);