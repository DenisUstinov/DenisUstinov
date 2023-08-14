<?php
	// Получаем сокращенную дату
	function getDayDate($date)
	{
		$date = strtotime($date);
		$days = array('Вос','Пон', 'Вто', 'Сре', 'Чет', 'Пят', 'Суб');
		return $days[date('w', $date)].', '.(int)date('d',$date);
	}

	// Получаем полную дату
	function getDayDateFull($date)
	{
		$date = strtotime($date);
		$months = array('','января','февраля','марта','апреля','мая','июня','июля','августа','сентября','октября','ноября','декабря');
		$days = array('Воскресенье','Понедельник', 'Вторник', 'Среда', 'Четверг', 'Пятница', 'Суббота');
		return $days[date('w', $date)].', '.(int)date('d',$date).' '.$months[date('n', $date)].' '.(int)date('Y',$date);
	}

	// получаем знак температуры
	function getTempSign($temperature,$alternative = '')
	{
		if($temperature){
			$temp = $temperature;
		}else{
			$temp = $alternative;
		}
		$temp = (int)$temp;
		if($temp > 0){
			$temp = '+'.$temp;
		}else{
			$temp = $temp;
		};
		return $temp;
	}

	// получаем направления ветра
	function getWindDirection($wind = 'p')
	{
		$wind = (string)$wind;
		$wind_direction = array(
								'p'=>'переменный ;',
								'calm'=>'отсутствует ',
								's'=>'южный &#8593; ',
								'n'=>'северный &#8595; ',
								'w'=>'западный &#8594; ',
								'e'=>'восточный &#8592; ',
								'sw'=>'юго-западный &#8599; ',
								'se'=>'юго-восточный &#8598; ',
								'nw'=>'северо-западный &#8600; ',
								'ne'=>'северо-восточный &#8601; '
								);
		return $wind_direction[$wind];
	}

	// Загружаем файл яндекс погоды
	function loadxmlyandex($city_id)
	{
		//$url = 'http://export.yandex.ru/weather-ng/forecasts/'.$city_id.'.xml';
		$url = 'http://mv4ha33soq.pfqw4zdfpaxhe5i.cmle.ru/weather-ng/forecasts/'.$city_id.'.xml';
		$userAgent = 'Googlebot/2.1 (+http://www.google.com/bot.html)';
		$xml = 'cache/weather_'.$city_id.'.xml';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		$output = curl_exec($ch);
		$fh = fopen($xml, 'w');
		fwrite($fh, $output);
		fclose($fh);
	}

	// Загружаем файл яндекс города
	function loadxmlcity()
	{
		$url = 'https://pogoda.yandex.ru/static/cities.xml';
		$userAgent = 'Googlebot/2.1 (+http://www.google.com/bot.html)';
		$xml = 'cache/weather_city.xml';
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, $userAgent);
		$output = curl_exec($ch);
		$fh = fopen($xml, 'w');
		fwrite($fh, $output);
		fclose($fh);
	}