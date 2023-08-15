<?php

require_once 'SafeMySQL.php';
require_once 'nokogiri.php';

class Model extends SafeMySQL
{
	public $apiKey = '';
	public $saw = '';

	function __construct ($dbConfig, $apiKey = false) {
		$this->apiKey = $apiKey;
		parent::__construct($dbConfig);
	}
	
	function imagefile($file) {
		return true;
	}
	
	function videofile ($file) {
		$array_insert['file'] = explode('.', $file);
		$array_insert['get_video_info'] = $this->getVideoInfo($array_insert['file'][0]);
		$array_insert['player_response'] = $this->playerResponse($array_insert['get_video_info']);
		$array_insert['itags_default'] = $this->itagsDefault(DIRECTORY.'/config/itags.json');
		return $array_insert;
	}
	
	function rowsmap ($matches) {
		return $this->getAll("SELECT videoId, title FROM videos LIMIT ?i, ?i", $matches['currentPage'] * 1000, 1000);
	}
	
	function sitemaps () {
		$data['rowsmaps'] = $this->getOne("SELECT COUNT(*) FROM videos");
		$data['tagsmaps'] = $this->tagsmaps();
		return $data;
	}
	
	function tagsmap ($matches) {
		$data = array();
		foreach (file(DIRECTORY.'/config/tagsmap/'.$matches['currentPage'].'.txt') as $queryString) {
			$queryString = str_replace(' ', '+', preg_replace('/[\s]{2,}/', ' ', trim($queryString)));
			$queryUrl = 'https://www.googleapis.com/youtube/v3/search?q='.$queryString.'&part=snippet&order=date&maxResults=50&type=video&videoEmbeddable=true&videoSyndicated=true&regionCode=RU&key=';
			foreach ($this->curlGet($queryUrl)['items'] as $item) {
				$data[] = $item;
			}
		}
		return $data;
	}
	
	function tagsmaps () {
		$scandir = scandir(DIRECTORY.'/config/tagsmap');
		unset($scandir[0],$scandir[1]);
		foreach($scandir as $file) {
			$file = pathinfo($file);
			$list[] = $file['filename'];
		}
		return $list;
	}
	
	function suggestion ($q) {
		$q = trim(preg_replace('/[\s]+/', ' ', $q));
		$q = str_replace(' ', '+', urldecode($q));
		$queryUrl = 'https://suggestqueries.google.com/complete/search?client=firefox&ds=yt&q='.$q;
		if($curl = curl_init()) {
			curl_setopt($curl, CURLOPT_URL, $queryUrl);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$json = curl_exec($curl);
			curl_close($curl);
			return $json;
		} else {
			return false;
		}
	}
	
	function addVideo ($videoId) {
		return $this->getRow("SELECT * FROM videos WHERE videoId=?s", $videoId);
	}
	
	function page ($matches = array()) {
		// Пока для совместимости
		return true;
	}
	function indexes ($queryString) {
		$queryUrl = 'https://www.googleapis.com/youtube/v3/search?q='.$queryString.'&part=snippet&order=date&maxResults=20&type=video&videoEmbeddable=true&videoSyndicated=true&regionCode=RU&key=';
		return $this->curlGet($queryUrl);
	}
	function index ($matches) {
		global $queryString;
		$queryUrl = 'https://www.googleapis.com/youtube/v3/search?q='.$queryString.'&part=snippet&order=date&maxResults=31&type=video&videoEmbeddable=true&videoSyndicated=true&regionCode=RU&key=';
		$json = $this->curlGet($queryUrl);
		$matches['alias'] = $queryString;
		if(isset($json['error'])) $json = $this->grabSearch($matches);
		return $json;
	}

	function search ($matches) {
		$queryUrl = 'https://www.googleapis.com/youtube/v3/search?q='.$this->queryString($matches).'&part=snippet&order=relevance&maxResults=19&type=video&videoEmbeddable=true&videoSyndicated=true&regionCode=RU&key=';
		$json = $this->curlGet($queryUrl);
		if(isset($json['error'])) $json = $this->grabSearch($matches);
		$json['queries'] = json_decode($this->suggestion($matches['alias']), true);
		return $json;
	}
	
