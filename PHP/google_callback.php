<?php
session_start();
require 'vendor/autoload.php';

// Initialize Google Client
$client = new Google_Client();
$client->setClientId('801533048919-jtbtlnmq82adqkmvs1v4etd3apvas3il.apps.googleusercontent.com');

// Retrieve ID token from POST data and verify it
$id_token = $_POST['id_token'] ?? null;
if (!$id_token) {
    echo json_encode(['success' => false, 'message' => 'ID token missing']);
    exit();
}

$payload = $client->verifyIdToken($id_token);
if ($payload) {
    // Extract user information from Google payload
    $google_id = $payload['sub'];
    $email = $payload['email'];
    $fname = $payload['given_name'];
    $lname = $payload['family_name'];
    $profile_picture = $payload['picture'] ?? './imgs/default-profile.png';

    // Connect to the database
    require_once './config.php';

    try {
        // Check if the user already exists based on Google ID or email
        $stmt = $pdo->prepare("SELECT id FROM person WHERE google_id = ? OR email = ?");
        $stmt->execute([$google_id, $email]);
        $user = $stmt->fetch();

        if (!$user) {
            // Register the new user in the 'person' table if they don't exist
            $stmt = $pdo->prepare("INSERT INTO person (fname, lname, email, profile_picture, google_id, auth_provider) VALUES (?, ?, ?, ?, ?, 'google')");
            $stmt->execute([$fname, $lname, $email, $profile_picture, $google_id]);
            $user_id = $pdo->lastInsertId();
        } else {
            $user_id = $user['id'];
        }

        // Set session variables for logged-in user
        $_SESSION['user_id'] = $user_id;
        $_SESSION['logged_in'] = true;
        $_SESSION['google_logged_in'] = true;
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['email'] = $email;
        $_SESSION['profile_picture'] = $profile_picture;

        // Respond with success
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        // Handle database errors gracefully
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    // Respond with an error if ID token is invalid
    echo json_encode(['success' => false, 'message' => 'Invalid ID token']);
}
?>
