<?php

if ($json['captions']) {
	$xml = simplexml_load_string($json['captions']);
	$TMPL['caption'] = '';
	$i = 1;
	foreach ($xml->text as $text){
		$text = preg_replace("/\[.+\]/i", '', strip_tags($text));
		if ($i == 1) {
			$TMPL['caption'] .= '<p>'.mb_ucfirst($text).' ';
		} elseif ($i == 10) {
			$TMPL['caption'] .= $text.'.</p>';
			$i = 0;
		} else {
			$TMPL['caption'] .= $text.' ';
		}
		$i++;
	}
} else {
	$TMPL['caption'] = '<p>Нет субтитров</p>';
}
$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/captions.html');
$TMPL['captions'] = $skin->make();