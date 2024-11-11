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
    curl_close($ch);
    
    $token_data = json_decode($response, true);

    if (isset($token_data['access_token'])) {
        $access_token = $token_data['access_token'];

        // Retrieve user profile information
        $user_info_url = "https://www.googleapis.com/oauth2/v2/userinfo?access_token=$access_token";
        $user_info = file_get_contents($user_info_url);
        $user_data = json_decode($user_info, true);

        if (isset($user_data['email'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['fname'] = $user_data['given_name'];
            $_SESSION['lname'] = $user_data['family_name'];
            $_SESSION['email'] = $user_data['email'];
            $_SESSION['profile_picture'] = $user_data['picture'];

            // Check if user exists in the database, if not insert them
            require_once './config.php';
            $stmt = $pdo->prepare("SELECT * FROM person WHERE email = ?");
            $stmt->execute([$_SESSION['email']]);
            $user = $stmt->fetch();

            if (!$user) {
                $stmt = $pdo->prepare("INSERT INTO person (fname, lname, email, profile_picture) VALUES (?, ?, ?, ?)");
                $stmt->execute([$_SESSION['fname'], $_SESSION['lname'], $_SESSION['email'], $_SESSION['profile_picture']]);
            }

            // Redirect to index page
            header('Location: ../index.php');
            exit();
        }
    } else {
        echo "Error fetching access token!";
    }
} else {
    echo "No authorization code provided!";
}
?>
