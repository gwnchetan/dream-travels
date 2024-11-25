<?php
require_once './config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($name) || empty($email) || empty($password)) {
        $error = "All fields are required.";
        header("Location: ../admin_registration.php?error=" . urlencode($error));
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
        header("Location: ../admin_registration.php?error=" . urlencode($error));
        exit();
    }

    // Check if admin already exists
    $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $error = "An admin with this email already exists.";
        header("Location: ../admin_registration.php?error=" . urlencode($error));
        exit();
    }

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    // Insert new admin into the database
    $insertStmt = $pdo->prepare("INSERT INTO admin (name, email, password) VALUES (?, ?, ?)");
    if ($insertStmt->execute([$name, $email, $hashedPassword])) {
        $success = "Admin registered successfully.";
        header("Location: ../loginpage.php?success=" . urlencode($success));
        exit();
    } else {
        $error = "Something went wrong. Please try again.";
        header("Location: ../admin_registration.php?error=" . urlencode($error));
        exit();
    }
} else {
    header("Location: ../admin_registration.php");
    exit();
}
