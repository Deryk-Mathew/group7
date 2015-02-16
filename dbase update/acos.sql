-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2015 at 02:22 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `test`
--

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 142),
(2, 1, NULL, NULL, 'Clients', 2, 15),
(3, 2, NULL, NULL, 'index', 3, 4),
(4, 2, NULL, NULL, 'view', 5, 6),
(5, 2, NULL, NULL, 'add', 7, 8),
(6, 2, NULL, NULL, 'edit', 9, 10),
(7, 2, NULL, NULL, 'delete', 11, 12),
(8, 1, NULL, NULL, 'Groups', 16, 27),
(9, 8, NULL, NULL, 'index', 17, 18),
(10, 8, NULL, NULL, 'view', 19, 20),
(11, 8, NULL, NULL, 'add', 21, 22),
(12, 8, NULL, NULL, 'edit', 23, 24),
(13, 8, NULL, NULL, 'delete', 25, 26),
(14, 1, NULL, NULL, 'Notes', 28, 39),
(15, 14, NULL, NULL, 'index', 29, 30),
(16, 14, NULL, NULL, 'view', 31, 32),
(17, 14, NULL, NULL, 'add', 33, 34),
(18, 14, NULL, NULL, 'edit', 35, 36),
(19, 14, NULL, NULL, 'delete', 37, 38),
(20, 1, NULL, NULL, 'Pages', 40, 43),
(21, 20, NULL, NULL, 'display', 41, 42),
(22, 1, NULL, NULL, 'Users', 44, 61),
(23, 22, NULL, NULL, 'index', 45, 46),
(24, 22, NULL, NULL, 'view', 47, 48),
(25, 22, NULL, NULL, 'add', 49, 50),
(26, 22, NULL, NULL, 'edit', 51, 52),
(27, 22, NULL, NULL, 'delete', 53, 54),
(28, 22, NULL, NULL, 'login', 55, 56),
(29, 22, NULL, NULL, 'logout', 57, 58),
(30, 1, NULL, NULL, 'AclExtras', 62, 63),
(31, 1, NULL, NULL, 'DebugKit', 64, 71),
(32, 31, NULL, NULL, 'ToolbarAccess', 65, 70),
(33, 32, NULL, NULL, 'history_state', 66, 67),
(34, 32, NULL, NULL, 'sql_explain', 68, 69),
(35, 1, NULL, NULL, 'Phpunit', 72, 73),
(36, 1, NULL, NULL, 'Balances', 74, 89),
(37, 36, NULL, NULL, 'index', 75, 76),
(38, 36, NULL, NULL, 'view', 77, 78),
(39, 36, NULL, NULL, 'add', 79, 80),
(40, 36, NULL, NULL, 'edit', 81, 82),
(41, 36, NULL, NULL, 'delete', 83, 84),
(42, 22, NULL, NULL, 'initDB', 59, 60),
(43, 1, NULL, NULL, 'ClientStocks', 90, 105),
(44, 43, NULL, NULL, 'index', 91, 92),
(45, 43, NULL, NULL, 'view', 93, 94),
(46, 43, NULL, NULL, 'add', 95, 96),
(47, 43, NULL, NULL, 'edit', 97, 98),
(48, 43, NULL, NULL, 'delete', 99, 100),
(55, 1, NULL, NULL, 'Stocks', 106, 117),
(56, 55, NULL, NULL, 'index', 107, 108),
(57, 55, NULL, NULL, 'view', 109, 110),
(58, 55, NULL, NULL, 'add', 111, 112),
(59, 55, NULL, NULL, 'edit', 113, 114),
(60, 55, NULL, NULL, 'delete', 115, 116),
(61, 1, NULL, NULL, 'StockExchanges', 118, 129),
(62, 61, NULL, NULL, 'index', 119, 120),
(63, 61, NULL, NULL, 'view', 121, 122),
(64, 61, NULL, NULL, 'add', 123, 124),
(65, 61, NULL, NULL, 'edit', 125, 126),
(66, 61, NULL, NULL, 'delete', 127, 128),
(67, 43, NULL, NULL, 'buyStock', 101, 102),
(68, 36, NULL, NULL, 'deposit', 85, 86),
(69, 36, NULL, NULL, 'withdraw', 87, 88),
(70, 2, NULL, NULL, 'remove', 13, 14),
(71, 43, NULL, NULL, 'sellStock', 103, 104),
(72, 1, NULL, NULL, 'Meetings', 130, 141),
(73, 72, NULL, NULL, 'index', 131, 132),
(74, 72, NULL, NULL, 'view', 133, 134),
(75, 72, NULL, NULL, 'add', 135, 136),
(76, 72, NULL, NULL, 'edit', 137, 138),
(77, 72, NULL, NULL, 'delete', 139, 140);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
