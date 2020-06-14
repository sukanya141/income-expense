-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2020 at 11:21 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zocute_db_new_210520`
--

-- --------------------------------------------------------

--
-- Table structure for table `plan`
--

CREATE TABLE `plan` (
  `plan_id` int(2) NOT NULL COMMENT 'ไอดีแผน',
  `plan_name` varchar(50) NOT NULL COMMENT 'ชื่อแผน',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `plan`
--

INSERT INTO `plan` (`plan_id`, `plan_name`, `create_at`, `update_at`) VALUES
(1, 'การออม&การลงทุน', '2020-05-21 17:56:21', '2020-05-21 17:57:16'),
(2, 'สาธารณูปโภค(ค่าน้ำ ค่าไฟ ค่าโทรศัพท์ บิลอื่นๆ)', '2020-05-21 17:56:21', '2020-05-21 17:57:47'),
(3, 'ครอบครัว', '2020-05-21 17:56:21', '2020-05-21 17:57:53'),
(4, 'ส่วนตัว', '2020-05-21 17:56:21', '2020-05-21 17:58:10'),
(5, 'สันทนาการ(ช้อปปิ้ง สังสรรค์ ท่องเที่ยว)', '2020-05-21 17:56:21', '2020-05-21 17:57:59'),
(6, 'หนี้สิน', '2020-05-21 17:56:21', '2020-05-21 17:58:04'),
(7, 'อื่นๆ', '2020-05-21 17:56:21', '2020-05-21 17:58:06');

-- --------------------------------------------------------

--
-- Table structure for table `saving`
--

CREATE TABLE `saving` (
  `saving_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  `typemoney_id` int(2) NOT NULL COMMENT 'fk จาก typemoney',
  `saving_detail` varchar(100) NOT NULL COMMENT 'รายละเอียด',
  `saving_value` double NOT NULL,
  `saving_date` datetime NOT NULL DEFAULT current_timestamp(),
  `month_id` int(2) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `saving`
--

INSERT INTO `saving` (`saving_id`, `user_id`, `typemoney_id`, `saving_detail`, `saving_value`, `saving_date`, `month_id`, `create_at`, `update_at`) VALUES
(1, 1, 4, 'วันนี้ออมเงินหน่อยละกันสัก 10 บาท', 10, '2020-05-07 01:32:35', 5, '2020-05-21 18:29:35', '2020-05-21 18:32:45'),
(2, 1, 6, 'ข้าวไก่กระเพราะนะ 60 บาท', 60, '2020-05-07 01:32:46', 5, '2020-05-21 18:29:35', '2020-05-21 18:32:48'),
(3, 1, 6, 'เติมน้ำมัน', 100, '2020-05-08 01:32:56', 5, '2020-05-21 18:29:35', '2020-05-21 18:32:57'),
(4, 2, 4, 'ลงทุนหน่อยละกัน เผื่อได้', 50, '2020-05-23 01:33:01', 5, '2020-05-21 18:29:35', '2020-05-21 18:33:07'),
(5, 2, 6, 'เข้าร้านเกม 2 ชม 15บ*2', 30, '2020-05-23 01:33:08', 5, '2020-05-21 18:29:35', '2020-05-21 18:33:12'),
(6, 2, 6, 'เข้า7-11 ซื้อของทั่วไป', 350, '2020-05-23 01:33:16', 5, '2020-05-21 18:29:35', '2020-05-21 18:33:18'),
(7, 2, 5, '7-11 จ่ายน้ำ 450 ไฟ 2200', 2650, '2020-05-25 01:33:19', 5, '2020-05-21 18:29:35', '2020-05-21 19:45:34'),
(8, 2, 1, 'เงินเข้า 20000', 20000, '2020-05-05 02:43:41', 5, '2020-05-21 19:44:34', '2020-05-21 19:44:34'),
(10, 2, 2, 'จ่ายโทรศัพท์ 250', 250, '2020-05-16 00:00:00', 5, '2020-05-21 21:20:31', '2020-05-21 21:20:31');

