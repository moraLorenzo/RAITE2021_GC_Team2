-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2021 at 07:50 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gc_team2`
--

-- --------------------------------------------------------

--
-- Table structure for table `accounts_tbl`
--

CREATE TABLE `accounts_tbl` (
  `id` int(11) NOT NULL,
  `username_fld` varchar(50) NOT NULL,
  `emailadd_fld` varchar(50) NOT NULL,
  `token_fld` varchar(100) NOT NULL,
  `password_fld` varchar(100) NOT NULL,
  `role_fld` varchar(10) NOT NULL,
  `createdAt` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `accounts_tbl`
--

INSERT INTO `accounts_tbl` (`id`, `username_fld`, `emailadd_fld`, `token_fld`, `password_fld`, `role_fld`, `createdAt`) VALUES
(2, 'admin1234', 'admin1234@gmail.com', 'ZDcxYThhMjY2ZmUyNzk4YjEzYjNmYjRjNTMwNmNmZTFkMTAwNmJhMGIxNjU1NjIxNTZkNTJjYzM1ZmEwMzVkZA', '$2y$10$ZmI0M2I4Njg0NTdiOWFjMueSmacyTr.uK.QdYuRC/qZuFpQGTdUsW', '0', '2021-11-06 13:10:35'),
(7, 'user1', 'user1@gmail.com', '', '$2y$10$ZWQ4ZjZjYmYzMjY1MTZhYuQ84PSk4zZKrq3t1qZIixfOwTBkXUdCW', '1', '2021-11-06 13:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `employees_tbl`
--

CREATE TABLE `employees_tbl` (
  `id` int(11) NOT NULL,
  `fname_fld` text NOT NULL,
  `mname_fld` text NOT NULL,
  `lname_fld` text NOT NULL,
  `rank_fld` varchar(20) NOT NULL,
  `filename_fld` varchar(50) NOT NULL,
  `isdeleted_fld` int(2) NOT NULL,
  `updatedOn` datetime NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employees_tbl`
--

INSERT INTO `employees_tbl` (`id`, `fname_fld`, `mname_fld`, `lname_fld`, `rank_fld`, `filename_fld`, `isdeleted_fld`, `updatedOn`, `createdOn`) VALUES
(1, 'jose', 'b.', 'dela cruz', 'Third Mate', 'josebdelacruz', 0, '2021-10-23 14:43:27', '2021-10-23 14:43:27'),
(2, 'Rolando', 'M.', 'Vergara', '', '', 0, '2021-11-06 07:47:35', '2021-11-06 14:48:57'),
(3, 'Joaquin', '', 'Mercurio', '', '', 0, '2021-11-06 07:47:35', '2021-11-06 14:48:57'),
(4, 'Jasper', '', 'Yolanda', '', '', 0, '2021-11-06 07:49:11', '2021-11-06 14:49:43'),
(5, 'Jessie', 'C.', 'Aviles', '', '', 0, '2021-11-06 07:49:11', '2021-11-06 14:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `schedules_tbl`
--

CREATE TABLE `schedules_tbl` (
  `id` int(11) NOT NULL,
  `accountId_fld` int(11) NOT NULL,
  `empId_fld` int(11) NOT NULL,
  `scheDate_fld` varchar(10) NOT NULL,
  `scheStatus_fld` varchar(10) NOT NULL,
  `isdeleted_fld` int(2) NOT NULL,
  `updatedOn` datetime NOT NULL,
  `createdOn` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedules_tbl`
--

INSERT INTO `schedules_tbl` (`id`, `accountId_fld`, `empId_fld`, `scheDate_fld`, `scheStatus_fld`, `isdeleted_fld`, `updatedOn`, `createdOn`) VALUES
(2, 1, 2, '2021-11-06', 'pending', 0, '0000-00-00 00:00:00', '2021-11-06 14:16:47'),
(3, 1, 2, '2021-11-06', 'pending', 0, '0000-00-00 00:00:00', '2021-11-06 14:16:54'),
(4, 1, 2, '2021-11-06', 'pending', 0, '0000-00-00 00:00:00', '2021-11-06 14:17:34'),
(5, 2, 2, '2021-11-06', 'pending', 0, '0000-00-00 00:00:00', '2021-11-06 14:22:00'),
(6, 3, 2, '1970-01-01', 'pending', 0, '0000-00-00 00:00:00', '2021-11-06 14:27:13'),
(7, 4, 2, '10/30/2021', 'pending', 0, '0000-00-00 00:00:00', '2021-11-06 14:36:56'),
(8, 5, 2, '10/30/2021', 'pending', 0, '0000-00-00 00:00:00', '2021-11-06 14:47:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accounts_tbl`
--
ALTER TABLE `accounts_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees_tbl`
--
ALTER TABLE `employees_tbl`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedules_tbl`
--
ALTER TABLE `schedules_tbl`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accounts_tbl`
--
ALTER TABLE `accounts_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employees_tbl`
--
ALTER TABLE `employees_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules_tbl`
--
ALTER TABLE `schedules_tbl`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