	function video ($matches) {
		$queryUrl = 'https://www.googleapis.com/youtube/v3/search?q='.$this->queryString($matches).'&part=snippet&order=date&maxResults=19&type=video&videoEmbeddable=true&videoSyndicated=true&regionCode=RU&key=';
		$json = $this->curlGet($queryUrl);
		if(isset($json['error'])) $json = $this->grabSearch($matches);
		$json['queries'] = json_decode($this->suggestion($matches['alias']), true);
		return $json;
	}

	function channel ($matches) {
		$queryUrl = 'https://www.googleapis.com/youtube/v3/search?channelId='.$this->queryString($matches).'&part=snippet&order=date&maxResults=19&type=video&videoEmbeddable=true&videoSyndicated=true&regionCode=RU&key=';
		$json = $this->curlGet($queryUrl);
		if(isset($json['error'])) $json = $this->grabChannel($matches['alias']);
		return $json;
	}

	function related ($videoId) {
		$queryUrl = 'https://www.googleapis.com/youtube/v3/search?relatedToVideoId='.$videoId.'&part=snippet&order=relevance&maxResults=10&type=video&videoEmbeddable=true&videoSyndicated=true&regionCode=RU&key=';
		$related = $this->curlGet($queryUrl);
		if(isset($related['error'])) $related = $this->grabRelated($videoId);
		return $related;
	}

	function comments ($videoId) {
		$queryUrl = 'https://www.googleapis.com/youtube/v3/commentThreads?part=snippet,replies&videoId='.$videoId.'&key=';
		return $this->curlGet ($queryUrl);
	}
	
	function getVideoInfo ($videoId) {
		parse_str(file_get_contents('https://www.youtube.com/get_video_info?video_id='.$videoId.'&cpn=CouQulsSRICzWn5E&eurl&el=adunit'), $get_video_info);
		return $get_video_info;
	}
	
	function playerResponse ($get_video_info) {
		if (isset($get_video_info['player_response'])) {
			return json_decode($get_video_info['player_response'], true);
		}
		return false;
	}
	
	function captions ($player_response) {
		if (isset($player_response['captions']['playerCaptionsTracklistRenderer']['captionTracks'][0])) {
			return file_get_contents($player_response['captions']['playerCaptionsTracklistRenderer']['captionTracks'][0]['baseUrl']);
		}
		return false;
	}
	
	function itagsDefault ($file) {
		if (is_file($file)) {
			return  json_decode(file_get_contents($file), true);
		}
		return false;
	}
	
	function watchVideo ($videoId) {
		$queryUrl = 'https://www.googleapis.com/youtube/v3/videos?id='.$videoId.'&part=snippet%2Cstatistics%2CcontentDetails&key=';
		$watch = $this->curlGet($queryUrl);
		if(isset($watch['error'])) $watch = $this->grabWatch($videoId);
		return $watch;
	}
	
	function checkId ($videoId) {
		return $this->getRow('SELECT * FROM videos WHERE videoId = ?s', $videoId);
	}
	
	function insert ($videoId) {
		$array_insert = $this->checkId($videoId);
		if (!count($array_insert)) {
			$json = $this->watchVideo($videoId);
			if(isset($json['items']) && $json['items'] >= 0) {
				$array_insert['videoId'] = $videoId; // ID видео
				$array_insert['publishedAt'] = date("c", strtotime($json['items'][0]['snippet']['publishedAt']));
				$array_insert['channelId'] = $json['items'][0]['snippet']['channelId']; // ID канала
				$array_insert['channelTitle'] = $json['items'][0]['snippet']['channelTitle']; //  Название канала
				$array_insert['title'] = $json['items'][0]['snippet']['title']; // Заголовок
				$array_insert['description'] = $json['items'][0]['snippet']['description']; // Описание
				$array_insert['tag'] = 'приколы'; // тэг по которому парсилось
				
				if(isset($json['items'][0]['snippet']['tags'])) {
					$array_insert['tags'] = implode(',', $json['items'][0]['snippet']['tags']);
				} else {
					$array_insert['tags'] = $this->titleToTags($array_insert['title']);
				}
				
				$array_insert['categoryId'] = $json['items'][0]['snippet']['categoryId']; // ID категории видео
				$array_insert['duration'] = $json['items'][0]['contentDetails']['duration']; // Длина видео
				
				(isset($json['items'][0]['statistics']['viewCount']) && $json['items'][0]['statistics']['viewCount'] != 0) ? $array_insert['viewCount'] = $json['items'][0]['statistics']['viewCount'] : $array_insert['viewCount'] = 1; // Просмотры
				(isset($json['items'][0]['statistics']['likeCount']) && $json['items'][0]['statistics']['likeCount'] != 0) ? $array_insert['likeCount'] = $json['items'][0]['statistics']['likeCount'] : $array_insert['likeCount'] = 1; // Лайки
				(isset($json['items'][0]['statistics']['dislikeCount']) && $json['items'][0]['statistics']['dislikeCount'] != 0) ? $array_insert['dislikeCount'] = $json['items'][0]['statistics']['dislikeCount'] : $array_insert['dislikeCount'] = 1; // Дизлайки

				$this->query('INSERT INTO videos SET ?u', $array_insert);
			}
		}
		$array_insert['queries'] = json_decode($this->suggestion($array_insert['title']), true);
		return $array_insert;
	}
	
