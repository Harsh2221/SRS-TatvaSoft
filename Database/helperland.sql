-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2022 at 07:46 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helperland`
--

-- --------------------------------------------------------

--
-- Table structure for table `address_table`
--

CREATE TABLE `address_table` (
  `Address_id` int(100) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Distance` int(10) NOT NULL,
  `House No.` int(10) NOT NULL,
  `Postal Code` int(10) NOT NULL,
  `Phone No.` int(10) NOT NULL,
  `City` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Admin_id` int(100) NOT NULL,
  `Admin_Name` varchar(150) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone No.` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone No.` int(10) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Confirm Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `rating of service provider`
--

CREATE TABLE `rating of service provider` (
  `Rating_id` int(11) NOT NULL,
  `Service_id` int(11) NOT NULL,
  `Service_provider_id` int(11) NOT NULL,
  `Customer_id` int(11) NOT NULL,
  `Time of arrival` float NOT NULL,
  `Quality of service` float NOT NULL,
  `Feedback` varchar(255) NOT NULL,
  `Rating` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_provider`
--

CREATE TABLE `service_provider` (
  `Service_Provider_id` int(100) NOT NULL,
  `FirstName` varchar(150) NOT NULL,
  `LastName` varchar(150) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone No.` int(10) NOT NULL,
  `Gender` varchar(10) NOT NULL,
  `Postal Code` int(10) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Password` varchar(150) NOT NULL,
  `Confirm Password` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `service_request`
--

CREATE TABLE `service_request` (
  `Service_id` int(11) NOT NULL,
  `customer_id` int(100) NOT NULL,
  `Service_Provider_id` int(100) NOT NULL,
  `Service_Date` date NOT NULL,
  `Service_Provider` varchar(150) NOT NULL,
  `Start_Time` time NOT NULL,
  `End_Time` time NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Pets at home` varchar(150) NOT NULL,
  `Service_inside_Cabinates` time NOT NULL,
  `Service_inside_Fridge` time NOT NULL,
  `Service_inside_oven` time NOT NULL,
  `Service_inside_washdryer` time NOT NULL,
  `Service_inside_window` time NOT NULL,
  `Total_service_time` time NOT NULL,
  `Service_amount` int(100) NOT NULL,
  `Service_status` varchar(10) NOT NULL,
  `Comments` varchar(255) NOT NULL,
  `Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address_table`
--
ALTER TABLE `address_table`
  ADD PRIMARY KEY (`Address_id`),
  ADD KEY `address foreign key` (`customer_id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`Admin_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Indexes for table `rating of service provider`
--
ALTER TABLE `rating of service provider`
  ADD PRIMARY KEY (`Rating_id`),
  ADD KEY `Service_id` (`Service_id`),
  ADD KEY `Service_provider_id` (`Service_provider_id`),
  ADD KEY `Customer_id` (`Customer_id`);

--
-- Indexes for table `service_provider`
--
ALTER TABLE `service_provider`
  ADD PRIMARY KEY (`Service_Provider_id`);

--
-- Indexes for table `service_request`
--
ALTER TABLE `service_request`
  ADD PRIMARY KEY (`Service_id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `Service_Provider_id` (`Service_Provider_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address_table`
--
ALTER TABLE `address_table`
  MODIFY `Address_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `Admin_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rating of service provider`
--
ALTER TABLE `rating of service provider`
  MODIFY `Rating_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_provider`
--
ALTER TABLE `service_provider`
  MODIFY `Service_Provider_id` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `service_request`
--
ALTER TABLE `service_request`
  MODIFY `Service_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `address_table`
--
ALTER TABLE `address_table`
  ADD CONSTRAINT `address foreign key` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rating of service provider`
--
ALTER TABLE `rating of service provider`
  ADD CONSTRAINT `rating of service provider_ibfk_1` FOREIGN KEY (`Service_id`) REFERENCES `service_request` (`Service_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rating of service provider_ibfk_2` FOREIGN KEY (`Service_provider_id`) REFERENCES `service_provider` (`Service_Provider_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rating of service provider_ibfk_3` FOREIGN KEY (`Customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `service_request`
--
ALTER TABLE `service_request`
  ADD CONSTRAINT `service_request_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `service_request_ibfk_2` FOREIGN KEY (`Service_Provider_id`) REFERENCES `service_provider` (`Service_Provider_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
