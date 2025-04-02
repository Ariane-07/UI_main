-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 01, 2025 at 04:13 PM
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
  `pet_status` varchar(255) NOT NULL DEFAULT 'pending',
  `pet_display_status` int(11) NOT NULL DEFAULT 1 COMMENT '0=deleted, 1=exist'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets_info`
--

INSERT INTO `pets_info` (`pet_id`, `pets_UserID`, `pet_photo_owner`, `pet_validIDName`, `pet_date_application`, `pet_owner_name`, `pet_owner_age`, `pet_owner_gender`, `pet_owner_birthday`, `pet_owner_telMobile`, `pet_owner_email`, `pet_owner_home_address`, `pet_owner_barangay`, `pet_name`, `pet_age`, `pet_gender`, `pet_species`, `pet_breed`, `pet_weight`, `pet_color`, `pet_marks`, `pet_birthday`, `pet_antiRabies_vac_date`, `pet_antiRabies_expi_date`, `pet_antiRabPic`, `pet_vet_clinic`, `pet_vet_name`, `pet_vet_clinic_address`, `pet_vet_contact_info`, `pet_owner_signature`, `pet_date_signed`, `pet_qr_code`, `pet_status`, `pet_display_status`) VALUES
(59, 18, '67cb0a7f190ba.jpg', '67cb0a7f194e9.jpg', '2025-03-07', 'joshua', 18, 'male', '2025-03-14', '09454454744', 'anderson@gmail.com', 'marilao bulacan', 'sta.rosa 2 marilao', 'pikachu', '1', 'male', 'dog', 'chaw chaw', '3', 'orange', 'awdaw', '2025-03-07', '2025-03-07', '2025-02-22', '67cb0a7f1b5ee.jpeg', 'j clinic', 'andy anderson', 'marilao bulacan', '09454454744', '67cb0a7f1a221.png', '2025-03-07', 'PET_59.png', 'declined_by_lgu', 1),
(60, 18, '67cb125748237.jpg', '67cb1257485df.jpg', '2025-03-07', 'juan', 234, 'male', '2025-02-26', '09770978151', 'DAwkjh@gmail.com', 'awkldjawkl', 'aswifuawiu', 'esfse', '43', 'male', 'awdawd', 'rgdrg', '23', 'zcascsdz', 'fcvdxzv', '2025-03-15', '2025-03-20', '2025-01-04', '67cb12574a6f2.jpeg', 'awdaw', 'sef', 'fth', '094544547889', '67cb12574a155.png', '2025-03-07', 'PET_60.png', 'pending', 1),
(61, 18, '67cb134c6be7f.jpeg', '67cb134c6c395.jpeg', '2025-03-28', 'pedro', 2323, 'male', '2025-03-11', '3284723897', 'sefsefse@gmail.com', 'qdawd', 'ggrdg', 'awdaw', '12', 'male', 'dawda', 'sefse', '123', 'awd', 'awdaw', '2025-03-21', '2025-03-14', '2025-03-11', '67cb134c6e9ee.jpeg', 'sszc', 'czc', 'xdvse', '09454545777', '67cb134c6e4bf.jpg', '2025-03-07', 'PET_61.png', 'pending', 1),
(63, 6, '67d109cfbef9d.jpg', '67d109cfbf5de.png', '2025-03-12', 'kokey', 12, 'male', '2025-03-12', '094944415454', 'kokey@gmail.com', 'marilao bulacan', 'sta.rosa 2', 'kiko', '12', 'male', 'dog', 'husky', '2', 'white', 'awd', '2025-03-12', '2025-03-13', '2025-03-12', '67d109cfc009f.jpeg', 'joshua clinic', 'joshua padilla', 'marilao bulacan', '09454454744', '67d109cfbfcf0.jpeg', '2025-03-12', 'PET_63.png', 'declined_by_vet', 1),
(65, 18, NULL, '67dd4c8c941e6.jpg', '2025-03-21', 'wadawd', 123, 'male', '2025-03-21', '09454454744', 'andersonandy046@gmail.com', 'sta.rosa 2 marilao', 'tibagan', 'joshua', '12', 'male', 'turtle', 'pagong', '12', 'red', 'awdawdaw', '2025-03-21', '2025-04-30', '2025-02-28', '67dd4c8c94911.jpeg', 'awdawd', 'esfesf', 'tfhft', '094544454744', NULL, '2025-03-21', 'PET_65.png', 'declined_by_vet', 1),
(66, 39, '67e8ffcfdc193.jpg', '67e8ffcfdc654.png', '2025-03-31', 'Ariane Louise Magbanua', 21, 'female', '2003-07-07', '09399279193', 'magbanua.arianelouise@gmail.com', 'Metroland terreces', 'De Ocampo', 'timtam', '2', 'male', 'dog', 'shih tzu', '4.5', 'black', 'white marks', '2024-10-05', '2025-03-30', '2025-03-31', '67e8ffcfdcd75.jpg', 'Pet Clinic', 'Adolfo Alonso', 'Metroland terreces', '09399279193', '67e8ffcfdca0a.jpg', '2025-03-30', 'PET_66.png', 'accept_by_lgu', 0),
(67, 39, '67eb7a3d73c78.jpg', '67eb7a3d7435e.png', '2025-04-02', 'Ariane Louise Magbanuas', 21, 'female', '2003-07-07', '09399279193', 'magbanua.arianelouise@gmail.com', 'Metroland terrecess', 'De Ocampo', 'timtam', '2', 'Male', 'dogs', 'shih tzu', '4.5', 'black', 'white marks', '2025-04-02', '2025-04-01', '2025-04-01', '67eb7a3d74dfe.jpg', 'Vet District', 'Adolfo Alonso', 'Metroland terreces', '09399279193', '67eb7a3d74858.jpg', '2025-04-01', 'PET_67.png', 'accept_by_lgu', 1),
(68, 39, '67ebdaed9e9b0.jpg', '67ebdaed9f0bc.png', '2025-04-01', 'miguel', 21, 'male', '2003-07-25', '09399279193', 'magbanua.arianelouise@gmail.com', 'Metroland terreces', 'De Ocampo', 'alfredo', '3', 'male', 'dog', 'Labrador', '8', 'white', 'brown spots', '2020-01-05', '2025-04-01', '2025-04-03', '67ebdaed9f9f1.jpg', 'Pet Clinic', 'Almanor', 'Metroland terreces', '09399279193', '67ebdaed9f598.jpg', '2025-04-01', 'PET_68.png', 'pending', 1),
(69, 39, '67ebdba587b01.jpg', '67ebdba587f0a.png', '2025-04-01', 'borada', 54, 'male', '1986-02-06', '09399279193', 'magbanua.arianelouise@gmail.com', 'Metroland terreces', 'De Ocampo', 'scubi', '5', 'male', 'dog', 'shih tzu', '4.5', 'black', 'white marks', '2025-04-03', '2025-04-08', '2025-04-11', '67ebdba588553.jpg', 'Pet Clinic', 'Adolfo Alonso', 'Metroland terreces', '09399279193', '67ebdba588248.jpg', '2025-04-01', 'PET_69.png', 'pending', 1),
(70, 39, '67ebdd7974fb8.jpg', '67ebdd79754cf.png', '2025-04-01', 'Ariane Louise Magbanua', 45, 'male', '1985-07-07', '09399279193', 'magbanua.arianelouise@gmail.com', 'Metroland terreces', 'De Ocampo', 'timtam', '15', 'male', 'dog', 'shih tzu', '4.5', 'black', 'white marks', '2025-03-31', '2025-04-03', '2025-04-11', '67ebdd7975b45.jpg', 'Pet Clinic', 'Adolfo Alonso', 'Metroland terreces', '09399279193', '67ebdd7975826.jpg', '2025-04-01', '', 'pending', 1),
(71, 39, '67ebdd8150aa0.jpg', '67ebdd815103e.png', '2025-04-01', 'Ariane Louise Magbanua', 45, 'male', '1985-07-07', '09399279193', 'magbanua.arianelouise@gmail.com', 'Metroland terreces', 'De Ocampo', 'timtam', '15', 'male', 'dog', 'shih tzu', '4.5', 'black', 'white marks', '2025-03-31', '2025-04-03', '2025-04-11', '67ebdd8151f27.jpg', 'Pet Clinic', 'Adolfo Alonso', 'Metroland terreces', '09399279193', '67ebdd8151c3c.jpg', '2025-04-01', '', 'pending', 1),
(72, 39, '67ebddefc3d82.jpg', '67ebddefc42e7.png', '2025-04-01', 'Ariane Louise Magbanua', 24, 'male', '2000-05-05', '09399279193', 'magbanua.arianelouise@gmail.com', 'Metroland terreces', 'De Ocampo', 'boii', '4', 'male', 'dog', 'shih tzu', '4.5', 'black', 'white marks', '2025-04-09', '2025-04-03', '2025-04-11', '67ebddefc4a79.jpg', 'Pet Clinic', 'Adolfo Alonso', 'Metroland terreces', '09399279193', '67ebddefc46e3.jpg', '2025-04-01', 'PET_72.png', 'pending', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pets_info_history_update`
--

