-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2015 at 07:59 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_acos_lft_rght` (`lft`,`rght`),
  KEY `idx_acos_alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=71 ;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 128),
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
(43, 1, NULL, NULL, 'ClientStocks', 90, 103),
(44, 43, NULL, NULL, 'index', 91, 92),
(45, 43, NULL, NULL, 'view', 93, 94),
(46, 43, NULL, NULL, 'add', 95, 96),
(47, 43, NULL, NULL, 'edit', 97, 98),
(48, 43, NULL, NULL, 'delete', 99, 100),
(55, 1, NULL, NULL, 'Stocks', 104, 115),
(56, 55, NULL, NULL, 'index', 105, 106),
(57, 55, NULL, NULL, 'view', 107, 108),
(58, 55, NULL, NULL, 'add', 109, 110),
(59, 55, NULL, NULL, 'edit', 111, 112),
(60, 55, NULL, NULL, 'delete', 113, 114),
(61, 1, NULL, NULL, 'StockExchanges', 116, 127),
(62, 61, NULL, NULL, 'index', 117, 118),
(63, 61, NULL, NULL, 'view', 119, 120),
(64, 61, NULL, NULL, 'add', 121, 122),
(65, 61, NULL, NULL, 'edit', 123, 124),
(66, 61, NULL, NULL, 'delete', 125, 126),
(67, 43, NULL, NULL, 'buyStock', 101, 102),
(68, 36, NULL, NULL, 'deposit', 85, 86),
(69, 36, NULL, NULL, 'withdraw', 87, 88),
(70, 2, NULL, NULL, 'remove', 13, 14);

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_aros_lft_rght` (`lft`,`rght`),
  KEY `idx_aros_alias` (`alias`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Group', 1, NULL, 1, 4),
(2, NULL, 'Group', 2, NULL, 5, 6);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`),
  KEY `idx_aco_id` (`aco_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 2, 1, '-1', '-1', '-1', '-1'),
(3, 2, 2, '1', '1', '1', '1'),
(4, 2, 14, '1', '1', '1', '1'),
(5, 2, 29, '1', '1', '1', '1'),
(6, 2, 56, '1', '1', '1', '1'),
(7, 2, 57, '1', '1', '1', '1'),
(8, 2, 43, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `balance`
--

CREATE TABLE IF NOT EXISTS `balance` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `cash_balance` float(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE IF NOT EXISTS `clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned DEFAULT NULL,
  `NINum` varchar(17) NOT NULL,
  `name` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `town` varchar(50) NOT NULL,
  `county` varchar(50) NOT NULL,
  `postcode` varchar(10) NOT NULL,
  `registered` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `NINum` (`NINum`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `client_stocks`
--

CREATE TABLE IF NOT EXISTS `client_stocks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `stock_id` int(11) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `cost` float(10,2) NOT NULL,
  `purchase` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`),
  KEY `stock_id` (`stock_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Financial Advisor');

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `client_id` int(11) unsigned NOT NULL,
  `body` text NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `averageDailyVolume` int(11) NOT NULL,
  `change` varchar(10) NOT NULL,
  `daysLow` float(10,2) NOT NULL,
  `daysHigh` float NOT NULL,
  `yearsLow` float NOT NULL,
  `marketCapatalization` varchar(20) NOT NULL,
  `lastTradePriceOnly` float(10,2) NOT NULL,
  `daysRange` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `symbol` varchar(4) NOT NULL,
  `volume` int(11) NOT NULL,
  `stockExchange_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `symbol` (`symbol`),
  KEY `stockExchange_id` (`stockExchange_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;



-- --------------------------------------------------------

--
-- Table structure for table `stock_exchanges`
--

CREATE TABLE IF NOT EXISTS `stock_exchanges` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `stock_exchanges`
--

INSERT INTO `stock_exchanges` (`id`, `name`) VALUES
(1, 'LSE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `group_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `group_id` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `group_id`) VALUES
(1, 'admin', '1d493e180de83af28ae84771e473b72456dd3373', 'Administrator Account', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `balance`
--
ALTER TABLE `balance`
  ADD CONSTRAINT `balance_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `clients`
--
ALTER TABLE `clients`
  ADD CONSTRAINT `clients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_stocks`
--
ALTER TABLE `client_stocks`
  ADD CONSTRAINT `client_stocks_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `client_stocks_ibfk_2` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`);

--
-- Constraints for table `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`);

--
-- Constraints for table `stocks`
--
ALTER TABLE `stocks`
  ADD CONSTRAINT `stocks_ibfk_1` FOREIGN KEY (`stockExchange_id`) REFERENCES `stock_exchanges` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
