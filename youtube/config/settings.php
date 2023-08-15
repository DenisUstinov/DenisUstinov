<?php
$TMPL['templates'] = 'new';

// Запрос вывода на главной
$queryString = 'видео';

// Цвет сайта
$TMPL['color_site'] = '007b60';

// Настройки сео главной страницы
$TMPL['title_site'] = 'Видео';
$TMPL['description_site'] = 'Смотрите, скачивайте видео';
$TMPL['keywords_site'] = 'видео, ютюб, смотреть онлайн, скачать бесплатно, музыка, клипы, фильмы, обзоры, новинки, топы';
$TMPL['image_site'] = HOST.'/templates/'.$TMPL['templates'].'/images/standard.png'; // Картинка по умолчанию для постинга в социальную сеть

// Описание сайта
$TMPL['mail'] = 'website_024(собака)bk.ru';
$TMPL['main_description'] = '<h1>О сайте '.DOMAIN.'</h1><p>Привет! Тебе очень повезло и ты попал на '.DOMAIN.', где тебе всегда рады.</p>';

// Для вставки в <head></head>
$TMPL['head_site'] = '
<meta name="wmail-verification" content="dcb9ebe72e3173e759915d1725763611" />
<meta name="yandex-verification" content="bf7bab7e8f4f83c0" />
<script async src="https://pushprofit.ru/scripts/6/babf9d7d1491d1a0951b23d9bb9c5d4dfe3d7fce.js"></script>
';

// Для вставки в <footer></footer>
$TMPL['footer_site'] = '';

// Для вставки в <body></body>
$TMPL['body_site'] = '';

// Данные базы ключей
$keys_base = 'http://denisuu6.beget.tech/messageKeys.php';
$login = 'ZjuSfwG0OWAHsUH';
$password = 'pYAcUsvoQi9Z8SQ';

// Релевантные запросу ссылки
$relevantAdd = [
	'Приколы 2019' => '<a href="/search/ПРИКОЛЫ 2019" target="_blank">Приколы 2018</a><a href="/search/ПРИКОЛЫ 2019" target="_blank">Приколы 2018</a>',
	'Приколы 2018' => '<a href="/search/ПРИКОЛЫ 2019" target="_blank">Приколы 2018</a>',
	'Приколы 2017' => '<a href="/search/ПРИКОЛЫ 2019" target="_blank">Приколы 2017</a>'
];

// Рекламные блоки по сайту <div class="add">11111</div>
$TMPL['add_watch_top'] = '<!--noindex
						<iframe class="teaser" src="https://lechitesami.ru/add_folder/my-watch-top.php?width=100%&height=280px" framespacing="0" frameborder="no" scrolling="no" style="width:100%;min-height:280px"></iframe>
						<iframe class="teaser-mobile" src="https://lechitesami.ru/add_folder/my-watch-top.php?width=250px&height=520px" framespacing="0" frameborder="no" scrolling="no" style="margin:0 auto;max-width:250px;min-height:520px"></iframe>
						<!--/noindex-->';
$TMPL['add_watch_bottom'] = '<!--noindex-->
						<iframe class="teaser" src="https://lechitesami.ru/add_folder/my-watch-bottom.php?width=100%&height=280px" framespacing="0" frameborder="no" scrolling="no" style="width:100%;min-height:280px"></iframe>
						<iframe class="teaser-mobile" src="https://lechitesami.ru/add_folder/my-watch-bottom.php?width=250px&height=520px" framespacing="0" frameborder="no" scrolling="no" style="margin:0 auto;max-width:250px;min-height:520px"></iframe>
						<!--/noindex-->';
$TMPL['add_watch_sidebar_top'] = '';
$TMPL['add_watch_sidebar_related'] = '<!--noindex-->
						<iframe class="teaser" src="https://lechitesami.ru/add_folder/my-sidebar-top.php?width=100%&height=180px" framespacing="0" frameborder="no" scrolling="no" style="width:100%;min-height:180px"></iframe>
						<!--/noindex-->';
