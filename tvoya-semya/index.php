<?php
error_reporting(0);

$data = date('Y')+date('d')+date('m');
$query = rtrim($_SERVER['QUERY_STRING'], '/');

define('DIRECTORY', __DIR__);
define('CORE', __DIR__ . '/core');
define('DOMAIN', $_SERVER['HTTP_HOST']);
define('HOST', 'https://'.$_SERVER['HTTP_HOST']);
define('ADMIN_DIRECTORY', 'panel/'.$data);

require_once DIRECTORY.'/libs/functions.lib.php';
require_once DIRECTORY.'/libs/templates.lib.php';
require_once CORE.'/models/model.php';
$db = new SafeMySQL(require_once DIRECTORY.'/config/db.php');


/**
 * роутер проверяет наличие вхождения
 * подключает соответствующий контроллер
 * @param array
 * @return void
 */
$action = 'Error';
$controller = 'Article';
foreach(require_once DIRECTORY.'/config/routes.php' as $pattern => $route)
{
	if(preg_match("#$pattern#i", $query, $matches))
	{
		if (!isset($matches['current_page'])) $matches['current_page'] = 1;
		if (isset($route['action'])) $action = $route['action'];
		$controller = $route['controller'];
		break;
	}
}
require_once CORE.'/controllers/'.$controller.'Controller.php';
