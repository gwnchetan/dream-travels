<?php
session_start();
require_once './google_config.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Exchange authorization code for an access token
    $token_url = "https://oauth2.googleapis.com/token";
    $postData = [
        'code' => $code,
        'client_id' => '801533048919-jtbtlnmq82adqkmvs1v4etd3apvas3il.apps.googleusercontent.com',
        'client_secret' => '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',
        'redirect_uri' => 'http://localhost/bookings/PHP/call_back.php',
        'grant_type' => 'authorization_code',
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);

    if ($response === false) {
        die('Curl error: ' . curl_error($ch));
    }

    curl_close($ch);
    $token_data = json_decode($response, true);

    if (isset($token_data['error'])) {
        die('Google API error: ' . $token_data['error_description']);
    }

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        // Retrieve user profile information
        $user_info_url = "https://www.googleapis.com/oauth2/v2/userinfo?access_token=$access_token";
        $user_info = file_get_contents($user_info_url);
        $user_data = json_decode($user_info, true);

        if (isset($user_data['email'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['fname'] = $user_data['given_name'];
            $_SESSION['lname'] = $user_data['family_name'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['profile_picture'] = $user_data['picture'];
            $_SESSION['login_method'] = "Google"; // Set login method to Google

            // Fetch user's IP address
            $ip_address = $_SERVER['REMOTE_ADDR'];
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                $ip_address = $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
            }

            // Check if user exists in the database, if not insert them in both user and person tables
            require_once './config.php';

            // Check if user exists in person table
            $stmt = $pdo->prepare("SELECT id FROM person WHERE email = ?");
            $stmt->execute([$_SESSION['email']]);
            $person = $stmt->fetch();

            if (!$person) {
                // Insert into person table
                $stmt = $pdo->prepare("INSERT INTO person (fname, lname, email, profile_picture) VALUES (?, ?, ?, ?)");
                $stmt->execute([$_SESSION['fname'], $_SESSION['lname'], $_SESSION['email'], $_SESSION['profile_picture']]);

                // Get the person table ID to use as a reference in user table
                $person_id = $pdo->lastInsertId();

                // Insert into user table (required for foreign key reference in user_activity)
                $stmt = $pdo->prepare("INSERT INTO user (email, password, id) VALUES (?, ?, ?)");
                $stmt->execute([$_SESSION['email'], null, $person_id]);
                $_SESSION['user_id'] = $person_id;
            } else {
                $_SESSION['user_id'] = $person['id']; // Use existing user ID
            }

            // Store login time, device info, IP address, and login method in user_activity
            $_SESSION['login_time'] = date('Y-m-d H:i:s');
            $device_info = php_uname(); // Capture basic device info (can be customized)

            $stmt = $pdo->prepare("INSERT INTO user_activity (user_id, login_time, device_info, login_method, ip_address) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$_SESSION['user_id'], $_SESSION['login_time'], $device_info, $_SESSION['login_method'], $ip_address]);

            // Redirect to index page
            header('Location: ../index.php');
            exit();
        } else {
            die("Error retrieving user data!");
        }
    } else {
        die("Error fetching access token!");
    }
} else {
    die("No authorization code provided!");
}
?>