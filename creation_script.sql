-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 29, 2024 at 01:31 PM
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
CREATE DATABASE IF NOT EXISTS `accessibility_project` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `accessibility_project`;

-- --------------------------------------------------------

--
-- Table structure for table `accessibility_issues`
--

CREATE TABLE `accessibility_issues` (
  `issue_id` int(11) NOT NULL,
  `issue_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `accessibility_issues`
--

INSERT INTO `accessibility_issues` (`issue_id`, `issue_name`, `description`) VALUES
(1, 'Visual Impairment', 'Difficulties with vision, including blindness and low vision.'),
(2, 'Hearing Impairment', 'Challenges with hearing, including deafness and hearing loss.'),
(3, 'Mobility Impairment', 'Physical disabilities that affect movement, including the use of wheelchairs.'),
(4, 'Cognitive Impairment', 'Mental health conditions or learning disabilities affecting memory, attention, or understanding.'),
(5, 'Color Blindness', 'Inability to distinguish between certain colors, such as red and green.'),
(6, 'Speech Impairment', 'Difficulties with speech and communication.'),
(7, 'Photosensitivity', 'Sensitivity to flashing lights or patterns, which can trigger seizures or other symptoms.'),
(8, 'Motor Impairment', 'Difficulty with fine motor skills, affecting the ability to use a mouse or keyboard.'),
(9, 'Reading Difficulty', 'Challenges with reading due to dyslexia or other conditions.'),
(10, 'Severe Arthritis', 'Joint pain and stiffness that can make navigation difficult.');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prompt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `rating` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `name`, `email`, `message`, `created_at`, `rating`) VALUES
(1, 132, 'John Doe', 'john.doe@example.com', 'Great website! The accessibility features are really helpful.', '2024-09-27 03:33:16', NULL),
(2, 133, 'Jane Smith', 'jane.smith@example.com', 'I found the color contrast advice very useful. Keep up the good work!', '2024-09-27 03:33:16', 5),
(3, 134, 'Michael Johnson', 'michael.johnson@example.com', 'The prompts for alt text generation are excellent. Thank you!', '2024-09-27 03:33:16', 5),
(4, 135, 'Emily Davis', 'emily.davis@example.com', 'I had some issues with the font size options. They could be more flexible.', '2024-09-27 03:33:16', 3),
(5, 136, 'David Lee', 'david.lee@example.com', 'The site is easy to navigate, but I would love to see more resources for cognitive impairments.', '2024-09-27 03:33:16', 5),
(6, 137, 'Sarah Wilson', 'sarah.wilson@example.com', 'The ability to bookmark prompts is very convenient.', '2024-09-27 03:33:16', 4),
(7, 138, 'Muhammad Ali', 'muhammad.ali@example.com', 'Good selection of accessibility tools, but the load time could be improved.', '2024-09-27 03:33:16', 4),
(8, 139, 'Li Wei', 'li.wei@example.com', 'I appreciate the effort put into making the site accessible for everyone.', '2024-09-27 03:33:16', 5),
(9, 140, 'Ana Garcia', 'ana.garcia@example.com', 'The contact form works well, but I would suggest adding a captcha to prevent spam.', '2024-09-27 03:33:16', 5),
(10, 141, 'Vikram Patel', 'vikram.patel@example.com', 'The website has been very helpful in my studies. Thank you!', '2024-09-27 03:33:16', 4),
(11, 142, 'Olivia Brown', 'olivia.brown@example.com', 'I love the clear layout and easy-to-find information.', '2024-09-27 03:33:16', 3),
(12, 143, 'Daniel Miller', 'daniel.miller@example.com', 'The feedback section could use more features, such as the ability to upload files.', '2024-09-27 03:33:16', NULL),
(13, 152, 'fnjkanknf', 'enqfbwkjfb@fiwnon.com', 'fnjk', '2024-09-29 04:59:38', NULL),
(15, 154, 'adl', 'adler@iinet.net.au', 'ji', '2024-09-29 05:13:38', 4),
(16, 154, 'adl', 'adler@iinet.net.au', 'testing', '2024-09-29 05:23:59', 5),
(17, 7, 'admin', '', 'njhboubvgv', '2024-09-29 08:39:23', 3),
(18, 7, 'admin', '', 'njhboubvgv', '2024-09-29 08:39:28', 2),
(19, 7, 'admin', '', 'njhboubvgvhjvjhv kh', '2024-09-29 08:41:10', 3),
(20, 155, 'adlern222', 'madlerr1@gmail.commmm', 'hibfiubp', '2024-09-29 08:42:21', 4),
(21, 7, 'admin', '', 'hyubuo', '2024-09-29 08:45:07', 5),
(22, 7, 'admin', '', 'hyubuo', '2024-09-29 08:47:23', 3);

-- --------------------------------------------------------

--
-- Table structure for table `prompts`
--

CREATE TABLE `prompts` (
  `id` int(11) NOT NULL,
  `problem` varchar(255) DEFAULT NULL,
  `prompt_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prompts`
--

INSERT INTO `prompts` (`id`, `problem`, `prompt_text`) VALUES
(1, 'Images without text alternatives', 'Describe an image of a person using a laptop in a park. The description should be detailed and cover the surroundings as well.'),
(2, 'Videos without captions', 'Generate detailed captions for a video where a professor explains the basics of quantum physics in a classroom setting.'),
(3, 'Insufficient color contrast', 'Suggest a color scheme for a website that ensures a contrast ratio of at least 4.5:1 for text against its background. Provide specific color codes for both text and background.');

-- --------------------------------------------------------

--
-- Table structure for table `recommendations`
--

CREATE TABLE `recommendations` (
  `recommendation_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `tag_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `date_created`, `role`) VALUES
(7, 'admin', '', '$2y$10$iuPZNmLJ8F.frwFzq9yMFu/vdf4bZakDDfihPb0nwpSHXwmwiekka', '2024-09-16 02:48:49', 'admin'),
(132, 'john_doe', 'john.doe@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-09-26 16:00:00', 'user'),
(133, 'jane_smith', 'jane.smith@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-10-10 16:00:00', 'user'),
(134, 'michael_johnson', 'michael.johnson@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-10-24 16:00:00', 'user'),
(135, 'emily_davis', 'emily.davis@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-11-07 16:00:00', 'user'),
(136, 'david_lee', 'david.lee@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-11-21 16:00:00', 'user'),
(137, 'sarah_wilson', 'sarah.wilson@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-12-05 16:00:00', 'user'),
(138, 'muhammad_ali', 'muhammad.ali@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2023-12-19 16:00:00', 'user'),
(139, 'li_wei', 'li.wei@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-01-02 16:00:00', 'user'),
(140, 'ana_garcia', 'ana.garcia@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-01-16 16:00:00', 'user'),
(141, 'vikram_patel', 'vikram.patel@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-01-30 16:00:00', 'user'),
(142, 'olivia_brown', 'olivia.brown@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-02-13 16:00:00', 'user'),
(143, 'daniel_miller', 'daniel.miller@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-02-27 16:00:00', 'user'),
(144, 'nina_fernandez', 'nina.fernandez@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-03-12 16:00:00', 'user'),
(145, 'kofi_mensah', 'kofi.mensah@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-03-26 16:00:00', 'user'),
(146, 'sakura_tanaka', 'sakura.tanaka@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-04-09 16:00:00', 'user'),
(147, 'ahmed_khan', 'ahmed.khan@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-04-23 16:00:00', 'user'),
(148, 'yara_elias', 'yara.elias@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-05-07 16:00:00', 'user'),
(149, 'kevin_nakamura', 'kevin.nakamura@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-05-21 16:00:00', 'user'),
(150, 'maria_rosales', 'maria.rosales@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-06-04 16:00:00', 'user'),
(151, 'peter_schmidt', 'peter.schmidt@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-06-18 16:00:00', 'user'),
(152, 'adler', 'madlerr1@gmail.com', '$2y$10$cV/8JuxBXYh/XJI.VvjKCOnVxq.z09fHI13H.vd7OxgXhxM0uwwkS', '2024-09-29 04:58:02', 'user'),
(153, 'adlern22', 'madlerr1@gmail.co', '$2y$10$8yBgydmHyznnmrxx.vg25eSjpMWyUMhzMwlNxty7otGEUrh7LP82C', '2024-09-29 05:01:10', 'user'),
(154, 'adl', 'adler@iinet.net.au', '$2y$10$gtyOMgOGJgpIYZUxBifV/uQCz5eBSFjB/qa7cPoPEKidU//D9FqhK', '2024-09-29 05:02:33', 'user'),
(155, 'adlern222', 'madlerr1@gmail.commmm', '$2y$10$H436KcOqAlbPAslbnbdLqOIEDg9ho0iy7epKj9cWoYsmCen1gNDa2', '2024-09-29 08:42:04', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `user_accessibility`
--

CREATE TABLE `user_accessibility` (
  `user_accessibility_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `issue_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_accessibility`
--

INSERT INTO `user_accessibility` (`user_accessibility_id`, `user_id`, `issue_id`) VALUES
(82, 132, 1),
(83, 132, 5),
(84, 133, 2),
(85, 133, 4),
(86, 134, 3),
(87, 135, 1),
(88, 135, 7),
(89, 136, 5),
(90, 136, 9),
(91, 136, 6),
(92, 137, 10),
(93, 137, 8),
(94, 138, 2),
(95, 139, 3),
(96, 139, 4),
(97, 139, 7),
(98, 140, 1),
(99, 140, 8),
(100, 141, 6),
(101, 141, 9),
(102, 142, 10),
(103, 142, 2),
(104, 142, 4),
(105, 142, 5),
(106, 143, 3),
(107, 144, 7),
(108, 144, 9),
(109, 144, 10),
(110, 145, 1),
(111, 145, 3),
(112, 146, 5),
(113, 147, 8),
(114, 147, 9),
(115, 148, 2),
(116, 148, 4),
(117, 148, 6),
(118, 148, 7),
(119, 149, 10),
(120, 149, 1),
(121, 150, 3),
(122, 150, 8),
(123, 151, 6),
(124, 151, 9),
(125, 152, 5),
(126, 152, 7),
(127, 153, 5),
(128, 154, 7);

-- --------------------------------------------------------

--
-- Table structure for table `user_recommendations`
--

CREATE TABLE `user_recommendations` (
  `user_recommendation_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `recommendation_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_tags`
--

CREATE TABLE `user_tags` (
  `user_tag_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tag_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accessibility_issues`
--
ALTER TABLE `accessibility_issues`
  ADD PRIMARY KEY (`issue_id`);

--
-- Indexes for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `prompt_id` (`prompt_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `prompts`
--
ALTER TABLE `prompts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD PRIMARY KEY (`recommendation_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`),
  ADD UNIQUE KEY `tag_name` (`tag_name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_accessibility`
--
ALTER TABLE `user_accessibility`
  ADD PRIMARY KEY (`user_accessibility_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `issue_id` (`issue_id`);

--
-- Indexes for table `user_recommendations`
--
ALTER TABLE `user_recommendations`
  ADD PRIMARY KEY (`user_recommendation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `recommendation_id` (`recommendation_id`);

--
-- Indexes for table `user_tags`
--
ALTER TABLE `user_tags`
  ADD PRIMARY KEY (`user_tag_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `tag_id` (`tag_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessibility_issues`
--
ALTER TABLE `accessibility_issues`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `prompts`
--
ALTER TABLE `prompts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `recommendations`
--
ALTER TABLE `recommendations`
  MODIFY `recommendation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `user_accessibility`
--
ALTER TABLE `user_accessibility`
  MODIFY `user_accessibility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT for table `user_recommendations`
--
ALTER TABLE `user_recommendations`
  MODIFY `user_recommendation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_tags`
--
ALTER TABLE `user_tags`
  MODIFY `user_tag_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`prompt_id`) REFERENCES `prompts` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `recommendations`
--
ALTER TABLE `recommendations`
  ADD CONSTRAINT `recommendations_ibfk_1` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_accessibility`
--
ALTER TABLE `user_accessibility`
  ADD CONSTRAINT `user_accessibility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_accessibility_ibfk_2` FOREIGN KEY (`issue_id`) REFERENCES `accessibility_issues` (`issue_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_recommendations`
--
ALTER TABLE `user_recommendations`
  ADD CONSTRAINT `user_recommendations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_recommendations_ibfk_2` FOREIGN KEY (`recommendation_id`) REFERENCES `recommendations` (`recommendation_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_tags`
--
ALTER TABLE `user_tags`
  ADD CONSTRAINT `user_tags_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_tags_ibfk_2` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
