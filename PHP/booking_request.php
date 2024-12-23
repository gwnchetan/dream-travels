<?php
require_once "./config.php"; // Ensure this is the correct path to your config file

session_start();

// Check if the form data is posted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $roomId = $_POST['room_id']; // Get the room ID from the form submission
    $checkIn = $_POST['check_in'];
    $checkOut = $_POST['check_out'];
    $userId = $_SESSION['user_id']; // Get user ID from session

    // Validate data
    if (empty($roomId) || empty($checkIn) || empty($checkOut) || empty($userId)) {
        die("The following booking details are missing: Room ID, User ID. Please check the required fields.");
    }

    try {
        // Prepare the booking data
        $query = "INSERT INTO hotel_bookings (room_id, user_id, check_in, check_out, status) VALUES (:room_id, :user_id, :check_in, :check_out, 'Pending')";
        $stmt = $pdo->prepare($query);
        $stmt->execute([
            ':room_id' => $roomId,
            ':user_id' => $userId,
            ':check_in' => $checkIn,
            ':check_out' => $checkOut
        ]);

        echo "Booking request sent successfully!";
        // Redirect to booking success page
        header("Location: ./booking_success.php");
        exit();
    } catch (PDOException $e) {
        die("Database error: " . $e->getMessage());
    }
} else {
    die("Invalid request method.");
}
?>
