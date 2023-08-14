<?php
	error_reporting(E_ALL);
	require_once 'url.php';
	require_once DIRECTORI.'/core/functions.php';
	$client_ip = $_SERVER['REMOTE_ADDR'];
	$city_name = getGeo($client_ip); // Передаем айпи в функцию и возратит название города

	/* .Модуль обработки запросов */
	if(isset($_GET['city_id'])){

		$city_id = $_GET['city_id'];
		require_once DIRECTORI.'/core/ar_subdomen_city.php';
		$city_name = array_search($city_id, $ar_subdomen_city);

		if(isset($_GET['color_background'])){
			$color_background = $_GET['color_background'];
			setcookie('color_background', $color_background, time()+3600*24*30, '/', '.xn--80afdbf6bfdbh.xn--p1ai'); // Устанавливаем куки фона
		}

		if(isset($_GET['color_text'])){
			$color_text = $_GET['color_text'];
			$color_text = substr($color_text, 1);// Убрали решотку #
			setcookie('color_text', $color_text, time()+3600*24*30, '/', '.xn--80afdbf6bfdbh.xn--p1ai'); // Устанавливаем куки текста
		}

		setcookie('city_id', $city_id, time()+3600*24*30, '/', '.xn--80afdbf6bfdbh.xn--p1ai'); // Устанавливаем куки айди города
		header('Location: http://'.$city_name.'.xn--80afdbf6bfdbh.xn--p1ai');
		exit;

	}
	if(isset($_SERVER) && isset($_SERVER['SITY_NAME'])){

		$city_name = idn_to_utf8($_SERVER['SITY_NAME']);
		require_once DIRECTORI.'/core/ar_subdomen_city.php';
		if(isset($ar_subdomen_city[$city_name])){

			$city_id = $ar_subdomen_city[$city_name];
			setcookie('city_id', $city_id, time()+3600*24*30, '/', '.xn--80afdbf6bfdbh.xn--p1ai'); // Устанавливаем куки айди города

		}else{
			$city_id = 27612; // Москва
		}

	}elseif(isset($_COOKIE['city_id'])){
		$city_id = $_COOKIE['city_id'];

	}else{
		require_once DIRECTORI.'/core/ar_select_city.php';
		if(isset($ar_select_city[$city_name])){
			$city_id = $ar_select_city[$city_name];
		}else{
			$city_id = 27612; // Москва
		}
	}
	/* .Модуль обработки запросов */

	
	if(isset($_COOKIE['color_background'])){
		$color_background = $_COOKIE['color_background'];
	}else{
		$color_background = 'http://pcwallart.com/images/blue-color-gradient-wallpaper-2.jpg';
	}

	if(isset($_COOKIE['color_text'])){
		$color_text = $_COOKIE['color_text'];
	}else{
		$color_text = 'ffffff';
	}
	//echo $_SERVER['HTTP_HOST'];
	//print_r($_COOKIE);

	require_once DIRECTORI.'/core/weather.php';