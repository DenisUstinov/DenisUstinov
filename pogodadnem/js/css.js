window.onload = function myFunc (){
	width = document.body.clientWidth;//Измерили размер окна браузера
	var n_30 = 30;
	var n_48 = 48;
	var n_60 = 60;
	var n_100 = 100;
	var n_130 = 130;

	if(width >= 1366){
		var n_30 = width/45.53333333333333;
		var n_48 = width/28.45833333333333;
		var n_60 = width/22.76666666666667;
		var n_100 = width/13.66;
		var n_130 = width/10.50769230769231;
	}

	document.getElementById('body').style.fontSize=n_100+'%';  //Задали размер шрифта

	var links = document.getElementsByClassName('day');
	for(i=0; i < links.length; i++) {
		links[i].style.height=n_130+'px';  //Задали размер активной
		links[i].style.width=n_100+'px';  //Задали размер активной
	}
	var links = document.getElementsByClassName('img_prev');
	for(i=0; i < links.length; i++) {
		links[i].style.height=n_30+'px';  //Задали размер активной
		links[i].style.width=n_30+'px';  //Задали размер активной
	}
	var links = document.getElementsByClassName('img_details');
	for(i=0; i < links.length; i++) {
		links[i].style.height=n_48+'px';  //Задали размер активной
		links[i].style.width=n_48+'px';  //Задали размер активной
	}
	var links = document.getElementsByClassName('img_fact');
	for(i=0; i < links.length; i++) {
		links[i].style.height=n_60+'px';  //Задали размер активной
		links[i].style.width=n_60+'px';  //Задали размер активной
	}

	onload = myFunc;
	onresize = myFunc;
};