<?php

$TMPL['HOST'] = HOST;
$TMPL['URL'] = URL;

$TMPL['title'] = $json['get_video_info']['title'];
$TMPL['publishedAt'] = $json['get_video_info']['timestamp'];
$TMPL['videoId'] = $json['get_video_info']['video_id'];
$TMPL['duration'] = $json['get_video_info']['length_seconds'];

require_once CORE.'/views/playerView.php';

$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/ld_json.html');
$TMPL['ld_json'] = $skin->make();

$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/embed.html');
$echo = wp_html_compression_finish($skin->make());
wp_html_compression_start();
echo $echo;