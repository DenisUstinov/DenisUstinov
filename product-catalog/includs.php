<?php
	define('DIRECTORI', __DIR__); // Для путей PHP
	define('HOSTS','http://'.$_SERVER['HTTP_HOST']); // Для ссылок HTML

	/* Для папки модулей */
	define('DIRECTORI_MODULES', DIRECTORI.'/modules'); // Для путей PHP
	define('HOSTS_MODULES', HOSTS.'/modules'); // Для ссылок HTML


	require_once (DIRECTORI.'/functions/functions.php');
	require_once (DIRECTORI.'/classes/PHPExcel/PHPExcel.php');
	require_once (DIRECTORI.'/classes/PHPExcel/PHPExcel/IOFactory.php');
?>