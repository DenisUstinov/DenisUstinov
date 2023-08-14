<?php
	require_once ('../../functions/functions.php');
	require_once ('../../classes/PHPExcel/PHPExcel.php');

	$db_client = parse_excel_file('../../databases/db_client.xls' );
	foreach($db_client as $value_client){
		if($_GET['url'] == $value_client[1]){
			$pass = $value_client[2];
		}
	}
	$post_pass = trim(strip_tags($_POST['pass']));
	if ($post_pass === $pass){
		$brand = '';
		$client = $_POST['client'];
		$brand = $_POST['brand'];
		$adres = $_POST['adres'];

		require 'phpmailer/PHPMailerAutoload.php';
		
		$mail = new PHPMailer;
		
		$mail->isSMTP();
		
		$mail->Host = 'smtp.mail.ru';
		$mail->SMTPAuth = true;
		$mail->Username = 'denis_ustinow@mail.ru'; // логин от вашей почты
		$mail->Password = 'DangaR2017'; // пароль от почтового ящика
		$mail->SMTPSecure = 'ssl';
		$mail->Port = '465';
		
		$mail->CharSet = 'UTF-8';
		$mail->From = 'denis_ustinow@mail.ru'; // адрес почты, с которой идет отправка
		$mail->FromName = 'denis_ustinow'; // имя отправителя
		$mail->addAddress('denis_ustinow@mail.ru');
		$mail->addAddress('rub0-opt1@novex-trade.ru');
		//$mail->addCC('bella_rubcovsk@mail.ru');
		//$mail->addCC('email3@email.com');
		
		$mail->isHTML(true);
		
		$mail->Subject = 'Заявка - '.$client.' ('.$adres.')';
		$mail->Body = '<div>'.$brand.'</div>';
		//$mail->AltBody = 'Привет, мир! Это альтернативное письмо';
		//$mail->addAttachment('img/Lighthouse.jpg', 'Картинка Маяк.jpg');
		// $mail->SMTPDebug = 1;
		
		if( $mail->send() ){
		echo'
		<script>
			var speed = 1000
			function reload() {
			top.document.location.reload()
			}
			setTimeout("reload()", speed);
		</script>
		';
				echo <<< END
					<div id="body">
						<div style='padding: 15% 5% 0 5%; text-align:center; font-family: Arial, sans-serif; color: #47a3da;''>
								<h1>Заявка обработана.</h1>
						</div>
					</div>
END;
			}else{
				echo 'Письмо не может быть отправлено. ';
				echo 'Ошибка: ' . $mail->ErrorInfo;
			}
	}else{
	echo <<< END
		<div id="body">
			<div style='padding: 15% 5% 0 5%; text-align:center; font-family: Arial, sans-serif; color: #47a3da;''>
					<h4>Неверный пароль! Закройте окно нажав на крестик в верхнем углу. Повторно кликните по кнопке "Оформить" и заполните заявку еще раз. Если Вы забыли пароль, свяжитесь с нами по тел. 8-929-325-6604</h4>
			</div>
		</div>
END;
	}

?>