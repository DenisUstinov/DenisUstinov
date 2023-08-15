<?
//https://www.wphook.ru/rasnoe/compress-html.html
class Compress_HTML {
    protected $compress_css = false; //сжатие css (true - включено)
    protected $compress_js = false; //сжатие js-скриптов (true - включено)
    protected $info_comment = true; //вывод информации о сжатии (было - стало)
    protected $remove_comments = true; //комментарии в коде
    protected $html;

    public function __construct($html)
    {
		if (!empty($html)) {
			$this->parseHTML($html);
		}
	}

    public function __toString()
    {
		return $this->html;
	}

    protected function bottomComment($raw, $compressed)
	{
        $raw = strlen($raw);
        $compressed = strlen($compressed);
        $savings = ($raw-$compressed) / $raw * 100;
        $savings = round($savings, 2);
        return '<!--HTML compressed, size saved '.$savings.'%. From '.$raw.' bytes, now '.$compressed.' bytes-->';
	}

    protected function minifyHTML($html)
	{
        $pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
        preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
        $overriding = false;
        $raw_tag = false;
        $html = '';
        foreach ($matches as $token) {
            $tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
            $content = $token[0];
            if (is_null($tag)){
                if ( !empty($token['script']) ){
					$strip = $this->compress_js;
				} elseif (!empty($token['style'])){
					$strip = $this->compress_css;
				} elseif ($content == '<!--wp-html-compression no compression-->') {
					$overriding = !$overriding; continue;
				} elseif ($this->remove_comments) {
					if (!$overriding && $raw_tag != 'textarea') {
						//$content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);// Затерает коментарии <!--noindex-->
					}
				}
            } else{
                if ($tag == 'pre' || $tag == 'textarea') {
					$raw_tag = $tag;
				} elseif ($tag == '/pre' || $tag == '/textarea') {
					$raw_tag = false;
				} else {
					if ($raw_tag || $overriding) {
						$strip = false;
					} else {
						$strip = true;
						$content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
						$content = str_replace(' />', '/>', $content);
					}
				}
			}
            if ($strip) {
				$content = $this->removeWhiteSpace($content);
			}
            $html .= $content;
		}
        return $html;
	}

    public function parseHTML($html)
	{
        $this->html = $this->minifyHTML($html);
        if ($this->info_comment) {
			$this->html .= "\n" . $this->bottomComment($html, $this->html);
		}
	}

    protected function removeWhiteSpace($str)
	{
        $str = str_replace("\t", ' ', $str);
        $str = str_replace("\n",  '', $str);
        $str = str_replace("\r",  '', $str);
        while (stristr($str, '  ')) {
			$str = str_replace('  ', ' ', $str);
		}
        return $str;
	}
}
function wp_html_compression_finish($html){return new Compress_HTML($html);}
function wp_html_compression_start(){ob_start('wp_html_compression_finish');}