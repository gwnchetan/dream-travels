<?php
session_start();
require_once './config.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Server-side validations
    if (empty($email) || empty($password)) {
        $errorMessage = 'Email and password are required.';
        header("Location: loginpage.php?error=" . urlencode($errorMessage));
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Invalid email format.';
        header("Location: loginpage.php?error=" . urlencode($errorMessage));
        exit();
    } else {
        // Check if email exists in the user table
        $stmt = $conn->prepare("SELECT u.id, u.email, u.password, p.fname, p.lname FROM user u JOIN person p ON u.email = p.email WHERE u.email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId, $dbEmail, $hashedPassword, $fname, $lname);
            $stmt->fetch();

            // Verify the password
            if (password_verify($password, $hashedPassword)) {
                // Successful login
                $_SESSION['user_id'] = $userId;  // Store user ID in session
                $_SESSION['email'] = $dbEmail;   // Store email in session
                $_SESSION['fname'] = $fname;     // Store first name in session
                $_SESSION['lname'] = $lname;     // Store last name in session
                $_SESSION['login_time'] = time();  // Record login time for session tracking

                // Record login in user_activity table
                $loginTime = date("Y-m-d H:i:s");
                $activityStmt = $conn->prepare("INSERT INTO user_activity (user_id, login_time, login_method) VALUES (?, ?, ?)");
                $loginMethod = 'Email/Password';
                $activityStmt->bind_param("iss", $userId, $loginTime, $loginMethod);

                if ($activityStmt->execute()) {
                    // Redirect to index.php after successful login
                    header("Location: ../index.php");
                    exit();
                } else {
                    $errorMessage = 'Failed to record login activity.';
                    header("Location: ../loginpage.php?error=" . urlencode($errorMessage));
                    exit();
                }
            } else {
                $errorMessage = 'Incorrect password.';
                header("Location: ../loginpage.php?error=" . urlencode($errorMessage));
                exit();
            }
        } else {
            $errorMessage = 'No account found with that email.';
            header("Location: ../loginpage.php?error=" . urlencode($errorMessage));
            exit();
        }
    }
}
?>
