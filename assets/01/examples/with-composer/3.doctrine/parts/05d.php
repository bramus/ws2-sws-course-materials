<?php

$value = $db->fetchColumn('SELECT username FROM users WHERE id = ?', array(3));

dump($value);