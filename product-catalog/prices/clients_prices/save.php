<?php
	require_once '../../includs.php';
	
	if(isset($_GET['page']) && $_GET['bella'] && $_GET['seni']){
		$discount_bella = $_GET['bella'];
		$discount_seni = $_GET['seni'];
		$url = $_GET['page'];

		$parse_import_file = parse_excel_file(DIRECTORI.'/prices/import.xls'); // Парсим import.xls
		$parse_db_price = parse_excel_file(DIRECTORI.'/databases/db_price.xls'); // Парсим db.xls
		if($parse_import_file && $parse_db_price){
			$group = '';
			foreach($parse_import_file as $value){
				foreach($parse_db_price as $db_price_value){
					if($value[1] == $db_price_value[1]){ // Сравнение артиклей товаров
						/*Формируем группы*/
						if($group != $db_price_value[3]){
							$group = $db_price_value[3];
						}
						if($db_price_value[4] == 'Bella'){
							$price = $value[3]*$discount_bella;
						}elseif($db_price_value[4] == 'Seni'){
							$price = $value[3]*$discount_seni;
						}
						$price = (int)$price;
						$res_2[] = array($db_price_value[0], $db_price_value[1], $db_price_value[2], $group, $db_price_value[4], $db_price_value[5], $value[2], $price);
					}
				}
			}
			sort($res_2); // Сортируем массив по первым элементам
			
			Save_Exel_File(DIRECTORI.'/prices/clients_prices/'.$url.'_price.xls',$res_2); //Вызов функции создание файла xml из многомерного массива.
			
			$file = ($url."_price.xls");
			header ("Content-Type: application/xls");
			header ("Accept-Ranges: bytes");
			header ("Content-Length: ".filesize($file));
			header ("Content-Disposition: attachment; filename=".$file);  
			readfile($file);
		}
	}
?>