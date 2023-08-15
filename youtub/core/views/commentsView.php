<?php

/**
 * Представление вывода списка записей по условию
 */

if (isset($json['comments']['pageInfo']['totalResults']) && $json['comments']['pageInfo']['totalResults'] > 0) {
	/**
	 * Получаем и обрабатывает переменные для массива шаблона
	 */
	$TMPL['comment'] = '';
	$i = 1;
	foreach($json['comments']['items'] as $key => $item) {
		if ($i >= 50) break; // Не больше 50 кометариев
		$TMPL['class_comments'] = 'noreplies';
		$TMPL['authorDisplayName'] = $item['snippet']['topLevelComment']['snippet']['authorDisplayName'];
		$TMPL['authorProfileImageUrl'] = $item['snippet']['topLevelComment']['snippet']['authorProfileImageUrl'];
		$TMPL['authorChannelId'] = $item['snippet']['topLevelComment']['snippet']['authorChannelId']['value'];
		$TMPL['textOriginal'] = nl2br(upUrl(htmlspecialchars($item['snippet']['topLevelComment']['snippet']['textOriginal'])));
		$TMPL['likeCount'] = $item['snippet']['topLevelComment']['snippet']['likeCount'];
		$TMPL['publishedAt'] = showDate(strtotime($item['snippet']['topLevelComment']['snippet']['publishedAt']));

		$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/comments-items.html');
		$TMPL['comment'] .= $skin->make();

		// Если есть ответы на комментарии
		if (isset($item['replies'])) {
			$TMPL['class_comments'] = 'replies';
			foreach($item['replies']['comments'] as $key => $item_replies) {
				$TMPL['authorDisplayName'] = $item_replies['snippet']['authorDisplayName'];
				$TMPL['authorProfileImageUrl'] = $item_replies['snippet']['authorProfileImageUrl'];
				$TMPL['authorChannelId'] = $item_replies['snippet']['authorChannelId']['value'];
				$TMPL['textOriginal'] = nl2br(upUrl(htmlspecialchars($item_replies['snippet']['textOriginal'])));
				$TMPL['likeCount'] = $item_replies['snippet']['likeCount'];
				$TMPL['publishedAt'] = showDate(strtotime($item_replies['snippet']['publishedAt']));

				$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/comments-items.html');
				$TMPL['comment'] .= $skin->make();
			}
		}
		$i++;
	}
} else {
	$TMPL['comment'] = '<p>Нет комментариев!</p>';
}
$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/comments.html');
$TMPL['comments'] = $skin->make();