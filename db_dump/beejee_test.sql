-- phpMyAdmin SQL Dump
-- version 4.7.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Фев 11 2018 г., 16:39
-- Версия сервера: 5.6.37
-- Версия PHP: 7.0.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `beejee_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `name` tinytext NOT NULL,
  `content` text NOT NULL,
  `email` tinytext NOT NULL,
  `img` tinytext,
  `status` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `tasks`
--

INSERT INTO `tasks` (`id`, `name`, `content`, `email`, `img`, `status`, `created_at`) VALUES
(2, 'Valera', 'In Any Text Editor Countless productivity apps and sites store your tasks in their own proprietary database and file format. But you can work with your todo.txt file in every text editor ever made, regardless of operating system or vendor.', 'whoiam@mail.ru', '126f9ac2eb100ae094003a2f18d9ba68.jpg', NULL, '2018-02-10 23:10:04'),
(3, 'Andrey', 'PHP (recursive acronym for PHP: Hypertext Preprocessor) is a widely-used open source general-purpose scripting language that is especially suited for web development and can be embedded into HTML. The best way we learn anything is by practice and exercise questions. We have started this section for those (beginner to intermediate) who are familiar with PHP. Hope, these exercises help you to improve your PHP coding skills. Currently, following sections are available, we are working hard to add more exercises. Happy Coding!', 'anrey2342342@mail.ru', 'fce5340effdb46d408b9dda9671eb841.jpg', 1, '2018-02-10 23:12:06'),
(4, 'Andrey', 'PHP (recursive acronym for PHP: Hypertext Preprocessor) is a widely-used open source general-purpose scripting language that is especially suited for web development and can be embedded into HTML.\r\n\r\nThe best way we learn anything is by practice and exercise questions. We have started this section for those (beginner to intermediate) who are familiar with PHP.\r\n\r\nHope, these exercises help you to improve your PHP coding skills. Currently, following sections are available, we are working hard to add more exercises. Happy Coding!', 'anrey2342342@mail.ru', 'e748f2a1345ee7e3c0ab685bf8fb8d85.jpg', NULL, '2018-02-10 23:16:19'),
(5, 'Nikolay', 'Write a PHP script to find the maximum and minimum marks from the following set of arrays. Go to the editor\r\nSample arrays :\r\n$marks1 = array(360,310,310,330,313,375,456,111,256); \r\n$marks2 = array(350,340,356,330,321); \r\n$marks3 = array(630,340,570,635,434,255,298); \r\nExpected Output :\r\nMaximum marks : 635 \r\nMinimum marks : 111', 'callme3334@gmail.com', '', 0, '2018-02-10 23:26:35'),
(6, 'Alex', '1. Write a PHP script to decode a JSON string. Go to the editor\r\nClick me to see the solution\r\n\r\n2. Write a PHP script to decode large integers. Go to the editor\r\nSample integer :\r\n{&quot;number&quot;: 123456789012345678901234567890}\r\nClick me to see the solution\r\n\r\n3. Write a PHP script to get JSON representation of a value from an array. Go to the editor\r\nClick me to see the solution\r\n\r\n4. Write a PHP function to display JSON decode errors. Go to the editor\r\nClick me to see the solution', 'hello@gmail.com', 'b07582131e4f2e68ec166a707cdfbb32.jpg', 1, '2018-02-11 15:36:49');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` text NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `password`) VALUES
(2, 'admin', '$2y$10$YoHWsVqD9fiU1Hjn3hkM3OMsi7yru8doxT0mxPTwVRN1/nmY6D.Cm');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tasks`
--
ALTER TABLE `tasks`
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
-- AUTO_INCREMENT для таблицы `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
