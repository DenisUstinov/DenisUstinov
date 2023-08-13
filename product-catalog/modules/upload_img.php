<?php
	require_once '../includs.php';

	if(isset($_POST['type']) && $_POST['type'] != NULL){
		$b = $_POST['type'];
		$c = $_POST['data'];
		$e = $_POST['title'];
		$f = $_POST['text'];
		$i = edit_excel_file(DIRECTORI.'/databases/db_article.xls',$b,$c,$e,$f); // Функция вернет порядковый номер строки для имени картинки
		
		$uploadfile = DIRECTORI.'/images/articles/'.$b.'/'.$i.'.jpg';
		//move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile); // Загрузка файла
		if(move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)){// Загрузка файла с проверкой
			header("Location: /modules/admin2015.php?flag=1"); // Все ок
		}else{
			header("Location: /modules/admin2015.php?flag=2"); // Все херово
		}
	}
?>


<?php
/* Функция редактирования прайса*/
	function edit_excel_file($filename,$b,$c,$e,$f){
		$array = array();
		$file_type = PHPExcel_IOFactory::identify( $filename );
		$objReader = PHPExcel_IOFactory::createReader($file_type);
		$objPHPExcel = $objReader->load( $filename );
		$array = $objPHPExcel->getActiveSheet()->toArray();
		$i = count($array );
		$ii = $i-1;
		if($array[$ii][0] != null){
			$i++;
		}
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()
			->setCellValue('A'.$i, $i)
			->setCellValue('B'.$i, $b)
			->setCellValue('C'.$i, $c)
			->setCellValue('D'.$i, $i.'jpg')
			->setCellValue('E'.$i, $e)
			->setCellValue('F'.$i, $f);

		$save = new PHPExcel_Writer_Excel5($objPHPExcel);
		$save->save($filename);
		
		unset($objPHPExcel);
		unset($save);
		return($i);
	}
/* .Функция редактирования прайса*/
?>