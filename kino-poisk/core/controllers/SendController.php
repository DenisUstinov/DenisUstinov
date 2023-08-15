<?php

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['text']) && isset($_POST['url']))
	{
		$subject = 'Сообщение о нарушении с сайта КиноПоиск24';

		$message = '
			<html>
				<head>
					<title>'.$subject.'</title>
				</head>
				<body>
					<p><b>email: </b>'.$_POST['email'].'</p>
					<p><b>text: </b>'.$_POST['text'].'</p>
					<p><b>url: </b>'.$_POST['url'].'</p>
				</body>
			</html>
				';

		$headers  = "Content-type: text/html; charset=utf-8 \r\n";
		$headers .= "From: Отправитель <from@example.com>\r\n";
		if (mail($mail, $subject, $message, $headers)) {
			$result = array(
				'article' => ' Данные отправленны.</p>'
			);
			echo json_encode($result);
		}
	}