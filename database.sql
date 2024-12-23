-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 07:21 PM
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
-- Database: `booking_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `created_at`, `updated_at`) VALUES
(2, 'chetan sakre', 'csakre634@gmail.com', '$2y$10$pqgB92rmAkRPq.5A1W.H/eg9rQqqXbeDgIUQRhYrO5byCwed1sJKC', '2024-11-19 06:39:24', '2024-11-19 06:39:24');

-- --------------------------------------------------------

--
-- Table structure for table `airports`
--

CREATE TABLE `airports` (
  `airport_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `iata_code` char(3) NOT NULL,
  `icao_code` char(4) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `latitude` decimal(10,6) DEFAULT NULL,
  `longitude` decimal(10,6) DEFAULT NULL,
  `timezone` varchar(50) DEFAULT NULL,
  `elevation` int(11) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `airports`
--

INSERT INTO `airports` (`airport_id`, `name`, `iata_code`, `icao_code`, `city`, `state`, `country`, `latitude`, `longitude`, `timezone`, `elevation`, `type`, `status`) VALUES
(1, 'Agartala Airport', 'IXA', NULL, 'Agartala', 'Tripura', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(2, 'Agatti Island Airport', 'AGX', NULL, 'Agatti Island', 'Lakshadweep', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(3, 'Kheria Airport', 'AGR', NULL, 'Agra', 'Uttar Pradesh', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(4, 'Sardar Vallabhbhai Patel Intl', 'AMD', NULL, 'Ahmedabad', 'Gujarat', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'International', 1),
(5, 'Lengpui Airport', 'AJL', NULL, 'Aizawl', 'Mizoram', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(6, 'Akola Airport', 'AKD', NULL, 'Akola', 'Maharashtra', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(7, 'Prayagraj Bamrauli Airport', 'IXD', NULL, 'Allahabad', 'Uttar Pradesh', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(8, 'Along Airport', 'IXV', NULL, 'Along', 'Arunachal Pradesh', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(9, 'Sri Guru Ram Dass Jee Intl', 'ATQ', NULL, 'Amritsar', 'Punjab', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'International', 1),
(10, 'Chikkalthana Airport', 'IXU', NULL, 'Aurangabad', 'Maharashtra', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(11, 'Bagdogra Airport', 'IXB', NULL, 'Bagdogra', 'West Bengal', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(12, 'Balurghat Airport', 'RGH', NULL, 'Balurghat', 'West Bengal', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(13, 'HAL Airport', 'BLR', NULL, 'Bangalore', 'Karnataka', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'International', 1),
(14, 'Bareilly Airport', 'BEK', NULL, 'Bareilly', 'Uttar Pradesh', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(15, 'Belgaum Airport', 'IXG', NULL, 'Belgaum', 'Karnataka', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(16, 'Bellary Airport', 'BEP', NULL, 'Bellary', 'Karnataka', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(17, 'Bathinda Airport', 'BUP', NULL, 'Bhatinda', 'Punjab', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(18, 'Bhavnagar Airport', 'BHU', NULL, 'Bhavnagar', 'Gujarat', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(19, 'Raja Bhoj Airport', 'BHO', NULL, 'Bhopal', 'Madhya Pradesh', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(20, 'Biju Patnaik Airport', 'BBI', NULL, 'Bhubaneswar', 'Odisha', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(21, 'Bhuj Rudra Mata Airport', 'BHJ', NULL, 'Bhuj', 'Gujarat', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(22, 'Nal Airport', 'BKB', NULL, 'Bikaner', 'Rajasthan', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(23, 'Bilaspur Airport', 'PAB', NULL, 'Bilaspur', 'Chhattisgarh', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(24, 'Car Nicobar Airport', 'CBD', NULL, 'Car Nicobar', 'Andaman and Nicobar Islands', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(25, 'Chandigarh Airport', 'IXC', NULL, 'Chandigarh', 'Chandigarh', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(26, 'Chennai International Airport', 'MAA', NULL, 'Chennai/Madras', 'Tamil Nadu', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'International', 1),
(27, 'Peelamedu Airport', 'CJB', NULL, 'Coimbatore', 'Tamil Nadu', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(28, 'Cooch Behar Airport', 'COH', NULL, 'Cooch Behar', 'West Bengal', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(29, 'Cuddapah Airport', 'CDP', NULL, 'Cuddapah', 'Andhra Pradesh', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(30, 'Daman Airport', 'NMB', NULL, 'Daman', 'Daman and Diu', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(31, 'Daparizo Airport', 'DAE', NULL, 'Daparizo', 'Arunachal Pradesh', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(32, 'Dehradun Jolly Grant Airport', 'DED', NULL, 'Dehra Dun', 'Uttarakhand', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(33, 'Indira Gandhi International Airport', 'DEL', 'VIDP', 'Delhi', 'Delhi', 'India', 28.556200, 77.100000, 'Asia/Kolkata', 777, 'International', 1),
(34, 'Dhanbad Airport', 'DBD', NULL, 'Dhanbad', 'Jharkhand', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(35, 'Gaggal Airport', 'DHM', NULL, 'Dharamsala', 'Himachal Pradesh', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(36, 'Chabua Airport', 'DIB', NULL, 'Dibrugarh', 'Assam', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(37, 'Dimapur Airport', 'DMU', NULL, 'Dimapur', 'Nagaland', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(38, 'Diu Airport', 'DIU', NULL, 'Diu', 'Daman and Diu', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(39, 'Lokpriya Gopinath Bordoloi International Airport', 'GAU', NULL, 'Guwahati', 'Assam', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(40, 'Gaya Airport', 'GAY', NULL, 'Gaya', 'Bihar', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(41, 'Dabolim Airport', 'GOI', NULL, 'Goa', 'Goa', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'International', 1),
(42, 'Gorakhpur Airport', 'GOP', NULL, 'Gorakhpur', 'Uttar Pradesh', 'India', NULL, NULL, 'Asia/Kolkata', 733, 'Domestic', 1),
(43, 'Rajiv Gandhi International Airport', 'HYD', 'VOHS', 'Hyderabad', 'Telangana', 'India', 17.240300, 78.429900, 'Asia/Kolkata', 1742, 'International', 1);

-- --------------------------------------------------------

--
-- Table structure for table `flights`
--

CREATE TABLE `flights` (
  `id` int(11) NOT NULL,
  `airline_name` varchar(255) NOT NULL,
  `flight_number` varchar(50) NOT NULL,
  `departure_airport_id` int(11) NOT NULL,
  `arrival_airport_id` int(11) NOT NULL,
  `departure_time` datetime NOT NULL,
  `arrival_time` datetime NOT NULL,
  `duration` time NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `seats_available` int(11) NOT NULL,
  `status` enum('Scheduled','Delayed','Cancelled') DEFAULT 'Scheduled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flights`
--

INSERT INTO `flights` (`id`, `airline_name`, `flight_number`, `departure_airport_id`, `arrival_airport_id`, `departure_time`, `arrival_time`, `duration`, `price`, `seats_available`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Air India', 'AI101', 1, 2, '2024-11-28 08:00:00', '2024-11-28 12:00:00', '04:00:00', 5500.00, 150, 'Scheduled', '2024-11-27 15:35:47', '2024-11-27 15:35:47'),
(2, 'IndiGo', '6E202', 2, 3, '2024-11-28 14:30:00', '2024-11-28 18:00:00', '03:30:00', 4500.00, 180, 'Scheduled', '2024-11-27 15:35:47', '2024-11-27 15:35:47'),
(3, 'SpiceJet', 'SG303', 3, 4, '2024-11-28 10:00:00', '2024-11-28 12:30:00', '02:30:00', 3500.00, 200, 'Scheduled', '2024-11-27 15:35:47', '2024-11-27 15:35:47'),
(4, 'Vistara', 'UK404', 4, 5, '2024-11-29 06:00:00', '2024-11-29 09:00:00', '03:00:00', 6000.00, 170, 'Delayed', '2024-11-27 15:35:47', '2024-11-27 15:35:47'),
(5, 'GoAir', 'G8305', 5, 6, '2024-11-29 17:00:00', '2024-11-29 20:30:00', '03:30:00', 4000.00, 120, 'Cancelled', '2024-11-27 15:35:47', '2024-11-27 15:35:47'),
(6, 'Air India', 'AI106', 1, 3, '2024-11-30 08:00:00', '2024-11-30 11:30:00', '03:30:00', 5700.00, 140, 'Scheduled', '2024-11-27 15:35:47', '2024-11-27 15:35:47'),
(7, 'IndiGo', '6E207', 2, 4, '2024-12-01 15:00:00', '2024-12-01 18:30:00', '03:30:00', 4600.00, 160, 'Scheduled', '2024-11-27 15:35:47', '2024-11-27 15:35:47'),
(8, 'SpiceJet', 'SG308', 3, 5, '2024-12-02 07:30:00', '2024-12-02 10:30:00', '03:00:00', 3800.00, 190, 'Scheduled', '2024-11-27 15:35:47', '2024-11-27 15:35:47'),
(9, 'Vistara', 'UK409', 4, 6, '2024-12-03 12:00:00', '2024-12-03 15:30:00', '03:30:00', 6200.00, 110, 'Scheduled', '2024-11-27 15:35:47', '2024-11-27 15:35:47'),
(10, 'GoAir', 'G8310', 5, 1, '2024-12-04 09:00:00', '2024-12-04 13:00:00', '04:00:00', 4100.00, 130, 'Delayed', '2024-11-27 15:35:47', '2024-11-27 15:35:47');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) NOT NULL,
  `combined_location` text DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `rating` float DEFAULT 0,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`id`, `name`, `description`, `location`, `combined_location`, `image_url`, `created_at`, `updated_at`, `city`, `state`, `country`, `rating`, `latitude`, `longitude`, `capacity`) VALUES
(4, 'Ocean Bliss', 'Hotel with a seaside view.', 'Dwarka Beach, Dwarka', 'Dwarka, Gujarat, Dwarka Beach, Dwarka', 'https://content.r9cdn.net/rimg/himg/c2/ec/b3/expedia_group-2691890-259665347-508620.jpg?width=335&height=268&crop=true', '2024-11-25 16:36:59', '2024-11-29 15:14:29', 'Dwarka', 'Gujarat', 'India', 4.3, 22.23940000, 68.96740000, 120),
(5, 'Fort Heritage', 'Experience royal living.', 'Pavagadh, Vadodara', 'Vadodara, Gujarat, Pavagadh, Vadodara', 'https://images.pexels.com/photos/70441/pexels-photo-70441.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1', '2024-11-25 16:36:59', '2024-12-06 13:18:05', 'Vadodara', 'Gujarat', 'India', 4.6, 22.46710000, 73.51230000, 70),
(6, 'Desert Comfort', 'A unique desert-themed stay.', 'Rann of Kutch, Bhuj', 'Bhuj, Gujarat, Rann of Kutch, Bhuj', 'https://media.istockphoto.com/id/636484522/photo/hotel-resort-swimming-pool.jpg?s=612x612&w=0&k=20&c=ET-8reopQEIhH4YYee6tqlFpfKEg19oLRRCJX3-56rs=', '2024-11-25 16:36:59', '2024-12-06 16:07:30', 'Bhuj', 'Gujarat', 'India', 1, 23.24100000, 69.66690000, 60),
(7, 'Pearl Residency', 'Perfect for business travelers.', 'Paldi, Ahmedabad', 'Ahmedabad, Gujarat, Paldi, Ahmedabad', 'https://media.istockphoto.com/id/1163136092/photo/monte-carlo-monaco-casino-square-cafe-de-paris-travel-summer-holiday-people-famous-places.jpg?s=612x612&w=0&k=20&c=VQy9Uscsg_o1HO-AMEsKeoGIkiA6t80Y7Bn73ng7iJ0=', '2024-11-25 16:36:59', '2024-12-06 16:25:26', 'Ahmedabad', 'Gujarat', 'India', 4.2, 23.02170000, 72.57140000, 110),
(8, 'Shiv Sagar Resort', 'Located near Gir National Park.', 'Sasan Gir, Junagadh', 'Junagadh, Gujarat, Sasan Gir, Junagadh', 'https://media.istockphoto.com/id/1370563822/photo/assos-village-in-kefalonia.jpg?s=612x612&w=0&k=20&c=0IRElQrnR8TT3wKnN4gSPBO9j0fyTotEpA_iB9Rgpi0=', '2024-11-25 16:36:59', '2024-12-06 16:21:54', 'Junagadh', 'Gujarat', 'India', 1, 21.12410000, 70.48480000, 75),
(9, 'Hill View Retreat', 'Relaxing hill station stay.', 'Saputara, Dang', 'Dang, Gujarat, Saputara, Dang', 'https://media.istockphoto.com/id/96669695/photo/luxury-palace-courtyard.jpg?s=612x612&w=0&k=20&c=CAAsyEccQsjiIXST3omGGYzmYNgcad8SrucOyEOxCAs=', '2024-11-25 16:36:59', '2024-12-06 16:13:38', 'Dang', 'Gujarat', 'India', 1, 20.57970000, 73.75020000, 65),
(10, 'The Grand Plaza', 'Five-star hotel with top-notch amenities.', 'C G Road, Ahmedabad', 'Ahmedabad, Gujarat, C G Road, Ahmedabad', 'https://media.istockphoto.com/id/1279145000/photo/crete-greece-candia-park-village-a-luxury-holiday-village-in-crete-greece.jpg?s=612x612&w=0&k=20&c=zmhJ8s8Pt-TD6qDBUUecfJ3Pk6_L6mrG79nnSbUe5_o=', '2024-11-25 16:36:59', '2024-12-06 16:25:44', 'Ahmedabad', 'Gujarat', 'India', 4.9, 23.03050000, 72.54610000, 200),
(11, 'Riverview Hotel', 'Stay by the Sabarmati River.', 'Ashram Road, Ahmedabad', 'Ahmedabad, Gujarat, Ashram Road, Ahmedabad', 'https://media.istockphoto.com/id/1351436405/photo/khimsar-fort-hotel-illuminated-in-the-warm-indian-night.jpg?s=612x612&w=0&k=20&c=yPg2m1_K6n_xmfwanO52Ky2NwqzKvnG07QN7i91h4GY=', '2024-11-25 16:36:59', '2024-12-06 16:21:02', 'Ahmedabad', 'Gujarat', 'India', 1, 23.03760000, 72.56180000, 130),
(12, 'Royal Orchid', 'Luxury hotel with heritage vibes.', 'Bhuj City', 'Bhuj, Gujarat, Bhuj City', 'https://media.istockphoto.com/id/1299852621/photo/ghost-city-inn.jpg?s=612x612&w=0&k=20&c=Psa32XUJ5z6Lvr3jvoirWzNVk-alDF0IxYLOipD1KnY=', '2024-11-25 16:36:59', '2024-12-06 16:26:24', 'Bhuj', 'Gujarat', 'India', 4.4, 23.25430000, 69.66950000, 90),
(13, 'Green Woods Resort', 'Eco-friendly hotel surrounded by trees.', 'Dandi, Navsari', 'Navsari, Gujarat, Dandi, Navsari', 'https://media.istockphoto.com/id/490555943/photo/indian-hotel-resort-evening-scene.jpg?s=612x612&w=0&k=20&c=Kdxdri8dOvSchwNXzV1uYQcXGAI8CD0BKSi7gkxPzKI=', '2024-11-25 16:36:59', '2024-12-06 16:12:42', 'Navsari', 'Gujarat', 'India', 1, 20.95320000, 72.92790000, 85),
(14, 'Seaside Paradise', 'Resort near Mandvi Beach.', 'Mandvi, Kutch', 'Kutch, Gujarat, Mandvi, Kutch', 'https://media.istockphoto.com/id/1130843037/photo/the-jamaica-pegasus-hotel.jpg?s=612x612&w=0&k=20&c=UaJzULMje64V4yScxIlmcyJTJ4Pf1Fx4ICWONfqLMdY=', '2024-11-25 16:36:59', '2024-12-06 16:26:37', 'Kutch', 'Gujarat', 'India', 4.2, 22.83380000, 69.35240000, 95),
(16, 'Lighthouse Resort', 'Iconic stay with a view of the lighthouse.', 'Porbandar', 'Porbandar, Gujarat, Porbandar', 'https://media.istockphoto.com/id/1176361308/photo/balcony-frame-with-the-university-of-paris-blurred-in-the-background.jpg?s=612x612&w=0&k=20&c=8OrYISM_fXTjHkZMdDdXQD80ehqWcC91bs52UpkAhek=', '2024-11-25 16:36:59', '2024-12-06 16:17:13', 'Porbandar', 'Gujarat', 'India', 1, 21.64170000, 69.60930000, 100),
(17, 'Harmony Suites', 'Peaceful hotel in Gandhinagar.', 'Sector 11, Gandhinagar', 'Gandhinagar, Gujarat, Sector 11, Gandhinagar', 'https://media.istockphoto.com/id/155445110/photo/luxury-holiday-villa-with-swimming-pool.jpg?s=612x612&w=0&k=20&c=UM2GEXmgi6IF4ai3HArQhvX3ZgU97Hcj4593k16oNrk=', '2024-11-25 16:36:59', '2024-12-06 16:26:50', 'Gandhinagar', 'Gujarat', 'India', 4, 23.21560000, 72.63690000, 140),
(18, 'Heritage Haveli', 'Stay in a historic haveli.', 'Surendranagar', 'Surendranagar, Gujarat, Surendranagar', 'https://media.istockphoto.com/id/157533612/photo/indian-palace.jpg?s=612x612&w=0&k=20&c=6Q2B7L2iSiYihFfMtDpNi9V0RSSECCV-vXhlLTf9t6s=', '2024-11-25 16:36:59', '2024-12-06 16:13:10', 'Surendranagar', 'Gujarat', 'India', 1, 22.72720000, 71.64830000, 60),
(19, 'Urban Retreat', 'Modern hotel in Rajkot.', 'Yagnik Road, Rajkot', 'Rajkot, Gujarat, Yagnik Road, Rajkot', 'https://media.istockphoto.com/id/592662746/photo/hotel-best-western-plus-in-willingen.jpg?s=612x612&w=0&k=20&c=6osGNWBEKK4feSHfJPRdzP6Low733xBzWCsIcUxlwUk=', '2024-11-25 16:36:59', '2024-12-06 16:22:57', 'Rajkot', 'Gujarat', 'India', 1, 22.30390000, 70.80220000, 150),
(20, 'Golden Dunes', 'Desert luxury stay.', 'Little Rann of Kutch, Surendranagar', 'Surendranagar, Gujarat, Little Rann of Kutch, Surendranagar', 'https://media.istockphoto.com/id/528722737/photo/square-in-shanghai.jpg?s=612x612&w=0&k=20&c=2_NN6gfxOybL5blZSGqCQJnV-RvELYf7N1bWN3qaQwA=', '2024-11-25 16:36:59', '2024-12-06 16:10:09', 'Surendranagar', 'Gujarat', 'India', 1, 23.30770000, 71.90100000, 50),
(21, 'Hotel Royal Plaza', 'A grand hotel offering luxurious amenities.', 'Ashram Road, Ahmedabad', 'Ahmedabad, Gujarat, Ashram Road, Ahmedabad', 'https://media.istockphoto.com/id/637128818/photo/luxury-residence-in-india.jpg?s=612x612&w=0&k=20&c=NhUZvxpMRUxBQDbjrnMDU3mnB4-SC-dJMODPda4KTD4=', '2024-11-25 16:39:37', '2024-12-06 16:14:11', 'Ahmedabad', 'Gujarat', 'India', 1, 23.03360000, 72.61630000, 250),
(22, 'Silver Sands Resort', 'Seaside resort with a private beach.', 'Mandvi Beach, Kutch', 'Kutch, Gujarat, Mandvi Beach, Kutch', 'https://media.istockphoto.com/id/2153520875/photo/the-mount-washington-hotel-at-dusk-with-lights-and-deep-blue-evening-sky.jpg?s=612x612&w=0&k=20&c=4UsKoe1ffwlOfJKmcGBWag40v5NygWfvg33kY3r_8xE=', '2024-11-25 16:39:37', '2024-12-06 16:27:04', 'Kutch', 'Gujarat', 'India', 4.5, 22.83960000, 69.35140000, 150),
(23, 'Saffron Palace', 'A royal stay with modern comforts.', 'Rajkot, Gujarat', 'Rajkot, Gujarat, Rajkot, Gujarat', 'https://media.istockphoto.com/id/184386486/photo/resort.jpg?s=612x612&w=0&k=20&c=ZpumfBwiarIxGQYOe3aBNz0vzfVQ7k8ub94sqT8f-Bw=', '2024-11-25 16:39:37', '2024-12-06 16:21:33', 'Rajkot', 'Gujarat', 'India', 1, 22.30390000, 70.80220000, 120),
(24, 'Lavender Inn', 'Affordable yet elegant accommodations.', 'Gandhinagar', 'Gandhinagar, Gujarat, Gandhinagar', 'https://media.istockphoto.com/id/494468514/photo/lake-pichola-hotel-palace.jpg?s=612x612&w=0&k=20&c=dS1xrWGmYHQHY8ec2oPG7zqlaOhyqnEPK3cRVNpLYdo=', '2024-11-25 16:39:37', '2024-12-06 16:14:29', 'Gandhinagar', 'Gujarat', 'India', 1, 23.21560000, 72.63690000, 100),
(25, 'Desert Oasis', 'A peaceful retreat amidst the desert landscape.', 'Kutch', 'Kutch, Gujarat, Kutch', 'https://media.istockphoto.com/id/635977750/photo/legislative-yuan-building.jpg?s=612x612&w=0&k=20&c=xQ975w3lxIy9v41T6jyk32vRpoM9DBvcleV9ZU46Rzg=', '2024-11-25 16:39:37', '2024-12-06 16:08:59', 'Kutch', 'Gujarat', 'India', 1, 23.24510000, 69.66650000, 80),
(26, 'The Imperial Residency', 'Lavish and grand accommodations in Surat.', 'Surat', 'Surat, Gujarat, Surat', 'https://media.istockphoto.com/id/183827601/photo/patio-luxury-villa-phuket-thailand.jpg?s=612x612&w=0&k=20&c=hXKqlMQyU0zSRFVQ5RNYfl6YEpawAVAL4alzgBEnTHI=', '2024-11-25 16:39:37', '2024-12-06 16:27:37', 'Surat', 'Gujarat', 'India', 4.7, 21.17020000, 72.83110000, 180),
(28, 'Grand Sapphire', 'Modern hotel with conference facilities.', 'Vadodara', 'Vadodara, Gujarat, Vadodara', 'https://media.istockphoto.com/id/1490140364/photo/modern-beach-hotel-with-sea-view-swimming-pool.jpg?s=612x612&w=0&k=20&c=gnEQQ7IQBFiJiyjZFzw41wqD1iAZivz-oexOhFhY61M=', '2024-11-25 16:39:37', '2024-12-06 16:12:08', 'Vadodara', 'Gujarat', 'India', 1, 22.30720000, 73.18120000, 200),
(29, 'Rishabh Resort', 'A family-friendly resort with a water park.', 'Surat', 'Surat, Gujarat, Surat', 'https://media.istockphoto.com/id/1569779303/photo/springhill-suites-by-marriott-on-west-simpson-avenue-at-jackson-in-jackson-hole-in-teton.jpg?s=612x612&w=0&k=20&c=0-6nuN1oR7yl9jWwkFy_LJ2cI29Lnu62Jj7MRi8d9NE=', '2024-11-25 16:39:37', '2024-12-06 16:28:07', 'Surat', 'Gujarat', 'India', 4.2, 21.17020000, 72.83110000, 150),
(30, 'Vibrant Villa', 'A luxurious stay with a home-like feel.', 'Vadodara', 'Vadodara, Gujarat, Vadodara', 'https://media.istockphoto.com/id/1351436403/photo/dawn-in-khimsar-hotel.jpg?s=612x612&w=0&k=20&c=0N5bjB2L2umPhPGiCU8WkZ0gFplFTK_p_itViZ0hmD8=', '2024-11-25 16:39:37', '2024-12-06 16:23:35', 'Vadodara', 'Gujarat', 'India', 1, 22.30720000, 73.18120000, 130),
(31, 'Cosmic Stay', 'A tech-savvy hotel for the modern traveler.', 'Ahmedabad', 'Ahmedabad, Gujarat, Ahmedabad', 'https://media.istockphoto.com/id/95316718/photo/convention-center-entrance-at-night.jpg?s=612x612&w=0&k=20&c=GYx9HRnc66hgpgs2oFtQBwlsSsyQNrVNfyMJEZdX8Yo=', '2024-11-25 16:39:37', '2024-12-06 16:08:29', 'Ahmedabad', 'Gujarat', 'India', 1, 23.02250000, 72.57140000, 170),
(32, 'Skyline Heights', 'Hotel with an amazing city view.', 'Vadodara', 'Vadodara, Gujarat, Vadodara', 'https://media.istockphoto.com/id/1136360768/photo/pub-and-hotels-in-belfast-city-centre.jpg?s=612x612&w=0&k=20&c=-GBi7iWgR7wEkjjVmBLBRLmWCA8OfQ0-JS2eCZ7zIRg=', '2024-11-25 16:39:37', '2024-12-06 16:22:22', 'Vadodara', 'Gujarat', 'India', 1, 22.30720000, 73.18120000, 110),
(33, 'The Heritage Hotel', 'A stay with a touch of history and culture.', 'Bhavnagar', 'Bhavnagar, Gujarat, Bhavnagar', 'https://media.istockphoto.com/id/1783465462/photo/illuminated-sign-located-on-the-facade-of-the-ibsen-hotel-on-vandersgade-street-in-copenhagen.jpg?s=612x612&w=0&k=20&c=rX_ye1jFFW6wlIX8wXRixrKvnrE2SDljchyS-xcRdL8=', '2024-11-25 16:39:37', '2024-12-06 16:28:22', 'Bhavnagar', 'Gujarat', 'India', 4.2, 21.76040000, 72.15440000, 140),
(34, 'Majestic Garden Resort', 'A resort surrounded by lush greenery.', 'Surat', 'Surat, Gujarat, Surat', 'https://media.istockphoto.com/id/1164031850/photo/scenes-from-san-diego-and-coronado-california.jpg?s=612x612&w=0&k=20&c=bAA4dsd3mZCYUGu-_pAyuzi3L8lj8U-TRiCM6wNswJM=', '2024-11-25 16:39:37', '2024-12-06 16:18:06', 'Surat', 'Gujarat', 'India', 1, 21.17020000, 72.83110000, 160),
(35, 'Radha Krishna Hotel', 'Stay with traditional Indian hospitality.', 'Rajkot', 'Rajkot, Gujarat, Rajkot', 'https://media.istockphoto.com/id/1401429162/photo/the-el-palace-hotel-in-barcelona.jpg?s=612x612&w=0&k=20&c=e1B9oJ0fuX8IcMSl4mWbkr2UzqQBFgDiT29g7QESgSM=', '2024-11-25 16:39:37', '2024-12-06 16:19:00', 'Rajkot', 'Gujarat', 'India', 1, 22.30390000, 70.80220000, 120),
(36, 'Aditya Palace', 'Spacious rooms with a royal touch.', 'Gandhinagar', 'Gandhinagar, Gujarat, Gandhinagar', 'https://media.istockphoto.com/id/1776936746/photo/thatched-roundhouses-at-a-wilderness-hotel-in-namibia.jpg?s=612x612&w=0&k=20&c=GhJ07-k8iC4VI3dTVgQoqQ0C_a9IaPlgDZRUFNcn1oQ=', '2024-11-25 16:39:37', '2024-12-06 16:28:45', 'Gandhinagar', 'Gujarat', 'India', 4.5, 23.21560000, 72.63690000, 150),
(37, 'Mirage Resort', 'A unique resort experience amidst the desert.', 'Kutch', 'Kutch, Gujarat, Kutch', 'https://media.istockphoto.com/id/175208109/photo/the-front-view-of-beach-house.jpg?s=612x612&w=0&k=20&c=bkJcqggeBMycY7hT0MD3YmBrijw9qqItoZ8JbBsBb_M=', '2024-11-25 16:39:37', '2024-12-06 16:18:37', 'Kutch', 'Gujarat', 'India', 4, 23.24510000, 69.66650000, 90),
(38, 'Gold Coast Inn', 'A chic hotel with a contemporary design.', 'Daman', 'Daman, Gujarat, Daman', 'https://media.istockphoto.com/id/177002026/photo/business-centre.jpg?s=612x612&w=0&k=20&c=aN6RnwC59kjYeE5LfsJvehANpZwgxPonHq_jLzy4HMs=', '2024-11-25 16:39:37', '2024-12-06 16:09:18', 'Daman', 'Gujarat', 'India', 1, 20.39740000, 72.83110000, 100),
(39, 'Hilltop Mansion', 'Hotel with a panoramic hill view.', 'Saputara', 'Saputara, Gujarat, Saputara', 'https://media.istockphoto.com/id/1165695230/photo/cannes-france-miramar-luxury-apartments-seaside-port-croisette-travel-summer-holiday.jpg?s=612x612&w=0&k=20&c=669C2weTYXMsn7C2PGSmL2rNUrBpMcMM8YKZAy1XFUc=', '2024-11-25 16:39:37', '2024-12-06 16:31:13', 'Saputara', 'Gujarat', 'India', 4.4, 20.57970000, 73.75020000, 120),
(40, 'Grand Ocean Resort', 'Luxury resort with oceanfront villas.', 'Dwarka', 'Dwarka, Gujarat, Dwarka', 'https://media.istockphoto.com/id/146753772/photo/resort-in-cancun-shown-in-the-daytime-from-the-air.jpg?s=612x612&w=0&k=20&c=TsDt2nU2cZBsQ4H4czSyTXWpHtcWcJWTrfsjq4ahSb8=', '2024-11-25 16:39:37', '2024-12-06 16:11:30', 'Dwarka', 'Gujarat', 'India', 1, 22.23940000, 68.96740000, 200),
(41, 'rajesh hotels', 'just good hotel', 'rajkot,gujarat', NULL, 'https://media.istockphoto.com/id/1905108404/photo/view-of-the-luxury-grand-hotel-tremezzo-with-swimming-pool-on-the-shore-of-lake-como.jpg?s=612x612&w=0&k=20&c=hh-XC9cr-cUpKc_a8UcfBM7WSmjxE8bAo1TwvUVXM6Q=', '2024-11-29 16:33:43', '2024-12-06 16:19:47', 'rajkot', 'Gujarat', 'India ', 1, 99.99999999, 23.11254000, 3);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_bookings`
--

CREATE TABLE `hotel_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_in_time` time NOT NULL,
  `check_out` date NOT NULL,
  `check_out_time` time NOT NULL,
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending',
  `admin_comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `person`
--

CREATE TABLE `person` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `street_address` varchar(255) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `postal_code` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `profile_picture` text DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `person`
--

INSERT INTO `person` (`id`, `fname`, `lname`, `email`, `street_address`, `city`, `state`, `postal_code`, `country`, `profile_picture`, `contact_number`, `dob`, `gender`) VALUES
(10, 'chetan', 'sakre', 'csakare726@rku.ac.in', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 'DSG', 'CHETAN', 'dsgchetan3@gmail.com', NULL, NULL, NULL, NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocLAOStjpmNw9_vCjPczu1JMSu8gvtxtDW-Lo9MhEifb1MR6_w=s96-c', NULL, NULL, NULL),
(12, 'Chetan', 'Sakre', 'chetansakre37@gmail.com', NULL, NULL, NULL, NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocLfPXpNpnzR8219BuPeJ86uiFpgZyX9ShuGMDgFs8cAXJfyMw=s96-c', NULL, NULL, NULL),
(13, 'add', 'sakre', 'texts2@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 'dhanraj', 'sakre', 'user@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 'Chetan', 'Sakare', 'csakre634@gmail.com', NULL, NULL, NULL, NULL, NULL, 'https://lh3.googleusercontent.com/a/ACg8ocIMnD71EAni6onhzjxQVGvf4Ju8phQ_3dbJXr2d0ekR76ijmUKY=s96-c', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `hotel_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `capacity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `availability_status` enum('Available','Booked') DEFAULT 'Available'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `hotel_id`, `type`, `capacity`, `price`, `image_url`, `created_at`, `updated_at`, `availability_status`) VALUES
(4, 4, 'Luxury Suite', 3, 8500.00, 'https://example.com/room5.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Booked'),
(5, 5, 'Executive Room', 2, 4000.00, 'https://example.com/room6.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
(6, 6, 'Tent', 6, 7000.00, 'https://example.com/room7.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
(7, 7, 'Single Room', 1, 2000.00, 'https://example.com/room8.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Booked'),
(8, 8, 'Double Room', 2, 3500.00, 'https://example.com/room9.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
(9, 9, 'Cottage', 4, 6000.00, 'https://example.com/room10.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
(10, 10, 'Presidential Suite', 5, 12000.00, 'https://example.com/room11.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Booked'),
(11, 11, 'Deluxe Suite', 3, 6500.00, 'https://example.com/room12.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
(12, 12, 'Standard Room', 2, 2800.00, 'https://example.com/room13.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Booked'),
(13, 13, 'Eco Lodge', 2, 3200.00, 'https://example.com/room14.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
(14, 14, 'Beachfront Room', 4, 5800.00, 'https://example.com/room15.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Booked'),
(16, 16, 'Sea View Room', 3, 4500.00, 'https://example.com/room17.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
(17, 17, 'Heritage Room', 2, 4200.00, 'https://example.com/room18.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Booked'),
(18, 18, 'Luxury Villa', 6, 9000.00, 'https://example.com/room19.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
(19, 19, 'Modern Suite', 4, 5000.00, 'https://example.com/room20.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
(20, 20, 'Deluxe Room', 2, 4500.00, 'https://example.com/room1.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
(21, 21, 'Deluxe Room', 2, 5500.00, 'https://example.com/room21.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(22, 22, 'Beachfront Suite', 4, 8000.00, 'https://example.com/room22.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Booked'),
(23, 23, 'Presidential Suite', 3, 12000.00, 'https://example.com/room23.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(24, 24, 'Standard Room', 2, 3500.00, 'https://example.com/room24.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(25, 25, 'Luxury Suite', 3, 7500.00, 'https://example.com/room25.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(26, 26, 'Family Room', 5, 5000.00, 'https://example.com/room26.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Booked'),
(28, 28, 'Double Room', 2, 4000.00, 'https://example.com/room28.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(29, 29, 'Cottage', 4, 6000.00, 'https://example.com/room29.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Booked'),
(30, 30, 'Executive Room', 2, 4500.00, 'https://example.com/room30.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(31, 31, 'Deluxe Suite', 3, 6500.00, 'https://example.com/room31.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(32, 32, 'Luxury Villa', 6, 9500.00, 'https://example.com/room32.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(33, 33, 'Heritage Room', 2, 5000.00, 'https://example.com/room33.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Booked'),
(34, 34, 'Ocean View Room', 3, 6500.00, 'https://example.com/room34.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(35, 35, 'Premium Suite', 4, 7500.00, 'https://example.com/room35.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(36, 36, 'Standard Room', 2, 3200.00, 'https://example.com/room36.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Booked'),
(37, 37, 'Garden View Room', 3, 4000.00, 'https://example.com/room37.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(38, 38, 'Beach Suite', 2, 5000.00, 'https://example.com/room38.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(39, 39, 'Mountain View Room', 2, 4200.00, 'https://example.com/room39.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Booked'),
(40, 40, 'Luxury Room', 4, 8500.00, 'https://example.com/room40.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
(41, 41, 'king size ', 4, 1000.00, NULL, '2024-11-29 16:33:43', '2024-11-29 16:33:43', 'Available');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Admin','User') DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `password`, `role`) VALUES
(11, 'csakare726@rku.ac.in', '$2y$10$l/Ze2FoTGGRAmLTf5x38neasyUMLEhMCbwCftuduhftRx5B75IB0m', 'User'),
(12, 'chetansakre37@gmail.com', NULL, 'User'),
(17, 'csakre634@gmail.com', NULL, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `user_activity`
--

CREATE TABLE `user_activity` (
  `activity_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` datetime DEFAULT current_timestamp(),
  `logout_time` datetime DEFAULT NULL,
  `session_duration` int(11) DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `device_info` varchar(100) DEFAULT NULL,
  `login_method` enum('Email/Password','OAuth') DEFAULT NULL,
  `geolocation` varchar(100) DEFAULT NULL,
  `pages_visited` text DEFAULT NULL,
  `actions` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_activity`
--

INSERT INTO `user_activity` (`activity_id`, `user_id`, `login_time`, `logout_time`, `session_duration`, `ip_address`, `device_info`, `login_method`, `geolocation`, `pages_visited`, `actions`) VALUES
(26, 11, '2024-11-14 19:45:52', '2024-11-14 19:46:28', 0, '127.0.0.1', 'Windows 10.0', 'Email/Password', NULL, NULL, NULL),
(29, 12, '2024-11-14 15:22:48', '2024-11-14 19:53:50', 271, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(33, 11, '2024-11-14 20:20:40', '2024-11-14 20:20:47', 0, '127.0.0.1', 'Windows 10.0', 'Email/Password', NULL, NULL, NULL),
(36, 11, '2024-11-14 22:00:23', '2024-11-14 22:00:29', 0, '127.0.0.1', 'Windows 10.0', 'Email/Password', NULL, NULL, NULL),
(37, 11, '2024-11-19 12:02:28', '2024-11-19 12:02:31', 0, '127.0.0.1', 'Windows 10.0', 'Email/Password', NULL, NULL, NULL),
(39, 17, '2024-11-22 08:00:19', '2024-11-22 12:30:24', 270, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(40, 17, '2024-11-25 14:33:24', '2024-11-25 19:03:31', 270, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(41, 17, '2024-11-25 14:45:07', '2024-11-25 19:15:10', 270, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(42, 17, '2024-11-26 17:19:08', '2024-11-26 21:50:22', 271, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(43, 17, '2024-11-27 15:45:46', '2024-11-27 20:16:20', 270, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(44, 17, '2024-11-27 15:52:55', '2024-11-27 21:03:52', 310, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(45, 17, '2024-11-27 16:35:22', NULL, NULL, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(46, 17, '2024-11-29 15:13:31', '2024-11-29 21:02:12', 348, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(47, 17, '2024-11-29 17:39:14', NULL, NULL, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(48, 17, '2024-11-30 07:07:11', NULL, NULL, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(49, 17, '2024-11-30 17:00:04', NULL, NULL, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(50, 17, '2024-12-06 04:57:30', NULL, NULL, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(55, 17, '2024-12-06 06:26:37', NULL, NULL, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(56, 17, '2024-12-06 12:33:06', NULL, NULL, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(57, 17, '2024-12-06 17:00:47', '2024-12-06 21:44:52', 17045, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(58, 17, '2024-12-06 17:15:06', '2024-12-06 21:54:40', 16774, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(59, 17, '2024-12-06 17:31:37', NULL, NULL, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(60, 17, '2024-12-06 19:18:07', NULL, NULL, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(61, 17, '2024-12-06 19:18:43', NULL, NULL, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `airports`
--
ALTER TABLE `airports`
  ADD PRIMARY KEY (`airport_id`),
  ADD UNIQUE KEY `iata_code` (`iata_code`);

--
-- Indexes for table `flights`
--
ALTER TABLE `flights`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departure_airport_id` (`departure_airport_id`),
  ADD KEY `arrival_airport_id` (`arrival_airport_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `hotels` ADD FULLTEXT KEY `name` (`name`,`location`,`description`);

--
-- Indexes for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_room_hotel` (`hotel_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD PRIMARY KEY (`activity_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `airports`
--
ALTER TABLE `airports`
  MODIFY `airport_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `flights`
--
ALTER TABLE `flights`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `flights`
--
ALTER TABLE `flights`
  ADD CONSTRAINT `flights_ibfk_1` FOREIGN KEY (`departure_airport_id`) REFERENCES `airports` (`airport_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `flights_ibfk_2` FOREIGN KEY (`arrival_airport_id`) REFERENCES `airports` (`airport_id`) ON DELETE CASCADE;

--
-- Constraints for table `hotel_bookings`
--
ALTER TABLE `hotel_bookings`
  ADD CONSTRAINT `hotel_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `hotel_bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_room_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`email`) REFERENCES `person` (`email`) ON DELETE CASCADE;

--
-- Constraints for table `user_activity`
--
ALTER TABLE `user_activity`
  ADD CONSTRAINT `user_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