$TMPL['add_watch_sidebar_bottom'] = '';
$TMPL['category_top'] = '';
$TMPL['category_bottom'] = '';
$TMPL['add_modal'] = '<!-- Модальное окно -->
						<script>
							var delay_popup = 20000;
							setTimeout("document.getElementById(\'popup-bottom\').style.display=\'block\';", delay_popup);
						</script>
						<div id="popup-bottom" style="display:none;position:fixed;bottom:0;left:0;right:0;max-width:738px;margin:0 auto;padding:10px;background:#fff;box-shadow:0 0 15px rgba(0,0,0,0.5);z-index:10000">
							<a href="#" onclick="document.getElementById(\'popup-bottom\').style.display=\'none\'; return false;" style="position:absolute;width:35px;line-height:35px;top:-35px;right:0;background:red;font-size:35px;font-weight:bold;text-align:center;color:#e6f0ff;text-decoration:none;">X</a>
							<div style="background:#e6e6e6;">
								<!--noindex-->
								<iframe class="teaser" name="add_modal" src="https://lechitesami.ru/add_folder/popup.php?width=738px&height=220px" framespacing="0" frameborder="no" scrolling="no" style="width:738px;height:220px"></iframe>
								<a class="teaser-mobile" href="http://trvzzbhn.remedy-sale.com/" style="text-decoration:none;" target="_blank">
									<img style="display:block;max-width:250px;margin:0 auto;" src="https://vseokrohe.ru/add_folder/add_images/modal.png">
								</a>
								<!--/noindex-->
							</div>
						</div>
						<!-- Модальное окно -->';

// Вывод в похожих
$add_video = 'akm10Jv1gpM';

