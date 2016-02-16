-- phpMyAdmin SQL Dump
-- version 4.4.7
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Ноя 18 2015 г., 10:43
-- Версия сервера: 5.6.26-log
-- Версия PHP: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `gis`
--

-- --------------------------------------------------------

--
-- Структура таблицы `gis_category`
--

CREATE TABLE IF NOT EXISTS `gis_category` (
  `id` int(11) unsigned NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `locale` varchar(10) NOT NULL DEFAULT 'en_US',
  `category_position` tinyint(4) NOT NULL DEFAULT '0',
  `category_title` varchar(255) DEFAULT NULL,
  `category_description` text,
  `category_color` varchar(20) DEFAULT NULL,
  `category_image` varchar(255) DEFAULT NULL,
  `category_image_thumb` varchar(255) DEFAULT NULL,
  `category_visible` tinyint(4) NOT NULL DEFAULT '1',
  `category_trusted` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COMMENT='Holds information about categories defined for a deployment';

--
-- Дамп данных таблицы `gis_category`
--

INSERT INTO `gis_category` (`id`, `parent_id`, `locale`, `category_position`, `category_title`, `category_description`, `category_color`, `category_image`, `category_image_thumb`, `category_visible`, `category_trusted`) VALUES
(1, 0, 'uk_UA', 0, 'ТТУ', 'Тяжкі тілесні ушкодження', 'ff0000', NULL, NULL, 1, 0),
(2, 0, 'uk_UA', 1, 'Вбивства', 'Вбивства', 'd12323', NULL, NULL, 1, 0),
(3, 0, 'uk_UA', 2, 'Розбій', 'Розбій', '00ff88', NULL, NULL, 1, 0),
(4, 0, 'uk_UA', 3, 'Торгівля людьми', 'Торгівля людьми', 'ffd900', NULL, NULL, 1, 0),
(5, 0, 'uk_UA', 4, 'Згвалтування', 'Згвалтування', '3a10e3', NULL, NULL, 1, 0),
(6, 0, 'uk_UA', 5, 'Корупція', 'Корупція', 'e66007', NULL, NULL, 1, 0),
(7, 0, 'uk_UA', 6, 'Шахрайство', 'Шахрайство', 'd10fd1', NULL, NULL, 1, 0),
(8, 0, 'uk_UA', 7, 'Грабіж', 'Грабіж', '77de1d', NULL, NULL, 1, 0),
(9, 0, 'uk_UA', 8, 'Контрабанда', 'Контрабанда', '00ff2b', NULL, NULL, 1, 0),
(10, 0, 'uk_UA', 9, 'Крадіжка', 'Крадіжка', 'd67513', NULL, NULL, 1, 0),
(11, 0, 'uk_UA', 10, 'Хуліганство', 'Хуліганство', '07e8bb', NULL, NULL, 1, 0),
(12, 15, 'uk_UA', 12, 'Мітинг', 'Мітинг', 'd0e303', NULL, NULL, 1, 0),
(13, 15, 'uk_UA', 13, 'Масові безлади', 'Масові безлади', '7911bf', NULL, NULL, 1, 0),
(14, 15, 'uk_UA', 14, 'Акції протеста', 'Акції протеста', 'db5d14', NULL, NULL, 1, 0),
(15, 0, 'uk_UA', 11, 'Масові заходи', 'Масові заходи', '286309', NULL, NULL, 1, 0),
(16, 0, 'uk_UA', 15, 'ДТП', 'ДТП', '0f4ccf', NULL, NULL, 1, 0),
(17, 22, 'uk_UA', 19, 'Стихійне лихо', 'Стихійне лихо', '383621', NULL, NULL, 1, 0),
(18, 22, 'uk_UA', 17, 'Біологічного характеру', 'Біологічного характеру', '0b6100', NULL, NULL, 1, 0),
(19, 0, 'uk_UA', 20, 'ЗЗС пов`язані з незаконним оббігом наркотиків', 'ЗЗС пов`язані з незаконним оббігом наркотиків', '561799', NULL, NULL, 1, 0),
(20, 0, 'uk_UA', 21, 'Інше', 'Інше', '000000', NULL, NULL, 1, 0),
(21, 22, 'uk_UA', 18, 'Пожежа', 'Пожежа', 'c78f16', NULL, NULL, 1, 0),
(22, 0, 'uk_UA', 16, 'Надзвичайні події', 'Надзвичайні події', '12c72a', NULL, NULL, 1, 0),
(23, 0, 'uk_UA', 22, 'Розшук', 'Розшук', 'd911cf', NULL, NULL, 1, 0),
(24, 23, 'uk_UA', 23, 'Неповнолітні', 'Неповнолітні', '31e312', NULL, NULL, 1, 0),
(25, 23, 'uk_UA', 24, 'Безвісті зникші', 'Безвісті зникші', 'a1540b', NULL, NULL, 1, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `gis_category`
--
ALTER TABLE `gis_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_visible` (`category_visible`),
  ADD KEY `parent_id` (`parent_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `gis_category`
--
ALTER TABLE `gis_category`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
