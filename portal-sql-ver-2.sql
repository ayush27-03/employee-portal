-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2025 at 07:40 AM
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
-- Database: `portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `certifications`
--

CREATE TABLE `certifications` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `issuer` varchar(60) NOT NULL,
  `issueDate` date NOT NULL,
  `certId` varchar(100) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `institution` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`id`, `name`, `institution`, `status`) VALUES
(1, 'B.Tech in Computer Science and Engineering', 'MRU', '0'),
(2, 'B.Tech in Mechanical Engineering', 'IIT Delhi', '0'),
(3, 'B.Tech in Electronics and Communication', 'BITS Pilani', '0'),
(4, 'B.Sc in Data Science', 'Delhi University', '0'),
(5, 'BCA in Cybersecurity', 'MRU', '0'),
(6, 'M.Tech in Artificial Intelligence', 'IIT Bombay', '0'),
(7, 'MBA in Finance', 'IIM Bangalore', '0'),
(8, 'M.Sc in Applied Mathematics', 'Jawaharlal Nehru University', '0'),
(9, 'B.A. in Psychology', 'Jamia Millia Islamia', '0'),
(10, 'B.Com in Accounting and Finance', 'SRCC, Delhi University', '0');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `status`) VALUES
(1, 'IT', '1'),
(2, 'Finance', '1'),
(3, 'Administration', '1'),
(4, 'HR', '1'),
(5, 'Marketing', '1');

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `department` varchar(30) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `zip` varchar(10) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(70) DEFAULT NULL,
  `pan` varchar(20) DEFAULT NULL,
  `aadhaar` varchar(12) DEFAULT NULL,
  `marital_status` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `first_name`, `last_name`, `username`, `password`, `department`, `created_at`, `role`, `status`, `email`, `phone`, `city`, `zip`, `state`, `country`, `pan`, `aadhaar`, `marital_status`, `gender`, `is_deleted`) VALUES
(1, 'Varun', 'Ahlawat', 'varunahlawat2027', '$2y$10$MnoGJ6VolNv/j5OvEVxJde1OfCBaNyulTELlhK0Qq3eQdVIp0d3Qi', '2', '2025-06-26 05:50:54', 5, '0', 'varun2003@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '1'),
(2, 'Ranveer', 'Roy', 'ranveerroy9034', '$2y$10$DdF8BClL1G1HUwGf7/dHKeg.mn8sYF.8ZEXkpADDCqmSlahcL/Jxa', '2', '2025-06-26 05:58:11', 4, '0', 'roy99@gmail.com', '9262347891', 'Lucknow', '226017', 'Uttar Pradesh', 'India', 'ADFKL78', '', 'single', 'male', '0'),
(3, 'abc', 'xyz', 'abcxyz7898', '$2y$10$dvahJcyUzO.UeFr735/pJu8y0BQVLfefkvs012kZgbEGph43AnmAu', '3', '2025-07-01 09:48:59', 1, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(4, 'Abhay', 'Sharma', 'abhaysharma3527', '$2y$10$gIhROI3wGZoi9b5CM9VHHOywhsZSeKmDndCLltDhVn/2kBmVdD.J.', '2', '2025-07-07 09:25:45', 3, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(5, 'C', 'D', 'cd1129', '$2y$10$VxmJLEn6O37JfYQZBM6hTeJ1PGuBB9Db5K6/JupHsqKFEiYvXAdwe', '5', '2025-07-07 09:29:00', 3, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(6, 'd', 'f', 'df9670', '$2y$10$S9gvdLrsovthnuePrSKT3.ayvJfg1yG2h4QEec8sUadPKv1LyN6ye', '3', '2025-07-07 10:21:13', 1, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(7, 'Rohit', 'Sharma', 'rohitsharma2605', '$2y$10$orfwczSoE3sYzCYvy72lOuNYoVEDgMtZ53v6vkF7nIFXLaDtWZeqy', '2', '2025-07-08 04:04:42', 2, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`) VALUES
(1, 'Admin', '1'),
(2, 'HR Manager', '1'),
(3, 'Team Lead', '1'),
(4, 'Tester', '1'),
(5, 'Developer', '1');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` int(70) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `degId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workex`
--

CREATE TABLE `workex` (
  `id` int(11) NOT NULL,
  `empId` int(11) NOT NULL,
  `company` varchar(30) NOT NULL,
  `duration` float NOT NULL,
  `remarks` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `certifications`
--
ALTER TABLE `certifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `degree`
--
ALTER TABLE `degree`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workex`
--
ALTER TABLE `workex`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `certifications`
--
ALTER TABLE `certifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `degree`
--
ALTER TABLE `degree`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `workex`
--
ALTER TABLE `workex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
