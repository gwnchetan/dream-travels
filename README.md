# dream-travers-
create database bookings 
-- Step 1: Create the 'person' table
CREATE TABLE person (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fname VARCHAR(50) NOT NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL
);

-- Step 2: Create the 'user' table, linked to 'person' by email
CREATE TABLE user (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    FOREIGN KEY (email) REFERENCES person(email) ON DELETE CASCADE
);

-- Step 3: Create the 'user_activity' table for tracking user actions
CREATE TABLE user_activity (
    activity_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    login_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    logout_time DATETIME,
    session_duration INT,  -- session duration in seconds
    ip_address VARCHAR(45), -- stores IPv4 and IPv6 addresses
    device_info VARCHAR(100), -- stores user device information
    login_method VARCHAR(50), -- login method (e.g., "Email/Password", "OAuth")
    geolocation VARCHAR(100), -- optional geolocation data
    pages_visited TEXT,  -- stores list of pages visited in a session
    actions TEXT,  -- specific actions taken in the session
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);

-- Step 4: Create the 'user_security' table for security tracking
CREATE TABLE user_security (
    security_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    failed_login_attempts INT DEFAULT 0,
    two_factor_enabled BOOLEAN DEFAULT FALSE,
    last_password_change DATETIME,
    account_status ENUM('active', 'inactive', 'suspended') DEFAULT 'active',
    FOREIGN KEY (user_id) REFERENCES user(id) ON DELETE CASCADE
);
