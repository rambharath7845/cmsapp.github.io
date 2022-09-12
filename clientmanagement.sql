-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 12, 2022 at 04:12 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `clientmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `2022_article`
--

CREATE TABLE `2022_article` (
  `Sno` int(11) NOT NULL,
  `ArticleID` varchar(50) NOT NULL,
  `ClientID` varchar(50) DEFAULT NULL,
  `ArticleName` varchar(50) DEFAULT NULL,
  `ArticleLink` longtext,
  `CurrentStatus` int(11) DEFAULT '1',
  `Comments` longtext,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `ModifiedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `IsActive` int(11) DEFAULT '1',
  `IsDelete` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `2022_article`
--

INSERT INTO `2022_article` (`Sno`, `ArticleID`, `ClientID`, `ArticleName`, `ArticleLink`, `CurrentStatus`, `Comments`, `CreatedBy`, `CreatedOn`, `ModifiedBy`, `ModifiedOn`, `IsActive`, `IsDelete`) VALUES
(1, 'ART001', 'CLT002', '', 'https://charpstar.se/FullStackTest/Images/1.jpg', 1, NULL, 'CLT001', '2022-09-12 06:31:28', NULL, '2022-09-12 06:31:28', 1, 0),
(2, 'ART002', 'CLT002', '', 'https://charpstar.se/FullStackTest/Images/2.jpg', 1, NULL, 'CLT001', '2022-09-12 06:31:40', NULL, '2022-09-12 06:31:40', 1, 0),
(3, 'ART003', 'CLT002', '', 'https://charpstar.se/FullStackTest/Images/3.jpg', 1, NULL, 'CLT001', '2022-09-12 06:31:50', NULL, '2022-09-12 06:31:50', 1, 0),
(4, 'ART004', 'CLT003', '', 'https://charpstar.se/FullStackTest/Images/4.jpeg', 1, NULL, 'CLT001', '2022-09-12 06:32:05', NULL, '2022-09-12 06:32:05', 1, 0),
(5, 'ART005', 'CLT003', '', 'https://charpstar.se/FullStackTest/Images/5.jpeg', 1, NULL, 'CLT001', '2022-09-12 06:32:15', NULL, '2022-09-12 06:32:15', 1, 0),
(6, 'ART006', 'CLT003', '', 'https://charpstar.se/FullStackTest/Images/6.jpeg', 1, NULL, 'CLT001', '2022-09-12 06:32:26', NULL, '2022-09-12 06:32:26', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `2022_clients`
--

CREATE TABLE `2022_clients` (
  `Sno` int(11) NOT NULL,
  `ClientID` varchar(50) NOT NULL,
  `ClientName` varchar(50) DEFAULT NULL,
  `MobileNo` varchar(15) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `PassWord` varchar(50) DEFAULT NULL,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `ModifiedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `IsActive` int(11) DEFAULT '1',
  `IsDelete` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `2022_clients`
--

INSERT INTO `2022_clients` (`Sno`, `ClientID`, `ClientName`, `MobileNo`, `UserName`, `PassWord`, `CreatedBy`, `CreatedOn`, `ModifiedBy`, `ModifiedOn`, `IsActive`, `IsDelete`) VALUES
(1, 'CLT001', 'Ramalingam M', '7845733072', 'ram7845', 'e10adc3949ba59abbe56e057f20f883e', 'CLT001', '2022-09-10 08:46:54', 'CLT001', '2022-09-10 12:20:38', 1, 0),
(2, 'CLT002', 'Client 1', '9092786628', 'client1', '5ee2f73400544e68d9faa49a89bcfc13', 'USR002', '2022-09-10 20:52:03', NULL, '2022-09-10 20:52:03', 1, 0),
(3, 'CLT003', 'Client 2', '9798128848', 'client2', 'b9bca987b7d5be9f428f34cf9846ed1e', 'USR002', '2022-09-12 06:00:12', NULL, '2022-09-12 06:00:12', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `2022_userlogin`
--

CREATE TABLE `2022_userlogin` (
  `Sno` int(11) NOT NULL,
  `UserID` varchar(50) NOT NULL,
  `EmployeeID` varchar(50) DEFAULT NULL,
  `EmployeeName` varchar(50) DEFAULT NULL,
  `UserName` varchar(50) DEFAULT NULL,
  `PassWord` varchar(50) DEFAULT NULL,
  `CreatedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `CreatedBy` varchar(50) DEFAULT NULL,
  `ModifiedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  `ModifiedBy` varchar(50) DEFAULT NULL,
  `IsActive` int(11) DEFAULT '1',
  `IsDelete` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `2022_userlogin`
--

INSERT INTO `2022_userlogin` (`Sno`, `UserID`, `EmployeeID`, `EmployeeName`, `UserName`, `PassWord`, `CreatedOn`, `CreatedBy`, `ModifiedOn`, `ModifiedBy`, `IsActive`, `IsDelete`) VALUES
(1, 'USR001', 'ETS2080', 'Ramalingam M', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '2022-09-10 20:27:19', 'USR001', '2022-09-11 13:24:33', 'USR001', 1, 0),
(2, 'USR002', 'PRMG2022', 'Production Manager', 'productionmanager', 'e10adc3949ba59abbe56e057f20f883e', '2022-09-10 23:18:17', 'USR001', '2022-09-10 23:18:17', NULL, 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `2022_article`
--
ALTER TABLE `2022_article`
  ADD UNIQUE KEY `Sno` (`Sno`);

--
-- Indexes for table `2022_clients`
--
ALTER TABLE `2022_clients`
  ADD PRIMARY KEY (`ClientID`),
  ADD UNIQUE KEY `Sno` (`Sno`);

--
-- Indexes for table `2022_userlogin`
--
ALTER TABLE `2022_userlogin`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Sno` (`Sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `2022_article`
--
ALTER TABLE `2022_article`
  MODIFY `Sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `2022_clients`
--
ALTER TABLE `2022_clients`
  MODIFY `Sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `2022_userlogin`
--
ALTER TABLE `2022_userlogin`
  MODIFY `Sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
