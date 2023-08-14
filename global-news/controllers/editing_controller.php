<?php
	require_once DIRECTORI.'/models/model.php';
	$db = new safeMysql();
	require_once DIRECTORI.'/controllers/function_controller.php';
	/* Удалить картинку ******************************************************************/
	if (isset($_POST['delete_images'])){
		if(!empty($_POST['image_name'])){// удаляем старую картинку если есть
			if (file_exists(DIRECTORI.'/templates/img/'.$_POST['image_name'])) unlink(DIRECTORI.'/templates/img/'.$_POST['image_name']);
		}
		header("Location: ".HOST.$_SERVER['PHP_SELF']."?table=".$table.'&id='.$_POST['delete_images']);  
		exit;
	}
	/* Удалить картинку ******************************************************************/

	/* ОБРАБОТЧИК ФОРМ *******************************************************************/
	foreach($_POST as $key_post => $value_post){
		if($key_post != 'id' && $key_post != 'image_'.$table && $key_post != 'delete' && $key_post != 'image_name' && $key_post != 'password_'.$table){// если надо редактировать данныеотсеим данные полей
			$data_post[$key_post] = $value_post;//остальные в массив
		}
	}// Пост в цикле в массив(какие поля формы есть?)
	/*.ОБРАБОТЧИК ФОРМ *******************************************************************/


	/* ФАЙЛЫ *****************************************************************************/
	if(isset($_FILES['image_'.$table]['tmp_name']) && is_uploaded_file($_FILES['image_'.$table]['tmp_name'])){
		if(!empty($_POST['image_name'])){// удаляем старую картинку если есть
			if (file_exists(DIRECTORI.'/templates/img/'.$_POST['image_name'])) unlink(DIRECTORI.'/templates/img/'.$_POST['image_name']);
		}
		$type = $_FILES['image_'.$table]['name'];
		$date = time();
		$name = $date.'_'.$type;
		move_uploaded_file($_FILES['image_'.$table]['tmp_name'], DIRECTORI.'/templates/img/'.$name);
		$data_post['image_'.$table] = $name;// Имя картинки тоже в массив
	}
	/*.ФАЙЛЫ *****************************************************************************/


	/* ПАРОЛЬ ****************************************************************************/
	if(!empty($_POST['password_'.$table])){// Если пришел пароль в POST
		$password_setings = $_POST['password_'.$table];
		//$password_setings = md5(md5(trim($password_setings)));
		$password_setings = password_hash($password_setings, PASSWORD_DEFAULT);
		$data_post['password_'.$table] = $password_setings;// Пароль в массив тоже в массив
	}
	/*.ПАРОЛЬ ****************************************************************************/


	/* ЗАПРОСЫ ***************************************************************************/
	if(isset($_POST['delete'])){
		if(!empty($_POST['image_name'])){// удаляем старую картинку если есть
			if (file_exists(DIRECTORI.'/templates/img/'.$_POST['image_name'])) unlink(DIRECTORI.'/templates/img/'.$_POST['image_name']);
		}
		$db->query("DELETE FROM ?n WHERE id=?i",$table,$_POST['delete']);
	}elseif($_POST['id']){
		$db->query("UPDATE ?n SET ?u WHERE id=?s",$table,$data_post,$_POST['id']);
	}else{ 
		$db->query("INSERT INTO ?n SET ?u",$table,$data_post);
	}
	/*.ЗАПРОСЫ ***************************************************************************/


	header("Location: ".HOST.$_SERVER['PHP_SELF']."?table=".$table);  
	exit;
?>