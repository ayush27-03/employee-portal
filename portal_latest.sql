-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 02:41 PM
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
  `empId` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `issuer` varchar(60) NOT NULL,
  `issueDate` date NOT NULL,
  `status` enum('0','1') NOT NULL,
  `fileName` varchar(250) NOT NULL,
  `filePath` varchar(450) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `degree`
--

CREATE TABLE `degree` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `degree`
--

INSERT INTO `degree` (`id`, `name`, `status`, `is_deleted`) VALUES
(1, 'B.Tech in Computer Science and Engineering', '1', '0'),
(2, 'B.Tech in Mechanical Engineering', '1', '0'),
(3, 'B.Tech in Electronics and Communication', '1', '0'),
(4, 'B.Sc in Data Science', '1', '0'),
(5, 'BCA in Cybersecurity', '1', '0'),
(6, 'M.Tech in Artificial Intelligence', '1', '0'),
(7, 'MBA in Finance', '1', '0'),
(8, 'M.Sc in Applied Mathematics', '1', '0'),
(9, 'B.A. in Psychology', '1', '0'),
(10, 'B.Com in Accounting and Finance', '1', '0'),
(11, 'B.Com in International Economics', '1', '0'),
(12, 'B.Tech in Civil Engineering', '1', '0'),
(13, 'B.Tech in Electrical Engineering', '1', '0'),
(14, 'B.Tech in Chemical Engineering', '1', '0'),
(15, 'B.Tech in Aerospace Engineering', '1', '0'),
(16, 'B.Tech in Biotechnology', '1', '0'),
(17, 'B.Sc in Computer Science', '1', '0'),
(18, 'B.Sc in Mathematics', '1', '0'),
(19, 'B.Sc in Physics', '1', '0'),
(20, 'B.Sc in Chemistry', '1', '0'),
(21, 'B.Sc in Biology', '1', '0'),
(22, 'BBA in Business Administration', '1', '0'),
(23, 'BBA in Digital Marketing', '1', '0'),
(24, 'BBA in Human Resource Management', '1', '0'),
(25, 'B.Des in Fashion Design', '1', '0'),
(26, 'B.Arch in Architecture', '1', '0'),
(27, 'B.Pharm in Pharmacy', '1', '0'),
(28, 'BDS in Dental Surgery', '1', '0'),
(29, 'MBBS in Medicine', '1', '0'),
(30, 'BAMS in Ayurvedic Medicine', '1', '0'),
(31, 'BHMS in Homeopathic Medicine', '1', '0'),
(32, 'B.VSc in Veterinary Science', '1', '0'),
(33, 'BFA in Fine Arts', '1', '0'),
(34, 'LLB in Law', '1', '0'),
(35, 'B.Ed in Education', '1', '0'),
(36, 'B.Tech in Petroleum Engineering', '1', '0'),
(37, 'B.Tech in Agricultural Engineering', '1', '0'),
(38, 'B.Tech in Food Technology', '1', '0'),
(39, 'B.Sc in Environmental Science', '1', '0'),
(40, 'B.Sc in Statistics', '1', '0'),
(41, 'B.Sc in Microbiology', '1', '0'),
(42, 'B.Sc in Forensic Science', '1', '0'),
(43, 'B.Sc in Nutrition and Dietetics', '1', '0'),
(44, 'BBA in International Business', '1', '0'),
(45, 'BBA in Financial Markets', '1', '0'),
(46, 'B.Des in Product Design', '1', '0'),
(47, 'B.Des in Interior Design', '1', '0'),
(48, 'BFA in Applied Arts', '1', '0'),
(49, 'BFA in Visual Communication', '1', '0'),
(50, 'BFA in Sales and Marketing', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`, `status`, `is_deleted`) VALUES
(1, 'IT', '0', '0'),
(2, 'Finance', '1', '0'),
(3, 'Administration', '1', '0'),
(4, 'HR', '1', '0'),
(5, 'Marketing', '1', '0'),
(6, 'Legal', '1', '0'),
(7, 'Operations', '1', '0'),
(8, 'Sales', '1', '0'),
(9, 'R&D', '1', '0'),
(10, 'Customer Support', '1', '0'),
(11, 'Procurement', '1', '0'),
(12, 'QA', '0', '0'),
(13, 'Production', '1', '0'),
(14, 'Strategy & Planning', '1', '0'),
(15, 'Training & Development', '0', '0'),
(16, 'Facilities', '1', '0');

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
(4, 'Abhay', 'Sharma', 'abhaysharma3527', '$2y$10$gIhROI3wGZoi9b5CM9VHHOywhsZSeKmDndCLltDhVn/2kBmVdD.J.', '2', '2025-07-07 09:25:45', 3, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(5, 'C', 'D', 'cd1129', '$2y$10$VxmJLEn6O37JfYQZBM6hTeJ1PGuBB9Db5K6/JupHsqKFEiYvXAdwe', '5', '2025-07-07 09:29:00', 3, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(6, 'd', 'f', 'df9670', '$2y$10$S9gvdLrsovthnuePrSKT3.ayvJfg1yG2h4QEec8sUadPKv1LyN6ye', '3', '2025-07-07 10:21:13', 1, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(7, 'Rohit', 'Sharma', 'rohitsharma2605', '$2y$10$orfwczSoE3sYzCYvy72lOuNYoVEDgMtZ53v6vkF7nIFXLaDtWZeqy', '2', '2025-07-08 04:04:42', 2, '0', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(8, 'Akshay', 'Saini', 'akshaysaini7097', '$2y$10$j7p80u3.5RwGwlmz03pTfOFmFW3bOyS6D/x2OHE496W1BE8kGfAtW', '3', '2025-07-14 03:32:54', 1, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(9, 'Vaibhav', 'Goenka', 'vaibhavgoenka1056', '$2y$10$M/xPj4.aUmdGy652YgmI8O6wEn2Q4wS7Nkg62fW.TFojkntCbfsxK', '2', '2025-07-14 04:53:20', 3, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0'),
(10, 'Keshav', 'Rajora', 'keshavrajora9459', '$2y$10$NKK5akedcqnZEpk2g/5Om.7PSBQrgLz6CdTWKyBhtF.jPGXnzm0Ry', '5', '2025-07-14 05:03:08', 5, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0');

-- --------------------------------------------------------

--
-- Table structure for table `institution`
--

CREATE TABLE `institution` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `status` enum('0','1','','') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `institution`
--

INSERT INTO `institution` (`id`, `name`, `status`, `is_deleted`) VALUES
(1, 'MRU', '1', '0'),
(2, 'IIT Delhi', '1', '0'),
(3, 'BITS Pilani', '1', '0'),
(4, 'Delhi University', '1', '0'),
(5, 'IIT Bombay', '1', '0'),
(6, 'IIM Bangalore', '1', '0'),
(7, 'Jawaharlal Nehru University', '1', '0'),
(8, 'Jamia Millia Islamia', '1', '0'),
(9, 'SRCC, Delhi University', '1', '0'),
(10, 'IIT Madras', '1', '0'),
(11, 'IIT Kanpur', '1', '0'),
(12, 'IIT Kharagpur', '1', '0'),
(13, 'IIT Roorkee', '1', '0'),
(14, 'IIM Ahmedabad', '1', '0'),
(15, 'IIM Calcutta', '1', '0'),
(16, 'IIM Lucknow', '1', '0'),
(17, 'University of Mumbai', '1', '0'),
(18, 'University of Calcutta', '1', '0'),
(19, 'Banaras Hindu University', '1', '0'),
(20, 'Anna University', '1', '0'),
(21, 'Amity University', '1', '0'),
(22, 'Manipal University', '1', '0'),
(23, 'VIT Vellore', '1', '0'),
(24, 'Symbiosis International University', '1', '0'),
(25, 'Christ University', '1', '0'),
(26, 'Ashoka University', '1', '0'),
(27, 'Shiv Nadar University', '1', '0'),
(28, 'OP Jindal Global University', '1', '0'),
(29, 'NMIMS Mumbai', '1', '0'),
(30, 'XLRI Jamshedpur', '1', '0'),
(31, 'TISS Mumbai', '1', '0'),
(32, 'SPJIMR Mumbai', '1', '0'),
(33, 'IMT Ghaziabad', '1', '0'),
(34, 'IIFT Delhi', '1', '0'),
(35, 'FMS Delhi', '1', '0'),
(36, 'MDI Gurgaon', '1', '0'),
(37, 'NIT Trichy', '1', '0'),
(38, 'NIT Surathkal', '1', '0'),
(39, 'DTU Delhi', '1', '0'),
(40, 'NSUT Delhi', '1', '0'),
(41, 'IIIT Hyderabad', '1', '0'),
(42, 'IIIT Bangalore', '1', '0'),
(43, 'NIFT Delhi', '1', '0'),
(44, 'NID Ahmedabad', '1', '0'),
(45, 'MICA Ahmedabad', '1', '0'),
(46, 'IRMA Anand', '1', '0'),
(47, 'TIFR Mumbai', '1', '0'),
(48, 'ISI Kolkata', '1', '0'),
(49, 'NALSAR Hyderabad', '1', '0'),
(50, 'NLU Delhi', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `map`
--

CREATE TABLE `map` (
  `id` int(11) NOT NULL,
  `eid` int(11) NOT NULL,
  `iid` int(11) NOT NULL,
  `degId` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` enum('1','0') NOT NULL DEFAULT '1',
  `description` varchar(250) DEFAULT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `status`, `description`, `is_deleted`) VALUES
