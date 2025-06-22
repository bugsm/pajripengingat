-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2025 at 09:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pajri_reminder`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Kuliah'),
(3, 'Kerja'),
(5, 'Pribadi');

-- --------------------------------------------------------

--
-- Table structure for table `priorities`
--

CREATE TABLE `priorities` (
  `id` int NOT NULL,
  `level` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `priorities`
--

INSERT INTO `priorities` (`id`, `level`) VALUES
(1, 'Tinggi'),
(3, 'Sedang'),
(5, 'Rendah');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` int NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`) VALUES
(1, 'Belum Selesai'),
(3, 'Selesai');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL,
  `category_id` int DEFAULT NULL,
  `priority_id` int DEFAULT NULL,
  `status_id` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` text,
  `due_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `category_id`, `priority_id`, `status_id`, `title`, `description`, `due_date`, `created_at`) VALUES
(37, 1, 1, 1, 1, 'Tugas Pemweb teori', 'Detail tugas divclass pajri', '2025-06-13', '2025-06-12 09:52:48'),
(41, 1, 5, 3, 1, 'bermain roblox', 'bermain roblox bersama', '2025-06-13', '2025-06-12 10:07:33'),
(45, 7, 1, 3, 3, 'TAM ', 'teori\r\n', '2025-06-20', '2025-06-17 16:54:59'),
(47, 7, 1, 1, 1, 'teori', 'dsa', '2025-06-13', '2025-06-17 17:01:53'),
(49, 13, 1, 1, 1, 'dsad', 'dsadas', '2025-06-11', '2025-06-21 06:06:41'),
(52, 15, 3, 1, 1, 'wrg', 'wvgwre', '2025-06-19', '2025-06-22 07:06:04'),
(53, 26, 1, 1, 3, 'Tugas Pemweb', 'Mantap j', '2025-06-26', '2025-06-22 09:46:20');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`) VALUES
(1, 'Faadil', '$2y$10$CKEZlDfrWmqHGthVscC72OXGFkNT1nfe0RqEN.1uNQ9BNAH14QCRG', 'user'),
(3, 'pajri', '$2y$10$x/rr8X0ooLcM0zt0d0bxKeUAJz9rpxdogMqYrBSHv7TF0ZDk354B2', 'user'),
(7, '23170510', '$2y$10$h3.bzLWrsjJx6UTGmddUMeRgmUylIwvIBH3u.iajg0urQlUA0405G', 'user'),
(11, 'admin1', '$2y$10$koOJh8beS2nPxLCor2cbv.xtlweAiO5waldWkKiJN7EnMY8IW5e8W', 'admin'),
(13, 'Syahdam', '$2y$10$la42dGoFpa.g1O/XRWzWruCOjZOigal1M5wVLFdzwOjEd0ApSHcUS', 'user'),
(15, 'udin', '$2y$10$coY6Lea.ozRHiNoTJx4jTu62uCDk8M6s7Wj4Re846xghuxLcQWNam', 'admin'),
(17, 'allisya', '$2y$10$xADimvVe7aR0bLilHGcisuZQMVkMlLDfFUJrUU9mFQYz3T/v1XMvq', 'user'),
(26, 'user', '$2y$10$hxzKnGvFZsasl0tRc5EEeeV/zS6n9CSE7GfUEZsf1dQZfG0TJc1hu', 'user'),
(27, 'padil', '$2y$10$hPmXgISogHEYVfxp6wnlN.uVpP6T0WKfI4DstxRzkQnZXNAd/HqZ.', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `priorities`
--
ALTER TABLE `priorities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `category_id` (`category_id`),
  ADD KEY `priority_id` (`priority_id`),
  ADD KEY `status_id` (`status_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `priorities`
--
ALTER TABLE `priorities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `tasks_ibfk_2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `tasks_ibfk_3` FOREIGN KEY (`priority_id`) REFERENCES `priorities` (`id`),
  ADD CONSTRAINT `tasks_ibfk_4` FOREIGN KEY (`status_id`) REFERENCES `statuses` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
