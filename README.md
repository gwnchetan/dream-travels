	CREATE TABLE `person` (
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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


CREATE TABLE `user` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `email` varchar(100) NOT NULL,
 `password` varchar(255) DEFAULT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `email` (`email`),
 CONSTRAINT `user_ibfk_1` FOREIGN KEY (`email`) REFERENCES `person` (`email`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci


CREATE TABLE `user_activity` (
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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci