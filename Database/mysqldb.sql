-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Време на генериране: 29 окт 2023 в 21:10
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
  `sessionid` text NOT NULL COMMENT 'DO NOT CHANGE!!!',
  `isaccountprivate` int(11) NOT NULL,
  `isverified` int(11) NOT NULL,
  `followercount` int(11) NOT NULL,
  `followingcount` int(11) NOT NULL,
  `photocount` int(11) NOT NULL,
  `pfpURL` text NOT NULL,
  `fullname` text NOT NULL,
  `biography` text NOT NULL,
  `website` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='stores the accounts. idk what else to say lol';

--
-- Схема на данните от таблица `accounts`
--

INSERT INTO `accounts` (`ID`, `Username`, `Password`, `uniquetoken`, `device_id`, `sessionid`, `isaccountprivate`, `isverified`, `followercount`, `followingcount`, `photocount`, `pfpURL`, `fullname`, `biography`, `website`) VALUES
(1, 'itzjava', '$2y$10$EW4vQDsqVVcP72cNyhma4eWoZ.HVF7P6ObZvVcWcuLPjSuPg30jmS', 176705279, 'D855C26E-B5F0-4A6D-85B8-604D5931D20F', '', 0, 0, 0, 0, 0, '/ign/icon.png', 'itzJava', '', ''),
(2, 'samsung', '$2y$10$MM4X0v1oPMbR.iivW9ZCGuA8JWliTOow0mgfXav17j4qzph.JCFR2', 1625975060, 'D855C26E-B5F0-4A6D-85B8-604D5931D20F', '', 0, 0, 0, 0, 0, '/ign/icon.png', 'samsung', '', ''),
(3, 'smaznug', '$2y$10$U78mm/9tMcZF1RX/RsO5r.ToQ0uQMgSqnbxK2nbrcD8aqSmF1IBRO', 293371062, 'D855C26E-B5F0-4A6D-85B8-604D5931D20F', '32c959d1cac614ae601131ff153e010ec9623ff1', 0, 0, 0, 0, 0, '/ign/icon.png', 'smaznug', '', ''),
(4, 'ssjjs', '$2y$10$8fnPXKJJhC4UQVA7FJJpTOt/CpFoc/DglEy/jXgIRd0v/Ez0bCdHi', 1187585929, '81FEFBAE-6674-4B0A-9267-6CA9946F5A54', '8924e45401a399c3366084687bf826b8d9318e6d', 0, 0, 0, 0, 1, '/ign/icon.png', 'ssjjs', '', ''),
(5, 'vvv', '$2y$10$7SfCYwQIMaEe8AJBjswC8exS.Q6nFiMkt8YUThFl.DRXXb8zoyf1S', 217720711, '9C5ED229-9950-4F86-9FC6-5D91A70F18B1', '64853efe4437a37c804d577e15eac457629e78ad', 0, 0, 0, 0, 2, '/ign/icon.png', 'vvv', '', ''),
(6, 'hhh', '$2y$10$X81NXpW8OS3V6pqkLxwAQOByDI0czaedEPFAbb86RjdJxBdEQ9F5G', 18701782, '9C5ED229-9950-4F86-9FC6-5D91A70F18B1', 'e004ede66eb37a7b888edfcaed3827061ece3dd5', 0, 0, 0, 0, 1, '/ign/icon.png', 'hhh', '', 'http://itworks'),
(7, 'bananaphone', '$2y$10$MaocB9BTQsLMsW7mf56ie.QHPKvh./JuNJncFBGIyAARIlVQzegIe', 37770385, 'D855C26E-B5F0-4A6D-85B8-604D5931D20F', '4eab61dd96a1b5ed3c6c22e435d092030d0b7658', 0, 1, 6, 9, 4, '/ign/icon.png', '📞📞📞🍌', 'Ring ring ring banana phoooon', 'https://en.wikipedia.org/wiki/Banana'),
(8, 'checheneca', '$2y$10$wdPzwd0txDanBaI8VebP4eK11q7vDMEU6/Yky5IFr32BmFi/pC6Ly', 799447121, 'D855C26E-B5F0-4A6D-85B8-604D5931D20F', 'f0c7116c17dc4bd6af07479e39c8ca86c77e66ff', 0, 1, 6969, 69, 2, '/ign/icon.png', 'checheneca', 'Аз сам чичиницъ', '');

-- --------------------------------------------------------

--
-- Структура на таблица `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `username` text NOT NULL,
  `accountid` int(11) NOT NULL,
  `text` text NOT NULL,
  `likes` int(11) NOT NULL,
  `is_reply` tinyint(1) NOT NULL,
  `replycomment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура на таблица `posts`
