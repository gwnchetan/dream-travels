<?php
session_start();
include './config.php';

if (!isset($_SESSION['email'])) {
    header("Location: ./login.php");
    exit();
}

$user_email = $_SESSION['email'];

// Process form data
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $full_name = $_POST['full_name'];
    $contact_number = $_POST['contact_number'] ?? null;
    $nationality = $_POST['nationality'] ?? null;
    $dob = $_POST['dob'] ?? null;
    $gender = $_POST['gender'] ?? null;
    $street_address = $_POST['street_address'] ?? null;
    $city = $_POST['city'] ?? null;
    $state = $_POST['state'] ?? null;
    $postal_code = $_POST['postal_code'] ?? null;
    $country = $_POST['country'] ?? null;

    // Split full name into first and last names
    $name_parts = explode(' ', $full_name, 2);
    $fname = $name_parts[0];
    $lname = $name_parts[1] ?? '';

    // Profile picture upload handling
    if (isset($_FILES['profile_picture']) && $_FILES['profile_picture']['error'] === UPLOAD_ERR_OK) {
        $profile_picture = 'uploads/' . basename($_FILES['profile_picture']['name']);
        move_uploaded_file($_FILES['profile_picture']['tmp_name'], $profile_picture);
    } else {
        // Keep existing profile picture if none is uploaded
        $profile_picture_query = "SELECT profile_picture FROM person WHERE email = :email";
        $stmt = $pdo->prepare($profile_picture_query);
        $stmt->execute(['email' => $user_email]);
        $user_data = $stmt->fetch();
        $profile_picture = $user_data['profile_picture'] ?? 'default.jpg';
    }

    // Update user data in the database
    $query = "UPDATE person SET fname = :fname, lname = :lname, contact_number = :contact_number, nationality = :nationality, dob = :dob, gender = :gender, street_address = :street_address, city = :city, state = :state, postal_code = :postal_code, country = :country, profile_picture = :profile_picture WHERE email = :email";
    $stmt = $pdo->prepare($query);
    $params = [
        'fname' => $fname,
        'lname' => $lname,
        'contact_number' => $contact_number,
        'nationality' => $nationality,
        'dob' => $dob,
        'gender' => $gender,
        'street_address' => $street_address,
        'city' => $city,
        'state' => $state,
        'postal_code' => $postal_code,
        'country' => $country,
        'profile_picture' => $profile_picture,
        'email' => $user_email
    ];

    if ($stmt->execute($params)) {
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