	function watch ($matches) {
		$array_insert = $this->insert($matches['alias']);
		$array_insert['comments'] = $this->comments($matches['alias']);
		$array_insert['related'] = $this->related($matches['alias']);
		
		$array_insert['get_video_info'] = $this->getVideoInfo($matches['alias']);
		$array_insert['player_response'] = $this->playerResponse($array_insert['get_video_info']);
		$array_insert['captions'] = $this->captions($array_insert['player_response']);
		$array_insert['itags_default'] = $this->itagsDefault(DIRECTORY.'/config/itags.json');
		return $array_insert;
	}
	
	function embed ($videoId) {
		$array_insert['get_video_info'] = $this->getVideoInfo($videoId);
		$array_insert['player_response'] = $this->playerResponse($array_insert['get_video_info']);
		$array_insert['itags_default'] = $this->itagsDefault(DIRECTORY.'/config/itags.json');
		return $array_insert;
	}
	
	function queryString ($matches) {
		return isset($matches['pageToken']) ? $matches['alias'].'&pageToken='.$matches['pageToken'] : $matches['alias'];
	}
	
	// Разбирает тайтл видео на теги
	function titleToTags($title) {
		$title = mb_strtolower($title);
		$title = preg_replace("/[^\w ]/ui", " ", $title);
		$title = preg_replace("/[\s]{2,}/", " ", $title);
		$title = explode(' ', $title);
		foreach ($title as $tag) {
			if (mb_strlen($tag, 'UTF-8') > 3) {
				$tags_array[] = $tag;
			}
		}
		return isset($tags_array) ? implode(',', array_unique($tags_array)) : 'видео';
	}