--

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
  `originaluploadid` text NOT NULL,
  `isvideo` int(11) NOT NULL,
  `isuploadedbyprivateacc` int(11) NOT NULL,
  `photouserid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Схема на данните от таблица `posts`
--

INSERT INTO `posts` (`ID`, `username`, `AccountID`, `PhotoDIR`, `Likes`, `Comments`, `posttimestamp`, `description`, `views`, `originaluploadid`, `isvideo`, `isuploadedbyprivateacc`, `photouserid`) VALUES
(1, 'itzjava', 1, '/ign/photos/1.png', 0, 0, 1696149639, 'Plantyyy', 0, '0', 0, 0, 0),
(2, 'itzjava', 1, '/ign/photos/2.png', 0, 0, 1696152669, 'Deez nuts', 0, '0', 0, 0, 0),
(3, 'itzjava', 1, '/ign/photos/3.png', 0, 0, 1696152787, 'Kid', 0, '0', 0, 0, 0),
(4, 'itzjava', 1, '/ign/photos/4.png', 0, 0, 1696153054, 'Shrek', 0, '0', 0, 0, 0),
(5, 'itzjava', 1, '/ign/photos/5.png', 0, 0, 1696153064, 'Beluga', 0, '0', 0, 0, 0),
(6, 'itzjava', 1, '/ign/photos/6.png', 0, 0, 1696153169, 'Currently descriptions are not supported!', 0, '1696153169', 0, 0, 0),
(7, 'itzjava', 1, '/ign/photos/7.png', 0, 0, 1696494137, 'Minecraft', 0, '0', 0, 0, 0),
(8, 'itzjava', 1, '/ign/photos/8.png', 0, 0, 1696506643, '#poda', 0, '0', 0, 0, 0),
(9, 'itzjava', 1, '/ign/photos/9.png', 0, 0, 1696509435, 'Ivan dragan petkan', 0, '0', 0, 0, 0),
(10, 'smaznug', 3, '/ign/photos/10.png', 0, 0, 1698238865, 'No caption has been set!', 0, '0', 0, 0, 0),
(11, 'hhh', 6, '/ign/photos/11.png', 0, 0, 1698441567, 'Test', 0, '0', 0, 0, 0),
(12, 'hhh', 6, '/ign/photos/12.png', 0, 0, 1698484711, 'No caption has been set!', 0, '0', 0, 0, 0),
(13, 'hhh', 6, '/ign/photos/13.png', 0, 0, 1698484840, 'Kiril', 0, '0', 0, 0, 0),
(14, 'hhh', 6, '/ign/photos/14.png', 0, 0, 1698487146, 'Currently descriptions are not supported!', 0, '1698487145', 0, 0, 0),
(15, 'hhh', 6, '/ign/photos/15.png', 0, 0, 1698487540, 'Currently descriptions are not supported!', 0, '1698487539', 0, 0, 0),
(16, 'vvv', 5, '/ign/photos/16.png', 0, 0, 1698497690, 'No caption has been set!', 0, '0', 0, 0, 0),
(17, 'vvv', 5, '/ign/photos/17.png', 0, 0, 1698500129, 'No caption has been set!', 0, '0', 0, 0, 1),
(18, 'bananaphone', 7, '/ign/photos/18.png', 0, 0, 1698500211, 'No caption has been set!', 0, '0', 0, 0, 1),
(19, 'bananaphone', 7, '/ign/photos/19.png', 0, 0, 1698500275, 'Banana phoooonnn', 0, '0', 0, 0, 2),
(20, 'bananaphone', 7, '/ign/photos/20.png', 0, 0, 1698501461, 'No caption has been set!', 0, '0', 0, 0, 3),
(21, 'bananaphone', 7, '/ign/photos/21.png', 0, 0, 1698601764, 'Hello world!', 0, '0', 0, 0, 4),
(22, 'vvv', 5, '/ign/photos/22.png', 0, 0, 1698602717, 'Nostalgia', 0, '0', 0, 0, 2),
(23, 'hhh', 6, '/ign/photos/23.png', 0, 0, 1698602990, 'No caption has been set!', 0, '0', 0, 0, 1),
(24, 'ssjjs', 4, '/ign/photos/24.png', 0, 0, 1698606995, '#mike', 0, '0', 0, 0, 1),
(25, 'checheneca', 8, '/ign/photos/25.png', 0, 0, 1698607605, 'Аз сам чичиниц #чичиниц', 0, '0', 0, 0, 1),
(26, 'checheneca', 8, '/ign/photos/26.png', 0, 0, 1698607633, 'Аз сам чичиниц #чичиниц', 0, '0', 0, 0, 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
