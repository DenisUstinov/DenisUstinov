<?php

	function validationString($string)
	{
		return htmlspecialchars(strip_tags(stripslashes(trim($string))));
	}



	/**
	 *
	 * Если пришли данные в POST обрабатываем функцией
	 * validationString и отправляем на почту
	 *
	 */
	if($_SERVER['REQUEST_METHOD'] && isset($_POST['body_mail']))
	{
		require_once DIRECTORY.'/libs/PHPMailer/PHPMailerAutoload.php';

		$header_mail = validationString($_POST['header_mail']);
		$body_mail = validationString($_POST['body_mail']);
		$alt_mail = validationString($_POST['alt_mail']);
		$serverResponse = validationString($_POST['serverResponse']);

		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'smtp.mail.ru';
		$mail->SMTPAuth = true;
		$mail->Username = 'contacts@tvoya-semya.ru';
		$mail->Password = 'DangaR2015';
		$mail->SMTPSecure = 'ssl';
		$mail->Port = '465';

		$mail->CharSet = 'UTF-8';
		$mail->setFrom('contacts@tvoya-semya.ru', 'Дениса Устинова');         // Адрес от кого
		$mail->addAddress('denis_ustinow@mail.ru', 'Денису Устинову');              // Адрес кому

		$mail->isHTML(true);
		$mail->Subject = $header_mail;
		$mail->Body = $body_mail;
		$mail->AltBody = $alt_mail;

		if(!$mail->send())
		{
			echo 'Письмо не отправленно. Код ошибки: ' . $mail->ErrorInfo;
		}
		else
		{
			echo $serverResponse;
		}
	}