-- --------------------------------------------------------

--
-- Table structure for table `typemoney`
--

CREATE TABLE `typemoney` (
  `typemoney_id` int(2) NOT NULL,
  `typemoney_name` varchar(30) NOT NULL,
  `type_tran` enum('รายรับ','รายจ่าย') CHARACTER SET utf8 NOT NULL,
  `typemoney_note` varchar(100) DEFAULT NULL COMMENT 'หมายเหตุ กรณีเลือก อื่นๆ',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `typemoney`
--

INSERT INTO `typemoney` (`typemoney_id`, `typemoney_name`, `type_tran`, `typemoney_note`, `create_at`, `update_at`) VALUES
(1, 'เงินเดือน', 'รายรับ', NULL, '2020-05-21 17:50:42', '2020-05-21 17:50:42'),
(2, 'ดอกเบี้ย', 'รายรับ', NULL, '2020-05-21 17:50:42', '2020-05-21 17:50:42'),
(3, 'อื่นๆ', 'รายรับ', NULL, '2020-05-21 17:50:42', '2020-05-21 17:50:42'),
(4, 'การออม&การลงทุน', 'รายจ่าย', NULL, '2020-05-21 17:50:42', '2020-05-21 17:50:42'),
(5, 'สาธาณูปโภค(ค่าน้ำ ค่าไฟ ค่าโทร', 'รายจ่าย', NULL, '2020-05-21 17:50:42', '2020-05-21 17:50:42'),
(6, 'ครอบครัว&ส่วนตัว', 'รายจ่าย', NULL, '2020-05-21 17:50:42', '2020-05-21 17:50:42'),
(7, 'สันทนาการ', 'รายจ่าย', NULL, '2020-05-21 17:50:42', '2020-05-21 17:50:42'),
(8, 'หนี้สิน', 'รายจ่าย', NULL, '2020-05-21 17:50:42', '2020-05-21 17:50:42'),
(9, 'อื่นๆ', 'รายจ่าย', NULL, '2020-05-21 17:50:42', '2020-05-21 17:50:42');

-- --------------------------------------------------------

--
-- Table structure for table `userplan`
--

CREATE TABLE `userplan` (
  `uplan_id` int(10) NOT NULL,
  `plan_id` int(2) NOT NULL COMMENT 'ไอดีแผนแต่ละชนิด (fk)',
  `uplan_value` double NOT NULL COMMENT 'ค่าแผนแต่ละชนิด',
  `month_id` int(2) NOT NULL,
  `user_id` int(10) NOT NULL COMMENT 'ไอดีผู้ใช้ (fk)',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userplan`
--

INSERT INTO `userplan` (`uplan_id`, `plan_id`, `uplan_value`, `month_id`, `user_id`, `create_at`, `update_at`) VALUES
(1, 1, 1000, 5, 1, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(2, 2, 1050, 5, 1, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(3, 3, 1100, 5, 1, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(4, 4, 1150, 5, 1, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(5, 5, 1200, 5, 1, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(6, 6, 1250, 5, 1, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(7, 7, 1300, 5, 1, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(8, 1, 2000, 5, 2, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(9, 2, 2050, 5, 2, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(10, 3, 2100, 5, 2, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(11, 4, 2150, 5, 2, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(12, 5, 2200, 5, 2, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(13, 6, 2250, 5, 2, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(14, 7, 2300, 5, 2, '2020-05-21 18:24:34', '2020-05-21 18:24:34'),
(15, 1, 500, 6, 2, '2020-05-21 19:33:45', '2020-05-21 19:33:45'),
(16, 2, 5000, 6, 2, '2020-05-21 19:33:45', '2020-05-21 19:33:45'),
(17, 3, 900, 6, 2, '2020-05-21 19:33:45', '2020-05-21 19:33:45'),
(18, 4, 2000, 6, 2, '2020-05-21 19:33:45', '2020-05-21 19:33:45'),
(19, 5, 200, 6, 2, '2020-05-21 19:33:45', '2020-05-21 19:33:45'),
(20, 6, 5000, 6, 2, '2020-05-21 19:33:45', '2020-05-21 19:33:45'),
(21, 7, 5000, 6, 2, '2020-05-21 19:33:45', '2020-05-21 19:33:45');

-- --------------------------------------------------------

--
-- Table structure for table `usersaccount`
--

CREATE TABLE `usersaccount` (
  `user_id` int(10) NOT NULL,
  `user_name` varchar(12) NOT NULL COMMENT 'ชื่อผู้ใช้',
  `user_pass` varchar(30) NOT NULL COMMENT 'รหัสผ่าน',
  `user_email` varchar(30) NOT NULL COMMENT 'อีเมล',
  `user_fname` varchar(30) NOT NULL COMMENT 'ชื่อ',
  `user_sname` varchar(30) NOT NULL COMMENT 'สกุล',
  `user_gen` varchar(10) NOT NULL COMMENT 'เพศ',
  `user_bd` date NOT NULL COMMENT 'วันเกิด',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usersaccount`
--

INSERT INTO `usersaccount` (`user_id`, `user_name`, `user_pass`, `user_email`, `user_fname`, `user_sname`, `user_gen`, `user_bd`, `create_at`, `update_at`) VALUES
(1, 'alicez', '1234', 'alice@g.com', 'alice', 'jojo', 'หญิง', '2000-05-12', '2020-05-21 18:20:19', '2020-05-21 18:20:19'),
(2, 'lijinx83', '1234', 'lijinx.83@g.com', 'lijin', 'sumijukiji', 'ชาย', '1988-02-13', '2020-05-21 18:20:19', '2020-05-21 18:20:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `plan`
--
ALTER TABLE `plan`
  ADD PRIMARY KEY (`plan_id`);

--
-- Indexes for table `saving`
--
ALTER TABLE `saving`
  ADD PRIMARY KEY (`saving_id`),
  ADD KEY `typemoney_tb_typemoney_id` (`typemoney_id`),
  ADD KEY `saving.useraccount_tb_user_id` (`user_id`);

--
-- Indexes for table `typemoney`
--
ALTER TABLE `typemoney`
  ADD PRIMARY KEY (`typemoney_id`);

--
-- Indexes for table `userplan`
--
ALTER TABLE `userplan`
  ADD PRIMARY KEY (`uplan_id`),
  ADD KEY `userplan.plan_tb_plan_id` (`plan_id`),
  ADD KEY `userplan.useraccount_tb_user_id` (`user_id`);

--
-- Indexes for table `usersaccount`
--
ALTER TABLE `usersaccount`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `plan`
--
ALTER TABLE `plan`
  MODIFY `plan_id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'ไอดีแผน', AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `saving`
--
ALTER TABLE `saving`
  MODIFY `saving_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `typemoney`
--
ALTER TABLE `typemoney`
  MODIFY `typemoney_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userplan`
--
ALTER TABLE `userplan`
  MODIFY `uplan_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `usersaccount`
--
ALTER TABLE `usersaccount`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `saving`
--
ALTER TABLE `saving`
  ADD CONSTRAINT `saving.useraccount_tb_user_id` FOREIGN KEY (`user_id`) REFERENCES `usersaccount` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `typemoney_tb_typemoney_id` FOREIGN KEY (`typemoney_id`) REFERENCES `typemoney` (`typemoney_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `userplan`
--
ALTER TABLE `userplan`
  ADD CONSTRAINT `userplan.plan_tb_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `plan` (`plan_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `userplan.useraccount_tb_user_id` FOREIGN KEY (`user_id`) REFERENCES `usersaccount` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
