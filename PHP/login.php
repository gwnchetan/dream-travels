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
        // Check if the email exists in the admin table
        $stmt = $pdo->prepare("SELECT * FROM admin WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            // Admin found
            $admin = $stmt->fetch();

            if (password_verify($password, $admin['password'])) {
                // Set session for admin
                $_SESSION['admin_id'] = $admin['admin_id'];
                $_SESSION['email'] = $admin['email'];
                $_SESSION['name'] = $admin['name'];
                $_SESSION['logged_in'] = true;
                $_SESSION['role'] = 'Admin';

                // Log admin activity
                $loginMethod = 'Email/Password';
                $activityStmt = $pdo->prepare("INSERT INTO user_activity (user_id, ip_address, device_info, login_method) VALUES (?, ?, ?, ?)");
                $activityStmt->execute([$admin['admin_id'], $ipAddress, $deviceInfo, $loginMethod]);

                header("Location: ../admin_dashboard.php");
                exit();
            } else {
                $errorMessage = 'Incorrect password.';
                header("Location: ../loginpage.php?error=" . urlencode($errorMessage));
                exit();
            }
        } else {
            // If not in admin table, check in user table
            $stmt = $pdo->prepare("SELECT u.id, u.email, u.password, p.fname, p.lname FROM user u JOIN person p ON u.email = p.email WHERE u.email = ?");
            $stmt->execute([$email]);

            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch();

                if (password_verify($password, $user['password'])) {
                    // Set session for normal user
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['fname'] = $user['fname'];
                    $_SESSION['lname'] = $user['lname'];
                    $_SESSION['logged_in'] = true;
                    $_SESSION['role'] = 'User';

                    // Log user activity
                    $loginMethod = 'Email/Password';
                    $activityStmt = $pdo->prepare("INSERT INTO user_activity (user_id, ip_address, device_info, login_method) VALUES (?, ?, ?, ?)");
                    $activityStmt->execute([$user['id'], $ipAddress, $deviceInfo, $loginMethod]);

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
}
?>
