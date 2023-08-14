<?
	function getGeo($ip){
		if(!filter_var($ip, FILTER_VALIDATE_IP, array('flags' => FILTER_FLAG_IPV4)))
		return FALSE;
		$get = file_get_contents("http://ipgeobase.ru:7020/geo?ip={$ip}");
		$xml = simplexml_load_string($get);
		$city_name = isset($xml->ip->city) ? strtolower($xml->ip->city) : '';
		return $city_name;
	}
	function colorChange($color_icon)
	{
		list($red, $green, $blue) = array(
			$color_icon{0}.$color_icon{1},
			$color_icon{2}.$color_icon{3},
			$color_icon{4}.$color_icon{5}
		);
		$red = hexdec($red); 
		$green = hexdec($green);
		$blue = hexdec($blue);
		return $colorRGB = $red.', '.$green.', '.$blue;
	}
?>