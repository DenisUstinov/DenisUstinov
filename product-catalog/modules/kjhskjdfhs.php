<?php
	error_reporting(E_ALL);

	$results_uploads_price = '';
	if(isset($_POST['pass_price']) && $_POST['pass_price'] == 'DangeR2015'){
		$type_price = $_POST['type_price'];
		if($type_price == 'price'){
			if(move_uploaded_file($_FILES['file_price']['tmp_name'], DIRECTORI.'/prices/import.xls')){
				$parse_import_file = parse_excel_file(DIRECTORI.'/prices/import.xls'); // Парсим import.xls
				$parse_db_file = parse_excel_file(DIRECTORI.'/databases/db_price.xls'); // Парсим db.xls
				if($parse_import_file && $parse_db_file){
					$group = '';
					foreach($parse_import_file as $value){
						foreach($parse_db_file as $dbvalue){
							if($value[1] == $dbvalue[1]){ // Сравнение артиклей товаров
								/*Формируем группы*/
								if($group != $dbvalue[3]){
									$group = $dbvalue[3];
								}
								$res_2[] = array($dbvalue[0], $dbvalue[1], $dbvalue[2], $group, $dbvalue[4], $dbvalue[5], $value[2], $value[3]);
							}
						}
					}
					sort($res_2); // Сортируем массив по первым элементам
					Save_Exel_File(DIRECTORI.'/prices/price.xls',$res_2); //Вызов функции создание файла xml из многомерного массива.
					cleanDir(DIRECTORI.'/cache');// Вызов функции определенной ниже для очистки папки кэш
					$results_uploads_price = '<p>Файл загружен и обработан ☺</p>';
				}
			}
		}
	}

	$results_uploads_article = '';
	if(isset($_POST['pass_article']) && $_POST['pass_article'] == 'DangeR2015'){
		$type_article = $_POST['type_article'];
		if($type_article == 'article'){
			if(move_uploaded_file($_FILES['file_article']['tmp_name'], DIRECTORI.'/databases/db_article.xls')){
					$results_uploads_article = '<p>Файл загружен и обработан ☺</p>';
			}
		}
	}
?>
<style>
	.admin{
		text-align:center;
		padding:20px;
		color:#47a3da;
		width:550px;
		margin:0 auto;
	}

	a,p{
		text-decoration:none;
		color:#47a3da;
		font-size:1.0em;
	}

	.form{
		text-align:left;
		width:500px;
		color:#47a3da;
		padding:10px 20px;
		margin:20px 0;
		border: solid 1px #47a3da;
	}

	.input, .form textarea, .form select{
		color:#47a3da;
		font-size: 13px;
		margin-bottom: 10px;
		display: block;
		padding: 6px;
		width: 500px;
		border: solid 1px #47a3da;
		background-color:#fff;
	}

	.submit{
		font-size: 15px;
		display: block;
		padding: 10px;
		width: 500px;
		border: solid 1px #47a3da;
		background-color:#47a3da;
		color:#fff;
	}
	@media screen and (max-width: 59em) {
		.admin{
			padding:0;
		}
	}
</style>
<!-- Модальное окно загрузка прайсов -->
<div class="admin">
	<a href="/">На главную ►</a>
	<!--<div class="form">
		<h3>Добавление статьи</h3>
		<form method="post" action="upload_img.php" enctype = "multipart/form-data">
			<input class="input" type="text" name="title">
			<input class="input" type="date" name="data">
			<select name="type">
				<option value = "">Рубрика
				<option value = "actions">Акции
				<option value = "news">Новости
			</select>
			<textarea rows="8" cols="30" name="text"></textarea>
			<input class="input" type="file" name="file">
			<input class="submit" type="submit" value="Сохранить">
		</form>
	</div>-->


	<div class="form">
		<h3>Загрузка прайса</h3>
		<form method="post" enctype="multipart/form-data">
			<?=$results_uploads_price;?>
			<input style="visibility:hidden" type="text" name="type_price" value = "price">
			<input class="input" type="text" name="pass_price" placeholder="Введите пароль на загрузку">
			<input class="input" type="file" name="file_price">
			<input class="submit" type="submit" value="Сохранить">
		</form>
	</div>
	<div class="form">
		<h3>Загрузка статей</h3>
		<form method="post" enctype="multipart/form-data">
			<?=$results_uploads_article;?>
			<input style="visibility:hidden" type="text" name="type_article" value = "article">
			<input class="input" type="text" name="pass_article" placeholder="Введите пароль на загрузку">
			<input class="input" type="file" name="file_article">
			<input class="submit" type="submit" value="Сохранить">
		</form>
	</div>
</div>
<!-- /Модальное окно загрузка прайсов -->