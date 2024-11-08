<?php
session_start();
include './config.php';

if (!isset($_SESSION['email'])) {
    header("Location: ./PHP/login.php");
    exit();
}

$user_email = $_SESSION['email'];

// Process form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $contact_number = $_POST['contact_number'];
    $nationality = $_POST['nationality'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $street_address = $_POST['street_address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postal_code = $_POST['postal_code'];
    $country = $_POST['country'];

    // Split full name into first name and last name
    $name_parts = explode(' ', $full_name, 2);
    $fname = $name_parts[0];
    $lname = isset($name_parts[1]) ? $name_parts[1] : '';

    // Profile picture upload handling
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] == 0) {
        $profile_picture = 'uploads/' . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
    } else {
        // If no new profile picture is uploaded, keep the existing one
        $profile_picture_query = "SELECT profile_picture FROM person WHERE email = ?";
        $stmt = $conn->prepare($profile_picture_query);
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();
        $user_data = $result->fetch_assoc();
        $profile_picture = $user_data['profile_picture'];
    }

    // Update the user data in the database
    $query = "UPDATE person SET fname = ?, lname = ?, contact_number = ?, nationality = ?, dob = ?, gender = ?, street_address = ?, city = ?, state = ?, postal_code = ?, country = ?, profile_picture = ? WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssssssssss", $fname, $lname, $contact_number, $nationality, $dob, $gender, $street_address, $city, $state, $postal_code, $country, $profile_picture, $user_email);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Profile updated successfully!";
        $_SESSION['msg_type'] = "success";
    } else {
        $_SESSION['message'] = "Error updating profile.";
        $_SESSION['msg_type'] = "danger";
    }

    header("Location: ../profilepage.php");
    exit();
}
?>
