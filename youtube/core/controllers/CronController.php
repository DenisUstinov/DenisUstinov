<?php
set_time_limit(500);
/**
 * Контроллер парсинга видео по cron
 */
require_once CORE.'/models/Model.php';
$db = new Model(require_once DIRECTORY.'/config/db.php', require_once DIRECTORY.'/config/key.php');

$json = array();
$json = $db->channel($matches);

foreach ($json['items'] as $item) {
	$db->insert($item['id']['videoId']);
}

sleep(5);
if (isset($json['nextPageToken'])) {
	header('Location: '.HOST.'/cron/'.$matches['alias'].'/'.$json['nextPageToken']);
	exit;
}