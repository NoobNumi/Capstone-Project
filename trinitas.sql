-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 09:02 AM
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
(2, '9 Single Beds/Room', 'fa-solid fa-bed'),
(3, '2 Single Beds in 3 Rooms', 'fa-solid fa-bed'),
(4, '1 Single Bed (1 Room)', 'fa-solid fa-bed'),
(5, 'Aircon', 'fa-solid fa-wind'),
(6, 'Electric Fan', 'fa-solid fa-fan'),
(7, 'Chapel Venue', 'fa-solid fa-church'),
(8, 'Trinitas Venue', 'fa-solid fa-church'),
(9, 'Comfort Room', 'fa-solid fa-restroom'),
(10, 'Owned Restroom', 'fa-solid fa-restroom'),
(11, '50-100 Persons', 'fa-solid fa-people-group'),
(12, '50-70 Persons', 'fa-solid fa-people-group'),
(13, 'Free Parking', 'fa-solid fa-car-side'),
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
  `is_admin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcement_id`, `post_content`, `timestamp`, `is_admin`) VALUES
(3, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quam, ipsum facere. Nobis molestias, quisquam mollitia atque delectus, iusto eius excepturi, eos iure dignissimos repudiandae. Libero quia dolorum dolore maxime molestias.\r\n\r\n        Lorem ipsum dolor, sit amet consectetur adipisicing elit. Similique esse in error sed laboriosam repudiandae eveniet tenetur itaque incidunt illo pariatur, facere aliquam mollitia, vitae corrupti perferendis quod laborum obcaecam Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quod repellendus repellat qui eum. Quasi vel a ex omnis nesciunt accusantium animi, eaque earum possimus facilis, consectetur exercitationem obcaecati consequatur maxime?', '2023-11-23 06:36:39', 1),
(6, 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Natus deserunt error quidem sunt repellat nulla consequuntur minima nostrum, molestiae facilis voluptatibus ullam reprehenderit repellendus, animi aliquid! Saepe iure veritatis obcaecati.', '2023-11-23 06:35:29', 0),
(7, '\"Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?\"', '2023-11-23 07:03:13', 0);

-- --------------------------------------------------------

--
-- Table structure for table `announcement_image`
--

CREATE TABLE `announcement_image` (
  `announce_img_id` int(11) NOT NULL,
  `announcement_id` int(11) NOT NULL,
  `img_url_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `announcement_image`
--

INSERT INTO `announcement_image` (`announce_img_id`, `announcement_id`, `img_url_path`) VALUES
(4, 3, '../uploads/Screenshot 2023-09-29 213004.png'),
(8, 6, '../uploads/Screenshot 2023-10-18 214535.png'),
(18, 7, '../uploads/lockscreen.jpg'),
(19, 7, '../uploads/Gravity falls.jpg');

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
-- Table structure for table `appointment_record`
--

CREATE TABLE `appointment_record` (
  `appoint_id` int(4) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `appoint_sched_date` varchar(100) NOT NULL,
  `appoint_sched_time` varchar(1000) NOT NULL,
  `appoint_description` text NOT NULL,
  `appoint_status` enum('pending','confirmed','cancelled') NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  `is_read_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_record`
--

INSERT INTO `appointment_record` (`appoint_id`, `user_id`, `first_name`, `last_name`, `contact_no`, `appoint_sched_date`, `appoint_sched_time`, `appoint_description`, `appoint_status`, `timestamp`, `is_read`, `is_read_user`) VALUES
(1, 10005, 'Enn', 'Numi', '09123456789', 'November 23 2023', '4:00 PM', 'hehe', 'confirmed', '2023-11-28 13:02:53', 0, 1),
(2, 10005, 'Juan', 'Dela Cruz', '09123443232', 'February 02 2024', '4:00 PM', 'updated appointment date', 'cancelled', '2023-11-29 15:17:24', 1, 0),
(3, 10005, 'Enn', 'Numi', '09123456789', 'December 30 2023', '4:00 PM', 'This is for testing purposes only. ', 'confirmed', '2023-12-01 01:18:08', 1, 1),
(4, 10005, 'Enn', 'Numi', '09123456789', 'December 30 2023', '4:00 PM', 'hehehehhee', 'confirmed', '2023-12-01 01:22:14', 1, 1),
(5, 10005, 'Enn', 'Numi', '0912345677889', 'December 30 2023', '4:00 PM', 'hays', 'confirmed', '2023-12-01 01:26:17', 1, 1),
(6, 10005, 'Taylor', 'Swift', '123', 'February  9 2024', '4:00 PM', 'Updated datesssssss ulit', 'pending', '2023-12-01 02:04:00', 0, 0),
(7, 10005, 'Enn', 'Numi', '09123456789', 'December 30 2023', '4:00 PM', 'hehe', 'pending', '2023-12-01 02:09:15', 0, 0),
(8, 10005, 'Enn', 'Numi', '09123456789', 'December 22 2023', '4:00 PM', 'testing ulit', 'pending', '2023-12-01 02:12:09', 1, 0),
(9, 10005, 'Enn', 'Numi', '09123456789', 'December 22 2023', '4:00 PM', 'hays pang ilan na to', 'pending', '2023-12-01 02:13:14', 0, 0),
(10, 10005, 'Enn', 'Numi', '09123456789', 'December 31 2023', '4:00 PM', '10th test', 'cancelled', '2023-12-01 02:15:13', 0, 1),
(11, 10005, 'Enn', 'Numi', '09123455667', 'December 06 2023', '4:00 PM', 'pang 11th na ini jusko', 'pending', '2023-12-01 02:24:15', 1, 0),
(12, 10005, 'Enn', 'Numi', '09123456789', 'December 14 2023', '4:00 PM', 'hehe', 'pending', '2023-12-01 02:32:55', 1, 0),
(13, 10005, 'Enn', 'Numi', '09123456789', 'December 21 2023', '4:00 PM', '12th ', 'pending', '2023-12-01 02:38:32', 0, 0),
(14, 10005, 'Enn', 'Numi', '09123456789', 'December 22 2023', '4:00 PM', 'omagaaad', 'pending', '2023-12-01 02:39:45', 0, 0),
(15, 10005, 'Enn', 'Numi', '09123456789', 'December 14 2023', '4:00 PM', 'aaaaaaa', 'pending', '2023-12-01 02:40:29', 0, 0),
(16, 10005, 'Enn', 'Numi', '09123456789', 'December 23 2023', '4:00 PM', '14th test', 'pending', '2023-12-01 02:41:19', 0, 0),
(17, 10005, 'Enn', 'Numi', '09123456789', 'December 17 2023', '4:00 PM', 'heh', 'pending', '2023-12-01 02:41:50', 0, 0),
(18, 10005, 'Enn', 'Numi', '0912345677889', 'December 22 2023', '4:00 PM', '15th test', 'confirmed', '2023-12-01 02:43:42', 1, 0),
(19, 10005, 'Enn', 'Numi', '09123456789', 'December 23 2023', '4:00 PM', '17th test', 'confirmed', '2023-12-01 02:44:29', 1, 0),
(20, 10005, 'Enn', 'Numi', '0912345677889', 'December 28 2023', '4:00 PM', '18th test', 'pending', '2023-12-01 02:45:16', 1, 0),
(21, 10005, 'Enn', 'Numi', '09123456789', 'December 26 2023', '4:00 PM', 'huhu', 'confirmed', '2023-12-04 01:18:53', 1, 1),
(22, 10005, 'Enn', 'Numi', '09123456789', 'December 21 2023', '4:00 PM', 'hehehehehehehehhe 19th time na pls lang', 'pending', '2023-12-01 12:54:01', 1, 0),
(23, 10005, 'Enn', 'Numi', '09123456789', 'December 6 2023', '4:00 PM', 'hehehehehehheheheheheeheheheheh 20th na', 'confirmed', '2023-12-01 14:58:35', 1, 1),
(24, 10005, 'Enn', 'Numi', '09123456789', 'December 2 2023', '4:00 PM', 'ulitt huhuhuhuhu', 'confirmed', '2023-12-01 02:59:54', 1, 1),
(25, 10005, 'Enn', 'Numi', '09123456789', 'December 25 2023', '4:00 PM', 'heheheheheheh', 'pending', '2023-12-01 03:00:38', 1, 0),
(26, 10005, 'Enn', 'Numi', '09123456789', 'December 20, 2023', '4:00 PM', 'This is for testing purposes only', 'confirmed', '2023-12-04 01:15:33', 1, 0),
(27, 10005, 'Enn', 'Numi', '09123456789', 'January 06, 2024', '4:00 PM', 'making appointment rn', 'confirmed', '2023-12-04 01:15:03', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `appointment_unavailability`
--

CREATE TABLE `appointment_unavailability` (
  `unavailable_appoint_id` int(11) NOT NULL,
  `date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment_unavailability`
--

INSERT INTO `appointment_unavailability` (`unavailable_appoint_id`, `date`) VALUES
(1, 'December 01, 2023'),
(2, 'December 02, 2023'),
(3, 'December 03, 2023'),
(4, 'January 01, 2024'),
(5, 'January 02, 2024'),
(6, 'January 09, 2024'),
(7, 'November 20, 2023'),
(8, 'November 21, 2023'),
(9, 'November 22, 2023'),
(10, 'December 17, 2023'),
(11, 'December 18, 2023'),
(12, 'December 19, 2023'),
(13, 'November 27, 2023'),
(14, 'November 28, 2023'),
(15, 'November 29, 2023'),
(16, 'January 25, 2024'),
(17, 'January 26, 2024'),
(18, 'January 04, 2024'),
(19, 'January 05, 2024'),
(20, 'January 19, 2024'),
(21, 'January 16, 2024'),
(22, 'January 17, 2024'),
(23, 'January 18, 2024'),
(24, 'December 10, 2023'),
(25, 'December 11, 2023'),
(26, 'December 12, 2023'),
(27, 'February 21, 2024'),
(28, 'February 22, 2024'),
(29, 'February 23, 2024'),
(30, 'February 24, 2024'),
(31, 'February 25, 2024'),
(32, 'February 26, 2024'),
(33, 'February 27, 2024'),
(34, 'February 28, 2024');

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
-- Table structure for table `available_reservation_dates`
--

CREATE TABLE `available_reservation_dates` (
  `available_reserve_id` int(11) NOT NULL,
  `available_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `available_reservation_dates`
--

INSERT INTO `available_reservation_dates` (`available_reserve_id`, `available_date`) VALUES
(1, 'December 27, 2023'),
(2, 'December 28, 2023'),
(3, 'December 29, 2023'),
(4, 'February 14, 2024'),
(5, 'February 15, 2024'),
(6, 'February 16, 2024'),
(7, 'February 25, 2024'),
(8, 'February 29, 2024'),
(9, 'February 28, 2024'),
(10, 'February 27, 2024'),
(11, 'February 26, 2024'),
(13, 'January 30, 2024');

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
-- Table structure for table `chart`
--

CREATE TABLE `chart` (
  `id` int(11) NOT NULL,
  `count` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chart`
--

INSERT INTO `chart` (`id`, `count`, `type`) VALUES
(1, '21', 'Retreat'),
(2, '', 'Seminar'),
(3, '10', 'Reception'),
(4, '3', 'Recollection'),
(5, '', 'Training');

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
(9, 10005, 'Enn Numi', 'This is for testing purposes only', '5', '0', '2023-12-10 21:29:58'),
(10, 10002, 'Satoru Gojo', 'HEHEHEHEHEHEHEH', '5', '0', '2023-12-10 21:35:49'),
(11, 10005, 'Enn Numi', 'test', '4', '0', '2023-12-10 22:15:42'),
(12, 10002, 'Satoru Gojo', 'medyo buggy', '2', '1', '2023-12-10 22:36:42');

-- --------------------------------------------------------

--
-- Table structure for table `meals`
--

CREATE TABLE `meals` (
  `meal_id` int(11) NOT NULL,
  `meal_name` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `meal_img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meals`
--

INSERT INTO `meals` (`meal_id`, `meal_name`, `type`, `meal_img_path`) VALUES
(2, 'Crab and Corn Soup', 'breakfast', '../images/Meal_Photos/Breakfast/BF_Crab_Corn.jpg'),
(3, 'Egg Soup', 'breakfast', '../images/Meal_Photos/Breakfast/BF_Egg_Soup.jpg'),
(4, 'Italian Pasta', 'breakfast', '../images/Meal_Photos/Breakfast/BF_Italian Pasta.jpg'),
(5, 'Pesto Pasta', 'breakfast', '../images/Meal_Photos/Breakfast/BF_Pesto_Pasta.jpg'),
(6, 'Tuna Pasta', 'breakfast', '../images/Meal_Photos/Breakfast/BF_Tuna_Pasta.jpg'),
(7, 'Pork Barbeque', 'ld', '../images/Meal_Photos/Lunch_Dinner/PorkBBQ.jpg'),
(8, 'Pork Stir Fry with Mushroom', 'ld', '../images/Meal_Photos/Lunch_Dinner/PorkStirwMushroom.jpg'),
(10, 'Honey Glazed Chicken', 'ld', '../images/Meal_Photos/Lunch_Dinner/HoneyGlazedChicken.jpg'),
(11, 'Korean Chicken with Sesame Seeds', 'ld', '../images/Meal_Photos/Lunch_Dinner/LD_KoreanwSesame.jpg'),
(13, 'Fish Fillet with White Sauce', 'ld', '../images/Meal_Photos/Lunch_Dinner/LD_fish_whiteSouce.jpg'),
(17, 'Mixed Vegetables with Butter', 'ld', '../images/Meal_Photos/Lunch_Dinner/LD_MixedVegiesWButter.jpg'),
(18, 'Stir Fry Mixed Vegetables with Oyster Sauce', 'ld', '../images/Meal_Photos/Lunch_Dinner/MixedVegetableWOyster.jpg'),
(20, 'Mango Pudding', 'dessert', '../images/Meal_Photos/Dessert/DS_manggo_pudding.jpg'),
(23, 'Iced Tea', 'drinks', '../images/Meal_Photos/Drinks/DK_Iced_tea.jpg'),
(25, 'Tapioca', 'dessert', '../uploads/DS_Tapioca2.jpg'),
(27, 'Lumpiang', 'ld', '../uploads/LD_Lumpia.jpg'),
(29, 'Cucumber Lemonade', 'drinks', '../uploads/CucumberLemonade.jpeg'),
(30, 'Chopsuey', 'ld', '../uploads/Chopsuey.jpg'),
(31, 'Fish Fillet with Lemon', 'ld', '../uploads/LD_FishwLemon.jpg'),
(32, 'Sweet and sour fish', 'ld', '../uploads/6543cc8f3953d_LD_FishSweetSour.jpg'),
(40, 'Buko Pandan', 'dessert', '../uploads/654418eaa2d3f_DS_Buko_Pandan.jpg');

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
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(2, 7),
(2, 8),
(2, 9),
(2, 10),
(2, 11),
(2, 12),
(2, 13),
(2, 14),
(2, 15),
(2, 16),
(2, 17),
(2, 18),
(2, 19),
(3, 7),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 12),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(4, 23),
(4, 24),
(4, 20),
(5, 21),
(5, 22);

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
(129, 1, 10002, 'aG95', '', '2023-10-01 15:00:23', 1, 1),
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
(155, 10006, 1, 'dGhueA==', '', '2023-11-03 09:28:28', 1, 0),
(156, 10007, 1, 'c2FtcGxl', '', '2023-11-06 03:29:54', 1, 0),
(157, 10007, 1, 'YWFhYQ==', '', '2023-11-08 05:47:27', 1, 0),
(158, 1, 10008, 'VGVzdGluZw==', '', '2023-11-20 12:18:16', 1, 1),
(159, 1, 10008, 'SGVubG9v', '', '2023-11-20 12:20:55', 1, 1),
(317, 1, 10008, 'dGVzdA==', '', '2023-11-20 12:25:42', 1, 1),
(318, 1, 10008, 'aG95', '', '2023-11-20 12:29:38', 1, 1),
(319, 10008, 1, 'SGVsbG8=', '', '2023-11-20 12:41:47', 1, 0),
(320, 1, 10002, 'dGVzdGluZw==', '', '2023-11-25 08:17:43', 1, 1),
(321, 10002, 1, 'd2hhdD8=', '', '2023-11-25 08:18:02', 1, 0),
(322, 1, 10002, 'dGVlc3Rpbmcg', '', '2023-11-25 08:20:54', 1, 1),
(323, 10005, 1, 'V2VoPw==', '', '2023-12-01 02:10:15', 1, 0),
(324, 1, 10005, 'a2psamxr', '', '2023-12-01 06:42:51', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `package_id` int(11) NOT NULL,
  `service_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `type` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`package_id`, `service_id`, `name`, `price`, `type`, `description`, `image_path`) VALUES
(1, 1, 'Casa Maria Retreat Package', 1300.00, 'retreat', 'Food and Accommodation', '/images/casaMariaPackage.png'),
(2, 1, 'Lunduyan Retreat Package', 900.00, 'retreat', 'Food and Accommodation', '/images/lunduyanPackage.png'),
(3, 2, 'Recollection Package', 400.00, 'recollection', 'Food and Accommodation &\nNo Overnight', '/images/recollection_package.png'),
(4, 3, 'Catering Package', 8000.00, 'reception', 'Additional 450.00 per Head for Cater', '/images/catering_package.png'),
(5, 3, 'Venue-Only Package', 8000.00, 'reception', 'Accommodation', '/images/venue_package.png'),
(6, 4, 'Training Package', 400.00, 'training', 'Food and Accommodation &\nNo Overnight', '/images/training_package.png'),
(7, 5, 'Seminar Package', 400.00, 'seminar', 'Food and Accommodation &\nNo Overnight', '/images/seminar_package.png');

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
-- Table structure for table `package_images`
--

CREATE TABLE `package_images` (
  `image_id` int(11) NOT NULL,
  `image_path` text NOT NULL,
  `package_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `package_images`
--

INSERT INTO `package_images` (`image_id`, `image_path`, `package_id`) VALUES
(1, '/images/CasaMariaPackage_Img/casamaria_main.jpg', 1),
(2, '/images/CasaMariaPackage_Img/casamaria_minilounge1.jpg', 1),
(3, '/images/CasaMariaPackage_Img/casamaria_rooms.jpg', 1),
(4, '/images/CasaMariaPackage_Img/casamaria_roomview1.jpg', 1),
(5, '/images/CasaMariaPackage_Img/casamaria_roomview2.jpg', 1),
(6, '/images/CasaMariaPackage_Img/casamaria_roomview3.jpg', 1),
(7, '/images/CasaMariaPackage_Img/casamaria_roomview4.jpg', 1),
(9, '/images/CasaMariaPackage_Img/casamaria_amenity1.jpg\"', 1),
(10, '/images/CasaMariaPackage_Img/casamaria_roomview7.jpg', 1),
(11, '/images/CasaMariaPackage_Img/casamaria_roomview8.jpg', 1),
(12, '/images/CasaMariaPackage_Img/casamaria_bedroom.jpg', 1),
(13, '/images/CasaMariaPackage_Img/casamaria_bed1.jpg', 1),
(14, '/images/CasaMariaPackage_Img/casamaria_bed2.jpg', 1),
(15, '/images/CasaMariaPackage_Img/casamaria_bed3.jpg', 1),
(16, '/images/CasaMariaPackage_Img/casamaria_bed4.jpg', 1),
(17, '/images/CasaMariaPackage_Img/casamaria_bed5.jpg', 1),
(18, '/images/CasaMariaPackage_Img/casamaria_bed6.jpg', 1),
(19, '/images/CasaMariaPackage_Img/casamaria_bed7.jpg', 1),
(20, '/images/CasaMariaPackage_Img/casamaria_bed8.jpg', 1),
(21, '/images/LunduyanPackage_Img/lunduyan_main.jpg', 2),
(22, '/images/LunduyanPackage_Img/lunduyan_blg.jpg', 2),
(23, '/images/LunduyanPackage_Img/lunduyan.jpg', 2),
(24, '/images/LunduyanPackage_Img/lunduyan_room1.jpg', 2),
(25, '/images/LunduyanPackage_Img/lunduyan_room2.jpg', 2),
(26, '/images/LunduyanPackage_Img/lunduyan_room3.jpg', 2),
(27, '/images/LunduyanPackage_Img/lunduyan_room4.jpg', 2),
(28, '/images/LunduyanPackage_Img/lunduyan_room5.jpg', 2),
(29, '/images/LunduyanPackage_Img/lunduyan_strafaelroom.jpg', 2),
(30, '/images/LunduyanPackage_Img/lunduyan_strafaelroom0.jpg', 2),
(31, '/images/LunduyanPackage_Img/lunduyan_strafaelroom1.jpg', 2),
(32, '/images/LunduyanPackage_Img/lunduyan_strafaelroom2.jpg', 2),
(33, '/images/LunduyanPackage_Img/lunduyan_strafaelroom3.jpg', 2),
(39, '/images/Package_Img/trinitasVenue.jpg', 4),
(40, '/images/Package_Img/trinitasVenue1.jpg', 4),
(41, '/images/Package_Img/trinitasVenue2.jpg', 4),
(42, '/images/Package_Img/trinitasVenue3.jpg', 4),
(43, '/images/Package_Img/trinitasVenue4.jpg', 4),
(44, '/images/Package_Img/trinitasVenue5.jpg', 4),
(45, '/images/Package_Img/trinitasVenue6.jpg', 4),
(46, '/images/Package_Img/trinitasVenue7.jpg', 4),
(47, '/images/Package_Img/trinitasVenue.jpg', 5),
(48, '/images/Package_Img/trinitasVenue1.jpg', 5),
(49, '/images/Package_Img/trinitasVenue2.jpg', 5),
(50, '/images/Package_Img/trinitasVenue3.jpg', 5),
(51, '/images/Package_Img/trinitasVenue4.jpg', 5),
(52, '/images/Package_Img/trinitasVenue5.jpg', 5),
(53, '/images/Package_Img/trinitasVenue6.jpg', 5),
(54, '/images/Package_Img/trinitasVenue7.jpg', 5),
(55, '/images/Package_Img/trinitasVenue.jpg', 6),
(56, '/images/Package_Img/trinitasVenue1.jpg', 6),
(57, '/images/Package_Img/trinitasVenue2.jpg', 6),
(58, '/images/Package_Img/trinitasVenue3.jpg', 6),
(59, '/images/Package_Img/trinitasVenue4.jpg', 6),
(60, '/images/Package_Img/trinitasVenue5.jpg', 6),
(61, '/images/Package_Img/trinitasVenue6.jpg', 6),
(62, '/images/Package_Img/trinitasVenue7.jpg', 6),
(63, '/images/Package_Img/trinitasVenue.jpg', 7),
(64, '/images/Package_Img/trinitasVenue1.jpg', 7),
(65, '/images/Package_Img/trinitasVenue2.jpg', 7),
(66, '/images/Package_Img/trinitasVenue3.jpg', 7),
(67, '/images/Package_Img/trinitasVenue4.jpg', 7),
(68, '/images/Package_Img/trinitasVenue5.jpg', 7),
(69, '/images/Package_Img/trinitasVenue6.jpg', 7),
(70, '/images/Package_Img/trinitasVenue7.jpg', 7);

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
  `contact_no` varchar(255) NOT NULL,
  `guest` varchar(255) NOT NULL,
  `check_in` varchar(1000) NOT NULL,
  `check_out` varchar(1000) NOT NULL,
  `package` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `transaction_num` varchar(15) NOT NULL,
  `breakfast` varchar(100) NOT NULL,
  `lunch` varchar(100) NOT NULL,
  `dinner` varchar(100) NOT NULL,
  `dessert` varchar(100) NOT NULL,
  `drinks` varchar(100) NOT NULL,
  `total` varchar(50) NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','') NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  `is_read_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reception_reservation_record`
--

INSERT INTO `reception_reservation_record` (`reception_id`, `user_id`, `first_name`, `last_name`, `contact_no`, `guest`, `check_in`, `check_out`, `package`, `type`, `price`, `transaction_num`, `breakfast`, `lunch`, `dinner`, `dessert`, `drinks`, `total`, `payment_method`, `proof_of_payment`, `status`, `timestamp`, `is_read`, `is_read_user`) VALUES
(1, 10005, 'Enn', 'Numi', '12343223425', '12', 'January 9 2024', 'January 13 2024', 'Catering Package', 'reception', 8000, 'XRLEV42106', 'Pork Barbeque', 'Pork Stir Fry with Mushroom', 'Honey Glazed Chicken', 'Mango Pudding', 'Iced Tea', '384000', 'Pay-on-Site', '', 'confirmed', '2023-12-03 16:00:00', 1, 0),
(2, 10005, 'Enn', 'Numi', '08903244235', '12', 'April 16 2024', 'May 22 2024', 'Catering Package', 'reception', 8000, 'DVXEK36807', 'Pork Barbeque', 'Pork Stir Fry with Mushroom', 'Honey Glazed Chicken', 'Mango Pudding', 'Iced Tea', '3456000', 'GCash', 'wallpaper.png', 'confirmed', '2023-12-03 16:00:00', 1, 1),
(3, 10005, 'Enn', 'Numi', '09123456789', '12', 'June 1 2024', 'June 4 2024', 'Venue-Only Package', 'reception', 8000, 'VHRWZ57260', 'Crab and Corn Soup', 'Pork Barbeque', 'Pork Barbeque', 'Mango Pudding', 'Iced Tea', '288000', 'Pay-on-Site', '', 'confirmed', '2023-12-06 09:58:40', 0, 0),
(4, 10005, 'Enn', 'Numi', '09123456789', '10', 'June 17 2024', 'June 21 2024', 'Catering Package', 'reception', 8000, 'PDLQG04318', 'Honey Glazed Chicken', 'Mixed Vegetables with Butter', 'Fish Fillet with White Sauce', 'Buko Pandan', 'Cucumber Lemonade', '320000', 'Pay-on-Site', '', 'cancelled', '2023-12-08 06:54:48', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `recollection_reservation_record`
--

CREATE TABLE `recollection_reservation_record` (
  `recollection_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `guest` varchar(255) NOT NULL,
  `check_in` varchar(1000) NOT NULL,
  `check_out` varchar(1000) NOT NULL,
  `package` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `transaction_num` varchar(15) NOT NULL,
  `breakfast` varchar(100) NOT NULL,
  `lunch` varchar(100) NOT NULL,
  `dinner` varchar(100) NOT NULL,
  `dessert` varchar(100) NOT NULL,
  `drinks` varchar(100) NOT NULL,
  `total` varchar(50) NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','') NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  `is_read_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `recollection_reservation_record`
--

INSERT INTO `recollection_reservation_record` (`recollection_id`, `user_id`, `first_name`, `last_name`, `contact_no`, `guest`, `check_in`, `check_out`, `package`, `type`, `price`, `transaction_num`, `breakfast`, `lunch`, `dinner`, `dessert`, `drinks`, `total`, `payment_method`, `proof_of_payment`, `status`, `timestamp`, `is_read`, `is_read_user`) VALUES
(1, 10005, 'Basta name', 'Numi', '0912423743565', '4', 'December 7 2023', 'December 8 2023', 'Recollection Package', 'recollection', 400, 'EJKGY15783', 'Egg Soup', 'Pork Stir Fry with Mushroom', 'Pork Barbeque', 'Tapioca', 'Cucumber Lemonade', '8000', 'GCash', 'Gravity falls.jpg', 'cancelled', '2023-12-01 12:17:17', 1, 1),
(2, 10005, 'this is a test', 'Numi', '123', '7', 'January 2 2024', 'January 5 2024', 'Recollection Package', 'recollection', 400, 'WTHNR37820', 'Pesto Pasta', 'Honey Glazed Chicken', 'Korean Chicken with Sesame Seeds', 'Tapioca', 'Cucumber Lemonade', '8400', 'Pay-on-Site', '', 'cancelled', '2023-12-07 10:40:43', 0, 0);

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
-- Table structure for table `reservation_unavailability`
--

CREATE TABLE `reservation_unavailability` (
  `unavailable_reservation_id` int(11) NOT NULL,
  `date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservation_unavailability`
--

INSERT INTO `reservation_unavailability` (`unavailable_reservation_id`, `date`) VALUES
(1, 'January 16, 2024'),
(2, 'January 17, 2024'),
(3, 'January 18, 2024'),
(4, 'December 04, 2023'),
(5, 'December 05, 2023'),
(6, 'December 06, 2023'),
(7, 'December 11, 2023'),
(8, 'December 12, 2023'),
(9, 'December 13, 2023'),
(10, 'January 01, 1970');

-- --------------------------------------------------------

--
-- Table structure for table `retreat_reservation_record`
--

CREATE TABLE `retreat_reservation_record` (
  `retreat_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `guest` varchar(255) NOT NULL,
  `check_in` varchar(1000) NOT NULL,
  `check_out` varchar(1000) NOT NULL,
  `package` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `transaction_num` varchar(15) NOT NULL,
  `breakfast` varchar(100) NOT NULL,
  `lunch` varchar(100) NOT NULL,
  `dinner` varchar(100) NOT NULL,
  `dessert` varchar(100) NOT NULL,
  `drinks` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','') NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  `is_read_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `retreat_reservation_record`
--

INSERT INTO `retreat_reservation_record` (`retreat_id`, `user_id`, `first_name`, `last_name`, `contact_no`, `guest`, `check_in`, `check_out`, `package`, `type`, `price`, `transaction_num`, `breakfast`, `lunch`, `dinner`, `dessert`, `drinks`, `total`, `payment_method`, `proof_of_payment`, `status`, `timestamp`, `is_read`, `is_read_user`) VALUES
(2, 10005, 'testing ', 'Numi', '09123456789', '10', 'December 21 2023', 'December 30 2023', 'Lunduyan Retreat Package', 'retreat', 900, 'UBTXQ73654', 'Pesto Pasta', 'Mixed Vegetables with Butter', 'Korean Chicken with Sesame Seeds', 'Tapioca', 'Cucumber Lemonade', '81000', 'Pay-on-Site', '', 'cancelled', '2023-12-01 00:32:23', 1, 1),
(3, 10005, 'Enn', 'Numi', '09123456789', '6', 'January 16 2023', 'January 18 2023', 'Casa Maria Retreat Package', 'retreat', 1300, 'UDJZK15084', 'Crab and Corn Soup', 'Pork Barbeque', 'Pork Barbeque', 'Mango Pudding', 'Iced Tea', '15600', 'Pay-on-Site', '', 'confirmed', '2023-12-02 18:03:23', 1, 1),
(5, 10005, 'Enn', 'Numi', '0912345677889', '5', 'January 24 2024', 'February 23 2024', 'Casa Maria Retreat Package', 'retreat', 1300, 'YWUEG45068', 'Crab and Corn Soup', 'Pork Barbeque', 'Pork Barbeque', 'Mango Pudding', 'Iced Tea', '195000', 'Pay-on-Site', '', 'confirmed', '2023-12-04 01:15:04', 1, 0),
(6, 10005, 'try', 'Numi', '09123456789', '12', 'March 11 2024', 'March 16 2024', 'Lunduyan Retreat Package', 'retreat', 900, 'CXMEJ86520', 'Egg Soup', 'Pork Barbeque', 'Pork Stir Fry with Mushroom', 'Tapioca', 'Iced Tea', '54000', 'Pay-on-Site', '', 'cancelled', '2023-12-03 11:26:39', 1, 0),
(7, 10005, 'Enn', 'Numi', '09123456789', '4', 'March 25 2024', 'April 9 2024', 'Casa Maria Retreat Package', 'retreat', 1300, 'YJURB01536', 'Tuna Pasta', 'Korean Chicken with Sesame Seeds', 'Fish Fillet with White Sauce', 'Mango Pudding', 'Cucumber Lemonade', '72800', 'Pay-on-Site', '', 'cancelled', '2023-12-05 02:22:03', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `month` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `month`, `amount`) VALUES
(1, 'Jan', 10000),
(2, 'Feb', 0),
(3, 'Mar', 0),
(4, 'Apr', 0),
(5, 'May', 0),
(6, 'June', 0),
(7, 'July', 40000),
(8, 'Aug', 30000),
(9, 'Sept', 50000),
(10, 'Oct', 12000),
(11, 'Nov', 3000),
(12, 'Dec', 89000);

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

--
-- Dumping data for table `sales_report`
--

INSERT INTO `sales_report` (`sales_report_id`, `report_id`, `total_sales`, `sales_report_date`) VALUES
(1, 1, 0, '2023-11-04'),
(2, 2, 0, '2023-11-05');

-- --------------------------------------------------------

--
-- Table structure for table `seminar_reservation_record`
--

CREATE TABLE `seminar_reservation_record` (
  `seminar_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `guest` varchar(255) NOT NULL,
  `check_in` varchar(1000) NOT NULL,
  `check_out` varchar(1000) NOT NULL,
  `package` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `transaction_num` varchar(15) NOT NULL,
  `breakfast` varchar(100) NOT NULL,
  `lunch` varchar(100) NOT NULL,
  `dinner` varchar(100) NOT NULL,
  `dessert` varchar(100) NOT NULL,
  `drinks` varchar(100) NOT NULL,
  `total` varchar(50) NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','') NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  `is_read_user` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `price_range` varchar(255) NOT NULL,
  `service_description` text NOT NULL,
  `img_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `price_range`, `service_description`, `img_path`) VALUES
(1, 'Retreat', '800.00 - 1200.00', 'This is a retreat reservation', '../images/another_imageBG.png'),
(2, 'Recollection', '400.00', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, natus laboriosam. Possimus totam eligendi cupiditate tempore, expedita quibusdam nobis sit labore exercitationem facere atque, rem dignissimos!', '../images/IMG20230907154303.jpg'),
(3, 'Reception', '8000.00', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, natus laboriosam. Possimus totam eligendi cupiditate tempore, expedita quibusdam nobis sit labore exercitationem facere atque, rem dignissimos!', '../images/img17.jpg'),
(4, 'Training', '400.00', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, natus laboriosam. Possimus totam eligendi cupiditate tempore, expedita quibusdam nobis sit labore exercitationem facere atque, rem dignissimos!', '../images/IMG20230907152638.jpg'),
(5, 'Seminar', '400.00', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quis, natus laboriosam. Possimus totam eligendi cupiditate tempore, expedita quibusdam nobis sit labore exercitationem facere atque, rem dignissimos!', '../images/IMG20230907152638.jpg');

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
-- Table structure for table `souvenir_items`
--

CREATE TABLE `souvenir_items` (
  `item_id` int(11) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `souvenir_description` text DEFAULT NULL,
  `souvenir_img_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `souvenir_items`
--

INSERT INTO `souvenir_items` (`item_id`, `item_name`, `souvenir_description`, `souvenir_img_path`) VALUES
(1, 'Birth Stones', 'The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.', '../images/prod1.jpg'),
(2, 'Rosaries', 'The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.', '../images/prod2.jpg'),
(3, 'Rosary Bracelets', 'The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.', '../images/prod4.jpg'),
(4, 'Books', 'The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.', '../images/prod9.jpg'),
(5, 'Bags', 'The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.', '../images/prod11.jpg'),
(6, 'Tumblers', 'The lorem text the section that contains header with having open functionality. Lorem dolor sit amet consectetur adipisicing elit.', '../images/prod8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `training_reservation_record`
--

CREATE TABLE `training_reservation_record` (
  `training_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `guest` varchar(255) NOT NULL,
  `check_in` varchar(1000) NOT NULL,
  `check_out` varchar(1000) NOT NULL,
  `package` varchar(200) NOT NULL,
  `type` varchar(100) NOT NULL,
  `price` float NOT NULL,
  `transaction_num` varchar(15) NOT NULL,
  `breakfast` varchar(100) NOT NULL,
  `lunch` varchar(100) NOT NULL,
  `dinner` varchar(100) NOT NULL,
  `dessert` varchar(100) NOT NULL,
  `drinks` varchar(100) NOT NULL,
  `total` varchar(50) NOT NULL,
  `payment_method` enum('Pay-on-Site','GCash') NOT NULL,
  `proof_of_payment` varchar(255) DEFAULT NULL,
  `status` enum('pending','confirmed','cancelled','') NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  `is_read_user` tinyint(4) NOT NULL
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
  `password` varchar(255) NOT NULL,
  `profile_picture` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `profile_picture`, `timestamp`) VALUES
(10002, 'Satoru', 'Gojo', 'gojo@email.com', '$2y$10$2n61M2RneGq9n8K5.v2H/uiZmcQYtfUR/3kb9eU8s9ubdjhzAXhlC', 'profile_pictures/gojo.jpg', '2023-11-14 14:42:18'),
(10005, 'Enn', 'Numi', 'numinum1128@gmail.com', '$2y$10$zZ00VRhHPA7M1z2do.g4ue9Ze0U666LZm0tXNzEYk0REINIOFuBOK', 'profile_pictures/bocchi pfp.jpg', '2023-11-11 02:13:33'),
(10006, 'Mafuyu', 'Asaina', 'mafuyu@gmail.com', '$2y$10$oFNQRVU1DyW4X0k2dmBxa.qK34UBzziv7BFALIY/f9lfz8qzoymHK', 'profile_pictures/asahina-dp.jpg', '2023-11-13 09:13:06'),
(10008, 'Hitori', 'Gotou', 'numinum1128+test1@gmail.com', '$2y$10$EC6ntecwOZq8/cK.JjfRw.S359ZB/lFH6ZxdJiBuLyiN9A4kC7ME6', 'profile_pictures/testPFP.jpg', '2023-11-20 11:47:57');

--
-- Indexes for dumped tables
--

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
-- Indexes for table `announcement_image`
--
ALTER TABLE `announcement_image`
  ADD PRIMARY KEY (`announce_img_id`);

--
-- Indexes for table `appointment_record`
--
ALTER TABLE `appointment_record`
  ADD PRIMARY KEY (`appoint_id`);

--
-- Indexes for table `appointment_unavailability`
--
ALTER TABLE `appointment_unavailability`
  ADD PRIMARY KEY (`unavailable_appoint_id`);

--
-- Indexes for table `available_reservation_dates`
--
ALTER TABLE `available_reservation_dates`
  ADD PRIMARY KEY (`available_reserve_id`);

--
-- Indexes for table `chart`
--
ALTER TABLE `chart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

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
-- Indexes for table `package_images`
--
ALTER TABLE `package_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `package_id` (`package_id`);

--
-- Indexes for table `reception_reservation_record`
--
ALTER TABLE `reception_reservation_record`
  ADD PRIMARY KEY (`reception_id`);

--
-- Indexes for table `recollection_reservation_record`
--
ALTER TABLE `recollection_reservation_record`
  ADD PRIMARY KEY (`recollection_id`);

--
-- Indexes for table `reservation_unavailability`
--
ALTER TABLE `reservation_unavailability`
  ADD PRIMARY KEY (`unavailable_reservation_id`);

--
-- Indexes for table `retreat_reservation_record`
--
ALTER TABLE `retreat_reservation_record`
  ADD PRIMARY KEY (`retreat_id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_report`
--
ALTER TABLE `sales_report`
  ADD PRIMARY KEY (`sales_report_id`);

--
-- Indexes for table `seminar_reservation_record`
--
ALTER TABLE `seminar_reservation_record`
  ADD PRIMARY KEY (`seminar_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `souvenir_items`
--
ALTER TABLE `souvenir_items`
  ADD PRIMARY KEY (`item_id`);

--
-- Indexes for table `training_reservation_record`
--
ALTER TABLE `training_reservation_record`
  ADD PRIMARY KEY (`training_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `amenities`
--
ALTER TABLE `amenities`
  MODIFY `amenity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `announcement_image`
--
ALTER TABLE `announcement_image`
  MODIFY `announce_img_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `appointment_record`
--
ALTER TABLE `appointment_record`
  MODIFY `appoint_id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `appointment_unavailability`
--
ALTER TABLE `appointment_unavailability`
  MODIFY `unavailable_appoint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `available_reservation_dates`
--
ALTER TABLE `available_reservation_dates`
  MODIFY `available_reserve_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `chart`
--
ALTER TABLE `chart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `meal_category`
--
ALTER TABLE `meal_category`
  MODIFY `mealCat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=325;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `package_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `package_images`
--
ALTER TABLE `package_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `reception_reservation_record`
--
ALTER TABLE `reception_reservation_record`
  MODIFY `reception_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `recollection_reservation_record`
--
ALTER TABLE `recollection_reservation_record`
  MODIFY `recollection_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservation_unavailability`
--
ALTER TABLE `reservation_unavailability`
  MODIFY `unavailable_reservation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `retreat_reservation_record`
--
ALTER TABLE `retreat_reservation_record`
  MODIFY `retreat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `sales_report`
--
ALTER TABLE `sales_report`
  MODIFY `sales_report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `seminar_reservation_record`
--
ALTER TABLE `seminar_reservation_record`
  MODIFY `seminar_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `training_reservation_record`
--
ALTER TABLE `training_reservation_record`
  MODIFY `training_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10009;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
