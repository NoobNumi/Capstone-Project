-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2023 at 09:17 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trinitas`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_email`, `admin_password`) VALUES
(1, 'adTrinitas@gmail.com', '$2y$10$PwzUj1TAWpfZ9JNtOWIVHOg5EVhAJDOP0x9deJ.iSSonUkEt8OCWa');

-- --------------------------------------------------------

--
-- Table structure for table `amenities`
--

CREATE TABLE `amenities` (
  `amenity_id` int(11) NOT NULL,
  `amenity_name` varchar(200) NOT NULL,
  `amenity_icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `amenities`
--

INSERT INTO `amenities` (`amenity_id`, `amenity_name`, `amenity_icon`) VALUES
(1, 'Food Catering', 'fa-solid fa-utensils'),
(2, '9 Single Beds per Room', 'fa-solid fa-bed'),
(3, '2 Single Beds per Room\r\n(3 Rooms)', 'fa-solid fa-bed'),
(4, '1 Single Bed (1 Room)', 'fa-solid fa-bed'),
(5, 'Aircon', 'fa-solid fa-air-conditioner'),
(6, 'Electric Fan', 'fa-solid fa-air-conditioner'),
(7, 'Chapel Venue', 'fa-solid fa-church'),
(8, 'Trinitas Venue', 'fa-solid fa-church'),
(9, 'Comfort Room', 'fa-solid fa-restroom'),
(10, 'Owned Comfort Room', 'fa-solid fa-restroom'),
(11, '50-100 Persons Only', 'fa-solid fa-people-group'),
(12, '50-70 Persons Only', 'fa-solid fa-people-group'),
(13, 'Free Parking in Premises', 'fa-solid fa-car-side'),
(14, 'Gazebo', 'fa-solid fa-house'),
(15, 'Other Guest may be here', 'fa-solid fa-people-group');

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` int(255) NOT NULL,
  `post_content` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_comment`
--

CREATE TABLE `announcement_comment` (
  `announcement_comment_id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_image`
--

CREATE TABLE `announcement_image` (
  `announce_img_id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `img_url_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `announcement_react`
--

CREATE TABLE `announcement_react` (
  `announcement_react_id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `react_value` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appoinment_report`
--

CREATE TABLE `appoinment_report` (
  `appoint_report_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `appointt_report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `appointment_availability`
--

CREATE TABLE `appointment_availability` (
  `available_appoint_id` int(11) NOT NULL,
  `date` varchar(1000) NOT NULL,
  `time_slot` varchar(1000) NOT NULL,
  `availability_status` enum('available','booked') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_availability`
--

INSERT INTO `appointment_availability` (`available_appoint_id`, `date`, `time_slot`, `availability_status`) VALUES
(1, 'September 29, 2023', '9:00 AM', 'booked'),
(2, 'September 20, 2023', '3:00 PM', 'available'),
(3, 'October 7, 2023', '2:00 PM', 'booked'),
(4, 'September 29, 2023', '10:00 AM', 'booked'),
(5, '', '4:00 PM', 'available'),
(6, '2023-9-29', '4:00 PM', 'available'),
(7, '2023-9-30', '4:00 PM', 'available'),
(8, '2023-9-31', '4:00 PM', 'available'),
(9, 'September 29, 2023', '4:00 PM', 'available'),
(10, 'September 30, 2023', '4:00 PM', 'available'),
(11, 'October 01, 2023', '4:00 PM', 'available'),
(12, 'October 08, 2023', '4:00 PM', 'available'),
(13, 'October 09, 2023', '4:00 PM', 'available'),
(14, 'October 10, 2023', '4:00 PM', 'available'),
(15, 'October 28, 2023', '4:00 PM', 'available'),
(16, 'September 24, 2023', '4:00 PM', 'available'),
(17, 'September 25, 2023', '4:00 PM', 'available'),
(18, 'September 26, 2023', '4:00 PM', 'available'),
(19, 'September 24, 2023', '4:00 PM', 'available'),
(20, 'September 25, 2023', '4:00 PM', 'available'),
(21, 'September 26, 2023', '4:00 PM', 'available'),
(22, 'October 01, 2023', '4:00 PM', 'available'),
(23, 'October 01, 2023', '4:00 PM', 'available'),
(24, 'October 22, 2023', '4:00 PM', 'available'),
(25, 'October 23, 2023', '4:00 PM', 'available'),
(26, 'October 24, 2023', '4:00 PM', 'available'),
(27, 'October 25, 2023', '4:00 PM', 'available'),
(28, 'October 28, 2023', '4:00 PM', 'available'),
(29, 'October 02, 2023', '4:00 PM', 'available');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_record`
--

CREATE TABLE `appointment_record` (
  `appoint_id` int(4) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `appoint_sched_date` varchar(100) NOT NULL,
  `appoint_sched_time` varchar(1000) NOT NULL,
  `appoint_description` text NOT NULL,
  `appoint_status` enum('pending','confirmed','cancelled') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_record`
--

INSERT INTO `appointment_record` (`appoint_id`, `user_id`, `first_name`, `last_name`, `street_add`, `city_municipality`, `province`, `postal_code`, `contact_no`, `appoint_sched_date`, `appoint_sched_time`, `appoint_description`, `appoint_status`, `timestamp`, `is_read`) VALUES
(1001, 10001, 'Ed', 'Sheeran', 'New York Street', 'Legazpi', 'Albay', 5403, '09123456789', 'October 27 2023', '4:00 PM', 'testing only', 'confirmed', '2023-11-03 12:23:12', 0),
(1002, 10001, 'Taylor', ' Swift', 'Batungbakal Street', 'New York', 'New York', 5403, '123456', 'October 19 2023', '4:00 PM', 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Sint exercitationem a dolore dolores libero, aut corporis alias consequuntur dolorem dignissimos pariatur atque consequatur, sunt voluptate earum laborum distinctio maiores eius!', 'confirmed', '2023-11-03 12:23:12', 0),
(1003, 10001, 'Satoru', 'Gojo', 'Street di matirhan', 'Legazpi', 'Masbate', 5403, '09123455667', 'October 31 2023', '4:00 PM', 'para sa pag test lang heheheheheheheheheheheheeheheheheheheheheheheheheheheheheheheheheh', 'cancelled', '2023-11-03 12:23:12', 0),
(1004, 10005, 'Enn', 'Numi', 'Batungbakal Street', 'Dimasalang', 'Masbate', 1234, '0912345677889', 'October 1 2023', '4:00 PM', 'Test', 'confirmed', '2023-11-03 12:23:12', 0),
(1005, 10005, 'Juan', 'Dela Cruz', 'Street di matirhan', 'sassas', 'sasA', 0, 'sasas', 'October 27 2023', '4:00 PM', 'The quick brown fox jumps over the lazy dog heheheeheh heheheheh eheheheh heeehe ehdkhsd hehjdy 8cdgh eThe qyic shjad  dthsdb sdysidb dysai ncdy fiufaufdd iffuis dafnej ruci dthe quick brown fox jumps over the lazy dog hehehe dii pa dintapos hays brownout pa talaga nubayan hays jusko jaaaaaaaaaaaaaa', 'confirmed', '2023-11-03 12:23:12', 0),
(1006, 10005, 'Hello ', 'World', 'New York Street', 'Legazpi', 'Albay', 1234, '09123456789', 'October 27 2023', '4:00 PM', '121323434444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444444443535 33333333333333333333345666 555555555555555555555554 53333333333335 4353333333333 46546 65466666666666666665', 'cancelled', '2023-11-03 12:23:12', 0),
(1008, 1001, 'Human', 'Being', 'National Road Street', 'Masbate', 'Masbate', 54086, '09123', 'October 20 2023', '4:00 PM', 'Test', 'cancelled', '2023-11-03 12:23:12', 0),
(1009, 10005, 'Pedro', 'Dela Cruz', 'Batungbakal Street', 'Legazpi', 'Albay', 5403, '0912345677889', 'October 27 2023', '4:00 PM', 'wala lang ', 'confirmed', '2023-11-03 12:23:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `assistant_manager`
--

CREATE TABLE `assistant_manager` (
  `asst_id` int(11) NOT NULL,
  `assist_email` varchar(255) NOT NULL,
  `assist_password` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assistant_manager`
--

INSERT INTO `assistant_manager` (`asst_id`, `assist_email`, `assist_password`) VALUES
(1, 'assist_trinitas@gmail.com', '$2y$10$xZFLSum9BjBDg4lZsVxi5upVHgG5gu6nL7nZn3TEGwmYL8acfJPzi');

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_report`
--

CREATE TABLE `cancellation_report` (
  `cancellation_id` int(11) NOT NULL,
  `retreat_id` int(11) NOT NULL,
  `recollection_id` int(11) NOT NULL,
  `reception_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `seminar_id` int(11) NOT NULL,
  `appoint_id` int(11) NOT NULL,
  `report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category_descriptions`
--

CREATE TABLE `category_descriptions` (
  `description_id` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `description_icon` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category_descriptions`
--

INSERT INTO `category_descriptions` (`description_id`, `description`, `description_icon`) VALUES
(1, 'Meal-inclusive Services', 'fa-solid fa-utensils'),
(2, 'Venue-Only', 'fa-solid fa-church'),
(3, 'Per-person Pricing', 'fa-solid fa-user'),
(4, 'Per-group Pricing', 'fa-solid fa-people-group'),
(5, 'Meal-inclusive Services (Optional)', 'fa-solid fa-utensils'),
(6, 'Shared Guest Rooms', 'fa-solid fa-bed');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `feedback_message` text NOT NULL,
  `rating` varchar(50) NOT NULL,
  `anonymous` varchar(1000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `user_id`, `name`, `feedback_message`, `rating`, `anonymous`, `timestamp`) VALUES
(1, 10001, 'testing_only test', 'Oks lang', 'Bad', '', '2023-10-20 02:25:02'),
(2, 10005, 'Enn Numi', 'Ayoko na po', '2', '1', '2023-10-19 20:25:09'),
(3, 10006, 'Mafuyu Asaina', 'too many bugs\r\n', '1', '1', '2023-11-03 02:26:33'),
(4, 10006, 'Mafuyu Asaina', 'the h button wont work my name is spelled incorrectly\r\n', '1', '0', '2023-11-03 02:29:11');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `meal_id` int(11) NOT NULL,
  `meal_name` varchar(255) NOT NULL,
  `meal_img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`meal_id`, `meal_name`, `meal_img_path`) VALUES
(2, 'Crab and Corn Soup', '/images/Meal_Photos/Breakfast/BF_Crab_Corn.jpg'),
(3, 'Egg Soup', '/images/Meal_Photos/Breakfast/BF_Egg_Soup.jpg'),
(4, 'Italian Pasta', '/images/Meal_Photos/Breakfast/BF_Italian Pasta.jpg'),
(5, 'Pesto Pasta', '/images/Meal_Photos/Breakfast/BF_Pesto_Pasta.jpg'),
(6, 'Tuna Pasta', '/images/Meal_Photos/Breakfast/BF_Tuna_Pasta.jpg'),
(7, 'Pork Barbeque', '/images/Meal_Photos/Lunch_Dinner/PorkBBQ.jpg'),
(8, 'Pork Stir Fry with Mushroom', '/images/Meal_Photos/Lunch_Dinner/PorkStirwMushroom.jpg'),
(10, 'Honey Glazed Chicken', '/images/Meal_Photos/Lunch_Dinner/HoneyGlazedChicken.jpg'),
(11, 'Korean Chicken with Sesame Seeds', '/images/Meal_Photos/Lunch_Dinner/LD_KoreanwSesame.jpg'),
(13, 'Fish Fillet with White Sauce', '/images/Meal_Photos/Lunch_Dinner/LD_fish_whiteSouce.jpg'),
(17, 'Mixed Vegetables with Butter', '/images/Meal_Photos/Lunch_Dinner/LD_MixedVegiesWButter.jpg'),
(18, 'Stir Fry Mixed Vegetables with Oyster Sauce', '/images/Meal_Photos/Lunch_Dinner/MixedVegetableWOyster.jpg'),
(20, 'Mango Pudding', '/images/Meal_Photos/Dessert/DS_manggo_pudding.jpg'),
(23, 'Iced Tea', '/images/Meal_Photos/Drinks/DK_Iced_tea.jpg'),
(25, 'Tapioca', '../uploads/DS_Tapioca2.jpg'),
(27, 'Lumpiang', '../uploads/LD_Lumpia.jpg'),
(29, 'Cucumber Lemonade', '../uploads/CucumberLemonade.jpeg'),
(30, 'Chopsuey', '../uploads/Chopsuey.jpg'),
(31, 'Fish Fillet with Lemon', '../uploads/LD_FishwLemon.jpg'),
(32, 'Sweet and sour fish', '../uploads/6543cc8f3953d_LD_FishSweetSour.jpg'),
(40, 'Buko Pandan', '../uploads/654418eaa2d3f_DS_Buko_Pandan.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `meal_category`
--

CREATE TABLE `meal_category` (
  `mealCat_id` int(11) NOT NULL,
  `mealCat_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meal_category`
--

INSERT INTO `meal_category` (`mealCat_id`, `mealCat_name`) VALUES
(1, 'Breakfast'),
(2, 'Lunch'),
(3, 'Dinner'),
(4, 'Drinks'),
(5, 'Dessert');

-- --------------------------------------------------------

--
-- Table structure for table `meal_sets`
--

CREATE TABLE `meal_sets` (
  `mealCat_id` int(11) NOT NULL,
  `meal_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meal_sets`
--

INSERT INTO `meal_sets` (`mealCat_id`, `meal_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 7),
(2, 8),
(2, 10),
(2, 11),
(2, 13),
(2, 17),
(2, 18),
(4, 23),
(3, 7),
(3, 8),
(3, 10),
(3, 11),
(3, 13),
(3, 17),
(3, 18),
(5, 20),
(5, 25),
(5, 26),
(2, 27),
(4, 29),
(2, 30),
(2, 31),
(2, 32),
(3, 34),
(3, 35),
(3, 36),
(5, 40);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(255) NOT NULL,
  `receiver_id` int(255) NOT NULL,
  `message` varchar(1000) NOT NULL,
  `image_url` varchar(1000) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` int(11) NOT NULL DEFAULT 0,
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `sender_id`, `receiver_id`, `message`, `image_url`, `timestamp`, `is_read`, `is_admin`) VALUES
(1, 2, 1, 'SG95', '', '2023-09-28 13:26:39', 1, 0),
(2, 1, 1, 'SGlpaWk=', '', '2023-09-28 13:28:05', 1, 0),
(3, 1, 1, 'cHNzeQ==', '', '2023-09-28 13:28:55', 1, 0),
(4, 1, 1, 'QW5nIGN1dGUgbmkgTmluYQ==', '', '2023-09-28 13:34:10', 1, 1),
(5, 1, 1, 'VHJ1ZQ==', '', '2023-09-28 13:34:20', 1, 0),
(6, 1, 1, '', '../uploads/651580e6a5133_WIN_20230927_17_07_51_Pro.jpg', '2023-09-28 13:34:30', 1, 0),
(7, 1, 1, 'UmF3cg==', '', '2023-09-28 13:34:32', 1, 0),
(8, 3, 1, 'SGVsbG8gcG8=', '', '2023-09-28 15:19:46', 1, 0),
(9, 1, 1, 'WWlpZWU=', '', '2023-09-29 09:20:56', 1, 0),
(10, 2, 1, 'YXlhdyBiYT8=', '', '2023-09-29 09:37:48', 1, 0),
(11, 2, 1, 'dHJ5', '', '2023-09-29 11:00:15', 1, 0),
(12, 2, 1, 'Y2hhdCB1bGl0', '', '2023-09-29 11:08:13', 1, 0),
(13, 1, 2, 'R2FnaSBiYWtpdCBheWF3', '', '2023-09-29 11:09:18', 1, 1),
(14, 2, 1, 'dHJ5', '', '2023-09-29 11:25:33', 1, 0),
(15, 2, 1, 'aGVsbG8=', '', '2023-09-29 11:53:57', 1, 0),
(16, 2, 1, 'cHNzdA==', '', '2023-09-29 12:13:37', 1, 0),
(17, 1, 1, 'YmFrZXQgcG8=', '', '2023-09-29 12:15:54', 1, 1),
(18, 2, 1, 'SGlp', '', '2023-09-29 12:41:52', 1, 0),
(19, 1, 2, 'SGlpaQ==', '', '2023-09-29 12:43:40', 1, 1),
(20, 2, 1, 'aGVoZQ==', '', '2023-09-29 12:43:47', 1, 0),
(21, 1, 1, 'dHJ5IHVsaXQ=', '', '2023-09-29 12:43:58', 1, 0),
(22, 1, 1, 'bmdp', '', '2023-09-29 12:44:11', 1, 0),
(23, 3, 1, '', '../uploads/6516c6dfd55b0_372380596_312892198075036_5287694985242954215_n.jpg', '2023-09-29 12:45:19', 1, 0),
(24, 1, 3, 'TmljZWU=', '', '2023-09-29 12:45:29', 1, 1),
(25, 1, 1, 'T3k=', '', '2023-09-29 12:56:24', 1, 0),
(26, 1, 1, 'c2VuZA==', '', '2023-09-29 13:34:07', 1, 0),
(27, 2, 1, 'amRoamFoaGQ=', '', '2023-09-29 13:50:42', 1, 0),
(28, 2, 1, 'aGVsbw==', '', '2023-09-29 13:52:21', 1, 0),
(29, 1, 2, 'aGlp', '', '2023-09-29 13:52:53', 1, 1),
(30, 2, 1, 'aGVsbG8=', '', '2023-09-29 13:54:47', 1, 0),
(31, 1, 2, 'aGlpaQ==', '', '2023-09-29 13:55:29', 1, 1),
(32, 2, 1, 'SGlp', '', '2023-09-29 13:56:55', 1, 0),
(33, 1, 2, 'WWllZQ==', '', '2023-09-29 13:57:56', 1, 1),
(34, 2, 1, 'SGlp', '', '2023-09-29 14:00:06', 1, 0),
(35, 1, 3, 'SGVsbG8=', '', '2023-09-29 14:00:58', 1, 1),
(36, 2, 1, 'aGVsbG8=', '', '2023-09-29 14:02:42', 1, 0),
(37, 1, 1, 'd2h5', '', '2023-09-29 14:06:48', 1, 1),
(38, 2, 1, 'b2tl', '', '2023-09-29 14:06:54', 1, 0),
(39, 3, 1, 'dGVzdA==', '', '2023-09-29 14:07:09', 1, 0),
(40, 1, 1, 'c2VuZA==', '', '2023-09-29 14:08:32', 1, 0),
(41, 3, 1, 'SGlp', '', '2023-09-29 14:14:05', 1, 0),
(42, 1, 3, 'SGlp', '', '2023-09-29 14:14:12', 1, 1),
(43, 1, 1, 'dGVzdCBwbGVhc2U=', '', '2023-09-29 14:14:36', 1, 0),
(44, 1, 1, 'd29yayBuYQ==', '', '2023-09-29 14:26:55', 1, 0),
(45, 2, 1, 'YXlhdw==', '', '2023-09-29 14:27:43', 1, 0),
(46, 1, 2, 'aGF5cw==', '', '2023-09-29 14:27:52', 1, 1),
(47, 1, 1, 'd2h5eQ==', '', '2023-09-29 14:27:59', 1, 0),
(48, 1, 1, '', '../uploads/6516df0f81b0b_WIN_20230927_17_07_51_Pro.jpg', '2023-09-29 14:28:31', 1, 0),
(49, 1, 1, 'c2VuZA==', '', '2023-09-29 14:47:20', 1, 0),
(50, 1, 1, 'd2h5', '', '2023-09-29 14:47:33', 1, 1),
(51, 2, 1, 'c2VuZA==', '', '2023-09-29 14:47:41', 1, 0),
(52, 1, 3, 'aGVsbG8=', '', '2023-09-29 14:53:39', 1, 1),
(53, 2, 1, 'aGlp', '', '2023-09-29 14:53:47', 1, 0),
(54, 3, 1, 'ZHNkYXM=', '', '2023-09-29 14:54:24', 1, 0),
(55, 1, 1, 'aXRvIGFubyBuYW1hbiBkYXc=', '', '2023-09-29 14:54:40', 1, 0),
(56, 1, 1, 'c2VuZA==', '', '2023-09-29 15:16:53', 1, 0),
(57, 1, 1, 'aGVsbG8=', '', '2023-09-29 15:40:38', 1, 1),
(58, 1, 3, 'aGVsbA==', '', '2023-09-29 15:40:45', 1, 1),
(59, 1, 2, 'aGVsbw==', '', '2023-09-29 15:40:50', 1, 1),
(60, 2, 1, 'aGVsbG8=', '', '2023-09-29 15:42:53', 1, 0),
(61, 1, 2, 'aGlp', '', '2023-09-29 15:43:02', 1, 1),
(62, 1, 1, 'aGlp', '', '2023-09-29 15:43:15', 1, 0),
(63, 1, 1, 'aGVsbw==', '', '2023-09-29 15:46:20', 1, 0),
(64, 2, 1, 'aGk=', '', '2023-09-29 15:46:28', 1, 0),
(65, 1, 1, 'dHJ5', '', '2023-09-29 15:59:25', 1, 0),
(66, 1, 1, 'Z2FudW4gdGFsYWdh', '', '2023-09-29 15:59:40', 1, 0),
(67, 1, 1, 'd2Vo', '', '2023-09-29 16:03:34', 1, 0),
(68, 1, 1, 'Z2Zn', '', '2023-09-29 16:04:00', 1, 1),
(69, 1, 3, 'aGdoZw==', '', '2023-09-29 16:04:05', 1, 1),
(70, 3, 1, 'enh4', '', '2023-09-29 16:11:16', 1, 0),
(71, 1, 1, 'YXNkYXNk', '', '2023-09-29 16:11:25', 1, 0),
(72, 3, 1, 'd2RzZA==', '', '2023-09-29 16:13:44', 1, 0),
(73, 1, 1, 'dHJ5', '', '2023-09-29 16:16:09', 1, 0),
(74, 1, 1, 'bnViYXlhbg==', '', '2023-09-29 16:16:22', 1, 1),
(75, 3, 1, 'c2Fz', '', '2023-09-29 16:16:32', 1, 0),
(76, 1, 1, 'dWxpdA==', '', '2023-09-29 16:20:25', 1, 0),
(77, 1, 1, 'b2ty', '', '2023-09-29 16:21:01', 1, 1),
(78, 3, 1, 'c2RhZHM=', '', '2023-09-29 16:21:22', 1, 0),
(79, 1, 1, 'c2pkamFzamg=', '', '2023-09-29 16:22:04', 1, 0),
(80, 1, 1, 'c2FzYQ==', '', '2023-09-29 16:37:12', 1, 0),
(81, 10001, 1, 'd2V3', '', '2023-09-29 16:37:56', 1, 0),
(82, 1, 10001, 'aGVoZWhl', '', '2023-09-29 16:38:03', 1, 1),
(83, 10003, 1, '', '../uploads/6516fdb3427f0_design_capstone reference.png', '2023-09-29 16:39:15', 1, 0),
(84, 1, 10003, 'bm9pY2U=', '', '2023-09-29 16:39:26', 1, 1),
(85, 1, 10002, 'SGk=', '', '2023-09-29 16:39:42', 1, 1),
(86, 1, 10003, 'eWVzcw==', '', '2023-09-29 16:39:48', 1, 1),
(87, 10001, 1, 'YXNhc2E=', '', '2023-09-29 16:42:55', 1, 0),
(88, 1, 10001, 'c2Fzc2Fz', '', '2023-09-29 16:43:16', 1, 1),
(89, 1, 10001, 'c2FzYQ==', '', '2023-09-29 16:43:17', 1, 1),
(90, 10001, 1, 'c2FzYXNh', '', '2023-09-29 16:43:21', 1, 0),
(91, 10001, 1, 'c2FzYXNhc2E=', '', '2023-09-29 16:43:23', 1, 0),
(92, 10001, 1, 'c2Fzc2FzZGhzZGFoc3Zkcw==', '', '2023-09-29 16:43:25', 1, 0),
(93, 10001, 1, 'SGk=', '', '2023-09-30 08:53:06', 1, 0),
(94, 10001, 1, 'aGVsbG8=', '', '2023-09-30 08:55:48', 1, 0),
(95, 10001, 1, 'aGlp', '', '2023-09-30 09:31:42', 1, 0),
(96, 10002, 1, 'SElJSQ==', '', '2023-09-30 09:33:12', 1, 0),
(97, 1, 10002, 'aGVoZQ==', '', '2023-09-30 09:33:35', 1, 1),
(98, 10001, 1, 'aGVoZQ==', '', '2023-09-30 09:35:56', 1, 0),
(99, 1, 10001, 'aGlp', '', '2023-09-30 09:36:06', 1, 1),
(100, 10001, 1, 'cHNzdA==', '', '2023-09-30 09:39:05', 1, 0),
(101, 10002, 1, 'Li4u', '', '2023-09-30 09:40:31', 1, 0),
(102, 10001, 1, 'aGV5eQ==', '', '2023-09-30 09:43:55', 1, 0),
(103, 10001, 1, 'cHNzdA==', '', '2023-09-30 11:47:35', 1, 0),
(104, 10001, 1, 'Li4u', '', '2023-09-30 12:01:06', 1, 0),
(105, 10001, 1, 'Li4u', '', '2023-09-30 12:04:36', 1, 0),
(106, 10001, 1, 'aGF5cw==', '', '2023-09-30 12:06:23', 1, 0),
(107, 10001, 1, 'Li4u', '', '2023-09-30 13:06:01', 1, 0),
(108, 10001, 1, 'dGVzdA==', '', '2023-09-30 13:16:46', 1, 0),
(109, 10001, 1, 'Li4u', '', '2023-09-30 13:17:13', 1, 0),
(110, 10001, 1, 'Li4u', '', '2023-09-30 13:18:25', 1, 0),
(111, 10002, 1, 'Li4u', '', '2023-09-30 14:11:39', 1, 0),
(112, 10002, 1, 'Li4u', '', '2023-09-30 14:12:18', 1, 0),
(113, 1, 10002, 'Li4u', '', '2023-09-30 14:56:46', 1, 1),
(114, 1, 10002, 'Li4uLg==', '', '2023-09-30 14:58:55', 1, 1),
(115, 1, 10001, 'Li4u', '', '2023-09-30 15:02:00', 1, 1),
(116, 1, 10001, 'ZGdoc3NmZ2hpdGcg', '', '2023-09-30 15:03:21', 1, 1),
(117, 1, 10002, 'd3FlcXdlZQ==', '', '2023-09-30 15:03:51', 1, 1),
(118, 10001, 1, 'Li4uLi4uLi4=', '', '2023-10-01 06:00:46', 1, 0),
(119, 1, 10001, 'Li4uLi4=', '', '2023-10-01 06:00:57', 1, 1),
(120, 1, 10001, 'Li4u', '', '2023-10-01 06:14:59', 1, 1),
(121, 1, 10001, 'aGV5', '', '2023-10-01 06:37:31', 1, 1),
(122, 1, 10001, 'eWFoYWxsb29v', '', '2023-10-01 13:24:11', 1, 1),
(123, 1, 10001, 'cHNzdA==', '', '2023-10-01 13:24:30', 1, 1),
(124, 1, 10001, 'aGlp', '', '2023-10-01 13:48:44', 1, 1),
(125, 1, 10001, 'Li4u', '', '2023-10-01 13:50:40', 1, 1),
(126, 1, 10001, 'dGVzdA==', '', '2023-10-01 13:57:02', 1, 1),
(127, 1, 10001, 'dGVzdA==', '', '2023-10-01 13:57:10', 1, 1),
(128, 1, 10001, 'Li4u', '', '2023-10-01 14:55:26', 1, 1),
(129, 1, 10002, 'aG95', '', '2023-10-01 15:00:23', 0, 1),
(130, 10001, 1, 'YXpkYXM=', '', '2023-10-01 15:33:47', 1, 0),
(131, 1, 10001, 'dGVzdGluZw==', '', '2023-10-01 15:42:33', 1, 1),
(132, 1, 10001, 'Li4uLi4uLi4uLi4u', '', '2023-10-01 15:46:45', 1, 1),
(133, 1, 10001, 'bmlpaWlpaW4=', '', '2023-10-02 00:20:31', 1, 1),
(134, 1, 10001, 'dWxpdA==', '', '2023-10-02 00:23:09', 1, 1),
(135, 1, 10001, '', '../uploads/651a168a483e3_Screenshot 2023-09-29 213004.png', '2023-10-02 01:02:02', 1, 1),
(136, 10001, 1, 'aHV5', '', '2023-10-02 01:30:21', 1, 0),
(137, 10003, 1, 'UHV1Pw==', '', '2023-10-02 01:31:47', 1, 0),
(138, 1, 10001, 'd2dhdD8=', '', '2023-10-02 01:32:35', 1, 1),
(139, 1, 10003, 'aG91', '', '2023-10-02 01:33:26', 1, 1),
(140, 1, 10003, 'Li4uLi4uLi4=', '', '2023-10-02 01:33:42', 1, 1),
(141, 1, 10005, 'aGk=', '', '2023-10-27 08:07:17', 1, 1),
(142, 10005, 1, 'aGVsbG9c', '', '2023-10-27 08:08:38', 1, 0),
(143, 10005, 1, '', '../uploads/653b7036d3769_WIN_20231027_16_09_04_Pro.jpg', '2023-10-27 08:09:26', 1, 0),
(144, 1, 10005, 'aWlpaWg=', '', '2023-10-27 08:10:46', 1, 1),
(145, 1, 10005, 'aWk=', '', '2023-10-27 08:13:47', 1, 1),
(146, 10005, 1, 'aGVubG8=', '', '2023-11-01 03:08:06', 1, 0),
(147, 10006, 1, 'ZWxsb3A=', '', '2023-11-03 09:25:13', 1, 0),
(148, 10006, 1, 'ZWxsbw==', '', '2023-11-03 09:25:18', 1, 0),
(149, 10006, 1, 'aGVsbG8=', '', '2023-11-03 09:25:23', 1, 0),
(150, 10006, 1, 'aSB3b3VsZCBsaWtlIHR5byBhcHBvaW10Zw==', '', '2023-11-03 09:25:31', 1, 0),
(151, 10006, 1, 'aSB3b3B1bGQgbGlrZSB0byByZW41IHRoZSBmaXI1c3p0IHBpYyBtcGxvenp6', '', '2023-11-03 09:25:47', 1, 0),
(152, 10006, 1, '', '../uploads/6544bce38a7b5_DS_Tapioca_1.jpg', '2023-11-03 09:26:59', 1, 0),
(153, 10006, 1, 'aSB3b3VsO2QgbGlrZSB0byByZXNlZXJ2ZSAgYSByb29tIHBsZWFzZQ==', '', '2023-11-03 09:28:24', 1, 0),
(154, 10006, 1, 'dHlubXgg', '', '2023-11-03 09:28:26', 1, 0),
(155, 10006, 1, 'dGhueA==', '', '2023-11-03 09:28:28', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `service_id`, `name`, `price`, `description`, `image_path`) VALUES
(1, 1, 'Casa Maria Retreat Package', 1200.00, 'Food and Accommodation', '/images/casaMariaPackage.png'),
(2, 1, 'Lunduyan Retreat Package', -99999.00, 'Food and Accommodation', '/images/lunduyanPackage.png'),
(3, 2, 'Recollection Package', 400.00, 'Food and Accommodation &\nNo Overnight', '/images/recollection_package.png'),
(4, 3, 'Catering Package', 8000.00, 'Additional 450.00 per Head for Cater', '/images/catering_package.png'),
(5, 3, 'Venue-Only Package', 8000.00, 'Accommodation', '/images/venue_package.png'),
(6, 4, 'Training Package', 400.00, 'Food and Accommodation &\nNo Overnight', '/images/training_package.png'),
(7, 5, 'Seminar Package', 400.00, 'Food and Accommodation &\nNo Overnight', '/images/seminar_package.png');

-- --------------------------------------------------------

--
-- Table structure for table `package_amenities`
--

CREATE TABLE `package_amenities` (
  `package_id` int(11) DEFAULT NULL,
  `amenity_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_amenities`
--

INSERT INTO `package_amenities` (`package_id`, `amenity_id`) VALUES
(1, 1),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 10),
(1, 13),
(1, 14),
(1, 15),
(2, 1),
(2, 2),
(2, 6),
(2, 9),
(2, 13),
(2, 14),
(2, 15),
(3, 1),
(3, 8),
(3, 9),
(3, 12),
(3, 13),
(3, 14),
(4, 1),
(4, 7),
(4, 9),
(4, 11),
(4, 13),
(4, 14),
(5, 7),
(5, 9),
(5, 11),
(5, 13),
(5, 14),
(6, 1),
(6, 8),
(6, 9),
(6, 12),
(6, 13),
(6, 14),
(7, 1),
(7, 8),
(7, 9),
(7, 12),
(7, 13),
(7, 14);

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE `product_details` (
  `prod_id` int(11) NOT NULL,
  `prod_name` varchar(255) NOT NULL,
  `prod_price` float NOT NULL,
  `prod_img` varchar(255) NOT NULL,
  `prod_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reception_reservation_record`
--

CREATE TABLE `reception_reservation_record` (
  `reception_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `check_in` varchar(1000) NOT NULL,
  `check_out` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `payment_option` enum('Pay Full','Pay Half') DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reception_reservation_record`
--

INSERT INTO `reception_reservation_record` (`reception_id`, `user_id`, `first_name`, `last_name`, `street_add`, `city_municipality`, `province`, `postal_code`, `contact_no`, `check_in`, `check_out`, `price`, `payment_method`, `payment_option`, `proof_of_payment`, `status`, `timestamp`, `is_read`) VALUES
(1, 10005, 'Monkey', 'Luffy', 'P1', 'Pilar', 'Sorsogon', 4355, '091234578604', 'October 1 2023', 'October 26 2023', 4800, 'Pay-on-Site', '', NULL, 'confirmed', '2023-11-01 12:28:04', 0),
(2, 10005, 'Satoru', 'Gojo', 'Tokyo', 'Japan', 'Japan', 1232, '09090391', 'October 3 2023', 'November 30 2023', 12323, 'GCash', '', 'cute me', 'confirmed', '2023-11-05 07:43:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `recollection_reservation_record`
--

CREATE TABLE `recollection_reservation_record` (
  `recollection_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `guest_count` int(255) NOT NULL,
  `check_in` varchar(1000) NOT NULL,
  `check_out` varchar(1000) NOT NULL,
  `catering` enum('Yes','No') NOT NULL,
  `price` float NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `payment_option` enum('Pay Full','Pay Half') DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recollection_reservation_record`
--

INSERT INTO `recollection_reservation_record` (`recollection_id`, `user_id`, `first_name`, `last_name`, `street_add`, `city_municipality`, `province`, `postal_code`, `contact_no`, `guest_count`, `check_in`, `check_out`, `catering`, `price`, `payment_method`, `payment_option`, `proof_of_payment`, `status`, `timestamp`, `is_read`) VALUES
(1, 10005, 'Juan', 'Dela Cruz', 'Legazpi street', 'Legazpi City', 'Albay', 12342, '091234243', 12, 'November 2 2023', 'November 24 2023', 'Yes', 12000, '', '', 'image.png', 'confirmed', '2023-11-03 12:25:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `reservation_report`
--

CREATE TABLE `reservation_report` (
  `report_id` int(11) NOT NULL,
  `retreat_id` int(11) NOT NULL,
  `recollection_id` int(11) NOT NULL,
  `reception_id` int(11) NOT NULL,
  `training_id` int(11) NOT NULL,
  `seminar_id` int(11) NOT NULL,
  `report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `retreat_reservation_record`
--

CREATE TABLE `retreat_reservation_record` (
  `retreat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `guest_count` int(11) NOT NULL,
  `check_in` varchar(1000) NOT NULL,
  `check_out` varchar(1000) NOT NULL,
  `room_type` enum('Casa Maria','Lunduyan','Attic') NOT NULL,
  `catering` enum('Yes','No') NOT NULL,
  `price` float NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `payment_option` enum('pay_full','pay_half') DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retreat_reservation_record`
--

INSERT INTO `retreat_reservation_record` (`retreat_id`, `user_id`, `first_name`, `last_name`, `street_add`, `city_municipality`, `province`, `postal_code`, `contact_no`, `guest_count`, `check_in`, `check_out`, `room_type`, `catering`, `price`, `payment_method`, `payment_option`, `proof_of_payment`, `status`, `timestamp`, `is_read`) VALUES
(1, 10005, 'Jose', 'Rizal', 'Test Address', 'Dunno hehe', 'Masbate', 2123, '09123345678', 5, 'November 3 2023', 'November 6 2023', 'Lunduyan', 'No', 12000, 'GCash', 'pay_half', 'images', 'confirmed', '2023-11-04 13:03:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales_report`
--

CREATE TABLE `sales_report` (
  `sales_report_id` int(11) NOT NULL,
  `report_id` int(11) NOT NULL,
  `total_sales` float NOT NULL,
  `sales_report_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `seminar_reservation_record`
--

CREATE TABLE `seminar_reservation_record` (
  `seminar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `guest_count` int(11) NOT NULL,
  `check_in` varchar(1000) NOT NULL,
  `check_out` varchar(1000) NOT NULL,
  `catering` enum('Yes','No') NOT NULL,
  `price` float NOT NULL,
  `payment_method` enum('Pay-on_Site','GCash') NOT NULL,
  `payment_option` enum('Pay Full','Pay half') DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `seminar_reservation_record`
--

INSERT INTO `seminar_reservation_record` (`seminar_id`, `user_id`, `last_name`, `first_name`, `street_add`, `province`, `city_municipality`, `postal_code`, `contact_no`, `guest_count`, `check_in`, `check_out`, `catering`, `price`, `payment_method`, `payment_option`, `proof_of_payment`, `status`, `timestamp`, `is_read`) VALUES
(1, 10003, 'Villamin', 'Niña Gillian', 'National Road St.', 'Masbate', 'Dimasalang', 3243, '091234578604', 3, 'November 15 2023', 'October 24 2023', 'Yes', 14400, '', NULL, NULL, 'confirmed', '2023-11-03 12:29:54', 0);

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `price_range` varchar(255) NOT NULL,
  `img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `price_range`, `img_path`) VALUES
(1, 'Retreat', '800.00 - 1200.00', '../images/retreat_img.png'),
(2, 'Recollection', '400.00', '../images/recollection.jpg'),
(3, 'Reception', '8000.00', '../images/img17.jpg'),
(4, 'Training', '400.00', 'https://scontent.fmnl9-4.fna.fbcdn.net/v/t39.30808-6/313948058_135956659225210_1082207828745443346_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=5614bc&_nc_eui2=AeGtSeVctdF4HbjoB3D9ajg45UxqUpV4T4DlTGpSlXhPgGUcNfmR9E6d-xTtUDiZRL-vBOGzu21Hw__3GGoMuepv&_nc_ohc=_G67Wz7Kf'),
(5, 'Seminar', '400.00', '../images/seminar_pic.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `service_descriptions`
--

CREATE TABLE `service_descriptions` (
  `service_id` int(11) DEFAULT NULL,
  `description_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `service_descriptions`
--

INSERT INTO `service_descriptions` (`service_id`, `description_id`) VALUES
(1, 3),
(1, 1),
(1, 6),
(2, 3),
(2, 1),
(3, 4),
(3, 5),
(4, 4),
(4, 1),
(4, 2),
(5, 3),
(5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `training_reservation_record`
--

CREATE TABLE `training_reservation_record` (
  `training_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `street_add` varchar(255) NOT NULL,
  `city_municipality` varchar(255) NOT NULL,
  `province` varchar(255) NOT NULL,
  `postal_code` int(4) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `check_in` varchar(1000) NOT NULL,
  `check_out` varchar(1000) NOT NULL,
  `catering` enum('Yes','No') NOT NULL,
  `price` float NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `payment_option` enum('Pay Full','Pay Half') DEFAULT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `reportId` int(11) NOT NULL,
  `status` enum('pending','confirmed','cancelled','') NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(5) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`) VALUES
(10001, 'Nina Gillian', 'Villamin', 'nin@mail.com', '$2y$10$xkv9QC.aL5iHYrygOUoOT.zTYETdKlzaVUdIUUNCR8ueP7ZLCwbXe'),
(10002, 'Satoru', 'Gojo', 'gojo@email.com', '$2y$10$2n61M2RneGq9n8K5.v2H/uiZmcQYtfUR/3kb9eU8s9ubdjhzAXhlC'),
(10003, 'Crissa', 'Olavario', 'crissa@email.com', '$2y$10$tkD/QbBiSwaMZJJo6eQ8XOS9PP30c7lLut3D5N1PsG6TBIidxORFO'),
(10005, 'Enn', 'Numi', 'numinum1128@gmail.com', '$2y$10$zZ00VRhHPA7M1z2do.g4ue9Ze0U666LZm0tXNzEYk0REINIOFuBOK'),
(10006, 'Mafuyu', 'Asaina', 'mafuyu@gmail.com', '$2y$10$oFNQRVU1DyW4X0k2dmBxa.qK34UBzziv7BFALIY/f9lfz8qzoymHK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `amenities`
--
ALTER TABLE `amenities`
  ADD PRIMARY KEY (`amenity_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `announcement_comment`
--
ALTER TABLE `announcement_comment`
  ADD PRIMARY KEY (`announcement_comment_id`);

--
-- Indexes for table `announcement_image`
--
ALTER TABLE `announcement_image`
  ADD PRIMARY KEY (`announce_img_id`),
  ADD KEY `announcement_image_ibfk_1` (`announcement_id`);

--
-- Indexes for table `appoinment_report`
--
ALTER TABLE `appoinment_report`
  ADD PRIMARY KEY (`appoint_report_id`),
  ADD KEY `appoint_id` (`appoint_id`);

--
-- Indexes for table `appointment_availability`
--
ALTER TABLE `appointment_availability`
  ADD PRIMARY KEY (`available_appoint_id`);

--
-- Indexes for table `appointment_record`
--
ALTER TABLE `appointment_record`
  ADD PRIMARY KEY (`appoint_id`),
  ADD KEY `appoinment_record_ibfk_1` (`user_id`);

--
-- Indexes for table `assistant_manager`
--
ALTER TABLE `assistant_manager`
  ADD PRIMARY KEY (`asst_id`);

--
-- Indexes for table `cancellation_report`
--
ALTER TABLE `cancellation_report`
  ADD PRIMARY KEY (`cancellation_id`),
  ADD KEY `appoint_id` (`appoint_id`),
  ADD KEY `reservation_id` (`retreat_id`),
  ADD KEY `recollection_id2` (`recollection_id`),
  ADD KEY `reception_id2` (`reception_id`),
  ADD KEY `seminar_id2` (`seminar_id`),
  ADD KEY `training_id2` (`training_id`);

--
-- Indexes for table `category_descriptions`
--
ALTER TABLE `category_descriptions`
  ADD PRIMARY KEY (`description_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `meals`
--
ALTER TABLE `meals`
  ADD PRIMARY KEY (`meal_id`);

--
-- Indexes for table `meal_category`
--
ALTER TABLE `meal_category`
  ADD PRIMARY KEY (`mealCat_id`);

--
-- Indexes for table `meal_sets`
--
ALTER TABLE `meal_sets`
  ADD KEY `mealCat_id` (`mealCat_id`),
  ADD KEY `meal_id` (`meal_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`package_id`);

--
-- Indexes for table `package_amenities`
--
ALTER TABLE `package_amenities`
  ADD KEY `package_id` (`package_id`),
  ADD KEY `amenity_id` (`amenity_id`);

--
-- Indexes for table `product_details`
--
ALTER TABLE `product_details`
  ADD PRIMARY KEY (`prod_id`);

--
-- Indexes for table `reception_reservation_record`
--
ALTER TABLE `reception_reservation_record`
  ADD PRIMARY KEY (`reception_id`),
  ADD KEY `user_id4` (`user_id`);

--
-- Indexes for table `recollection_reservation_record`
--
ALTER TABLE `recollection_reservation_record`
  ADD PRIMARY KEY (`recollection_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `reservation_report`
--
ALTER TABLE `reservation_report`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `retreat_id` (`retreat_id`),
  ADD KEY `recollection_id` (`recollection_id`),
  ADD KEY `seminar_id` (`seminar_id`),
  ADD KEY `training_id` (`training_id`),
  ADD KEY `reception_id` (`reception_id`);

--
-- Indexes for table `retreat_reservation_record`
--
ALTER TABLE `retreat_reservation_record`
  ADD PRIMARY KEY (`retreat_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD PRIMARY KEY (`sales_report_id`),
  ADD KEY `reserve_id` (`report_id`);

--
-- Indexes for table `seminar_reservation_record`
--
ALTER TABLE `seminar_reservation_record`
  ADD PRIMARY KEY (`seminar_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `service_descriptions`
--
ALTER TABLE `service_descriptions`
  ADD KEY `service_id` (`service_id`),
  ADD KEY `description_ID` (`description_id`);

--
-- Indexes for table `training_reservation_record`
--
ALTER TABLE `training_reservation_record`
  ADD PRIMARY KEY (`training_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `reportId` (`reportId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `announcement_comment`
--
ALTER TABLE `announcement_comment`
  MODIFY `announcement_comment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `announcement_image`
--
ALTER TABLE `announcement_image`
  MODIFY `announce_img_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appoinment_report`
--
ALTER TABLE `appoinment_report`
  MODIFY `appoint_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `appointment_availability`
--
ALTER TABLE `appointment_availability`
  MODIFY `available_appoint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `appointment_record`
--
ALTER TABLE `appointment_record`
  MODIFY `appoint_id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1010;

--
-- AUTO_INCREMENT for table `assistant_manager`
--
ALTER TABLE `assistant_manager`
  MODIFY `asst_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cancellation_report`
--
ALTER TABLE `cancellation_report`
  MODIFY `cancellation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `category_descriptions`
--
ALTER TABLE `category_descriptions`
  MODIFY `description_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meals`
--
ALTER TABLE `meals`
  MODIFY `meal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `meal_category`
--
ALTER TABLE `meal_category`
  MODIFY `mealCat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_details`
--
ALTER TABLE `product_details`
  MODIFY `prod_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reception_reservation_record`
--
ALTER TABLE `reception_reservation_record`
  MODIFY `reception_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `recollection_reservation_record`
--
ALTER TABLE `recollection_reservation_record`
  MODIFY `recollection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `reservation_report`
--
ALTER TABLE `reservation_report`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `retreat_reservation_record`
--
ALTER TABLE `retreat_reservation_record`
  MODIFY `retreat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sales_report`
--
ALTER TABLE `sales_report`
  MODIFY `sales_report_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `seminar_reservation_record`
--
ALTER TABLE `seminar_reservation_record`
  MODIFY `seminar_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `training_reservation_record`
--
ALTER TABLE `training_reservation_record`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10007;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `announcement_image`
--
ALTER TABLE `announcement_image`
  ADD CONSTRAINT `announcement_image_ibfk_1` FOREIGN KEY (`announcement_id`) REFERENCES `announcements` (`announcement_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `appoinment_report`
--
ALTER TABLE `appoinment_report`
  ADD CONSTRAINT `appoint_id2` FOREIGN KEY (`appoint_id`) REFERENCES `appointment_record` (`appoint_id`) ON UPDATE CASCADE;

--
-- Constraints for table `appointment_record`
--
ALTER TABLE `appointment_record`
  ADD CONSTRAINT `user_id5` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `cancellation_report`
--
ALTER TABLE `cancellation_report`
  ADD CONSTRAINT `appoint_id` FOREIGN KEY (`appoint_id`) REFERENCES `appointment_record` (`appoint_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reception_id2` FOREIGN KEY (`reception_id`) REFERENCES `reception_reservation_record` (`reception_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `recollection_id2` FOREIGN KEY (`recollection_id`) REFERENCES `recollection_reservation_record` (`recollection_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `retreat_id2` FOREIGN KEY (`retreat_id`) REFERENCES `retreat_reservation_record` (`retreat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_id2` FOREIGN KEY (`seminar_id`) REFERENCES `seminar_reservation_record` (`seminar_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `training_id2` FOREIGN KEY (`training_id`) REFERENCES `training_reservation_record` (`training_id`) ON UPDATE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `user_id7` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `reception_reservation_record`
--
ALTER TABLE `reception_reservation_record`
  ADD CONSTRAINT `user_id4` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `reservation_report`
--
ALTER TABLE `reservation_report`
  ADD CONSTRAINT `reception_id` FOREIGN KEY (`reception_id`) REFERENCES `reception_reservation_record` (`reception_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `recollection_id` FOREIGN KEY (`recollection_id`) REFERENCES `recollection_reservation_record` (`recollection_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `retreat_id` FOREIGN KEY (`retreat_id`) REFERENCES `retreat_reservation_record` (`retreat_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `seminar_id` FOREIGN KEY (`seminar_id`) REFERENCES `seminar_reservation_record` (`seminar_id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `training_id` FOREIGN KEY (`training_id`) REFERENCES `training_reservation_record` (`training_id`) ON UPDATE CASCADE;

--
-- Constraints for table `retreat_reservation_record`
--
ALTER TABLE `retreat_reservation_record`
  ADD CONSTRAINT `user_id2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD CONSTRAINT `report_id` FOREIGN KEY (`report_id`) REFERENCES `reservation_report` (`report_id`) ON UPDATE CASCADE;

--
-- Constraints for table `seminar_reservation_record`
--
ALTER TABLE `seminar_reservation_record`
  ADD CONSTRAINT `user_id1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
