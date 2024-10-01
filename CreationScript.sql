-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 01, 2024 at 04:22 PM
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
(5, 'Color Blindness', 'Inability to distinguish between certain colors, such as red and green.'),
(6, 'Speech Impairment', 'Difficulties with speech and communication.'),
(7, 'Photosensitivity', 'Sensitivity to flashing lights or patterns, which can trigger seizures or other symptoms.'),
(8, 'Motor Impairment', 'Difficulty with fine motor skills, affecting the ability to use a mouse or keyboard.'),
(9, 'Reading Difficulty', 'Challenges with reading due to dyslexia or other conditions.'),
(10, 'Severe Arthritis', 'Joint pain and stiffness that can make navigation difficult.'),
(15, 'Cognitive Impairment', NULL),
(16, 'Mobility Impairment', NULL);

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
(4, 135, 'Emily Davis', 'emily.davis@example.com', 'I had some issues with the font size options. They could be more flexible.', '2024-09-27 03:33:16', 3),
(6, 137, 'Sarah Wilson', 'sarah.wilson@example.com', 'The ability to bookmark prompts is very convenient.', '2024-09-27 03:33:16', 4),
(7, 138, 'Muhammad Ali', 'muhammad.ali@example.com', 'Good selection of accessibility tools, but the load time could be improved.', '2024-09-27 03:33:16', 4),
(8, 139, 'Li Wei', 'li.wei@example.com', 'I appreciate the effort put into making the site accessible for everyone.', '2024-09-27 03:33:16', 5),
(9, 140, 'Ana Garcia', 'ana.garcia@example.com', 'The contact form works well, but I would suggest adding a captcha to prevent spam.', '2024-09-27 03:33:16', 5),
(10, 141, 'Vikram Patel', 'vikram.patel@example.com', 'The website has been very helpful in my studies. Thank you!', '2024-09-27 03:33:16', 4),
(11, 142, 'Olivia Brown', 'olivia.brown@example.com', 'I love the clear layout and easy-to-find information.', '2024-09-27 03:33:16', 3),
(17, 7, 'admin', '', 'njhboubvgv', '2024-09-29 08:39:23', 3),
(18, 7, 'admin', '', 'njhboubvgv', '2024-09-29 08:39:28', 2),
(19, 7, 'admin', '', 'njhboubvgvhjvjhv kh', '2024-09-29 08:41:10', 3),
(21, 7, 'admin', '', 'hyubuo', '2024-09-29 08:45:07', 5),
(22, 7, 'admin', '', 'hyubuo', '2024-09-29 08:47:23', 3);

-- --------------------------------------------------------

--
-- Table structure for table `prompts`
--

