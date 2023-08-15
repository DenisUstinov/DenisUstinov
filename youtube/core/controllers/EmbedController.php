<?php

/**
 * Контроллер создания embed видео для встраивания
 */
require_once CORE.'/models/Model.php';
$db = new Model(require_once DIRECTORY.'/config/db.php');

$json = array();
$json = $db->embed($matches['alias']);

if (!require_once CORE.'/views/embedView.php') return false;