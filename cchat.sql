-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 05, 2021 at 08:11 AM
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
  `groupName` varchar(200) NOT NULL,
  `groupDate` datetime NOT NULL,
  `groupMember` text NOT NULL,
  `groupImage` text DEFAULT NULL,
  `userCreate` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`groupId`, `groupName`, `groupDate`, `groupMember`, `groupImage`, `userCreate`) VALUES
('group01', 'NLXDPM', '2021-05-27 10:52:46', 'phu@gmail.com,nhan@gmail.com,trung@gmail.com,loc@gmail.com', 'public/image/Group.jpg', 'phu@gmail.com'),
('group2', 'PM2', '2021-06-05 12:35:26', 'nhan@gmail.com,trung@gmail.com', 'public/image/Group.jpg', 'phu@gmail.com');

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
  `deleted_receiver` tinyint(1) DEFAULT NULL,
  `msgDeleted` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender`, `receiver`, `message`, `files`, `date`, `seen`, `received`, `deleted_sender`, `deleted_receiver`, `msgDeleted`) VALUES
(1, 'phu@gmail.com', 'nhan@gmail.com', 'hello', '', '2021-05-20 16:03:04', 0, 0, 1, 0, 1),
(2, 'nhan@gmail.com', 'phu@gmail.com', 'how are u', NULL, '2021-05-20 16:05:04', NULL, NULL, NULL, NULL, 1),
(3, 'phu@gmail.com', 'nhan@gmail.com', 'phu', NULL, '2021-05-20 16:07:01', NULL, NULL, NULL, NULL, 0),
(4, 'phu@gmail.com', 'nhan@gmail.com', 'quy', NULL, '2021-05-20 16:08:01', NULL, NULL, NULL, NULL, 0),
(25, 'nhan@gmail.com', 'group01', '', 'public/image/16225636422422156492670774875254.jpg', '2021-06-01 23:07:52', NULL, NULL, NULL, NULL, 1),
(26, 'nhan@gmail.com', 'group01', '', 'public/image/16225636771064677309536494492653.jpg', '2021-06-01 23:08:12', NULL, NULL, NULL, NULL, NULL),
(27, 'nhan@gmail.com', 'group01', 'Tgg', 'public/image/16225637003063716173874128379589.jpg', '2021-06-01 23:08:35', NULL, NULL, NULL, NULL, 0),
(28, 'phu@gmail.com', 'group01', 'Nguyễn Hữu Thiên Phú', '', '2021-06-02 15:59:37', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userId` bigint(20) NOT NULL,
  `userName` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
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
(1, ' Thiên Phú KTPM', 'phu@gmail.com', 'Male', '123456', '2020-12-25 15:31:32', 'public/image/phu.jpg-1', 'nhan@gmail.com,trung@gmail.com', 'loc@gmail.com,khang@gmail.com'),
(2, 'Nhan', 'nhan@gmail.com', 'Female', '123456', '2020-12-25 15:31:49', 'public/image/nhan.jpg', 'phu@gmail.com,trung@gmail.com', 'loc@gmail.com,khang@gmail.com'),
(3, 'Trung', 'trung@gmail.com', 'Male', 'password', '2020-12-25 15:32:10', 'public/image/trung.jpg', 'nhan@gmail.com,phu@gmail.com', 'khang@gmail.com,loc@gmail.com'),
(4, 'Loc', 'loc@gmail.com', 'Male', 'password', '2020-12-25 15:32:10', 'public/image/loc.jpg', 'khang@gmail.com,phu@gmail.com', ''),
(5, 'Khang', 'khang@gmail.com', 'Male', 'password', '2020-12-25 15:32:10', 'public/image/khang.jpg', 'loc@gmail.com', '');

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