CREATE TABLE `prompts` (
  `id` int(11) NOT NULL,
  `problem` varchar(255) DEFAULT NULL,
  `prompt_text` text NOT NULL,
  `ai_recommendation` varchar(255) DEFAULT NULL,
  `guideline` varchar(10) DEFAULT NULL,
  `ai_link` varchar(255) DEFAULT NULL,
  `ai_description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prompts`
--

INSERT INTO `prompts` (`id`, `problem`, `prompt_text`, `ai_recommendation`, `guideline`, `ai_link`, `ai_description`) VALUES
(6, 'Ensure that images on a webpage or HTML code contain appropriate and descriptive alt attributes, in accordance with accessibility standards.', 'Identify images without appropriate alternative text that fail to meet WCAG 1.1 Text Alternatives guidelines. Provide specific recommendations or code corrections to ensure all non-text content is described properly for accessibility. If a screenshot is provided, analyse the flagged issues and suggest corrections. [insert code here/screenshot here]', 'Gemini', '1.1', 'https://gemini.google.com', 'Gemini AI offers the best balance of context-specific alt text, clarity, and usability. Its concise, detailed descriptions fit the content\'s context and ensure a good experience for screen reader users. It also suggests handling redundant information, helping developers avoid unnecessary alt text, making it practical for accessibility compliance.'),
(7, 'check the accessibility of time-based media, such as videos and audio files, ensuring they comply with WCAG 1.2 guidelines. ', 'Analyse the provided HTML code or screenshot or any issues related to time-based media accessibility (video or audio). Identify missing captions, transcripts, or audio descriptions for video and audio elements in accordance with WCAG 1.2 Time-based Media guidelines. Recommend specific solutions or corrected code to ensure that all users, including those with hearing or visual impairments, can access the media content.', 'Gemini', '1.2', 'https://gemini.google.com', 'Gemini provides the best balance of detail, context, and usability, with clear instructions and detailed, context-specific captions and transcripts, ensuring full compliance with WCAG 1.2.'),
(8, 'Identify and Correct improper use of non-semantic elements (e.g., using <div> or <span> instead of proper headings, lists, or form elem', 'Analyse the provided HTML code or accessibility report for issues related to adaptable content. Identify improper use of non-semantic elements (e.g., <div> or <span> instead of proper headings), missing associations for form labels, or incorrect structure. Provide code corrections to ensure semantic structure.', 'Copilot', '1.3', 'https://copilot.microsoft.com/', 'Copilot is recommended for its comprehensive approach, as it incorporates <fieldset> and <legend> for improved structure. For simplicity, Gemini AI offers clear and easy-to-implement suggestions.'),
(9, 'Identifying issues that impact the visual clarity and distinguishability of web content.', 'Analyse the provided HTML code or accessibility report for issues related to the distinguishability of content under WCAG 1.4 Distinguishable guidelines. Focus on identifying insufficient colour contrast, use of colour alone to convey information, and text that may be too small or difficult to read. Recommend code adjustments or alternative design solutions to ensure all users can clearly see and distinguish the content, regardless of visual impairments.', 'Gemini', '1.4', 'https://gemini.google.com', 'Gemini AI provides detailed, practical suggestions, including specific colour adjustments, icons, and font size improvements, making it the best choice for ensuring compliance with WCAG 1.4 Distinguishable guidelines.'),
(10, 'identifying interactive elements on a webpage that are not keyboard accessible.', 'Analyze the provided HTML code or accessibility report for any issues related to keyboard accessibility under WCAG 2.1 Keyboard Accessible guidelines. Focus on identifying interactive elements (e.g., buttons, links, forms) that are not accessible using the keyboard alone. Recommend code adjustments or alternative solutions to ensure all functionality is operable through keyboard input without requiring a mouse.', 'Gemini', '2.1', 'https://gemini.google.com', 'Gemini AI is recommended for its balance of clarity and comprehensive solutions, making it the best choice for ensuring full compliance with WCAG 2.1 Keyboard Accessible guidelines.'),
(11, 'Ensuring that all users, regardless of ability, have adequate time to complete tasks on a webpage.', 'Analyse the provided HTML code or accessibility report for issues related to time limits under WCAG 2.2 Enough Time guidelines. Focus on identifying time-sensitive content or interactions that do not offer users the ability to extend, pause, or adjust the time limits. Recommend solutions to ensure that users with disabilities, such as those with cognitive impairments, have enough time to complete tasks or access the content.', 'Gemini', '2.2', 'https://gemini.google.com', 'Gemini AI for its balance of detail, clarity, and practicality, making it the most comprehensive choice for ensuring compliance with WCAG 2.2 Enough Time.'),
(12, 'Identify content that could potentially cause seizures or physical reactions for users with photosensitive epilepsy.', 'Analyse the provided HTML code or accessibility report for any content that may cause seizures or physical reactions under WCAG 2.3 Seizures and Physical Reactions guidelines. Focus on identifying flashing content that blinks more than three times per second, high-contrast animations, or content that may trigger photosensitive epilepsy. Recommend solutions to remove or modify the flashing content to ensure user safety.', 'Gemini', '2.3', 'https://gemini.google.com', 'Gemini AI is recommended due to its balance of detail, usability, and clarity, making it the best option for ensuring full compliance with WCAG 2.3.'),
(13, 'Identifying navigation-related issues on a webpage, highlighting problems such as missing skip links, improper heading structures, unclear link text, and the absence of ARIA landmarks.', 'Analyse the provided HTML code or accessibility report for issues related to navigation under WCAG 2.4 Navigable guidelines. Focus on identifying missing skip links, improper heading structures, unclear link text, and missing or incomplete landmarks that hinder navigation for users with disabilities. Recommend code improvements or design changes to ensure that the content is easy to navigate using keyboards, screen readers, and other assistive technologies.', 'Gemini', '2.4', 'https://gemini.google.com', 'Gemini AI is recommended for its thorough and actionable solutions, making it the best option for ensuring compliance with WCAG 2.4 Navigable guidelines..'),
(14, 'This prompt is used to identify and address accessibility issues related to input methods, ensuring interactive elements on a webpage are accessible via multiple input methods, such as keyboard, touch, and voice commands.', 'Analyse the provided HTML code or accessibility report for any issues related to input methods under WCAG 2.5 Input Modalities guidelines. Focus on identifying interactive elements that are not accessible through various input methods, such as touch, voice control, or keyboard. Recommend code adjustments or design changes to ensure that users can interact with the content through multiple input modalities, including touch gestures, speech commands, and keyboard navigation.', 'Gemini AI', '2.5', 'https://gemini.google.com', 'Gemini AI is recommended for its detailed and easy-to-implement solutions.'),
(15, 'analysing web content to ensure it is readable and understandable, particularly for users with cognitive impairments.', 'Analyse the provided HTML code or accessibility report for issues related to text readability under WCAG 3.1 Readable guidelines. Focus on identifying missing language declarations, overly complex language, and undefined abbreviations or jargon. Recommend solutions to simplify language, add appropriate language attributes, and provide expansions for abbreviations or jargon to ensure the content is accessible and understandable by a wide range of users, including those with cognitive impairments.', 'Gemini', '3.1', 'https://gemini.google.com', 'Gemini AI is recommended for its comprehensive, clear, and actionable solutions.'),
(16, 'Identify issues with unpredictable content behaviour, such as unexpected focus changes or automatic page reloads, and ensure that user interactions behave consistently.', 'Analyse the provided HTML code or accessibility report for any issues related to unpredictable content behaviour under WCAG 3.2 Predictable guidelines. Focus on identifying unexpected context changes (e.g., forms submitting automatically, links opening in new windows without warning) and ensure that user interactions behave consistently. Recommend code or design adjustments to make the interactions predictable and consistent for users.', 'Gemini', '3.2', 'https://gemini.google.com', 'Gemini AI is the best choice for its detailed and easy-to-implement solutions.'),
(17, 'Identify accessibility issues in forms, such as missing labels, unclear error messages, and the absence of guidance or input validation.', 'Analyse the provided HTML code or accessibility report for issues related to input assistance under WCAG 3.3 Input Assistance guidelines. Focus on identifying missing form labels, unclear error messages, and the lack of suggestions or instructions for users when completing forms. Recommend code or design improvements to ensure that users receive adequate guidance, error prevention, and correction mechanisms during form interactions.', 'Gemini', '3.3', 'https://gemini.google.com', 'Gemini AI is the best choice for its comprehensive, but easy-to-follow solutions.'),
(18, 'Ensuring that web content is compatible with a wide range of assistive technologies, such as screen readers, by identifying and correcting issues with ARIA attributes, non-standard HTML elements, and keyboard accessibility.', 'Analyse the provided HTML code or accessibility report for compatibility issues under WCAG 4.1 Compatible guidelines. Focus on identifying incorrect or missing ARIA attributes, non-standard HTML elements, and potential problems with assistive technologies like screen readers. Recommend solutions to ensure that the code is properly structured and fully compatible with a wide range of assistive technologies.', 'Copilot is suitable in this situation for generating more technical responses. If Gemini can be used if you require easier solutions.', '4.1', 'https://copilot.microsoft.com', 'Gemini AI is comprehensive, while Copilot offers more technical responses.');

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
(144, 'nina_fernandez', 'nina.fernandez@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-03-12 16:00:00', 'general user'),
(145, 'kofi_mensah', 'kofi.mensah@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-03-26 16:00:00', 'general user'),
(146, 'sakura_tanaka', 'sakura.tanaka@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-04-09 16:00:00', 'general user'),
(147, 'ahmed_khan', 'ahmed.khan@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-04-23 16:00:00', 'general user'),
(148, 'yara_elias', 'yara.elias@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-05-07 16:00:00', 'general user'),
(149, 'kevin_nakamura', 'kevin.nakamura@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-05-21 16:00:00', 'general user'),
(150, 'maria_rosales', 'maria.rosales@example.com', '$2y$10$abcdefghijklmnopqrstuvwx', '2024-06-04 16:00:00', 'general user');

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
(87, 135, 1),
(88, 135, 7),
(92, 137, 10),
(93, 137, 8),
(94, 138, 2),
(97, 139, 7),
(98, 140, 1),
(99, 140, 8),
(100, 141, 6),
(101, 141, 9),
(102, 142, 10),
(103, 142, 2),
(105, 142, 5),
(107, 144, 7),
(108, 144, 9),
(109, 144, 10),
(110, 145, 1),
(112, 146, 5),
(113, 147, 8),
(114, 147, 9),
(115, 148, 2),
(117, 148, 6),
(118, 148, 7),
(119, 149, 10),
(120, 149, 1),
(122, 150, 8);

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
  ADD KEY `issue_id` (`issue_id`),
  ADD KEY `user_accessibility_ibfk_1` (`user_id`);

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
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `prompts`
--
ALTER TABLE `prompts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT for table `user_accessibility`
--
ALTER TABLE `user_accessibility`
  MODIFY `user_accessibility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

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
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

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
