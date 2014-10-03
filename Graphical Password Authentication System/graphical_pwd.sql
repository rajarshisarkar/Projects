-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2013 at 02:48 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `graphical_pwd`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `layer` bigint(7) NOT NULL,
  `1` varchar(800) NOT NULL,
  `2` varchar(800) NOT NULL,
  `3` varchar(800) NOT NULL,
  `4` varchar(800) NOT NULL,
  `5` varchar(800) NOT NULL,
  PRIMARY KEY  (`layer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `images`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `name` varchar(80) NOT NULL,
  `clg` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` bigint(12) NOT NULL,
  `userimage` varchar(800) NOT NULL,
  `image1` varchar(800) NOT NULL,
  `image2` varchar(800) NOT NULL,
  `image3` varchar(800) NOT NULL,
  `image4` varchar(800) NOT NULL,
  `image5` varchar(800) NOT NULL,
  PRIMARY KEY  (`username`,`email`,`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `name`, `clg`, `email`, `phone`, `userimage`, `image1`, `image2`, `image3`, `image4`, `image5`) VALUES
('12', '12', 'asds', '12', 'http://localhost/project_rajarshi/images/wood.jpg', 1234566541, '', 'http://localhost/project_rajarshi/images/wood.jpg', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/edu.jpg', 'http://localhost/project_rajarshi/images/two.jpg', 'http://localhost/project_rajarshi/images/virus.jpg'),
('45', '45', '45', '45', '45', 4567896547, '', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/two.jpg', 'http://localhost/project_rajarshi/images/edu.jpg', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/two.jpg'),
('admin', '666', 'admin', '', 'rajarshi1397.11@bitmesra.ac.in', 9471104971, '', '', '', '', '', ''),
('aloo', 'aloo', 'aloo', 'aloo', 'aloo', 1236547896, '', 'http://localhost/project_rajarshi/images/wood.jpg', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/edu.jpg', 'http://localhost/project_rajarshi/images/two.jpg', 'http://localhost/project_rajarshi/images/virus.jpg'),
('asa', 'asa', 'asa', 'asa', 'asa', 1233211235, 'images/default.jpg', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/edu.jpg', 'http://localhost/project_rajarshi/images/two.jpg', 'http://localhost/project_rajarshi/images/virus.jpg'),
('gargwa', 'garg', 'Sir Saurabh Garg', 'Birla Institute of Technology , Mesra', 'saurabh@google.com', 8796541238, 'images/default.jpg', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/edu.jpg', 'http://localhost/project_rajarshi/images/two.jpg', 'http://localhost/project_rajarshi/images/virus.jpg', 'http://localhost/project_rajarshi/images/virus.jpg'),
('k', 'k', 'k', 'k', 'k', 4563215698, 'images/default.jpg', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/edu.jpg', 'http://localhost/project_rajarshi/images/two.jpg', 'http://localhost/project_rajarshi/images/virus.jpg', 'http://localhost/project_rajarshi/images/wood.jpg'),
('m', 'm', 'mm', 'mm', 'mm', 4569871234, '', 'http://localhost/project_rajarshi/images/wood.jpg', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/edu.jpg', 'http://localhost/project_rajarshi/images/two.jpg', 'http://localhost/project_rajarshi/images/virus.jpg'),
('q', 'q', 'q', 'q', 'q', 7896541235, 'images/default.jpg', 'http://localhost/project_rajarshi/images/wood.jpg', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/edu.jpg', 'http://localhost/project_rajarshi/images/two.jpg', 'http://localhost/project_rajarshi/images/virus.jpg'),
('raj', 'raj', 'Rajarshi Sarkar', 'BIT Mesra', 'rajarshisarkar80@yahoo.co.in', 7896541236, '', '', '', '', '', ''),
('rajarshi', 'rajarshi', 'Rajarshi Sarkar', 'BIT Mesra Ranchi', 'rajarshi@rajarshi.com', 9456497145, 'images/default.jpg', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/wood.jpg', 'http://localhost/project_rajarshi/images/bit.jpg', 'http://localhost/project_rajarshi/images/wood.jpg', 'http://localhost/project_rajarshi/images/bit.jpg');
