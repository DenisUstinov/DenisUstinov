<?php

$TMPL['player'] = '';
$TMPL['videofile'] = '';
$TMPL['height'] = '';
$TMPL['width'] = '';
$TMPL['download'] = '';
$type = '';

if (isset($json['player_response']['streamingData']['formats'])) {
	$TMPL['player'] = '<video poster="'.HOST.'/imagefile/'.$json['get_video_info']['video_id'].'.jpg" id="player">';
	$array_reverse = array_reverse($json['player_response']['streamingData']['formats']);

	$i = 0;
	foreach($array_reverse as $formats) {
		$formats['url'] = preg_replace('/^(.*)\.googlevideo\.com/', HOST.'/', $formats['url']);
		if ($json['itags_default'][$formats['itag']]['extension'] == 'mp4') {
			$TMPL['player'] .= '<source src="'.$formats['url'].'" type="video/mp4" size="'.$json['itags_default'][$formats['itag']]['video']['height'].'"/>';
			if ($i == 0) {
				$TMPL['height'] = $json['itags_default'][$formats['itag']]['video']['height'];
				$TMPL['width'] = $json['itags_default'][$formats['itag']]['video']['width'];
				$TMPL['videofile'] = $json['get_video_info']['video_id']. '.' .$json['itags_default'][$formats['itag']]['video']['height']. '.' .$json['itags_default'][$formats['itag']]['extension'];
				
				$TMPL['contentLength'] = $formats['contentLength'];
				$TMPL['quality'] = $formats['quality'];
				$TMPL['bitrate'] = $formats['bitrate'];
				//$TMPL['lastModified'] = $formats['lastModified'];
				
				$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/playerSchema.html');
				$TMPL['playerSchema'] = $skin->make();
			}
			$i++;
		}
		if ($json['itags_default'][$formats['itag']]['extension'] != 'webm') {
			$TMPL['download'] .= '<li><a href="'.HOST.'/videofile/'.$json['get_video_info']['video_id'].'.'.$json['itags_default'][$formats['itag']]['video']['height'].'.'.$json['itags_default'][$formats['itag']]['extension'].'" target="_blank" title="Скачать видео '.$json['itags_default'][$formats['itag']]['extension'].' '.$json['itags_default'][$formats['itag']]['video']['height'].'p бесплатно">'.$json['itags_default'][$formats['itag']]['extension'].' '.$json['itags_default'][$formats['itag']]['video']['height'].'p</a></li>';
			$type .= ', '.$json['itags_default'][$formats['itag']]['extension'].' ('.$json['itags_default'][$formats['itag']]['video']['height'].'p)';
		}
	}
	
	$type = ltrim($type, ',');
	$TMPL['player'] .= '</video>';
} else {
	$TMPL['player'] = '<div id="player" data-plyr-provider="youtube" data-plyr-embed-id="'.$matches['alias'].'"></div>';
}