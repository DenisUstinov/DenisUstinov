window.onload = function myFunc (){
	var n_100 = 100;
	var n_1080 = 1080;

	width = document.body.clientWidth;
	if(width >= 1366){
		var n_100 = width/13.66;
		var n_1080 = width/1.264814814814815;
	}

	document.getElementById('body').style.fontSize=n_100+'%';
	document.getElementById('body').style.width=n_1080+'px';

	onload = myFunc;
	onresize = myFunc;
};