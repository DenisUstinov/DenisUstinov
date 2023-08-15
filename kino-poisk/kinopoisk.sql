-- phpMyAdmin SQL Dump
-- version 4.0.10.10
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 14 2017 г., 13:18
-- Версия сервера: 5.5.45
-- Версия PHP: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `kinopoisk`
--

-- --------------------------------------------------------

--
-- Структура таблицы `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Комментарий',
  `id_articles` int(11) NOT NULL COMMENT 'Комментарий',
  `title_articles` varchar(200) NOT NULL COMMENT 'Комментарий',
  `description_articles` varchar(300) NOT NULL COMMENT 'Комментарий',
  `ru_header_articles` varchar(200) NOT NULL COMMENT 'Комментарий',
  `en_header_articles` varchar(200) NOT NULL COMMENT 'Комментарий',
  `text_articles` varchar(2000) NOT NULL COMMENT 'Комментарий',
  `tags_articles` varchar(1000) NOT NULL COMMENT 'Комментарий',
  PRIMARY KEY (`id`),
  FULLTEXT KEY `text_articles` (`ru_header_articles`,`en_header_articles`,`text_articles`,`tags_articles`),
  FULLTEXT KEY `tags_articles` (`tags_articles`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='table_articles' AUTO_INCREMENT=2 ;

--
-- Дамп данных таблицы `articles`
--

INSERT INTO `articles` (`id`, `id_articles`, `title_articles`, `description_articles`, `ru_header_articles`, `en_header_articles`, `text_articles`, `tags_articles`) VALUES
(1, 319, '', '', 'Терминатор 3: Восстание машин', 'Terminator 3: Rise of the Machines', 'Прошло десять лет с тех пор, как Джон Коннор помог предотвратить Судный День и спасти человечество от массового уничтожения. Теперь ему 25, Коннор не живет «как все» — у него нет дома, нет кредитных карт, нет сотового телефона и никакой работы.\n\nЕго существование нигде не зарегистрировано. Он не может быть прослежен системой Skynet — высокоразвитой сетью машин, которые когда-то попробовали убить его и развязать войну против человечества. Пока из теней будущего не появляется T-X — Терминатрикс, самый сложный киборг-убийца Skynet. Посланная назад сквозь время, чтобы завершить работу, начатую ', 'Год: 2003\nСтрана: США, Германия, Великобритания\nЖанр: фантастика, боевик, триллер, приключения\nАктеры: Арнольд Шварценеггер, Ник Стал, Клэр Дэйнс, Кристанна Локен, Дэвид Эндрюс, Марк Фамиглетти, Эрл Боэн, Мойра Харрис, Чоппер Бернет, Кристофер Лоуфорд\nСценарий: Джон Бренкето, Майкл Феррис, Джеймс Кэмерон\nРежиссер: Джонатан Мостоу\nПродюсер: Хэл Либерман, Джоэль Б. Майклс, Эндрю Дж. Вайна\nКомпозитор: Марко Белтрами\nБюджет: $200 000 000\nМировая премьера: 30 июня 2003');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
