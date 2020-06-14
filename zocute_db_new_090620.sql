-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2020 at 06:23 PM
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
(10, 2, 5, 'จ่ายโทรศัพท์ 250', 250, '2020-05-16 00:00:00', 5, '2020-05-21 21:20:31', '2020-05-29 14:02:04'),
(11, 2, 4, 'จ่ายเงินออม', 2000, '2020-10-29 00:00:00', 10, '2020-10-29 13:35:42', '2020-06-02 18:49:44'),
(12, 2, 4, 'test1', 1000, '2020-07-16 21:35:25', 7, '2020-07-16 14:35:25', '2020-06-02 14:38:02'),
(13, 2, 5, 'test2', 1200, '2020-08-16 21:35:25', 8, '2020-08-16 14:35:25', '2020-06-02 14:38:02'),
(14, 2, 9, 'test3', 1300, '2020-09-16 21:35:25', 9, '2020-09-16 14:35:25', '2020-06-02 14:38:02'),
(15, 2, 5, 'test11.1', 1050, '2020-06-16 21:35:25', 6, '2020-06-16 14:35:25', '2020-06-02 14:38:02'),
(16, 2, 7, 'เงินค่าสันทนาการ', 2000, '2020-11-16 21:35:25', 11, '2020-11-16 14:35:25', '2020-11-02 14:38:02'),
(17, 2, 7, 'เงินค่าสันทนาการ2', 2500, '2020-12-16 21:35:25', 12, '2020-12-16 14:35:25', '2020-12-02 14:38:02'),
(18, 2, 7, 'เงินค่าสันทนาการ3', 2550, '2021-01-16 21:35:25', 1, '2021-01-16 14:35:25', '2021-01-02 14:38:02'),
(19, 2, 1, 'ได้เงินเดือน 250000', 250000, '2020-06-03 00:00:00', 6, '2020-06-03 10:01:44', '2020-06-03 10:01:44'),
(20, 1, 1, 'อาลิซได้เงินเดือน 3000', 3000, '2020-06-03 00:00:00', 6, '2020-06-03 10:13:11', '2020-06-03 10:13:11'),
(21, 1, 1, 'ได้เงินรางวัล', 250000, '2020-06-03 00:00:00', 6, '2020-06-03 10:45:27', '2020-06-03 10:45:27'),
(22, 1, 1, 'ได้เงินรางวัล', 250000, '2020-06-03 00:00:00', 6, '2020-06-03 10:45:53', '2020-06-03 10:45:53'),
(23, 1, 7, 'จ่ายโทรศัพท์ 250', 8000, '2020-06-03 00:00:00', 6, '2020-06-03 10:46:34', '2020-06-03 10:46:34'),
(24, 1, 6, 'ไปเที่ยวครอบครัว', 3500, '2020-06-02 00:00:00', 6, '2020-06-03 13:35:26', '2020-06-03 13:35:26'),
(25, 1, 5, 'จ่ายค่าไฟ', 2500, '2020-06-02 00:00:00', 6, '2020-06-03 13:35:46', '2020-06-03 13:35:46'),
(26, 1, 3, 'ถูกหวยยย', 800, '2020-06-02 00:00:00', 6, '2020-06-03 13:36:15', '2020-06-03 13:36:15'),
(27, 1, 1, 'ได้เงินอีกแล้ว', 200, '2020-06-03 00:00:00', 6, '2020-06-03 13:38:14', '2020-06-03 13:38:14'),
(28, 1, 4, 'เอาเงินมาออม', 200, '2020-06-03 00:00:00', 6, '2020-06-03 13:38:39', '2020-06-03 13:38:39'),
(29, 1, 2, 'ถอนเงินหุ้น SCB ได้มา 2881.35', 2881.35, '2020-06-05 00:00:00', 6, '2020-06-05 10:54:36', '2020-06-05 10:54:36'),
(30, 1, 9, 'ซื้อขนม 7-11 15', 15.05, '2020-06-05 00:00:00', 6, '2020-06-05 11:26:18', '2020-06-05 11:26:18'),
(31, 1, 9, 'ซื้อขนม 7-11 15', 15.05, '2020-06-05 00:00:00', 6, '2020-06-05 11:27:24', '2020-06-05 11:27:24'),
(32, 1, 5, 'ค่าน้ำค่าไฟ', 2520, '2020-07-01 00:00:00', 7, '2020-06-05 11:28:19', '2020-06-05 11:28:19'),
(33, 1, 5, 'ค่าน้ำค่าไฟ 2471', 2471.85, '2020-08-01 00:00:00', 8, '2020-06-05 11:29:02', '2020-06-05 11:29:02'),
(34, 1, 5, 'ค่าน้ำค่าไฟ 3401.25', 3400.25, '2020-09-01 00:00:00', 9, '2020-06-05 11:29:44', '2020-06-05 11:29:44'),
(35, 1, 5, 'ค่าน้ำสุดแพง 5023.57', 5023.57, '2020-11-01 00:00:00', 11, '2020-06-05 13:03:17', '2020-06-05 13:03:17'),
(36, 1, 1, 'ว้าวว ได้เงินอีกละ', 111, '2020-06-08 00:00:00', 6, '2020-06-07 17:45:14', '2020-06-07 17:45:14'),
(37, 1, 3, 'เก็บเงินได้', 7, '2020-06-08 00:00:00', 6, '2020-06-07 17:45:36', '2020-06-07 17:45:36'),
(38, 1, 3, 'ว้าววสนุกไปเลย เสียตังค์', 500.95, '2020-06-08 00:00:00', 6, '2020-06-07 17:50:51', '2020-06-08 14:12:47'),
(39, 1, 5, 'จ่ายค่าไฟ', 200, '2020-06-08 00:00:00', 6, '2020-06-08 11:20:32', '2020-06-08 11:20:32'),
(40, 1, 3, 'วันนี้แม่ให้เงิน 1560', 1560, '2020-06-09 00:00:00', 6, '2020-06-08 20:53:14', '2020-06-08 20:53:14'),
(41, 1, 4, 'แบ่งเก็บ 300', 300, '2020-06-09 00:00:00', 6, '2020-06-08 20:53:34', '2020-06-08 20:53:34'),
(42, 1, 6, 'อาหารวันนี้ 450', 450, '2020-06-09 00:00:00', 6, '2020-06-08 20:53:56', '2020-06-08 20:53:56'),
(44, 1, 3, 'eieร', 100, '2020-06-07 00:00:00', 6, '2020-06-08 21:14:12', '2020-06-08 21:14:12');

