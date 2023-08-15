<?php

error_reporting(E_ALL);

define('DIRECTORY', __DIR__);
define('CORE', __DIR__ . '/core');
define('DOMAIN', $_SERVER['HTTP_HOST']);
define('HOST', 'http://'.$_SERVER['HTTP_HOST']);

$TMPL['HOST'] = HOST;
$TMPL['DOMAIN'] = DOMAIN;
//$TMPL['DOMAIN'] = idn_to_utf8(DOMAIN);

require_once DIRECTORY.'/config/config.php';
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
$query = rtrim($_SERVER['QUERY_STRING'], '/');

$controller = 'Main';

foreach(require_once DIRECTORY.'/config/routes.php' as $pattern => $route)
{
	if(preg_match("#$pattern#i", $query, $matches))
	{
		$controller = $route['controller'];
		break;
	}
}

require_once CORE.'/controllers/'.$controller.'Controller.php';