-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2025 at 04:19 PM
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
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `chat_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `message_text` text NOT NULL,
  `message_media` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `message_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=deleted,1=existing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`chat_id`, `sender_id`, `receiver_id`, `message_text`, `message_media`, `message_status`) VALUES
(8, 6, 12, 'fesf', NULL, 1),
(9, 6, 13, 'hi juan', NULL, 1),
(10, 6, 13, 'upload juan', '67c69c561a010_399348fa029a6aa83bd9021ab45f137a.jpg', 1),
(11, 6, 10, 'hello', NULL, 1),
(12, 6, 15, 'hi alden', NULL, 1),
(13, 15, 6, 'hello azi', NULL, 1),
(14, 15, 6, 'hello', NULL, 1),
(15, 15, 6, '', '67c6a3a757500_007.png', 1),
(16, 15, 6, '', NULL, 1),
(17, 15, 7, '', NULL, 1),
(18, 15, 7, '', NULL, 1),
(19, 15, 8, 'hello', NULL, 1),
(20, 15, 7, 'test', NULL, 1),
(21, 18, 15, 'hi doc', NULL, 1),
(22, 15, 18, 'hello din', NULL, 1),
(23, 15, 18, 'hi', NULL, 1),
(24, 18, 15, 'test oki', NULL, 1),
(25, 15, 6, 'test', NULL, 1),
(26, 15, 6, 'hello', NULL, 1),
(27, 18, 15, 'yyyyy', NULL, 1),
(28, 18, 15, 'fesf', NULL, 1),
(29, 18, 8, 'test', NULL, 1),
(30, 18, 8, 'tttt', NULL, 1),
(31, 18, 8, 'fesf', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pets_info`
--

CREATE TABLE `pets_info` (
  `pet_id` int(11) NOT NULL,
  `pets_UserID` int(11) NOT NULL,
  `pet_photo_owner` varchar(255) DEFAULT NULL,
  `pet_validIDName` varchar(255) DEFAULT NULL,
  `pet_date_application` date NOT NULL,
  `pet_owner_name` varchar(60) NOT NULL,
  `pet_owner_age` int(11) NOT NULL,
  `pet_owner_gender` varchar(60) NOT NULL,
  `pet_owner_birthday` date NOT NULL,
  `pet_owner_telMobile` varchar(60) NOT NULL,
  `pet_owner_email` varchar(60) NOT NULL,
  `pet_owner_home_address` varchar(60) NOT NULL,
  `pet_owner_barangay` varchar(255) NOT NULL,
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
  `pet_antiRabPic` varchar(255) DEFAULT NULL,
  `pet_vet_clinic` varchar(255) NOT NULL,
  `pet_vet_name` varchar(60) NOT NULL,
  `pet_vet_clinic_address` varchar(255) NOT NULL,
  `pet_vet_contact_info` varchar(255) NOT NULL,
  `pet_owner_signature` varchar(255) DEFAULT NULL,
  `pet_date_signed` date NOT NULL,
  `pet_qr_code` varchar(255) DEFAULT NULL,
  `pet_status` varchar(255) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets_info`
--

INSERT INTO `pets_info` (`pet_id`, `pets_UserID`, `pet_photo_owner`, `pet_validIDName`, `pet_date_application`, `pet_owner_name`, `pet_owner_age`, `pet_owner_gender`, `pet_owner_birthday`, `pet_owner_telMobile`, `pet_owner_email`, `pet_owner_home_address`, `pet_owner_barangay`, `pet_name`, `pet_age`, `pet_gender`, `pet_species`, `pet_breed`, `pet_weight`, `pet_color`, `pet_marks`, `pet_birthday`, `pet_antiRabies_vac_date`, `pet_antiRabies_expi_date`, `pet_antiRabPic`, `pet_vet_clinic`, `pet_vet_name`, `pet_vet_clinic_address`, `pet_vet_contact_info`, `pet_owner_signature`, `pet_date_signed`, `pet_qr_code`, `pet_status`) VALUES
(59, 18, '67cb0a7f190ba.jpg', '67cb0a7f194e9.jpg', '2025-03-07', 'joshua', 18, 'male', '2025-03-14', '09454454744', 'anderson@gmail.com', 'marilao bulacan', 'sta.rosa 2 marilao', 'pikachu', '1', 'male', 'dog', 'chaw chaw', '3', 'orange', 'awdaw', '2025-03-07', '2025-03-07', '2025-02-22', '67cb0a7f1b5ee.jpeg', 'j clinic', 'andy anderson', 'marilao bulacan', '09454454744', '67cb0a7f1a221.png', '2025-03-07', 'PET_59.png', 'accept_by_lgu'),
(60, 18, '67cb125748237.jpg', '67cb1257485df.jpg', '2025-03-07', 'juan', 234, 'male', '2025-02-26', '09770978151', 'DAwkjh@gmail.com', 'awkldjawkl', 'aswifuawiu', 'esfse', '43', 'male', 'awdawd', 'rgdrg', '23', 'zcascsdz', 'fcvdxzv', '2025-03-15', '2025-03-20', '2025-01-04', '67cb12574a6f2.jpeg', 'awdaw', 'sef', 'fth', '094544547889', '67cb12574a155.png', '2025-03-07', 'PET_60.png', 'declined_by_vet'),
(61, 18, '67cb134c6be7f.jpeg', '67cb134c6c395.jpeg', '2025-03-28', 'pedro', 2323, 'male', '2025-03-11', '3284723897', 'sefsefse@gmail.com', 'qdawd', 'ggrdg', 'awdaw', '12', 'male', 'dawda', 'sefse', '123', 'awd', 'awdaw', '2025-03-21', '2025-03-11', '2025-03-25', '67cb134c6e9ee.jpeg', 'sszc', 'czc', 'xdvse', '09454545777', '67cb134c6e4bf.jpg', '2025-03-07', 'PET_61.png', 'accept_by_vet');

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
(35, 51, 16, 'post success', '2025-03-03 12:20:57'),
(36, 51, 11, 'single post success', '2025-03-03 12:23:32'),
(37, 56, 6, 'test pikachu', '2025-03-04 04:28:20'),
(38, 56, 15, 'aaaa', '2025-03-04 04:32:00'),
(39, 56, 15, 'test', '2025-03-04 04:32:12'),
(40, 53, 15, 'video', '2025-03-04 04:32:21'),
(41, 56, 15, 'gesf', '2025-03-04 04:41:52');

-- --------------------------------------------------------

--
-- Table structure for table `post_content`
--

CREATE TABLE `post_content` (
  `post_id` int(11) NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `post_user_id` int(11) NOT NULL,
  `post_content` text NOT NULL,
  `post_images` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `post_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=deleted, 1=existing'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_content`
--

INSERT INTO `post_content` (`post_id`, `post_date`, `post_user_id`, `post_content`, `post_images`, `post_status`) VALUES
(51, '2025-03-03 12:20:47', 16, 'test upload single photo', '{\"images\":[\"img_67c59e9f23ff4.jpg\"],\"videos\":[]}', 1),
(52, '2025-03-03 12:23:16', 11, 'test multiple photos', '{\"images\":[\"img_67c59f346e283.jpg\",\"img_67c59f346e63b.jpeg\",\"img_67c59f346e8a6.png\",\"img_67c59f346eb22.jpg\"],\"videos\":[]}', 1),
(53, '2025-03-03 12:24:20', 11, 'test upload videos', '{\"images\":[],\"videos\":[\"vid_67c59f743135b.mp4\"]}', 1),
(56, '2025-03-04 05:29:26', 6, 'pikachu', '{\"images\":[\"img_67c681579931e.jpeg\"]}', 0),
(57, '2025-03-04 05:28:55', 6, '', NULL, 0),
(58, '2025-03-04 04:46:10', 15, 'pets', '{\"images\":[\"img_67c685920c63d.png\",\"img_67c685920ca60.webp\",\"img_67c685920ccaa.jpg\"],\"videos\":[]}', 1),
(59, '2025-03-04 05:28:57', 15, '', NULL, 0),
(60, '2025-03-04 05:29:44', 6, 'wadawd', '{\"images\":[\"img_67c68fc89e6b9.jpg\"],\"videos\":[]}', 1),
(61, '2025-03-04 05:29:56', 6, 'hfthtrfhtf', '{\"images\":[\"img_67c68fd49df15.jpeg\"],\"videos\":[]}', 1),
(62, '2025-03-04 14:36:19', 18, '', '{\"images\":[\"img_67c70fe3642e2.jpg\"],\"videos\":[]}', 1),
(63, '2025-03-04 14:37:30', 15, 'test ', '{\"images\":[\"img_67c7102a44aa0.png\"],\"videos\":[]}', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(60) DEFAULT NULL,
  `Username` varchar(255) NOT NULL,
  `Gender` varchar(60) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ProfilePic` varchar(255) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Contact` varchar(60) DEFAULT NULL,
  `Address` longtext DEFAULT NULL,
  `Link_address` longtext DEFAULT NULL,
  `Role` varchar(255) NOT NULL DEFAULT 'pet_owner'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Username`, `Gender`, `Email`, `Password`, `ProfilePic`, `BirthDate`, `Contact`, `Address`, `Link_address`, `Role`) VALUES
(6, 'azi acosta', 'aziacosta', 'Female', 'andersonandy046@gmail.com', 'aecf3f06d39b17636faff2099db795e9d156dc3444322c77d50cdad30df0a95f', 'Profile_67c69a1de18df.jpg', '2000-02-19', '09454454744', 'sta.rosa 2 marilao bulacan', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.88762306286!2d121.96660327498417!3d13.845783486556023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a2958fff7f86a1%3A0x699ef1cba8f56a17!2sPolytechnic%20University%20of%20the%20Philippines%20(Unisan%2C%20Quezon%20Campus)!5e0!3m2!1sfil!2sph!4v1740974053065!5m2!1sfil!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'pet_owner'),
(7, NULL, 'joshua', '', 'joshua@gmail.com', 'fc52fabe94c0e037d2df4498e87481a6438960c9f73d517584a7a5c564535ac4', NULL, NULL, '', '', NULL, 'pet_owner'),
(8, NULL, 'test', '', 'test@gmail.com', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', NULL, NULL, '', '', NULL, 'pet_owner'),
(10, NULL, 'drg', '', 'gdrg', 'ceca3433682bb26312cf1cd7c9c0cc7be025f98e44e5731956a2ab71e29b69a5', NULL, NULL, '', '', NULL, 'pet_owner'),
(11, 'Joshua anderson padilla', 'andyanderson895', 'Male', 'andyanderson895@yahoo.com', 'eeb1ccc90a93645e43e6e0ccb1d260d87dd47d1d47e98c6d1cadaeeffe820c9d', 'Profile_67c59f058391c.jpg', '2000-03-04', '09454454744', 'sta.rosa marilao bulacan', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15429.69694581816!2d121.02204164999999!3d14.80142965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397af84aa3b1a33%3A0x7ec8015e45998a7f!2sAPAWAN%20VILLAGE%20PHASE%203!5e0!3m2!1sfil!2sph!4v1741004817615!5m2!1sfil!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'pet_owner'),
(12, NULL, 'angenise24', '', 'angenise24@gmail.com', '53d27f0c391424eec5910a67237d2bd6c9a55663d1ed9381c5560b9f9542c843', NULL, NULL, '', '', NULL, 'vet'),
(13, NULL, 'juan', '', 'juan@gmail.com', 'ed08c290d7e22f7bb324b15cbadce35b0b348564fd2d5f95752388d86d71bcca', NULL, NULL, NULL, NULL, NULL, 'vet'),
(14, NULL, 'andy', '', 'andy@gmail.com', '6177321eac992341d1ad0823a07e76bfc4ee6909db120e377ea303fdc216756c', NULL, NULL, NULL, NULL, NULL, 'lgu'),
(15, 'dawd', 'alden', 'Female', 'alden@gmail.com', 'c928225c4ccc97126df308f85ec92b9e4dde097cee3b0ad2b65062d5b7b7f123', NULL, '0000-00-00', '', '', '', 'vet'),
(16, NULL, 'padilla', '', 'padilla@gmail.com', '012d67fac892457c2e8f05290131868aa15983ab438a52293937f570b4c114d5', NULL, NULL, NULL, NULL, NULL, 'pet_owner'),
(17, NULL, 'padilla2', '', 'ssegse@gmail.com', '012d67fac892457c2e8f05290131868aa15983ab438a52293937f570b4c114d5', NULL, NULL, NULL, NULL, NULL, 'pet_owner'),
(18, NULL, 'andersonandy046', '', 'andersonandy04@gmail.com', 'aecf3f06d39b17636faff2099db795e9d156dc3444322c77d50cdad30df0a95f', NULL, NULL, NULL, NULL, NULL, 'pet_owner');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `pets_info`
--
ALTER TABLE `pets_info`
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
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `pets_info`
--
ALTER TABLE `pets_info`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `comments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `post_content`
--
ALTER TABLE `post_content`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
