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
-- Структура таблицы `h_Student_Tasks`
--
-- Создание: Окт 31 2020 г., 09:32
-- Последнее обновление: Окт 31 2020 г., 22:58
--

DROP TABLE IF EXISTS `h_Student_Tasks`;
CREATE TABLE `h_Student_Tasks` (
  `St_Task_ID` int(11) NOT NULL COMMENT 'Идентификатор задачи',
  `Student_ID` int(11) NOT NULL COMMENT 'Идентификатор ученика',
  `Task_ID` int(11) NOT NULL COMMENT 'Идентификатор задания',
  `Status` varchar(100) NOT NULL COMMENT 'Статус задачи',
  `Deadline` date NOT NULL COMMENT 'Крайняя дата сдачи',
  `Tries` int(11) NOT NULL COMMENT 'Количество попыток',
  `Rating_Type` varchar(50) NOT NULL COMMENT 'Тип оценки ("Средняя по попыткам", "Максимальный балл")'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `h_Student_Tasks`
--

INSERT INTO `h_Student_Tasks` (`St_Task_ID`, `Student_ID`, `Task_ID`, `Status`, `Deadline`, `Tries`, `Rating_Type`) VALUES
(1, 1, 1, 'Открыто', '2020-11-05', 10, 'Максимальный балл'),
(2, 1, 2, 'Открыто', '2020-10-28', 3, 'Максимальный балл');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `h_Student_Tasks`
--
ALTER TABLE `h_Student_Tasks`
  ADD PRIMARY KEY (`St_Task_ID`),
  ADD KEY `Student_ID` (`Student_ID`,`Task_ID`),
  ADD KEY `Task_ID` (`Task_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `h_Student_Tasks`
--
ALTER TABLE `h_Student_Tasks`
  MODIFY `St_Task_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор задачи', AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `h_Student_Tasks`
--
ALTER TABLE `h_Student_Tasks`
  ADD CONSTRAINT `h_Student_Tasks_ibfk_1` FOREIGN KEY (`Student_ID`) REFERENCES `h_Users` (`User_ID`),
  ADD CONSTRAINT `h_Student_Tasks_ibfk_2` FOREIGN KEY (`Task_ID`) REFERENCES `h_Tasks` (`Task_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
