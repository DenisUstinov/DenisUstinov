<?php

/**
 * Представление вывода списка записей по поиску
 */

if (isset($json['related']['items']) && count($json['related']['items']) > 0) {
	//$TMPL['next_video_id'] =  $json['related']['items'][0]['id']['videoId'].'/'.translit($json['related']['items'][0]['snippet']['title']); // Автовоспроизведение следующего
	
	$TMPL['watch_related_items'] = '';
	foreach($json['related']['items'] as $key => $item) {
		$TMPL['videoId'] = $item['id']['videoId'];
		$TMPL['publishedAt'] = showDate(date('U', strtotime($item['snippet']['publishedAt'])));
		$TMPL['channelId'] = $item['snippet']['channelId'];
		$TMPL['title'] = htmlspecialchars($item['snippet']['title']);
		$TMPL['title_small'] = mb_substr($TMPL['title'], 0, 40, 'UTF-8').'...';
		$TMPL['translit'] = translit($item['snippet']['title']);
		$TMPL['thumbnails'] = HOST.'/imagefile/'.$item['id']['videoId'].'.jpg';
		$TMPL['channelTitle'] = htmlspecialchars($item['snippet']['channelTitle']);
		
		$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/watch-related-items.html');
		$TMPL['watch_related_items'] .= $skin->make();
		
		// Вывод продвигаемого видео
		if($key == 0 && $data['videoId'] && $matches['alias'] != $data['videoId']){
			$TMPL['videoId'] = $data['videoId'];
			$TMPL['publishedAt'] = showDate(strtotime($data['publishedAt']));
			$TMPL['channelId'] = $data['channelId'];
			$TMPL['title'] = htmlspecialchars($data['title']);
			$TMPL['title_small'] = mb_substr($TMPL['title'], 0, 40, 'UTF-8').'...';
			$TMPL['translit'] = translit($data['title']);
			$TMPL['thumbnails'] = HOST.'/imagefile/'.$data['videoId'].'.jpg';
			$TMPL['channelTitle'] = htmlspecialchars($data['channelTitle']);
			
			$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/watch-related-items.html');
			$TMPL['watch_related_items'] .= $skin->make();
			
			$TMPL['watch_related_items'] .= $TMPL['add_watch_sidebar_related'];
		}
	}
	
	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/watch-related.html');
	$TMPL['videos_related'] = $skin->make();
} else {
	$TMPL['videos_related'] = 'Похожие видео не найдены!';
}