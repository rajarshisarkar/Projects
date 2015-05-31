-- phpMyAdmin SQL Dump
-- version 2.11.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 19, 2013 at 07:24 PM
-- Server version: 5.0.51
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hunt`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `name` varchar(800) NOT NULL,
  `feedback` varchar(800) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`name`, `feedback`) VALUES
('aloo', 'potol'),
('rajarshi', 'nice work man !'),
('hi', 'diya'),
('hi', 'diya'),
('hi', 'diya'),
('prem', 'aloobhindilelo'),
('garg', 'dobealoobhindi');

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `sno` bigint(40) NOT NULL,
  `notice1` varchar(1200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`sno`, `notice1`) VALUES
(0, 'Hunt has started ! Login to play ! Use less lifelines to score more ! \\m/ ');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `qno` bigint(40) NOT NULL,
  `qdesc` varchar(800) NOT NULL,
  `lifeline1` varchar(800) NOT NULL,
  `lifeline2` varchar(800) NOT NULL,
  `imagename` varchar(40) NOT NULL,
  `answer` varchar(40) NOT NULL,
  `counter` bigint(20) NOT NULL,
  PRIMARY KEY  (`qno`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qno`, `qdesc`, `lifeline1`, `lifeline2`, `imagename`, `answer`, `counter`) VALUES
