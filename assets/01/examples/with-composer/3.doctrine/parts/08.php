<?php

$result = $db->delete('users', array('username' => 'tester'));

dump($result);