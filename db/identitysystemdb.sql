-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 30, 2022 at 03:19 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `identitysystemdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `firstname`, `lastname`, `email`, `password`) VALUES
(1, 'kabelo', 'Kools', 'admin@is.com', '12eaab111b446b732cc93aa6ba43cf80');

-- --------------------------------------------------------

--
-- Table structure for table `docket`
--

CREATE TABLE `docket` (
  `docket_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `crime_type` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `docket`
--

INSERT INTO `docket` (`docket_id`, `person_id`, `crime_type`, `year`) VALUES
(24, 5, 'shoplifting', '2018'),
(25, 5, 'Rape', '2000');

-- --------------------------------------------------------

--
-- Table structure for table `face_identification`
--

CREATE TABLE `face_identification` (
  `face_id` int(11) NOT NULL,
  `person_id` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `face_identification`
--

INSERT INTO `face_identification` (`face_id`, `person_id`, `picture`, `admin_id`) VALUES
(16, 5, '9103014696082', 0);

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `person_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `dateOfbirth` date DEFAULT NULL,
  `id_number` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `house_no` varchar(255) NOT NULL,
  `street_name` varchar(255) NOT NULL,
  `suburb` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `keen_firstname` varchar(255) NOT NULL,
  `keen_lastname` varchar(255) NOT NULL,
  `keen_email` varchar(255) NOT NULL,
  `keen_phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `employee_type` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `confirmed_acc` varchar(1) NOT NULL DEFAULT '0',
  `admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`person_id`, `firstname`, `lastname`, `gender`, `dateOfbirth`, `id_number`, `phone`, `house_no`, `street_name`, `suburb`, `city`, `province`, `zip_code`, `country`, `keen_firstname`, `keen_lastname`, `keen_email`, `keen_phone`, `email`, `employee_type`, `password`, `confirmed_acc`, `admin_id`) VALUES
(5, 'Kabelo', 'Thejane', 'Male', '2005-12-31', '9103014696082', '0727780512', '10', 'wane', 'Braamfontein', 'johannesburg', 'gauteng', '2000', 'South Africa', 'Kabelo', 'Jackie', 'zumajacob@gmail.com', '0727780512', 'zumajacob@gmail.com', 'Police', '12eaab111b446b732cc93aa6ba43cf80', '1', 0),
(7, 'Kabza', 'Hlungwani', 'kliudfg', '2022-10-31', '9608015696082', '0727780512', '54545', 'oiuydfgh', 'hgfdcvb', 'xzcvbnm', 'gauteng', '5656', 'Zambia', 'Zuzile', 'Skhosana', 'kabelomighty@gmail.com', '0727780512', 'fdghxcv@gmail.com', 'default', '12eaab111b446b732cc93aa6ba43cf80', '0', 0),
(8, '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 'South', '', '', 'kabelomighty@gmail.com', '', '', 'default', '724606eef0ec338724b3b8c9f1e4e823', '0', 0),
(9, '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 'South', '', '', 'kabelomighty@gmail.com', '', '', 'default', '724606eef0ec338724b3b8c9f1e4e823', '0', 0),
(10, '', '', 'me', '0000-00-00', '', '', '', '', '', '', '', '', 'South', '', '', 'kabelomighty@gmail.com', '', '', 'default', '724606eef0ec338724b3b8c9f1e4e823', '0', 0),
(11, '', '', 'Female', '0000-00-00', '', '', '', '', '', '', '', '', 'South', '', '', 'kabelomighty@gmail.com', '', '', 'default', '724606eef0ec338724b3b8c9f1e4e823', '0', 0),
(12, '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 'South', '', '', 'kabelomighty@gmail.com', '', '', 'default', '724606eef0ec338724b3b8c9f1e4e823', '0', 0),
(13, '', '', '', '0000-00-00', '', '', '', '', '', '', '', '', 'South', '', '', 'kabelomighty@gmail.com', '', '', 'default', '724606eef0ec338724b3b8c9f1e4e823', '0', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `docket`
--
ALTER TABLE `docket`
  ADD PRIMARY KEY (`docket_id`);

--
-- Indexes for table `face_identification`
--
ALTER TABLE `face_identification`
  ADD PRIMARY KEY (`face_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`person_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `docket`
--
ALTER TABLE `docket`
  MODIFY `docket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `face_identification`
--
ALTER TABLE `face_identification`
  MODIFY `face_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `person_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
