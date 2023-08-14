<?php

	/**
	 * Вид формирования карты сайта
	 *
	 */
	$TMPL['sitemap'] = '';
	foreach($categories as $catval)
	{
		$TMPL['class'] = 'li_big';
		$TMPL['title'] = $catval['name_categories'];
		$TMPL['url'] = HOST.'/'.$catval['url_categories'];
		$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/rows_sitemap_html.html');
		$TMPL['rows_sitemap_html'] = $skin->make();

		foreach($subcategories as $subcatval)
		{
			if($catval['id'] == $subcatval['category_subcategories'])
			{
				$TMPL['class'] = 'li_normal';
				$TMPL['title'] = $subcatval['name_subcategories'];
				$TMPL['url'] = HOST.'/'.$catval['url_categories'].'/'.$subcatval['url_subcategories'];
				$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/rows_sitemap_html.html');
				$TMPL['rows_sitemap_html'] .= $skin->make();

				foreach($articles as $articles_value)
				{
					if($subcatval['id'] == $articles_value['subcategory_articles'])
					{
						$TMPL['class'] = 'li_small';
						$TMPL['title'] = $articles_value['header_articles'];
						$TMPL['url'] = HOST.'/'.$catval['url_categories'].'/'.$subcatval['url_subcategories'].'/'.$articles_value['url_articles'].'.html';
						$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/rows_sitemap_html.html');
						$TMPL['rows_sitemap_html'] .= $skin->make();
					}
				}
			}
		}
		$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/view_sitemap_html.html');
		$TMPL['sitemap'] .= $skin->make();
	}
				/* Для SEO сайта */
				$TMPL['navigation_string'] .= ' → <a title="Карта сайта">Карта сайта</a>';
				$TMPL['preview_settings'] = '';
				$TMPL['title_settings'] = 'Карта сайта';
				$TMPL['description_settings'] = 'Карта сайта ТвояСемья.рф';
				$TMPL['keywords_settings'] = '';
				/* Для SEO сайта */
	$skin = new skin(DIRECTORY.'/templates/'.$settings['template_settings'].'/view_sitemap.html');
	$TMPL['content'] .= $skin->make();