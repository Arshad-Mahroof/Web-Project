-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 24, 2025 at 10:46 AM
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
-- Database: `lankan_organizers`
--

-- --------------------------------------------------------

--
-- Table structure for table `booked_packages`
--

CREATE TABLE `booked_packages` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `card_name` varchar(255) NOT NULL,
  `card_number` varchar(255) NOT NULL,
  `expiry` varchar(7) NOT NULL,
  `package_id` int(11) NOT NULL,
  `booking_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `booked_packages`
--

INSERT INTO `booked_packages` (`id`, `username`, `package_name`, `amount`, `card_name`, `card_number`, `expiry`, `package_id`, `booking_date`) VALUES
(3, 'user one', 'Ifthar', 1000000.00, 'user one', '************1234', '12/25', 10, '2025-05-31'),
(4, 'user two', 'Get Together', 2500000.00, 'Inamullah', '************3456', '12/25', 13, '2025-06-30');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `full_name` varchar(200) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(11) NOT NULL,
  `package_type` varchar(255) NOT NULL,
  `services` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `package_type`, `services`, `created_at`, `price`) VALUES
(10, 'Ifthar', '{\"chef\":\"320\",\"photographers\":\"322\",\"waiters\":[\"324\"],\"restaurants\":\"325\"}', '2025-05-31 15:09:28', 1000000.00),
(11, 'Wedding', '{\"chef\":\"320\",\"photographers\":\"322\",\"waiters\":[\"324\"],\"restaurants\":\"325\",\"djs\":\"321\",\"transport\":\"328\"}', '2025-05-31 15:10:30', 1500000.00),
(12, 'Parties', '{\"chef\":\"320\",\"photographers\":\"322\",\"waiters\":[\"324\"],\"restaurants\":\"325\"}', '2025-05-31 15:10:50', 2000000.00),
(13, 'Get Together', '{\"chef\":\"320\",\"photographers\":\"322\",\"waiters\":[\"324\"],\"restaurants\":\"325\",\"djs\":\"321\"}', '2025-05-31 15:11:13', 2500000.00),
(14, 'Event', '{\"chef\":\"320\",\"photographers\":\"322\",\"waiters\":[\"324\"],\"restaurants\":\"325\"}', '2025-05-31 15:11:36', 3000000.00),
(15, 'DJ Parties', '{\"chef\":\"320\",\"photographers\":\"322\",\"waiters\":[\"324\"],\"restaurants\":\"325\"}', '2025-05-31 15:12:22', 3500000.00),
(16, 'Ifthar', '{\"chef\":\"320\",\"photographers\":\"322\",\"waiters\":[\"324\"],\"restaurants\":\"325\"}', '2025-06-15 13:29:24', 99999999.99);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `provider_name` varchar(100) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `card_name` varchar(100) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `expiry` varchar(7) NOT NULL,
  `service_id` int(11) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `payment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `username`, `provider_name`, `service_name`, `amount`, `card_name`, `card_number`, `expiry`, `service_id`, `booking_date`, `payment_date`) VALUES
(11, 'user one', 'provider one', 'Makeup Artists', 15000.00, 'user one', '************1234', '12/25', 326, '2025-05-30', '2025-05-31 21:08:41');

-- --------------------------------------------------------

--
-- Table structure for table `pending_payments`
--

