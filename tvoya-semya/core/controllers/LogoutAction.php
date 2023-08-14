<?php
session_start();

$_SESSION = array();
session_destroy();
setcookie(session_name(), '');

header('Location: '.HOST);
exit;
