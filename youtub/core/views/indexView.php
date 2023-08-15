<?php

/**
 * Представление вывода списка записей на главной
 */

if (count($json['items']) > 0) {
	require_once CORE.'/views/navChannelView.php';
	require_once CORE.'/views/listVideoView.php';
} else {
	$TMPL['error_code'] = 'Видео не найдены!';
	return false;
}