<?
/**
 * Контроллер вывода списка записей в карте сайта
 */
require_once CORE.'/models/Model.php';
$db = new Model(require_once DIRECTORY.'/config/db.php', require_once DIRECTORY.'/config/key.php');

$data = array();
$data = $db->$action($matches);
	
if (!require_once CORE.'/views/sitemapView.php') return false;