-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 01 2020 г., 10:14
-- Версия сервера: 5.7.21-20-beget-5.7.21-20-1-log
-- Версия PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `f90457uj_velikiy`
--

-- --------------------------------------------------------

--
-- Структура таблицы `h_Tries`
--
-- Создание: Окт 31 2020 г., 21:28
-- Последнее обновление: Окт 31 2020 г., 22:54
--

DROP TABLE IF EXISTS `h_Tries`;
CREATE TABLE `h_Tries` (
  `Try_ID` int(11) NOT NULL COMMENT 'Идентификатор попытки',
  `St_Task_ID` int(11) NOT NULL COMMENT 'Идентификатор задания студента',
  `Try_Date` datetime NOT NULL COMMENT 'Дата попытки',
  `Rating` int(11) NOT NULL COMMENT 'Оценка до 100 баллов',
  `Status` varchar(100) NOT NULL COMMENT 'Статус попытки ("В процессе", "Задание выполнено", "Задание не выполнено")',
  `Code` varchar(1000) DEFAULT NULL COMMENT 'Код ответа',
  `Comment` varchar(250) NOT NULL COMMENT 'Комментарий к попытке'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `h_Tries`
--

INSERT INTO `h_Tries` (`Try_ID`, `St_Task_ID`, `Try_Date`, `Rating`, `Status`, `Code`, `Comment`) VALUES
(3, 1, '2020-11-01 01:54:44', 0, 'Задача не решена', '', 'Время вышло');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `h_Tries`
--
ALTER TABLE `h_Tries`
  ADD PRIMARY KEY (`Try_ID`),
  ADD KEY `St_Task_ID` (`St_Task_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `h_Tries`
--
ALTER TABLE `h_Tries`
  MODIFY `Try_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор попытки', AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `h_Tries`
--
ALTER TABLE `h_Tries`
  ADD CONSTRAINT `h_Tries_ibfk_1` FOREIGN KEY (`St_Task_ID`) REFERENCES `h_Student_Tasks` (`St_Task_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
