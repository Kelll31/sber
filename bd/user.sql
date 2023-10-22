-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Окт 22 2023 г., 12:11
-- Версия сервера: 10.4.28-MariaDB
-- Версия PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `sber`
--

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `user_id` int(90) NOT NULL,
  `user_hash` text NOT NULL,
  `user_role` int(9) NOT NULL,
  `user_name` text NOT NULL,
  `user_pass` text NOT NULL,
  `user_login` longtext NOT NULL,
  `user_count` varchar(999) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`user_id`, `user_hash`, `user_role`, `user_name`, `user_pass`, `user_login`, `user_count`) VALUES
(1, '0', 0, 'Александра Серова', '1', '447725', ','),
(2, '0', 1, 'Гена Цыдармян', '2', 'pupaxlupa', ','),
(3, '0', 2, 'Варов Максим', '3', 'trueghoul1000-7', '5,5,6,6,6,6,6'),
(4, '0', 1, 'Анжела Белая', '4', 'adeptexiao', ','),
(5, '0', 2, 'Виталий5', '5', 'vitalik5', '7,7,8,2,2'),
(6, '0', 2, 'Виталий6', '6', 'vitalik6', '4,4,4,4,4,4,4'),
(7, '0', 2, 'Виталий7', '7', 'vitalik7', '4,4,4,2'),
(8, '0', 2, 'Виталий8', '8', 'vitalik8', '2,2,2,2,2'),
(9, '0', 2, 'Виталий9', '9', 'vitalik9', ','),
(10, '0', 2, 'Виталий10', '10', 'vitalik10', ','),
(11, '0', 0, 'admin', '1', '1', ','),
(12, '0', 2, 'Негры лохи', 'ye', 'ye', ','),
(13, '0', 2, 'Красноштанов Александр', '123', '123', '5,5,6,6,6,6'),
(14, '4yHQGPRoeMTvbwrcrjjtaafirPuVJc5H', 1, 'Алексей Куприков', '210747058', '210747058', ',');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(90) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
