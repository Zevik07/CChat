-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2021 at 09:22 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cchat`
--

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `groupId` varchar(200) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `member` text NOT NULL,
  `image` text DEFAULT NULL,
  `userCreate` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`groupId`, `name`, `date`, `member`, `image`, `userCreate`) VALUES
('group1', 'Group1', '2021-05-27 10:52:46', 'phu@gmail.com, nhan@gmail.com, trung@gmail.com', NULL, 'phu@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` bigint(20) NOT NULL,
  `sender` varchar(200) NOT NULL,
  `receiver` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `files` text DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `seen` tinyint(1) DEFAULT NULL,
  `received` tinyint(1) DEFAULT NULL,
  `deleted_sender` tinyint(1) DEFAULT NULL,
  `deleted_receiver` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender`, `receiver`, `message`, `files`, `date`, `seen`, `received`, `deleted_sender`, `deleted_receiver`) VALUES
(0, '', '', '', NULL, NULL, NULL, NULL, NULL, NULL),
(1, 'phu@gmail.com', 'nhan@gmail.com', 'hello', '', '2021-05-20 16:03:04', 0, 0, 1, 0),
(2, 'nhan@gmail.com', 'phu@gmail.com', 'how are u', NULL, '2021-05-20 16:05:04', NULL, NULL, NULL, NULL),
(3, 'phu@gmail.com', 'nhan@gmail.com', 'phu', NULL, '2021-05-20 16:07:01', NULL, NULL, NULL, NULL),
(4, 'phu@gmail.com', 'nhan@gmail.com', 'quy', NULL, '2021-05-20 16:08:01', NULL, NULL, NULL, NULL),
(5, 'phu@gmail.com', 'nhan@gmail.com', 'bo', NULL, '2021-05-20 16:08:01', NULL, NULL, NULL, NULL),
(6, 'phu@gmail.com', 'nhan@gmail.com', 'vien', NULL, '2021-05-20 16:09:01', NULL, NULL, NULL, NULL),
(7, 'phu@gmail.com', 'nhan@gmail.com', 'hop', NULL, '2021-05-20 16:10:01', NULL, NULL, NULL, NULL),
(8, 'phu@gmail.com', 'nhan@gmail.com', 'lai', NULL, '2021-05-20 16:11:01', NULL, NULL, NULL, NULL),
(9, 'phu@gmail.com', 'nhan@gmail.com', 'last Msg', NULL, '2021-05-20 16:11:01', NULL, NULL, NULL, NULL),
(10, 'phu@gmail.com', 'nhan@gmail.com', 'last Msg1', NULL, '2021-05-20 16:11:01', NULL, NULL, NULL, NULL),
(11, 'nhan@gmail.com', 'phu@gmail.com', 'l1', NULL, '2021-05-20 16:11:01', NULL, NULL, NULL, NULL),
(12, 'nhan@gmail.com', 'phu@gmail.com', '123', NULL, '2021-05-20 16:11:01', NULL, NULL, NULL, NULL),
(13, 'phu@gmail.com', 'nhan@gmail.com', 'nvhvn', NULL, '2021-05-29 14:19:31', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` bigint(20) NOT NULL,
  `userName` varchar(200) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `password` varchar(64) NOT NULL,
  `date` datetime DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `friend` text DEFAULT NULL,
  `request` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userId`, `userName`, `email`, `gender`, `password`, `date`, `image`, `friend`, `request`) VALUES
(1, 'Phu', 'phu@gmail.com', 'Male', 'password', '2020-12-25 15:31:32', 'public/image/phu.jpg', 'nhan@gmail.com,trung@gmail.com', NULL),
(2, 'Nhan', 'nhan@gmail.com', 'Female', 'password', '2020-12-25 15:31:49', 'public/image/nhan.jpg', 'phu@gmail.com,phu@gmail.com', NULL),
(3, 'Trung', 'trung@gmail.com', 'Male', 'password', '2020-12-25 15:32:10', 'public/image/trung.jpg', 'phu@gmail.com,nhan@gmail.com', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`groupId`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userId`),
  ADD KEY `username` (`userName`),
  ADD KEY `email` (`email`),
  ADD KEY `gender` (`gender`),
  ADD KEY `date` (`date`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
