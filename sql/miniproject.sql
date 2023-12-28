-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Dec 28, 2023 at 06:40 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `miniproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `inpurchaselist`
--

CREATE TABLE `inpurchaselist` (
  `InPurchaseListID` int(11) NOT NULL,
  `InPurchaseID` int(11) NOT NULL,
  `MenuID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `ItemsTotalAmount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `inpurchaseorder`
--

CREATE TABLE `inpurchaseorder` (
  `InPurchaseID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `KioskID` int(11) NOT NULL,
  `InPurchaseDate` date NOT NULL DEFAULT current_timestamp(),
  `InPurchaseTime` time NOT NULL DEFAULT current_timestamp(),
  `InPurchaseSubTotal` float NOT NULL,
  `InPurchaseTotalPrice` float NOT NULL,
  `TotalPointsEarned` int(11) NOT NULL,
  `TotalPointsRedeemed` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `kiosk`
--

CREATE TABLE `kiosk` (
  `KioskID` int(11) NOT NULL,
  `KioskName` varchar(50) NOT NULL,
  `OperationStatus` varchar(10) NOT NULL,
  `KioskLogo` blob NOT NULL,
  `KioskNum` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `membership`
--

CREATE TABLE `membership` (
  `MembershipID` int(11) NOT NULL,
  `UserID` int(50) NOT NULL,
  `MembershipPoints` int(11) NOT NULL,
  `TotalPointsEarned` int(11) NOT NULL,
  `JoinedDate` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `MenuID` int(11) NOT NULL,
  `KioskID` int(50) NOT NULL,
  `ItemName` varchar(50) NOT NULL,
  `ItemDesc` varchar(100) NOT NULL,
  `ItemPrice` float NOT NULL,
  `Availability` varchar(10) NOT NULL,
  `Stock` int(10) NOT NULL,
  `ItemImage` blob NOT NULL,
  `MenuQR` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `onlineorder`
--

CREATE TABLE `onlineorder` (
  `OrderID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `KioskID` int(11) NOT NULL,
  `OrderDate` date NOT NULL,
  `OrderTime` time NOT NULL,
  `OrderSubTotal` float NOT NULL,
  `OrderTotalPrice` float NOT NULL,
  `TotalPointsEarned` int(11) NOT NULL,
  `TotalPointsRedeemed` int(11) NOT NULL,
  `OrderStatus` varchar(100) NOT NULL,
  `OrderQR` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `orderlist`
--

CREATE TABLE `orderlist` (
  `OrderListID` int(11) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `MenuID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `OrderTotalAmount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `PaymentID` int(11) NOT NULL,
  `PaymentDate` date NOT NULL DEFAULT current_timestamp(),
  `PaymentTime` time NOT NULL DEFAULT current_timestamp(),
  `PaymentType` varchar(100) NOT NULL,
  `OrderID` int(11) NOT NULL,
  `InPurchaseID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `UserID` int(11) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `FullName` varchar(50) DEFAULT NULL,
  `Email` varchar(100) NOT NULL,
  `NumPhone` varchar(10) NOT NULL,
  `UserType` varchar(10) NOT NULL,
  `UserQR` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`UserID`, `UserName`, `Password`, `FullName`, `Email`, `NumPhone`, `UserType`, `UserQR`) VALUES
(1, 'johndoe', '123456', 'John', 'john.doe@example.com', '123-456-78', 'Customer', '-'),
(2, 'danialnbl', '$2y$10$Qd2hajR4HK.Ax2i4o77DfuWdkd7Ikp9jwBRwpKm4SlR', '', '', '', '', ''),
(3, 'admin', '$2y$10$UDzphJEltIRJohUEOI5Xk..KSEIIyuPQQrJoz/yqciv', '', 'test@gmail.com', '', '', ''),
(4, 'cb22151', '123456', '', 'dsa@gmail.com', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `VendorID` int(11) NOT NULL,
  `VendorName` varchar(50) NOT NULL,
  `VendorEmail` varchar(50) NOT NULL,
  `VendorPassword` varchar(50) NOT NULL,
  `VendorNum` varchar(10) NOT NULL,
  `VendorQR` varchar(10) NOT NULL,
  `ApprovalStatus` varchar(50) NOT NULL,
  `ApprovalDate` date NOT NULL,
  `KioskID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `inpurchaselist`
--
ALTER TABLE `inpurchaselist`
  ADD PRIMARY KEY (`InPurchaseListID`),
  ADD KEY `InPurchaseID2` (`InPurchaseID`),
  ADD KEY `MenuID2` (`MenuID`);

--
-- Indexes for table `inpurchaseorder`
--
ALTER TABLE `inpurchaseorder`
  ADD PRIMARY KEY (`InPurchaseID`),
  ADD KEY `UserIDFK` (`UserID`),
  ADD KEY `KioskIDFK` (`KioskID`);

--
-- Indexes for table `kiosk`
--
ALTER TABLE `kiosk`
  ADD PRIMARY KEY (`KioskID`);

--
-- Indexes for table `membership`
--
ALTER TABLE `membership`
  ADD PRIMARY KEY (`MembershipID`),
  ADD KEY `UserID` (`UserID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`MenuID`),
  ADD KEY `KioskID2` (`KioskID`);

--
-- Indexes for table `onlineorder`
--
ALTER TABLE `onlineorder`
  ADD PRIMARY KEY (`OrderID`),
  ADD KEY `KioskID` (`KioskID`),
  ADD KEY `UserID2` (`UserID`);

--
-- Indexes for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD PRIMARY KEY (`OrderListID`),
  ADD KEY `MenuID` (`MenuID`),
  ADD KEY `OrderIDFKList` (`OrderID`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `OrderID` (`OrderID`),
  ADD KEY `InPurchaseID` (`InPurchaseID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`UserID`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`VendorID`),
  ADD KEY `KioskID3` (`KioskID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `inpurchaselist`
--
ALTER TABLE `inpurchaselist`
  MODIFY `InPurchaseListID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inpurchaseorder`
--
ALTER TABLE `inpurchaseorder`
  MODIFY `InPurchaseID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kiosk`
--
ALTER TABLE `kiosk`
  MODIFY `KioskID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `membership`
--
ALTER TABLE `membership`
  MODIFY `MembershipID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `MenuID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `onlineorder`
--
ALTER TABLE `onlineorder`
  MODIFY `OrderID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orderlist`
--
ALTER TABLE `orderlist`
  MODIFY `OrderListID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `VendorID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `inpurchaselist`
--
ALTER TABLE `inpurchaselist`
  ADD CONSTRAINT `InPurchaseID2` FOREIGN KEY (`InPurchaseID`) REFERENCES `inpurchaseorder` (`InPurchaseID`),
  ADD CONSTRAINT `MenuID2` FOREIGN KEY (`MenuID`) REFERENCES `menu` (`MenuID`);

--
-- Constraints for table `inpurchaseorder`
--
ALTER TABLE `inpurchaseorder`
  ADD CONSTRAINT `KioskIDFK` FOREIGN KEY (`KioskID`) REFERENCES `kiosk` (`KioskID`),
  ADD CONSTRAINT `UserIDFK` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `membership`
--
ALTER TABLE `membership`
  ADD CONSTRAINT `UserID` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `KioskID2` FOREIGN KEY (`KioskID`) REFERENCES `kiosk` (`KioskID`);

--
-- Constraints for table `onlineorder`
--
ALTER TABLE `onlineorder`
  ADD CONSTRAINT `KioskID` FOREIGN KEY (`KioskID`) REFERENCES `kiosk` (`KioskID`),
  ADD CONSTRAINT `UserID2` FOREIGN KEY (`UserID`) REFERENCES `user` (`UserID`);

--
-- Constraints for table `orderlist`
--
ALTER TABLE `orderlist`
  ADD CONSTRAINT `MenuID` FOREIGN KEY (`MenuID`) REFERENCES `menu` (`MenuID`),
  ADD CONSTRAINT `OrderIDFKList` FOREIGN KEY (`OrderID`) REFERENCES `onlineorder` (`OrderID`);

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `InPurchaseID` FOREIGN KEY (`InPurchaseID`) REFERENCES `inpurchaseorder` (`InPurchaseID`),
  ADD CONSTRAINT `OrderID` FOREIGN KEY (`OrderID`) REFERENCES `onlineorder` (`OrderID`);

--
-- Constraints for table `vendor`
--
ALTER TABLE `vendor`
  ADD CONSTRAINT `KioskID3` FOREIGN KEY (`KioskID`) REFERENCES `kiosk` (`KioskID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
