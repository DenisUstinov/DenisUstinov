<?php

require_once CORE.'/models/Model.php';
$db = new Model(require_once DIRECTORY.'/config/db.php');

$file_data = array();
$file_data = $db->$action($matches['file']);

if (!require_once CORE.'/views/'.$action.'View.php') return false;