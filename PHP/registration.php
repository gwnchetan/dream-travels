<?php
session_start();
require_once './config.php';

$errorMessages = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    $query = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $errorMessages[] = "Email already in use.";
    }

    if ($password !== $confirm_password) {
        $errorMessages[] = "Passwords do not match.";
    }

    if (empty($errorMessages)) {
        try {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $insertPerson = "INSERT INTO person (fname, lname, email) VALUES ('$fname', '$lname', '$email')";
            if (!mysqli_query($conn, $insertPerson)) {
                throw new Exception("Failed to insert into person table.");
            }

            $insertUser = "INSERT INTO user (email, password) VALUES ('$email', '$hashedPassword')";
            if (!mysqli_query($conn, $insertUser)) {
                throw new Exception("Failed to insert into user table.");
            }

            header("Location: ../loginpage.php?success=Account created successfully. You can now log in.");
            exit();

        } catch (Exception $e) {
            error_log($e->getMessage());

            $errorMessages[] = "Failed to create account. Please try again.";
            $errorString = implode(", ", $errorMessages);
            header("Location: ../loginpage.php?error=" . urlencode($errorString));
            exit();
        }
    } else {
        $errorString = implode(", ", $errorMessages);
        header("Location: ../loginpage.php?error=" . urlencode($errorString));
        exit();
    }
}
?>
