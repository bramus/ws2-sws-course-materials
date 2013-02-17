<?php

$item = $db->fetchArray('SELECT * FROM users WHERE id = ?', array(1));

dump($item);