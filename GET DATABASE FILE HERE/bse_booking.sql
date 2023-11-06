-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 10:40 AM
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

--
-- Dumping data for table `bidding_table`
--

INSERT INTO `bidding_table` (`id`, `staff_id`, `bidding_status`, `role`, `slot_id`, `managed_by`) VALUES
(3, 'vandalim', 'rejected', 'chef', '11/11/11', 'cafemanager'),
(4, 'vandalim', 'approved', 'chef', '88/88/88', 'cafemanager2'),
(5, 'vandalim', 'pending', 'chef', '44/44/44', 'cafemanager');

-- --------------------------------------------------------

--
-- Table structure for table `cafe_staff`
--

CREATE TABLE `cafe_staff` (
  `staffID` varchar(30) NOT NULL,
  `staffRole` varchar(30) NOT NULL,
  `userID` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cafe_staff`
--

INSERT INTO `cafe_staff` (`staffID`, `staffRole`, `userID`) VALUES
('johndoe_chef', 'cashier', 'johndoe'),
('rickkoe_chef', 'waiter', 'rickkoe'),
('vandalim_chef', 'chef', 'vandalim');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `userID` int(11) NOT NULL,
  `userName` varchar(30) NOT NULL,
  `userPassword` varchar(30) NOT NULL,
  `userEmail` varchar(30) NOT NULL,
  `userProfile` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`userID`, `userName`, `userPassword`, `userEmail`, `userProfile`) VALUES
(15, 'sysadmin', '1', 'asdf@gmail.com', 'admin'),
(16, 'cafeowner', '1', 'lkjh@gmail.com', 'owner'),
(17, 'cafemanager', '1', 'mnbv@gmail.com', 'manager'),
(18, 'johndoe', '1', 'rewq@gmail.com', 'staff'),
(19, 'rickkoe', '1', 'fhdt@gmail.com', 'staff'),
(20, 'vandalim', '1', 'oibq@gmail.com', 'staff'),
(25, 'cafeowner2', '1', 'asdz@gmail.com', 'owner'),
(26, 'dummymanager', '1', 'dummymanager@gmail.com', 'manager'),
(27, 'cafemanager2', '1', 'ydno@gmail.com', 'manager');

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
-- Dumping data for table `work_slot`
--

INSERT INTO `work_slot` (`slotID`, `ownerID`, `chefSlot`, `cashierSlot`, `waiterSlot`, `slotDate`, `managerID`) VALUES
(20, 'cafeowner', 3, 3, 3, '11/11/11', 'cafemanager'),
(21, 'cafeowner', 0, 0, 0, '22/22/22', 'dummymanager'),
(22, 'cafeowner', 0, 0, 0, '33/33/33', 'dummymanager'),
(23, 'cafeowner', 6, 6, 6, '44/44/44', 'cafemanager'),
(24, 'cafeowner', 0, 0, 0, '55/55/55', 'dummymanager'),
(25, 'cafeowner', 0, 0, 0, '66/66/66', 'dummymanager'),
(26, 'cafeowner', 0, 0, 0, '77/77/77', 'dummymanager'),
(27, 'cafeowner', 0, 0, 0, '88/88/88', 'cafemanager2');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `work_slot`
--
ALTER TABLE `work_slot`
  MODIFY `slotID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

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
