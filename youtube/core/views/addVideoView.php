<?
	if($key == 1 && $data['videoId'] && $matches['alias'] != $data['videoId']){
		$TMPL['videoId'] = $data['videoId'];
		$TMPL['publishedAt'] = showDate(strtotime($data['publishedAt']));
		$TMPL['channelId'] = $data['channelId'];
		$TMPL['title'] = htmlspecialchars($data['title']);
		$TMPL['title_small'] = mb_substr($TMPL['title'], 0, 40, 'UTF-8').'...';
		$TMPL['translit'] = translit($data['title']);
		$TMPL['description'] = mb_substr(htmlspecialchars(upUrl($data['description'])), 0, 90, 'UTF-8').'...';
		$TMPL['thumbnails'] = 'https://i.ytimg.com/vi/'.$data['videoId'].'/mqdefault.jpg';
		$TMPL['channelTitle'] = htmlspecialchars($data['channelTitle']);
	}