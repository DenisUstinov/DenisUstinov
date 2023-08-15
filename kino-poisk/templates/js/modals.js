/* Функция модального окна */
	function modal_visible(id){
		document.getElementById(id).style.display = "";
		document.getElementById('body').style.overflow = "hidden";
	}
	function modal_hidden(id){
		document.getElementById(id).style.display = "none";
		document.getElementById('body').style.overflow = "visible";
	}
/* .Функция модального окна */