
<?php
	require_once 'functions.php';

	$city_id = 36034;
	$cache_lifetime = 7200;
	$cache_file = 'weather_'.$city_id.'.xml';

	if(file_exists($cache_file)){
		$cache_modified = time() - @filemtime($cache_file);
		if( $cache_modified > $cache_lifetime ) 
		loadxmlyandex($city_id);
	}else{
		loadxmlyandex($city_id);
	}

	$data = simplexml_load_file($cache_file);
	/* Общие */
	$fact_city = $data->attributes()->city; // Город
	$fact_part = $data->attributes()->part; // Край
	$fact_country = $data->attributes()->country; // Страна
	/* Сейчас */
	$fact_data = $data->fact->{'uptime'};
	$fact_data_full = getDayDateFull($fact_data);
	$fact_image = $data->fact->{'image-v3'}; // Картинка погоды
	$fact_weather_type = $data->fact->{'weather_type'}; // Слова погоды
	$fact_wind_speed = $data->fact->{'wind_speed'}; // Ветер скорость
	$fact_wind_direction = $data->fact->{'wind_direction'}; // Ветер направление
	$fact_wind_direction = getWindDirection($fact_wind_direction); // Ветер направление
	$fact_humidity = $data->fact->{'humidity'}; // Влажность
	$fact_pressure = $data->fact->{'pressure'}; // давление
	$fact_mslp_pressure = $data->fact->{'mslp_pressure'}; //Среднее давление на уровне моря
	$fact_temperature = $data->fact->{'temperature'}; //Температура

	/*По дням*/
	//$sunrise = $data->day[0]->{'sunrise'}; //Восход солнце
	//$sunset = $data->day[0]->{'sunset'}; //Заход солнце
	//$moon_phase = $data->day[0]->{'moon_phase'}; //тип луны
	//$moonrise = $data->day[0]->{'moonrise'}; //восход луна
	//$moonset = $data->day[0]->{'moonset'}; //восход луна
	
	/* Дата дня */
	//$prev_data = $data->day[$i]->attributes()->date;
	//$prev_data = getDayDate($prev_data);
	/* Температура днем для вывода превью дня */
	//$day_part = $data->day[$i]->{'day_part'}; // Зашли в обьект
	//$temperature_from = $day_part[4]->{'temperature-data'}->avg; // Получили дневную температуру как среднию дня
	//$temperature_from = getTempSign($temperature_from); // Прогнали через функцию знака температуры
	//$temperature_to = $day_part[5]->{'temperature-data'}->avg; // Получили ночную температуру как среднию дня
	//$temperature_to = getTempSign($temperature_to); // Прогнали через функцию знака температуры
	/* Картинка дня дневная */
	//$prev_image = $day_part[1]->{'image-v3'};
	/* Небо дня дневная */
	//$prev_weather_type = $day_part[1]->{'weather_type'};

	//$day_part0 = $data->day[0]->{'day_part'}; // Зашли в обьект

	//$day_part3 = $data->day[3]->{'day_part'}; // Зашли в обьект
	$dss = array('Утром', 'Днем', 'Вечером', 'Ночью');
	//print_r($data);
	for($i = 0; $i < 10; $i++){
		/* Дата дня */
		$prev_data = $data->day[$i]->attributes()->date;
		$prev_data = getDayDate($prev_data);
		$prev_data_full = $data->day[$i]->attributes()->date;
		$prev_data_full = getDayDateFull($prev_data_full);
		/* Температура днем для вывода превью дня */
		$day_part = $data->day[$i]->{'day_part'}; // Зашли в обьект
		$temperature_from = $day_part[4]->{'temperature-data'}->avg; // Получили дневную температуру как среднию дня
		$temperature_from = getTempSign($temperature_from); // Прогнали через функцию знака температуры
		$temperature_to = $day_part[5]->{'temperature-data'}->avg; // Получили ночную температуру как среднию дня
		$temperature_to = getTempSign($temperature_to); // Прогнали через функцию знака температуры
		/* Картинка дня дневная */
		$prev_image = $day_part[1]->{'image-v3'};
		/* Небо дня дневная */
		$prev_weather_type = $day_part[1]->{'weather_type'};
		if($i == 0){
			$active = 'active';
			$none = 'style="display:block;"';
		}else{
			$active = '';
			$none = 'style="display:none;"';
		}
		$prev .= '
			<a class="day '.$active.'">
				<div style="padding-bottom:5px;font-size:0.95em;font-weight:400;">'.$prev_data.'</div>
				<div style="padding-bottom:0px;"><img src="images/'.$prev_image.'.png" width="30px" height="30px"></div>
				<div style="padding-bottom:0px;font-size:1.5em;font-weight:400;">'.$temperature_from.'° <span style="font-size:0.5em;color:rgba(255,255,255,0.5)"> '.$temperature_to.'°</span></div>
				<div style="font-size:0.7em;">'.$prev_weather_type.'</div>
			</a>
		';
		$details .= '
			<div id="details" '.$none.'>
				<div style="font-size:1.0em;font-weight:400; padding:10px 0;border-top:1px solid rgba(255,255,255,0.3);">Подробный прогноз на '.$prev_data_full.'</div>
				';
			for($ii = 0; $ii < 4; $ii++){
				$details_dss = $dss[$ii]; // Время дня
				$details_temperature_from = $day_part[$ii]->{'temperature_from'};
				$details_temperature_from = getTempSign($details_temperature_from);
				$details_temperature_to = $day_part[$ii]->{'temperature_to'};
				$details_temperature_to = getTempSign($details_temperature_to);
				$details_image = $day_part[$ii]->{'image-v3'}; // Картинка погоды
				$details_weather_type = $day_part[$ii]->{'weather_type'}; // Слова погоды
				$details_wind_speed = $day_part[$ii]->{'wind_speed'}; // Ветер скорость
				$details_wind_direction = $day_part[$ii]->{'wind_direction'}; // Ветер направление
				$details_wind_direction = getWindDirection($details_wind_direction); // Ветер направление
				$details_humidity = $day_part[$ii]->{'humidity'}; // Влажность
				$details_pressure = $day_part[$ii]->{'pressure'}; // давление
				$details_mslp_pressure = $day_part[$ii]->{'mslp_pressure'}; //Среднее давление на уровне моря

				$details .= '
					<div class="float">
						<div style="font-weight:100;">'.$details_dss.'</div>
						<div style="font-size:3.0em">'.$details_temperature_from.'°...<span style="font-size:0.6em;color:rgba(255,255,255,0.5)"> '.$details_temperature_to.'°</span><span style="font-size:0.3em;">°C </span> <img src="images/'.$details_image.'.png"></div>
						<div style="font-size:0.7em;">'.$details_weather_type.'</div>
						<div style="font-size:0.7em;">Ветер '.$details_wind_direction.' '.$details_wind_speed.' м/с</div>
						<div style="font-size:0.7em;">Относительная влажность '.$details_humidity.' % </div>
						<div style="font-size:0.7em;">Атмосферное давление '.$details_pressure.' мм.рт.ст.</div>
						<div style="font-size:0.7em;">Среднее давление на уровне моря '.$details_mslp_pressure.' мм.рт.ст.</div>
					</div>
				';
			}
			$sunrise = $data->day[$i]->{'sunrise'}; //Восход солнце
			$sunset = $data->day[$i]->{'sunset'}; //Заход солнце
			$moon_phase = $data->day[$i]->{'moon_phase'}; //тип луны
			$moonrise = $data->day[$i]->{'moonrise'}; //восход луна
			$moonset = $data->day[$i]->{'moonset'}; //восход луна
			$details .= '
					<div style="clear:left"></div>
					<div style="padding-top:10px;font-size:0.9em;">Солнце: '.$sunrise.' / '.$sunset.', Луна: '.$moonrise.' / '.$moonset.'</div>
				</div>
			';
	}
