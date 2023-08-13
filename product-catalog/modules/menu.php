<!--Навигация сайта-->
<style>
/*Стили модуля навигации*/
	#nav{
		top:0;
		left:0;
		height:100%;
		text-align: center;
		z-index:10000;
		position:fixed;
		background-color: #47a3da;
	}

	#nav_duble{
		top:0;
		left:0;
		width:100%;
		text-align: center;
		z-index:10000;
		position:fixed;
		background-color: #47a3da;
	}

	a {
		font-size:0.95em;
		color: #a9d0fc;
		text-decoration: none;
	}

	#logo{
		border: none;/* скрыть контур у ссылок-картинок */
	}

	.a_nav{
		font-size:0.95em;
		text-align: left;
		color: #fff;
		display: block;
		border-bottom: 1px solid #258ecd;
	}

	.a_nav:hover{
		background:#258ecd;
	}

	#button_link{
		color:#fff;
		border:1px solid #fff;
	}

	#button_link:hover{
		color:#47a3da;
		background:#fff;
		border:1px solid #fff;
	}

	#nav_top_prev{
		top:0;
		left:0;
		width:100%;
		position:fixed;
		z-index:1000;
		background: rgba(71, 163, 218, 0.5);
		text-align:center;
		display:none;
		cursor: pointer
	}

	#nav_top_prev p{
		font-size:1.5em;
		font-weight:700;
		padding: 0.27em 0;
		color:#fff;
	}
	@media screen and (min-width: 59em) {
		#nav_duble{
			display:none;
		}
	}

	@media screen and (max-width: 59em) {
		#nav{
			display:none;
		}
		.a_nav{
			font-size:1.7em;
			font-weight:100;
			float:left;
			width:30%;
			border-right: 1px solid #258ecd;
		}

		#nav_top_prev{
			display:block;
		}
		/*#logo{
			width:20%;
		}*/
	}
	/*Стили модуля навигации*/
</style>
<nav id="nav">
	<a href="<?php echo HOSTS.'/'.$url; ?>">
		<img id="logo" src="<?=HOSTS; ?>/images/logo.png">
	</a>
	<div style="height:1px; border-bottom: 1px solid #258ecd;"></div>
	<?=$menu_top_left;?>
	<div id="button">
		<a onclick="javascript:spoiler('modal_results')" href="javascript:document.form.submit()" id="button_link">Оформить</a>
	</div>
</nav>

<nav id="nav_top_prev" onclick="javascript:modals('nav_duble')">
	<p>≡</p>
</nav>
<nav id="nav_duble" style="display:none;" onclick="javascript:modals('nav_duble')">
	<?=$menu_top_left;?>
	<a href="<?php echo HOSTS.'/'.$url; ?>">
		<img id="logo" src="<?=HOSTS; ?>/images/logo.png">
	</a>
	<div id="button">
		<a onclick="javascript:spoiler('modal_results')" href="javascript:document.form.submit()" id="button_link">Оформить</a>
	</div>
</nav>
<!--Конец навигация сайта-->