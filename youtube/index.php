<?php

// Вывод ошибок
error_reporting(E_ALL);

// Константы
define('DIRECTORY', __DIR__);
define('CORE', __DIR__ . '/core');
define('DOMAIN', $_SERVER['HTTP_HOST']);
define('HOST', 'http://'.$_SERVER['HTTP_HOST']);
define('URL', HOST.'/'.rtrim($_SERVER['QUERY_STRING'], '/'));

// Настройки сайта
require_once DIRECTORY.'/config/settings.php';

// Библиотеки
require_once DIRECTORY.'/libs/functions.lib.php';
require_once DIRECTORY.'/libs/templates.lib.php';
require_once DIRECTORY.'/libs/compress.lib.php';

// Роутер
$action = 'index';
foreach(require_once DIRECTORY.'/config/routes.php' as $pattern => $route){
	if(preg_match("#$pattern#i", rtrim($_SERVER['QUERY_STRING'], '/'), $matches)){
		if(isset($route['action'])) $action = $route['action'];
		$controller = $route['controller'];
		break;
	}
}

if(!isset($controller) || !require_once CORE.'/controllers/'.$controller.'Controller.php')
	require_once CORE.'/controllers/ErrorController.php';