(1, 'I might be in your hand. Am I ?', 'http://en.wikipedia.org/wiki/Stone_Cold_Steve_Austin', 'http://in.redhat.com/', 'sun', 'ruby', 0),
(2, 'Relation is the way in which two or more concepts, objects, or people are connected.', 'http://en.wikipedia.org/wiki/Larry_Page', 'http://en.wikipedia.org/wiki/Four-stroke_engine', 'search', 'googleindia', 0),
(3, 'Do you think that the designer has not used something in this page ?', 'http://en.wikipedia.org/wiki/Pen', 'http://en.wikipedia.org/wiki/Universe', 'font', 'verdana', 0),
(4, 'Do you have a brother ? FYI your brother is a boy or a man who has the same parents as you.', 'http://en.wikipedia.org/wiki/Johnny_Depp', 'http://en.wikipedia.org/wiki/Inception', 'firewarning', 'warnerbros', 0),
(5, 'It looks absolutely real.Yes,it is the only clue for you.', 'http://en.wikipedia.org/wiki/Amitabh_Bachchan', 'http://en.wikipedia.org/wiki/Shahrukh_Khan', 'nelson', 'madametussauds', 0),
(6, 'Nine out of ten people like chocolate. The tenth person always lies. - John Q. Tullius', 'https://developer.apple.com/technologies/mac/cocoa.html', 'http://en.wikipedia.org/wiki/Cattle', 'dipd', 'dairymilk', 0),
(7, 'The notion of getting under the hood and explaining how something works, that is fairly familiar territory to me.', 'http://en.wikipedia.org/wiki/Joseph_Gordon-Levitt', 'http://en.wikipedia.org/wiki/Inception', 'close_enough', 'robinhood', 0),
(8, 'What would you drink if you are thirsty ?', 'http://www.pure.com/', 'http://en.wikipedia.org/wiki/Water', 'thirst', 'eurekaforbes', 0),
(9, 'You can find me somewhere in Scotland and Australia.', 'http://en.wikipedia.org/wiki/River', 'http://www.soccerbase.com/players/player.sd?player_id=45895', 'c___e', 'clyde', 0),
(10, 'I am a very very famous Indian celebrity.', 'http://en.wikipedia.org/wiki/Holi', 'http://www.thefreedictionary.com/don', 'tall', 'amitabhbachchan', 0),
(11, 'Well , you can go back to 1947 to find me.', 'http://en.wikipedia.org/wiki/Dalit', 'http://en.wikipedia.org/wiki/Devdas_(1955_film)', '1947', 'mahatmagandhi', 0),
(12, 'You should watch some TV to answer this.', 'http://timesofindia.indiatimes.com/topic/free-roaming/news/', 'http://www.ndtv.com/topic/sms-limit/news', 'nohint', 'idea', 0),
(13, 'Sssshhhh....do not say it now..', 'http://en.wikipedia.org/wiki/WikiLeaks', 'http://en.wikipedia.org/wiki/Townsville,_Queensland', 'secret', 'julianassange', 0),
(14, 'Say my last name.', 'http://en.wikipedia.org/wiki/X-Men', 'http://en.wikipedia.org/wiki/Jerry_O%27Connell', 'change', 'romjin', 0),
(15, 'My mother taught me to share stuffs with friends.', 'http://en.wikipedia.org/wiki/Linux', 'http://en.wikipedia.org/wiki/Microsoft_Windows', 'networking', 'samba', 0),
(16, 'Bow your heads.You need to enter the name of one god here.', 'http://en.wikipedia.org/wiki/India_at_the_Cricket_World_Cup', 'http://en.wikipedia.org/wiki/2011_Cricket_World_Cup', 'god', 'sachinrameshtendulkar', 0),
(17, 'October 4th was a memorable day for me.', 'http://en.wikipedia.org/wiki/Multilingualism', 'http://en.wikipedia.org/wiki/PHP', 'degree', 'markzuckerberg', 0),
(18, 'Lets play a game inside a game in this question.', 'http://en.wikipedia.org/wiki/Stone_Cold_Steve_Austin', 'http://en.wikipedia.org/wiki/Spock', 'gay', 'sheldoncooper', 0),
(19, 'And that is why I fear doctors.', 'http://en.wikipedia.org/wiki/Attack_(computing)', 'http://en.wikipedia.org/wiki/Cyber', 'login', 'sqlinjection', 0),
(20, 'So , you really thought I will provide you any hint for this question. LOL...you are amazing...', 'http://en.wikipedia.org/wiki/Encryption', 'http://en.wikipedia.org/wiki/HTTP_cookie', '6566acabef3008d24f5c14cbdb450855', 'obama', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(80) NOT NULL,
  `password` varchar(80) NOT NULL,
  `college` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `phone` bigint(40) NOT NULL,
  `level` bigint(40) NOT NULL,
  `score` bigint(40) NOT NULL,
  `huntstatus` bigint(40) NOT NULL,
  `life1_1` bigint(40) NOT NULL,
  `life1_2` bigint(40) NOT NULL,
  `life2_1` bigint(40) NOT NULL,
  `life2_2` bigint(40) NOT NULL,
  `life3_1` bigint(40) NOT NULL,
  `life3_2` bigint(40) NOT NULL,
  `life4_1` bigint(40) NOT NULL,
  `life4_2` bigint(20) NOT NULL,
  `life5_1` bigint(40) NOT NULL,
  `life5_2` bigint(20) NOT NULL,
  `life6_1` bigint(20) NOT NULL,
  `life6_2` bigint(20) NOT NULL,
  `life7_1` bigint(20) NOT NULL,
  `life7_2` bigint(20) NOT NULL,
  `life8_1` bigint(20) NOT NULL,
  `life8_2` bigint(20) NOT NULL,
  `life9_1` bigint(20) NOT NULL,
  `life9_2` bigint(20) NOT NULL,
  `life10_1` bigint(20) NOT NULL,
  `life10_2` bigint(20) NOT NULL,
  `life11_1` bigint(20) NOT NULL,
  `life11_2` bigint(20) NOT NULL,
  `life12_1` bigint(20) NOT NULL,
  `life12_2` bigint(20) NOT NULL,
  `life13_1` bigint(20) NOT NULL,
  `life13_2` bigint(20) NOT NULL,
  `life14_1` bigint(20) NOT NULL,
  `life14_2` bigint(20) NOT NULL,
  `life15_1` bigint(20) NOT NULL,
  `life15_2` bigint(20) NOT NULL,
  `life16_1` bigint(20) NOT NULL,
  `life16_2` bigint(20) NOT NULL,
  `life17_1` bigint(20) NOT NULL,
  `life17_2` bigint(20) NOT NULL,
  `life18_1` bigint(20) NOT NULL,
  `life18_2` bigint(20) NOT NULL,
  `life19_1` bigint(20) NOT NULL,
  `life19_2` bigint(20) NOT NULL,
  `life20_1` bigint(20) NOT NULL,
  `life20_2` bigint(20) NOT NULL,
  `life21_1` bigint(20) NOT NULL,
  `life21_2` bigint(20) NOT NULL,
  `life22_1` bigint(20) NOT NULL,
  `life22_2` bigint(20) NOT NULL,
  `life23_1` bigint(20) NOT NULL,
  `life23_2` bigint(20) NOT NULL,
  PRIMARY KEY  (`name`,`email`,`phone`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `password`, `college`, `email`, `phone`, `level`, `score`, `huntstatus`, `life1_1`, `life1_2`, `life2_1`, `life2_2`, `life3_1`, `life3_2`, `life4_1`, `life4_2`, `life5_1`, `life5_2`, `life6_1`, `life6_2`, `life7_1`, `life7_2`, `life8_1`, `life8_2`, `life9_1`, `life9_2`, `life10_1`, `life10_2`, `life11_1`, `life11_2`, `life12_1`, `life12_2`, `life13_1`, `life13_2`, `life14_1`, `life14_2`, `life15_1`, `life15_2`, `life16_1`, `life16_2`, `life17_1`, `life17_2`, `life18_1`, `life18_2`, `life19_1`, `life19_2`, `life20_1`, `life20_2`, `life21_1`, `life21_2`, `life22_1`, `life22_2`, `life23_1`, `life23_2`) VALUES
('admin', '666', 'BIT Mesra', 'rajarshi1397.11@bitmesra.ac.in', 9471104971, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('alooalo', '12', '12', '12', 12, 7, 59, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('asd', 'asd', 'asd', 'rajarshi1397.11@bitmesra.ac.in', 98, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('avl', 'avl', 'BIT Mesra', 'avl@avl.com', 9471104387, 21, 183, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0),
('garg', 'garg', 'BIT Mesra', 'garg@garg.com', 9465652315, 21, 212, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('hellnoo', '12', 'IIT KGP', '12', 12, 21, 194, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0),
('megaraj', '12', 'BIT Mesra', 'rajarshi1397.11@bitmesra.ac.in', 947104971, 12, 110, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('prem', 'prem', 'BIT Mesra', 'sasa@sasa.com', 9471104687, 2, 25, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('prempre', '12', '12', '12', 12, 7, 60, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('premprem', '11', '11', '11', 11, 7, 59, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('rajarsh', '12', '12', '12', 12, 21, 198, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
('rajarshi', '22', '22', '22', 22, 3, 19, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('sarkar', '12', '12', '12', 12, 6, 49, 1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
('swapan', 'swapan', 'XIM B', 'swapan@nettech.in', 9331590003, 21, 200, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);