(1, 'Admin', '1', 'Superuser with full system control', '0'),
(2, 'HR Manager', '1', 'Handles HR activities and employee relations', '0'),
(3, 'Team Lead', '1', 'Leads a team of developers or testers', '0'),
(4, 'Tester', '1', 'Responsible for testing software applications', '0'),
(5, 'Developer', '1', 'Writes and maintains software code', '0'),
(6, 'Project Manager', '1', 'Manages project timelines and resources', '0'),
(7, 'Product Owner', '1', 'Defines product vision and requirements', '0'),
(8, 'Scrum Master', '1', 'Facilitates agile processes and ceremonies', '0'),
(9, 'UX Designer', '1', 'Designs user experiences and interactions', '0'),
(10, 'UI Developer', '1', 'Implements user interface designs', '0'),
(11, 'Frontend Developer', '1', 'Develops client-side web applications', '0'),
(12, 'Backend Developer', '1', 'Develops server-side applications and APIs', '0'),
(13, 'Full Stack Developer', '1', 'Works on both frontend and backend development', '0'),
(14, 'DevOps Engineer', '1', 'Manages deployment and infrastructure automation', '0'),
(15, 'QA Engineer', '1', 'Ensures software quality through testing', '0'),
(16, 'Business Analyst', '1', 'Analyzes business processes and requirements', '0'),
(17, 'Data Analyst', '1', 'Interprets and analyzes business data', '0'),
(18, 'Data Scientist', '1', 'Builds predictive models and analyzes complex data', '0'),
(19, 'Database Administrator', '1', 'Manages and maintains database systems', '0'),
(20, 'Systems Architect', '1', 'Designs overall system structure and components', '0'),
(21, 'Network Engineer', '1', 'Maintains and configures network infrastructure', '0'),
(22, 'Security Specialist', '1', 'Ensures system and data security', '0'),
(23, 'Technical Writer', '1', 'Creates technical documentation and manuals', '0'),
(24, 'Content Strategist', '1', 'Plans content creation and distribution', '0'),
(25, 'Marketing Specialist', '1', 'Develops and implements marketing strategies', '0'),
(26, 'Sales Executive', '1', 'Handles sales and client acquisition', '0'),
(27, 'Customer Support', '1', 'Provides assistance and support to customers', '0'),
(28, 'IT Support', '1', 'Resolves technical issues for employees', '0'),
(29, 'Office Administrator', '1', 'Manages office operations and administrative tasks', '0'),
(30, 'Finance Manager', '1', 'Oversees financial planning and budgeting', '0'),
(31, 'Accountant', '1', 'Manages financial records and transactions', '0'),
(32, 'Recruiter', '1', 'Sources and hires new talent for the organization', '0'),
(33, 'Training Coordinator', '1', 'Organizes employee training and development programs', '0'),
(34, 'Legal Counsel', '1', 'Provides legal advice and ensures compliance', '0'),
(35, 'Compliance Officer', '1', 'Ensures adherence to laws and regulations', '0'),
(36, 'Operations Manager', '1', 'Manages day-to-day business operations', '0'),
(37, 'Logistics Coordinator', '1', 'Coordinates transportation and supply chain activities', '0'),
(38, 'Facilities Manager', '1', 'Manages building maintenance and services', '0'),
(39, 'Executive Assistant', '1', 'Supports executives with scheduling and coordination', '0'),
(40, 'Graphic Designer', '1', 'Creates visual content and branding materials', '0'),
(41, 'Social Media Manager', '1', 'Manages social media presence and campaigns', '0'),
(42, 'SEO Specialist', '1', 'Optimizes websites for search engines', '0'),
(43, 'Mobile Developer', '1', 'Develops applications for mobile devices', '0'),
(44, 'Game Developer', '1', 'Creates video games and interactive experiences', '0'),
(45, 'AI Engineer', '1', 'Builds artificial intelligence systems', '0'),
(46, 'Machine Learning Specialist', '1', 'Develops machine learning models and algorithms', '0'),
(47, 'Cloud Architect', '1', 'Designs and manages cloud infrastructure', '0'),
(48, 'Blockchain Developer', '1', 'Develops decentralized applications (DApps)', '0'),
(49, 'IoT Specialist', '1', 'Works on Internet of Things (IoT) solutions', '0'),
(50, 'AR/VR Developer', '1', 'Develops augmented and virtual reality applications', '0'),
(51, 'Research Scientist', '1', 'Conducts scientific research and experiments', '0'),
(52, 'Product Designer', '1', 'Designs physical and digital products', '0'),
(53, 'Technical Architect', '1', 'Defines technical structure of software systems', '0'),
(54, 'Solution Architect', '1', 'Designs end-to-end business solutions', '0');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(11) NOT NULL,
  `name` int(70) NOT NULL,
  `status` enum('0','1') DEFAULT NULL,
  `degId` int(11) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
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
  `remarks` varchar(50) NOT NULL,
  `is_deleted` enum('0','1') NOT NULL DEFAULT '0'
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
-- Indexes for table `institution`
--
ALTER TABLE `institution`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `map`
--
ALTER TABLE `map`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `institution`
--
ALTER TABLE `institution`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `map`
--
ALTER TABLE `map`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
