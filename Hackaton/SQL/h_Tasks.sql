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
-- Структура таблицы `h_Tasks`
--
-- Создание: Окт 31 2020 г., 22:49
-- Последнее обновление: Ноя 01 2020 г., 05:53
--

DROP TABLE IF EXISTS `h_Tasks`;
CREATE TABLE `h_Tasks` (
  `Task_ID` int(11) NOT NULL COMMENT 'Идентификатор задания',
  `Discipline_ID` int(11) NOT NULL COMMENT 'Идентификатор дисциплины',
  `Name` varchar(100) NOT NULL COMMENT 'Название задания',
  `Legend` varchar(500) DEFAULT NULL,
  `Description` varchar(750) NOT NULL COMMENT 'Описание задачи',
  `Time_Limit` float NOT NULL COMMENT 'Временной лимит (мин)',
  `Language` varchar(30) NOT NULL COMMENT 'Язык программирования задачи',
  `Checkers` varchar(500) NOT NULL COMMENT 'Условия выполнения задания',
  `Rating` varchar(500) NOT NULL COMMENT 'Условия оценивания'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `h_Tasks`
--

INSERT INTO `h_Tasks` (`Task_ID`, `Discipline_ID`, `Name`, `Legend`, `Description`, `Time_Limit`, `Language`, `Checkers`, `Rating`) VALUES
(1, 1, 'Перебор элементов массива с помощью цикла for', NULL, 'Дан массив $a = array(1,2,3,4,5). С помощью одного цикла for преобразуйте этот массив в array(0,2,6,12,20).', 2, 'PHP', '{\"WordPresence\":[[\"for\",\"FunctionOrKey\",1]]}', ''),
(2, 2, 'Работа со строками', NULL, 'Дана строка s = \"Programmer\". С помощью методов работы со строками (изменение регистра, замена подстроки и обрезка строки) превратите эту строку в s = \"PRO_ME\"', 20, 'C#', '', ''),
(5, 1, '1213', '', '		123	\r\n		', 123, 'PHP', 'null', '[\"SymbNum\",[[\"100\",\"50\"],[\"80\",\"100\"]]]');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `h_Tasks`
--
ALTER TABLE `h_Tasks`
  ADD PRIMARY KEY (`Task_ID`),
  ADD KEY `Discipline_ID` (`Discipline_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `h_Tasks`
--
ALTER TABLE `h_Tasks`
  MODIFY `Task_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор задания', AUTO_INCREMENT=6;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `h_Tasks`
--
ALTER TABLE `h_Tasks`
  ADD CONSTRAINT `h_Tasks_ibfk_1` FOREIGN KEY (`Discipline_ID`) REFERENCES `h_Disciplines` (`Discipline_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
