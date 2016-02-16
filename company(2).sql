-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2014 at 10:48 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `company`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
`DId` int(11) NOT NULL,
  `Name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `Info` text COLLATE utf8_unicode_ci NOT NULL,
  `LimitAuth` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DId`, `Name`, `Info`, `LimitAuth`) VALUES
(1, 'Phòng kế toán', 'Quản lý thu chi', 5),
(2, 'Phòng nhân sự', 'Quản lý nhân viên', 2),
(3, 'Ban Giám đốc', 'Quản lý công ty\r\n', 6),
(6, 'Phòng kế hoạch', 'Hoạch định kế hoạch cho công ty', 2);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE IF NOT EXISTS `employee` (
`EId` int(11) NOT NULL,
  `Name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `DoB` date NOT NULL,
  `Sex` int(11) NOT NULL COMMENT '0: Female, 1: Male',
  `Address` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `Phone` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Distance` float NOT NULL,
  `BSSalary` int(11) NOT NULL,
  `PoF` int(11) NOT NULL COMMENT '0: Part time; 1: Full time',
  `pwd` varchar(256) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`EId`, `Name`, `DoB`, `Sex`, `Address`, `Phone`, `Email`, `Distance`, `BSSalary`, `PoF`, `pwd`) VALUES
(1, 'Nguyễn Xuân Bách', '1994-12-15', 1, 'Ngõ 83, Nguyễn An Ninh', '0989 041 381', 'bachnx.hedspi@gmail.com', 4.5, 5000000, 1, 'e554c5c596cce238a093053aba7efdc6bb9a2920'),
(2, 'Nguyễn Tiến Hùng', '1990-02-14', 1, 'Số 14 đường Cầu Giấy', '0123 212 222', 'hungnt@gmail.com', 3.1, 10000000, 1, '8a46aa311d091343dd0771de074f5bd5c6008b5f'),
(3, 'Hoàng Tiến Mạnh', '2014-12-01', 1, 'Hà Nội', '0123 921 111', 'manhnt@yahoo.com', 3.2, 20000000, 1, '045575412a254dac8cabbb5cc81f9a1e1d12c7bd'),
(4, 'Hoàng An Nga', '1984-05-18', 0, 'Quận Tây Hồ', '0912 999 221', 'ngaxinh@gmail.com', 2.3, 3000000, 0, '13a6597187ada1bf567d5aa7c4dbaced57ccf938'),
(5, 'Trương Thu An', '1970-12-02', 0, 'Hàn Quốc', '0912 221 222', 'An@gmail.com', 10000, 100000000, 1, '90daa5b30efa5ec676bcec8dabbf518bac57b988'),
(6, 'Minh Hoàng', '1974-11-17', 1, 'Ngõ 91, đường Giải Phóng, Quận Hai Bà Trưng', '0965 888 777', 'mh@gmail.com', 13, 2000000, 1, 'd72a2bb5f02a8fb70d14b424d3deb58007dfe859'),
(7, 'Phạm Thu Trang', '1995-02-20', 0, 'Ngõ Bà Triệu, Quận Hoàn Kiếm', '01688 222 333', 'trangpham2002@gmail.com', 2, 3000000, 2, 'be72388ea2936dbcadb4c35d96147320576edc6c'),
(8, 'Hoàng Tiến Huy', '0000-00-00', 1, '', '', 'huy@gmail.com', 13, 1000000, 1, '102ba431ca4c02b5cadc2a98d4da4813ed3d0b4d');

-- --------------------------------------------------------

--
-- Table structure for table `month`
--

