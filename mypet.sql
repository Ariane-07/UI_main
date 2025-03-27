-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 27, 2025 at 08:49 AM
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
  `message_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=deleted,1=existing',
  `message_seen` int(11) NOT NULL COMMENT '1=seen, 0=unseen'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`chat_id`, `sender_id`, `receiver_id`, `message_text`, `message_media`, `message_status`, `message_seen`) VALUES
(35, 18, 6, 'hi azi', NULL, 1, 1),
(38, 6, 18, 'testdddd', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `impounded_pets`
--

CREATE TABLE `impounded_pets` (
  `imp_id` int(11) NOT NULL,
  `imp_date_caught` date NOT NULL,
  `imp_location_found` varchar(255) NOT NULL,
  `imp_location_impound` varchar(255) NOT NULL,
  `imp_days_rem` int(11) NOT NULL,
  `imp_impounded_photo` varchar(255) NOT NULL,
  `imp_notes` text DEFAULT NULL,
  `imp_status` varchar(60) NOT NULL DEFAULT 'Unclaimed',
  `imp_claim_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `impounded_pets`
--

INSERT INTO `impounded_pets` (`imp_id`, `imp_date_caught`, `imp_location_found`, `imp_location_impound`, `imp_days_rem`, `imp_impounded_photo`, `imp_notes`, `imp_status`, `imp_claim_by`) VALUES
(4, '2025-03-12', 'marilao', 'malolos', 5, '67d195a886d15.jpeg', 'asfawff', 'Pending', 18),
(6, '2025-03-12', 'marilao bulacan', 'malolos bulacan', 5, '67d1964667477.jpg', '', 'Unclaimed', NULL);

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
(60, 18, '67cb125748237.jpg', '67cb1257485df.jpg', '2025-03-07', 'juan', 234, 'male', '2025-02-26', '09770978151', 'DAwkjh@gmail.com', 'awkldjawkl', 'aswifuawiu', 'esfse', '43', 'male', 'awdawd', 'rgdrg', '23', 'zcascsdz', 'fcvdxzv', '2025-03-15', '2025-03-20', '2025-01-04', '67cb12574a6f2.jpeg', 'awdaw', 'sef', 'fth', '094544547889', '67cb12574a155.png', '2025-03-07', 'PET_60.png', 'accept_by_lgu'),
(61, 18, '67cb134c6be7f.jpeg', '67cb134c6c395.jpeg', '2025-03-28', 'pedro', 2323, 'male', '2025-03-11', '3284723897', 'sefsefse@gmail.com', 'qdawd', 'ggrdg', 'awdaw', '12', 'male', 'dawda', 'sefse', '123', 'awd', 'awdaw', '2025-03-21', '2025-03-11', '2025-03-25', '67cb134c6e9ee.jpeg', 'sszc', 'czc', 'xdvse', '09454545777', '67cb134c6e4bf.jpg', '2025-03-07', 'PET_61.png', 'pending'),
(63, 6, '67d109cfbef9d.jpg', '67d109cfbf5de.png', '2025-03-12', 'kokey', 12, 'male', '2025-03-12', '094944415454', 'kokey@gmail.com', 'marilao bulacan', 'sta.rosa 2', 'kiko', '12', 'male', 'dog', 'husky', '2', 'white', 'awd', '2025-03-12', '2025-03-13', '2025-03-12', '67d109cfc009f.jpeg', 'joshua clinic', 'joshua padilla', 'marilao bulacan', '09454454744', '67d109cfbfcf0.jpeg', '2025-03-12', 'PET_63.png', 'accept_by_lgu'),
(65, 18, NULL, '67dd4c8c941e6.jpg', '2025-03-21', 'wadawd', 123, 'male', '2025-03-21', '09454454744', 'andersonandy046@gmail.com', 'sta.rosa 2 marilao', 'tibagan', 'joshua', '12', 'male', 'turtle', 'pagong', '12', 'red', 'awdawdaw', '2025-03-21', '2025-03-19', '2025-03-24', '67dd4c8c94911.jpeg', 'awdawd', 'esfesf', 'tfhft', '094544454744', NULL, '2025-03-21', 'PET_65.png', 'pending');

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
(41, 56, 15, 'gesf', '2025-03-04 04:41:52'),
(42, 60, 18, 'test', '2025-03-13 01:07:53'),
(43, 64, 18, 'test', '2025-03-13 01:21:26'),
(44, 63, 18, 'still working ?', '2025-03-13 01:28:18'),
(45, 64, 34, 'eee', '2025-03-24 14:16:15');

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
(63, '2025-03-04 14:37:30', 15, 'test ', '{\"images\":[\"img_67c7102a44aa0.png\"],\"videos\":[]}', 1),
(64, '2025-03-13 00:57:22', 18, 'testiung', '{\"images\":[\"img_67d22d7242bec.jpg\"]}', 1),
(65, '2025-03-12 16:07:32', 15, '', '{\"images\":[\"img_67d1b12bca1a0.jpg\"],\"videos\":[]}', 0),
(66, '2025-03-24 14:16:01', 34, 'test', NULL, 1),
(67, '2025-03-27 06:24:29', 34, 'test', '{\"images\":[\"img_67e4ef1da5219.jpg\"]}', 1),
(68, '2025-03-27 06:25:44', 14, 'im lgu\r\n', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `post_like`
--

CREATE TABLE `post_like` (
  `like_id` int(11) NOT NULL,
  `like_user_id` int(11) NOT NULL,
  `like_post_id` int(11) NOT NULL,
  `like_action` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_like`
--

INSERT INTO `post_like` (`like_id`, `like_user_id`, `like_post_id`, `like_action`) VALUES
(5, 18, 64, 'like'),
(7, 16, 64, 'like'),
(8, 15, 64, 'like'),
(9, 34, 64, 'like'),
(10, 34, 61, 'like'),
(11, 15, 68, 'like'),
(12, 15, 67, 'like'),
(13, 15, 66, 'like'),
(14, 34, 68, 'like');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `UserID` int(11) NOT NULL,
  `Name` varchar(60) DEFAULT NULL,
  `Bio` text DEFAULT NULL,
  `Username` varchar(255) NOT NULL,
  `Gender` varchar(60) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `ProfilePic` varchar(255) DEFAULT NULL,
  `BirthDate` date DEFAULT NULL,
  `Contact` varchar(60) DEFAULT NULL,
  `Address` longtext DEFAULT NULL,
  `Link_address` longtext DEFAULT NULL,
  `Role` varchar(255) NOT NULL DEFAULT 'pet_owner',
  `license_proof` varchar(255) DEFAULT NULL,
  `otp_code` varchar(10) DEFAULT NULL,
  `otp_expiry` datetime DEFAULT NULL,
  `status` int(11) NOT NULL COMMENT '0=unverified,1=verified,2=deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Name`, `Bio`, `Username`, `Gender`, `Email`, `Password`, `ProfilePic`, `BirthDate`, `Contact`, `Address`, `Link_address`, `Role`, `license_proof`, `otp_code`, `otp_expiry`, `status`) VALUES
(6, 'azi acosta', '', 'aziacosta', 'Female', 'andersonandy0@gmail.com', 'aecf3f06d39b17636faff2099db795e9d156dc3444322c77d50cdad30df0a95f', 'Profile_67c69a1de18df.jpg', '2000-02-19', '09454454744', 'sta.rosa 2 marilao bulacan', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3873.88762306286!2d121.96660327498417!3d13.845783486556023!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33a2958fff7f86a1%3A0x699ef1cba8f56a17!2sPolytechnic%20University%20of%20the%20Philippines%20(Unisan%2C%20Quezon%20Campus)!5e0!3m2!1sfil!2sph!4v1740974053065!5m2!1sfil!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'pet_owner', NULL, '91446', NULL, 1),
(7, NULL, '', 'joshua', '', 'joshua@gmail.com', 'fc52fabe94c0e037d2df4498e87481a6438960c9f73d517584a7a5c564535ac4', NULL, NULL, '', '', NULL, 'pet_owner', NULL, NULL, NULL, 1),
(8, NULL, '', 'test', '', 'test@gmail.com', '9f86d081884c7d659a2feaa0c55ad015a3bf4f1b2b0b822cd15d6c15b0f00a08', NULL, NULL, '', '', NULL, 'pet_owner', NULL, NULL, NULL, 1),
(10, NULL, '', 'drg', '', 'gdrg', 'ceca3433682bb26312cf1cd7c9c0cc7be025f98e44e5731956a2ab71e29b69a5', NULL, NULL, '', '', NULL, 'pet_owner', NULL, NULL, NULL, 1),
(11, 'Joshua anderson padilla', '', 'andyanderson895', 'Male', 'andyanderson895@yahoo.com', 'eeb1ccc90a93645e43e6e0ccb1d260d87dd47d1d47e98c6d1cadaeeffe820c9d', 'Profile_67c59f058391c.jpg', '2000-03-04', '09454454744', 'sta.rosa marilao bulacan', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15429.69694581816!2d121.02204164999999!3d14.80142965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397af84aa3b1a33%3A0x7ec8015e45998a7f!2sAPAWAN%20VILLAGE%20PHASE%203!5e0!3m2!1sfil!2sph!4v1741004817615!5m2!1sfil!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'pet_owner', NULL, NULL, NULL, 1),
(12, NULL, '', 'angenise24', '', 'angenise24@gmail.com', '53d27f0c391424eec5910a67237d2bd6c9a55663d1ed9381c5560b9f9542c843', NULL, NULL, '', '', NULL, 'vet', NULL, NULL, NULL, 1),
(13, NULL, '', 'juan', '', 'juan@gmail.com', 'ed08c290d7e22f7bb324b15cbadce35b0b348564fd2d5f95752388d86d71bcca', NULL, NULL, NULL, NULL, NULL, 'vet', NULL, NULL, NULL, 1),
(14, 'andy@gmail.com', '', 'andy', 'Male', 'andy@gmail.com', '6964894d3381c8babae9271306a6c8783c89a2fe580cbbb2bcff61db1d6bfc89', '', '0000-00-00', '', 'andy@gmail.com', '', 'lgu', NULL, NULL, NULL, 1),
(15, 'dawd', '', 'alden', 'Female', 'alden@gmail.com', 'c928225c4ccc97126df308f85ec92b9e4dde097cee3b0ad2b65062d5b7b7f123', NULL, '0000-00-00', '', '', '', 'vet', NULL, NULL, NULL, 1),
(16, NULL, '', 'padilla', '', 'padilla@gmail.com', '012d67fac892457c2e8f05290131868aa15983ab438a52293937f570b4c114d5', NULL, NULL, NULL, NULL, NULL, 'pet_owner', NULL, NULL, NULL, 1),
(17, NULL, '', 'padilla2', '', 'ssegse@gmail.com', '012d67fac892457c2e8f05290131868aa15983ab438a52293937f570b4c114d5', NULL, NULL, NULL, NULL, NULL, 'pet_owner', NULL, NULL, NULL, 1),
(18, 'Juan dela cruz', 'testting bio', 'andersonandy046', 'Female', 'andersonandy046@gmail.com', 'aecf3f06d39b17636faff2099db795e9d156dc3444322c77d50cdad30df0a95f', '', '0000-00-00', '', 'sta.rosa 2 marilao', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15429.69694581816!2d121.02204164999999!3d14.80142965!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397af84aa3b1a33%3A0x7ec8015e45998a7f!2sAPAWAN%20VILLAGE%20PHASE%203!5e0!3m2!1sfil!2sph!4v1741447380658!5m2!1sfil!2sph\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'pet_owner', NULL, NULL, '2025-03-16 12:01:53', 1),
(20, NULL, '', 'test4', '', 'test4@gmail.com', '66b5add2fa660bce69fdf80804d0c907390b12bac849a5009a72535f6dcea48d', NULL, NULL, NULL, NULL, NULL, 'vet', NULL, NULL, NULL, 1),
(21, NULL, '', 'awd@gmail.com', '', 'awd@gmail.com', '66b5add2fa660bce69fdf80804d0c907390b12bac849a5009a72535f6dcea48d', NULL, NULL, NULL, NULL, NULL, 'vet', NULL, NULL, NULL, 1),
(22, NULL, NULL, 'testPhone123', '', 'testPhone123@gmail.com', 'dffc4e28b0956ec9ffeb10d2589d048cd57cf93c3a7ff601f8c93962853b2b70', NULL, NULL, NULL, NULL, NULL, 'pet_owner', NULL, NULL, NULL, 1),
(23, NULL, NULL, 'Lapulapu123', '', 'Lapulapu123@gmail.com', '32bf07f76a2aeaf56071b9adf2391a14a642c784cb225b200a594758f02e5f03', NULL, NULL, NULL, NULL, NULL, 'pet_owner', NULL, NULL, NULL, 1),
(24, NULL, NULL, 'Pakshet123', '', 'Pakshet123@gmail.com', '06d6bdd9fb554a6f9bc695026d2541a2c927bfc02fae03805f8ef62c70ed6195', NULL, NULL, NULL, NULL, NULL, 'pet_owner', NULL, NULL, NULL, 1),
(25, NULL, NULL, 'audrey123', '', 'Audrey123@gmail.com', '484ff75ece55a742aa508ae957d1b44bda677eae6ba6fc5d7f5ac5dd6ca8300d', NULL, NULL, NULL, NULL, NULL, 'pet_owner', NULL, NULL, NULL, 1),
(26, NULL, NULL, 'mrbean', '', 'Mrbean123@yahoo.com', 'a27b901fb45e40076e0b4a3dad8db8a5a583ef2281d07dff9ed450d4050dc2a7', NULL, NULL, NULL, NULL, NULL, 'pet_owner', NULL, NULL, NULL, 1),
(27, NULL, NULL, 'Joshua123@gmail.com', '', 'Joshua123@gmail.com', 'eb876a288a8467c5683a81b59d694a87ad49cccf6786425704956b952fad22d6', NULL, NULL, NULL, NULL, NULL, 'vet', 'vet_id_67dace3b3de15.webp', NULL, NULL, 1),
(28, NULL, NULL, 'Pedro123@gmail.com', '', 'Pedro123@gmail.com', 'a995d64da582f6118cc43e3ea6e666baa9d1c0bd4b408ca87f2ba35c6994dfe0', NULL, NULL, NULL, NULL, NULL, 'pet_owner', NULL, NULL, NULL, 1),
(29, NULL, NULL, 'JuanCarlos123@gmail.com', '', 'JuanCarlos123@gmail.com', 'c2e5e9a238a936b6d4005fd4ac445f53901b6202531d91f10742235698ef89ae', NULL, NULL, NULL, NULL, NULL, 'pet_owner', NULL, NULL, NULL, 1),
(30, NULL, NULL, 'docwilly', '', 'Docwilly123@gmail.com', 'f65e5bef8f16a6d3ddcc06ccabdb19127edcff548684cbe8d8275b7d68c31c50', NULL, NULL, NULL, NULL, NULL, 'vet', 'vet_id_67dacf29690d4.jpeg', NULL, NULL, 1),
(32, NULL, NULL, 'BongBong123@gmail.com', '', 'BongBong123@gmail.com', '792e96c9ffc5f3c412504bdffb87c77eb61b987cb8f80a273aa1bbb23e93aed2', NULL, NULL, NULL, NULL, NULL, 'pet_owner', NULL, NULL, NULL, 1),
(33, NULL, NULL, 'KuyaDoc123@gmail.com', '', 'KuyaDoc123@gmail.com', 'd4df883bee6b0af3abae360cd36197001eb963e867ad217731c74f40f548f2d1', NULL, NULL, NULL, NULL, NULL, 'vet', 'vet_id_67dad03aa285c.webp', NULL, NULL, 2),
(34, 'ako si super admin', NULL, 'super_admin', '', 'super_admin@gmail.com', '35b1e72c51ac17b1cfc8d79e2b24fd22bd5797e4c8461e7e8561818eec28715d', NULL, NULL, NULL, NULL, NULL, 'superAdmin', 'vet_id_67dad03aa285c.webp', NULL, NULL, 1),
(35, 'manok nok', NULL, 'manok', '', 'manok@gmail.com', '5e765d24dd5772cf59ec94d0abf80c4b8cd5e564e64f0eb5e67dad8eebe8948e', NULL, NULL, NULL, 'manok@gmail.com', NULL, 'lgu', NULL, NULL, NULL, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `impounded_pets`
--
ALTER TABLE `impounded_pets`
  ADD PRIMARY KEY (`imp_id`);

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
-- Indexes for table `post_like`
--
ALTER TABLE `post_like`
  ADD PRIMARY KEY (`like_id`);

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
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `impounded_pets`
--
ALTER TABLE `impounded_pets`
  MODIFY `imp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pets_info`
--
ALTER TABLE `pets_info`
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `post_comments`
--
ALTER TABLE `post_comments`
  MODIFY `comments_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `post_content`
--
ALTER TABLE `post_content`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `post_like`
--
ALTER TABLE `post_like`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
