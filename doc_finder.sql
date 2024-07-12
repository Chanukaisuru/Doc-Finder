-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2024 at 06:13 PM
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
-- Database: `doc_finder`
--

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `reg_no` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `specialty` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`reg_no`, `user_id`, `first_name`, `last_name`, `phone_no`, `province`, `qualification`, `specialty`) VALUES
('mbbs123', 10, 'Tharindu', 'Dilshan', '0766263405', 'Mātara', 'mbbs', 'fiver'),
('mbbs1234', 12, 'Tharindu', 'Dilshan', '0766263405', 'Mātara', 'mbbs', 'fiver');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `feedback_text` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `email`, `contact_number`, `feedback_text`, `submitted_at`) VALUES
(1, 'Tharindu Dilshan', 'tharindudilshan6263@gmail.com', '1452655', 'goood', '2024-07-11 09:50:49'),
(2, 'Tharindu Dilshan', 'tharindudilshan6263@gmail.com', '', 'good', '2024-07-11 09:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `nic` varchar(100) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `age` int(3) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `sick` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`nic`, `user_id`, `first_name`, `last_name`, `age`, `phone_no`, `address`, `province`, `sick`) VALUES
('200177501366', NULL, 'Tharindu', 'Dilshan', 29, '0766263405', 'kotapolagedara, thennapita, gomila,mawarala', 'Mātara', 'fiver'),
('200177501369', 9, 'Tharindu', 'Dilshan', 29, '0766263405', 'kotapolagedara, thennapita, gomila,mawarala', 'Mātara', 'fiver');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role_no` int(2) NOT NULL,
  `otp_code` varchar(6) DEFAULT NULL,
  `otp_expires_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `user_name`, `password`, `role_no`, `otp_code`, `otp_expires_at`, `created_at`) VALUES
(1, 'tharindudilshan6263@gmail.com', 'root', '$2y$10$la1ulySPCtwV4W5blQxzpORBRcRIbJTuuUfHXgu83CigyqG8I0kDG', 1, NULL, NULL, '2024-07-12 04:24:57'),
(2, 'chanukaisuru26@gmail.com', 'root', '$2y$10$DoGYKzUfyGF7yU2RrpFl8OTRBb7v/v76B4MUF1kZu/hfPzAgh3MHe', 2, NULL, NULL, '2024-07-12 04:25:12'),
(6, 'tharindu@gmail.com', 'tharindu', '123', 1, NULL, NULL, '2024-07-11 22:50:57'),
(7, 'tharindudilshanem6263@gmail.com', 'Tharindu', '$2y$10$A4rOmRJd0yHYcwV.blHHauPYT.6MEqrPln5d3Cp4dC3NQyueLpdJu', 3, '607715', '2024-07-12 18:02:58', '2024-07-12 13:25:13'),
(8, 'tharindudilshanemf6263@gmail.com', 'Tharindu', '$2y$10$M77oD.8y1LX9X1wOMi5zsO2VnquCX0Txkupe7egzVHztAIWZQXsl.', 3, NULL, NULL, '2024-07-12 13:27:17'),
(9, 'tharindudilshanemlll6263@gmail.com', 'Tharindu', '$2y$10$noQ8e5/hY2VsPLrMqORpfu2o3blgYZck.jbo/C/zxUPYtapIpGXd.', 3, NULL, NULL, '2024-07-12 13:27:41'),
(10, 'doctor1@gmail.com', 'Tharindu', '$2y$10$l81asxdm93WMg97o08jozeOBl8w.ShDCqRlOlOSr/dPdrfXBaQONO', 2, NULL, NULL, '2024-07-12 13:34:24'),
(11, 'admin@gmail.com', 'admin', '$2y$10$x3pIfnq8BYTU46uj.ywRte.YqtPedSI4CZhHIwcqzsD4hChVo43RW', 1, NULL, NULL, '2024-07-12 13:39:12'),
(12, 'chanaka8@gmail.com', 'Tharindu', '$2y$10$SEcEUXqqqggRh.JoR5kXiOdUbUOB7zMWZmaXGlbBfrxoC/Ix2VPoy', 2, NULL, NULL, '2024-07-12 15:34:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`reg_no`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`nic`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `patients`
--
ALTER TABLE `patients`
  ADD CONSTRAINT `patients_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
