/*
 * Функция зависимого списка для админки
 *
 */



function myFunc(el)
{
	var inputs_none = document.getElementsByClassName('none');
	for(i=0; i < inputs_none.length; i++) {
		inputs_none[i].style.display='none';
	}//скрыли все элементы

	var inputs_name = document.getElementsByClassName('name');
	for(i=0; i < inputs_name.length; i++) {
		inputs_name[i].removeAttribute('name');
	}//убрали все имена

	k = el.options[el.selectedIndex].value;

	var inputs_none = document.getElementsByClassName(k);
	for(i=0; i < inputs_none.length; i++) {
		inputs_none[i].style.display='block';
	}

	var inputs_name = document.getElementsByClassName('i'+k);
	for(i=0; i < inputs_name.length; i++) {
		inputs_name[i].setAttribute('name', 'subcategory_articles');
	}
}