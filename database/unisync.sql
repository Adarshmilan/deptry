-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2025 at 09:31 PM
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
-- Database: `unisync`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `c_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `complaint_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`c_id`, `u_id`, `complaint_text`, `created_at`) VALUES
(1, 1, 'person A stole my money', '2025-09-25 13:00:10');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `request_id`, `sender_id`, `content`, `created_at`) VALUES
(1, 3, 1, 'hey', '2025-09-25 13:05:57'),
(2, 3, 2, 'hey', '2025-09-25 13:06:12'),
(3, 3, 2, 'hello om', '2025-09-25 13:19:47'),
(4, 3, 2, 'hello adrsh', '2025-09-25 13:19:54'),
(5, 3, 1, 'hello adarsh', '2025-09-25 13:20:20'),
(6, 3, 1, 'ommmmmmmmmmmmmmm', '2025-09-25 13:20:30'),
(7, 3, 2, 'hi', '2025-09-25 13:21:36'),
(8, 3, 2, 'hi', '2025-09-25 13:21:42'),
(9, 3, 2, 'hu', '2025-09-25 13:22:02'),
(10, 3, 1, 'hu', '2025-09-25 13:22:40'),
(11, 3, 2, 'hi', '2025-09-25 18:32:46'),
(12, 3, 2, 'om', '2025-09-25 18:37:49'),
(13, 3, 1, 'adarsh', '2025-09-25 18:38:47'),
(14, 3, 2, 'adarsh', '2025-09-25 18:39:55'),
(15, 3, 1, 'om', '2025-09-25 18:43:35'),
(16, 3, 2, 'adarsh', '2025-09-25 18:43:46'),
(17, 4, 1, 'om', '2025-09-25 18:45:44'),
(18, 5, 2, 'hi om', '2025-09-25 19:20:32'),
(19, 5, 1, 'hi adarsh', '2025-09-25 19:20:49');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` int(11) NOT NULL,
  `requester_id` int(11) NOT NULL,
  `deliverer_id` int(11) DEFAULT NULL,
  `item_description` text NOT NULL,
  `pickup_location` varchar(255) NOT NULL,
  `delivery_fee` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `requester_id`, `deliverer_id`, `item_description`, `pickup_location`, `delivery_fee`, `status`, `created_at`) VALUES
(1, 1, 2, 'lays magic masala', 'crystal mall', 30, 'completed', '2025-09-25 12:35:00'),
(2, 1, 2, 'coke ', 'crystal mall', 30, 'completed', '2025-09-25 12:51:23'),
(3, 2, 1, 'lays', 'crystal mall', 30, 'completed', '2025-09-25 12:55:43'),
(4, 1, 2, 'coke', 'crystal', 30, 'completed', '2025-09-25 18:44:45'),
(5, 1, 2, 'masala masti', 'crystal', 20, 'accepted', '2025-09-25 19:19:00'),
(6, 2, NULL, 'coke ', 'crystal mall', 30, 'pending', '2025-09-25 19:23:40');

-- --------------------------------------------------------

--
-- Table structure for table `suggestions`
--

CREATE TABLE `suggestions` (
  `s_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  `suggestion_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `suggestions`
--

INSERT INTO `suggestions` (`s_id`, `u_id`, `suggestion_text`, `created_at`) VALUES
(1, 1, 'you should add payment methods', '2025-09-25 12:59:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password_hash`, `created_at`) VALUES
(1, 'om', 'om.devmurari137287@marwadiuniversity.ac.in', '$2y$10$p3ePTACleMyluPqfm7yE9OHrYhQ36w2eZj5QrKWXZ4eKBRLA2cCcW', '2025-09-25 12:26:55'),
(2, 'adarsh', 'om.devmurari1372877@marwadiuniversity.ac.in', '$2y$10$TDQpcrjrg6pJd0YrB21KSebRmN.ud6GWafbvz/.o5xPGMrm/COpd.', '2025-09-25 12:27:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_id` (`request_id`),
  ADD KEY `sender_id` (`sender_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requester_id` (`requester_id`),
  ADD KEY `deliverer_id` (`deliverer_id`);

--
-- Indexes for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `u_id` (`u_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `suggestions`
--
ALTER TABLE `suggestions`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `messages`
--
ALTER TABLE `messages`
  ADD CONSTRAINT `messages_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `messages_ibfk_2` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`requester_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `requests_ibfk_2` FOREIGN KEY (`deliverer_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `suggestions`
--
ALTER TABLE `suggestions`
  ADD CONSTRAINT `suggestions_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
