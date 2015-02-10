-- phpMyAdmin SQL Dump
-- version 4.1.10
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2015 at 10:16 PM
-- Server version: 5.1.67-andiunpam
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `funchayat`
--

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `from` varchar(30) NOT NULL,
  `to` varchar(30) NOT NULL,
  `m_id` int(11) NOT NULL,
  `status_from` tinyint(1) NOT NULL,
  `status_to` tinyint(1) NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `post_id` int(11) NOT NULL,
  `topic` varchar(30) NOT NULL,
  `by` varchar(30) NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `topic`, `by`) VALUES
(0, 'programming', 'Petr'),
(8, 'entertainment', 'Anudeep'),
(16, 'food and Health', 'Gennady');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE IF NOT EXISTS `replies` (
  `serial` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `rep_id` int(11) NOT NULL,
  `root` int(11) NOT NULL,
  `by` varchar(30) NOT NULL,
  PRIMARY KEY (`serial`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`serial`, `post_id`, `rep_id`, `root`, `by`) VALUES
(0, 0, 1, 0, 'Petr'),
(1, 0, 2, 1, 'Gennady'),
(2, 0, 3, 2, 'Petr'),
(3, 0, 4, 2, 'Petr'),
(4, 0, 5, 2, 'Petr'),
(5, 0, 6, 2, 'Petr'),
(6, 0, 7, 0, 'Anudeep'),
(7, 8, 1, 8, 'Anudeep'),
(8, 8, 2, 1, 'Petr'),
(9, 8, 3, 8, 'Petr'),
(10, 8, 4, 8, 'Gennady'),
(11, 0, 8, 6, 'Gennady'),
(12, 0, 9, 7, 'Gennady'),
(13, 8, 5, 3, 'Gennady'),
(14, 16, 1, 16, 'Gennady'),
(15, 16, 2, 16, 'Anudeep'),
(16, 16, 3, 1, 'dhruvab21');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `uname` varchar(30) NOT NULL,
  `technology` tinyint(1) NOT NULL,
  `fashion` tinyint(1) NOT NULL,
  `science` tinyint(1) NOT NULL,
  `politics` tinyint(1) NOT NULL,
  `programming` tinyint(1) NOT NULL,
  `internet` tinyint(1) NOT NULL,
  `gadgets` tinyint(1) NOT NULL,
  `designing` tinyint(1) NOT NULL,
  `productivity` tinyint(1) NOT NULL,
  `movies` tinyint(1) NOT NULL,
  `innovation` tinyint(1) NOT NULL,
  `social networking` tinyint(1) NOT NULL,
  `entertainment` tinyint(1) NOT NULL,
  `music` tinyint(1) NOT NULL,
  `culture` tinyint(1) NOT NULL,
  `literature` tinyint(1) NOT NULL,
  `arts` tinyint(1) NOT NULL,
  `food and health` tinyint(1) NOT NULL,
  `exercise` tinyint(1) NOT NULL,
  `relationships` tinyint(1) NOT NULL,
  `religion` tinyint(1) NOT NULL,
  `sports` tinyint(1) NOT NULL,
  `nature` tinyint(1) NOT NULL,
  PRIMARY KEY (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`uname`, `technology`, `fashion`, `science`, `politics`, `programming`, `internet`, `gadgets`, `designing`, `productivity`, `movies`, `innovation`, `social networking`, `entertainment`, `music`, `culture`, `literature`, `arts`, `food and health`, `exercise`, `relationships`, `religion`, `sports`, `nature`) VALUES
('admin@bony', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('admin@harsh', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
('Anudeep', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0),
('dhruvab21', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0),
('Gennady', 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0),
('Petr', 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uname` varchar(30) NOT NULL,
  `pwd` varchar(20) NOT NULL,
  `email` varchar(40) NOT NULL,
  `dob` date NOT NULL,
  `userpicture` tinyint(1) NOT NULL,
  PRIMARY KEY (`uname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uname`, `pwd`, `email`, `dob`, `userpicture`) VALUES
('admin@bony', 'root', 'bonyroopchandani@gmail.com', '1994-08-18', 1),
('admin@harsh', 'root', 'harshsharma873@gmail.com', '1994-12-22', 1),
('Anudeep', '1234', 'anudeep@gmail.com', '1992-03-04', 1),
('dhruvab21', 'dhruva', 'dhruva@dhruva.com', '1988-02-03', 0),
('Gennady', '1234', 'gennady@gmail.com', '1996-09-19', 1),
('Petr', '1234', 'Petr@gmail.com', '1994-08-18', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