CREATE TABLE `pets_info_history_update` (
  `ph_id` int(11) NOT NULL,
  `ph_pet_id` int(11) NOT NULL,
  `ph_pet_antiRabies_vac_date` date NOT NULL,
  `ph_pet_antiRabies_expi_date` date NOT NULL,
  `ph_update_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pets_info_history_update`
--

INSERT INTO `pets_info_history_update` (`ph_id`, `ph_pet_id`, `ph_pet_antiRabies_vac_date`, `ph_pet_antiRabies_expi_date`, `ph_update_at`) VALUES
(2, 65, '2025-03-30', '2025-02-25', '2025-03-30 07:53:57'),
(3, 65, '2025-04-05', '2025-02-25', '2025-03-30 07:54:53'),
(4, 61, '2025-03-12', '2025-03-11', '2025-03-30 07:56:55'),
(5, 66, '2025-03-30', '2025-03-31', '2025-04-01 03:51:31'),
(6, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:24:57'),
(7, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:24:58'),
(8, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:24:59'),
(9, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:25:00'),
(10, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:25:00'),
(11, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:25:01'),
(12, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:25:01'),
(13, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:25:01'),
(14, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:25:02'),
(15, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:25:02'),
(16, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:25:02'),
(17, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:25:03'),
(18, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:25:03'),
(19, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:28:39'),
(20, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:29:43'),
(21, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:29:43'),
(22, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:29:43'),
(23, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:29:44'),
(24, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:29:50'),
(25, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:29:51'),
(26, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:29:52'),
(27, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:29:52'),
(28, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:48'),
(29, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:48'),
(30, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:49'),
(31, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:49'),
(32, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:49'),
(33, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:49'),
(34, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:50'),
(35, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:50'),
(36, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:50'),
(37, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:50'),
(38, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:52'),
(39, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:52'),
(40, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:52'),
(41, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:53'),
(42, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:30:53'),
(43, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:31:59'),
(44, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:31:59'),
(45, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:31:59'),
(46, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:32:00'),
(47, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:32:00'),
(48, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:32:00'),
(49, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:32:00'),
(50, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:32:00'),
(51, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:32:02'),
(52, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:32:02'),
(53, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:32:02'),
(54, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:32:07'),
(55, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:35:23'),
(56, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:35:24'),
(57, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:35:25'),
(58, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:35:26'),
(59, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:36:47'),
(60, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:36:48'),
(61, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:36:52'),
(62, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:37:54'),
(63, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:37:55'),
(64, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:37:56'),
(65, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:38:31'),
(66, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:42:00'),
(67, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:44:18'),
(68, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:44:20'),
(69, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:44:21'),
(70, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:47:21'),
(71, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:47:26'),
(72, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:47:33'),
(73, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:47:40'),
(74, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:49:59'),
(75, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:50:04'),
(76, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:50:10'),
(77, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:50:17'),
(78, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:51:03'),
(79, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:54:55'),
(80, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:55:01'),
(81, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:55:20'),
(82, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:55:23'),
(83, 67, '2025-04-01', '2025-04-01', '2025-04-01 07:55:25'),
(84, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:02:34'),
(85, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:02:38'),
(86, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:02:51'),
(87, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:02:54'),
(88, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:02:57'),
(89, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:03:01'),
(90, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:03:59'),
(91, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:04:02'),
(92, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:04:05'),
(93, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:05:55'),
(94, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:06:01'),
(95, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:06:05'),
(96, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:06:14'),
(97, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:06:16'),
(98, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:06:20'),
(99, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:06:48'),
(100, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:06:52'),
(101, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:06:54'),
(102, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:06:55'),
(103, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:07:51'),
(104, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:07:55'),
(105, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:07:58'),
(106, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:08:03'),
(107, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:08:17'),
(108, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:08:29'),
(109, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:10:17'),
(110, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:10:21'),
(111, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:10:25'),
(112, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:10:32'),
(113, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:10:45'),
(114, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:10:47'),
(115, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:10:53'),
(116, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:29:57'),
(117, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:29:58'),
(118, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:29:58'),
(119, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:29:59'),
(120, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:31:14'),
(121, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:31:14'),
(122, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:31:15'),
(123, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:31:16'),
(124, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:31:17'),
(125, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:31:17'),
(126, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:31:42'),
(127, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:31:42'),
(128, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:31:47'),
(129, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:34:03'),
(130, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:34:03'),
(131, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:34:04'),
(132, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:34:04'),
(133, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:34:06'),
(134, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:34:07'),
(135, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:34:52'),
(136, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:34:52'),
(137, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:35:31'),
(138, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:35:33'),
(139, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:35:34'),
(140, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:35:35'),
(141, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:35:36'),
(142, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:36:03'),
(143, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:36:04'),
(144, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:36:06'),
(145, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:36:06'),
(146, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:36:06'),
(147, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:36:07'),
(148, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:36:07'),
(149, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:37:03'),
(150, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:37:08'),
(151, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:07'),
(152, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:07'),
(153, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:07'),
(154, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:07'),
(155, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:09'),
(156, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:09'),
(157, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:10'),
(158, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:13'),
(159, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:13'),
(160, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:13'),
(161, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:13'),
(162, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:13'),
(163, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:25'),
(164, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:30'),
(165, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:30'),
(166, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:34'),
(167, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:37'),
(168, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:39:40'),
(169, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:40:09'),
(170, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:40:10'),
(171, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:40:12'),
(172, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:41:45'),
(173, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:42:30'),
(174, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:42:33'),
(175, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:42:36'),
(176, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:42:39'),
(177, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:42:43'),
(178, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:42:55'),
(179, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:42:58'),
(180, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:42:59'),
(181, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:45:27'),
(182, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:45:29'),
(183, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:45:31'),
(184, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:45:32'),
(185, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:46:44'),
(186, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:46:47'),
(187, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:46:48'),
(188, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:50:01'),
(189, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:50:03'),
(190, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:50:04'),
(191, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:50:28'),
(192, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:50:42'),
(193, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:50:45'),
(194, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:50:48'),
(195, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:50:59'),
(196, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:51:01'),
(197, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:51:08'),
(198, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:51:20'),
(199, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:51:36'),
(200, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:51:39'),
(201, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:52:53'),
(202, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:52:55'),
(203, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:53:17'),
(204, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:53:17'),
(205, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:53:18'),
(206, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:53:57'),
(207, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:53:57'),
(208, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:53:58'),
(209, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:53:59'),
(210, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:53:59'),
(211, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:54:45'),
(212, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:55:00'),
(213, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:55:02'),
(214, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:55:04'),
(215, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:55:08'),
(216, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:55:12'),
(217, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:55:16'),
(218, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:55:27'),
(219, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:57:00'),
(220, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:57:04'),
(221, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:58:18'),
(222, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:58:23'),
(223, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:58:35'),
(224, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:58:38'),
(225, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:58:45'),
(226, 67, '2025-04-01', '2025-04-01', '2025-04-01 08:58:48'),
(227, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:00:10'),
(228, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:00:15'),
(229, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:00:20'),
(230, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:00:27'),
(231, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:00:52'),
(232, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:00:56'),
(233, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:01:15'),
(234, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:02:03'),
(235, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:03:30'),
(236, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:03:32'),
(237, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:04:21'),
(238, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:04:28'),
(239, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:05:43'),
(240, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:05:48'),
(241, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:07:16'),
(242, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:07:17'),
(243, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:08:32'),
(244, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:10:05'),
(245, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:10:06'),
(246, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:10:06'),
(247, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:10:48'),
(248, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:10:53'),
(249, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:22:05'),
(250, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:25:07'),
(251, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:25:12'),
(252, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:26:49'),
(253, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:29:15'),
(254, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:29:19'),
(255, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:30:17'),
(256, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:30:22'),
(257, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:30:28'),
(258, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:31:32'),
(259, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:31:37'),
(260, 67, '2025-04-01', '2025-04-01', '2025-04-01 09:54:54'),
(261, 67, '2025-04-01', '2025-04-01', '2025-04-01 10:52:51');

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
(14, 'andy@gmail.com', '', 'andy', 'Male', 'andy@gmail.com', '6177321eac992341d1ad0823a07e76bfc4ee6909db120e377ea303fdc216756c', '', '0000-00-00', '', 'andy@gmail.com', '', 'lgu', NULL, NULL, NULL, 1),
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
(35, 'manok nok', NULL, 'manok', '', 'manok@gmail.com', '5e765d24dd5772cf59ec94d0abf80c4b8cd5e564e64f0eb5e67dad8eebe8948e', NULL, NULL, NULL, 'manok@gmail.com', NULL, 'lgu', NULL, NULL, NULL, 2),
(36, 'juan tamad', NULL, 'newlgu', '', 'newlgu@gmail.com', 'cb58aa6ef7d5d67c6114f83468eaba449e7af03e9884c74b3d0be724f714ef93', NULL, NULL, NULL, 'sta.rosa 2 marilao', NULL, 'lgu', NULL, NULL, NULL, 1),
(37, 'mark', NULL, 'mark', '', 'mark@gmail.com', '92b6222b166d49960e9fdcc680fe96e71a573ae92cd676b4b9b3a06b373d54df', NULL, NULL, NULL, 'tibagan', NULL, 'lgu', NULL, NULL, NULL, 2),
(38, NULL, NULL, 'jovet', '', 'Jovet123@gmail.com', 'ac6c22bab09885fb65f36dfd0e623dfa697792c41f15dc8ebf31639e7cd036d9', NULL, NULL, NULL, NULL, NULL, 'vet', 'vet_id_67e6259b16e84.png', NULL, NULL, 0),
(39, NULL, NULL, 'pet', '', 'pet@gmail.com', '085e7379957955147718f130b7d8b8f8081f5e07c1362a69e2a688d7489e5a30', NULL, NULL, NULL, NULL, NULL, 'pet_owner', NULL, NULL, NULL, 1),
(40, NULL, NULL, 'vet', '', 'vet@gmail.com', '6f4dcc01184727835e1085c6666f87cff943e84157fee05b7723b25161344853', NULL, NULL, NULL, NULL, NULL, 'vet', 'vet_id_67e8ff3ce36aa.png', NULL, NULL, 0),
(41, 'lgu admin', NULL, 'lgu', '', 'lgu@gmail.com', '5ca9e0e9d0dde6129acefaab3f864df82af6ffe957c9e13579c03a7ab23da509', NULL, NULL, NULL, 'Metroland terreces', NULL, 'lgu', NULL, NULL, NULL, 1);

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
-- Indexes for table `pets_info_history_update`
--
ALTER TABLE `pets_info_history_update`
  ADD PRIMARY KEY (`ph_id`);

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
  MODIFY `pet_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `pets_info_history_update`
--
ALTER TABLE `pets_info_history_update`
  MODIFY `ph_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

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
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
