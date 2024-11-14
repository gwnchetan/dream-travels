<?php
session_start();
require_once './config.php'; // Database connection

// Set timezone to Asia/Kolkata (Indian Time Zone)
date_default_timezone_set('Asia/Kolkata');

// Ensure that the database connection variable is available
global $pdo;

// Check if the user is logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Ensure user_id is set in the session
    if (isset($_SESSION['user_id'])) {
        // Capture the logout time and calculate session duration
        $logoutTime = date('Y-m-d H:i:s');
        $loginTime = isset($_SESSION['login_time']) ? $_SESSION['login_time'] : $logoutTime;
        $sessionDuration = strtotime($logoutTime) - strtotime($loginTime); // in seconds

        // Optional data (replace with actual values if available)
        $geolocation = isset($_SESSION['geolocation']) ? $_SESSION['geolocation'] : null;
        $pagesVisited = isset($_SESSION['pages_visited']) ? $_SESSION['pages_visited'] : null;
        $actions = isset($_SESSION['actions']) ? $_SESSION['actions'] : null;

        // Update user activity in the `user_activity` table
        $stmt = $pdo->prepare("UPDATE user_activity 
                               SET logout_time = ?, session_duration = ?, geolocation = ?, 
                                   pages_visited = ?, actions = ? 
                               WHERE user_id = ? 
                               ORDER BY activity_id DESC
                               LIMIT 1");
        $stmt->execute([$logoutTime, $sessionDuration, $geolocation, $pagesVisited, $actions, $_SESSION['user_id']]);
    }

    // Clear all session variables related to login
    $_SESSION = [];
    session_unset();

    // Destroy the session to ensure complete logout
    session_destroy();

    // Check if Google login is used, and clear Google-specific cookies or tokens
    if (isset($_COOKIE['google_auth'])) {
        setcookie('google_auth', '', time() - 3600, '/'); // Clear Google auth cookie
    }

    // If using Google OAuth API, include additional logout steps
    if (isset($_SESSION['google_token'])) {
        unset($_SESSION['google_token']); // Clear any Google session tokens
        // Redirect to Google logout URL to fully log out of Google if needed
        $googleLogoutUrl = "https://accounts.google.com/Logout"; 
        header("Location: $googleLogoutUrl"); // Optional Google logout
        exit();
    }
}

// Redirect to the home page after logout
header("Location: ../index.php");
exit();
?>
