-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2023 at 09:31 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance-management-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(200) NOT NULL,
  `admin_password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_username`, `admin_password`) VALUES
(1, 'admin', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `employee_shift` varchar(200) NOT NULL,
  `attendance_date` date DEFAULT NULL,
  `attendance_timeIn` time DEFAULT NULL,
  `attendance_timeOut` time DEFAULT NULL,
  `attendance_status` varchar(200) DEFAULT NULL,
  `employee_id` int(11) NOT NULL,
  `employee_firstName` varchar(200) NOT NULL,
  `employee_lastName` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dept_id` int(11) NOT NULL,
  `dept_code` varchar(20) NOT NULL,
  `dept_name` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dept_id`, `dept_code`, `dept_name`) VALUES
(10209, 'MKD', 'Marketing Department'),
(13846, 'SLD', 'Sales Department'),
(19475, 'ACD', 'Accounting Department'),
(22608, 'ITD', 'Information Technology Department'),
(47670, 'SCD', 'Security Department'),
(54280, 'AMD', 'Admin Department'),
(54575, 'FND', 'Finance Department'),
(76290, 'HRD', 'Human Resources Department'),
(84655, 'CSD', 'Customer Service Department');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(20) NOT NULL,
  `employee_firstName` varchar(200) NOT NULL,
  `employee_lastName` varchar(200) NOT NULL,
  `employee_position` varchar(200) NOT NULL,
  `employee_image` blob NOT NULL,
  `employee_department` varchar(200) NOT NULL,
  `employee_shift` varchar(200) NOT NULL,
  `employee_password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `employee_firstName`, `employee_lastName`, `employee_position`, `employee_image`, `employee_department`, `employee_shift`, `employee_password`) VALUES
(15781, 'Jeff', 'Winger', 'Training Specialist', 0x363436353261326565376534642e706e67, 'Human Resources Department', '08:00:00 - 18:00:00', 'winger'),
(16833, 'Kyle', 'Velez', 'Systems Analyst', 0x363436346339396633383434362e6a7067, 'Admin Department', '07:00:00 - 17:00:00', 'velez'),
(18363, 'Pierce', 'Hawthorne', 'Finance Manager', 0x363436353261346130643436312e706e67, 'Finance Department', '08:00:00 - 18:00:00', 'hawthorne'),
(26321, 'Britta', 'Perry', 'HR Director', 0x363436353239313962343963352e706e67, 'Human Resources Department', '07:30:00 - 16:00:00', 'perry'),
(31659, 'Alexandra Ashley', 'Fernandez', 'Business Analyst', 0x363436346339643438656136322e706e67, 'Admin Department', '07:30:00 - 16:00:00', 'fernandez'),
(32675, 'Annie', 'Edison', 'Accountant', 0x363436353239616532353739632e706e67, 'Accounting Department', '06:00:00 - 16:00:00', 'edison'),
(39373, 'Troy', 'Barnes', 'Cybersecurity Agent', 0x363436353239383133316365332e706e67, 'Security Department', '08:00:00 - 18:00:00', 'barnes'),
(63045, 'Shirley', 'Bennett', 'Sales Director', 0x363436353261376331316564352e706e67, 'Sales Department', '07:30:00 - 16:00:00', 'bennett'),
(78929, 'Abed', 'Nadir', 'IT', 0x363436353239343064306236332e706e67, 'Information Technology Department', '07:30:00 - 16:00:00', 'nadir'),
(81538, 'Eugene', 'Garces', 'Security Engineer', 0x363436346339666635633762312e706e67, 'Admin Department', '06:00:00 - 16:00:00', 'garces'),
(84107, 'John Daxen', 'Occeno', 'Marketing Manager', 0x363436346339623931623761642e706e67, 'Admin Department', '08:00:00 - 18:00:00', 'occeno');

-- --------------------------------------------------------

--
-- Table structure for table `employee_department`
--

CREATE TABLE `employee_department` (
  `emp_dept_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `dept_code` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_department`
--

INSERT INTO `employee_department` (`emp_dept_id`, `employee_id`, `dept_code`) VALUES
(20, 16833, 'AMD'),
(21, 84107, 'AMD'),
(22, 31659, 'AMD'),
(23, 81538, 'AMD'),
(26, 26321, 'HRD'),
(27, 78929, 'ITD'),
(28, 39373, 'SCD'),
(29, 32675, 'ACD'),
(30, 15781, 'HRD'),
(31, 18363, 'FND'),
(32, 63045, 'SLD');

-- --------------------------------------------------------

--
-- Table structure for table `employee_shift`
--

CREATE TABLE `employee_shift` (
  `emp_shift_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `shift_time` varchar(200) NOT NULL,
  `shift_start` time NOT NULL,
  `shift_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employee_shift`
--

INSERT INTO `employee_shift` (`emp_shift_id`, `employee_id`, `shift_time`, `shift_start`, `shift_end`) VALUES
(20, 16833, '07:00:00 - 17:00:00', '07:00:00', '17:00:00'),
(21, 84107, '08:00:00 - 18:00:00', '08:00:00', '18:00:00'),
(22, 31659, '07:30:00 - 16:00:00', '07:30:00', '16:00:00'),
(23, 81538, '06:00:00 - 16:00:00', '06:00:00', '16:00:00'),
(26, 26321, '07:30:00 - 16:00:00', '07:30:00', '16:00:00'),
(27, 78929, '07:30:00 - 16:00:00', '07:30:00', '16:00:00'),
(28, 39373, '08:00:00 - 18:00:00', '08:00:00', '18:00:00'),
(29, 32675, '06:00:00 - 16:00:00', '06:00:00', '16:00:00'),
(30, 15781, '08:00:00 - 18:00:00', '08:00:00', '18:00:00'),
(31, 18363, '08:00:00 - 18:00:00', '08:00:00', '18:00:00'),
(32, 63045, '07:30:00 - 16:00:00', '07:30:00', '16:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `shift_id` int(11) NOT NULL,
  `shift_start` time NOT NULL,
  `shift_end` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shift_id`, `shift_start`, `shift_end`) VALUES
(10551, '07:00:00', '17:00:00'),
(26750, '07:30:00', '16:00:00'),
(46605, '08:00:00', '18:00:00'),
(54332, '06:00:00', '16:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dept_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employee_department`
--
ALTER TABLE `employee_department`
  ADD PRIMARY KEY (`emp_dept_id`);

--
-- Indexes for table `employee_shift`
--
ALTER TABLE `employee_shift`
  ADD PRIMARY KEY (`emp_shift_id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90818;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99059;

--
-- AUTO_INCREMENT for table `employee_department`
--
ALTER TABLE `employee_department`
  MODIFY `emp_dept_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `employee_shift`
--
ALTER TABLE `employee_shift`
  MODIFY `emp_shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93332;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
