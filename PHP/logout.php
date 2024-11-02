<?php
session_start();
require_once './config.php';

if (isset($_SESSION['user_id'])) {
    $logoutTime = date("Y-m-d H:i:s");
    $loginTime = $_SESSION['login_time'];
    $sessionDuration = time() - $loginTime;

    $activityId = $_SESSION['activity_id'];
    $updateActivity = $conn->prepare("UPDATE user_activity SET logout_time = ?, session_duration = ? WHERE activity_id = ?");
    $updateActivity->bind_param("sii", $logoutTime, $sessionDuration, $activityId);
    $updateActivity->execute();
    
    session_unset();
    session_destroy();
}

header("Location: ../index.php");
exit();
?>
