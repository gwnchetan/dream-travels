
Table	Create table
admin	CREATE TABLE `admin` (
 `admin_id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(100) NOT NULL,
 `email` varchar(100) NOT NULL,
 `password` varchar(255) NOT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`admin_id`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
airports	CREATE TABLE `airports` (
 `airport_id` int(11) NOT NULL AUTO_INCREMENT,
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
 `status` tinyint(1) DEFAULT 1,
 PRIMARY KEY (`airport_id`),
 UNIQUE KEY `iata_code` (`iata_code`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
bookings	CREATE TABLE `bookings` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `room_id` int(11) NOT NULL,
 `check_in` date NOT NULL,
 `check_out` date NOT NULL,
 `status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending',
 `admin_comment` text DEFAULT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 PRIMARY KEY (`id`),
 KEY `room_id` (`room_id`),
 KEY `idx_user_status` (`user_id`,`status`),
 CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
 CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
hotels	CREATE TABLE `hotels` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
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
 `capacity` int(11) NOT NULL,
 PRIMARY KEY (`id`),
 FULLTEXT KEY `name` (`name`,`location`,`description`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
person	CREATE TABLE `person` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
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
 `gender` enum('Male','Female','Other') DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
rooms	CREATE TABLE `rooms` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `hotel_id` int(11) NOT NULL,
 `type` varchar(50) NOT NULL,
 `capacity` int(11) NOT NULL,
 `price` decimal(10,2) NOT NULL,
 `image_url` varchar(255) DEFAULT NULL,
 `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
 `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
 `availability_status` enum('Available','Booked') DEFAULT 'Available',
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
user	CREATE TABLE `user` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `email` varchar(100) NOT NULL,
 `password` varchar(255) DEFAULT NULL,
 `role` enum('Admin','User') DEFAULT 'User',
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`),
 CONSTRAINT `user_ibfk_1` FOREIGN KEY (`email`) REFERENCES `person` (`email`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
user_activity	CREATE TABLE `user_activity` (
 `activity_id` int(11) NOT NULL AUTO_INCREMENT,
 `user_id` int(11) NOT NULL,
 `login_time` datetime DEFAULT current_timestamp(),
 `logout_time` datetime DEFAULT NULL,
 `session_duration` int(11) DEFAULT NULL,
 `ip_address` varchar(45) DEFAULT NULL,
 `device_info` varchar(100) DEFAULT NULL,
 `login_method` enum('Email/Password','OAuth') DEFAULT NULL,
 `geolocation` varchar(100) DEFAULT NULL,
 `pages_visited` text DEFAULT NULL,
 `actions` text DEFAULT NULL,
 PRIMARY KEY (`activity_id`),
 KEY `user_id` (`user_id`),
 CONSTRAINT `user_activity_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci
