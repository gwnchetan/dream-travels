<?php
session_start();
require_once './config.php';

date_default_timezone_set('Asia/Kolkata');

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $logoutTime = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("UPDATE user_activity SET logout_time = ?, session_duration = TIMESTAMPDIFF(SECOND, login_time, ?) WHERE user_id = ? AND logout_time IS NULL");
    $stmt->bind_param("ssi", $logoutTime, $logoutTime, $userId);
    $stmt->execute();

    if ($stmt->affected_rows === 0) {
        error_log("Logout update failed for user_id: $userId");
    }

    $stmt->close();

    session_unset();
    session_destroy();

    if (!headers_sent()) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "<script>window.location.href='../index.php';</script>";
        exit();
    }
}
?>
