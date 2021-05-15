-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2021 at 03:01 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbdocumenttrack`
--

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `college_id` int(11) NOT NULL,
  `college_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`college_id`, `college_name`) VALUES
(1, 'Institute of Computer Science'),
(2, 'College of Engineering'),
(3, 'College of Teacher Education'),
(5, 'College of Liberal Arts'),
(6, 'College of Nursing'),
(10, 'College of Law');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `college_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `college_id`) VALUES
(1, 'Computer Engineering', 2),
(2, 'Mechanical Engineering', 2),
(3, 'Electrical Engineering', 2),
(4, 'Geodetic Engineering', 2),
(5, 'Secondary Education', 3),
(6, 'Elementary Education', 3);

-- --------------------------------------------------------

--
-- Table structure for table `department_user`
--

CREATE TABLE `department_user` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department_user`
--

INSERT INTO `department_user` (`id`, `user_id`, `department_id`) VALUES
(6, 19, 1),
(7, 20, 2),
(8, 21, 5);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `document_id` int(255) NOT NULL,
  `documentType` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `purpose` varchar(255) NOT NULL,
  `created_at` varchar(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `attachment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sentlogs`
--

CREATE TABLE `sentlogs` (
  `id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `dateTimeSent` varchar(200) NOT NULL,
  `tracking_code` varchar(200) NOT NULL,
  `tracking_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `receiverAction` varchar(250) NOT NULL,
  `recipient_user_id` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `trackinglogs`
--

CREATE TABLE `trackinglogs` (
  `id` int(11) NOT NULL,
  `tracking_id` int(11) NOT NULL,
  `tracking_code` varchar(200) NOT NULL,
  `document_id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `recipient_user_id` int(11) NOT NULL,
  `receiverAction` varchar(200) NOT NULL,
  `dateTimeSent` varchar(200) NOT NULL,
  `dateTimeReceive` varchar(200) NOT NULL,
  `receiverNote` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tracking_history`
--

CREATE TABLE `tracking_history` (
  `tracking_id` int(11) NOT NULL,
  `document_id` int(11) NOT NULL,
  `sender_user_id` int(11) NOT NULL,
  `recipient_user_id` int(11) NOT NULL,
  `dateTimeSent` varchar(255) NOT NULL,
  `dateTimeReceive` varchar(255) DEFAULT NULL,
  `receiverAction` varchar(255) DEFAULT NULL,
  `tracking_code` varchar(255) NOT NULL,
  `receiverNote` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Triggers `tracking_history`
--
DELIMITER $$
CREATE TRIGGER `sentLog` AFTER INSERT ON `tracking_history` FOR EACH ROW INSERT into sentlogs VALUES (null,NEW.sender_user_id,NEW.recipient_user_id,NEW.dateTimeSent,NEW.tracking_code)
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `trackinglogs` AFTER UPDATE ON `tracking_history` FOR EACH ROW INSERT into trackinglogs VALUES (null,NEW.tracking_id,NEW.tracking_code,NEW.document_id,NEW.sender_user_id,NEW.recipient_user_id,NEW.receiverAction,NEW.dateTimeSent,NEW.dateTimeReceive,NEW.receiverNote)
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(250) NOT NULL,
  `email` varchar(50) NOT NULL,
  `userType` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `userType`, `username`, `password`) VALUES
(1, 'Ronald Dale', 'dale@gmail.com', 'admin', 'admin', 'admin'),
(19, 'RONALD DALE ALABAN FUENTEBELLA', 'bg201802148@wmsu.edu.ph', 'user', 'dale', 'dale'),
(20, 'Mark Tubat', 'mark@gmail.com', 'user', 'mark', 'mark'),
(21, 'Stephanie Jane', 'step@gmail.com', 'user', 'step', 'step');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`college_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`),
  ADD KEY `college` (`college_id`);

--
-- Indexes for table `department_user`
--
ALTER TABLE `department_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FKuser` (`user_id`),
  ADD KEY `FKdepartment` (`department_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`document_id`),
  ADD KEY `userId` (`user_id`);

--
-- Indexes for table `sentlogs`
--
ALTER TABLE `sentlogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `senderID` (`sender_user_id`);

--
-- Indexes for table `trackinglogs`
--
ALTER TABLE `trackinglogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trackingID` (`tracking_id`),
  ADD KEY `documentID` (`document_id`),
  ADD KEY `sender` (`sender_user_id`),
  ADD KEY `receiver` (`recipient_user_id`);

--
-- Indexes for table `tracking_history`
--
ALTER TABLE `tracking_history`
  ADD PRIMARY KEY (`tracking_id`),
  ADD KEY `documentID` (`document_id`),
  ADD KEY `senderID` (`sender_user_id`),
  ADD KEY `recipientID` (`recipient_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `college_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `department_user`
--
ALTER TABLE `department_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `document_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `sentlogs`
--
ALTER TABLE `sentlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `trackinglogs`
--
ALTER TABLE `trackinglogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `tracking_history`
--
ALTER TABLE `tracking_history`
  MODIFY `tracking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `college` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`college_id`);

--
-- Constraints for table `department_user`
--
ALTER TABLE `department_user`
  ADD CONSTRAINT `FKdepartment` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `document`
--
ALTER TABLE `document`
  ADD CONSTRAINT `userId` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `trackinglogs`
--
ALTER TABLE `trackinglogs`
  ADD CONSTRAINT `receiver` FOREIGN KEY (`recipient_user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tracking_history`
--
ALTER TABLE `tracking_history`
  ADD CONSTRAINT `recipientID` FOREIGN KEY (`recipient_user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
