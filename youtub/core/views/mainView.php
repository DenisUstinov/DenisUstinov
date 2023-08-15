<?php
/**
 * Главное предсавление вида
 */
$TMPL['DOMAIN'] = DOMAIN;
$TMPL['HOST'] = HOST;
$TMPL['URL'] = URL;
$TMPL['year'] = date('Y');
$TMPL['url_logo'] = '';

if (!require_once CORE.'/views/'.$action.'View.php') return false;
require_once CORE.'/views/nav.php';

$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/index.html');
$echo = $skin->make();
wp_html_compression_start();
echo $echo;