<?php

$settings = $db->getRow('SELECT * FROM settings WHERE id=1');
require_once CORE.'/controllers/'.$action.'Action.php';