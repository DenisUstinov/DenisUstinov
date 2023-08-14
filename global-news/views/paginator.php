<?php
	$TMPL['paginator'] = '';
	$TMPL['rows_paginator'] = '';
	$paginator = $db->paginator();
	$i = 0;
	while($i++ < $paginator['num_pages'])
	{
		$TMPL['page'] = $i;
		$TMPL['get'] = $paginator['get'];
		$TMPL['url_paginator'] = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'?'.$paginator['get'].'&page='.$i;
		if($i == $cur_page){
			$TMPL['class_link'] = 'active disable';
		}else{
			$TMPL['class_link'] = 'noactive';
		}
		$skin = new skin(DIRECTORI.'/templates/rows_paginator.html');
		$TMPL['rows_paginator'] .= $skin->make();
	}
	$skin = new skin(DIRECTORI.'/templates/paginator.html');
	$TMPL['paginator'] .= $skin->make();
?>