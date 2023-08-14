window.onload = function myFunc (){
	width = document.body.clientWidth;//Измерили размер окна браузера
	var n_5 = 5;
	var n_10 = 10;
	var n_15 = 15;
	var n_20 = 20;
	var n_25 = 25;
	var n_40 = 40;
	var n_70 = 70;
	var n_80 = 80;
	var n_100 = 100;
	var n_170 = 170;
	var n_120 = 120;
	var n_650 = 650;

	if(width >= 1366){
		var n_5 = width/273.2;
		var n_10 = width/136.6;
		var n_15 = width/91.06666666666667;
		var n_20 = width/68.3;
		var n_25 = width/54.64;
		var n_40 = width/34.15;
		var n_70 = width/19.51428571428571;
		var n_80 = width/17.075;
		var n_100 = width/13.66;
		var n_170 = width/8.035294117647059;
		var n_120 = width/11.38333333333333;
		var n_650 = width/2.101538461538462;
	}

	document.getElementById('body').style.fontSize=n_100+'%';  //Задали размер шрифта
	document.getElementById('section').style.marginLeft=n_170+'px';  //Задали отступ контента
	document.getElementById('logo').style.paddingTop=n_15+'px';  //Задали отступы логотипа
	document.getElementById('logo').style.paddingBottom=n_15+'px';  //Задали отступы логотипа
	document.getElementById('logo').style.width=n_80+'px';  //Задали отступы логотипа
	document.getElementById('button').style.paddingTop=n_25+'px';  //Задали отступы кнопки
	document.getElementById('button_link').style.paddingRight=n_10+'px';  //Задали отступы кнопки
	document.getElementById('button_link').style.paddingLeft=n_10+'px';  //Задали отступы кнопки
	document.getElementById('button_link').style.paddingTop=n_5+'px';  //Задали отступы кнопки
	document.getElementById('button_link').style.paddingBottom=n_5+'px';  //Задали отступы кнопки
	document.getElementById('catalog').style.width=n_650+'px';  //Задали ширину каталога


	var links = document.getElementsByClassName('padd');
	for(i=0; i < links.length; i++) {
		links[i].style.paddingLeft=n_20+'px';//Задали отступы ссылок меню
		links[i].style.paddingRight=n_20+'px';//Задали отступы ссылок меню
		links[i].style.paddingTop=n_5+'px';//Задали отступы ссылок меню
		links[i].style.paddingBottom=n_5+'px';//Задали отступы ссылок меню
	}

	var imgs = document.getElementsByClassName('face_img');
	for(i=0; i < imgs.length; i++) {
		imgs[i].style.width=n_120+'px';//Задали отступы картинок каталога
	}

	var inputs = document.getElementsByClassName('input_catalog');
	for(i=0; i < inputs.length; i++) {
		inputs[i].style.width=n_40+'px';//Задали отступы картинок каталога
		inputs[i].style.height=n_70+'px';//Задали отступы картинок каталога
	}

	onload = myFunc;
	onresize = myFunc;
};