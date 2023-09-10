-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 10, 2023 at 10:33 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trinitas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'adTrinitas@gmail.com', '$2y$10$PwzUj1TAWpfZ9JNtOWIVHOg5EVhAJDOP0x9deJ.iSSonUkEt8OCWa');

-- --------------------------------------------------------

--
-- Table structure for table `appoinment_record`
--

CREATE TABLE `appoinment_record` (
  `appoint_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `appoint_sched` datetime NOT NULL,
  `appoint_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appoinment_record`
--

INSERT INTO `appoinment_record` (`appoint_id`, `user_id`, `first_name`, `last_name`, `street_add`, `city_municipality`, `province`, `postal_code`, `contact_no`, `appoint_sched`, `appoint_description`) VALUES
(1, 1, 'Niña Gillian', 'Villamin', 'National Road St.', 'Dimasalang', 'Masbate', 5407, '0912343434', '2023-05-30 03:47:00', 'Test'),
(2, 3, 'Joana', 'Lomerio', 'P1', 'Pilar', 'Sorsogon', 2121, '091234578604', '2023-05-25 07:59:00', 'Appointment purpose');

-- --------------------------------------------------------

--
-- Table structure for table `appoinment_report`
--

CREATE TABLE `appoinment_report` (
  `appoint_report_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `appointt_report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_report`
--

CREATE TABLE `cancellation_report` (
  `cancellation_id` int(11) NOT NULL,
  `retreat_id` int(11) NOT NULL,
  `recollection_id` int(11) NOT NULL,
  `reception_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `seminar_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `feedback_message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(255) NOT NULL,
  `receiver_id` int(255) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` int(11) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `message`, `timestamp`, `is_read`, `is_admin`) VALUES
(1, 1, 1, 'Psst', '2023-09-09 04:01:49', 1, 1),
(2, 4, 1, 'This is a test message', '2023-09-09 04:03:52', 1, 0),
(3, 1, 4, 'hello!', '2023-09-09 04:03:57', 1, 1),
(4, 4, 1, 'HI', '2023-09-09 04:04:00', 1, 0),
(5, 1, 4, 'How are you?', '2023-09-09 04:04:05', 1, 1),
(6, 2, 1, 'Hellooo', '2023-09-10 00:42:28', 1, 0),
(7, 3, 1, 'Testing.....', '2023-09-10 01:17:13', 1, 0),
(8, 2, 1, 'hehe', '2023-09-10 01:19:37', 1, 0),
(9, 1, 2, 'hehehehehehehehh', '2023-09-10 01:19:46', 1, 1),
(10, 1, 2, 'hello', '2023-09-10 04:16:40', 1, 1),
(11, 1, 1, 'Hello', '2023-09-10 04:25:00', 1, 0),
(12, 1, 1, 'Hiii', '2023-09-10 04:30:39', 1, 1),
(13, 1, 1, 'hello ulit', '2023-09-10 04:30:55', 1, 1),
(14, 1, 1, 'Yep?', '2023-09-10 04:30:59', 1, 0),
(15, 1, 1, 'Opo sis', '2023-09-10 04:34:40', 1, 0),
(16, 1, 2, 'HAHAHAH', '2023-09-10 05:46:53', 1, 1),
(17, 1, 3, 'yes p', '2023-09-10 05:47:16', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price` float NOT NULL,
  `prod_img` varchar(255) NOT NULL,
  `prod_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reception_reservation_record`
--

CREATE TABLE `reception_reservation_record` (
  `reception_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `price` float NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `payment_option` enum('Pay Full','Pay Half') DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reception_reservation_record`
--

INSERT INTO `reception_reservation_record` (`reception_id`, `user_id`, `first_name`, `last_name`, `street_add`, `city_municipality`, `province`, `postal_code`, `contact_no`, `check_in`, `check_out`, `price`, `payment_method`, `payment_option`, `proof_of_payment`) VALUES
(1, 1, 'Niña Gillian', 'Villamin', 'National Road St.', 'Pilar', 'Masbate', 4355, '091234578604', '2023-05-24', '2023-05-25', 8000, 'Pay-on-Site', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `recollection_reservation_record`
--

CREATE TABLE `recollection_reservation_record` (
  `recollection_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `guest_count` int(255) NOT NULL,
  `check_in` datetime NOT NULL,
  `check_out` datetime NOT NULL,
  `catering` enum('Yes','No') NOT NULL,
  `price` float NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `payment_option` enum('Pay Full','Pay Half') DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recollection_reservation_record`
--

INSERT INTO `recollection_reservation_record` (`recollection_id`, `user_id`, `first_name`, `last_name`, `street_add`, `city_municipality`, `province`, `postal_code`, `contact_no`, `guest_count`, `check_in`, `check_out`, `catering`, `price`, `payment_method`, `payment_option`, `proof_of_payment`) VALUES
(1, 1, 'Joana', 'Lomerio', 'P1', 'Pilar', 'Sorsogon', 4355, '091234578604', 2, '2023-05-23 14:18:00', '2023-05-26 14:18:00', 'No', 4800, 'Pay-on-Site', NULL, NULL),
(2, 3, 'Niña Gillian', 'Villamin', 'National Road St.', 'Dimasalang', 'Albay', 3243, '091234578604', 2, '2023-05-25 20:53:00', '2023-05-27 20:53:00', 'Yes', 6400, 'Pay-on-Site', NULL, NULL),
(3, 3, 'Niña Gillian', 'Villamin', 'National Road St.', 'Dimasalang', 'Masbate', 4355, '091234578604', 2, '2023-05-24 22:27:00', '2023-05-27 22:27:00', 'Yes', 9600, 'Pay-on-Site', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_report`
--

CREATE TABLE `reservation_report` (
  `report_id` int(11) NOT NULL,
  `retreat_id` int(11) NOT NULL,
  `recollection_id` int(11) NOT NULL,
  `reception_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `seminar_id` int(11) NOT NULL,
  `report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `retreat_reservation_record`
--

CREATE TABLE `retreat_reservation_record` (
  `retreat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `guest_count` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `room_type` enum('Casa Maria','Lunduyan','Attic') NOT NULL,
  `catering` enum('Yes','No') NOT NULL,
  `price` float NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `payment_option` enum('pay_full','pay_half') DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retreat_reservation_record`
--

INSERT INTO `retreat_reservation_record` (`retreat_id`, `user_id`, `first_name`, `last_name`, `street_add`, `city_municipality`, `province`, `postal_code`, `contact_no`, `guest_count`, `check_in`, `check_out`, `room_type`, `catering`, `price`, `payment_method`, `payment_option`, `proof_of_payment`) VALUES
(1, 3, 'Niña Gillian', 'Villamin', 'National Road St.', 'Dimasalang', 'Albay', 4355, '091234578604', 2, '2023-05-22', '2023-05-24', 'Lunduyan', 'Yes', 6400, 'Pay-on-Site', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sales_report`
--

CREATE TABLE `sales_report` (
  `sales_report_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `total_sales` float NOT NULL,
  `sales_report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seminar_reservation_record`
--

CREATE TABLE `seminar_reservation_record` (
  `seminar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `guest_count` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `catering` enum('Yes','No') NOT NULL,
  `price` float NOT NULL,
  `payment_method` enum('Pay-on_Site','GCash') NOT NULL,
  `payment_option` enum('Pay Full','Pay half') DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seminar_reservation_record`
--

INSERT INTO `seminar_reservation_record` (`seminar_id`, `user_id`, `last_name`, `first_name`, `street_add`, `province`, `city_municipality`, `postal_code`, `contact_no`, `guest_count`, `check_in`, `check_out`, `catering`, `price`, `payment_method`, `payment_option`, `proof_of_payment`) VALUES
(1, 3, 'Villamin', 'Niña Gillian', 'National Road St.', 'Masbate', 'Dimasalang', 3243, '091234578604', 3, '2023-05-24', '2023-05-27', 'Yes', 14400, '', NULL, NULL),
(2, 3, 'Aranel', 'Angel', 'Malangka', 'Albay', 'Legazpi', 3243, '091234578604', 2, '2023-05-21', '2023-05-27', 'Yes', 19200, '', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `training_reservation_record`
--

CREATE TABLE `training_reservation_record` (
  `training_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `catering` enum('Yes','No') NOT NULL,
  `price` float NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `payment_option` enum('Pay Full','Pay Half') DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `reportId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `training_reservation_record`
--

INSERT INTO `training_reservation_record` (`training_id`, `user_id`, `first_name`, `last_name`, `street_add`, `city_municipality`, `province`, `postal_code`, `contact_no`, `check_in`, `check_out`, `catering`, `price`, `payment_method`, `payment_option`, `proof_of_payment`, `reportId`) VALUES
(1, 3, 'Joana', 'Lomerio', 'P1', 'Pilar', 'Sorsogon', 4355, '091234578604', '2023-05-23', '2023-05-26', 'Yes', 0, 'Pay-on-Site', NULL, NULL, 0),
(2, 3, 'Joana', 'Lomerio', 'P1', 'Pilar', 'Sorsogon', 4355, '091234578604', '2023-05-23', '2023-05-26', 'Yes', 0, 'Pay-on-Site', NULL, NULL, 0),
(3, 3, 'Crissa', 'Olavario', 'Upper Bonga', 'Bacacay', 'Albay', 4355, '091234578604', '2023-05-24', '2023-05-26', 'Yes', 0, 'Pay-on-Site', NULL, NULL, 0),
(4, 3, 'Crissa', 'Olavario', 'Upper Bonga', 'Bacacay', 'Albay', 4355, '091234578604', '2023-05-24', '2023-05-26', 'Yes', 0, 'Pay-on-Site', NULL, NULL, 0),
(5, 3, 'Crissa', 'Olavario', 'Upper Bonga', 'Bacacay', 'Albay', 4355, '091234578604', '2023-05-24', '2023-05-26', 'Yes', 0, 'Pay-on-Site', NULL, NULL, 0),
(6, 3, 'Niña Gillian', 'Villamin', 'National Road St.', 'Dimasalang', 'Albay', 4355, '091234578604', '2023-05-23', '2023-05-25', 'Yes', 0, 'Pay-on-Site', NULL, NULL, 0),
(7, 3, 'Niña Gillian', 'Villamin', 'National Road St.', 'Dimasalang', 'Albay', 4355, '0912321432', '2023-05-22', '2023-05-27', 'No', 0, 'Pay-on-Site', NULL, NULL, 0),
(8, 3, 'Niña Gillian', 'Villamin', 'National Road St.', 'Dimasalang', 'Albay', 4355, '0912321432', '2023-05-22', '2023-05-27', 'No', 0, 'Pay-on-Site', NULL, NULL, 0),
(9, 3, 'Joana', 'Lomerio', 'National Road St.', 'Dimasalang', 'Masbate', 4355, '123213', '2023-06-09', '2023-06-10', 'Yes', 0, 'Pay-on-Site', NULL, NULL, 0),
(10, 3, 'Niña Gillian', 'Villamin', 'National Road St.', 'Pilar', 'gfgrbt', 4355, '12345', '2023-05-23', '2023-05-25', 'Yes', 0, 'Pay-on-Site', NULL, NULL, 0),
(11, 3, 'Niña Gillian', 'Lomerio', 'National Road St.', 'Pilar', 'Albay', 4355, '091234578604', '2023-05-25', '2023-05-26', 'Yes', 8000, 'Pay-on-Site', NULL, NULL, 0),
(12, 3, 'Niña Gillian', 'Villamin', 'National Road St.', 'Dimasalang', 'Masbate', 3243, '091234578604', '2023-05-24', '2023-05-27', 'Yes', 26400, 'Pay-on-Site', NULL, NULL, 0),
(13, 3, 'Niña Gillian', 'Villamin', 'National Road St.', 'Dimasalang', 'Albay', 4355, '091234578604', '2023-05-24', '2023-05-25', 'Yes', 17600, 'Pay-on-Site', NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'testing_only', 'test', 'test@mail.com', '$2y$10$7aF3OFX6G3yv/gOKmjpplOl/k576321hLrBp9pTLbpr2ph591JbyW'),
(2, 'Nina Gillian', 'Villamin', '1233@mail.com', '$2y$10$EbW5XQ04PobEzzh883WF4eKfTcAw2sYrdr1HDSY0W2G1TKJv9UJQa'),
(3, 'Basta User', 'Basta lastname', 'test@ayokona.com', '$2y$10$M5H4CffLtpuke5jci8HO5e3ONwM2Eg0uoa/067VLdp8ATFZBee8f.'),
(4, 'Juan', 'Dela Cruz', 'juan@mail.com', '$2y$10$6VuFvqbM3Sr9VnppwtU8RuGh9gojI9dqfOnRQWCGmSYgv3VK/IvuG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `appoinment_record`
--
ALTER TABLE `appoinment_record`
  ADD PRIMARY KEY (`appoint_id`),
  ADD KEY `appoinment_record_ibfk_1` (`user_id`);

--
-- Indexes for table `appoinment_report`
--
ALTER TABLE `appoinment_report`
  ADD PRIMARY KEY (`appoint_report_id`),
  ADD KEY `appoint_id` (`appoint_id`);

--
-- Indexes for table `cancellation_report`
--
ALTER TABLE `cancellation_report`
  ADD PRIMARY KEY (`cancellation_id`),
  ADD KEY `appoint_id` (`appoint_id`),
  ADD KEY `reservation_id` (`retreat_id`),
  ADD KEY `recollection_id2` (`recollection_id`),
  ADD KEY `reception_id2` (`reception_id`),
  ADD KEY `seminar_id2` (`seminar_id`),
  ADD KEY `training_id2` (`training_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `reception_reservation_record`
--
ALTER TABLE `reception_reservation_record`
  ADD PRIMARY KEY (`reception_id`),
  ADD KEY `user_id4` (`user_id`);

--
-- Indexes for table `recollection_reservation_record`
--
ALTER TABLE `recollection_reservation_record`
  ADD PRIMARY KEY (`recollection_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reservation_report`
--
ALTER TABLE `reservation_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `retreat_id` (`retreat_id`),
  ADD KEY `recollection_id` (`recollection_id`),
  ADD KEY `seminar_id` (`seminar_id`),
  ADD KEY `training_id` (`training_id`),
  ADD KEY `reception_id` (`reception_id`);

--
-- Indexes for table `retreat_reservation_record`
--
ALTER TABLE `retreat_reservation_record`
  ADD PRIMARY KEY (`retreat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD PRIMARY KEY (`sales_report_id`),
  ADD KEY `reserve_id` (`report_id`);

--
-- Indexes for table `seminar_reservation_record`
--
ALTER TABLE `seminar_reservation_record`
  ADD PRIMARY KEY (`seminar_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `training_reservation_record`
--
ALTER TABLE `training_reservation_record`
  ADD PRIMARY KEY (`training_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reportId` (`reportId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `appoinment_record`
--
ALTER TABLE `appoinment_record`
  MODIFY `appoint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `appoinment_report`
--
ALTER TABLE `appoinment_report`
  MODIFY `appoint_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cancellation_report`
--
ALTER TABLE `cancellation_report`
  MODIFY `cancellation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reception_reservation_record`
--
ALTER TABLE `reception_reservation_record`
  MODIFY `reception_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `recollection_reservation_record`
--
ALTER TABLE `recollection_reservation_record`
  MODIFY `recollection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reservation_report`
--
ALTER TABLE `reservation_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retreat_reservation_record`
--
ALTER TABLE `retreat_reservation_record`
  MODIFY `retreat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_report`
--
ALTER TABLE `sales_report`
  MODIFY `sales_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seminar_reservation_record`
--
ALTER TABLE `seminar_reservation_record`
  MODIFY `seminar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `training_reservation_record`
--
ALTER TABLE `training_reservation_record`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appoinment_record`
--
ALTER TABLE `appoinment_record`
  ADD CONSTRAINT `user_id5` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `appoinment_report`
--
ALTER TABLE `appoinment_report`
  ADD CONSTRAINT `appoint_id2` FOREIGN KEY (`appoint_id`) REFERENCES `appoinment_record` (`appoint_id`) ON UPDATE CASCADE;

--
-- Constraints for table `cancellation_report`
--
ALTER TABLE `cancellation_report`
  ADD CONSTRAINT `appoint_id` FOREIGN KEY (`appoint_id`) REFERENCES `appoinment_record` (`appoint_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reception_id2` FOREIGN KEY (`reception_id`) REFERENCES `reception_reservation_record` (`reception_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `recollection_id2` FOREIGN KEY (`recollection_id`) REFERENCES `recollection_reservation_record` (`recollection_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `retreat_id2` FOREIGN KEY (`retreat_id`) REFERENCES `retreat_reservation_record` (`retreat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_id2` FOREIGN KEY (`seminar_id`) REFERENCES `seminar_reservation_record` (`seminar_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `training_id2` FOREIGN KEY (`training_id`) REFERENCES `training_reservation_record` (`training_id`) ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `user_id7` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `reception_reservation_record`
--
ALTER TABLE `reception_reservation_record`
  ADD CONSTRAINT `user_id4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `reservation_report`
--
ALTER TABLE `reservation_report`
  ADD CONSTRAINT `reception_id` FOREIGN KEY (`reception_id`) REFERENCES `reception_reservation_record` (`reception_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `recollection_id` FOREIGN KEY (`recollection_id`) REFERENCES `recollection_reservation_record` (`recollection_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `retreat_id` FOREIGN KEY (`retreat_id`) REFERENCES `retreat_reservation_record` (`retreat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_id` FOREIGN KEY (`seminar_id`) REFERENCES `seminar_reservation_record` (`seminar_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `training_id` FOREIGN KEY (`training_id`) REFERENCES `training_reservation_record` (`training_id`) ON UPDATE CASCADE;

--
-- Constraints for table `retreat_reservation_record`
--
ALTER TABLE `retreat_reservation_record`
  ADD CONSTRAINT `user_id2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD CONSTRAINT `report_id` FOREIGN KEY (`report_id`) REFERENCES `reservation_report` (`report_id`) ON UPDATE CASCADE;

--
-- Constraints for table `seminar_reservation_record`
--
ALTER TABLE `seminar_reservation_record`
  ADD CONSTRAINT `user_id1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