// Меню сайта по каналам
$nav_channel = [
'Смешные видео приколы' => 'UCHlxlOdu6MEsnW_rRFMhA7g',
'Aртур Видео Приколы' => 'UC3xT_JcBpFrbS6EMK0vaItA',
'РЫБАЛКА ВИДЕО ПРИКОЛЫ 2018' => 'UCEMrNi-P6uhLk1VG2BAJmZA',
'Самые смешные животные' => 'UCry2lRj7CWd4nA5ZJ_tn9yQ',
'Смешные Кошки - МатроскинТВ' => 'UC3Pg4sZOGeO1yvkUVs2nj0A',
'Эти смешные животные' => 'UCr3grBablGnDpyEN4po8Qmg',
'Талантливые Люди' => 'UCo8ZOITv6WRDvLMa2j2xVxw',
'Талантливые люди' => 'UCnuNk4lC1AXBHaTbC6uqDJg',
'Талантливые люди' => 'UCPfRXGjOKBC8ZJVSBGth8FQ',
'prikol show не для слабонервных' => 'UCVOtj0MP4vVnE4XDYbKCw7g',
'Приколы на Рыбалке 2018' => 'UCaKor13JpjZOByxRfBkxXUw',
'Подборка Жестов Не для слабонервным' => 'UCkucAzyiSSe3yO1VBqqkMrg',
'ВСЁ САМОЕ ИНТЕРЕСНОЕ!' => 'UCuccims6wITzfBUxm0jbxhQ',
'Всё самое интересное в интернете.' => 'UC_0Q63m6u180v9wEb6TQlSA',
'Ремонт Двигателя! И интересное!' => 'UCocyJMpBhS5xhQpFirqx29A',
'КРАСИВЫЕ ВИДЕО-ПОЗДРАВЛЕНИЯ, ПОЖЕЛАНИЯ' => 'UCcZab0tNI3EcBHDXKOVzeJg',
'САМЫЕ КРАСИВЫЕ ДЕВУШКИ ПИКАП ПРАНКИ' => 'UCqDBH8mYGRrYRNq-FFY52VA',
'Шокирующие, прикольные, красивые, восхитетельные и просто смешные видео.' => 'UCEWhAH1EmTdouT7F5UC8z_w',
'АВТОМОБИЛИ' => 'UC-1W6GKASWrqZfK45zFLapg',
'Иван Зенкевич PRO автомобили' => 'UCuWhsa1VzH2CB20aBmCmxQw',
'Alex Blare Культовые автомобили.' => 'UCOU4k-C0fJVfhxKOILbhCbw',
'Политика сегодня: Россия США Украина' => 'UCAyoyj6QDZR4HU_kOLrPSsg',
'ПОЛИТИКА ПЛЮС' => 'UCS2veaOFWmuVKL1ygIQwsIQ',
'Аналитика и Политика' => 'UCjUZV7V_A2k36LOEh_yzqTA',
'Телеканал Культура' => 'UCik7MxUtSXXfT-f_78cQRfQ',
'ACADEMIA | Канал Культура' => 'UCR06zdhHCypqnO4s7lpGMAg',
'Эхо Культура' => 'UCcNuyKUXXlLBdOJ1qVHlgPw',
'Barvina Sport' => 'UCIZXDdK4hSaLpBW9_14mVMQ',
'Спорт-Экспресс' => 'UCow8oFES_sFLjw5lEm9uGmQ',
'Спорт и Культура' => 'UCnbRqNmHmTVgljTNqNL4LDQ',
'Наука 2.0' => 'UCIi2Tk2POJkRgWHD7HGBa7Q',
'Цікава наука' => 'UCMIVE71tHEUDkuw8tPxtzSQ',
'НАУКА' => 'UCy_rs-R2JDbTa4vzU3rP4Ag',
'Своим Ходом - PRO Путешествия' => 'UCcwDl4Ur1bUfPK-R_FKJA4A',
'ПРО ПУТЕШЕСТВИЯ Богдан Булычёв' => 'UCgovv1nO7nnCwulSBa2Kjsw',
'Alexander Kondrashov' => 'UC0bwuabO4JHHa-BMs00pHnQ',
'FILMSTER' => 'UCOD2veMoMj5jy6K0pGt55Bw',
'ЭРОТИЧЕСКИЕ ФИЛЬМЫ HD' => 'UCCwPrN6gjKg66QomGdjnOgA',
'ФИЛЬМЫ СССР' => 'UCciAkFGfTbDhKyF_I6k7W5A',
'Советские мультфильмы' => 'UCWJs8oN4lpgPnKM_L-w5gCA',
'МУЛЬТФИЛЬМЫ - В ХОРОШЕМ КАЧЕСТВЕ' => 'UC0heQVoV8qLHH8xgzNI76qg',
'МультФильмы' => 'UCis_-DS9V2f9X0_Lm2CG7MQ',
'музыкальные видео клипы' => 'UC0E1ErJKZYhI9spy88c3pCA',
'Music' => 'UC-9-kyTW8ZkZNDHQJ6FgpwQ',
'Музыкальные открытки и Видео поздравления' => 'UCtjw_0bgKzfpfqiEV659tKw',
'Прохождение игр для девочек на ПК' => 'UCEXsC1fL9F3DShx7oFHFPug',
'PC игры' => 'UCgq9jEulRyX6rV3vWBcelTQ',
'Игры И Сборка Пк' => 'UC7nieWXEPkQ6FcH3feQYIMQ',
'Скечи и другие видео' => 'UCefPL6UlDwoMrLTnMKxDGlQ',
'другие видео' => 'UCnYjbJp9yLBn3WVNDmpX-lQ',
'Others Videos' => 'UChmJdf1g-MPsIdg_NbGjKVw',
'Онлайн уроки танцев с Шоу-балетом "Культурная революция"' => 'UCHMc6uzQYq_mR8bHy2YLzAg',
'Уроки Спортивной Гимнастики' => 'UCEz_7dFQjyhj234BuuZBfwA',
'Уроки Спорта' => 'UCilMcTHjVF9_itK7FPmxS1Q',
'Видеоуроки в Интернет' => 'UCmJWjnmz5rBdB7cDAWW4dAg',
'Уроки по YouTube' => 'UCeh7FIGPyL4SYdbWGjgaSiw',
'Школа 1С - видеоуроки бесплатно' => 'UCS_K2CIhhAjVhsDnulDJLCg',
'Александр Лисицын' => 'UCRRD6XJkWPtKFYnF4aEpEAw',
'Мужское хобби' => 'UC5dxen6XMxRhfvVEm0k9mLQ',
'Мужские Хобби' => 'UCQO5rdyFARbnL7UXS3yrF0w',
'90-60-90 | Спортивные девушки' => 'UC48c6ABk2JcVBntKnJJ8SPA',
'Девушки и Спорт' => 'UCM-eqwvM8ah-E8sSiPNGxug',
'Девушки +СПОРТ' => 'UC1dZsk3QuvfemOWE0GZ6GtA',
'Онлайн уроки танцев с Шоу-балетом "Культурная революция"' => 'UCHMc6uzQYq_mR8bHy2YLzAg',
'ANDRII DIATEL *DANCE TUTORIALS*' => 'UCJgpuxPfFGGYlj4w6Azz1Bg',
'DragonsDanceStudio' => 'UC-fEo4_LHvnUh3oYlt9kccQ',
'Азбука Рисования' => 'UCktiC07wsJGQQJGv9WnYVXA',
'УРОКИ РИСОВАНИЯ' => 'UC-D-mzENfsIQiS5r_YqS--Q',
'Уроки рисования' => 'UCad-iuGqP9ZTUkIdsRt6NpQ',
'Рукоделие ТV' => 'UC5g-Divz10f7Xy67M3xJ5Ug',
'Best РУКОДЕЛИЕ' => 'UCmvgKkPs5KSUyEeswloL0oQ',
'Рукоделие дома' => 'UCa1s_w96Nndg7Syo6NOy8bg',
'Poli na Palme - маски, уход за собой' => 'UC-zXU5jze5SI2fERacgCStg',
'КСЕНИЯ ЗАВИЗИОН / Beauty Ksu' => 'UCvHkBcFeSWwD9PNvjtiD7KQ',
'Салон красоты' => 'UCYlSZEcdhecWsHxjznTpu5A',
'Интересная медицина' => 'UCRGb5aGqsjdec25dNFEAuCg',
'Медицина и здоровье' => 'UCIlDkDriTzrtEBMrpqElHRw',
'Медицина для СТУДЕНТОВ' => 'UC8-4bi8WSh09msKqiZ_Vr5g',
'Сима Все для мам' => 'UC3Ic7TrXijXh-L0FgUShG-Q',
'Лучшее от мамы' => 'UCEgH20vN5aqMACl2Ar2t6wA',
'Любящие мамы' => 'UCee6QJgYP7d2HGPLXn1bOmA',
'Кулинарные видео рецепты Video Cooking' => 'UCAfsdV8TQJsD0bE5mmJAHfw',
'Кулинария. Видео рецепты' => 'UClHScyX5MupK8LBel4AFXzA',
'КУХНЯ Видео Рецепты' => 'UCfXmGVbDQvRN5b2zZFA1sDQ',
'Домашнее Хозяйство' => 'UCwPLYgowCLWNRArgYcOHiuw',
'domahnee hozaystvo' => 'UCvYXzUriIt6w-mkzPaaDmng',
'Домашнее хозяйство' => 'UC38b8FB9q2Kssmcu1vJ7aXg',
'Случайное Видео' => 'UCg6Ee2eQaFqplziIspzak3Q',
'Random Video / Случайное Видео' => 'UCJe--3WfWuemCAk4eeS2T7A',
'СлУчАйНыЕ ВиДеО На YouTub' => 'UCZyH18WtqgbkQmrqVoUOTUw'
];

