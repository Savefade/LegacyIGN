-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране:  9 септ 2023 в 22:19
-- Версия на сървъра: 10.4.25-MariaDB
-- Версия на PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данни: `legacyign`
--

-- --------------------------------------------------------

--
-- Структура на таблица `accounts`
--

CREATE TABLE `accounts` (
  `ID` int(11) NOT NULL,
  `Username` text NOT NULL,
  `Password` text NOT NULL,
  `uniquetoken` int(11) NOT NULL,
  `device_id` text NOT NULL,
  `isaccountprivate` int(11) NOT NULL,
  `isverified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='stores the accounts. idk what else to say lol';

CREATE TABLE `posts` (
  `ID` int(11) NOT NULL,
  `username` text NOT NULL,
  `AccountID` int(11) NOT NULL,
  `PhotoDIR` text NOT NULL,
  `Likes` int(11) NOT NULL,
  `Comments` int(11) NOT NULL,
  `posttimestamp` int(11) NOT NULL,
  `description` text NOT NULL,
  `views` int(11) NOT NULL,
  `isvideo` int(11) NOT NULL,
  `isuploadedbyprivateacc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `posts`
--

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
