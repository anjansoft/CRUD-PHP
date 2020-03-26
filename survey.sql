-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2018 at 12:30 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `survey`
--

-- --------------------------------------------------------

--
-- Table structure for table `survey`
--

CREATE TABLE `survey` (
  `survey_id` int(11) NOT NULL,
  `survey_name` longtext NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `isdeleted` int(11) DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey`
--

INSERT INTO `survey` (`survey_id`, `survey_name`, `date_created`, `isdeleted`) VALUES
(1, 'Customer Satisfaction & Feedback Survey', '2018-10-27 18:30:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `survey_answers`
--

CREATE TABLE `survey_answers` (
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_name` longtext NOT NULL,
  `answer_flag` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_answers`
--

INSERT INTO `survey_answers` (`answer_id`, `question_id`, `answer_name`, `answer_flag`) VALUES
(1, 1, '1', 0),
(2, 1, '2', 0),
(3, 1, '3', 0),
(4, 1, '4', 0),
(5, 1, '5', 0),
(6, 1, '6', 0),
(7, 1, '7', 0),
(8, 1, '8', 0),
(9, 1, '9', 0),
(10, 1, '10', 0),
(11, 2, '1', 0),
(12, 2, '2', 0),
(13, 2, '3', 0),
(14, 2, '4', 0),
(15, 2, '5', 0),
(16, 3, 'Yes', 0),
(17, 3, 'No', 0),
(33, 6, 'C', 0),
(32, 6, 'B', 0),
(31, 6, 'A', 0),
(21, 4, '1', 0),
(22, 4, '2', 0),
(23, 4, '3', 0),
(24, 4, '4', 0),
(25, 4, '5', 0),
(26, 5, '1', 0),
(27, 5, '2', 0),
(28, 5, '3', 0),
(29, 5, '4', 0),
(30, 5, '5', 0),
(42, 11, 'DD', 0),
(41, 11, 'CC', 0),
(40, 11, 'BB', 0),
(39, 11, 'AA', 0);

-- --------------------------------------------------------

--
-- Table structure for table `survey_questions`
--

CREATE TABLE `survey_questions` (
  `question_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `question_name` longtext NOT NULL,
  `question_type` int(11) DEFAULT '0',
  `question_code` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `survey_questions`
--

INSERT INTO `survey_questions` (`question_id`, `survey_id`, `question_name`, `question_type`, `question_code`) VALUES
(1, 1, 'how likely is that you would recommend the e-merchandise service or product listed to an agent or colleague?', 1, 'a3c8cfba'),
(2, 1, ' how user-friendly is our website\'s interface?', 1, '2f0e0186'),
(3, 1, ' Did we meet the scheduled delivery date?', 1, '6bdf3c1f'),
(4, 1, ' how would you rate the quality of packaging?', 1, '8ff274fd'),
(5, 1, ' how would you rate the over all experience in using e-merchandise?', 1, 'baaf4fd6'),
(6, 1, ' Test checkbox', 3, 'b26a2e23'),
(11, 1, ' Test Radio', 1, 'fc1d703c'),
(10, 1, ' Test textbox', 2, 'd581b176');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '4',
  `user_name` varchar(255) NOT NULL,
  `user_password` varchar(256) NOT NULL,
  `exam_checker` int(11) NOT NULL,
  `contact_number` varchar(15) NOT NULL,
  `user_token` varchar(255) NOT NULL,
  `date_created` date NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `role_id`, `user_name`, `user_password`, `exam_checker`, `contact_number`, `user_token`, `date_created`) VALUES
(1, 'admin', 1, 'admin', '0192023a7bbd73250516f069df18b500', 1, '', '', '0000-00-00'),
(67, 'test1', 4, 'test1', '5a105e8b9d40e1329780d62ea2265d8a', 0, '', '', '0000-00-00'),
(70, 'AnjanReddy Ranabothu', 4, 'anjan111reddy@gmail.com', '', 0, '9652133977', 'd16b74a8', '2018-10-28'),
(71, 'AnjanReddy Ranabothu', 4, 'anjan@gmail.com', '', 0, '9652133977', '72f2b9aa', '2018-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`role_id`, `role_name`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Team Leader'),
(4, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_survey`
--

CREATE TABLE `user_survey` (
  `us_id` int(11) NOT NULL,
  `date_submitted` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_survey`
--

INSERT INTO `user_survey` (`us_id`, `date_submitted`, `user_id`, `survey_id`) VALUES
(8, '2018-10-28', 71, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_survey_answers`
--

CREATE TABLE `user_survey_answers` (
  `user_survey_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `survey_id` int(11) NOT NULL,
  `essay` longtext,
  `question_type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_survey_answers`
--

INSERT INTO `user_survey_answers` (`user_survey_id`, `user_id`, `question_id`, `answer_id`, `survey_id`, `essay`, `question_type`) VALUES
(46, 71, 11, 41, 1, '', 1),
(45, 71, 10, 0, 1, 'Test text box', 2),
(44, 71, 6, 33, 1, '', 3),
(43, 71, 6, 31, 1, '', 3),
(42, 71, 5, 29, 1, '', 1),
(41, 71, 4, 23, 1, '', 1),
(40, 71, 3, 17, 1, '', 1),
(39, 71, 2, 12, 1, '', 1),
(38, 71, 1, 1, 1, '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `survey`
--
ALTER TABLE `survey`
  ADD PRIMARY KEY (`survey_id`);

--
-- Indexes for table `survey_answers`
--
ALTER TABLE `survey_answers`
  ADD PRIMARY KEY (`answer_id`);

--
-- Indexes for table `survey_questions`
--
ALTER TABLE `survey_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `user_survey`
--
ALTER TABLE `user_survey`
  ADD PRIMARY KEY (`us_id`);

--
-- Indexes for table `user_survey_answers`
--
ALTER TABLE `user_survey_answers`
  ADD PRIMARY KEY (`user_survey_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `survey`
--
ALTER TABLE `survey`
  MODIFY `survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `survey_answers`
--
ALTER TABLE `survey_answers`
  MODIFY `answer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `survey_questions`
--
ALTER TABLE `survey_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_survey`
--
ALTER TABLE `user_survey`
  MODIFY `us_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_survey_answers`
--
ALTER TABLE `user_survey_answers`
  MODIFY `user_survey_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
