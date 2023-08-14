<script type="text/javascript" src="../js/css_iframes.js"></script>
<?php
	require_once ('../functions/functions.php');
	require_once ('../classes/PHPExcel/PHPExcel.php');

	$db_client = parse_excel_file('../databases/db_client.xls' );
	foreach($db_client as $value_client){
		if($_GET['url'] == $value_client[1]){
			$url = $_GET['url'];
		}
	}

	if($url){
		if(isset($_POST) && $_POST != NULL){
			$brand = '';
			foreach ($_POST as $key => $value) {
				if($value){
					list($price, $face) = explode("^", $key);
					$price = str_replace("_", ".", $price);
					$face = str_replace("_", " ", $face);
						$price = $price*$value;
						$summa += $price;
						$brand .= "<p>$face............$value шт.</p>";
				}
			}

			if($brand && $summa >= 1000){
				$summa = (int)$summa;
				echo <<<FORM
					<meta charset='UTF-8'>
					<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no">
					<style>
						#content{text-align:center; font-family: Arial, sans-serif; font-size:0.6em; color: #47a3da;}
						@media screen and (max-width: 59em) {#content{font-size:2.0em;}}
					</style>
					<body id="body">
						<div id="content">
							<p></p>
							<h3 style="margin-top:30px; font-size:1.7em;">Оформите Вашу заявку:</h3>
							<form action='../classes/mail/index.php?url=$url' method='POST'>
								<input style='font-size:1.2em; width:75%; padding:1.0%; margin:1% 0 0 0; color:#47a3da; border: 1px solid #47a3da;' type='text' placeholder="Наименование клиента" name="client" required><br>
								<input style='font-size:1.2em; width:75%; padding:1.0%; margin:1% 0 0 0; color:#47a3da; border: 1px solid #47a3da;' type='text' placeholder="Адрес доставки заказа" name="adres" required><br>
								<input style='font-size:1.2em; width:75%; padding:1.0%; margin:1% 0 0 0; color:#47a3da; border: 1px solid #47a3da;' type='text' placeholder="Пароль клиента" name="pass" required><br>
								<textarea style='display:none;' name="brand">$brand</textarea>
								<center><div style="font-size:1.2em; width:70%; padding:1%; text-align:left;">$brand</div>
								<div style="font-size:1.2em; width:70%; padding:1%; text-align:left; height:25px; border-top: 1px solid #47a3da;">Общая сумма: $summa руб.</div></center>
								<input style='font-size:1.5em; width:75%; padding:1.0%; margin:1% 0 0 0; color:#fff; background-color:#47a3da; border:none;' type='submit' value='Отправить заявку оператору'>
							</form>
						</div>
					</body>
FORM;
			}else{
				echo <<<END
					<div id="body">
						<div style='padding: 10%; font-size:0.7em;text-align:center; font-family: Arial, sans-serif; color: #47a3da;'>
								<h1>Доставка осуществляется от 1000 рублей.</h1>
						</div>
					</div>
END;
			}
		}
	}else{
		echo <<<ENDS
			<div id="body">
				<div style='padding: 10%; font-size:0.7em;text-align:center; font-family: Arial, sans-serif; color: #47a3da;'>
						<h1>Если Вы являетесь нашим клиентом, зайдите на сайт по Вашей индивидуальной ссылке. Если Вы желаете стать нашим клиентом, обращайтесь к ТП Белла-Сибирь Устинову Д.Н.<br><br>тел: 8-929-325-6604<br>тел: 8-923-755-1802<br>mail: Denis_Ustinow@mail.ru</h1>
				</div>
			</div>
ENDS;
}

?>