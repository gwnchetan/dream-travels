<?php
session_start();
include './config.php';

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: ./PHP/login.php");
    exit();
}

// Get the logged-in user's email
$user_email = $_SESSION['email'];

// Delete user data from the `person` table
$query = "DELETE FROM person WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();

// Check if deletion was successful
if ($stmt->affected_rows > 0) {
    // Successfully deleted, log the user out
    $_SESSION['message'] = "Your profile has been deleted successfully.";
    $_SESSION['msg_type'] = "success";
    session_unset();
    session_destroy();
    header("Location: goodbye.php"); // Redirect to a goodbye or landing page
} else {
    $_SESSION['message'] = "There was an error deleting your profile.";
    $_SESSION['msg_type'] = "danger";
    header("Location: ../profilepage.php"); // Redirect back to profile if deletion failed
}
exit();
?>
