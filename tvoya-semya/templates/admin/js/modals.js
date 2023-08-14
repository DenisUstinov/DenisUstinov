/* Функция модального окна */
	function modal_visible(id){
		document.getElementById(id).style.display = "";
		document.body.style.overflow = "hidden";
		//document.html.style.margin = "0 17px 0 0";
	}
	function modal_hidden(id){
		document.getElementById(id).style.display = "none";
		document.body.style.overflow = "visible";
		//document.getElementById('html').style.margin = "0";
	}
/* .Функция модального окна */