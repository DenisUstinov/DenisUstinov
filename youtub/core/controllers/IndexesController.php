<?php

require_once CORE.'/models/Model.php';
$db = new Model(require_once DIRECTORY.'/config/db.php', require_once DIRECTORY.'/config/key.php');

$json = array();
$json = $db->indexes($queryString);

if (!require_once CORE.'/views/indexesView.php') return false;