<?php
	$punkt_menu = ''; // Пункты меню и ссылки якоря для ни
	$catalog = '';// Вывод каталога
	$menu_top_left = '';// Вывод меню
	$i = ''; // Счетчик цикла
	$discount_bella = 1; // Скидка по Bella умолчание
	$discount_seni = 1; // Скидка по Seni умолчание
	$url = ''; // Значения урла
	
	/* Модуль обработки урлов, создание скидок */
	if(isset($_GET['page']) && $_GET['page'] != 'admin2015'){
		$url = $_GET['page'];
		if($url > 0){ // Проверка строки на число
			$discount_bella = (1 - $url/100);
			$discount_seni = $discount_bella;
		}else{
			$db_client_discount = parse_excel_file( DIRECTORI.'/databases/db_client.xls' );
			foreach($db_client_discount as $value_discount){
				if($url == $value_discount[1]){ // Если гет равен одному из занчений массива(определенному клиенту)
					$discount_bella = (1 - $value_discount[4]/100);
					$discount_seni = (1 - $value_discount[5]/100);
				}
			}
		}
	}
	/* .Модуль обработки урлов, создание скидок */

	$parse_price = parse_excel_file( DIRECTORI.'/prices/price.xls' );
	foreach($parse_price as $price_array){
		$i ++;
		if($i>2){ //Начинаем только с 3 строки файла
			/*Создаем якоря для ссылок меню выше обьявил переменную $a*/
			if($punkt_menu != $price_array[3]){ //Создаем якоря для ссылок меню
				$punkt_menu = $price_array[3]; 
				$catalog .= '<a name="'.$punkt_menu.'"></a>';
				$menu_top_left .= '<a class="a_nav padd" href="#'.$punkt_menu.'">'.$punkt_menu.'</a>';
			}

			if($price_array[4] == 'Bella'){
				$price = $price_array[7]*$discount_bella;
			}elseif($price_array[4] == 'Seni'){
				$price = $price_array[7]*$discount_seni;
			}

			$catalog .= '
				<table class="price_table">
					<tr>
						<td width="10%">
							<img class="face_img" src="'.HOSTS.'/images/'.$price_array[2].'" title="'.$price_array[2].'">
						</td>
						<td>
							<table style="padding:0 10px;">
								<tr>
									<td>
										<h2 style="font-weight:300;">'.$price_array[5].'</h2>
									</td>
								</tr>
								<tr>
									<td>
										Остаток: <span style="color: #ef6d4b;"> '.(int)$price_array[6].' шт.</span>
									</td>
								</tr>
								<tr>
									<td>
										Цена: <span style="color: #ef6d4b; font-size:1.95em"> '.(int)$price.' р.</span>
									</td>
								</tr>
							</table>
						</td>
						<td width="5%">
							<input class="input_catalog" name="'.$price.'^'.$price_array[5].'" type="number" autocomplete="off" placeholder="0">
						</td>
					</tr>
				</table>
			';
		}
	}
?>
<style>
	/*Стили модуля каталог*/

	*{
		margin: 0;
		padding: 0;
	}

	#catalog{
		border:0px solid rgba(0,0,0, 0.2);
	}

	#header{
		margin:1.5em 0 3em;
	}

	h1{
		font-size:2.4em;
		font-weight:400;
		margin:0 0 1.2em 0;
	}

	.price_table{
		width:100%;
		padding:8px;
		color:#47a3da;
	}

	.input_catalog{
		text-align:center;
		margin:10px;
		font-size: 1.45em;
		color:#47a3da;
		border: solid 1px rgba(121, 146, 181, 0.3);
	}

	input[type=number]::-webkit-inner-spin-button,
	input[type=number]::-webkit-outer-spin-button {
		-webkit-appearance: none; margin:0;
	}

	.face_img{
		border:1px solid rgba(121, 146, 181, 0.3);
	}

	table{
		font-size:0.90em
	}

	@media screen and (max-width: 59em) {
		#section{margin:0 !important; width:100% !important;}
		#catalog{margin:0 auto; width:95% !important;}
		#header{text-align:center;}

		.price_table{
			border-bottom:1px solid rgba(121, 146, 181, 0.3);
		}
	
		.face_img{
			border:none;
		}
		#header > span {
			margin-top: 5.2em;
		}
	}
	.button_link{
		color:#47a3da;
		border:1px solid #47a3da;
	}

	.button_link:hover{
		color:#fff;
		background:#47a3da;
		border:1px solid #47a3da;
	}
	
	#header > span {
		display: block;
		position: relative;
		z-index: 200;
		font-size: 0.9em;
		font-weight: 300;
		text-transform: uppercase;
		letter-spacing: 0.5em;
		padding: 0.2em 0 1.5em 0.2em;
	}
</style>
<div id="section">
	<div id="catalog">
		<div id="header">
			<span title="ООО Оптсервис, уже много лет является нашим дистребьютером в городе Рубцовске, предлагая самые низкие цены на продукцию Bella">ОПТСЕРВИС</span>
			<h1>Каталог Bella Rubcovsk</h1>
			<a class="button_link padd" href="prices/clients_prices/save.php?page=<?=$url?>&bella=<?=$discount_bella?>&seni=<?=$discount_seni?>">Прайс</a>
			<a href="#" class="button_link padd" onclick="javascript:spoiler('modal_news')">Новости</a>
			<a href="#" class="button_link padd" onclick="javascript:spoiler('modal_contacts')">Контакты</a>
		</div>
		<form target="ifr" action="<?=HOSTS; ?>/modules/preview.php?url=<?=$url ?>" method="POST" name="form">
			<?=$catalog;?>
		</form>
	</div>
</div>