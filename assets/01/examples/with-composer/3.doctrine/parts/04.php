<?php

$numAffected = $db->executeUpdate('UPDATE todolist SET what = REVERSE(what) WHERE id = ?', array(1));

dump($numAffected);