CREATE TABLE `pending_payments` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `provider_name` varchar(100) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `card_name` varchar(100) NOT NULL,
  `card_number` varchar(20) NOT NULL,
  `expiry` varchar(10) NOT NULL,
  `service_id` int(11) NOT NULL,
  `booking_date` date DEFAULT NULL,
  `request_date` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_services`
--

CREATE TABLE `pending_services` (
  `id` int(11) NOT NULL,
  `provider_name` varchar(100) DEFAULT NULL,
  `service_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `time_slot` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pending_users`
--

CREATE TABLE `pending_users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','service') NOT NULL,
  `photo` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `provider_name` varchar(100) DEFAULT NULL,
  `service_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `location` varchar(150) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `time_slot` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `provider_name`, `service_name`, `description`, `email`, `photo`, `location`, `price`, `time_slot`) VALUES
(320, 'provider one', 'Chef', 'A chef is a skilled culinary professional who prepares delicious meals, manages kitchen staff, designs menus, ensures food safety standards, and combines creativity with technique to craft flavourful dishes, delighting guests with every bite while maintaining efficiency, cleanliness, and consistency in a fast-paced kitchen environment to achieve exceptional dining experiences.', 'provider1@gmail.com', 'uploads/1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', 'Kandy', 15000.00, 'Full Time'),
(321, 'provider one', 'DJs', 'A DJ is a music expert who selects, mixes, and plays tracks to entertain audiences at events, parties, and clubs, using turntables or digital equipment, reading the crowd\'s energy, creating smooth transitions, and setting the perfect atmosphere with beats, lights, and sound to ensure a memorable and lively experience.\r\n', 'provider1@gmail.com', 'uploads/1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', 'Matale', 15000.00, 'Full Time'),
(322, 'provider one', 'Photographers', 'A photographer is a creative professional who captures moments through a camera, using lighting, composition, and editing techniques to produce visually appealing images for events, portraits, or commercial purposes, preserving memories and telling stories, while working closely with clients to meet their vision and deliver high-quality, meaningful photographic results.\r\n', 'provider1@gmail.com', 'uploads/1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', 'Nuwara Eliya', 15000.00, 'Full Time'),
(323, 'provider one', 'Decorators', 'Decorators are creative professionals who design and enhance event spaces using themes, colors, lighting, and decorative elements to create visually stunning environments, transforming ordinary venues into memorable settings for weddings, parties, and special occasions, while coordinating with clients to reflect their vision and ensuring every detail is beautifully executed.\r\n', 'provider1@gmail.com', 'uploads/1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', 'Ampara', 15000.00, 'Full Time'),
(324, 'provider one', 'Waiters', 'Waiters are hospitality professionals who serve food and beverages to customers, take orders accurately, ensure guest satisfaction, maintain cleanliness, and provide prompt, courteous service in restaurants or events, playing a key role in creating a pleasant dining experience through effective communication, attention to detail, and a friendly, professional attitude.\r\n', 'provider1@gmail.com', 'uploads/1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', 'Batticaloa', 15000.00, 'Full Time'),
(325, 'provider one', 'Restaurants', 'Restaurants are dining establishments that offer a variety of food and beverages prepared by skilled chefs, providing customers with a comfortable atmosphere, excellent service, and delicious meals, catering to diverse tastes and occasions while focusing on quality, hygiene, ambiance, and memorable culinary experiences for guests.\r\n', 'provider1@gmail.com', 'uploads/1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', 'Mullaitivu', 15000.00, 'Full Time'),
(326, 'provider one', 'Makeup Artists', 'A makeup artist is a skilled professional who enhances or transforms a person’s appearance using cosmetic products, working for events, photoshoots, weddings, or film productions, with expertise in skin tones, facial features, and makeup techniques, while collaborating with clients to achieve desired looks and boost their confidence and beauty.\r\n', 'provider1@gmail.com', 'uploads/1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', 'Trincomalee', 15000.00, 'Full Time'),
(327, 'provider one', 'Mehandi Artists', 'A mehndi artist is a talented professional who creates intricate and beautiful designs using henna paste on hands and feet, especially for weddings, festivals, and special occasions, combining traditional and modern patterns with precision and creativity to enhance beauty, celebrate culture, and provide a memorable, artistic experience for clients.\r\n', 'provider1@gmail.com', 'uploads/1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', 'Jaffna', 15000.00, 'Full Time'),
(328, 'provider one', 'Transport', 'Transport services provide the movement of people or goods from one location to another using various vehicles like cars, vans, or trucks, ensuring timely, safe, and efficient travel or delivery for events or daily needs, while focusing on reliability, comfort, coordination, and customer satisfaction for a smooth experience.\r\n', 'provider1@gmail.com', 'uploads/1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', 'Kilinochchi', 15000.00, 'Full Time'),
(330, 'provider one', 'Cleaning Services', 'Cleaning workers are dedicated professionals who maintain cleanliness and hygiene in homes, offices, or event venues by sweeping, mopping, dusting, and sanitizing surfaces, ensuring a safe and pleasant environment, working efficiently and thoroughly to support health standards and enhance the overall appearance and comfort of any space.\r\n', 'provider1@gmail.com', 'uploads/1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', 'Kurunegala', 15000.00, 'Full Time');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `role` enum('admin','service','user') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `photo` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_code` int(11) DEFAULT NULL,
  `code_expires` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `photo`, `created_at`, `reset_code`, `code_expires`) VALUES
(19, 'Arshad Mahroof', 'arshadmahroof267@gmail.com', '$2y$10$r0CbHIJQxwylF2ppqmI5Be/L24b3d1ri1RXw0FbI2JzowKTKf2Xjm', 'admin', 'uploads/1748702087_Picture1.jpg', '2025-05-31 14:34:47', NULL, NULL),
(20, 'user one', 'user1@gmail.com', '$2y$10$cXl2N00ea7vQTGD3ebfBq.1tYavRux0QirPwpz5ZeQyGIGZkwRq12', 'user', 'uploads/1748702468_hd-man-user-illustration-icon-transparent-png-701751694974843ybexneueic.png', '2025-05-31 14:41:08', NULL, NULL),
(21, 'provider one', 'provider1@gmail.com', '$2y$10$4jmPWAaIjpzIX9SgnSlwl.ID3FN0EvPsuEkwyuxhDZXveRpKbvhhi', 'service', 'uploads/1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', '2025-05-31 14:45:27', NULL, NULL),
(22, 'provider two', 'provider2@gmail.com', '$2y$10$OH64hmK8aXNUCt/Hnrmmh.3qZjyFYCSmuNiQsx/0mXlJBpEnuQ05a', 'service', 'uploads/1748704940_1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', '2025-05-31 15:25:39', NULL, NULL),
(23, 'user two', 'user2@gmail.com', '$2y$10$0jgXCOHRtDoR1/BpM5xWyeta/vyopQV8VgVJT5.lwgZcsX/PIa266', 'user', 'uploads/1749986219_1748702468_hd-man-user-illustration-icon-transparent-png-701751694974843ybexneueic.png', '2025-06-15 11:16:59', NULL, NULL),
(24, 'provider three', 'provider3@gmail.com', '$2y$10$0qxh6o0pEQopsj8DPXHA0Os.y4ndP5jYY3EwFS.3ChO0I9zkoOUGK', 'service', 'uploads/1749991343_1748702643_depositphotos_237795804-stock-illustration-unknown-person-silhouette-profile-picture.jpg', '2025-06-15 12:52:03', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booked_packages`
--
ALTER TABLE `booked_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_payments`
--
ALTER TABLE `pending_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_services`
--
ALTER TABLE `pending_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pending_users`
--
ALTER TABLE `pending_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_idx` (`email`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `email_idx` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booked_packages`
--
ALTER TABLE `booked_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `pending_payments`
--
ALTER TABLE `pending_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pending_services`
--
ALTER TABLE `pending_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `pending_users`
--
ALTER TABLE `pending_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=331;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
