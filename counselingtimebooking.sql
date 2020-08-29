-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2019 at 11:10 AM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `counselingtimebooking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`) VALUES
('admin1', 'Haider', 'haider4uiu@gmail.com', '1234'),
('admin2', 'Sir', 'sir@uiu.com', '4321');

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `schedule_id` int(10) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `section` varchar(10) NOT NULL,
  `topic` varchar(100) NOT NULL,
  `teacher_id` varchar(100) NOT NULL,
  `day` varchar(20) NOT NULL,
  `start_time` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`schedule_id`, `student_id`, `student_name`, `course_name`, `section`, `topic`, `teacher_id`, `day`, `start_time`) VALUES
(1, '011133051', 'Haider', 'CN', 'A', 'NAT', 'MIHn', 'Sun', '03:00:00'),
(2, '011133033', 'SK', 'Web', 'A', 'Ajax', 'MIHn', 'Sat', '01:00:00'),
(5, '011133005', 'Saad Sabit', 'Algorithms', 'D', 'Knapsack', 'SS', 'Sat', '12:30:00'),
(6, '011133051', 'Haider Ali', 'AI', 'B', 'KNN', 'SS', 'Sun', '09:30:00'),
(7, '011133005', 'haider', 'Web', 'D', 'Ajax', 'SS', 'Sun', '08:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `counseling_hours`
--

CREATE TABLE `counseling_hours` (
  `id` int(100) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `day` varchar(20) NOT NULL,
  `start_time` time NOT NULL DEFAULT '00:00:00',
  `end_time` time NOT NULL DEFAULT '00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `counseling_hours`
--

INSERT INTO `counseling_hours` (`id`, `teacher_id`, `day`, `start_time`, `end_time`) VALUES
(8, 'MIHn', 'Sun', '01:00:00', '13:59:00'),
(23, 'SS', 'Sun', '08:30:00', '11:00:00'),
(25, 'AZIM', 'Tue', '10:00:00', '14:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(30) NOT NULL,
  `approved` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `email`, `password`, `approved`) VALUES
('011133005', 'sabit', 'asdf@c.com', '1234', 1),
('011133037', 'sk', 'sk@c.com', '2222', 0),
('011133051', 'haider', 'haider@gmail.com', '123456', 0);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` varchar(20) NOT NULL,
  `password` varchar(30) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `room` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `password`, `name`, `phone`, `email`, `room`) VALUES
('AZIM', 'AZIM1234', 'Mohammad Azim', '222222222', 'azim@gmail.com', '529'),
('MIHn', 'MIHn1234', 'Mohammad Imam Hossain', '0123456789', 'imamhossain@gmail.com', '419'),
('SS', 'SS1234', 'Swakkhar Shatabda', '99999999', 'ss@gmail.com', '412');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `counseling_hours`
--
ALTER TABLE `counseling_hours`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `schedule_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `counseling_hours`
--
ALTER TABLE `counseling_hours`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
