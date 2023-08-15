<?php
header("Content-type: text/txt; charset=UTF-8");

$TMPL['sitemap'] = 'Sitemap: '.HOST.'/sitemap.xml';

$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/robots.html');
echo $skin->make();