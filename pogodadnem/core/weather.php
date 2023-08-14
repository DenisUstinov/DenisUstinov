
<?php
	error_reporting(0);
	require_once 'core/color.php';
	require_once 'core/functions_weather.php';
	require_once 'core/templates.php';

	$time_of_day = array('Утром', 'Днем', 'Вечером', 'Ночью');
	$TMPL['hosts'] = HOSTS;
	$TMPL['city_id'] = $city_id;
	$TMPL['client_ip'] = $client_ip;
	$TMPL['color_background'] = $color_background;
	$TMPL['color_text'] = $color_text;
	$TMPL['colorChange'] = colorChange($color_text);// Фоны

	/*
	* Загрузчик xml файла погоды для города
	* с проверкой времени последней загрузки
	* передаем идентификатор города
	*/
	/*$cache_lifetime = 3600;
	$cache_file = 'cache/weather_'.$city_id.'.xml';
	if(file_exists($cache_file)){
		$cache_modified = time() - @filemtime($cache_file);
		if($cache_modified > $cache_lifetime) 
		loadxmlyandex($city_id);
	}else{
		loadxmlyandex($city_id);
	}
	$data = simplexml_load_file($cache_file);
	//print_r($data);*/
	$url = 'http://mv4ha33soq.pfqw4zdfpaxhe5i.cmle.ru/weather-ng/forecasts/'.$city_id.'.xml';
	if(@fopen($url, "r"))
	{
		$cache_file = 'cache/weather_'.$city_id.'.xml';
		if(!file_exists($cache_file) && file_exists($cache_file) || filemtime($cache_file) < time()-3600)
		{
			loadxmlyandex($city_id);
		}
	}

	$data = simplexml_load_file($cache_file);
	/**************************************************/

	$details_all = '';
	$prev = '';
	for($i = 0; $i < 10; $i++){
		$TMPL['id'] = 'id_'.$i;// Айди для модальных окон
		$day_part = $data->day[$i]->{'day_part'}; // Зашли в обьект
		$TMPL['prev_date'] = getDayDate($data->day[$i]->attributes()->date);
		$TMPL['prev_image'] = str_replace('+', '--', $day_part[1]->{'image-v3'});
		$TMPL['prev_temperature_from'] = getTempSign($day_part[4]->{'temperature-data'}->avg);
		$TMPL['prev_temperature_to'] = getTempSign($day_part[5]->{'temperature-data'}->avg);
		$TMPL['prev_weather_type'] = $day_part[1]->{'weather_type'};
		if($i == 0){
			$TMPL['active'] = 'active';
			$TMPL['display_none'] = 'style="display:block;"';
		}else{
			$TMPL['active'] = 'no_active';
			$TMPL['display_none'] = 'style="display:none;"';
		}
		$details = '';//Обязательно для обнуления
		for($ii = 0; $ii < 4; $ii++){
			$TMPL['time_of_day'] = $time_of_day[$ii];
			$TMPL['temperature_from'] = getTempSign($day_part[$ii]->{'temperature_from'},$day_part[$ii]->{'temperature'});
			$TMPL['temperature_to'] = getTempSign($day_part[$ii]->{'temperature_to'},$day_part[$ii]->{'temperature'});
			$TMPL['image'] = str_replace('+', '--', $day_part[$ii]->{'image-v3'});
			$TMPL['weather_type'] = $day_part[$ii]->{'weather_type'};
			$TMPL['wind_direction'] = getWindDirection($day_part[$ii]->{'wind_direction'});
			$TMPL['wind_speed'] = $day_part[$ii]->{'wind_speed'};
			$TMPL['humidity'] = $day_part[$ii]->{'humidity'};
			$TMPL['pressure'] = $day_part[$ii]->{'pressure'};
			$TMPL['mslp_pressure'] = $day_part[$ii]->{'mslp_pressure'};

			$skin = new skin('details');
			$details .= $skin->make();
		}
		$TMPL['details'] = $details;
		$TMPL['date'] = getDayDateFull($data->day[$i]->attributes()->date);
		$TMPL['sunrise'] = $data->day[$i]->{'sunrise'};
		$TMPL['sunset'] = $data->day[$i]->{'sunset'};
		$TMPL['moonrise'] = $data->day[$i]->{'moonrise'};
		$TMPL['moonset'] = $data->day[$i]->{'moonset'};
		$TMPL['moon_phase'] = $moon_phase = $data->day[$i]->{'moon_phase'}; //тип луны

		$skin = new skin('details_all');
		$details_all .= $skin->make();

		$skin = new skin('prev');
		$prev .= $skin->make();
	}
	$TMPL['city'] = $data->attributes()->city; // Текущий город
	$TMPL['part'] = $data->attributes()->part; // Текущий регион
	$TMPL['country'] = $data->attributes()->country; // Текущий страна
	$TMPL['fact_date'] = getDayDateFull($data->fact->{'uptime'}); // Текущий дата
	$TMPL['fact_temperature'] = $data->fact->{'temperature'}; // Текущий температура
	$TMPL['fact_image'] = str_replace('+', '--', $data->fact->{'image-v3'}); // Текущий картинка погоды

	$TMPL['fact_weather_type'] = $data->fact->{'weather_type'}; // Текущий тип погоды
	$TMPL['fact_wind_direction'] = getWindDirection($data->fact->{'wind_direction'}); // Текущий направление ветра
	$TMPL['fact_wind_speed'] = $data->fact->{'wind_speed'}; // Текущий скорость ветра
	$TMPL['fact_humidity'] = $data->fact->{'humidity'}; // Текущий влажность
	$TMPL['fact_pressure'] = $data->fact->{'pressure'}; // Текущий давление
	$TMPL['fact_mslp_pressure'] = $data->fact->{'mslp_pressure'}; // Текущий давление у моря
	$TMPL['prev'] = $prev; // Шаблон превью
	$TMPL['details_all'] = $details_all; // Шаблон детальной погоды
	$array_city = '';
	require_once DIRECTORI.'/core/ar_select_city.php';
	foreach($ar_select_city as $key_cities => $value_cities){
		$array_city .= '<option value="'.$value_cities.'">' .$key_cities. '</option>';
	}
	$TMPL['array_city'] = $array_city;

	$skin = new skin('index');
	$cache_time = 900;
	$cache_file_site = DIRECTORI.'/cache/site_'.$city_id.'.html';
	if(file_exists($cache_file_site) && time() - @filemtime($cache_file_site) < $cache_time){
		readfile($cache_file_site);
		exit();
	}else{
		ob_start();
	}

	echo $skin->make();

    $buffer = ob_get_contents();
	ob_end_flush(); 
	$fp = fopen($cache_file_site, 'w'); 
	fwrite($fp, $buffer); 
	fclose($fp);
?>