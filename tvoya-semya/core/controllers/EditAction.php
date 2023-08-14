<?php
session_start();

$TMPL['table'] = $matches['table'];

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user_id'])){
	/* ОБРАБОТЧИК ФОРМ *******************************************************************/
	foreach($_POST as $key_post => $value_post){
		if($key_post != 'id' && $key_post != 'image_'.$TMPL['table'] && $key_post != 'tags_'.$TMPL['table'] && $key_post != 'delete' && $key_post != 'image_name' && $key_post != 'password_'.$TMPL['table']){// если надо редактировать данные ,отсеим данные полей
			$data_post[$key_post] = $value_post;//остальные в массив
		}
	}// Пост в цикле в массив(какие поля формы есть?)
	/*************************************************************************************/
	
	
	/* ИЗОБРАЖЕНИЯ ***********************************************************************/
	if(isset($_FILES['image_'.$TMPL['table']]['tmp_name']) && is_uploaded_file($_FILES['image_'.$TMPL['table']]['tmp_name']))
	{
		if(!empty($_POST['image_name'])){
			image_delite($settings['template_settings'],$TMPL['table'],$_POST['image_name']);
		}

		move_uploaded_file($_FILES['image_'.$TMPL['table']]['tmp_name'], DIRECTORY.'/templates/'.$settings['template_settings'].'/img/'.$_FILES['image_'.$TMPL['table']]['name']);
		$data_post['image_'.$TMPL['table']] = $_FILES['image_'.$TMPL['table']]['name'];

		if($TMPL['table'] == 'articles' || $TMPL['table'] == 'pages')
		{
			$name = time();

			require_once DIRECTORY.'/libs/imgresize.lib.php';
			$img = new imgresize();
			$img->load(DIRECTORY.'/templates/'.$settings['template_settings'].'/img/'.$_FILES['image_'.$TMPL['table']]['name']);

			$img->resampleToWidth(750);
			$img->sharpen();
			$img->watermark(DIRECTORY.'/templates/'.$settings['template_settings'].'/img/trash/watermark/watermark_750.png');
			$img->save(DIRECTORY.'/templates/'.$settings['template_settings'].'/img/'.$TMPL['table'].'/large/'.$name.'.jpg', 85);

			$img->resampleToWidth(350);
			$img->sharpen();
			$img->save(DIRECTORY.'/templates/'.$settings['template_settings'].'/img/'.$TMPL['table'].'/medium/'.$name.'.jpg', 85);

			unlink(DIRECTORY.'/templates/'.$settings['template_settings'].'/img/'.$_FILES['image_'.$TMPL['table']]['name']);
			$data_post['image_'.$TMPL['table']] = $name.'.jpg';
		}
	}
	/*************************************************************************************/
	
	
	/* ПАРОЛЬ ****************************************************************************/
	if(!empty($_POST['password_'.$TMPL['table']])){// Если пришел пароль в POST
		$password = $_POST['password_'.$TMPL['table']];
		$password = password_hash($password, PASSWORD_DEFAULT);
		$data_post['password_'.$TMPL['table']] = $password;// Пароль тоже в массив
	}
	/*************************************************************************************/
	
	
	/* ТЭГИ ******************************************************************************/
	if(!empty($_POST['tags_'.$TMPL['table']]))
	{
		$tags_string = mb_strtolower($_POST['tags_'.$TMPL['table']], 'utf-8');
		//$tags_string= trim(preg_replace('/\s{2,}/', '', $tags_string));
		$tags_string = str_replace(' ', '', $tags_string);
		$data_post['tags_'.$TMPL['table']] = $tags_string;
	}
	/*************************************************************************************/
	
	
	/* ЗАПРОСЫ ***************************************************************************/
	if(isset($_POST['delete']))
	{
		if(!empty($_POST['image_name']))
		{
			image_delite($settings['template_settings'],$TMPL['table'],$_POST['image_name']);
		}
		$db->query('DELETE FROM ?n WHERE id=?i',$TMPL['table'],$_POST['delete']);
	}
	elseif($_POST['id'])
	{
		$db->query('UPDATE ?n SET ?u WHERE id=?s',$TMPL['table'], $data_post, $_POST['id']);
	}
	else
	{ 
		$db->query('INSERT INTO ?n SET ?u',$TMPL['table'], $data_post);
	}
	/*************************************************************************************/

	/* Для редиректа только статей *******************************************************/
	$location = '';
	if($TMPL['table'] == 'articles') {
		$categories = $db->getAll('SELECT * FROM categories');
		$subcategories = $db->getAll('SELECT * FROM subcategories');
		$url_categories = url_categories($data_post['category_articles']);
		$url_subcategories = url_subcategories($data_post['subcategory_articles']);
		$url_articles = $data_post['url_articles'];
		$location = '/'.$url_categories.'/'.$url_subcategories.'/'.$data_post['url_articles'].'.html';
	} elseif($TMPL['table'] == 'pages') {
		$url_pages = $data_post['url_pages'];
		$location = '/page/'.$data_post['url_pages'].'.html';
	}
	/*************************************************************************************/


	header('Location: '.HOST.$location);
	exit;
}