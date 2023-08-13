<?php
	error_reporting(E_ALL);
	require_once ('includs.php');

	/* Определяем контент для загрузки */
	if(isset($_GET['page']) && $_GET['page'] == 'admin2015'){
		require_once(DIRECTORI.'/modules/admin2015.php');// Админ панель сайта
	}else{
		require_once (DIRECTORI.'/modules/header.php');// Шапка сайта
		require_once(DIRECTORI.'/modules/modal.php');// Модальное окно
		require_once(DIRECTORI.'/modules/content.php');// Каталог товаров
		require_once(DIRECTORI.'/modules/menu.php');// Боковое меню сайта
		require_once (DIRECTORI.'/modules/footer.php');// Футер сайта
	}
	/* .Определяем контент для загрузки */
?>
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