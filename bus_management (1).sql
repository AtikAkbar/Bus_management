-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 01:22 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `bus`
--

CREATE TABLE `bus` (
  `bus_id` int(11) NOT NULL,
  `bus_number` varchar(20) NOT NULL,
  `capacity` int(11) NOT NULL,
  `bus_type` varchar(50) NOT NULL,
  `manufacturer` varchar(50) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `purchase_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus`
--

INSERT INTO `bus` (`bus_id`, `bus_number`, `capacity`, `bus_type`, `manufacturer`, `status`, `purchase_date`) VALUES
(1, '101', 50, 'Luxury', 'Toto', 'Active', '2022-10-01'),
(2, '102', 30, 'Mini', 'Toto', 'Active', '2023-05-25');

-- --------------------------------------------------------

--
-- Table structure for table `bus_buss_driver`
--

CREATE TABLE `bus_buss_driver` (
  `bus_id` int(11) NOT NULL,
  `schedule_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bus_schedule`
--

CREATE TABLE `bus_schedule` (
  `schedule_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `route_id` int(11) NOT NULL,
  `departure_time` time NOT NULL,
  `arrival_time` time NOT NULL,
  `trip_duration` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_schedule`
--

INSERT INTO `bus_schedule` (`schedule_id`, `bus_id`, `route_id`, `departure_time`, `arrival_time`, `trip_duration`) VALUES
(1, 1, 1, '10:00:00', '12:00:00', '02:00:00'),
(2, 2, 1, '11:00:00', '01:00:00', '02:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `bus_user`
--

CREATE TABLE `bus_user` (
  `user_id` int(11) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `bus_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bus_user`
--

INSERT INTO `bus_user` (`user_id`, `phone`, `email`, `name`, `bus_id`) VALUES
(1, '0179635', 'joy.datta@northsouth.edu', 'Joy ', 1),
(2, '0179689', 'atik@northsouth.edu', 'Atik', 1);

-- --------------------------------------------------------

--
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `user_id` int(11) NOT NULL,
  `license_number` varchar(20) NOT NULL,
  `experience_years` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `driver_shift`
--

CREATE TABLE `driver_shift` (
  `shift_id` int(11) NOT NULL,
  `bus_id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `shift_start_time` varchar(15) DEFAULT NULL,
  `shift_end_time` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `passenger`
--

CREATE TABLE `passenger` (
  `user_id` int(11) NOT NULL,
  `travel_date` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `passenger`
--

INSERT INTO `passenger` (`user_id`, `travel_date`) VALUES
(1, '10-12-2022'),
(2, '17-10-2021');

-- --------------------------------------------------------

--
-- Table structure for table `routeb`
--

CREATE TABLE `routeb` (
  `route_id` int(11) NOT NULL,
  `from` varchar(50) NOT NULL,
  `starting_point` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL,
  `distance` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `routeb`
--

INSERT INTO `routeb` (`route_id`, `from`, `starting_point`, `destination`, `distance`) VALUES
(1, 'Dhaka_Route', '11.30 AM', 'Cumilla', 500.00),
(2, 'Khulna Route', '12.30 AM', 'Cumilla', 500.00);

-- --------------------------------------------------------

--
-- Table structure for table `sign_up`
--

CREATE TABLE `sign_up` (
  `signup_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sign_up`
--

INSERT INTO `sign_up` (`signup_id`, `first_name`, `last_name`, `email`, `phone`, `password`) VALUES
(1, 'John', 'Doe', 'john@doe.me', '0123456789', '1111'),
(3, 'Joy', 'Datta', 'joy@datta.com', '0123456789', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bus`
--
ALTER TABLE `bus`
  ADD PRIMARY KEY (`bus_id`);

--
-- Indexes for table `bus_buss_driver`
--
ALTER TABLE `bus_buss_driver`
  ADD PRIMARY KEY (`bus_id`,`schedule_id`,`user_id`),
  ADD KEY `schedule_id` (`schedule_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `bus_schedule`
--
ALTER TABLE `bus_schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `route_id` (`route_id`);

--
-- Indexes for table `bus_user`
--
ALTER TABLE `bus_user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `bus_id` (`bus_id`);

--
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `driver_shift`
--
ALTER TABLE `driver_shift`
  ADD PRIMARY KEY (`shift_id`),
  ADD KEY `bus_id` (`bus_id`),
  ADD KEY `driver_id` (`driver_id`);

--
-- Indexes for table `passenger`
--
ALTER TABLE `passenger`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `routeb`
--
ALTER TABLE `routeb`
  ADD PRIMARY KEY (`route_id`);

--
-- Indexes for table `sign_up`
--
ALTER TABLE `sign_up`
  ADD PRIMARY KEY (`signup_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sign_up`
--
ALTER TABLE `sign_up`
  MODIFY `signup_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bus_buss_driver`
--
ALTER TABLE `bus_buss_driver`
  ADD CONSTRAINT `bus_buss_driver_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`),
  ADD CONSTRAINT `bus_buss_driver_ibfk_2` FOREIGN KEY (`schedule_id`) REFERENCES `bus_schedule` (`schedule_id`),
  ADD CONSTRAINT `bus_buss_driver_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `driver` (`user_id`);

--
-- Constraints for table `bus_schedule`
--
ALTER TABLE `bus_schedule`
  ADD CONSTRAINT `bus_schedule_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`),
  ADD CONSTRAINT `bus_schedule_ibfk_2` FOREIGN KEY (`route_id`) REFERENCES `routeb` (`route_id`);

--
-- Constraints for table `bus_user`
--
ALTER TABLE `bus_user`
  ADD CONSTRAINT `bus_user_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`);

--
-- Constraints for table `driver`
--
ALTER TABLE `driver`
  ADD CONSTRAINT `driver_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bus_user` (`user_id`);

--
-- Constraints for table `driver_shift`
--
ALTER TABLE `driver_shift`
  ADD CONSTRAINT `driver_shift_ibfk_1` FOREIGN KEY (`bus_id`) REFERENCES `bus` (`bus_id`),
  ADD CONSTRAINT `driver_shift_ibfk_2` FOREIGN KEY (`driver_id`) REFERENCES `driver` (`user_id`);

--
-- Constraints for table `passenger`
--
ALTER TABLE `passenger`
  ADD CONSTRAINT `passenger_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `bus_user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
