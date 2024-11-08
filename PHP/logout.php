<?php
session_start();
require_once './config.php';

date_default_timezone_set('Asia/Kolkata');

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $logoutTime = date('Y-m-d H:i:s');

    // Ensure connection is established
    if (!$conn) {
        die("Database connection failed: " . $conn->connect_error);
    }

    // Prepare the update statement for logout time and session duration
    $stmt = $conn->prepare("UPDATE user_activity SET logout_time = ?, session_duration = TIMESTAMPDIFF(SECOND, login_time, ?) WHERE user_id = ? AND logout_time IS NULL");
    
    if ($stmt) {
        $stmt->bind_param("ssi", $logoutTime, $logoutTime, $userId);
        
        // Execute the statement and check for execution success
        if (!$stmt->execute()) {
            error_log("Statement execution failed: " . $stmt->error);
        }

        if ($stmt->affected_rows === 0) {
            error_log("Logout update failed for user_id: $userId");
        }

        $stmt->close();
    } else {
        error_log("Statement preparation failed: " . $conn->error);
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
}
?>
