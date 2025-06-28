-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2025 at 05:43 PM
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
-- Database: `newhospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `reason` text NOT NULL,
  `status` enum('pending','confirmed','cancelled') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `user_id`, `doctor_id`, `appointment_date`, `appointment_time`, `reason`, `status`, `created_at`) VALUES
(29, 1, 1, '2025-02-20', '02:00:00', 'fever', 'pending', '2025-01-21 21:43:26'),
(30, 1, 1, '2025-01-22', '21:29:00', 'Stomach Pain', 'pending', '2025-01-21 21:45:38'),
(31, 1, 1, '2025-01-22', '21:29:00', 'Headache', 'pending', '2025-01-21 21:45:53'),
(32, 1, 7, '2025-02-20', '02:00:00', 'fever', 'pending', '2025-02-04 22:26:02');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `specialization` varchar(100) NOT NULL,
  `qualifications` text NOT NULL,
  `experience_years` int(10) UNSIGNED NOT NULL,
  `hospital_branch` enum('Kandy','Colombo','Kurunegala') NOT NULL,
  `available_days` varchar(50) NOT NULL,
  `available_time` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `full_name`, `email`, `phone_number`, `specialization`, `qualifications`, `experience_years`, `hospital_branch`, `available_days`, `available_time`, `created_at`) VALUES
(1, 'Dr. John Smith', 'johnsmith@carecompass.com', '+94711234567', 'Cardiology', 'MBBS, MD (Cardiology)', 10, 'Colombo', 'Mon-Fri', '09:00 AM - 03:00 PM', '2025-01-21 18:34:38'),
(2, 'Dr. Sarah Lee', 'sarahlee@carecompass.com', '+94716543210', 'Neurology', 'MBBS, DM (Neurology)', 8, 'Kandy', 'Tue-Sat', '10:00 AM - 04:00 PM', '2025-01-21 18:34:38'),
(3, 'Dr. Ahmed Khan', 'ahmedkhan@carecompass.com', '+94712345678', 'Pediatrics', 'MBBS, DCH', 12, 'Kurunegala', 'Mon-Wed', '08:00 AM - 02:00 PM', '2025-01-21 18:34:38'),
(4, 'Dr. Mandika Wijeratne', 'Wijeratne@Gmail.com', '071234567', 'Cardiology', 'MBBS, MD (Cardiology)', 15, 'Kandy', 'Monday to Friday', '8:00 AM - 4:00 PM', '2025-02-04 20:55:51'),
(5, 'Dr. Shanika Abeysekara', 'shanika.abey@yahoo.com', '0707891234', 'Gynecology', 'MBBS, MD (Obstetrics & Gynecology)', 10, 'Kurunegala', 'Monday to Thursday', '9:00 AM - 3:00 PM', '2025-02-04 21:05:47'),
(6, 'Dr. Roshan Alwis', 'roshan.alwis@gmail.com', '0753217896', 'Orthopedics', 'MBBS, MS (Orthopedics), DNB (Ortho), FRCS', 17, 'Colombo', 'Monday to Friday', '8:00 AM - 4:00 PM', '2025-02-04 21:05:47'),
(7, 'Dr. Kasun Jayasooriya', 'kasun.jayasooriya@outlook.com', '0776543210', 'Dermatology', 'MBBS, MD (Dermatology), DDVL, FCPS', 14, 'Kandy', 'Tuesday to Saturday', '9:30 AM - 5:30 PM', '2025-02-04 21:05:47'),
(8, 'Dr. Dinesh Ratnayake', 'dinesh.ratnayake@gmail.com', '0789456123', 'General Surgery', 'MBBS, MS (Surgery), FRCS, DNB (Surgery)', 22, 'Kurunegala', 'Monday to Friday', '10:00 AM - 6:00 PM', '2025-02-04 21:05:47'),
(9, 'Dr. Janaka Ekanayake', 'janaka.ekanayake@yahoo.com', '0765124789', 'Oncology', 'MBBS, MD (Oncology), DM (Oncology), DNB (Oncology)', 19, 'Colombo', 'Monday to Wednesday', '8:00 AM - 2:00 PM', '2025-02-04 21:05:47'),
(10, 'Dr. Vishaka Weerasinghe', 'vishaka.weerasinghe@gmail.com', '0713579842', 'Radiology', 'MBBS, MD (Radiology), DNB (Radiology), FRCR', 11, 'Kandy', 'Thursday to Saturday', '10:30 AM - 5:30 PM', '2025-02-04 21:05:47'),
(11, 'Dr. Lahiru Senanayake', 'lahiru.sena@outlook.com', '0741236987', 'Psychiatry', 'MBBS, MD (Psychiatry), DPM, MRCPsych', 16, 'Colombo', 'Monday to Friday', '9:00 AM - 5:00 PM', '2025-02-04 21:05:47'),
(12, 'Dr. Malith Peris', 'malith.peris@gmail.com', '0704569873', 'Endocrinology', 'MBBS, MD (Internal Medicine), DM (Endocrinology), FACE', 13, 'Colombo', 'Tuesday to Saturday', '8:30 AM - 4:30 PM', '2025-02-04 21:05:47'),
(13, 'Dr. Shehan Fernando', 'shehan.fernando@yahoo.com', '0756987412', 'Hematology', 'MBBS, MD (Pathology/Hematology), DM (Hematology), FRCP', 18, 'Colombo', 'Monday to Thursday', '9:00 AM - 3:30 PM', '2025-02-04 21:05:47'),
(14, 'Dr. Nimali Wijesekara', 'nimali.wijesekara@gmail.com', '0779845132', 'Nephrology', 'MBBS, MD (Medicine), DM (Nephrology), DNB (Nephrology)', 20, 'Kandy', 'Monday to Friday', '10:00 AM - 6:00 PM', '2025-02-04 21:05:47'),
(15, 'Dr. Suraj Abeykoon', 'suraj.abeykoon@gmail.com', '0712365478', 'Rheumatology', 'MBBS, MD (Medicine), DM (Rheumatology), FRCP', 15, 'Kandy', 'Monday to Friday', '8:00 AM - 4:00 PM', '2025-02-04 21:05:47'),
(16, 'Dr. Lasantha Rajapaksha', 'lasantha.rajapaksha@gmail.com', '0715689741', 'Urology', 'MBBS, MS (Surgery), MCh (Urology), DNB (Urology)', 14, 'Colombo', 'Monday to Saturday', '9:00 AM - 5:00 PM', '2025-02-04 21:05:47'),
(17, 'Dr. Priyanka Fernando', 'priyanka.fernando@gmail.com', '0779568472', 'Gastroenterology', 'MBBS, MD (Gastroenterology), DM (Gastro), DNB', 19, 'Kandy', 'Monday to Friday', '10:00 AM - 6:00 PM', '2025-02-04 21:05:47'),
(18, 'Dr. Chandana Karunaratne', 'chandana.karunaratne@yahoo.com', '0758473621', 'Pulmonology', 'MBBS, MD (Pulmonology), DM (Respiratory Medicine), DTCD', 21, 'Colombo', 'Monday to Friday', '9:00 AM - 5:00 PM', '2025-02-04 21:05:47'),
(19, 'Dr. Dineth Weerakkody', 'dineth.weerakkody@gmail.com', '0708547123', 'Cardiothoracic Surgery', 'MBBS, MS (CT Surgery), MCh (CT Surgery), FRCS', 23, 'Colombo', 'Monday to Thursday', '8:00 AM - 2:00 PM', '2025-02-04 21:05:47'),
(20, 'Dr. Ishara Samarakoon', 'ishara.samarakoon@gmail.com', '0741256879', 'Plastic Surgery', 'MBBS, MS (Surgery), MCh (Plastic Surgery), DNB', 17, 'Kandy', 'Monday to Saturday', '9:00 AM - 5:00 PM', '2025-02-04 21:05:47'),
(21, 'Dr. Anura Perera', 'anura.perera@gmail.com', '0711234567', 'Cardiology', 'MBBS, MD (Cardiology), FRCP, FACC', 18, 'Colombo', 'Monday to Friday', '9:00 AM - 5:00 PM', '2025-02-04 21:05:47'),
(22, 'Dr. Nimal Fernando', 'nimal.fernando@yahoo.com', '0719876543', 'Pediatrics', 'MBBS, MD (Pediatrics), DCH, MRCPCH', 12, 'Colombo', 'Tuesday to Saturday', '10:00 AM - 6:00 PM', '2025-02-04 21:05:47'),
(23, 'Dr. Samantha Jayawardena', 'samantha.jaya@outlook.com', '0765432198', 'Neurology', 'MBBS, MD (Neurology), DM (Neurology), FRCP', 20, 'Kandy', 'Monday to Friday', '8:30 AM - 4:30 PM', '2025-02-04 21:05:47'),
(24, 'Dr. Tharindu Madushanka', 'tharindu.madushanka@outlook.com', '0752365412', 'Obstetrics & Gynecology', 'MBBS, MD (Obstetrics & Gynecology), FRCOG', 11, 'Colombo', 'Monday to Saturday', '8:00 AM - 3:00 PM', '2025-02-04 21:18:54'),
(25, 'Dr. Umesh Kularatne', 'umesh.kularatne@gmail.com', '0701234587', 'Gastroenterology', 'MBBS, MD (Gastroenterology), DM (Gastroenterology)', 20, 'Kandy', 'Tuesday to Friday', '8:30 AM - 4:30 PM', '2025-02-04 21:18:54'),
(26, 'Dr. Haritha Siriwardana', 'haritha.siriwardana@yahoo.com', '0789876543', 'Pediatrics', 'MBBS, MD (Pediatrics), MRCPCH', 15, 'Kandy', 'Monday to Friday', '9:00 AM - 5:00 PM', '2025-02-04 21:18:54'),
(27, 'Dr. Nethmi Premarathna', 'nethmi.premarathna@gmail.com', '0712459876', 'Orthopedics', 'MBBS, MS (Orthopedics), FRCS', 13, 'Colombo', 'Monday to Thursday', '9:00 AM - 4:00 PM', '2025-02-04 21:18:54'),
(28, 'Dr. Aruni Rajapaksha', 'aruni.rajapaksha@gmail.com', '0705643879', 'Cardiology', 'MBBS, MD (Cardiology), DNB (Cardiology)', 18, 'Colombo', 'Tuesday to Saturday', '9:00 AM - 5:00 PM', '2025-02-04 21:18:54'),
(29, 'Dr. Ruwan Kanchana', 'ruwan.kanchana@gmail.com', '0771235678', 'Urology', 'MBBS, MS (Urology), MCh (Urology)', 14, 'Kandy', 'Monday to Friday', '8:00 AM - 4:00 PM', '2025-02-04 21:18:54'),
(30, 'Dr. Chaminda Kulasekara', 'chaminda.kulasekara@yahoo.com', '0765432156', 'Rheumatology', 'MBBS, MD (Rheumatology), FRCP', 16, 'Colombo', 'Monday to Friday', '9:00 AM - 6:00 PM', '2025-02-04 21:18:54'),
(31, 'Dr. Dinithi Perera', 'dinithi.perera@gmail.com', '0746891230', 'Endocrinology', 'MBBS, MD (Endocrinology), DNB (Endocrinology)', 14, 'Kurunegala', 'Monday to Friday', '8:00 AM - 4:00 PM', '2025-02-04 21:18:54'),
(32, 'Dr. Indika Perera', 'indika.perera@gmail.com', '0751238970', 'Neurology', 'MBBS, MD (Neurology), DNB (Neurology)', 17, 'Kandy', 'Monday to Thursday', '9:00 AM - 5:00 PM', '2025-02-04 21:18:54'),
(33, 'Dr. Avishka Tharanga', 'avishka.tharanga@yahoo.com', '0767896542', 'Plastic Surgery', 'MBBS, MS (Surgery), MCh (Plastic Surgery)', 12, 'Colombo', 'Tuesday to Friday', '10:00 AM - 4:00 PM', '2025-02-04 21:18:54'),
(34, 'Dr. Sanjeewa Fernando', 'sanjeewa.fernando@gmail.com', '0714526789', 'General Surgery', 'MBBS, MS (General Surgery), FRCS', 19, 'Kandy', 'Monday to Saturday', '9:00 AM - 6:00 PM', '2025-02-04 21:18:54'),
(35, 'Dr. Lilantha Peris', 'lilantha.peris@gmail.com', '0706879654', 'Orthopedics', 'MBBS, MS (Orthopedics), FRCS', 13, 'Kandy', 'Monday to Friday', '8:30 AM - 4:30 PM', '2025-02-04 21:18:54'),
(36, 'Dr. Dilhara Manjula', 'dilhara.manjula@outlook.com', '0789158762', 'Oncology', 'MBBS, MD (Oncology), DM (Oncology)', 21, 'Colombo', 'Monday to Friday', '9:00 AM - 5:00 PM', '2025-02-04 21:18:54'),
(37, 'Dr. Madhurani Kumari', 'madhurani.kumari@gmail.com', '0709876543', 'Psychiatry', 'MBBS, MD (Psychiatry), MRCPsych', 12, 'Colombo', 'Tuesday to Saturday', '10:00 AM - 5:00 PM', '2025-02-04 21:18:54'),
(38, 'Dr. Sarath Weerasinghe', 'sarath.weerasinghe@gmail.com', '0751234569', 'Pediatrics', 'MBBS, MD (Pediatrics), DCH', 18, 'Kandy', 'Monday to Friday', '9:00 AM - 6:00 PM', '2025-02-04 21:18:54'),
(39, 'Dr. Jayantha Wickramaratne', 'jayantha.wickramaratne@outlook.com', '0712465897', 'Gastroenterology', 'MBBS, MD (Gastroenterology), DM (Gastro)', 15, 'Colombo', 'Monday to Friday', '10:00 AM - 4:00 PM', '2025-02-04 21:18:54'),
(40, 'Dr. Piumi Rathnayake', 'piumi.rathnayake@gmail.com', '0701234789', 'Ophthalmology', 'MBBS, MS (Ophthalmology)', 12, 'Kurunegala', 'Tuesday to Friday', '9:00 AM - 4:00 PM', '2025-02-04 21:18:54'),
(41, 'Dr. Shaminda Hewa', 'shaminda.hewa@gmail.com', '0761239876', 'Endocrinology', 'MBBS, MD (Endocrinology), DM (Endocrinology)', 14, 'Colombo', 'Monday to Saturday', '9:00 AM - 5:00 PM', '2025-02-04 21:18:54'),
(42, 'Dr. Kanchana Pradeep', 'kanchana.pradeep@gmail.com', '0717896543', 'Rheumatology', 'MBBS, MD (Rheumatology), DNB (Rheumatology)', 16, 'Kandy', 'Monday to Friday', '8:30 AM - 4:30 PM', '2025-02-04 21:18:54'),
(43, 'Dr. Venura Silva', 'venura.silva@gmail.com', '0779638520', 'Hematology', 'MBBS, MD (Hematology), DNB (Hematology)', 15, 'Kandy', 'Monday to Saturday', '9:00 AM - 6:00 PM', '2025-02-04 21:18:54'),
(44, 'Dr. Ruwani Hettiarachchi', 'ruwani.hettiarachchi@gmail.com', '0764321987', 'Neurology', 'MBBS, MD (Neurology), DM (Neurology)', 20, 'Colombo', 'Monday to Friday', '9:00 AM - 5:00 PM', '2025-02-04 21:18:54'),
(45, 'Dr. Yasitha Tharindu', 'yasitha.tharindu@yahoo.com', '0719874321', 'Dermatology', 'MBBS, MD (Dermatology), DDVL', 18, 'Colombo', 'Monday to Friday', '10:00 AM - 5:00 PM', '2025-02-04 21:18:54'),
(46, 'Dr. Anjalika Amarasinghe', 'anjalika.amarasinghe@gmail.com', '0701234890', 'Urology', 'MBBS, MS (Urology), MCh (Urology)', 17, 'Colombo', 'Monday to Friday', '8:00 AM - 4:00 PM', '2025-02-04 21:18:54'),
(47, 'Dr. Tharuka Jayasinghe', 'tharuka.jayasinghe@outlook.com', '0765348762', 'Plastic Surgery', 'MBBS, MS (Plastic Surgery), MCh (Plastic Surgery)', 13, 'Kandy', 'Monday to Saturday', '9:00 AM - 5:00 PM', '2025-02-04 21:18:54'),
(48, 'Dr. Sanjeevani Nilanthi', 'sanjeevani.nilanthi@gmail.com', '0746587412', 'Oncology', 'MBBS, MD (Oncology), DM (Oncology)', 19, 'Kurunegala', 'Monday to Friday', '9:00 AM - 5:00 PM', '2025-02-04 21:18:54'),
(49, 'Dr. Kusal Maduranga', 'kusal.maduranga@gmail.com', '0758462143', 'General Surgery', 'MBBS, MS (Surgery), FRCS', 20, 'Colombo', 'Monday to Friday', '8:00 AM - 4:00 PM', '2025-02-04 21:18:54'),
(50, 'Dr. Thushan Perera', 'thushan.perera@gmail.com', '0765432189', 'Cardiology', 'MBBS, MD (Cardiology), DNB (Cardiology)', 22, 'Kandy', 'Monday to Thursday', '9:00 AM - 5:00 PM', '2025-02-04 21:18:54');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks`
--

