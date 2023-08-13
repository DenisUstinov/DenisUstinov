<style>
	/*Стили модуля модальные окна*/
	#modal_ad{
		top:50px;
		right:50px;
		z-index:9000;
		width: 400px;
		min-width:28%;
		max-width:30%;
		position:fixed;
	}
	@media all and (max-width:1250px) {#modal_ad{display:none;}}

	.modal{
		top:0;
		z-index:20000;
		width: 100%;
		height: 100%;
		position:fixed;
		text-align:center;
		background:#fff;
		font-size:1.2em;
	}

	.modal h2{
		padding-bottom:0.3%;
		border-bottom:1px solid rgba(71, 163, 218, 0.3);
		font-weight:300;
		font-size: 1.7em;
	}

	.modal h3{
		font-weight:300;
		font-size: 1.3em;
	}
	
	.label{
		margin:0.5% 0 8% 0.4%;
		font-size:0.6em;
	}

	.modal img{
		width:100%;
		margin:20px 0;
	}
	
	.data{
		font-weight:300;
		color: #ef6d4b;
		font-size:0.7em;
		padding:0 0 1% 0;
	}

	.p{
		font-size:0.9em;
		text-align:justify;
		padding:2% 0;
	}

	.line{
		border-top:1px solid rgba(71, 163, 218, 0.3);
		width: 40%;
		margin:4% 0 15%;
	}

	iframe{
		width: 100%;
		height: 100%;
	}

	#modal_close {
		color:#ef6d4b;
		width: 51px;
		height: 51px;
		position: absolute;
		top: 10px;
		right: 5px;
		cursor: pointer;
		display: block;
		font-size: 1.9em;
	}
	.modal_body{
		width:60%;
		margin:2% auto;
		text-align:left;
	}

	@media screen and (max-width: 59em) {
		.modal_body{
			width:95%;
			margin:2% auto;
			text-align:left;
		}
		.modal h2, .label{
			text-align:center;
		}
	}
	/*Стили модуля модальные окна*/
</style>
<!-- Модальное окно реклама на главной -->
<div id="modal_ad" style="">
	<img src='<?=HOSTS; ?>/images/slide/1.jpg' id="image_1" style="position: absolute; width:100%;" />
	<img src='<?=HOSTS; ?>/images/slide/2.jpg' id="image_2" style="opacity: 0; filter: alpha(opacity=0); position: absolute; width:100%;" />
	<img src='<?=HOSTS; ?>/images/slide/3.jpg' id="image_3" style="opacity: 0; filter: alpha(opacity=0); position: absolute; width:100%;" />
</div>
<!-- Модальное окно реклама на главной -->

<!-- Модальное окно превью заявки -->
<div id="modal_results" class="modal" style="display:none; overflow:auto;">
	<iframe name='ifr' frameborder="0" border="0" cellspacing="0"></iframe>
	<span onclick="javascript:spoiler('modal_results')" id="modal_close">X</span>
</div>
<!-- /Модальное окно превью заявки -->

<!-- Модальное окно Акции -->
<div id="modal_actions" class="modal" style="display:none; overflow:auto;">
	<div class="modal_body">
		<h2>Акции Bella Rubcovsk</h2>
		<p class="label">актуальные акции продукции Bella</p>
		<?php function_parse_article(DIRECTORI.'/databases/db_article.xls', 'action'); ?>
		<p style="text-align:center;"><?=$Year = strftime('%Y'); ?> © ООО Белла Сибирь</p><br>
	</div>
	<span onclick="javascript:spoiler('modal_actions')" id="modal_close">X</span>
</div>
<!-- /Модальное окно Акции -->

<!-- Модальное окно Новости -->
<div id="modal_news" class="modal" style="display:none; overflow:auto;">
	<div class="modal_body">
		<h2>Новости Bella Rubcovsk</h2>
		<p class="label">актуальные новости о продукции Bella</p>
		<?php function_parse_article(DIRECTORI.'/databases/db_article.xls', 'news'); ?>
		<p style="text-align:center;"><?=$Year = strftime('%Y'); ?> © ООО Белла Сибирь</p><br>
	</div>
	<span onclick="javascript:spoiler('modal_news')" id="modal_close">X</span>
</div>
<!-- /Модальное окно Новости -->

<!-- Модальное окно Контакты -->
<div id="modal_contacts" class="modal" style="display:none; overflow:auto;">
	<div class="modal_body" style="text-align:center;">
		<h2>Контакты Bella Rubcovsk</h2><br><br>
		<p>Официальные сайты:</p><br>
		<p>www.tzmo-global.com</p>
		<p>www.bella-siberia.ru</p><br>
		<p>Наш адрес:</p><br>
		<p>658210, г. Рубцовск</p>
		<p>ул.Сельмашская, 2</p>
		<p>тел/факс:(38557)445-13</p><br>
		<p>Торговый представитель:</p><br>
		<h4>Устинов Денис Николаевич</h4><br>
		<p>тел: 8-962-812-2803</p>
		<p>тел: 8-929-325-6604</p><br>
		<p>mail: Denis_Ustinow@mail.ru</p>
		<p style="text-align:center;"><?=$Year = strftime('%Y'); ?> © ООО Белла Сибирь</p><br>
	</div>
	<span onclick="javascript:spoiler('modal_contacts')" id="modal_close">X</span>
</div>
<!-- /Модальное окно Контакты -->

<script type="text/javascript">
	function spoiler(id) {
		if(document.getElementById(id).style.display == "none"){
			document.getElementById(id).style.display = "";
			document.getElementById('body').style.overflow = "hidden";

		} else {
			document.getElementById(id).style.display = "none";
			document.getElementById('body').style.overflow = "visible";
		}
	}
	function modals(id) {
		if(document.getElementById(id).style.display == "none"){
			document.getElementById(id).style.display = "";

		} else {
			document.getElementById(id).style.display = "none";
		}
	}
</script>