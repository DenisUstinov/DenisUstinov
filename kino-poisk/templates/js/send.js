$( document ).ready(function() {
	$("#btn").click(
		function(){
			sendAjaxForm('result_form', 'form_mail', 'send.php');
			return false; 
		}
	);
});
 
function sendAjaxForm(result_form, ajax_form, url) {
	if (validateEmail() && validateName()) {
		jQuery.ajax({
			url:     url, //url страницы (action_ajax_form.php)
			type:     "POST", //метод отправки
			dataType: "html", //формат данных
			data: jQuery("#"+ajax_form).serialize(),  // Сеарилизуем объект
			success: function(response) { //Данные отправлены успешно
				result = jQuery.parseJSON(response);
				document.getElementById(result_form).innerHTML = "<p class='send'>Нет ошибки.  "+result.article;
				document.getElementById(ajax_form).reset();
			},
			error: function(response) { // Данные не отправлены
				document.getElementById(result_form).innerHTML = "<p class='send'>Ошибка. Данные не отправленны.</p>";
			}
		});
		modal_hidden('modal');
	}else return false;
}
//http://truemisha.ru/blog/javascript/javascript-validation.html

function validateEmail(){
	var x=document.forms["form_mail"]["email"].value;
	var atpos=x.indexOf("@");
	var dotpos=x.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length){
		document.getElementById('em').innerHTML = 'ВВЕДИТЕ КОРЕКТНЫЙ EMAIL';
		return false;
	} else {
		document.getElementById('em').innerHTML = '';
		return true;
	}
}

function validateName(){
	var x=document.forms["form_mail"]["text"].value;
	if (x.length > 500) {
		document.getElementById('au').innerHTML = 'СЛИШКОМ МНОГО СИМВОЛОВ';
		return false;
	} else if (x.length <= 0) {
		document.getElementById('au').innerHTML = 'ВВЕДИТЕ ВАШЕ СООБЩЕНИЕ';
		return false;
	} else {
		document.getElementById('au').innerHTML = '';
		return true;
	}
}