	function curlGet($queryUrl) {
		if($curl = curl_init()) {
			curl_setopt($curl, CURLOPT_URL, $queryUrl.$this->apiKey);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$json = json_decode(curl_exec($curl), true);
			
			// При возникновении ошибок инициализируем проверку ключа
			/*if (array_key_exists('error', $json)) {
				$curlinfo_http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				if ($curlinfo_http_code == $json['error']['code'] && $curlinfo_http_code == 400 || $curlinfo_http_code == 403) {
					$this->curlGetStatusKey($curlinfo_http_code);
				}
			}*/
			
			curl_close($curl);
			return $json;
		} else {
			return false;
		}
	}
	function grabGet($queryUrl) {
		$setUA = 'Opera/9.80 (BlackBerry; Opera Mini/4.5.33868/37.8993; HD; en_US) Presto/2.12.423 Version/12.16';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $queryUrl);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_REFERER, $queryUrl);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
		curl_setopt($ch, CURLOPT_USERAGENT, $setUA);
		$ret = curl_exec($ch);
		curl_close($ch);
		return $ret;
	}
	/*function curlGetStatusKey($http_code) {
		if($curl = curl_init()) {
			curl_setopt($curl, CURLOPT_URL, 'https://www.googleapis.com/youtube/v3/search?q=рубцовск&part=snippet&maxResults=0&key='.$this->apiKey);
			curl_setopt($curl, CURLOPT_HEADER, false);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			$json = json_decode(curl_exec($curl), true);
			
			// Если код ошибки повторился инициализируем запрос к базе ключей
			if (array_key_exists('error', $json)) {
				$curlinfo_http_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
				if ($http_code == $curlinfo_http_code && $curlinfo_http_code == $json['error']['code']) {
					$this->curlPost($http_code, $json['error']['message']);
				}
			}
			curl_close($curl);
		} else {
			return false;
		}
	}
	
	function curlPost($http_code, $error_message) {
		$send = false;
		global $keys_base;
		global $login;
		global $password;
		if($curl = curl_init()){
			curl_setopt($curl, CURLOPT_URL, $keys_base);
			curl_setopt($curl, CURLOPT_HEADER, 0);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS,
				array(
					'message_keys' => $error_message,
					'number_keys' => $this->apiKey,
					'httpcode_keys' => $http_code,
					'domain_keys' => DOMAIN,//не обновляет колонки домена и айпи надо смотреть
					'login' => $login,
					'password' => $password
				)
			);
			$json = json_decode(curl_exec($curl), true);
			curl_close($curl);
			
			if (isset($json['number_keys'])) {
				file_put_contents(DIRECTORY.'/config/key.php', '<?php return \''.$json['number_keys'].'\';', LOCK_EX);
				header('Location: '.URL);
				exit;
			}
		}
	}*/
	function grabWatch($videoId) {
		$data = $this->grabGet('https://m.youtube.com/watch?v='.$videoId.'&fulldescription=1&gl=RU&client=mv-google&hl=ru');
		$data = str_replace(" yt-uix-sessionlink      spf-link ", "channel-link", $data);
		$this->saw = new nokogiri($data);
		$data = $this->saw->get('div[style="font-size:13px"]')->toArray();
		
		$array_insert['items'][0]['snippet']['publishedAt'] = publishedAt(trim(str_replace("Опубликовано: ", '', $data[0]['div'][0]['div'][3]['#text'][0])));
		$array_insert['items'][0]['snippet']['channelId'] = str_replace("/channel/", '', $data[0]['div'][0]['div'][2]['a'][0]['href']);
		$array_insert['items'][0]['snippet']['channelTitle'] = $data[0]['div'][0]['div'][2]['a'][0]['#text'][0];
		$array_insert['items'][0]['snippet']['title'] = preg_replace('/- YouTube$/', '', $this->saw->get('title')->toText());
		
		$description = $this->saw->get('div[align="left"]')->toArray()[0]['#text'];
		
		$array_insert['items'][0]['snippet']['description'] = '';
		foreach ($description as $row) {
			$array_insert['items'][0]['snippet']['description'].= $row."\n";
		}
		
		$array_insert['items'][0]['snippet']['categoryId'] = '';
		$array_insert['items'][0]['contentDetails']['duration'] = duration(trim(preg_replace("/[^0-9:]/", '', $data[0]['div'][0]['div'][0]['#text'][0]), ":"));
		
		$array_insert['items'][0]['statistics']['viewCount'] = preg_replace("/[^0-9]/", '', trim($data[0]['div'][0]['div'][1]['#text'][0]));
		$array_insert['items'][0]['statistics']['likeCount'] = $data[0]['div'][0]['div'][0]['span'][0]['#text'][0];
		$array_insert['items'][0]['statistics']['dislikeCount'] = $data[0]['div'][0]['div'][0]['span'][1]['#text'][0];
		
		return $array_insert;
	}
	
	function grabRelated($videoId) {
		if(!is_object($this->saw)) {
			$data = $this->grabGet('https://m.youtube.com/watch?v='.$videoId.'&fulldescription=1&gl=RU&client=mv-google&hl=ru');
			$this->saw = new nokogiri($data);
		}
		$relevance = $this->saw->get('div table[width="100%"]')->toArray();
		$i = 0;
		$data = array();
		foreach ($relevance as $rel_value) {
			preg_match_all('/\/watch\?v=(.*?)\&.*?$/', $rel_value['tr'][0]['td'][0]['div'][0]['a'][0]['href'], $id);
			if(isset($id[1][0])) {
				$data['items'][$i]['id']['videoId'] = $id[1][0];
				$data['items'][$i]['snippet']['publishedAt'] = '';
				$data['items'][$i]['snippet']['channelId'] = '';
				$data['items'][$i]['snippet']['title'] = trim($rel_value['tr'][0]['td'][1]['div'][0]['a'][0]['#text'][0]);
				$data['items'][$i]['snippet']['channelTitle'] = '';
				$i++;
			}
		}
		return $data;
	}
	function grabSearch($matches){
		if(isset($matches['pageToken']) && $matches['pageToken'] != NULL) {
			$url = 'https://m.youtube.com/results?client=mv-google&gl=RU&hl=ru&search_sort=relevance&q='.$matches['alias'].'&search_type=search_all&uploaded=&action_continuation=1&ctoken='.$matches['pageToken'];
		} else {
			$url = 'https://m.youtube.com/results?client=mv-google&gl=RU&hl=ru&q='.$matches['alias'];
		}
		$grabsearch = $this->grabGet($url);
		$grabsearch = str_replace('font-size:13px;width:100%', 'width:100%;font-size:13px', $grabsearch);
		//print_r($grabsearch);exit;
		$saw = new nokogiri($grabsearch);
		
		//Пагинация
		$token = $saw->get('div[id="botPagination"]')->toArray();
		if(!empty($matches['pageToken']) && !empty($token[0]['div'][0]['span'][1]['a'][0]['href'])) {
			parse_str($token[0]['div'][0]['span'][0]['a'][0]['href'], $data['prevPageToken']);
			$data['prevPageToken'] = $data['prevPageToken']['ctoken'];
			parse_str($token[0]['div'][0]['span'][1]['a'][0]['href'], $data['nextPageToken']);
			$data['nextPageToken'] = $data['nextPageToken']['ctoken'];
		} else {
			parse_str($token[0]['div'][0]['span'][0]['a'][0]['href'], $data['nextPageToken']);
			$data['nextPageToken'] = $data['nextPageToken']['ctoken'];
		}

		$search = $saw->get('table[width="100%"] tr[valign="top"] td[style="width:100%;font-size:13px"]')->toArray();
		//print_r($search);//exit;
		$i = 0;
		foreach ($search as $items) {
			$href = trim($items['div'][0]['a'][0]['href']);
			preg_match_all("/watch\?v=(.*?)\&/", $href, $videoId);
			if(!empty($videoId[1][0])) {
				$data['items'][$i]['id']['videoId'] = $videoId[1][0];
				$data['items'][$i]['snippet']['publishedAt'] = trim($items['div'][1]['#text'][0]);
				$data['items'][$i]['snippet']['channelId'] = '';
				$data['items'][$i]['snippet']['title']= trim($items['div'][0]['a'][0]['#text'][0]);
				$data['items'][$i]['snippet']['description'] = trim($items['div'][3]['#text'][0]);
				$data['items'][$i]['snippet']['channelTitle'] = trim($items['div'][2]['#text'][0]);
				$i++;
			}
		}
		return $data;
	}
	function grabChannel($alias){
		$grabget = $this->grabGet('https://m.youtube.com/channel/'.$alias.'/videos?hl=ru&gl=RU&client=mv-google');
		$grabget = str_replace('font-size:13px;width:100%', 'width:100%;font-size:13px', $grabget);
		//print_r($grabget);exit;
		$saw = new nokogiri($grabget);
		$channel = $saw->get('table[width="100%"] tr[valign="top"] td[style="width:100%;font-size:13px"]')->toArray();
		//print_r($channel);exit;
		$i = 0;
		foreach ($channel as $items) {
			if($href = trim($items['div'][0]['a'][0]['href'])) {
				//$href = trim($items['div'][0]['a'][0]['href']);
				preg_match_all("/watch\?v=(.*?)\&/", $href, $videoId);
			//if(!empty($videoId[1][0])) {
				$data['items'][$i]['id']['videoId'] = $videoId[1][0];
				$data['items'][$i]['snippet']['publishedAt'] = trim($items['div'][1]['#text'][0]);
				$data['items'][$i]['snippet']['channelId'] = $alias;
				$data['items'][$i]['snippet']['title']= trim($items['div'][0]['a'][0]['#text'][0]);
				$data['items'][$i]['snippet']['description'] = trim($items['div'][3]['#text'][0]);
				//$data['items'][$i]['snippet']['channelTitle'] = trim($items['div'][2]['#text'][0]);
				$i++;
			}
		}
		return $data;
	}
}