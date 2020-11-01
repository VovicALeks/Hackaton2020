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
-- Структура таблицы `h_Users`
--
-- Создание: Окт 31 2020 г., 17:56
--

DROP TABLE IF EXISTS `h_Users`;
CREATE TABLE `h_Users` (
  `User_ID` int(11) NOT NULL COMMENT 'Идентификатор пользователя',
  `Full_Name` varchar(250) DEFAULT NULL COMMENT 'Полное имя пользователя',
  `Educ_Institute` varchar(300) DEFAULT NULL COMMENT 'Учебное заведение',
  `Email` varchar(100) DEFAULT NULL COMMENT 'Адрес электронной почты',
  `Birth_Date` date DEFAULT NULL COMMENT 'Дата рождения',
  `Status` varchar(50) DEFAULT NULL COMMENT 'Статус пользователя ("Учитель", "Ученик")',
  `Login` varchar(100) DEFAULT NULL COMMENT 'Логин',
  `Password` varchar(50) DEFAULT NULL COMMENT 'Пароль',
  `Class` varchar(10) DEFAULT NULL COMMENT 'Класс ученика'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `h_Users`
--

INSERT INTO `h_Users` (`User_ID`, `Full_Name`, `Educ_Institute`, `Email`, `Birth_Date`, `Status`, `Login`, `Password`, `Class`) VALUES
(1, 'Великий Владимир Александрович', 'Школа N', 'vova.velikiy.00@mail.ru', '2007-09-25', 'Ученик', 'vovavel', 'vovavel', '10А'),
(2, 'Фёдоров Сергей Олегович', 'Школа N', 'fedso@example.ru', '2007-04-11', 'Ученик', 'sergeifed', 'sergeifed', '10А'),
(3, 'Великая Анастасия Александровна', 'Школа N', 'nastyavel@example.ru', '1995-03-12', 'Учитель', 'NastyaVel', 'NastyaVel', NULL),
(4, 'Администратор', NULL, NULL, NULL, 'Администратор', 'admin', 'admin', NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `h_Users`
--
ALTER TABLE `h_Users`
  ADD PRIMARY KEY (`User_ID`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `h_Users`
--
ALTER TABLE `h_Users`
  MODIFY `User_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Идентификатор пользователя', AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
