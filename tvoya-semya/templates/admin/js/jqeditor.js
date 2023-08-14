/**
 * Copyright 2014 by AKB[SIT]
 * Free to use any way you like.
 * Site: http://falbar.ru/
*/

(function($){

	jQuery.fn.jqEditor = function(options){

		var element = this;

		var method = {
			template: function(){

				var tmp  = '<div class="jqEditor-tags-bar">';

					for(name in settings.tags){

						if (!$.isPlainObject(settings.tags[name])){
							tmp += '<span class="icon_editor" data-tag="' + $.trim(name) + '">' + $.trim(settings.tags[name]) + '</span>';
						}else{

							var attrs = "",
								pair  = "";

							for(attr in settings.tags[name]){
								if (attr != 'name' && attr != 'pair'){
									attrs += settings.tags[name][attr] + ',';
								};

								if (attr == 'pair' && settings.tags[name].pair == false){
									pair = 'data-pair="0"';
								};	
							};

							tmp += '<span class="icon_editor" data-tag="' + $.trim(name) + '" data-attrs="' + attrs.substring(0, attrs.length-1) + '"' + pair + '>' + $.trim(settings.tags[name].name) + '</span>';
						};
					};

					tmp += '</div>';

				return tmp;
			},
			insert: function(startTag, endTag){

				var el = element.get(0);
				
				el.focus();

				var cursorPos = this.getCursor(el),
					txtPre 	  = el.value.substring(0, cursorPos.start),
					txt    	  = el.value.substring(cursorPos.start, cursorPos.end),
					txtAft 	  = el.value.substring(cursorPos.end);

				if (cursorPos.start == cursorPos.end){
					var nuCursorPos = cursorPos.start + startTag.length;
				}else{
					var nuCursorPos = String(txtPre + startTag + txt + endTag).length;
				}
				
				el.value = txtPre + startTag + txt + endTag + txtAft;
				this.setCursor(el, nuCursorPos, nuCursorPos);
			},
			getCursor: function(el){

				var result = {
					start: 0,
					end: 0
				};

				if (el.setSelectionRange){
					result.start= el.selectionStart;
					result.end = el.selectionEnd;
				}else if(!document.selection){
					return false;
				}else if(document.selection && document.selection.createRange){
					var range = document.selection.createRange();
					var stored_range = range.duplicate();
					stored_range.moveToElementText(el);
					stored_range.setEndPoint('EndToEnd', range);
					result.start = stored_range.text.length - range.text.length;
					result.end = result.start + range.text.length;
				}

				return result;
			},
			setCursor: function(el, start, end){
				if(el.createTextRange){
					var range = el.createTextRange();
					range.move("character", start);
					range.select();
				} else if(el.selectionStart){
					el.setSelectionRange(start, end);
				}
			},
			split: function(str, syb){
				var temp = new Array();
				temp = str.split(syb);
				return temp;
			}
		};

		var settings = $.extend({

			stapleL: "<",
			stapleR: ">",

			tags: {

				b: "Жирный",
				i: "Курсив",
				u: "Подчеркнутый"
			}

		}, options);

		return this.each(function(){

			element.wrapAll('<div class="jqEditor">')
				   .before(method.template());

			var bar = element.parents('.jqEditor')
							 .find('.jqEditor-tags-bar');

			bar.find('span').click(function(){

				var startElement  = "",
					endElement	  = "";
		
				var tagCode 	 = $(this).attr('data-tag'),
					tagCodeStart = tagCode,
					tagCodeEnd	 = tagCode;

				var attrs  	= $(this).attr('data-attrs');
				var pair  	= $(this).attr('data-pair');

				if (attrs){

					var attrsStr = "";

					attrsArr = method.split(attrs, ',');
					
					for (var i = 0; i < attrsArr.length; i++) {
						attrsStr += attrsArr[i] + '="" ';
					};

					tagCodeStart = tagCode + ' ' +  $.trim(attrsStr);
				};

				startElement = settings.stapleL + tagCodeStart + settings.stapleR;
				endElement 	 = settings.stapleL + '/'+ tagCodeEnd + settings.stapleR;

				if (!parseInt(pair) && pair != undefined){
					startElement = settings.stapleL + tagCodeStart + "/" + settings.stapleR;
					endElement = "";
				};

				method.insert(startElement, endElement);
			});
		});
	};

})(jQuery);