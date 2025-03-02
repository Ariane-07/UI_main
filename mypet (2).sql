-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2025 at 05:17 PM
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
-- Database: `mypet`
--

-- --------------------------------------------------------

--
-- Table structure for table `pets`
--

CREATE TABLE `pets` (
  `pet_id` int(11) NOT NULL,
  `pet_photo_owner` varchar(255) NOT NULL,
  `pet_date_application` date NOT NULL,
  `pet_owner_name` varchar(60) NOT NULL,
  `pet_owner_age` int(11) NOT NULL,
  `pet_owner_gender` varchar(60) NOT NULL,
  `pet_owner_birthday` date NOT NULL,
  `pet_owner_telMobile` varchar(60) NOT NULL,
  `pet_owner_email` varchar(60) NOT NULL,
  `pet_owner_home_address` varchar(60) NOT NULL,
  `pet_name` varchar(60) NOT NULL,
  `pet_age` varchar(60) NOT NULL,
  `pet_gender` varchar(60) NOT NULL,
  `pet_species` varchar(60) NOT NULL,
  `pet_breed` varchar(60) NOT NULL,
  `pet_weight` varchar(60) NOT NULL,
  `pet_color` varchar(60) NOT NULL,
  `pet_marks` varchar(60) NOT NULL,
  `pet_birthday` date NOT NULL,
  `pet_antiRabies_vac_date` date NOT NULL,
  `pet_antiRabies_expi_date` date NOT NULL,
  `pet_vet_clinic` varchar(255) NOT NULL,
  `pet_vet_name` varchar(60) NOT NULL,
  `pet_vet_clinic_address` varchar(255) NOT NULL,
  `pet_vet_contact_info` varchar(255) NOT NULL,
  `pet_owner_signature` varchar(255) NOT NULL,
  `pet_date_signed` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_comments`
--

CREATE TABLE `post_comments` (
  `comments_id` int(11) NOT NULL,
  `comments_post_id` int(11) NOT NULL,
  `comments_user_id` int(11) NOT NULL,
  `comments_text` text NOT NULL,
  `comments_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_comments`
--

INSERT INTO `post_comments` (`comments_id`, `comments_post_id`, `comments_user_id`, `comments_text`, `comments_date`) VALUES
(3, 38, 6, 'paong', '2025-03-02 15:36:20'),
(4, 36, 6, 'boxing video', '2025-03-02 15:36:34'),
(5, 36, 6, 'hello', '2025-03-02 15:36:46'),
(6, 35, 6, 'multiple', '2025-03-02 15:52:05'),
(7, 38, 11, 'turtle', '2025-03-02 15:54:10'),
(8, 35, 11, 'test', '2025-03-02 15:54:28'),
(9, 40, 11, 'teet', '2025-03-02 15:55:40'),
(10, 39, 11, 'hello', '2025-03-02 15:59:52'),
(11, 39, 11, 'maloi', '2025-03-02 16:04:05');

-- --------------------------------------------------------

--
-- Table structure for table `post_content`
--

CREATE TABLE `post_content` (
  `post_id` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `post_user_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`post_images`)),
  `post_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=deleted, 1=existing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_content`
--

INSERT INTO `post_content` (`post_id`, `post_date`, `post_user_id`, `post_content`, `post_images`, `post_status`) VALUES
(32, '2025-03-02 12:57:34', 6, 'test', '{\"images\":[\"img_67c455be483e6.png\"],\"videos\":[]}', 1),
(33, '2025-03-02 13:44:44', 6, 'cars', '{\"images\":[\"img_67c460cc52e1e.jpeg\",\"img_67c460cc531a9.jpeg\",\"img_67c460cc539da.jpeg\"],\"videos\":[]}', 1),
(34, '2025-03-02 13:51:45', 6, 'testing video', '{\"images\":[],\"videos\":[\"vid_67c46271041f7.mp4\"]}', 1),
(35, '2025-03-02 13:53:23', 6, 'testing', '{\"images\":[\"img_67c462d32b583.jpeg\",\"img_67c462d32b921.jpeg\",\"img_67c462d32bbc7.jpeg\",\"img_67c462d32c099.jpeg\",\"img_67c462d32c439.jpeg\"],\"videos\":[]}', 1),
(36, '2025-03-02 13:53:38', 6, 'tetsintg tt2222', '{\"images\":[],\"videos\":[\"vid_67c462e2b69d4.mp4\"]}', 1),
(37, '2025-03-02 14:39:11', 11, 'padilla', '{\"images\":[\"img_67c4677099772.png\",\"img_67c4677099aee.png\"],\"videos\":[]}', 1),
(38, '2025-03-02 15:32:42', 6, 'show comments testing', '{\"images\":[\"img_67c4703c4a35f.png\"],\"videos\":[]}', 1),
(39, '2025-03-02 15:55:17', 11, 'maloi', '{\"images\":[\"img_67c47f65d84bc.jpg\"],\"videos\":[]}', 1),
(40, '2025-03-02 15:55:31', 11, '', '{\"images\":[\"img_67c47f730ccc3.png\"],\"videos\":[]}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ProfilePic` varchar(255) DEFAULT NULL,
  `Role` varchar(255) NOT NULL DEFAULT 'pet_owner'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Username`, `Email`, `Password`, `ProfilePic`, `Role`) VALUES
(6, 'andersonandy046', 'andersonandy046@gmail.com', 'aecf3f06d39b17636faff2099db795e9d156dc3444322c77d50cdad30df0a95f', NULL, 'pet_owner'),
(7, 'joshua', 'joshua@gmail.com', 'fc52fabe94c0e037d2df4498e87481a6438960c9f73d517584a7a5c564535ac4', NULL, 'pet_owner'),
(8, 'test', 'test@gmail.com', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', NULL, 'pet_owner'),
(10, 'drg', 'gdrg', 'ceca3433682bb26312cf1cd7c9c0cc7be025f98e44e5731956a2ab71e29b69a5', NULL, 'pet_owner'),
(11, 'andyanderson895', 'andyanderson895@yahoo.com', 'eeb1ccc90a93645e43e6e0ccb1d260d87dd47d1d47e98c6d1cadaeeffe820c9d', NULL, 'pet_owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pets`
--
ALTER TABLE `pets`
  ADD PRIMARY KEY (`pet_id`);

--
-- Indexes for table `post_comments`
--
ALTER TABLE `post_comments`
  ADD PRIMARY KEY (`comments_id`);

--
-- Indexes for table `post_content`
--
ALTER TABLE `post_content`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `post_user_id` (`post_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UserID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pets`
--
ALTER TABLE `pets`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `comments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `post_content`
--
ALTER TABLE `post_content`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
