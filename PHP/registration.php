<?php
session_start();
require_once './config.php';

$errorMessages = [];



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    try {
        // Check if the email is already in use
        $query = "SELECT * FROM user WHERE email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $email]);

        if ($stmt->rowCount() > 0) {
            $errorMessages[] = "Email already in use.";
        }

        // Check if passwords match
        if ($password !== $confirm_password) {
            $errorMessages[] = "Passwords do not match.";
        }

        

        if (empty($errorMessages)) {
            // Hash the password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Start a transaction
            $pdo->beginTransaction();

            // Insert into person table
            $insertPerson = "INSERT INTO person (fname, lname, email) VALUES (:fname, :lname, :email)";
            $stmtPerson = $pdo->prepare($insertPerson);
            $stmtPerson->execute(['fname' => $fname, 'lname' => $lname, 'email' => $email]);

            // Insert into user table
            $insertUser = "INSERT INTO user (email, password) VALUES (:email, :password)";
            $stmtUser = $pdo->prepare($insertUser);
            $stmtUser->execute(['email' => $email, 'password' => $hashedPassword]);

            // Commit the transaction
            $pdo->commit();

            header("Location: ../loginpage.php?success=" . urlencode("Account created successfully. You can now log in."));
            exit();
        } else {
            // If there are validation errors, redirect back with error messages
            $errorString = implode(", ", $errorMessages);
            header("Location: ../loginpage.php?error=" . urlencode($errorString));
            exit();
        }
    } catch (Exception $e) {
        // Rollback transaction on error
        $pdo->rollBack();
        error_log($e->getMessage());
        
        $errorMessages[] = "Failed to create account. Please try again.";
        $errorString = implode(", ", $errorMessages);
        header("Location: ../loginpage.php?error=" . urlencode($errorString));
        exit();
    }
}
?>
