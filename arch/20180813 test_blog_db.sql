-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 13 2018 г., 22:58
-- Версия сервера: 5.6.38
-- Версия PHP: 7.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `test_blog_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `author_id` int(10) UNSIGNED DEFAULT NULL,
  `pub_date` datetime DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `post_body` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `author_id`, `pub_date`, `title`, `post_body`) VALUES
(1, 4, '2018-01-01 01:00:00', 'titl YCATVg', 'postik YCATVWaslZVKorbrCOwi'),
(2, 4, '2018-01-01 01:00:00', 'titl niFWrg', 'postik niFWrOMWXOaBvmecGXgp'),
(3, 4, '2018-01-01 01:00:00', 'titl sAhtLg', 'postik sAhtLzbImMcXEKRsrPoD'),
(4, 4, '2018-01-01 01:00:00', 'titl UqYvYg', 'postik UqYvYQUmNUewfZfOTKVo');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `usermail` varchar(30) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `screen_name` varchar(30) DEFAULT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `usermail`, `password`, `screen_name`, `creation_date`) VALUES
(1, 'adm@mail.ru', '111', 'adm', '0000-00-00 00:00:00'),
(2, 'VasyanM@gmail.com', '1111', 'VasnM', '0000-00-00 00:00:00'),
(3, 'VasyagM@gmail.com', '1111', 'VasgM', '0000-00-00 00:00:00'),
(4, 'VasyaYR@gmail.com', '1111', 'VasYR', '0000-00-00 00:00:00'),
(5, 'VasyaCv@gmail.com', '1111', 'VasCv', '0000-00-00 00:00:00');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
