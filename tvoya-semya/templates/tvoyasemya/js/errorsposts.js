jQuery(function(){
	jQuery(document).keydown(function (e) {
		if ((e.ctrlKey && e.keyCode == 13) || (e.metaKey && e.keyCode == 13)) {
			e.preventDefault();
			var text = "";
		    if (window.getSelection) {
		        text = window.getSelection().toString();
		    } else if (document.selection && document.selection.type != "Control") {
		        text = document.selection.createRange().text;
		    }

		    if(text!==''){
		    	jQuery.ajax({
		    		url: 'molly.submit.php',
		    		type: 'post',
		    		data: 'text='+text
		    	});
		    }
		}
	});
});