<?php

$result = $db->insert('users', array(
	'username' => 'testuser',
	'password' => '548b443423c74becf92a5091bd63a80f058f38fc'
));

dump($db->lastInsertId());