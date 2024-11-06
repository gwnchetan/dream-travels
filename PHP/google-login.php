<?php
session_start();
require_once './config.php';
require_once 'vendor/autoload.php';

$clientID = "801533048919-jtbtlnmq82adqkmvs1v4etd3apvas3il.apps.googleusercontent.com"; // Replace with your actual Client ID
$data = json_decode(file_get_contents("php://input"));

if (!$data || !isset($data->id_token)) {
    echo json_encode(['success' => false, 'message' => 'No ID token provided']);
    exit;
}

$idToken = $data->id_token;
$client = new Google_Client(['client_id' => $clientID]);
$payload = $client->verifyIdToken($idToken);

header('Content-Type: application/json');
if ($payload) {
    $email = $payload['email'];
    $fname = $payload['given_name'];
    $lname = $payload['family_name'];

    // Check if the user exists
    $stmt = $conn->prepare("SELECT id FROM user WHERE email = ?");
    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Existing user, log them in
            $user = $result->fetch_assoc();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $email;
            $_SESSION['fname'] = $fname;
            $_SESSION['lname'] = $lname;
            $_SESSION['logged_in'] = true;

            echo json_encode(['success' => true]);
        } else {
            // New user, register them
            $stmt->close();
            $stmt = $conn->prepare("INSERT INTO person (fname, lname, email) VALUES (?, ?, ?)");
            if ($stmt) {
                $stmt->bind_param("sss", $fname, $lname, $email);
                $stmt->execute();
                $stmt->close();

                $stmt = $conn->prepare("INSERT INTO user (email) VALUES (?)");
                $stmt->bind_param("s", $email);
                $stmt->execute();

                $_SESSION['user_id'] = $conn->insert_id;
                $_SESSION['email'] = $email;
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['logged_in'] = true;

                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Failed to register user']);
            }
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare user check statement']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID token']);
}
?>