CREATE TABLE IF NOT EXISTS `month` (
  `EId` int(11) NOT NULL,
  `MId` date NOT NULL,
  `Descript` text COLLATE utf8_unicode_ci NOT NULL,
  `Money` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `month`
--

INSERT INTO `month` (`EId`, `MId`, `Descript`, `Money`) VALUES
(1, '2014-12-01', 'Tạm ứng dự án ABC', 200000),
(1, '2014-12-07', 'Nhận lương từ đầu tới ngày hôm nay\r\n', 30000);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE IF NOT EXISTS `position` (
`Id` int(11) NOT NULL,
  `Position` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `Authority` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`Id`, `Position`, `Authority`) VALUES
(1, 'Trưởng phòng', 2),
(2, 'Giám đốc', 6),
(3, 'Chuyên viên', 1),
(4, 'Kỹ thuật', 6),
(5, 'Quản lý dự án', 3),
(6, 'Phó Giám đốc', 6),
(7, 'Phó phòng', 2),
(8, 'Kế toán trưởng', 5);

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
`PId` int(11) NOT NULL,
  `Name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `Info` text COLLATE utf8_unicode_ci NOT NULL,
  `DId` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`PId`, `Name`, `Info`, `DId`) VALUES
(3, 'Kế hoạch 2015 ~ 2020', 'Hồ sơ số 192J', 6);

-- --------------------------------------------------------

--
-- Table structure for table `tworking`
--

CREATE TABLE IF NOT EXISTS `tworking` (
  `EId` int(11) NOT NULL,
  `PId` int(11) NOT NULL,
  `TFrom` datetime NOT NULL,
  `TTo` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workfor`
--

CREATE TABLE IF NOT EXISTS `workfor` (
  `EId` int(11) NOT NULL,
  `DId` int(11) NOT NULL,
  `Position` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `workfor`
--

INSERT INTO `workfor` (`EId`, `DId`, `Position`) VALUES
(2, 2, 1),
(3, 1, 1),
(1, 3, 2),
(4, 2, 3),
(5, 1, 3),
(6, 1, 3),
(7, 1, 3),
(8, 1, 8);

-- --------------------------------------------------------

--
-- Table structure for table `working`
--

CREATE TABLE IF NOT EXISTS `working` (
  `EId` int(11) NOT NULL,
  `PId` int(11) NOT NULL,
  `Position` int(11) NOT NULL,
  `SpH` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `working`
--

INSERT INTO `working` (`EId`, `PId`, `Position`, `SpH`) VALUES
(3, 3, 5, 100000);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
 ADD PRIMARY KEY (`DId`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
 ADD PRIMARY KEY (`EId`);

--
-- Indexes for table `month`
--
ALTER TABLE `month`
 ADD PRIMARY KEY (`EId`,`MId`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
 ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
 ADD PRIMARY KEY (`PId`), ADD KEY `DId` (`DId`);

--
-- Indexes for table `tworking`
--
ALTER TABLE `tworking`
 ADD PRIMARY KEY (`EId`,`PId`), ADD KEY `PId` (`PId`);

--
-- Indexes for table `workfor`
--
ALTER TABLE `workfor`
 ADD PRIMARY KEY (`EId`,`DId`), ADD KEY `workfor2` (`DId`), ADD KEY `Position` (`Position`);

--
-- Indexes for table `working`
--
ALTER TABLE `working`
 ADD PRIMARY KEY (`EId`,`PId`), ADD KEY `PId` (`PId`), ADD KEY `Position` (`Position`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
MODIFY `DId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
MODIFY `EId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
MODIFY `PId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `month`
--
ALTER TABLE `month`
ADD CONSTRAINT `EId1` FOREIGN KEY (`EId`) REFERENCES `employee` (`EId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `project`
--
ALTER TABLE `project`
ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`DId`) REFERENCES `department` (`DId`);

--
-- Constraints for table `tworking`
--
ALTER TABLE `tworking`
ADD CONSTRAINT `tworking1` FOREIGN KEY (`EId`, `PId`) REFERENCES `working` (`EId`, `PId`);

--
-- Constraints for table `workfor`
--
ALTER TABLE `workfor`
ADD CONSTRAINT `workfor1` FOREIGN KEY (`EId`) REFERENCES `employee` (`EId`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `workfor2` FOREIGN KEY (`DId`) REFERENCES `department` (`DId`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `workfor_ibfk_1` FOREIGN KEY (`Position`) REFERENCES `position` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `working`
--
ALTER TABLE `working`
ADD CONSTRAINT `working_ibfk_1` FOREIGN KEY (`EId`) REFERENCES `employee` (`EId`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `working_ibfk_2` FOREIGN KEY (`PId`) REFERENCES `project` (`PId`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `working_ibfk_3` FOREIGN KEY (`Position`) REFERENCES `position` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
