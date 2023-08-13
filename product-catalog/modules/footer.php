		<style>
			footer {
				font-size:1.0em;
				padding-top:4%;
				text-align:center;
			}
		</style>
		<!--Футер сайта-->
		<footer>
			<p><?=$Year = strftime('%Y');?> © ООО Белла Сибирь</p><br>
		</footer>
		<!--Конец футер сайта-->

		<!-- Скрипт слайдера -->
		<script type="text/javascript" src="<?=HOSTS; ?>/js/slides.js"></script>
		<!-- /Скрипт слайдера -->

        <!-- Yandex.Metrika counter -->
        <script type="text/javascript">
        (function (d, w, c) {
            (w[c] = w[c] || []).push(function() {
                try {
                    w.yaCounter33829154 = new Ya.Metrika({id:33829154,
                            webvisor:true,
                            clickmap:true,
                            trackLinks:true,
                            accurateTrackBounce:true,
                            trackHash:true,
                            ut:"noindex"});
                } catch(e) { }
            });
        
            var n = d.getElementsByTagName("script")[0],
                s = d.createElement("script"),
                f = function () { n.parentNode.insertBefore(s, n); };
            s.type = "text/javascript";
            s.async = true;
            s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js";
        
            if (w.opera == "[object Opera]") {
                d.addEventListener("DOMContentLoaded", f, false);
            } else { f(); }
        })(document, window, "yandex_metrika_callbacks");
        </script>
        <noscript><div><img src="//mc.yandex.ru/watch/33829154?ut=noindex" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->
	</body>
</html>
<?php
	if (isset($_GET["page"])){
		if($_GET["page"] != 'admin2015'){
			$buffer = ob_get_contents();
			ob_end_flush(); 
			$fp = fopen(DIRECTORI.'/cache/index_'.$_GET["page"].'.cache', 'w'); 
			fwrite($fp, $buffer); 
			fclose($fp);
		}
	}else{
		$buffer = ob_get_contents();
		ob_end_flush(); 
		$fp = fopen(DIRECTORI.'/cache/index.cache', 'w'); 
		fwrite($fp, $buffer); 
		fclose($fp);
	}