-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 25, 2024 at 06:32 PM
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
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `check_in` date NOT NULL,
  `check_out` date NOT NULL,
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending',
  `admin_comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `location` varchar(255) NOT NULL,
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

INSERT INTO `hotels` (`id`, `name`, `description`, `location`, `image_url`, `created_at`, `updated_at`, `city`, `state`, `country`, `rating`, `latitude`, `longitude`, `capacity`) VALUES
(1, 'Hotel Sapphire', 'A luxury hotel in the heart of Ahmedabad.', 'Ellis Bridge, Ahmedabad', 'https://example.com/hotel1.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Ahmedabad', 'Gujarat', 'India', 4.5, 23.02250000, 72.57140000, 150),
(2, 'Golden Leaf Resort', 'Peaceful stay with nature.', 'Nal Sarovar, Ahmedabad', 'https://example.com/hotel2.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Ahmedabad', 'Gujarat', 'India', 4, 22.99310000, 72.58050000, 80),
(3, 'Sunrise Inn', 'Budget-friendly hotel near Vadodara railway station.', 'Sayajigunj, Vadodara', 'https://example.com/hotel3.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Vadodara', 'Gujarat', 'India', 3.8, 22.30720000, 73.18120000, 100),
(4, 'Ocean Bliss', 'Hotel with a seaside view.', 'Dwarka Beach, Dwarka', 'https://example.com/hotel4.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Dwarka', 'Gujarat', 'India', 4.3, 22.23940000, 68.96740000, 120),
(5, 'Fort Heritage', 'Experience royal living.', 'Pavagadh, Vadodara', 'https://example.com/hotel5.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Vadodara', 'Gujarat', 'India', 4.6, 22.46710000, 73.51230000, 70),
(6, 'Desert Comfort', 'A unique desert-themed stay.', 'Rann of Kutch, Bhuj', 'https://example.com/hotel6.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Bhuj', 'Gujarat', 'India', 4.7, 23.24100000, 69.66690000, 60),
(7, 'Pearl Residency', 'Perfect for business travelers.', 'Paldi, Ahmedabad', 'https://example.com/hotel7.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Ahmedabad', 'Gujarat', 'India', 4.2, 23.02170000, 72.57140000, 110),
(8, 'Shiv Sagar Resort', 'Located near Gir National Park.', 'Sasan Gir, Junagadh', 'https://example.com/hotel8.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Junagadh', 'Gujarat', 'India', 4.8, 21.12410000, 70.48480000, 75),
(9, 'Hill View Retreat', 'Relaxing hill station stay.', 'Saputara, Dang', 'https://example.com/hotel9.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Dang', 'Gujarat', 'India', 4.5, 20.57970000, 73.75020000, 65),
(10, 'The Grand Plaza', 'Five-star hotel with top-notch amenities.', 'C G Road, Ahmedabad', 'https://example.com/hotel10.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Ahmedabad', 'Gujarat', 'India', 4.9, 23.03050000, 72.54610000, 200),
(11, 'Riverview Hotel', 'Stay by the Sabarmati River.', 'Ashram Road, Ahmedabad', 'https://example.com/hotel11.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Ahmedabad', 'Gujarat', 'India', 4.1, 23.03760000, 72.56180000, 130),
(12, 'Royal Orchid', 'Luxury hotel with heritage vibes.', 'Bhuj City', 'https://example.com/hotel12.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Bhuj', 'Gujarat', 'India', 4.4, 23.25430000, 69.66950000, 90),
(13, 'Green Woods Resort', 'Eco-friendly hotel surrounded by trees.', 'Dandi, Navsari', 'https://example.com/hotel13.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Navsari', 'Gujarat', 'India', 4.6, 20.95320000, 72.92790000, 85),
(14, 'Seaside Paradise', 'Resort near Mandvi Beach.', 'Mandvi, Kutch', 'https://example.com/hotel14.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Kutch', 'Gujarat', 'India', 4.2, 22.83380000, 69.35240000, 95),
(15, 'City Center Lodge', 'Affordable and convenient location.', 'Kalupur, Ahmedabad', 'https://example.com/hotel15.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Ahmedabad', 'Gujarat', 'India', 3.9, 23.03360000, 72.61630000, 120),
(16, 'Lighthouse Resort', 'Iconic stay with a view of the lighthouse.', 'Porbandar', 'https://example.com/hotel16.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Porbandar', 'Gujarat', 'India', 4.3, 21.64170000, 69.60930000, 100),
(17, 'Harmony Suites', 'Peaceful hotel in Gandhinagar.', 'Sector 11, Gandhinagar', 'https://example.com/hotel17.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Gandhinagar', 'Gujarat', 'India', 4, 23.21560000, 72.63690000, 140),
(18, 'Heritage Haveli', 'Stay in a historic haveli.', 'Surendranagar', 'https://example.com/hotel18.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Surendranagar', 'Gujarat', 'India', 4.1, 22.72720000, 71.64830000, 60),
(19, 'Urban Retreat', 'Modern hotel in Rajkot.', 'Yagnik Road, Rajkot', 'https://example.com/hotel19.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Rajkot', 'Gujarat', 'India', 4.2, 22.30390000, 70.80220000, 150),
(20, 'Golden Dunes', 'Desert luxury stay.', 'Little Rann of Kutch, Surendranagar', 'https://example.com/hotel20.jpg', '2024-11-25 16:36:59', '2024-11-25 16:36:59', 'Surendranagar', 'Gujarat', 'India', 4.5, 23.30770000, 71.90100000, 50),
(21, 'Hotel Royal Plaza', 'A grand hotel offering luxurious amenities.', 'Ashram Road, Ahmedabad', 'https://example.com/hotel21.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Ahmedabad', 'Gujarat', 'India', 4.6, 23.03360000, 72.61630000, 250),
(22, 'Silver Sands Resort', 'Seaside resort with a private beach.', 'Mandvi Beach, Kutch', 'https://example.com/hotel22.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Kutch', 'Gujarat', 'India', 4.5, 22.83960000, 69.35140000, 150),
(23, 'Saffron Palace', 'A royal stay with modern comforts.', 'Rajkot, Gujarat', 'https://example.com/hotel23.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Rajkot', 'Gujarat', 'India', 4.4, 22.30390000, 70.80220000, 120),
(24, 'Lavender Inn', 'Affordable yet elegant accommodations.', 'Gandhinagar', 'https://example.com/hotel24.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Gandhinagar', 'Gujarat', 'India', 3.9, 23.21560000, 72.63690000, 100),
(25, 'Desert Oasis', 'A peaceful retreat amidst the desert landscape.', 'Kutch', 'https://example.com/hotel25.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Kutch', 'Gujarat', 'India', 4.2, 23.24510000, 69.66650000, 80),
(26, 'The Imperial Residency', 'Lavish and grand accommodations in Surat.', 'Surat', 'https://example.com/hotel26.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Surat', 'Gujarat', 'India', 4.7, 21.17020000, 72.83110000, 180),
(27, 'Coral Reef Resort', 'A coastal retreat with a fantastic view.', 'Daman', 'https://example.com/hotel27.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Daman', 'Gujarat', 'India', 4.5, 20.39740000, 72.83110000, 150),
(28, 'Grand Sapphire', 'Modern hotel with conference facilities.', 'Vadodara', 'https://example.com/hotel28.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Vadodara', 'Gujarat', 'India', 4.3, 22.30720000, 73.18120000, 200),
(29, 'Rishabh Resort', 'A family-friendly resort with a water park.', 'Surat', 'https://example.com/hotel29.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Surat', 'Gujarat', 'India', 4.2, 21.17020000, 72.83110000, 150),
(30, 'Vibrant Villa', 'A luxurious stay with a home-like feel.', 'Vadodara', 'https://example.com/hotel30.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Vadodara', 'Gujarat', 'India', 4.4, 22.30720000, 73.18120000, 130),
(31, 'Cosmic Stay', 'A tech-savvy hotel for the modern traveler.', 'Ahmedabad', 'https://example.com/hotel31.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Ahmedabad', 'Gujarat', 'India', 4.1, 23.02250000, 72.57140000, 170),
(32, 'Skyline Heights', 'Hotel with an amazing city view.', 'Vadodara', 'https://example.com/hotel32.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Vadodara', 'Gujarat', 'India', 4.3, 22.30720000, 73.18120000, 110),
(33, 'The Heritage Hotel', 'A stay with a touch of history and culture.', 'Bhavnagar', 'https://example.com/hotel33.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Bhavnagar', 'Gujarat', 'India', 4.2, 21.76040000, 72.15440000, 140),
(34, 'Majestic Garden Resort', 'A resort surrounded by lush greenery.', 'Surat', 'https://example.com/hotel34.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Surat', 'Gujarat', 'India', 4.6, 21.17020000, 72.83110000, 160),
(35, 'Radha Krishna Hotel', 'Stay with traditional Indian hospitality.', 'Rajkot', 'https://example.com/hotel35.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Rajkot', 'Gujarat', 'India', 3.8, 22.30390000, 70.80220000, 120),
(36, 'Aditya Palace', 'Spacious rooms with a royal touch.', 'Gandhinagar', 'https://example.com/hotel36.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Gandhinagar', 'Gujarat', 'India', 4.5, 23.21560000, 72.63690000, 150),
(37, 'Mirage Resort', 'A unique resort experience amidst the desert.', 'Kutch', 'https://example.com/hotel37.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Kutch', 'Gujarat', 'India', 4, 23.24510000, 69.66650000, 90),
(38, 'Gold Coast Inn', 'A chic hotel with a contemporary design.', 'Daman', 'https://example.com/hotel38.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Daman', 'Gujarat', 'India', 4.3, 20.39740000, 72.83110000, 100),
(39, 'Hilltop Mansion', 'Hotel with a panoramic hill view.', 'Saputara', 'https://example.com/hotel39.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Saputara', 'Gujarat', 'India', 4.4, 20.57970000, 73.75020000, 120),
(40, 'Grand Ocean Resort', 'Luxury resort with oceanfront villas.', 'Dwarka', 'https://example.com/hotel40.jpg', '2024-11-25 16:39:37', '2024-11-25 16:39:37', 'Dwarka', 'Gujarat', 'India', 4.6, 22.23940000, 68.96740000, 200);

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
(1, 1, 'Suite', 4, 7500.00, 'https://example.com/room2.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Booked'),
(2, 2, 'Standard Room', 2, 3000.00, 'https://example.com/room3.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
(3, 3, 'Family Room', 5, 5000.00, 'https://example.com/room4.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
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
(15, 15, 'Budget Room', 2, 1800.00, 'https://example.com/room16.jpg', '2024-11-25 16:37:45', '2024-11-25 16:37:45', 'Available'),
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
(27, 27, 'Single Room', 1, 2500.00, 'https://example.com/room27.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available'),
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
(40, 40, 'Luxury Room', 4, 8500.00, 'https://example.com/room40.jpg', '2024-11-25 16:39:51', '2024-11-25 16:39:51', 'Available');

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
(29, 12, '2024-11-14 15:22:48', '2024-11-14 19:53:50', 16262, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(33, 11, '2024-11-14 20:20:40', '2024-11-14 20:20:47', 0, '127.0.0.1', 'Windows 10.0', 'Email/Password', NULL, NULL, NULL),
(36, 11, '2024-11-14 22:00:23', '2024-11-14 22:00:29', 0, '127.0.0.1', 'Windows 10.0', 'Email/Password', NULL, NULL, NULL),
(37, 11, '2024-11-19 12:02:28', '2024-11-19 12:02:31', 0, '127.0.0.1', 'Windows 10.0', 'Email/Password', NULL, NULL, NULL),
(39, 17, '2024-11-22 08:00:19', '2024-11-22 12:30:24', 16205, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(40, 17, '2024-11-25 14:33:24', '2024-11-25 19:03:31', 16207, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL),
(41, 17, '2024-11-25 14:45:07', '2024-11-25 19:15:10', 16203, '::1', 'Windows NT CHETAN 10.0 build 22621 (Windows 11) AMD64', '', NULL, NULL, NULL);

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
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_id` (`room_id`),
  ADD KEY `idx_user_status` (`user_id`,`status`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`id`);
ALTER TABLE `hotels` ADD FULLTEXT KEY `name` (`name`,`location`,`description`);

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
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `person`
--
ALTER TABLE `person`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_activity`
--
ALTER TABLE `user_activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE;

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
