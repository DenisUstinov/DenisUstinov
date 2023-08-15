	// Набор функций. Парсер субтитров
	/*function getPage($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/67.0.3396.99 Safari/537.36');
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		$page = curl_exec($ch);
		curl_close($ch);
		return $page;
	}

	function getCaptionsList($video_id) {
		$url = "https://www.youtube.com/watch?v=" . $video_id;
		$content = $this->getPage($url);
		preg_match_all('#<script(.*?)</script>#is', $content, $scripts);
		foreach($scripts[1] as $script){
			$script = trim($script,'> ');
			$find = FALSE;
			if(preg_match('/^var ytplayer/', $script)){
				$find = TRUE;
				break;
			}
		}
		if($find){
			$start_str = '"player_response":"';
			$end_str = ',\"adSafetyReason\":';
			$cap_start = strpos($script,$start_str)+ strlen($start_str);
			$cap_end = strpos($script,$end_str);
			$json = stripslashes('['.substr($script, $cap_start,$cap_end-$cap_start).'}]');
			$video_attrs = json_decode($json,TRUE)[0];
			if(isset($video_attrs['captions']['playerCaptionsTracklistRenderer']['captionTracks'])){
				return $video_attrs['captions']['playerCaptionsTracklistRenderer']['captionTracks'];
			}
		}
	}
	function getCaption($video_id){
		$captions = $this->getCaptionsList($video_id);
		if (count($captions)) {
			foreach($captions as $caption){
				if($caption['kind']=='asr'){
					break;
				}
			}
			$caption['baseUrl'] = urldecode($caption['baseUrl']);
			$uri = parse_url($caption['baseUrl']);
			$arr_qv = explode('&',$uri['query']);
			$uri['query'] = [];
			foreach ($arr_qv as $var){
				$var = explode('=',$var);
				$uri['query'][$var[0]]=$var[1];
			}
			if($uri['query']['lang']!='ru'){
				$langs = explode(',',$uri['query']['asr_langs']);
				if(in_array('ru', $langs)){
					$uri['query']['lang'] = 'ru';
				}else{
					$uri['query']['tlang'] = 'ru';
				}
			}
			$capUrl = $uri['scheme'].'://'.$uri['host'].$uri['path'].'?'.http_build_query($uri['query']);
			return file_get_contents($capUrl);
		}
		return '';
	}
	function captions($video_id){
		$str = $this->getCaption($video_id);
		$xml = simplexml_load_string($str);
		$result = '';
		$i = 1;
		if(is_object($xml)){
			foreach ($xml->text as $text){
				$text = str_replace("[смех]", '',strip_tags($text));
				$text = str_replace("[музыка]", '',strip_tags($text));
				$text = str_replace("[аплодисменты]", '',strip_tags($text));
				if ($i == 1) {
					$result .= '<p>'.mb_ucfirst($text).' ';
				} elseif ($i == 10) {
					$result .= $text.'.</p>';
					$i = 0;
				} else {
					$result .= $text.' ';
				}
				$i++;
			}
		} else {
			return '<p>Нет субтитров</p>';
		}
		return $result;
	}*/