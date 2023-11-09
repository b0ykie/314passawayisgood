-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2023 at 10:22 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bse_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidding_table`
--

CREATE TABLE `bidding_table` (
  `id` int(11) NOT NULL,
  `staff_id` varchar(255) NOT NULL,
  `bidding_status` enum('approved','rejected','pending') NOT NULL DEFAULT 'pending',
  `role` varchar(30) NOT NULL,
  `slot_id` varchar(30) NOT NULL,
  `managed_by` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cafe_staff`
--

CREATE TABLE `cafe_staff` (
  `staffID` varchar(30) NOT NULL,
  `staffRole` varchar(30) NOT NULL,
  `userID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `userID` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userPassword` varchar(30) NOT NULL,
  `userEmail` varchar(30) NOT NULL,
  `userProfile` varchar(30) NOT NULL,
  `userPhone` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`userID`, `userName`, `userPassword`, `userEmail`, `userProfile`, `userPhone`) VALUES
(1, 'sysadmin', '1', 'asdf@gmail.com', 'admin', '94502367'),
(2, 'cafeowner', '1', 'lkjh@gmail.com', 'owner', ''),
(3, 'dummymanager', '1', 'ybap@gmail.com', 'manager', ''),
(4, 'cafemanager', '1', 'mnbv@gmail.com', 'manager', ''),
(5, 'cafemanager2', '1', 'ydno@gmail.com', 'manager', ''),
(35, 'adrian', '1', 'dtyw@gmail.com', 'staff', '98254610'),
(36, 'keejin', '1', 'ased@gmail.com', 'staff', '98055185'),
(37, 'kelvin', '1', 'uvsq@gmail.com', 'staff', '80969009'),
(38, 'bryan', '1', 'umai@gmail.com', 'staff', '98231090'),
(39, 'larence', '1', 'bmos@gmail.com', 'staff', '94150747'),
(40, 'tianle', '1', 'okfa@gmail.com', 'staff', '91794442'),
(41, 'xuanxin', '1', 'xdzg@gmail.com', 'staff', '99044724'),
(42, 'james', '1', 'gkuh@gmail.com', 'staff', '90634887'),
(43, 'mary', '1', 'pknr@gmail.com', 'staff', '97575007'),
(44, 'john', '1', 'ribt@gmail.com', 'staff', '92211038'),
(45, 'jack', '1', 'mlit@gmail.com', 'staff', '82388275'),
(46, 'sarah', '1', 'xaob@gmail.com', 'staff', '89960266'),
(47, 'david', '1', 'qrey@gmail.com', 'staff', '80007539'),
(48, 'charles', '1', 'ywfq@gmail.com', 'staff', '94416222'),
(49, 'linda', '1', 'cwgh@gmail.com', 'staff', '85459519'),
(50, 'lisa', '1', 'nzml@gmail.com', 'staff', '97382247'),
(51, 'angela', '1', 'piun@gmail.com', 'staff', '92178807'),
(52, 'donna', '1', 'ujfl@gmail.com', 'staff', '84589322'),
(53, 'sharon', '1', 'quwo@gmail.com', 'staff', '89152218'),
(54, 'kevin', '1', 'wcqa@gmail.com', 'staff', '97906872'),
(55, 'edward', '1', 'ezag@gmail.com', 'staff', '94034429'),
(56, 'carol', '1', 'pelp@gmail.com', 'staff', '83992856'),
(57, 'paul', '1', 'zfoq@gmail.com', 'staff', '85097389'),
(58, 'mark', '1', 'axbz@gmail.com', 'staff', '99963791'),
(59, 'jerry', '1', 'klpe@gmail.com', 'staff', '95367098'),
(60, 'ana', '1', 'jeiz@gmail.com', 'staff', '96525632'),
(61, 'sam', '1', 'ogkr@gmail.com', 'staff', '81143701'),
(62, 'lily', '1', 'czbs@gmail.com', 'staff', '91887494'),
(63, 'alex', '1', 'bptc@gmail.com', 'staff', '81438969'),
(64, 'mia', '1', 'ymnh@gmail.com', 'staff', '99920849'),
(65, 'leo', '1', 'zzgn@gmail.com', 'staff', '80913215'),
(66, 'eva', '1', 'flyb@gmail.com', 'staff', '83998446'),
(67, 'max', '1', 'hdux@gmail.com', 'staff', '95099317'),
(68, 'ben', '1', 'qnhj@gmail.com', 'staff', '98977565'),
(69, 'eli', '1', 'nstq@gmail.com', 'staff', '94528206'),
(70, 'luke', '1', 'naiw@gmail.com', 'staff', '99050421'),
(71, 'tess', '1', 'bnxb@gmail.com', 'staff', '94266044'),
(72, 'liv', '1', 'dndl@gmail.com', 'staff', '97409449'),
(73, 'jade', '1', 'axhz@gmail.com', 'staff', '86038796'),
(74, 'kim', '1', 'dntb@gmail.com', 'staff', '96230977'),
(75, 'joy', '1', 'enrd@gmail.com', 'staff', '90815548'),
(76, 'dex', '1', 'cyfc@gmail.com', 'staff', '87113044'),
(77, 'kai', '1', 'lbik@gmail.com', 'staff', '92044607'),
(78, 'cole', '1', 'vfsc@gmail.com', 'staff', '91502195'),
(79, 'kira', '1', 'joya@gmail.com', 'staff', '98289201'),
(80, 'ali', '1', 'hred@gmail.com', 'staff', '88955162'),
(81, 'fay', '1', 'vfna@gmail.com', 'staff', '94787821'),
(82, 'gus', '1', 'fken@gmail.com', 'staff', '83845922'),
(83, 'iris', '1', 'hiah@gmail.com', 'staff', '90967620'),
(84, 'jay', '1', 'brkt@gmail.com', 'staff', '81600800'),
(85, 'mae', '1', 'kclw@gmail.com', 'staff', '84051550'),
(86, 'ray', '1', 'wfzd@gmail.com', 'staff', '86418994'),
(87, 'sue', '1', 'zich@gmail.com', 'staff', '82149224'),
(88, 'xan', '1', 'nape@gmail.com', 'staff', '95957820'),
(89, 'ace', '1', 'byda@gmail.com', 'staff', '93677034'),
(90, 'elf', '1', 'uydz@gmail.com', 'staff', '80453059'),
(91, 'neo', '1', 'rjvz@gmail.com', 'staff', '86795074'),
(92, 'poe', '1', 'gcwy@gmail.com', 'staff', '83361446'),
(93, 'sid', '1', 'wxnj@gmail.com', 'staff', '97877296'),
(94, 'val', '1', 'dpqb@gmail.com', 'staff', '96206453'),
(95, 'dee', '1', 'qxph@gmail.com', 'staff', '92696042'),
(96, 'finn', '1', 'wdpf@gmail.com', 'staff', '87749643'),
(97, 'hal', '1', 'dvdw@gmail.com', 'staff', '91754105'),
(98, 'lou', '1', 'eepq@gmail.com', 'staff', '85604991'),
(99, 'var', '1', 'gxfz@gmail.com', 'staff', '84833513'),
(100, 'q', '1', 'ukon@gmail.com', 'staff', '92137347'),
(101, 'w', '1', 'ljbr@gmail.com', 'staff', '84333614'),
(102, 'e', '1', 'vzop@gmail.com', 'staff', '83384183'),
(103, 'r', '1', 'hdfg@gmail.com', 'staff', '87558974'),
(104, 't', '1', 'zgqb@gmail.com', 'staff', '82862530'),
(105, 'y', '1', 'syvp@gmail.com', 'staff', '91561518'),
(106, 'u', '1', 'afkj@gmail.com', 'staff', '80691122'),
(107, 'i', '1', 'pqti@gmail.com', 'staff', '89175317'),
(108, 'o', '1', 'xrba@gmail.com', 'staff', '81173069'),
(109, 'p', '1', 'voyt@gmail.com', 'staff', '94315266'),
(110, 'l', '1', 'ahpz@gmail.com', 'staff', '94225376'),
(111, 'k', '1', 'iurs@gmail.com', 'staff', '81347363'),
(112, 'j', '1', 'ernm@gmail.com', 'staff', '88198000'),
(113, 'h', '1', 'ghuy@gmail.com', 'staff', '92826023'),
(114, 'g', '1', 'rqrb@gmail.com', 'staff', '81435748'),
(115, 'f', '1', 'uvgz@gmail.com', 'staff', '85371915'),
(116, 'd', '1', 'djgp@gmail.com', 'staff', '83742069'),
(117, 's', '1', 'dhpt@gmail.com', 'staff', '94605407'),
(118, 'a', '1', 'ejye@gmail.com', 'staff', '97719627'),
(119, 'z', '1', 'zzrn@gmail.com', 'staff', '80433852'),
(120, 'x', '1', 'odxv@gmail.com', 'staff', '99985046'),
(121, 'c', '1', 'edwl@gmail.com', 'staff', '83719428'),
(122, 'v', '1', 'cygv@gmail.com', 'staff', '86430471'),
(123, 'b', '1', 'qsbe@gmail.com', 'staff', '92771163'),
(124, 'n', '1', 'bcxl@gmail.com', 'staff', '87878451'),
(125, 'm', '1', 'fnkr@gmail.com', 'staff', '81212698'),
(126, 'ab', '1', 'mrmw@gmail.com', 'staff', '81589541'),
(127, 'cd', '1', 'kprr@gmail.com', 'staff', '82573062');

