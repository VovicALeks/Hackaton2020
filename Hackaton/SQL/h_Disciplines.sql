-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Ноя 01 2020 г., 10:15
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
-- Структура таблицы `h_Disciplines`
--
-- Создание: Окт 31 2020 г., 09:31
--

DROP TABLE IF EXISTS `h_Disciplines`;
CREATE TABLE `h_Disciplines` (
  `Discipline_ID` int(11) NOT NULL COMMENT 'Идентификатор дисциплины',
  `Name` varchar(200) NOT NULL COMMENT 'Название дисциплины',
  `Teacher_ID` int(11) NOT NULL COMMENT 'Идентификатор учителя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `h_Disciplines`
--

INSERT INTO `h_Disciplines` (`Discipline_ID`, `Name`, `Teacher_ID`) VALUES
(1, 'Основы PHP', 3),
(2, 'Основы C#', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `h_Disciplines`
--
ALTER TABLE `h_Disciplines`
  ADD PRIMARY KEY (`Discipline_ID`),
  ADD KEY `Teacher_ID` (`Teacher_ID`),
  ADD KEY `Teacher_ID_2` (`Teacher_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `h_Disciplines`
--
ALTER TABLE `h_Disciplines`
  MODIFY `Discipline_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор дисциплины', AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `h_Disciplines`
--
ALTER TABLE `h_Disciplines`
  ADD CONSTRAINT `h_Disciplines_ibfk_1` FOREIGN KEY (`Teacher_ID`) REFERENCES `h_Users` (`User_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
