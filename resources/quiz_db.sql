-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 13, 2011 at 08:21 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quiz_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `choices`
--

CREATE TABLE IF NOT EXISTS `choices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `question_id` int(11) NOT NULL,
  `isCorrect` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=101 ;

--
-- Dumping data for table `choices`
--

INSERT INTO `choices` (`id`, `text`, `question_id`, `isCorrect`) VALUES
(1, 'choice1q1', 1, 1),
(2, 'choice2q1', 1, 0),
(3, 'choice3q1', 1, 0),
(4, 'choice4q1', 1, 0),
(5, 'choice1q2', 2, 1),
(6, 'choice2q2', 2, 0),
(7, 'choice3q2', 2, 0),
(8, 'choice4q2', 2, 0),
(9, 'choice1q3', 3, 1),
(10, 'choice2q3', 3, 0),
(11, 'choice3q3', 3, 0),
(12, 'choice4q3', 3, 0),
(13, 'choice1q4', 4, 1),
(14, 'choice2q4', 4, 0),
(15, 'choice3q4', 4, 0),
(16, 'choice4q4', 4, 0),
(17, 'choice1q5', 5, 1),
(18, 'choice2q5', 5, 0),
(19, 'choice3q5', 5, 0),
(20, 'choice4q5', 5, 0),
(21, 'choice1q6', 6, 1),
(22, 'choice2q6', 6, 0),
(23, 'choice3q6', 6, 0),
(24, 'choice4q6', 6, 0),
(25, 'choice1q7', 7, 1),
(26, 'choice2q7', 7, 0),
(27, 'choice3q7', 7, 0),
(28, 'choice4q7', 7, 0),
(29, 'choice1q8', 8, 1),
(30, 'choice2q8', 8, 0),
(31, 'choice3q8', 8, 0),
(32, 'choice4q8', 8, 0),
(33, 'choice1q9', 9, 1),
(34, 'choice2q9', 9, 0),
(35, 'choice3q9', 9, 0),
(36, 'choice4q9', 9, 0),
(37, 'choice1q10', 10, 1),
(38, 'choice2q10', 10, 0),
(39, 'choice3q10', 10, 0),
(40, 'choice4q10', 10, 0),
(41, 'choice1q11', 11, 1),
(42, 'choice2q11', 11, 0),
(43, 'choice3q11', 11, 0),
(44, 'choice4q11', 11, 0),
(45, 'choice1q12', 12, 1),
(46, 'choice2q12', 12, 0),
(47, 'choice3q12', 12, 0),
(48, 'choice4q12', 12, 0),
(49, 'choice1q13', 13, 1),
(50, 'choice2q13', 13, 0),
(51, 'choice3q13', 13, 0),
(52, 'choice4q13', 13, 0),
(53, 'choice1q14', 14, 1),
(54, 'choice2q14', 14, 0),
(55, 'choice3q14', 14, 0),
(56, 'choice4q14', 14, 0),
(57, 'choice1q15', 15, 1),
(58, 'choice2q15', 15, 0),
(59, 'choice3q15', 15, 0),
(60, 'choice4q15', 15, 0),
(61, 'choice1q16', 16, 1),
(62, 'choice2q16', 16, 0),
(63, 'choice3q16', 16, 0),
(64, 'choice4q16', 16, 0),
(65, 'choice1q17', 17, 1),
(66, 'choice2q17', 17, 0),
(67, 'choice3q17', 17, 0),
(68, 'choice4q17', 17, 0),
(69, 'choice1q18', 18, 1),
(70, 'choice2q18', 18, 0),
(71, 'choice3q18', 18, 0),
(72, 'choice4q18', 18, 0),
(73, 'choice1q19', 19, 1),
(74, 'choice2q19', 19, 0),
(75, 'choice3q19', 19, 0),
(76, 'choice4q19', 19, 0),
(77, 'choice1q20', 20, 1),
(78, 'choice2q20', 20, 0),
(79, 'choice3q20', 20, 0),
(80, 'choice4q20', 20, 0),
(81, 'choice1q21', 21, 1),
(82, 'choice2q21', 21, 0),
(83, 'choice3q21', 21, 0),
(84, 'choice4q21', 21, 0),
(85, 'choice1q22', 22, 1),
(86, 'choice2q22', 22, 0),
(87, 'choice3q22', 22, 0),
(88, 'choice4q22', 22, 0),
(89, 'choice1q23', 23, 1),
(90, 'choice2q23', 23, 0),
(91, 'choice3q23', 23, 0),
(92, 'choice4q23', 23, 0),
(93, 'choice1q24', 24, 1),
(94, 'choice2q24', 24, 0),
(95, 'choice3q24', 24, 0),
(96, 'choice4q24', 24, 0),
(97, 'choice1q25', 25, 1),
(98, 'choice2q25', 25, 0),
(99, 'choice3q25', 25, 0),
(100, 'choice4q25', 25, 0);

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE latin1_general_ci NOT NULL,
  `default` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `default`) VALUES
(1, 'set A', 1);

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quiz_id` int(11) NOT NULL,
  `time` double(15,2) NOT NULL,
  `consumed` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `logs`
--


-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `text` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `difficulty` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=26 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `topic_id`, `text`, `difficulty`) VALUES
(1, 1, 't1q1 - id1', 1),
(2, 1, 't1q2 - id2', 1),
(3, 1, 't1q3 - id3', 1),
(4, 1, 't1q4 - id4', 1),
(5, 1, 't1q5 - id5', 1),
(6, 2, 't2q1 - id6', 1),
(7, 2, 't2q2 - id7', 1),
(8, 2, 't2q3 - id8', 1),
(9, 2, 't2q4 - id9', 1),
(10, 2, 't2q5 - id10', 1),
(11, 3, 't3q1 - id11', 1),
(12, 3, 't3q2 - id12', 1),
(13, 3, 't3q3 - id13', 1),
(14, 3, 't3q4 - id14', 1),
(15, 3, 't3q5 - id15', 1),
(16, 4, 't4q1 - id16', 1),
(17, 4, 't4q2 - id17', 1),
(18, 4, 't4q3 - id18', 1),
(19, 4, 't4q4 - id19', 1),
(20, 4, 't4q5 - id20', 1),
(21, 5, 't5q1 - id21', 1),
(22, 5, 't5q2 - id22', 1),
(23, 5, 't5q3 - id23', 1),
(24, 5, 't5q4 - id24', 1),
(25, 5, 't5q5 - id25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `question_quizzes`
--

CREATE TABLE IF NOT EXISTS `question_quizzes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `is_marked` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `question_quizzes`
--


-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE IF NOT EXISTS `quizzes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `user_email` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `code` varchar(30) COLLATE latin1_general_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `notes` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `allotted_time` double NOT NULL,
  `is_finished` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=1 ;

--
-- Dumping data for table `quizzes`
--


-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `title`) VALUES
(1, 'topic1'),
(2, 'topic2'),
(3, 'topic3'),
(4, 'topic4'),
(5, 'topic5');

-- --------------------------------------------------------

--
-- Table structure for table `topic_groups`
--

CREATE TABLE IF NOT EXISTS `topic_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) NOT NULL,
  `group_id` int(11) NOT NULL,
  `items` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `topic_groups`
--

INSERT INTO `topic_groups` (`id`, `topic_id`, `group_id`, `items`) VALUES
(1, 1, 1, 2),
(2, 2, 1, 3),
(3, 3, 1, 2),
(4, 4, 1, 3),
(5, 5, 1, 2);
