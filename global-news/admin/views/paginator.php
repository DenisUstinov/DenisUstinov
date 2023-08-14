<?php
	$TMPL['paginator'] = '';
	$paginator = $db->paginator();
	$i = 0;
	while($i++ < $paginator['num_pages']){
		$TMPL['page'] = $i;
		$TMPL['get'] = $paginator['get'];
		$TMPL['url_paginator'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$paginator['get'].'&page='.$i;
		if($i == $cur_page){
			$TMPL['class_link'] = 'active';
		}else{
			$TMPL['class_link'] = 'noactive';
		}
		$skin = new skin(DIRECTORI.'/admin/templates/paginator.html');
		$TMPL['paginator'] .= $skin->make();
	}
?>