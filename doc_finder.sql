-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 08:24 PM
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
  `name` varchar(100) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `specialty` varchar(100) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `hospital` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`reg_no`, `user_id`, `name`, `phone_no`, `district`, `location`, `qualification`, `specialty`, `profile_photo`, `hospital`, `address`) VALUES
('mbbs123', 57, 'Tharindu Dilshan', '0766263405', 'Galle', 'matara', 'mbbs1258', 'Orthopedic surgeon', 'uploads/Screenshot 2024-07-12 073501.png', 'matara', NULL),
('mbbs1232689', NULL, 'Tharindu Dilshan', '0766263405', 'Colombo', 'matara', 'mbbs1258', 'Gynecologist', 'Screenshot 2024-07-12 073501.png', 'matara', 'kotapolagedara, thennapita, gomila,mawarala'),
('mbbs123454', NULL, 'Tharindu Dilshan', '0766263405', 'Kandy', 'matara', 'xsdfghnbvc2652', 'General Practitioner', 'Screenshot 2024-07-12 073501.png', 'matara', 'kotapolagedara, thennapita, gomila,mawarala'),
('mbbs1235', 60, 'Tharindu Dilshan', '0766263405', 'Colombo', '6.175126004190012, 80.60610863497429', 'mbbs1258', 'Orthopedic surgeon', 'Screenshot 2024-07-12 073501.png', 'matara', 'kotapolagedara, thennapita, gomila,mawarala'),
('mbbs12389', 59, 'Tharindu Dilshan', '0766263405', 'Matara', 'matara', 'xsdfghnbvc2652', 'Dermatologist', 'Screenshot 2024-07-12 073501.png', 'matara', 'kotapolagedara, thennapita, gomila,mawarala');

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
(2, 'Tharindu Dilshan', 'tharindudilshan6263@gmail.com', '', 'good', '2024-07-11 09:51:59'),
(3, 'Tharindu Dilshan', 'chanukaisuru26@gmail.com', '', 'fgfdrtdgfcgctrtdcythcdcyhc', '2024-07-14 05:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message_details` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `district` varchar(50) DEFAULT NULL,
  `sick` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(54, 'ravinduhasith7002@gmail.com', 'admin', '$2y$10$qHuseJQBCXz17PN1eITDwOi7m7xJaDlpBEyQr/3XDe7BN5KmDZBGK', 1, '705229', '2024-07-24 18:36:53', '2024-07-24 05:45:56'),
(55, 'tharindudilshan6263@gmail.com', 'admin', '$2y$10$xPNPSB45f3oJ0Ksl4b//Y.7KRc2j2JecBbryqv3wM2F3TQLKzmTWC', 1, NULL, NULL, '2024-07-24 06:31:49'),
(57, 'chanukaisuru26@gmail.com', 'Tharindu Dilshan', '', 2, NULL, NULL, '2024-07-25 17:08:34'),
(58, 'tharindudilshan626563@gmail.com', 'Tharindu Dilshan', '$2y$10$NZ.icS9.BfZVR3FnHyrPOu1KmNASGlSD0KgTt7MmYho8QXL4VQoZK', 2, NULL, NULL, '2024-07-25 17:59:48'),
(59, 'tharindudilshan656263@gmail.com', 'Tharindu Dilshan', '', 2, NULL, NULL, '2024-07-25 18:03:15'),
(60, 'chanukaisuru256@gmail.com', 'Tharindu Dilshan', '', 2, NULL, NULL, '2024-07-25 18:05:27');

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
-- Indexes for table `messages`
--
ALTER TABLE `messages`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

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
