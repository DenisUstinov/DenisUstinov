window.onload = function myFunc (){
	width = document.body.clientWidth;//Измерили размер окна браузера
	var n_100 = 100;
	var n_750 = 750;
	
	if(width >= 1366){
		var n_100 = width/13.66;
		var n_750 = width/1.821333333333333;
	}

	if(width <= 1366){
		var n_100 = width/13.66;
		var n_750 = width/1.821333333333333;
	}

	document.getElementById('body').style.fontSize=n_100+'%';  //Задали размер шрифта
	document.getElementById('metka').style.maxWidth=n_750+'px';  //Задали размер шрифта

	onload = myFunc;
	onresize = myFunc;
};