-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 28, 2021 lúc 02:34 PM
-- Phiên bản máy phục vụ: 10.4.17-MariaDB
-- Phiên bản PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `cchat`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `group`
--

CREATE TABLE `group` (
  `groupId` varchar(50) NOT NULL,
  `name` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `member` text NOT NULL,
  `image` text DEFAULT NULL,
  `userCreate` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `group`
--

INSERT INTO `group` (`groupId`, `name`, `date`, `member`, `image`, `userCreate`) VALUES
('group1', 'Group1', '2021-05-27 10:52:46', 'phu@gmail.com, nhan@gmail.com, trung@gmail.com', NULL, 'phu@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `message`
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
-- Đang đổ dữ liệu cho bảng `message`
--

INSERT INTO `message` (`id`, `sender`, `receiver`, `message`, `files`, `date`, `seen`, `received`, `deleted_sender`, `deleted_receiver`) VALUES
(1, 'phu@gmail.com', 'nhan@gmail.com', 'hello', '', '2021-05-20 16:03:04', 0, 0, 1, 0),
(2, 'nhan@gmail.com', 'phu@gmail.com', 'how are u', NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'phu@gmail.com', 'nhan@gmail.com', 'good', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
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
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`userId`, `userName`, `email`, `gender`, `password`, `date`, `image`, `friend`, `request`) VALUES
(1, 'Phu', 'phu@gmail.com', 'Male', 'password', '2020-12-25 15:31:32', 'public/image/2.jpg', 'nhan@gmail.com,trung@gmail.com', NULL),
(2, 'Nhan', 'nhan@gmail.com', 'Female', 'password', '2020-12-25 15:31:49', 'public/image/2.jpg', 'phu@gmail.com,phu@gmail.com', NULL),
(3, 'Trung', 'trung@gmail.com', 'Male', 'password', '2020-12-25 15:32:10', 'public/image/2.jpg', 'phu@gmail.com,nhan@gmail.com', NULL),
(4, 'Phu', 'monnatyz@gmail.com', 'Male', '123123', '2021-05-27 10:51:15', 'public/image/2.jpg', NULL, NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`groupId`);

--
-- Chỉ mục cho bảng `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `user`
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
