-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2024 at 08:04 AM
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
-- Database: `accessibility_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('general user','admin','developer') DEFAULT 'general user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `date_created`, `role`) VALUES
(7, 'admin', '', '$2y$10$iuPZNmLJ8F.frwFzq9yMFu/vdf4bZakDDfihPb0nwpSHXwmwiekka', '2024-09-16 02:48:49', 'admin'),
(132, 'john_doe', 'john.doe@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-09-26 16:00:00', 'general user'),
(133, 'jane_smith', 'jane.smith@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-10-10 16:00:00', 'general user'),
(135, 'emily_davis', 'emily.davis@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-11-07 16:00:00', 'general user'),
(137, 'sarah_wilson', 'sarah.wilson@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-12-05 16:00:00', 'general user'),
(138, 'muhammad_ali', 'muhammad.ali@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-12-19 16:00:00', 'general user'),
(139, 'li_wei', 'li.wei@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-01-02 16:00:00', 'general user'),
(140, 'ana_garcia', 'ana.garcia@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-01-16 16:00:00', 'general user'),
(141, 'vikram_patel', 'vikram.patel@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-01-30 16:00:00', 'general user'),
(142, 'olivia_brown', 'olivia.brown@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-02-13 16:00:00', 'general user'),
(143, 'daniel_miller', 'daniel.miller@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-02-27 16:00:00', 'general user'),
(144, 'nina_fernandez', 'nina.fernandez@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-03-12 16:00:00', 'general user'),
(145, 'kofi_mensah', 'kofi.mensah@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-03-26 16:00:00', 'general user'),
(146, 'sakura_tanaka', 'sakura.tanaka@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-04-09 16:00:00', 'general user'),
(147, 'ahmed_khan', 'ahmed.khan@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-04-23 16:00:00', 'general user'),
(148, 'yara_elias', 'yara.elias@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-05-07 16:00:00', 'general user'),
(149, 'kevin_nakamura', 'kevin.nakamura@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-05-21 16:00:00', 'general user'),
(150, 'maria_rosales', 'maria.rosales@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-06-04 16:00:00', 'general user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
