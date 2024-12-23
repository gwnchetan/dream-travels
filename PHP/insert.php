<?php
// Include database connection file (replace with your actual database connection)
require_once './config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form data
    $hotel_name = $_POST['hotel_name'];
    $hotel_description = $_POST['hotel_description'];
    $hotel_location = $_POST['hotel_location'];
    $hotel_capacity = $_POST['hotel_capacity'];

    $room_type = $_POST['room_type'];
    $room_capacity = $_POST['room_capacity'];
    $room_price = $_POST['room_price'];
    $room_availability = $_POST['room_availability'];

    try {
        // Begin transaction
        $pdo->beginTransaction();

        // Insert hotel data
        $hotelQuery = "INSERT INTO hotels (name, description, location, capacity) VALUES (:hotel_name, :hotel_description, :hotel_location, :hotel_capacity)";
        $stmt = $pdo->prepare($hotelQuery);
        $stmt->execute([
            ':hotel_name' => $hotel_name,
            ':hotel_description' => $hotel_description,
            ':hotel_location' => $hotel_location,
            ':hotel_capacity' => $hotel_capacity
        ]);

        // Get last inserted hotel ID
        $hotel_id = $pdo->lastInsertId();

        // Insert room data
        $roomQuery = "INSERT INTO rooms (hotel_id, type, capacity, price, availability_status) VALUES (:hotel_id, :room_type, :room_capacity, :room_price, :room_availability)";
        $stmt = $pdo->prepare($roomQuery);
        $stmt->execute([
            ':hotel_id' => $hotel_id,
            ':room_type' => $room_type,
            ':room_capacity' => $room_capacity,
            ':room_price' => $room_price,
            ':room_availability' => $room_availability
        ]);

        // Commit transaction
        $pdo->commit();

        echo "Hotel and Room data inserted successfully!";
    } catch (Exception $e) {
        // Rollback if an error occurs
        $pdo->rollBack();
        echo "Failed to insert data: " . $e->getMessage();
    }
}
?>
