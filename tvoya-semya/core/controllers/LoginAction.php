<?php
session_start();

if (isset($_POST['auth_name']))
{
	$row = $db->getRow('SELECT * FROM settings WHERE login_settings=?s', $_POST['auth_name']);
	if($row && password_verify($_POST['auth_pass'], $row['password_settings']))
	{
		$_SESSION['user_id'] = $row['id'];
	}
	header('Location: '.HOST);
	exit;
}
elseif (!isset($_SESSION['user_id']))
{
	$skin = new skin(DIRECTORY.'/templates/admin/login.html');
	echo $skin->make(); 
	exit;
}
else
{
	header('Location: '.HOST);
	exit;
}