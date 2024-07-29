-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 28, 2024 at 07:36 PM
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
  `reg_no` varchar(50) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `location` varchar(1000) DEFAULT NULL,
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
('D/G/001', 76, 'Dr.Malinda Ekanayaka', '0766688954', 'Galle', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.4642105877956!2d80.22526487364674!3d6.067960428292162!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae1717e95435301%3A0xb5551fc56b0066ce!2sGalle%20Dental%20Care%20-Dr%20Malinda%20Ekanayake-Dentist-Implantologist!5e0!3m2!1sen!2slk!4v1722182077950!5m2!1sen!2slk', 'Dentistry', 'Dentist', 'depositphotos_210888716-stock-ph.jpg', 'Galle Dental Care', '1st floor,Namal filling station, Galle 80000'),
('D/G/002', 80, 'Dr.Pasindu Dilshan', '0725436215', 'Galle', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d57446.833852285694!2d80.17079699879848!3d6.056142950513006!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae17146f3021411%3A0x1e348a017514f8a9!2sRuhunu%20Hospital%20International%20Medical%20Center-%20Galle!5e1!3m2!1sen!2slk!4v1722179644819!5m2!1sen!2slk', 'Dentistry', 'Dentist', 'indian-doctor.jpg', 'Ruhunu Hospital', 'Kumaradasa Mawatha, Galle.'),
('D/GMP/001', 77, 'Dr.Surya Nanayakkara', '0702311030', 'Gampaha', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4939712.734654212!2d75.13780152706069!3d10.42813202846531!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2fbb4d3943eb1%3A0x743265049d8cbdd4!2sIdeal%20Dental%20Clinic!5e0!3m2!1sen!2slk!4v1722182275225!5m2!1sen!2slk', 'Dentistry', 'Dentist', 'handsome-indian-doctor-generate.jpg', 'Ideal Dental Clinic', 'Sanasa Ideal Complex, No 5,6,7, Gampaha 11000'),
('D/GMP/002', 81, 'Dr.udaya Kumara', '0155212655', 'Gampaha', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28663.5783416285!2d79.96086327431642!3d7.092851600000005!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2fbf31dd44adb%3A0xac1c31e22f8dd4a4!2sArogya%20Hospitals%20Pharmacy!5e1!3m2!1sen!2slk!4v1722180676930!5m2!1sen!2slk', 'Dentistry', 'Dentist', 'indian-doctor.jpg', 'Arogya Hospital', 'Nawinna Road, Gampaha.'),
('D/H/001', 79, 'Dr.Supun Navoda', '0758899632', 'Hambantota', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1689.3840018677406!2d81.00341570525974!3d6.307541872992923!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae6a78d7d5f4023%3A0xab99547d7ca23550!2sLanka%20Pharmacy%20And%20Channel%20Center!5e1!3m2!1sen!2slk!4v1722180012323!5m2!1sen!2slk', 'Dentistry', 'Dentist', 'images.jpg', 'Medical Center Hambantota', '45,Samagi Mawatha,Hambantota'),
('D/KND/001', 78, 'Dr.Nayana Gamage', '0123654789', 'Kandy', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3957.5427710356144!2d80.62994427365577!3d7.292746113749188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae36921ed4b73c5%3A0x9138bcdf1e0224cb!2sKatukale%20Dental%20Surgery!5e0!3m2!1sen!2slk!4v1722182460295!5m2!1sen!2slk', 'Dentistry', 'Dentist', 'images (1).jpg', 'Katukale Dental Surgery', 'Mother and Baby Care Channeling Centre, 29 Peradeniya Rd, Kandy 20000'),
('D/MR/001', 74, 'Dr. Kamal Weraseekara', '0765948756', 'Matara', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.3205532683664!2d80.54407727364604!3d5.950492929559591!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae1392fb2540f0d%3A0xda521fb60cfd163!2sDr.%20Kamal%20Weerasekara%20Dental!5e0!3m2!1sen!2slk!4v1722181589243!5m2!1sen!2slk', 'Dentistry', 'Dentist', 'dr-dk-gupta.jpg', 'Private Medical Center', '49, Udaya Mawatha, Matara.'),
('D/MR/002', 75, 'Dr.Ranjith Bandara', '0768912486', 'Matara', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.3577030618562!2d80.55309377364593!3d5.945344629614601!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae138d81bb3d7d9%3A0xbc243e6cf03414a1!2sInternational%20Dental%20Care%20and%20Implantology%20Center!5e0!3m2!1sen!2slk!4v1722181918794!5m2!1sen!2slk', 'Dentistry', 'Dentist', '10-doctor.jpg', 'International Dental Care and Implantology Center', '305/1/1, NEW TANGALLE ROAD , PALLIMULLA, 81000'),
('DL/G/001', 73, 'Dr.pasindu Hettiarachchi', '0785236456', 'Galle', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5586.923990856654!2d80.21380166182033!3d6.035377869950057!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae173bb8fdf788b%3A0x66e808382c238ed!2sAsiri%20Hospital%20Galle!5e0!3m2!1sen!2slk!4v1722181215919!5m2!1sen!2slk', 'Dermatologist', 'Dermatologist', '10-doctor.jpg', 'Asiri Hospital Galle', 'No.10 Wakwella Rd, Galle 80000'),
('DL/GAM/001', 72, 'Dr.Saman Rathnayaka', '0785216478', 'Gampaha', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5424.195386369176!2d79.99818699607897!3d7.09209441236328!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2fbf32a06a8e3%3A0x57514e8f36bd1794!2sNawaloka%20Medicare%20-%20Gampaha!5e0!3m2!1sen!2slk!4v1722180815828!5m2!1sen!2slk', 'Dermatologist', 'Dermatologist', 'handsome-indian-doctor-generate.jpg', 'Nawaloka Medicare - Gampaha', '43 Yakkala Rd, Gampaha'),
('GL/MR/001', 71, 'Dr.Gunathilaka', '0415698123', 'Matara', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.3277748103096!2d80.54603638885494!3d5.9494925000000025!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae138d6b35d8bd3%3A0x65efefb64a60292b!2sAsiri%20Hospital%20Matara!5e0!3m2!1sen!2slk!4v1722179951030!5m2!1sen!2slk', 'Dermatologist', 'Dermatologist', '10-doctor.jpg', 'Asiri Hospital Matara', 'No 26, Esplanade Rd Uyanwatta, 81000'),
('GP/C/001', 68, 'Dr. Dilshan Thahir', '077 298 7585', 'Colombo', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.70109368442!2d79.84762007365285!3d6.926288018354387!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae259596b1ea20f%3A0xda34adbfd02726c7!2sDr.%20Dhilshan%20Thahir!5e0!3m2!1sen!2slk!4v1722177445189!5m2!1sen!2slk', 'General medicine ', 'General Practitioner', 'dr-dk-gupta.jpg', 'Private Medical Center', '40, Green Cross Medical Centre, 28 Malay St, Colombo 2'),
('GP/G/001', 64, 'Dr. C.P. Vidana Pathirane', '0701234564', 'Galle', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d589.772009636114!2d80.21464256214416!3d6.063456786898711!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae173df51710f05%3A0xc6aa4156caff304f!2sMedical%20Centre%20Dr.%20C.P.%20Vidana%20Pathirane!5e0!3m2!1sen!2slk!4v1722157204377!5m2!1sen!2slk', 'General medicine ', 'General Practitioner', 'images.jpg', 'Private Medical Center', 'Nawinna Road, Galle.'),
('GP/G/002', 65, 'Dr. Lokuarachchi', '0761245672', 'Galle', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3967.4585635880003!2d80.22325837364674!3d6.0687275282838185!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae1717c0f8c9a5f%3A0x4ba355d0156ee5ca!2zRHIg4La94Lec4Laa4LeU4LaG4La74Lag4LeK4Lag4LeSIE1lZGljYWwgQ2VudHJl!5e0!3m2!1sen!2slk!4v1722157738647!5m2!1sen!2slk', 'General medicine ', 'General Practitioner', 'handsome-indian-doctor-generate.jpg', 'Private Medical Center', ' 4th Ln, Galle.'),
('GP/GM/001', 66, 'Dr. Tyrell Fernando', '0724587942', 'Gampaha', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d494.91435676663525!2d79.99173040174928!3d7.089453342392147!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae2fbec7ff91f87%3A0x5bf51085812f5c94!2sDr.%20Tyrell%20Fernando%20-%20Family%20Clinic!5e0!3m2!1sen!2slk!4v1722158108741!5m2!1sen!2slk', 'General medicine ', 'General Practitioner', 'depositphotos_210888716-stock-ph.jpg', 'Private Medical Center', 'Vidyala Road, Gampaha.'),
('GP/H/001', 67, 'Dr. Saiful Islam', '0714567891', 'Hambantota', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1014758.4002781804!2d79.83469255317065!3d6.534312047344257!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae6bd006daea8e5%3A0xe1284821423e69e1!2sDr%20Saiful%20Islam%E2%80%99s%20WellCare%20clinic!5e0!3m2!1sen!2slk!4v1722158708753!5m2!1sen!2slk', 'Occupational medicine', 'General Practitioner', '10-doctor.jpg', 'Private Medical Center', '60/2, Wilmot street, Hambantota'),
('GP/H/002', 70, 'Dr. Lakshitha Dananjaya', '0725648789', 'Hambantota', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d31734.448761947322!2d81.07447811083982!3d6.1567191!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae6bcd197dbb0f5%3A0xe42fda70461af392!2sDistrict%20General%20Hospital%20Hambantota%20(New)!5e0!3m2!1sen!2slk!4v1722179550845!5m2!1sen!2slk', 'General medicine ', 'General Practitioner', 'a-mature-indian-male-doctor-on-a.jpg', 'District General Hospital Hambantota', 'Hambantota'),
('GP/KLT/001', 69, 'Dr.Saman Gunarathna', '0712345896', 'Kalutara', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.541839675841!2d79.96033607365021!3d6.579354822514532!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae23720b8eda0b5%3A0x4da35c5ec1a2dd54!2sNEW%20PHILIP%20HOSPITAL!5e0!3m2!1sen!2slk!4v1722178223731!5m2!1sen!2slk', 'General medicine / Occupational medicine', 'General Practitioner', 'indian-doctor.jpg', 'Private Medical Center', '225 Galle Rd, Kalutara'),
('GP/MR/001', 62, 'Dr. Wijegunawardhana', '0702311030', 'Matara', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3968.314971862824!2d80.54525217364602!3d5.951266029551278!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae138d3917543e7%3A0x3d6bb72a54a9352a!2sDr.Wijegunawardana!5e0!3m2!1sen!2slk!4v1722156271305!5m2!1sen!2slk', 'General medicine / Occupational medicine', 'General Practitioner', 'a-mature-indian-male-doctor-on-a.jpg', 'Private Medical Center', '49, Udaya Mawatha, Matara.'),
('GP/MR/002', 63, 'Dr. Ranjith Abeysinghe', '0761278451', 'Matara', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d350.74944887227946!2d80.53635689894676!3d5.956520123776072!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae13f31bc9d5585%3A0xfc4e5f3109057f5a!2sDr.%20Ranjith%20Abeysinghe%20Medical%20Center!5e0!3m2!1sen!2slk!4v1722156898359!5m2!1sen!2slk', 'General medicine / Occupational medicine', 'General Practitioner', 'indian-doctor.jpg', 'Private Medical Center', 'Kumaradasa Mawatha, Matara.');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `feedback_text` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(61, 'docfinder2001@gmail.com', 'admin', '$2y$10$iThNgOzhn95ekrHU5zBKP.kIzY2HY/pFQa7p47/z2svtqgHNbkBFq', 1, NULL, NULL, '2024-07-28 08:39:09'),
(62, 'drwijegunawardhana@gmail.com', 'Dr. Wijegunawardhana', '', 2, NULL, NULL, '2024-07-28 08:49:13'),
(63, 'drranjith@gmail.com', 'Dr. Ranjith Abeysinghe', '', 2, NULL, NULL, '2024-07-28 08:56:07'),
(64, 'drvidana@gmail.com', 'Dr. C.P. Vidana Pathirane', '', 2, NULL, NULL, '2024-07-28 09:01:53'),
(65, 'drlokuarachchi@gmail.com', 'Dr. Lokuarachchi', '', 2, NULL, NULL, '2024-07-28 09:11:13'),
(66, 'drtyrell@gmail.com', 'Dr. Tyrell Fernando', '', 2, NULL, NULL, '2024-07-28 09:16:43'),
(67, 'drsaiful@gmail.com', 'Dr. Saiful Islam', '', 2, NULL, NULL, '2024-07-28 09:28:19'),
(68, 'dilshanthahir@gmail.com', 'Dr. Dilshan Thahir', '', 2, NULL, NULL, '2024-07-28 14:39:56'),
(69, 'samangunarantha12@gmail.com', 'Dr.Saman Gunarathna', '', 2, NULL, NULL, '2024-07-28 14:51:46'),
(70, 'lakshithad12@gmail.com', 'Dr. Lakshitha Dananjaya', '', 2, NULL, NULL, '2024-07-28 15:13:45'),
(71, 'gunathilaka34@gmail.com', 'Dr.Gunathilaka', '', 2, NULL, NULL, '2024-07-28 15:25:04'),
(72, 'srathnayaka@gmail.com', 'Dr.Saman Rathnayaka', '', 2, NULL, NULL, '2024-07-28 15:34:59'),
(73, 'phettiarachchi@gmail.com', 'Dr.pasindu Hettiarachchi', '', 2, NULL, NULL, '2024-07-28 15:41:19'),
(74, 'Kwirasekara@gmail.com', 'Dr. Kamal Weraseekara', '', 2, NULL, NULL, '2024-07-28 15:49:32'),
(75, 'ranith435@gmail.com', 'Dr.Ranjith Bandara', '', 2, NULL, NULL, '2024-07-28 15:52:42'),
(76, 'malinda34@gmail.com', 'Dr.Malinda Ekanayaka', '', 2, NULL, NULL, '2024-07-28 15:55:34'),
(77, 'suyrananayakkara@gmail.com', 'Dr.Surya Nanayakkara', '', 2, NULL, NULL, '2024-07-28 15:58:35'),
(78, 'nayanaekanayaka@gmail.com', 'Dr.Nayana Gamage', '', 2, NULL, NULL, '2024-07-28 16:02:04'),
(79, 'supunnavoda@gmail.com', 'Dr.Supun Navoda', '', 2, NULL, NULL, '2024-07-28 16:07:59'),
(80, 'pasinduDilshan@gmail.com', 'Dr.Pasindu Dilshan', '', 2, NULL, NULL, '2024-07-28 16:18:08'),
(81, 'udaya123@gmail.com', 'Dr.udaya Kumara', '', 2, NULL, NULL, '2024-07-28 16:21:11');

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

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
