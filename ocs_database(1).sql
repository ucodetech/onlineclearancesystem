-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 17, 2022 at 05:45 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ocs_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL,
  `school` varchar(255) NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`, `school`, `deleted`) VALUES
(1, 'SCIENCE LABORATORY TECHNOLOGY ', '', 0),
(2, 'FOOD SCIENCE AND TECHNOLOGY', '', 0),
(3, 'LEISURE AND TOURISM MANAGEMENT', '', 0),
(4, 'HOSPITALITY MANAGEMENT AND TECHNOLOGY', '', 0),
(5, 'COMPUTER SCIENCE', '', 0),
(6, 'MATHEMATICS AND STATISTICS', '', 0),
(7, 'MECHANICAL ENGINEERING (POWER)', '', 0),
(8, 'MECHANICAL ENGINEERING (MANUFACTURING)', '', 0),
(9, 'ELECTRICAL AND ELECTRONICS ENGINEERING ', '', 0),
(10, 'ACCOUNTANCY', '', 0),
(11, 'MARKETING', '', 0),
(12, 'OFFICE TECHNOLOGY MANAGEMENT', '', 0),
(13, 'BUSINESS ADMINISTRATION AND MANAGEMENT STUDIES', '', 0),
(14, 'ARCHITECTURAL TECHNOLOGY', '', 0),
(15, 'PUBLIC ADMINISTRATION', '', 0),
(16, 'SURVEYING AND GEOINFORMATICS', '', 0),
(17, 'BUILDING TECHNOLOGY', '', 0),
(18, 'FOUNDRY ENGINEERING TECHNOLOGY', '', 0),
(19, 'CIVIL ENGINEERING', '', 0),
(20, ' METALLURGICAL AND MATERIALS ENGINEERING', '', 0),
(21, 'QUANTITY SURVEYING', '', 0),
(22, 'ESTATE MANAGEMENT AND VALUATION', '', 0),
(23, 'URBAN AND REGIONAL PLANNING', '', 0),
(24, 'LIBRARY AND INFORMATION SCIENCE', '', 0),
(30, 'STUDENT AFFAIRS', 'GENERAL', 0),
(31, 'STUDENT ACCOUNT', 'GENERAL', 0),
(32, 'EDC', 'GENERAL', 0),
(33, 'STORE', 'GENERAL', 0),
(34, 'HOSTEL', 'GENERAL', 0),
(35, 'HEAD STUDENT AFFAIRS', 'GENERAL', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `feedback` text NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp(),
  `replied` tinyint(4) NOT NULL DEFAULT 0,
  `deleted` int(2) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `monitorHead`
--

CREATE TABLE `monitorHead` (
  `id` int(11) NOT NULL,
  `super_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `otp_table`
--

CREATE TABLE `otp_table` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(32) DEFAULT NULL,
  `verified` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `permission` varchar(200) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `permission`, `deleted`) VALUES
(1, 'superuser,library,student_affairs,student_account,head_academic_affairs,store,sport,edc,hostel,HOD', 0),
(2, 'library', 0),
(3, 'student_affairs', 0),
(4, 'student_account', 0),
(5, 'HOD', 0),
(6, 'edc', 0),
(7, 'store', 0),
(8, 'hostel', 0),
(9, 'head_academic_affairs', 0),
(10, 'sport', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pwdReset`
--

CREATE TABLE `pwdReset` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` text NOT NULL,
  `pwdResetExpires` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `offices` text NOT NULL,
  `cleared` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `userid`, `offices`, `cleared`) VALUES