?>
<body>
	<section id="weather">
		<div id="today">
			<div style="font-size:1.7em;"><?=$fact_city?>, <?=$fact_part?>, <?=$fact_country?></div>
			<div style="font-weight:200;"><?=$fact_data_full ?> года</div>
			<div style="font-size:5.0em"><?=$fact_temperature?><span style="font-size:0.3em;">°C </span> <img src="images/<?=$fact_image?>.png"></div>
			<div style="font-size:1.4em;"><?=$fact_weather_type?></div>
			<div style="font-size:0.7em;">Ветер <?=$fact_wind_direction?> <?=$fact_wind_speed?> м/с, Относительная влажность <?=$fact_humidity?> %</div>
			<div style="font-size:0.7em;">Атмосферное давление <?=$fact_pressure?> мм, Среднее давление на уровне моря <?=$fact_mslp_pressure?> мм</div>
		</div>
		<div class="day-group">
			<?=$prev?>
			<div style="clear:left"></div>
		</div>
		<?=$details?>
		<div style="text-align:center;padding-top:10px;margin-top:10px;border-top:1px solid rgba(255,255,255,0.3);">Яндекс погода © Rubtcovsk.ru</div>
	</section>
</body>
<meta charset="utf-8">
<style>
	@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,300,100&subset=cyrillic-ext,latin);
	body{
		margin:0;
		padding:0;
		background: url(cielo02.jpg) no-repeat center center fixed; 
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		font-family:Open Sans;
		font-weight:100;
		text-align:left;
		color:#fff;
	}
	#weather{
		width:90%;
		margin:20px auto;

	}
	.day-group{
		width:100%;
		padding:40px 0 25px;
		margin:0 auto;
	}
	.day{
		float:left;
		width:110px;
		height:140px;
		padding:10px 0 0 10px;
		text-align:center;
	}
	.active{
		position:relative;
		/*border:2px solid #b2cfff;*/
		background:rgba(255,255,255,0.3);
	}
	.active::before, .active::after {
		content: ''; 
		position: absolute;
		left: 47px; bottom: -30px;
		border: 15px solid transparent;
		/*border-top: 15px solid #b2cfff;*/
	}
	.active::after {
		border-top: 15px solid rgba(255,255,255,0.3);
		bottom: -30px; 
	}
	.details{
	}
	.float{
		float:left;
		width:22.3%;
		border-right: 1px solid rgba(255,255,255,0.3);
		background:rgba(255,255,255,0.3);
		padding:15px;
	}
</style>