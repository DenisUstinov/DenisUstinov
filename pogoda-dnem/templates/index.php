<!DOCTYPE html>
<html>
	<head>
		<title>Погода сейчас, днем и на 10 дней, города {$city}, {$part}, {$country}</title>
		<meta name='yandex-verification' content='69ddee8b13c2663a' />
		<meta name="viewport" content="width=device-width, initial-scale=0.8, maximum-scale=0.8, minimum-scale=0.8, user-scalable=no">
		<meta name="description" content="Прогноз погоды на 10 дней города {$city}, {$part}, {$country}">
		<meta name="keywords" content="погода,днем,10 дней,неделю,месяц,прогноз,яндекс погода,гистметео,гидромецентр,{$city},{$part},{$country}">
		<link href="{$hosts}/css/style.css" rel="stylesheet">
		<link rel="shortcut icon" href="{$hosts}/favicon.ico" type="image/x-icon" />
		<script src="{$hosts}/js/css.js"></script>
		<script src="{$hosts}/js/jquery-1.11.3.min.js"></script>
		<script src="{$hosts}/js/jquery.mobile.custom.min.js"></script>
		<script src="{$hosts}/js/jquery.slider-rm.js"></script>
		<style>
			body{
				background: url('{$color_background}') no-repeat center center fixed; 
				-webkit-background-size: cover;
				-moz-background-size: cover;
				-o-background-size: cover;
				background-size: cover;
				color:#{$color_text};
			}
			.slider-rm-style .slider-rm-nav__prev {
				background: url({$hosts}/core/color.php?image_name=arrow-left.png&color_icon={$color_text}) center center no-repeat;
			}
			.slider-rm-style .slider-rm-nav__next {
				background: url({$hosts}/core/color.php?image_name=arrow-right.png&color_icon={$color_text}) center center no-repeat;
			}
			.no_active:hover{
				background:rgba({$colorChange},0.1);
			}
			.active{
				background:rgba({$colorChange},0.3);
			}
			.active::after {
				border-top: 15px solid rgba({$colorChange},0.3); 
			}
			.details_one{
				border-left: 1px solid rgba({$colorChange},0.3);
				background:rgba({$colorChange},0.3);
			}
			.header_section{
				border-bottom:1px solid rgba({$colorChange},0.3);
			}
			#yet{
				background:rgba({$colorChange},0.3);
			}
			.modal{
			    box-shadow: 0px 0px 100px 50px rgba({$colorChange},0.3);
			}
			footer{
				border-top:1px solid rgba({$colorChange},0.3);
			}
		</style>
	</head>
	<body id="body">
		<section id="weather">
			<div id="today">
				<div style="font-size:1.7em;">{$city}, {$part}, {$country} <a style="cursor: pointer;color:#{$color_text};text-decoration:none;" onclick="javascript:spoiler('modal_city')"> ≡</a></div>
				<div style="font-weight:200;">{$fact_date} года</div>
				<div style="font-size:0.7em;">Ваш айпи: {$client_ip}</div>
				<div style="font-size:5.0em">{$fact_temperature}<span style="font-size:0.3em;">°C </span> <img class="img_fact" src="{$hosts}/core/color.php?image_name={$fact_image}.png&color_icon={$color_text}" width="60" height="60"></div>
				<div style="font-size:1.4em;">{$fact_weather_type}</div>
				<div style="font-size:0.7em;">Ветер {$fact_wind_direction} {$fact_wind_speed} м/с&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Относительная влажность {$fact_humidity} %</div>
				<div style="font-size:0.7em;">Атмосферное давление {$fact_pressure} мм&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Среднее давление на уровне моря {$fact_mslp_pressure} мм</div>
			</div>
			<!--<div id="search">
				<div style="text-align:right;font-size:0.7em;">Ваш айпи: {$client_ip}</div>
			</div>-->
			<div style="clear:left"></div>
			<div class="day-group">
				<div id="slider">
					<div class="slider-rm-ul">
						{$prev}
					</div>
				</div>
				<div style="clear:left"></div>
			</div>
			{$details_all}
			<div style="width:93%;height:100px;margin:0 auto;margin-bottom:20px;">
				<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
				<!-- ПогодаДнем_Футер -->
				<ins class="adsbygoogle"
					 style="display:block"
					 data-ad-client="ca-pub-2940100433717238"
					 data-ad-slot="3434373901"
					 data-ad-format="auto"></ins>
				<script>
				(adsbygoogle = window.adsbygoogle || []).push({});
				</script>
			</div>
			<script type="text/javascript" src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js" charset="utf-8"></script>
            <script type="text/javascript" src="//yastatic.net/share2/share.js" charset="utf-8"></script>
            <div style="margin:0 auto;width:300px;" class="ya-share2" data-services="vkontakte,facebook,odnoklassniki,moimir,gplus,twitter,blogger,qzone,tumblr,whatsapp"></div>
			<footer><a style="color:#{$color_text};text-decoration:none;" href="https://pogoda.yandex.ru" target="_blank">Яндекс погода © ПогодаДнем.рф</a></footer>
		</section>

		<!-- Модальное окно -->
		<div id="modal_city" class="modal" style="display:none; overflow:auto;">
			<div class="modal_body">
				Настройки осуществляются один раз! <!--<a href="">(Посмотреть 30 секундное видео по настройке)</a>--><br>
				Впоследствии сайт будет применять их автоматически. Не отключайте куки для сайта.<br><br>
				<form method="get">
					<label>Выбирете город:</label>
					<select id="select_city" name="city_id">
						<option value="{$city_id}">{$city}</option>
						{$array_city}
					</select><br>
					<label>Введите полный URL фоновой картинки:</label>
					<input id="input_background" type="text" name="color_background" value="{$color_background}">
					<label>Выберете цвет текста и иконок:</label>
					<input id="input_color" type="color" name="color_text" value="#{$color_text}">
					<input id="form_submit" type="submit" value="Сохранить настройки">
				</form>
			</div>
			<span onclick="javascript:spoiler('modal_city')" id="modal_close">x</span>
		</div>
		<!-- /Модальное окно -->

		<script type="text/javascript">
			function spoiler(id) {
				if(document.getElementById(id).style.display == "none"){
					document.getElementById(id).style.display = "";
					//document.getElementById('body').style.overflow = "hidden";

				} else {
					document.getElementById(id).style.display = "none";
					//document.getElementById('body').style.overflow = "visible";
				}
			}
			function modals(id) {
				var div = document.getElementsByClassName('details_all');
				for(i=0; i < div.length; i++) {
					div[i].style.display='none';
				}
				var dayactive = document.getElementsByClassName('day active');
				for(i=0; i < dayactive.length; i++) {
					dayactive[i].className='day no_active';
				}

				if(document.getElementById(id).style.display == "none"){
					document.getElementById(id).style.display = "";

				} else {
					document.getElementById(id).style.display = "none";
				}
			}
		</script>
		<script>
		$('#slider').sliderRM({
			bar: false,
			nav: false,
			responsive:{
				300:{
					items: 2,
					nav: true,
				},
				550:{
					items: 3,
					nav: true,
				},
				660:{
					items: 4,
					nav: true,
				},
				770:{
					items: 5,
					nav: true,
				},
				880:{
					items: 6,
					nav: true,
				},
				990:{
					items: 7,
					nav: true,
				},
				1100:{
					items: 8,
					nav: true,
				},
				1210:{
					items: 9,
					nav: true,
				},
				1320:{
					items: 10,
					nav: true,
				},
			}
		});
		</script>
        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter34566920 = new Ya.Metrika({id:34566920,
                            webvisor:true,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true});
                } catch(e) { }
            });
        
            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
        
            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="//mc.yandex.ru/watch/34566920" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
	</body>
</html>