<?php

	/**
	 * Вид формирования карты сайта
	 *
	 */
	$TMPL['sitemap'] = '';
	foreach($categories as $catval)
	{
		$TMPL['rows_sitemap_html'] = '';

		$TMPL['class'] = 'li_big';
		$TMPL['title'] = $catval['name_categories'];
		$TMPL['url'] = HOST.'/'.$catval['url_categories'];
		$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/rows_sitemap_html.html');
		$TMPL['categories'] = $skin->make();

		foreach($subcategories as $subcatval)
		{
			if($catval['id'] == $subcatval['category_subcategories'])
			{
				$data = $db->getAll("SELECT * FROM articles WHERE subcategory_articles = ?s", $subcatval['id']);
				if(count($data))
				{
					$TMPL['class'] = 'li_normal';
					$TMPL['title'] = $subcatval['name_subcategories'];
					$TMPL['url'] = HOST.'/'.$catval['url_categories'].'/'.$subcatval['url_subcategories'];
					$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/rows_sitemap_html.html');
					$TMPL['rows_sitemap_html'] .= $skin->make();
					foreach($data as $data_value)
					{
						$TMPL['class'] = 'li_small';
						$TMPL['title'] = $data_value['header_articles'];
						$TMPL['url'] = HOST.'/'.$catval['url_categories'].'/'.$subcatval['url_subcategories'].'/'.$data_value['url_articles'];
						$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/rows_sitemap_html.html');
						$TMPL['rows_sitemap_html'] .= $skin->make();
					}
				}
			}
		}
		if($TMPL['rows_sitemap_html'])
		{
			$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/view_sitemap_html.html');
			$TMPL['sitemap'] .= $skin->make();
		}
	}
	$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/view_sitemap.html');
	$TMPL['content'] .= $skin->make();