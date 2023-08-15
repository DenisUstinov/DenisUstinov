<?php
/**
 * Главное предсавление вида карты сайта
 */
$TMPL['DOMAIN'] = DOMAIN;
$TMPL['HOST'] = HOST;

header("Content-type: text/xml; charset=UTF-8");
$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/opensearch.html');
echo $skin->make();