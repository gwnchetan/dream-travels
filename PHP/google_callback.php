<?php
session_start();
require 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('801533048919-jtbtlnmq82adqkmvs1v4etd3apvas3il.apps.googleusercontent.com');

$id_token = $_POST['id_token'];
$payload = $client->verifyIdToken($id_token);

if ($payload) {
    $google_id = $payload['sub'];
    $email = $payload['email'];
    $fname = $payload['given_name'];
    $lname = $payload['family_name'];

    // Check if the user exists
    require_once 'db_connection.php';
    $stmt = $pdo->prepare("SELECT id FROM person WHERE google_id = ? OR email = ?");
    $stmt->execute([$google_id, $email]);
    $user = $stmt->fetch();

    if (!$user) {
        // Register new user if not exists
        $stmt = $pdo->prepare("INSERT INTO person (fname, lname, email, google_id, auth_provider) VALUES (?, ?, ?, ?, 'google')");
        $stmt->execute([$fname, $lname, $email, $google_id]);
        $user_id = $pdo->lastInsertId();
    } else {
        $user_id = $user['id'];
    }

    // Set session for logged-in user
    $_SESSION['user_id'] = $user_id;
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID token']);
}
?>
