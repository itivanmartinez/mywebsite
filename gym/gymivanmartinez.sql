-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2018 at 08:06 AM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gymivanmartinez`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblclasses`
--

CREATE TABLE `tblclasses` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Description` varchar(200) NOT NULL,
  `Location` varchar(50) NOT NULL,
  `Instructor` varchar(50) NOT NULL,
  `MaxSignUps` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblclassesdays`
--

CREATE TABLE `tblclassesdays` (
  `id` int(11) NOT NULL,
  `days` varchar(3) NOT NULL,
  `time` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblclassregistration`
--

CREATE TABLE `tblclassregistration` (
  `classId` int(11) NOT NULL,
  `memberId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblcredcardinfo`
--

CREATE TABLE `tblcredcardinfo` (
  `CustomerId` int(11) NOT NULL,
  `CCNumber` varchar(20) DEFAULT NULL,
  `BillingName` varchar(50) DEFAULT NULL,
  `BillingAddress` varchar(255) DEFAULT NULL,
  `BillingZipCode` varchar(5) DEFAULT NULL,
  `BillingState` varchar(2) DEFAULT NULL,
  `BillingCity` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblinvoices`
--

CREATE TABLE `tblinvoices` (
  `Id` int(11) NOT NULL,
  `MemberId` int(11) NOT NULL,
  `MembershipId` int(11) NOT NULL,
  `CCnumber` varchar(20) DEFAULT NULL,
  `BillDate` date DEFAULT NULL,
  `BillPaid` date DEFAULT NULL,
  `Cash` varchar(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmember`
--

CREATE TABLE `tblmember` (
  `id` int(11) NOT NULL,
  `FirstName` varchar(50) DEFAULT NULL,
  `LastName` varchar(50) DEFAULT NULL,
  `CellPhone` varchar(15) DEFAULT NULL,
  `AddressLine1` varchar(250) DEFAULT NULL,
  `AddressLine2` varchar(250) DEFAULT NULL,
  `Email` varchar(250) DEFAULT NULL,
  `City` varchar(100) DEFAULT NULL,
  `State` varchar(2) DEFAULT NULL,
  `ZipCode` varchar(5) DEFAULT NULL,
  `User` varchar(15) NOT NULL,
  `Password` varchar(8) NOT NULL,
  `privilegeID` int(11) NOT NULL,
  `DateJoined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmembershipreg`
--

CREATE TABLE `tblmembershipreg` (
  `Id` int(11) NOT NULL,
  `CustomerId` int(11) NOT NULL,
  `MembershipId` int(11) NOT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `CanDate` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblmemberships`
--

CREATE TABLE `tblmemberships` (
  `Id` int(11) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Price` decimal(20,2) NOT NULL,
  `Description` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tblusersprivileges`
--

CREATE TABLE `tblusersprivileges` (
  `id` int(11) NOT NULL,
  `class` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblclasses`
--
ALTER TABLE `tblclasses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblclassesdays`
--
ALTER TABLE `tblclassesdays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcredcardinfo`
--
ALTER TABLE `tblcredcardinfo`
  ADD PRIMARY KEY (`CustomerId`);

--
-- Indexes for table `tblinvoices`
--
ALTER TABLE `tblinvoices`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `MemberId` (`MemberId`),
  ADD KEY `MembershipId` (`MembershipId`),
  ADD KEY `CCnumber` (`CCnumber`);

--
-- Indexes for table `tblmember`
--
ALTER TABLE `tblmember`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblmembershipreg`
--
ALTER TABLE `tblmembershipreg`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CustomerId` (`CustomerId`),
  ADD KEY `MembershipId` (`MembershipId`);

--
-- Indexes for table `tblmemberships`
--
ALTER TABLE `tblmemberships`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `tblusersprivileges`
--
ALTER TABLE `tblusersprivileges`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblclasses`
--
ALTER TABLE `tblclasses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblinvoices`
--
ALTER TABLE `tblinvoices`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblmember`
--
ALTER TABLE `tblmember`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblmembershipreg`
--
ALTER TABLE `tblmembershipreg`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblmemberships`
--
ALTER TABLE `tblmemberships`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblusersprivileges`
--
ALTER TABLE `tblusersprivileges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
