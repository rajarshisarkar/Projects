-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2013 at 07:30 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `number` int(5) NOT NULL,
  `question` varchar(80) NOT NULL,
  `option1` varchar(80) NOT NULL,
  `option2` varchar(80) NOT NULL,
  `option3` varchar(80) NOT NULL,
  `option4` varchar(80) NOT NULL,
  `answer` int(4) NOT NULL,
  PRIMARY KEY  (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`number`, `question`, `option1`, `option2`, `option3`, `option4`, `answer`) VALUES
(1, 'Who is the best batsman in India ?', 'Sachin Tendulkar', 'Sir Ravindra Jadega', 'Gautam Gambhir', 'M.S. Dhoni', 1),
(2, 'Who is the Prime Minister of India ?', 'Bal Thakery', 'Mayawati', 'Man Mohan Singh', 'Mamata Banerjee', 3),
(3, '2+2 = ?', '1', '2', '3', '4', 4),
(4, '1+1 = ?', '1', '2', '3', '4', 2),
(5, '3 * 2 = ?', '3', '4', '5', '6', 4),
(6, '4 / 2 = ?', '6', '2', '3', '4', 2),
(7, '7 + 4 = ?', '8', '9', '6', '11', 4),
(8, '7 * 9 = ?', '98', '65', '63', '42', 3),
(9, 'Who is the director of nettech ?', 'Swapan Purkait', 'Rajarshi Sarkar', 'Udaybhanu Sanyal', 'Mudit Garg', 1),
(10, '3 - 8 = ?', '8', '65', '-4', '-5', 4);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE `result` (
  `name` varchar(80) NOT NULL,
  `roll` int(10) NOT NULL,
  `marks` int(10) NOT NULL,
  PRIMARY KEY  (`roll`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`name`, `roll`, `marks`) VALUES
('avl', 1, -5),
('haathi', 12, 7),
('genda', 22, -5),
('ammu', 44, 4),
('udaywa', 121, 7),
('ashok', 123, -5),
('osamabinladen', 141, 7),
('baigan', 147, -5),
('gautam', 654, 4),
('mayawati', 1111, 1),
('gopal', 1212, 10),
('baba', 1234, 4),
('gaiyya', 1236, 10),
('sajal', 1244, 7),
('Rajarshi', 1397, -5),
('Mudit', 1434, -2),
('potol', 1513, 10),
('lolwa', 2222, -2),
('monu', 2365, 10),
('babu', 3333, 3),
('bablu', 4444, 9),
('atish', 4545, 4),
('santu', 6545, 10),
('laloo', 8888, 7),
('rabri', 8958, -5),
('swapna', 9565, 4),
('hello', 12326, 1),
('coder', 12345, 9);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `roll` int(4) NOT NULL,
  `phone` bigint(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `department` varchar(40) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `password`, `roll`, `phone`, `email`, `department`, `status`) VALUES
('Rajarshi', '9999', 1397, 9999, '999', '9999', 4),
('uday', '99999', 1040, 946, '6565', '2323', 4),
('admin', '666', 666, 666, '666', '666', 1),
('santu', '9999', 6545, 1223, 'santu@nettech.in', 'CSE', 4),
('laloo', '8888', 8888, 8888, '8888', '888', 4),
('rabri', '7777', 8958, 58989, '5656', '9898', 4),
('ammu', '44', 44, 44, '44', '44', 4),
('bablu', '4444', 4444, 4444, '4444', '4444', 4),
('mayawati', '1111', 1111, 1111, '1111', '1111', 4),
('avl', '1', 1, 11, '1', '1', 4),
('baba', '1234', 1234, 9471104971, 'baba@dealing.com', 'Dealing Technology', 4),
('coder', '12', 12345, 12, 'coder@code.com', 'IT', 4),
('babu', '33', 3333, 9471104971, 'babu@baap.com', 'Engineering', 4),
('osamabinladen', '141', 141, 141, 'osama@obama.com', 'Terrorism', 4),
('potol', '321', 1513, 8986617548, 'potol@vegetables.com', 'Vegetables', 4),
('hello', '12', 12326, 12, '12', '12', 4),
('sajal', '1244', 1244, 1244, '1244', '1244', 4),
('ashok', '1', 123, 123, '123', '123', 4),
('gopal', '1212', 1212, 12, '12', '12', 4),
('atish', '4545', 4545, 45, '45', '45', 4),
('baigan', 'hello', 147, 471, '147', '1447', 4),
('haathi', '12', 12, 12, '12', '12', 4),
('vishal', 'vish12', 12, 12, '12', '12', 4),
('genda', '22', 22, 22, '22', '22', 4),
('diya', 'iam', 12, 12, '12', '12', 4),
('h', '1111', 1111, 1111, '1111', '1111', 4),
('gautam', '654', 654, 654, '654', '654', 4),
('gaiyya', '1236', 1236, 1236, '1236', '1236', 4),
('udaywa', '121', 121, 121, '121', '121', 3);
