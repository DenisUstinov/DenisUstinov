<?php
/**
 * Главное предсавление вида карты сайта
 */
$TMPL['HOST'] = HOST;
$TMPL['date'] = date(DateTime::W3C);

if (!require_once CORE.'/views/'.$action.'View.php') return false;

header("Content-type: text/xml; charset=UTF-8");
$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/'.$action.'.html');
echo $skin->make();