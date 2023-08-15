<?

/**
 * Представление вывода ощибки
 */
$TMPL['DOMAIN'] = DOMAIN;
$TMPL['HOST'] = HOST;
$TMPL['URL'] = URL;
$TMPL['year'] = date('Y');

$TMPL['title_site'] = '';
$TMPL['description_site'] = '';
$TMPL['keywords_site'] = '';
$TMPL['main_header'] = '';
$TMPL['main_description'] = '';
$TMPL['searchString'] = '';
$TMPL['url_logo'] = 'href="'.HOST.'"';
$TMPL['image_site'] = '';

$TMPL['content'] = '';
$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/error.html');
$TMPL['content'] =  $skin->make();

require_once CORE.'/views/nav.php';

$skin = new skin(DIRECTORY.'/templates/'.$TMPL['templates'].'/index.html');
$echo = wp_html_compression_finish($skin->make());
wp_html_compression_start();
echo $echo;