-- --------------------------------------------------------

--
-- Table structure for table `user_profile`
--

CREATE TABLE `user_profile` (
  `userProfileType` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profile`
--

INSERT INTO `user_profile` (`userProfileType`) VALUES
('admin'),
('manager'),
('owner'),
('staff');

-- --------------------------------------------------------

--
-- Table structure for table `work_role`
--

CREATE TABLE `work_role` (
  `role` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `work_role`
--

INSERT INTO `work_role` (`role`) VALUES
('cashier'),
('chef'),
('waiter');

-- --------------------------------------------------------

--
-- Table structure for table `work_slot`
--

CREATE TABLE `work_slot` (
  `slotID` int(11) NOT NULL,
  `ownerID` varchar(30) NOT NULL,
  `chefSlot` int(11) NOT NULL,
  `cashierSlot` int(11) NOT NULL,
  `waiterSlot` int(11) NOT NULL,
  `slotDate` varchar(30) NOT NULL,
  `managerID` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidding_table`
--
ALTER TABLE `bidding_table`
  ADD PRIMARY KEY (`id`),
  ADD KEY `slot_id` (`slot_id`),
  ADD KEY `staff_id` (`staff_id`),
  ADD KEY `role` (`role`),
  ADD KEY `managed_by` (`managed_by`);

--
-- Indexes for table `cafe_staff`
--
ALTER TABLE `cafe_staff`
  ADD PRIMARY KEY (`staffID`),
  ADD KEY `staffRole` (`staffRole`),
  ADD KEY `userID` (`userID`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `USER_ACCOUNT_CKEY` (`userName`),
  ADD KEY `userProfile` (`userProfile`);

--
-- Indexes for table `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`userProfileType`);

--
-- Indexes for table `work_role`
--
ALTER TABLE `work_role`
  ADD PRIMARY KEY (`role`);

--
-- Indexes for table `work_slot`
--
ALTER TABLE `work_slot`
  ADD PRIMARY KEY (`slotID`),
  ADD UNIQUE KEY `slotDate` (`slotDate`),
  ADD KEY `ownerID` (`ownerID`),
  ADD KEY `managerID` (`managerID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidding_table`
--
ALTER TABLE `bidding_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `work_slot`
--
ALTER TABLE `work_slot`
  MODIFY `slotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bidding_table`
--
ALTER TABLE `bidding_table`
  ADD CONSTRAINT `bidding_table_ibfk_1` FOREIGN KEY (`slot_id`) REFERENCES `work_slot` (`slotDate`),
  ADD CONSTRAINT `bidding_table_ibfk_2` FOREIGN KEY (`staff_id`) REFERENCES `user_account` (`userName`),
  ADD CONSTRAINT `bidding_table_ibfk_3` FOREIGN KEY (`role`) REFERENCES `work_role` (`role`),
  ADD CONSTRAINT `bidding_table_ibfk_4` FOREIGN KEY (`managed_by`) REFERENCES `work_slot` (`managerID`);

--
-- Constraints for table `cafe_staff`
--
ALTER TABLE `cafe_staff`
  ADD CONSTRAINT `cafe_staff_ibfk_1` FOREIGN KEY (`staffRole`) REFERENCES `work_role` (`role`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cafe_staff_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `user_account` (`userName`);

--
-- Constraints for table `user_account`
--
ALTER TABLE `user_account`
  ADD CONSTRAINT `user_account_ibfk_1` FOREIGN KEY (`userProfile`) REFERENCES `user_profile` (`userProfileType`) ON UPDATE CASCADE;

--
-- Constraints for table `work_slot`
--
ALTER TABLE `work_slot`
  ADD CONSTRAINT `work_slot_ibfk_1` FOREIGN KEY (`ownerID`) REFERENCES `user_account` (`userName`) ON UPDATE CASCADE,
  ADD CONSTRAINT `work_slot_ibfk_2` FOREIGN KEY (`managerID`) REFERENCES `user_account` (`userName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