-- --------------------------------------------------------

--
-- Table structure for table `typemoney`
--

CREATE TABLE `typemoney` (
  `typemoney_id` int(2) NOT NULL,
  `typemoney_name` varchar(50) NOT NULL,
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
(5, 'สาธาณูปโภค(ค่าน้ำ ค่าไฟ ค่าโทรศัพท์)', 'รายจ่าย', NULL, '2020-05-21 17:50:42', '2020-06-08 11:18:09'),
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
  `typemoney_id` int(2) NOT NULL COMMENT 'ไอดีแผนแต่ละชนิด (fk)',
  `uplan_value` double NOT NULL COMMENT 'ค่าแผนแต่ละชนิด',
  `month_id` int(2) NOT NULL,
  `user_id` int(10) NOT NULL COMMENT 'ไอดีผู้ใช้ (fk)',
  `create_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userplan`
--

INSERT INTO `userplan` (`uplan_id`, `typemoney_id`, `uplan_value`, `month_id`, `user_id`, `create_at`, `update_at`) VALUES
(29, 4, 3000, 6, 1, '2020-06-09 06:36:51', '2020-06-09 06:36:51'),
(30, 5, 4890, 6, 1, '2020-06-09 06:36:51', '2020-06-09 06:36:51'),
(31, 6, 1400, 6, 1, '2020-06-09 06:36:51', '2020-06-09 06:36:51'),
(32, 7, 2500, 6, 1, '2020-06-09 06:36:51', '2020-06-09 06:36:51'),
(33, 8, 250, 6, 1, '2020-06-09 06:36:51', '2020-06-09 06:36:51'),
(34, 9, 3600, 6, 1, '2020-06-09 06:36:51', '2020-06-09 06:36:51'),
(35, 4, 2500, 7, 1, '2020-06-09 06:37:44', '2020-06-09 06:37:44'),
(36, 5, 5000, 7, 1, '2020-06-09 06:37:44', '2020-06-09 06:37:44'),
(37, 6, 4600, 7, 1, '2020-06-09 06:37:44', '2020-06-09 06:37:44'),
(38, 7, 800, 7, 1, '2020-06-09 06:37:44', '2020-06-09 06:37:44'),
(39, 8, 0, 7, 1, '2020-06-09 06:37:44', '2020-06-09 06:37:44'),
(40, 9, 3600, 7, 1, '2020-06-09 06:37:44', '2020-06-09 06:37:44');

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
(1, 'alicez', '1234', 'alice@g.com', 'alice', 'jojo', 'ชาย', '2000-05-12', '2020-05-21 18:20:19', '2020-06-07 17:59:48'),
(2, 'lijinx83', '1227', 'lijinx.83@g.com', 'lijinx555', 'sumukiji', 'ชาย', '1988-04-28', '2020-05-21 18:20:19', '2020-05-30 14:53:51'),
(3, 'prakasitz', '12345', 'prakasit@g.com', 'prakasit', 'chuayraksa', 'ชาย', '2020-05-15', '2020-05-22 12:09:45', '2020-05-22 12:09:45'),
(4, 'test', '1234', 'test@g.com', 'test', 'test', 'ชาย', '2020-05-16', '2020-05-22 12:17:55', '2020-05-22 12:17:55'),
(5, '112233', '1234', '112233@g.com', '12345', '1234555', 'หญิง', '2020-05-20', '2020-05-22 12:21:11', '2020-05-30 09:11:38'),
(6, 'lady', '1234', 'lady@g.com', 'ผู้', 'หญิง', 'หญิง', '2020-05-09', '2020-05-30 09:07:14', '2020-05-30 09:11:43');

--
-- Indexes for dumped tables
--

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
  ADD KEY `userplan.useraccount_tb_user_id` (`user_id`),
  ADD KEY `userplan.typemoney_tb_typemoney_id` (`typemoney_id`);

--
-- Indexes for table `usersaccount`
--
ALTER TABLE `usersaccount`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `saving`
--
ALTER TABLE `saving`
  MODIFY `saving_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `typemoney`
--
ALTER TABLE `typemoney`
  MODIFY `typemoney_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `userplan`
--
ALTER TABLE `userplan`
  MODIFY `uplan_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `usersaccount`
--
ALTER TABLE `usersaccount`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
  ADD CONSTRAINT `userplan.typemoney_tb_typemoney_id` FOREIGN KEY (`typemoney_id`) REFERENCES `typemoney` (`typemoney_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `userplan.useraccount_tb_user_id` FOREIGN KEY (`user_id`) REFERENCES `usersaccount` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
