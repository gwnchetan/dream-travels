<?php
session_start();
require_once './config.php';
date_default_timezone_set('Asia/Kolkata');

// Function to revoke Google token if it exists in the session
function revokeGoogleToken($token) {
    $url = 'https://accounts.google.com/o/oauth2/revoke?token=' . $token;
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_exec($ch);
    curl_close($ch);
}

if (isset($_SESSION['user_id']) || isset($_SESSION['google_access_token'])) {
    // Check if it's a traditional login
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        $logoutTime = date('Y-m-d H:i:s');

        // Ensure connection is established with PDO
        if (!$pdo) {
            die("Database connection failed.");
        }

        // Prepare the update statement for logout time and session duration
        $stmt = $pdo->prepare("UPDATE user_activity SET logout_time = ?, session_duration = TIMESTAMPDIFF(SECOND, login_time, ?) WHERE user_id = ? AND logout_time IS NULL");

        if ($stmt) {
            // Execute the statement with parameters
            if (!$stmt->execute([$logoutTime, $logoutTime, $userId])) {
                error_log("Statement execution failed: " . implode(", ", $stmt->errorInfo()));
            }

            if ($stmt->rowCount() === 0) {
                error_log("Logout update failed for user_id: $userId");
            }
        } else {
            error_log("Statement preparation failed.");
        }
    }

    // If logged in with Google, revoke token
    if (isset($_SESSION['google_access_token'])) {
        revokeGoogleToken($_SESSION['google_access_token']);
    }

    // Clear session data
    $_SESSION = [];

    // Destroy session cookie if set
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destroy the session
    session_destroy();

    // Redirect to index.php
    if (!headers_sent()) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "<script>window.location.href='../index.php';</script>";
        exit();
    }
} else {
    // If no user is logged in, redirect directly
    header("Location: ../index.php");
    exit();
}
?>
