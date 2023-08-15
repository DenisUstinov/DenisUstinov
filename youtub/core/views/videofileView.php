<?php

if (isset($file_data['player_response']['streamingData']['formats'])) {
	foreach($file_data['player_response']['streamingData']['formats'] as $formats) {
		if ($file_data['itags_default'][$formats['itag']]['video']['height'] == $file_data['file'][1] && $file_data['itags_default'][$formats['itag']]['extension'] == $file_data['file'][2]) {
			header('Content-Type: application/octet-stream');
			header("Content-Transfer-Encoding: Binary"); 
			header("Content-disposition: attachment; filename=\"" . $matches['file'] . "\""); 
			readfile($formats['url']); 
			exit;
		}
	}
} else {
	return false;
}