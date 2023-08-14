<?php
	class skin
	{
		var $filename;

		public function __construct($filename)
		{
			$this->filename = $filename;
		}

		public function make()
		{
			$file = sprintf('%s', $this->filename);
			$fh_skin = fopen($file, 'r');
			$skin = @fread($fh_skin, filesize($file));
			fclose($fh_skin);
			return $this->parse($skin);
		}

		private function parse($skin)
		{
			global $TMPL;
			$skin = preg_replace_callback('/{\$([a-zA-Z0-9_]+)}/', create_function('$matches', 'global $TMPL; return (isset($TMPL[$matches[1]])?$TMPL[$matches[1]]:"");'), $skin);
			return $skin;
		}
	
		public function content()
		{
			$content = $this->make();
			preg_match_all('#<([h][2-6])>(.*?)</([h][2-6])>#i', $content, $matches);

			if (count($matches[0]) >= 2) {
				$nav_article = '';
				$nav_article .= '<!--noindex--><div class="nav_article"><p>Содержание:</p><ul>';
				foreach ($matches[0] as $key => $headers) {

					$nav_article .= '<li class="li_'.$matches[1][$key].'"><a href="#header_'. $key.'">'.$matches[2][$key].'</a></li>';
					$content = str_replace($headers, '<'. $matches[1][$key] .' class="" id="header_'. $key.'">'. $matches[2][$key] .'</'. $matches[1][$key] .'>', $content);
				}
				$nav_article .= '</ul></div><!--/noindex-->';
				$content = str_replace('</h1>', '</h1>'.$nav_article, $content);
			}
			return $content;
		}
	}
?>