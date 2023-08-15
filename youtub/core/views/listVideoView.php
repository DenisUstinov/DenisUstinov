<?php

/**
 * Представление вывода списка записей
 */

$TMPL['items_videos'] = '';
foreach($json['items'] as $key => $item){
	$TMPL['videoId'] = $item['id']['videoId'];
	$TMPL['publishedAt'] = showDate(strtotime($item['snippet']['publishedAt']));
	$TMPL['channelId'] = $item['snippet']['channelId'];
	$TMPL['title'] = htmlspecialchars($item['snippet']['title']);
	$TMPL['title_small'] = mb_substr($TMPL['title'], 0, 50, 'UTF-8').'...';
	$TMPL['translit'] = translit($item['snippet']['title']);
	$TMPL['description'] = mb_substr(htmlspecialchars(removeUrl($item['snippet']['description'])), 0, 90, 'UTF-8').'...';
	$TMPL['thumbnails'] = HOST.'/imagefile/'.$item['id']['videoId'].'.jpg';
	$TMPL['channelTitle'] = htmlspecialchars($item['snippet']['channelTitle']);
	
	$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/items_videos.html');
	$TMPL['items_videos'] .= $skin->make();
	
	// Вывод продвигаемого видео
	if($key == 0 && $data['videoId']){
		$TMPL['videoId'] = $data['videoId'];
		$TMPL['publishedAt'] = showDate(strtotime($data['publishedAt']));
		$TMPL['channelId'] = $data['channelId'];
		$TMPL['title'] = htmlspecialchars($data['title']);
		$TMPL['title_small'] = mb_substr($TMPL['title'], 0, 50, 'UTF-8').'...';
		$TMPL['translit'] = translit($data['title']);
		$TMPL['description'] = mb_substr(htmlspecialchars(removeUrl($data['description'])), 0, 90, 'UTF-8').'...';
		$TMPL['thumbnails'] = HOST.'/imagefile/'.$data['videoId'].'.jpg';
		$TMPL['channelTitle'] = htmlspecialchars($data['channelTitle']);
		
		$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/items_videos.html');
		$TMPL['items_videos'] .= $skin->make();
	}
}
$TMPL['content'] = '';
$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/list_videos.html');
$TMPL['content'] = $skin->make();