<?php
session_start();
require_once './config.php';

function getUserIpAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return ($_SERVER['REMOTE_ADDR'] === '::1') ? '127.0.0.1' : $_SERVER['REMOTE_ADDR'];
    }
}

function getOSInfo($userAgent) {
    $osArray = [
        'Windows' => '/Windows NT ([0-9.]+)/',
        'Mac OS' => '/Macintosh|Mac OS X ([0-9_]+)/',
        'Linux' => '/Linux/',
        'Ubuntu' => '/Ubuntu/',
    ];

    foreach ($osArray as $os => $regex) {
        if (preg_match($regex, $userAgent, $matches)) {
            return isset($matches[1]) ? $os . ' ' . str_replace('_', '.', $matches[1]) : $os;
        }
    }
    return 'Unknown OS';
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $ipAddress = getUserIpAddress();
    $deviceInfo = getOSInfo($_SERVER['HTTP_USER_AGENT']);

    if (empty($email) || empty($password)) {
        $errorMessage = 'Email and password are required.';
        header("Location: loginpage.php?error=" . urlencode($errorMessage));
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMessage = 'Invalid email format.';
        header("Location: loginpage.php?error=" . urlencode($errorMessage));
        exit();
    } else {
        $stmt = $conn->prepare("SELECT u.id, u.email, u.password, p.fname, p.lname FROM user u JOIN person p ON u.email = p.email WHERE u.email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $stmt->bind_result($userId, $dbEmail, $hashedPassword, $fname, $lname);
            $stmt->fetch();

            if (password_verify($password, $hashedPassword)) {
                $_SESSION['user_id'] = $userId;
                $_SESSION['email'] = $dbEmail;
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['logged_in'] = true;
                $_SESSION['auth_provider'] = 'Email/Password'; // New for consistency with Google login

                $stmt = $conn->prepare("INSERT INTO user_activity (user_id, ip_address, device_info, login_method) VALUES (?, ?, ?, ?)");
                $loginMethod = 'Email/Password';
                $stmt->bind_param("isss", $userId, $ipAddress, $deviceInfo, $loginMethod);
                $stmt->execute();

                header("Location: ../index.php");
                exit();
            } else {
                $errorMessage = 'Incorrect password.';
                header("Location: ../loginpage.php?error=" . urlencode($errorMessage));
                exit();
            }
        } else {
            $errorMessage = 'No account found with this email.';
            header("Location: ../loginpage.php?error=" . urlencode($errorMessage));
            exit();
        }
    }
}
?>
