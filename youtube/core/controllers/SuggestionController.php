<?
/**
 * Контроллер вывода списка записей в карте сайта
 */
require_once CORE.'/models/Model.php';
$db = new Model(require_once DIRECTORY.'/config/db.php');

$json = array();
$json = $db->suggestion($matches['alias']);

if (!require_once CORE.'/views/suggestionView.php') return false;