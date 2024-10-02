-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2024 at 08:39 AM
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
(3, 'Color Blindness', 'Inability to distinguish between certain colors, such as red and green.'),
(4, 'Speech Impairment', 'Difficulties with speech and communication.'),
(5, 'Photosensitivity', 'Sensitivity to flashing lights or patterns, which can trigger seizures or other symptoms.'),
(6, 'Motor Impairment', 'Difficulty with fine motor skills, affecting the ability to use a mouse or keyboard.'),
(7, 'Reading Difficulty', 'Challenges with reading due to dyslexia or other conditions.'),
(8, 'Severe Arthritis', 'Joint pain and stiffness that can make navigation difficult.'),
(9, 'Cognitive Impairment', 'Problems with a person\'s ability to think, learn, remember, use judgement, and make decisions'),
(10, 'Mobility Impairment', 'Varying types of physical disabilities that impact website interactions');

-- --------------------------------------------------------

--
-- Table structure for table `bookmarks`
--

CREATE TABLE `bookmarks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `prompt_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookmarks`
--

INSERT INTO `bookmarks` (`id`, `user_id`, `prompt_id`) VALUES
(86, 269, 2),
(87, 269, 5),
(88, 275, 5),
(89, 276, 4),
(90, 276, 7),
(91, 277, 1),
(92, 278, 6),
(93, 278, 8),
(94, 280, 9),
(95, 280, 5),
(96, 281, 5),
(97, 281, 2),
(99, 284, 10),
(100, 285, 7),
(102, 286, 7),
(103, 288, 1),
(104, 288, 11),
(105, 290, 10),
(106, 294, 10);

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
(28, 268, 'admin', '', 'The site has been a great resource for learning more about how to implement accessibility in my web projects. The prompts are clear and helpful, especially for handling color blindness issues. I hope to see more resources on cognitive impairments.', '2024-10-02 06:00:47', 4),
(29, 272, 'emily_johnson', 'emily.johnson@outlook.com', 'The information on the site is very insightful! As someone with speech impairment, I found it helpful to learn how developers can create more inclusive websites. I hope there will be more tips on hearing impairments soon', '2024-10-02 06:04:28', 5),
(30, 275, 'william_brown', 'william.brown@live.com', 'I\'ve found the accessibility prompts quite useful in building websites that accommodate motor impairments. The site\'s recommendations have already improved my coding process, but I would love to see even more details on handling severe arthritis and limited dexterity', '2024-10-02 06:08:25', 3),
(31, 276, 'olivia_davis', 'olivia.davis@yahoo.com', 'This site is an excellent educational tool for understanding different accessibility issues. As someone with visual and mobility impairments, I found the content useful in explaining how web accessibility can be improved. Keep up the good work!', '2024-10-02 06:10:18', 5),
(32, 277, 'michael_wilson', 'michael.wilson@gmail.com', 'Great resource for developers trying to make their websites more accessible. The detailed guidelines on color blindness and cognitive impairments were especially useful for my recent projects', '2024-10-02 06:11:27', 4),
(33, 278, 'sophia_miller', 'sophia.miller@hotmail.com', 'I\'ve learned so much from the site! It\'s interesting to see how web content can be made more accessible for those with speech impairments and other disabilities. I would recommend this site to anyone interested in making websites more inclusive.', '2024-10-02 06:12:39', 5),
(34, 280, 'isabella_jackson', 'isabella.jackson@gmail.com', 'Very helpful site! I found the content on motor impairment especially useful, and the photosensitivity guidance was eye-opening. It\'s great to see developers taking accessibility seriously', '2024-10-02 06:14:39', 5),
(35, 281, 'noah_anderson', 'noah.anderson@gmail.com', 'The prompts were helpful in addressing cognitive impairments in web design. I also appreciated the guidance on severe arthritis and how websites can be designed to accommodate users with physical challenges.', '2024-10-02 06:15:28', 3),
(37, 284, 'mia_taylor', 'mia.taylor@icloud.com', 'The site gave me a lot of valuable insights into how mobility impairment can affect website use. I look forward to more content around hearing impairment and motor challenges in the future', '2024-10-02 06:20:21', 5),
(38, 285, 'joshua_lee', 'joshua.lee@outlook.com', 'The AI suggestions for improving accessibility on visual impairment were top-notch. It made coding so much easier!', '2024-10-02 06:23:04', 4),
(39, 286, 'emma_jones', 'emma.jones@gmail.com', 'I never realized how important it was to consider users with photosensitivity until now. Great tool!', '2024-10-02 06:25:05', 5),
(40, 287, 'michael_walker', 'michael.walker@yahoo.com', 'Really liked how easy it was to identify potential accessibility issues for motor impairments. A huge time saver for developers!', '2024-10-02 06:25:55', 4),
(41, 289, 'lucas_brown', 'lucas.brown@protonmail.com', 'Super helpful for integrating accessibility features into my current project. Looking forward to more updates!', '2024-10-02 06:27:23', 4),
(42, 290, 'lily_clark', 'lily.clark@mail.com', 'This site helped me understand how color blindness impacts web design. It\'s been incredibly informative.', '2024-10-02 06:28:04', 4),
(43, 291, 'logan_taylor', 'logan.taylor@devcorp.com', 'As a developer, the resources on cognitive impairment were invaluable. It’s making a real difference in my current work', '2024-10-02 06:28:49', 4),
(44, 292, 'ava_wilson', 'ava.wilson@hotmail.com', 'The hearing impairment guidelines were eye-opening. I now understand how to improve my website\'s accessibility!', '2024-10-02 06:29:29', 4),
(45, 293, 'oliver_martin', 'oliver.martin@webdesign.net', 'It helped me spot a lot of accessibility issues I hadn’t considered before', '2024-10-02 06:30:09', 3),
(46, 294, 'charlotte_scott', 'charlotte.scott@zoho.com', 'The site\'s recommendations on mobility impairment were very practical. I’d recommend this to anyone wanting to improve accessibility.', '2024-10-02 06:30:57', 5);

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
(1, 'Ensure that images on a webpage or HTML code contain appropriate and descriptive alt attributes, in accordance with accessibility standards.', 'Identify images without appropriate alternative text that fail to meet WCAG 1.1 Text Alternatives guidelines. Provide specific recommendations or code corrections to ensure all non-text content is described properly for accessibility. If a screenshot is provided, analyse the flagged issues and suggest corrections. [insert code here/screenshot here]', 'Gemini', '1.1', 'https://gemini.google.com', 'Gemini AI offers the best balance of context-specific alt text, clarity, and usability. Its concise, detailed descriptions fit the content\'s context and ensure a good experience for screen reader users. It also suggests handling redundant information, helping developers avoid unnecessary alt text, making it practical for accessibility compliance.'),
(2, 'Check the accessibility of time-based media, such as videos and audio files, ensuring they comply with WCAG 1.2 guidelines. ', 'Analyse the provided HTML code or screenshot or any issues related to time-based media accessibility (video or audio). Identify missing captions, transcripts, or audio descriptions for video and audio elements in accordance with WCAG 1.2 Time-based Media guidelines. Recommend specific solutions or corrected code to ensure that all users, including those with hearing or visual impairments, can access the media content.', 'Gemini', '1.2', 'https://gemini.google.com', 'Gemini provides the best balance of detail, context, and usability, with clear instructions and detailed, context-specific captions and transcripts, ensuring full compliance with WCAG 1.2.'),
(3, 'Identify and Correct improper use of non-semantic elements (e.g., using <div> or <span> instead of proper headings, lists, or form elem', 'Analyse the provided HTML code or accessibility report for issues related to adaptable content. Identify improper use of non-semantic elements (e.g., <div> or <span> instead of proper headings), missing associations for form labels, or incorrect structure. Provide code corrections to ensure semantic structure.', 'Copilot', '1.3', 'https://copilot.microsoft.com', 'Copilot is recommended for its comprehensive approach, as it incorporates <fieldset> and <legend> for improved structure. For simplicity, Gemini AI offers clear and easy-to-implement suggestions.'),
(4, 'Identify issues that impact the visual clarity and distinguishability of web content.', 'Analyse the provided HTML code or accessibility report for issues related to the distinguishability of content under WCAG 1.4 Distinguishable guidelines. Focus on identifying insufficient colour contrast, use of colour alone to convey information, and text that may be too small or difficult to read. Recommend code adjustments or alternative design solutions to ensure all users can clearly see and distinguish the content, regardless of visual impairments.', 'Gemini', '1.4', 'https://gemini.google.com', 'Gemini AI provides detailed, practical suggestions, including specific colour adjustments, icons, and font size improvements, making it the best choice for ensuring compliance with WCAG 1.4 Distinguishable guidelines.'),
(5, 'Identifying interactive elements on a webpage that are not keyboard accessible.', 'Analyze the provided HTML code or accessibility report for any issues related to keyboard accessibility under WCAG 2.1 Keyboard Accessible guidelines. Focus on identifying interactive elements (e.g., buttons, links, forms) that are not accessible using the keyboard alone. Recommend code adjustments or alternative solutions to ensure all functionality is operable through keyboard input without requiring a mouse.', 'Gemini', '2.1', 'https://gemini.google.com', 'Gemini AI is recommended for its balance of clarity and comprehensive solutions, making it the best choice for ensuring full compliance with WCAG 2.1 Keyboard Accessible guidelines.'),
(6, 'Ensuring that all users, regardless of ability, have adequate time to complete tasks on a webpage.', 'Analyse the provided HTML code or accessibility report for issues related to time limits under WCAG 2.2 Enough Time guidelines. Focus on identifying time-sensitive content or interactions that do not offer users the ability to extend, pause, or adjust the time limits. Recommend solutions to ensure that users with disabilities, such as those with cognitive impairments, have enough time to complete tasks or access the content.', 'Gemini', '2.2', 'https://gemini.google.com', 'Gemini AI for its balance of detail, clarity, and practicality, making it the most comprehensive choice for ensuring compliance with WCAG 2.2 Enough Time.'),
(7, 'Identify content that could potentially cause seizures or physical reactions for users with photosensitive epilepsy.', 'Analyse the provided HTML code or accessibility report for any content that may cause seizures or physical reactions under WCAG 2.3 Seizures and Physical Reactions guidelines. Focus on identifying flashing content that blinks more than three times per second, high-contrast animations, or content that may trigger photosensitive epilepsy. Recommend solutions to remove or modify the flashing content to ensure user safety.', 'Gemini', '2.3', 'https://gemini.google.com', 'Gemini AI is recommended due to its balance of detail, usability, and clarity, making it the best option for ensuring full compliance with WCAG 2.3.'),
(8, 'Identify navigation-related issues on a webpage, highlighting problems such as missing skip links, improper heading structures, unclear link text, and the absence of ARIA landmarks.', 'Analyse the provided HTML code or accessibility report for issues related to navigation under WCAG 2.4 Navigable guidelines. Focus on identifying missing skip links, improper heading structures, unclear link text, and missing or incomplete landmarks that hinder navigation for users with disabilities. Recommend code improvements or design changes to ensure that the content is easy to navigate using keyboards, screen readers, and other assistive technologies.', 'Gemini', '2.4', 'https://gemini.google.com', 'Gemini AI is recommended for its thorough and actionable solutions, making it the best option for ensuring compliance with WCAG 2.4 Navigable guidelines..'),
(9, 'This prompt is used to identify and address accessibility issues related to input methods, ensuring interactive elements on a webpage are accessible via multiple input methods, such as keyboard, touch, and voice commands.', 'Analyse the provided HTML code or accessibility report for any issues related to input methods under WCAG 2.5 Input Modalities guidelines. Focus on identifying interactive elements that are not accessible through various input methods, such as touch, voice control, or keyboard. Recommend code adjustments or design changes to ensure that users can interact with the content through multiple input modalities, including touch gestures, speech commands, and keyboard navigation.', 'Gemini AI', '2.5', 'https://gemini.google.com', 'Gemini AI is recommended for its detailed and easy-to-implement solutions.'),
(10, 'Analyse web content to ensure it is readable and understandable, particularly for users with cognitive impairments.', 'Analyse the provided HTML code or accessibility report for issues related to text readability under WCAG 3.1 Readable guidelines. Focus on identifying missing language declarations, overly complex language, and undefined abbreviations or jargon. Recommend solutions to simplify language, add appropriate language attributes, and provide expansions for abbreviations or jargon to ensure the content is accessible and understandable by a wide range of users, including those with cognitive impairments.', 'Gemini', '3.1', 'https://gemini.google.com', 'Gemini AI is recommended for its comprehensive, clear, and actionable solutions.'),
(11, 'Identify issues with unpredictable content behaviour, such as unexpected focus changes or automatic page reloads, and ensure that user interactions behave consistently.', 'Analyse the provided HTML code or accessibility report for any issues related to unpredictable content behaviour under WCAG 3.2 Predictable guidelines. Focus on identifying unexpected context changes (e.g., forms submitting automatically, links opening in new windows without warning) and ensure that user interactions behave consistently. Recommend code or design adjustments to make the interactions predictable and consistent for users.', 'Gemini', '3.2', 'https://gemini.google.com', 'Gemini AI is the best choice for its detailed and easy-to-implement solutions.'),
(12, 'Identify accessibility issues in forms, such as missing labels, unclear error messages, and the absence of guidance or input validation.', 'Analyse the provided HTML code or accessibility report for issues related to input assistance under WCAG 3.3 Input Assistance guidelines. Focus on identifying missing form labels, unclear error messages, and the lack of suggestions or instructions for users when completing forms. Recommend code or design improvements to ensure that users receive adequate guidance, error prevention, and correction mechanisms during form interactions.', 'Gemini', '3.3', 'https://gemini.google.com', 'Gemini AI is the best choice for its comprehensive, but easy-to-follow solutions.'),
(13, 'Ensure that web content is compatible with a wide range of assistive technologies, such as screen readers, by identifying and correcting issues with ARIA attributes, non-standard HTML elements, and keyboard accessibility.', 'Analyse the provided HTML code or accessibility report for compatibility issues under WCAG 4.1 Compatible guidelines. Focus on identifying incorrect or missing ARIA attributes, non-standard HTML elements, and potential problems with assistive technologies like screen readers. Recommend solutions to ensure that the code is properly structured and fully compatible with a wide range of assistive technologies.', 'Copilot', '4.1', 'https://copilot.microsoft.com', 'Copilot is suitable in this situation for generating more technical responses. If Gemini can be used if you require easier solutions.');

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
  `role` enum('general_user','admin','developer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `date_created`, `role`) VALUES
(268, 'admin', '', '$2y$10$x1luJLNM.EfMm7w.V5kt3et00L0oxc8iKP9iuxGxtkHG/89exieu2', '2024-10-02 05:56:27', 'admin'),
(269, 'james_smith', 'james.smith@gmail.com', '$2y$10$rm0gE2z4GyosmLJmPgwS1O87Hg63aMio/q4HS8MPwWRJ0O5/x8ulu', '2024-10-02 05:59:00', 'developer'),
(272, 'emily_johnson', 'emily.johnson@outlook.com', '$2y$10$5YS6iQeRR3gdUqcm1QNjku..m2zhw.yxeGeyq.vYrddCknGMweWCe', '2024-10-02 06:03:36', 'general_user'),
(275, 'william_brown', 'william.brown@live.com', '$2y$10$LFCMI2EpGHkB9ebA5r1ofuS1kE95VqhCNZPDchb40i465eGPManyS', '2024-10-02 06:07:44', 'developer'),
(276, 'olivia_davis', 'olivia.davis@yahoo.com', '$2y$10$oVP082qYRoNKw4yQbZNyeedDl389S9kjFfzTppGShSgjcMTc6ZwUu', '2024-10-02 06:09:05', 'general_user'),
(277, 'michael_wilson', 'michael.wilson@gmail.com', '$2y$10$QKQeslxVYHIm3fKPqZvojugc1jiWGUhBirvEn./Q5sRgU5HGpR9Xi', '2024-10-02 06:11:01', 'developer'),
(278, 'sophia_miller', 'sophia.miller@hotmail.com', '$2y$10$hUzSS1dYQzp3CpAUY0QOVe8pOW.pWtl/MybrPANoonaeIo5a5KCbK', '2024-10-02 06:12:12', 'general_user'),
(279, 'liam_moore', 'liam.moore@protonmail.com', '$2y$10$tcMy.cx0/JiPAdBrF73czOmegmNWtPMrwRjZ/i70stR0kOQVWVZea', '2024-10-02 06:13:28', 'developer'),
(280, 'isabella_jackson', 'isabella.jackson@gmail.com', '$2y$10$o2cZ5hPWYgLscV44HpHcH.OFZLPP.Nx6B7SWFjhx08Gr1xIOzvGYC', '2024-10-02 06:14:09', 'general_user'),
(281, 'noah_anderson', 'noah.anderson@gmail.com', '$2y$10$RCJNbXtMz76/M0iqtoXOrOWFhjeaIaS6NKU.LE5afsiQUFsutDP02', '2024-10-02 06:15:06', 'developer'),
(284, 'mia_taylor', 'mia.taylor@icloud.com', '$2y$10$.Z2iSCoY/dN7IPAM9w2zM.UpPqgPmUQW800PLh/CMmQCJ02IwMdtW', '2024-10-02 06:20:02', 'general_user'),
(285, 'joshua_lee', 'joshua.lee@outlook.com', '$2y$10$7b1zwrX8B5iW3..y.ovLIOCd89jI3C3C/8EYwBv0UMlyjY9lsamHm', '2024-10-02 06:22:36', 'developer'),
(286, 'emma_jones', 'emma.jones@gmail.com', '$2y$10$DhQH0Vg2nDrvufj/EG.rI.S9TufgYZ/KasI4d4I17Gkv/TrVn8HkG', '2024-10-02 06:24:32', 'general_user'),
(287, 'michael_walker', 'michael.walker@yahoo.com', '$2y$10$aINA.zZZx67YkTEC/ys4kebITqhUg51WX2d9mSIBzsj0R8eaEK35u', '2024-10-02 06:25:41', 'developer'),
(288, 'sophia_white', 'sophia.white@aol.com', '$2y$10$8iazaLhaxdhtqCsMXHZq6uzJo2bxEqaFrZuAP5oxVd89C1hyBM.V2', '2024-10-02 06:26:20', 'general_user'),
(289, 'lucas_brown', 'lucas.brown@protonmail.com', '$2y$10$qpzv38gTPginE.TiDWb5z.hL4OVvmH2SLwvJLGrpNNeIdtb9zT.2e', '2024-10-02 06:27:04', 'developer'),
(290, 'lily_clark', 'lily.clark@mail.com', '$2y$10$lc7mNNECA3a0MIW7oRqk9...sDT703RyKMuv99vUb.IUACRQksSZK', '2024-10-02 06:27:44', 'general_user'),
(291, 'logan_taylor', 'logan.taylor@devcorp.com', '$2y$10$FEAIz4h3c4mQzCnSLLsKe./kxFy96BfYUjTs2AjNeNZy5i/74JX7a', '2024-10-02 06:28:36', 'developer'),
(292, 'ava_wilson', 'ava.wilson@hotmail.com', '$2y$10$zJq4Ax2Ms4w0C5WZmyjQQOMjVh7ShqtpEveUN50wztwRrV8C1Bn.a', '2024-10-02 06:29:13', 'general_user'),
(293, 'oliver_martin', 'oliver.martin@webdesign.net', '$2y$10$/CtwZZzbvxOhvjOmpaMDquud3opmhyjvmm0r0GTDq4sdHDMVEZ6l6', '2024-10-02 06:29:52', 'developer'),
(294, 'charlotte_scott', 'charlotte.scott@zoho.com', '$2y$10$YdCr72GWO72kixetiRm.qeTgOLYx0gSU5WD/xiNwtRsqU1kZpvgR2', '2024-10-02 06:30:34', 'general_user');

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
(188, 269, 1),
(189, 269, 3),
(190, 269, 9),
(195, 272, 2),
(196, 272, 4),
(203, 275, 6),
(204, 275, 7),
(205, 275, 8),
(206, 276, 1),
(207, 277, 2),
(208, 277, 3),
(209, 277, 9),
(215, 278, 4),
(216, 278, 7),
(217, 279, 1),
(218, 279, 2),
(219, 279, 10),
(220, 280, 3),
(221, 280, 5),
(222, 280, 6),
(223, 281, 7),
(224, 281, 8),
(225, 281, 9),
(232, 284, 2),
(233, 284, 6),
(234, 284, 10),
(235, 285, 1),
(236, 285, 2),
(237, 286, 5),
(238, 286, 9),
(239, 287, 6),
(240, 287, 7),
(241, 288, 4),
(242, 288, 9),
(243, 289, 2),
(244, 289, 8),
(245, 290, 3),
(246, 291, 9),
(247, 292, 2),
(248, 292, 5),
(249, 293, 6),
(250, 293, 9),
(251, 294, 7),
(252, 294, 10);

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accessibility_issues`
--
ALTER TABLE `accessibility_issues`
  MODIFY `issue_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `bookmarks`
--
ALTER TABLE `bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `prompts`
--
ALTER TABLE `prompts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=295;

--
-- AUTO_INCREMENT for table `user_accessibility`
--
ALTER TABLE `user_accessibility`
  MODIFY `user_accessibility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=253;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookmarks`
--
ALTER TABLE `bookmarks`
  ADD CONSTRAINT `bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookmarks_ibfk_2` FOREIGN KEY (`prompt_id`) REFERENCES `prompts` (`id`);

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `user_accessibility`
--
ALTER TABLE `user_accessibility`
  ADD CONSTRAINT `user_accessibility_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_accessibility_ibfk_2` FOREIGN KEY (`issue_id`) REFERENCES `accessibility_issues` (`issue_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
