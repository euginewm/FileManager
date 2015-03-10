-- phpMyAdmin SQL Dump
-- version 4.2.5
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Мар 10 2015 г., 04:06
-- Версия сервера: 5.5.29
-- Версия PHP: 5.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `filebase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `filemime` varchar(100) NOT NULL,
  `filesize` int(11) NOT NULL,
  `filestatus` enum('active','disabled') NOT NULL DEFAULT 'active',
  `filepath` varchar(200) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `user_id`, `filename`, `filemime`, `filesize`, `filestatus`, `filepath`) VALUES
(18, 7, 'ferrotitan-about.png', 'image/png', 1013974, 'disabled', '29515a227f14458431f6bbcf5c665d94d22b75ae'),
(19, 7, 'ferrotitan-contacts.png', 'image/png', 823812, 'disabled', 'fd350cebf87c7579630779f0758048e4fe97261a');

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
`id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
`id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(41) NOT NULL,
  `hash` varchar(41) NOT NULL,
  `name` varchar(200) CHARACTER SET utf8 NOT NULL,
  `secondname` varchar(200) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `birthday` int(10) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `hash`, `name`, `secondname`, `phone`, `birthday`) VALUES
(7, 'admin', 'euginewm@gmail.com', '9d4e1e23bd5b727046a9e3b4b7db57bd8d6ee684', '', 'Eugen', 'Cherniy', '+38095096653', 560552400);

-- --------------------------------------------------------

--
-- Структура таблицы `user_revision`
--

CREATE TABLE `user_revision` (
`user_id` int(11) NOT NULL,
  `user_data` blob NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `user_revision`
--

INSERT INTO `user_revision` (`user_id`, `user_data`, `date`) VALUES
(7, 0x613a363a7b693a303b733a353a2261646d696e223b693a313b733a353a22457567656e223b693a323b733a373a22436865726e6979223b693a333b733a31383a22657567696e65776d40676d61696c2e636f6d223b693a343b733a31323a222b3338303935303936363533223b693a353b693a3536303535323430303b7d, '2015-03-09 23:32:05');

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE `user_role` (
`id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_revision`
--
ALTER TABLE `user_revision`
 ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_revision`
--
ALTER TABLE `user_revision`
MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