// Меню сайта по запросам
$nav = [
'4K видео',
'8K видео',
'Go Go',
'GTA',
'Seo-оптимизация',
'The Forest',
'World of Tanks',
'Альтернативные концовки',
'Английский язык',
'Аниме-мультики',
'Армейские',
'АСМР',
'Атмосферные звуки',
'Аудио стихи',
'Аудиокниги',
'Аудиосказки',
'Аэробика',
'Балеты',
'Баскетбол',
'Басни',
'Бизнес-идеи',
'Бизнес-Тренинги',
'Биографии людей',
'Бисероплетение',
'Бодифлекс',
'Бокс',
'Брейк данс',
'Бутерброды',
'Варенье',
'Взрывы',
'Видео приколы',
'Виртуальная реальность',
'Военные',
'Война в Сирии',
'Воспитание ребенка',
'Восточные танцы',
'Вторые блюда',
'Выпечка',
'Вышивка крестиком',
'Вьетнам',
'Вязание',
'Гитара',
'Гонки',
'Грузия',
'Грузовики',
'Десерты',
'Дети танцуют',
'Детская психология',
'Детское питание',
'Диафильмы',
'Диеты',
'Дикий мир',
'Для беременных',
'Документальное кино',
'Драки',
'Дрессировка собак',
'Другие страны',
'ДТП-аварии',
'Женские стрижки',
'Жеские прически',
'Жесть',
'Животноводство',
'Забавные лисы',
'Завтраки',
'Загадки',
'Зоопарк видео',
'Изготовление алкоголя',
'Изготовление мебели',
'Изобретения будущего',
'Индийские фильмы',
'Индия',
'Инструкции',
'Интересно танцуют',
'Интересное',
'Интернет',
'Йога',
'Йо-Йо',
'Италия',
'Каверы Перепевки',
'Калланетика',
'Караоке',
'Катастрофы',
'КВН',
'Киндер сюрприз',
'Кипр',
'Клипы для тренировки',
'Коктейли',
'Колбаса',
'Колыбельные песни',
'Концерты',
'Короткометражки',
'Космос',
'Красиво поют',
'Криминал',
'Крутые машины',
'Куклы Барби',
'Лайфхаки',
'Лепка из пластилина',
'Лечение болезней',
'Майнкрафт',
'Макияж',
'Маникюр',
'Марокко',
'Мексика',
'Мистика',
'Молитвы православные',
'Мотоциклы',
'Мужские стрижки',
'Мужской макияж',
'Музыкальные клипы',
'Музыкальные хиты 2000',
'Мультиварка',
'Мультики СССР',
'Мультсериалы детские',
'Мюзиклы',
'На скорую руку',
'Наркоманы',
'Народная медицина',
'Научные эксперименты',
'Необъяснимое в мире',
'Новогодние украшения',
'О политике',
'Обзоры автомобилей',
'Обман зрения',
'Обучение массажу',
'Обучение фокусам',
'Огород на подоконнике',
'Оперы',
'Оформление бровей',
'Охота',
'Педикюр',
'Первая мед. помощь',
'Переезд на ПМЖ',
'Пилатес',
'Платные фильмы',
'Плетение из резинок',
'Плетение косичек',
'Познавательное',
'Половая жизнь',
'Правила безопасности',
'Пранки',
'Приколы на дорогах',
'Приколы про собак',
'Приколы с животными',
'Приколы с пьяными',
'Про айфон',
'Про любовь',
'Про религию Ислам',
'Про СССР',
'Про школьников',
'Происшествия',
'Психология',
'Птицеводство',
'Путин',
'Пчеловодство',
'Радиоспектакли',
'Развивающие видео',
'Развивающие мультики',
'Разные видео',
'Разные танцы',
'Резьба по дереву',
'Рекорды Гиннеса',
'Ремонт квартиры',
'Рецепты на Новый год',
'Рисование',
'Рисование акварелью',
'Рисование в клеточку',
'Рисование в стиле аниме',
'Рисование в стиле чиби',
'Рисование гуашью',
'Рисование для детей',
'Рисование карандашом',
'Розыгрыши',
'Роллы',
'Российские сериалы',
'Русалочка-Дисней',
'Русские мелодрамы',
'Русские сказки',
'Рыбалка',
'Сад, огород',
'Салаты',
'Самозащита для мужчин',
'Самооброна для женщин',
'Саморазвитие',
'Свадебные приколы',
'Сериал Элеон',
'Сковорода гриль',
'Скороговорки',
'Смешная реклама',
'Смешные дети',
'Смешные кошки',
'Смотреть Всем',
'Советские фильмы',
'Советы водителю',
'Советы на кухне',
'Советы путешественникам',
'Советы хозяйкам',
'Сотрудники ДПС',
'Сохраняем красоту',
'Спектакли театра',
'Спорт приколы',
'Спортзал и фитнес',
'Страхование',
'Стрип пластика',
'Строительство дома',
'Супы',
'США',
'Таиланд',
'Таланты во всем',
'Татарский язык',
'Телеспектакли',
'Торты',
'Трейлеры',
'Туризм на природе',
'Украина',
'Уродства людей',
'Уроки вождения',
'Уроки игры в покер',
'Уроки татуировки',
'Уход за кошкой',
'Учим фотографировать',
'Фейлы и падения',
'Фигурное катание',
'Филиппины',
'Фильмы для глухих',
'Фильмы для детей',
'Фильмы о природе',
'Фитнес',
'Флешмобы',
'Формула-1',
'Фортепиано',
'Фотошоп',
'Французский язык',
'Футбол',
'Хенд мейд',
'Хип Хоп',
'Хлебопечка',
'Хоккей',
'Цветоводство',
'Цирк',
'Ча-Ча-Ча',
'Чем занять ребенка',
'Шитье',
'Шитье игрушек',
'Шри-Ланка',
'Экстрим',
'Этикет',
'Ютуб музыка',
'Ютуб мультфильмы',
'Ютуб радио',
'Ютуб фильмы'
];