CREATE TABLE `feedbacks` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `branch` enum('Kandy','Colombo','Kurunegala') NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` text NOT NULL,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `contact` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_method` text NOT NULL,
  `status` enum('pending','confirmed','cancelled') NOT NULL,
  `paid_time` text NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `user_id`, `name`, `email`, `contact`, `amount`, `payment_method`, `status`, `paid_time`) VALUES
(1, '1', 'Arshad', 'arshadmahroof267@gmail.com', 772048768, 1000, 'debit-card', 'pending', '2025-02-05 10:19:12');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` enum('service','lab') NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `type`, `description`) VALUES
(1, 'General Medicine', 'service', 'Our experienced physicians provide comprehensive medical care for all age groups, focusing on preventive care and overall well-being.'),
(2, 'Pediatrics', 'service', 'We offer specialized care for infants, children, and adolescents, ensuring their health and development are closely monitored.'),
(3, 'Emergency Services', 'lab', 'Our 24/7 emergency department is equipped to handle critical medical situations promptly and efficiently.'),
(4, 'Diagnostic and Laboratory Services', 'lab', 'State-of-the-art diagnostic facilities for accurate tests and timely reports, aiding in effective treatment plans.'),
(5, 'Surgical Services', 'lab', 'Our skilled surgeons perform a wide range of procedures, from minor operations to complex surgeries, with advanced technology.\r\n\r\n'),
(6, 'Telemedicine Services', 'service', 'Our Telemedicine Services offer secure online consultations with expert doctors for convenient medical advice and follow-up care at home.'),
(7, 'Mental Health & Counseling', 'service', 'We provide confidential psychological assessments, therapy, and support to help manage stress, anxiety, and emotional challenges.'),
(8, 'Health Screening Packages', 'service', 'Our Health Screening Packages offer complete check-ups, including blood tests, cancer screenings, and wellness assessments for early detection and proactive health care.');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `user_role` enum('admin','doctor') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `pwd`, `user_role`) VALUES
(1, 'Admin', '1122', 'admin'),
(2, 'Doctor', '1212', 'doctor');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `pwd` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `pwd`, `email`, `phone`, `address`) VALUES
(1, 'Arshad', '1234', 'arshadmahroof267@gmail.com', '0772048768', 'Kandy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `feedbacks`
--
ALTER TABLE `feedbacks`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `feedbacks`
--
ALTER TABLE `feedbacks`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
