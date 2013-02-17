<?php

$value = $db->fetchColumn('SELECT username FROM users WHERE id = ?', array(1));

dump($value);