(1, 2, 'library', 1),
(2, 2, 'student_affairs', 1),
(3, 2, 'student_account', 0),
(4, 2, 'head_academic_affairs', 0),
(5, 2, 'store', 0),
(6, 2, 'sport', 0),
(7, 2, 'edc', 0),
(8, 2, 'hostel', 0),
(9, 2, 'HOD', 1),
(10, 1, 'library', 0),
(11, 1, 'student_affairs', 0),
(12, 1, 'student_account', 0),
(13, 1, 'head_academic_affairs', 0),
(14, 1, 'store', 0),
(15, 1, 'sport', 0),
(16, 1, 'edc', 0),
(17, 1, 'hostel', 0),
(18, 1, 'HOD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `requireHistory`
--

CREATE TABLE `requireHistory` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `school_form` varchar(200) DEFAULT NULL,
  `admission_letter` varchar(200) DEFAULT NULL,
  `acceptance_letter` varchar(200) DEFAULT NULL,
  `undertaken_form` varchar(200) DEFAULT NULL,
  `state_of_origin` varchar(200) DEFAULT NULL,
  `jamb_result` varchar(200) DEFAULT NULL,
  `medical_report` varchar(200) DEFAULT NULL,
  `clearance_form_hod` varchar(200) DEFAULT NULL,
  `school_fees_breakdown` varchar(200) DEFAULT NULL,
  `olevel_result` varchar(200) DEFAULT NULL,
  `birth_certificate` varchar(200) DEFAULT NULL,
  `it_letter` varchar(200) DEFAULT NULL,
  `nd_result` varchar(200) DEFAULT NULL,
  `jamb_admission_letter` varchar(200) DEFAULT NULL,
  `course_form` varchar(200) DEFAULT NULL,
  `nacoss_and_journal` varchar(200) DEFAULT NULL,
  `bio_data_form` varchar(200) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `requireHistoryDpt`
--

CREATE TABLE `requireHistoryDpt` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `school_form` varchar(200) DEFAULT NULL,
  `admission_letter` varchar(200) DEFAULT NULL,
  `acceptance_letter` varchar(200) DEFAULT NULL,
  `undertaken_form` varchar(200) DEFAULT NULL,
  `state_of_origin` varchar(200) DEFAULT NULL,
  `jamb_result` varchar(200) DEFAULT NULL,
  `medical_report` varchar(200) DEFAULT NULL,
  `clearance_form_hod` varchar(200) DEFAULT NULL,
  `school_fees_breakdown` varchar(200) DEFAULT NULL,
  `olevel_result` varchar(200) DEFAULT NULL,
  `birth_certificate` varchar(200) DEFAULT NULL,
  `it_letter` varchar(200) DEFAULT NULL,
  `nd_result` varchar(200) DEFAULT NULL,
  `jamb_admission_letter` varchar(200) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schoolsTable`
--

CREATE TABLE `schoolsTable` (
  `id` int(11) NOT NULL,
  `school` text NOT NULL,
  `deleted` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `studentFiles`
--

CREATE TABLE `studentFiles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_form` varchar(200) NOT NULL,
  `admission_letter` varchar(200) NOT NULL,
  `acceptance_letter` varchar(200) NOT NULL,
  `undertaken_form` varchar(200) NOT NULL,
  `state_of_origin` varchar(200) NOT NULL,
  `jamb_result` varchar(200) NOT NULL,
  `medical_report` varchar(200) NOT NULL,
  `clearance_form_hod` varchar(200) NOT NULL,
  `school_fees_breakdown` varchar(200) NOT NULL,
  `olevel_result` varchar(200) DEFAULT NULL,
  `birth_certificate` varchar(200) NOT NULL,
  `it_letter` varchar(200) DEFAULT NULL,
  `nd_result` varchar(200) DEFAULT NULL,
  `jamb_admission_letter` varchar(200) NOT NULL,
  `course_form` varchar(200) DEFAULT NULL,
  `nacoss_and_journal` varchar(200) NOT NULL,
  `bio_data_form` varchar(200) DEFAULT NULL,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `signature` varchar(100) DEFAULT 'defaultSign.png',
  `passport` varchar(255) DEFAULT NULL,
  `id_card` varchar(100) DEFAULT NULL,
  `department` text NOT NULL,
  `matric_no` varchar(25) DEFAULT NULL,
  `level` varchar(30) DEFAULT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `gender` varchar(7) NOT NULL,
  `dob` date DEFAULT NULL,
  `phone_number` varchar(255) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT 0,
  `dateJoined` timestamp NOT NULL DEFAULT current_timestamp(),
  `lastLogin` timestamp NOT NULL DEFAULT current_timestamp(),
  `deleted` tinyint(4) NOT NULL DEFAULT 0,
  `permission` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `signature`, `passport`, `id_card`, `department`, `matric_no`, `level`, `full_name`, `email`, `password`, `gender`, `dob`, `phone_number`, `verified`, `dateJoined`, `lastLogin`, `deleted`, `permission`) VALUES
(1, NULL, 'default.png', NULL, 'COMPUTER SCIENCE', 'FPI/HND/COM/19/045', NULL, 'Ejekwu Graveth', 'ucodetut@gmail.com', '$2y$10$iBNnuYVZdxxFqfsfkcFYAeqIiq90xUlOd6nWFcshU8pmFWzU1w1LG', 'male', NULL, '09152173136', 0, '2021-07-14 20:05:07', '2022-02-15 09:54:17', 0, 'student_hnd'),
(2, NULL, 'default.png', NULL, 'COMPUTER SCIENCE', 'FPI/HND/COM/19/048', 'HND', 'Alex Osi', 'ucodetech.wordpress@gmail.com', '$2y$10$WXblZ5Yq/868dhRtx0cDQ.IYO2gooLIk2b0Rw5CeX1.XNPXn1PsDu', 'female', NULL, '09152173138', 0, '2022-02-09 16:12:50', '2022-02-15 09:57:03', 0, 'student_hnd');

-- --------------------------------------------------------

--
-- Table structure for table `student_session`
--

CREATE TABLE `student_session` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `hash` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `superusers`
--

CREATE TABLE `superusers` (
  `id` int(11) NOT NULL,
  `passport` varchar(255) NOT NULL,
  `signature` varchar(100) DEFAULT 'defaultSign.png',
  `sudo_full_name` varchar(255) NOT NULL,
  `sudo_fileNo` varchar(30) NOT NULL,
  `sudo_department` varchar(100) NOT NULL,
  `sudo_username` varchar(50) DEFAULT NULL,
  `sudo_email` varchar(255) NOT NULL,
  `sudo_phoneNo` varchar(15) NOT NULL,
  `sudo_password` varchar(255) NOT NULL,
  `sudo_permission` varchar(200) NOT NULL,
  `sudo_dateAdded` timestamp NOT NULL DEFAULT current_timestamp(),
  `sudo_lastLogin` timestamp NOT NULL DEFAULT current_timestamp(),
  `sudo_verified` tinyint(4) NOT NULL DEFAULT 0,
  `sudo_deleted` tinyint(4) NOT NULL DEFAULT 0,
  `suspended` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `superusers`
--

INSERT INTO `superusers` (`id`, `passport`, `signature`, `sudo_full_name`, `sudo_fileNo`, `sudo_department`, `sudo_username`, `sudo_email`, `sudo_phoneNo`, `sudo_password`, `sudo_permission`, `sudo_dateAdded`, `sudo_lastLogin`, `sudo_verified`, `sudo_deleted`, `suspended`) VALUES
(6, '118183542-2802629256636143-5005236502389589790-n-76467a2b3ed1b1d0505501c7be7b1759231a.jpg', 'defaultSign.png', 'Ejekwu Graveth', 'FPI/LIB/002', 'COMPUTER SCIENCE', 'Ejekwu-2966', 'ucodetut@gmail.com', '09152173136', '$2y$10$GeLCu0ni0Vw3ETBBCFEQweabpQlxV1.gbitTtp5CSDvkR0IDNPvpO', 'Superuser,library,student_affairs,student_account,store,edc,hostel,HOD', '2021-07-14 20:22:43', '2022-02-15 10:13:56', 1, 0, 0),
(7, 'def.png', 'whatsapp-image-2021-04-09-at-2.01.03-pm-7270-53573c87e8e95e10ece838c7f9e34af102f0.jpeg', 'alex osi chi', 'FPI/SS/001', 'LIBRARY AND INFORMATION SCIENCE', 'alex-7213', 'uzbgraphixsite@gmail.com', '08107972754', '$2y$10$Mm6hpwPZnyjP2eZ9iKxeKe5fqciINdl1vuBGstpwsuWcJKmJFD9Dy', 'library', '2022-02-11 11:03:45', '2022-02-12 11:35:44', 1, 0, 0),
(8, 'def.png', 'signla-66078fee35a2dee70ed75df7a9df7e56203d.jpeg', 'Ajodo Samson', 'FPI/SS/002', 'COMPUTER SCIENCE', 'Ajodo-8288', 'uzbgraphixads@gmail.com', '0807464833', '$2y$10$WF7nMm8hdgtOJH5RqUFU9OEFQtExNHBJhUZiyzo2tAQ4qvJF.0ex2', 'HOD', '2022-02-11 11:53:44', '2022-02-12 11:41:23', 1, 0, 0),
(9, 'default.png', 'whatsapp-image-2020-11-23-at-12.56.09-pm-6410-79989f39b872a731422b21ec00920f59bc7c.jpeg', 'ALEX OSIH jhdjhdj', 'FPI/SS/010', 'STUDENT AFFAIRS', 'ALEX-6477', 'osi@gmail.com', '0906343783', '$2y$10$.sNAM3DgbWk7tak6NP5ueeM2sbE6Z5M96wa8dos3DTKM96y6HBOFS', 'student_affairs', '2022-02-12 11:41:05', '2022-02-12 15:02:01', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `super_profile`
--

CREATE TABLE `super_profile` (
  `id` int(11) NOT NULL,
  `sudo_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `super_profile`
--

INSERT INTO `super_profile` (`id`, `sudo_id`, `status`) VALUES
(6, 6, 1),
(7, 7, 1),
(8, 8, 1),
(9, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `super_session`
--

CREATE TABLE `super_session` (
  `id` int(11) NOT NULL,
  `sudo_id` int(11) NOT NULL,
  `sudo_hash` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `userRequestClearance`
--

CREATE TABLE `userRequestClearance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `library` varchar(200) DEFAULT NULL,
  `library_date` timestamp NULL DEFAULT current_timestamp(),
  `student_affairs` varchar(200) DEFAULT NULL,
  `student_affairs_date` timestamp NULL DEFAULT current_timestamp(),
  `sport` varchar(200) DEFAULT NULL,
  `sport_date` timestamp NULL DEFAULT current_timestamp(),
  `student_account` varchar(200) DEFAULT NULL,
  `student_account_date` timestamp NULL DEFAULT current_timestamp(),
  `HOD` varchar(200) DEFAULT NULL,
  `HOD_date` timestamp NULL DEFAULT current_timestamp(),
  `edc` varchar(200) DEFAULT NULL,
  `edc_date` timestamp NULL DEFAULT current_timestamp(),
  `store` varchar(200) DEFAULT NULL,
  `store_date` timestamp NULL DEFAULT current_timestamp(),
  `hostel` varchar(200) DEFAULT NULL,
  `hostel_date` timestamp NULL DEFAULT current_timestamp(),
  `head_academic_affairs` varchar(200) DEFAULT NULL,
  `head_academic_affairs_date` timestamp NULL DEFAULT current_timestamp(),
  `dateRequested` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pending` int(11) DEFAULT 0,
  `approved` int(11) DEFAULT 0,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userRequestClearance`
--

INSERT INTO `userRequestClearance` (`id`, `user_id`, `library`, `library_date`, `student_affairs`, `student_affairs_date`, `sport`, `sport_date`, `student_account`, `student_account_date`, `HOD`, `HOD_date`, `edc`, `edc_date`, `store`, `store_date`, `hostel`, `hostel_date`, `head_academic_affairs`, `head_academic_affairs_date`, `dateRequested`, `pending`, `approved`, `deleted`) VALUES
(3, 2, 'whatsapp-image-2021-04-09-at-2.01.03-pm-7270-53573c87e8e95e10ece838c7f9e34af102f0.jpeg', '2022-02-12 11:27:49', 'whatsapp-image-2020-11-23-at-12.56.09-pm-6410-79989f39b872a731422b21ec00920f59bc7c.jpeg', '2022-02-12 11:27:49', NULL, '2022-02-12 11:27:49', NULL, '2022-02-12 11:27:49', 'signla-66078fee35a2dee70ed75df7a9df7e56203d.jpeg', '2022-02-12 11:27:49', NULL, '2022-02-12 11:27:49', NULL, '2022-02-12 11:27:49', NULL, '2022-02-12 11:27:49', NULL, '2022-02-12 11:27:49', '2022-02-12 11:42:06', 1, 0, 0),
(4, 1, NULL, '2022-02-15 09:54:51', NULL, '2022-02-15 09:54:51', NULL, '2022-02-15 09:54:51', NULL, '2022-02-15 09:54:51', NULL, '2022-02-15 09:54:51', NULL, '2022-02-15 09:54:51', NULL, '2022-02-15 09:54:51', NULL, '2022-02-15 09:54:51', NULL, '2022-02-15 09:54:51', '2022-02-15 09:54:51', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `userRequestsDepartmentFinal`
--

CREATE TABLE `userRequestsDepartmentFinal` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_form` varchar(200) NOT NULL,
  `admission_letter` varchar(200) NOT NULL,
  `acceptance_letter` varchar(200) NOT NULL,
  `undertaken_form` varchar(200) NOT NULL,
  `state_of_origin` varchar(200) NOT NULL,
  `jamb_result` varchar(200) NOT NULL,
  `medical_report` varchar(200) NOT NULL,
  `clearance_form_hod` varchar(200) NOT NULL,
  `school_fees_breakdown` varchar(200) NOT NULL,
  `olevel_result` varchar(200) DEFAULT NULL,
  `birth_certificate` varchar(200) NOT NULL,
  `it_letter` varchar(200) DEFAULT NULL,
  `nd_result` varchar(200) DEFAULT NULL,
  `jamb_admission_letter` varchar(200) NOT NULL,
  `course_form` varchar(200) DEFAULT NULL,
  `nacoss_and_journal` varchar(200) NOT NULL,
  `bio_data_form` varchar(200) DEFAULT NULL,
  `dateRequested` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `pending` int(11) DEFAULT 0,
  `approved` int(11) DEFAULT 0,
  `deleted` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `verifyAdmin`
--

CREATE TABLE `verifyAdmin` (
  `id` int(11) NOT NULL,
  `sudo_email` varchar(255) NOT NULL,
  `token` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `verifyEmail`
--

CREATE TABLE `verifyEmail` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(64) NOT NULL,
  `dataVerified` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monitorHead`
--
ALTER TABLE `monitorHead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otp_table`
--
ALTER TABLE `otp_table`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdReset`
--
ALTER TABLE `pwdReset`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requireHistory`
--
ALTER TABLE `requireHistory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requireHistoryDpt`
--
ALTER TABLE `requireHistoryDpt`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schoolsTable`
--
ALTER TABLE `schoolsTable`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentFiles`
--
ALTER TABLE `studentFiles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_session`
--
ALTER TABLE `student_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `superusers`
--
ALTER TABLE `superusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sudo_fileNo` (`sudo_fileNo`),
  ADD UNIQUE KEY `sudo_email` (`sudo_email`),
  ADD UNIQUE KEY `sudo_phoneNo` (`sudo_phoneNo`),
  ADD UNIQUE KEY `sudo_username` (`sudo_username`);

--
-- Indexes for table `super_profile`
--
ALTER TABLE `super_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `super_session`
--
ALTER TABLE `super_session`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userRequestClearance`
--
ALTER TABLE `userRequestClearance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userRequestsDepartmentFinal`
--
ALTER TABLE `userRequestsDepartmentFinal`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifyAdmin`
--
ALTER TABLE `verifyAdmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `verifyEmail`
--
ALTER TABLE `verifyEmail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `monitorHead`
--
ALTER TABLE `monitorHead`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `otp_table`
--
ALTER TABLE `otp_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pwdReset`
--
ALTER TABLE `pwdReset`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `requireHistory`
--
ALTER TABLE `requireHistory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `requireHistoryDpt`
--
ALTER TABLE `requireHistoryDpt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `schoolsTable`
--
ALTER TABLE `schoolsTable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `studentFiles`
--
ALTER TABLE `studentFiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `student_session`
--
ALTER TABLE `student_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `superusers`
--
ALTER TABLE `superusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `super_profile`
--
ALTER TABLE `super_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `super_session`
--
ALTER TABLE `super_session`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userRequestClearance`
--
ALTER TABLE `userRequestClearance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `userRequestsDepartmentFinal`
--
ALTER TABLE `userRequestsDepartmentFinal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `verifyAdmin`
--
ALTER TABLE `verifyAdmin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `verifyEmail`
--
ALTER TABLE `verifyEmail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
