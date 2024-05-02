-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 30, 2024 at 05:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nxt`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `count` int(8) NOT NULL,
  `unique_id` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `emp_name` varchar(100) NOT NULL,
  `latitude` varchar(100) NOT NULL,
  `longitude` varchar(100) NOT NULL,
  `branch` varchar(15) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `day` varchar(12) NOT NULL,
  `present` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`count`, `unique_id`, `email`, `emp_name`, `latitude`, `longitude`, `branch`, `date`, `time`, `day`, `present`) VALUES
(1, '384393201', 'sharadtiwari9967@gmail.com', 'Sharad Tiwari', '19.0759958', '72.889935', 'Powai', '2024-04-12', '07:07:57', 'Sunday', 'IN'),
(2, '384393201', 'sharadtiwari9967@gmail.com', 'Sharad Tiwari', '19.0759958', '72.889935', 'Powai', '2024-04-12', '23:09:58', 'Sunday', 'OUT'),
(3, '384393201', 'sharadtiwari9967@gmail.com', 'Sharad Tiwari', '19.0772948', '72.8832895', 'Kanjurmarg', '2024-04-13', '10:20:00', 'Monday', 'IN'),
(4, '384393201', 'sharadtiwari9967@gmail.com', 'Sharad Tiwari', '19.0772948', '72.8832895', 'Powai', '2024-04-13', '06:30:00', 'Monday', 'OUT'),
(5, '384393201', 'sharadtiwari9967@gmail.com', 'Sharad Tiwari', '19.0771514', '72.8810743', 'Kanjurmarg', '2024-04-14', '22:12:12', 'Tuesday', 'IN'),
(6, '384393201', 'sharadtiwari9967@gmail.com', 'Sharad Tiwari', '19.0771514', '72.8810743', 'Mulund', '2024-04-14', '22:32:38', 'Tuesday', 'OUT'),
(7, '384393201', 'sharadtiwari9967@gmail.com', 'Sharad Tiwari\r\n', '19.0772948', '72.8832895', 'Powai', '2024-04-15', '10:00:00', 'Wednesday', 'IN'),
(8, '384393201', 'sharadtiwari9967@gmail.com', 'Sharad Tiwari', '19.0772948', '72.8832895', 'Powai', '2024-04-15', '06:30:00', 'Wednesday', 'OUT'),
(9, '384393201', 'sharadtiwari9967@gmail.com', 'Sharad Tiwari\r\n', '19.0772948', '72.8832895', 'Powai', '2024-04-11', '12:12:23', 'Thursday', 'IN'),
(10, '384393201', 'sharadtiwari9967@gmail.com', 'Sharad Tiwari\r\n', '19.0772948', '72.8832895', 'Powai', '2024-04-11', '06:30:00', 'Thursday', 'OUT'),
(11, '384393201', 'Sharadtiwari9967@gmail.com', 'Sharad Tiwari', '19.0896769', '72.8863752', 'Mulund', '2024-04-12', '14:12:24', 'Saturday', 'OUT'),
(20, '384393201', 'sharadtiwari9967@gmail.com', 'Sharad Tiwari', '19.1214594', '72.9106086', 'Kanjurmarg', '2024-04-18', '10:13:54', 'Thursday', 'OUT');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `img` varchar(500) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meetings`
--

CREATE TABLE `meetings` (
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Topic` varchar(300) NOT NULL,
  `members` varchar(300) NOT NULL,
  `location` varchar(300) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `status` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meetings`
--

INSERT INTO `meetings` (`Date`, `Time`, `Topic`, `members`, `location`, `duration`, `status`) VALUES
('2024-03-04', '02:02:00', 'Hello', 'Sharad, Pritesh, Code', 'Mulund', '2', 'ACTIVE'),
('2024-03-08', '08:39:05', 'Testing Review', 'Code, Sharad, Pritesh, Andrew', 'Mulund', '3', 'ACTIVE'),
('2025-01-01', '01:01:00', 'Design Review', 'Sharad, Sujal, Pritesh, Code', 'Powai', '4', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `msg_id` int(11) NOT NULL,
  `incoming_msg_id` int(11) NOT NULL,
  `outgoing_msg_id` int(11) NOT NULL,
  `msg` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`msg_id`, `incoming_msg_id`, `outgoing_msg_id`, `msg`) VALUES
(1, 0, 1387837206, 'Hello'),
(2, 638942507, 384393201, 'Hello man'),
(3, 638942507, 384393201, 'Hello man'),
(4, 1214251791, 384393201, 'Hello how are u?'),
(5, 384393201, 638942507, 'Hey Sharad!');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `unique_id` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `img` varchar(300) NOT NULL,
  `company_name` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `phone` varchar(12) NOT NULL,
  `position` varchar(100) NOT NULL,
  `role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`unique_id`, `fname`, `lname`, `email`, `password`, `img`, `company_name`, `status`, `phone`, `position`, `role`) VALUES
(384393201, 'Sharad', 'Tiwari', 'sharadtiwari9967@gmail.com', '6861dd57714551c11b1450d20d15db78', '1709226460anime-live-todoroki-z8y307ml7ee9jtre.png', 'NXTDIGITAL', 'Active', '9967838079', 'Head of Admin Department', 'admin'),
(638942507, 'Code', 'Nepal', 'codenepal@gmail.com', '27637e5210861484dfb1cc9416a2d7b6', '1708758123WIN_20230707_17_04_29_Pro.jpg', 'NXTDIGITAL', 'Active', '9967838079', 'Head of HR Department', 'user'),
(1214251791, 'Sharad', 'Tiwari', 'sharadtiwari969211@gmail.com', '6861dd57714551c11b1450d20d15db78', '1711362260WIN_20230707_17_03_54_Pro.jpg', '', 'InActive', '996783879', 'Technician', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`count`);

--
-- Indexes for table `meetings`
--
ALTER TABLE `meetings`
  ADD PRIMARY KEY (`Date`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`unique_id`),
  ADD KEY `unique_id` (`unique_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `count` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
