-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 16, 2024 at 09:16 AM
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
-- Database: `chapel_users`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_att_usherette`
--

CREATE TABLE `tbl_att_usherette` (
  `tbl_attendance_id` int(11) NOT NULL,
  `tbl_member_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `time_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_att_choir`
--

CREATE TABLE `tbl_att_choir` (
  `tbl_attendance_id` int(11) NOT NULL,
  `tbl_member_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `time_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_att_comi`
--

CREATE TABLE `tbl_att_comi` (
  `tbl_attendance_id` int(11) NOT NULL,
  `tbl_member_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `time_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_att_knights`
--

CREATE TABLE `tbl_att_knights` (
  `tbl_attendance_id` int(11) NOT NULL,
  `tbl_member_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `time_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_att_leccom`
--

CREATE TABLE `tbl_att_leccom` (
  `tbl_attendance_id` int(11) NOT NULL,
  `tbl_member_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `time_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_att_multi`
--

CREATE TABLE `tbl_att_multi` (
  `tbl_attendance_id` int(11) NOT NULL,
  `tbl_member_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `time_in` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'member',
  `image` varchar(255) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `verify_status` tinyint(2) NOT NULL COMMENT '0=no, 1=yes',
  `generate_code` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_att_usherette`
--
ALTER TABLE `tbl_att_usherette`
  ADD PRIMARY KEY (`tbl_attendance_id`);

--
-- Indexes for table `tbl_att_choir`
--
ALTER TABLE `tbl_att_choir`
  ADD PRIMARY KEY (`tbl_attendance_id`);

--
-- Indexes for table `tbl_att_comi`
--
ALTER TABLE `tbl_att_comi`
  ADD PRIMARY KEY (`tbl_attendance_id`);

--
-- Indexes for table `tbl_att_knights`
--
ALTER TABLE `tbl_att_knights`
  ADD PRIMARY KEY (`tbl_attendance_id`);

--
-- Indexes for table `tbl_att_leccom`
--
ALTER TABLE `tbl_att_leccom`
  ADD PRIMARY KEY (`tbl_attendance_id`);

--
-- Indexes for table `tbl_att_multi`
--
ALTER TABLE `tbl_att_multi`
  ADD PRIMARY KEY (`tbl_attendance_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_att_usherette`
--
ALTER TABLE `tbl_att_usherette`
  MODIFY `tbl_attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_att_choir`
--
ALTER TABLE `tbl_att_choir`
  MODIFY `tbl_attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_att_comi`
--
ALTER TABLE `tbl_att_comi`
  MODIFY `tbl_attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_att_knights`
--
ALTER TABLE `tbl_att_knights`
  MODIFY `tbl_attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_att_leccom`
--
ALTER TABLE `tbl_att_leccom`
  MODIFY `tbl_attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_att_multi`
--
ALTER TABLE `tbl_att_multi`
  MODIFY `tbl_attendance_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
