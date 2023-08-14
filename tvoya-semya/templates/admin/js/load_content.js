/* Функция подгрузки контента */
	function showContent(link){
		modal_visible('editor_modal');//Включить модальное окно
		var cont = document.getElementById('editor_content');
		cont.innerHTML = '';
		var http = createRequestObject();
		if (http) {
			http.open('get', link);
			http.onreadystatechange = function () {
				if (http.readyState == 4) {
					cont.innerHTML = http.responseText;
					//Текстовый редактор
					$(function(){
						$('#textarea').jqEditor({

							tags:{
								h2: '&lt;H2&gt;',
								h3: '&lt;H3&gt;',
								p: '&lt;p&gt;',
								b: '<b>&lt;b&gt;</b>',
								i: '<i>&lt;i&gt;</i>',
								ul: '&lt;ul&gt;',
								ol: '&lt;ol&gt;',
								li: '&lt;li&gt;',
								blockquote: '&lt;blockquote&gt;',
								a:{
									name: '&lt;a&gt;',
									attr_1: "href",
									attr_2: "alt",
									attr_3: "title"
								},
								img: {
									name: "&lt;img&gt;",
									pair: false,
									attr_1: "src",
									attr_2: "alt",
									attr_3: "title"
								}
							}
						});
					});
					//Текстовый редактор
				}
			}
			http.send(null);
		} else {
			document.location = link;
		}
	}
    // ajax объект
    function createRequestObject()  
    {  try { return new XMLHttpRequest() } 
        catch(e)  
        {  try { return new ActiveXObject('Msxml2.XMLHTTP') } 
            catch(e)  
            {   try { return new ActiveXObject('Microsoft.XMLHTTP') } 
                catch(e) { return null; }   } } } 
/* .Функция подгрузки контента */