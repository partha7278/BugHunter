-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2019 at 02:16 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bughunter`
--

-- --------------------------------------------------------

--
-- Table structure for table `bug`
--

DROP TABLE IF EXISTS `bug`;
CREATE TABLE IF NOT EXISTS `bug` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `b_cat_id` int(10) NOT NULL,
  `bug_name` varchar(200) NOT NULL,
  `bug_nor` varchar(250) DEFAULT NULL,
  `bug_about` text,
  `bug_impact` text,
  `bug_produce` text,
  `created_at` date NOT NULL,
  `bug_poc` text,
  `bug_poc_exten` varchar(10) DEFAULT NULL,
  `report` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `b_cat_id` (`b_cat_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `b_cat`
--

DROP TABLE IF EXISTS `b_cat`;
CREATE TABLE IF NOT EXISTS `b_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `b_cat_name` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(10) NOT NULL,
  `name` varchar(80) NOT NULL,
  `url` varchar(150) NOT NULL,
  `type` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(150) NOT NULL,
  `created_at` date NOT NULL,
  `contact` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

DROP TABLE IF EXISTS `testing`;
CREATE TABLE IF NOT EXISTS `testing` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `bug_id` int(10) NOT NULL,
  `url_id` int(10) NOT NULL,
  `complete` varchar(6) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `bug_id` (`bug_id`),
  KEY `url_id` (`url_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t_bug`
--

DROP TABLE IF EXISTS `t_bug`;
CREATE TABLE IF NOT EXISTS `t_bug` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `created_at` date NOT NULL,
  `testing_id` int(20) NOT NULL,
  `vulnerable_url` varchar(300) NOT NULL,
  `send` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `url`
--

DROP TABLE IF EXISTS `url`;
CREATE TABLE IF NOT EXISTS `url` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `project_id` int(10) NOT NULL,
  `project_url` varchar(200) NOT NULL,
  `created_at` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project_id` (`project_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
