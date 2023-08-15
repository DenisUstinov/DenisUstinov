<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchString'])) {
	$searchString = trim(preg_replace('/[\s]+/', ' ', $_POST['searchString']));
	$searchString = str_replace(' ', '+', urldecode($searchString));
	header('Location: '.HOST.'/search/'.$searchString);
	exit;
}

require_once CORE.'/models/Model.php';
$db = new Model(require_once DIRECTORY.'/config/db.php', require_once DIRECTORY.'/config/key.php');

$json = array();
$json = $db->$action($matches);

// Подключение плагинов
$data = array();
$data = $db->addVideo($add_video);

if (!require_once CORE.'/views/mainView.php') return false;