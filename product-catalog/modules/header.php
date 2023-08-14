<?php
	if (isset($_GET["page"])){
		if($_GET["page"] != 'admin2015' && file_exists(DIRECTORI.'/cache/index_'.$_GET["page"].'.cache')){ 
			readfile(DIRECTORI.'/cache/index_'.$_GET["page"].'.cache'); exit();
		} 
		ob_start();
	}else{
		if (file_exists(DIRECTORI.'/cache/index.cache')){  
			readfile(DIRECTORI.'/cache/index.cache'); exit();
		} 
		ob_start();
	}
?>
<!DOCTYPE html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<title>Продукция торговой марки Белла</title>
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=0.8, minimum-scale=0.8, user-scalable=no">
		<meta name="keywords" content="прокладки,подгузникки,пелёнки,трусики,косметика,вата,платочки,диски,палочки,новекс,белла,купить,цена,рубцовск"/>
		<meta name="description" content="Интерактивный прайс-каталог продукции, торговой марки Bella"/>
		<link rel="shortcut icon" href="<?=HOSTS; ?>/favicon.ico">
		<link rel="apple-touch-icon" href="<?=HOSTS; ?>/favicon.png">
		<!--[if IE]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<!-- Скрипт динамического изиенения стилей -->
		<script type="text/javascript" src="<?=HOSTS; ?>/js/css.js"></script>
		<!-- /Скрипт динамического изиенения стилей -->
		<noscript>
			<a style="padding-left:130px; color:red;" href="http://www.java.com/ru/download/help/enable_browser.xml">Для корректной работы сайта включите джава скрипт >>></a>
		</noscript>
		<style>
			@import url(http://fonts.googleapis.com/css?family=Roboto:100,300,400,700);
			body,html{overflow-x:hidden;font-family:'Roboto',Calibri,Arial,sans-serif;font-weight:300;font-size:15px;color:#47a3da;width:100%;height:100%;margin:0 auto;background:#fff;}
			#body{font-size:100%;}
			#section{margin-left:170px;}
			#logo{padding:15px 0; width:80px;}
			#button{padding-top:25px;}
			#button_link{padding:5px 10px;}
			#catalog{width:650px;}
			.padd{padding:5px 20px;}
			.face_img{width:110px;}
			.input_catalog{width:40px; height:70px;}
		</style>
		<!-- Подгрузка контента -->
		<script> 
			function showContent(link) { 
				var cont = document.getElementById('content'); 
				var loading = document.getElementById('loading'); 
				cont.innerHTML = loading.innerHTML;   
				var http = createRequestObject(); 
				if( http )  
				{ http.open('get', link); 
					http.onreadystatechange = function ()  
					{   if(http.readyState == 4)  
						{   cont.innerHTML = http.responseText;  }    } 
					http.send(null);  } 
				else  
				{  document.location = link;   }   } 
			// ajax объект
			function createRequestObject()  
			{  try { return new XMLHttpRequest() } 
				catch(e)  
				{  try { return new ActiveXObject('Msxml2.XMLHTTP') } 
					catch(e)  
					{   try { return new ActiveXObject('Microsoft.XMLHTTP') } 
						catch(e) { return null; }   } } } 
		</script>
		<!-- /Подгрузка контента -->
	</head>
	<body id="body">