<?php
session_start();
require_once './config.php';

// Capture Search Parameters
$location = isset($_POST['location']) ? trim($_POST['location']) : '';
$checkIn = isset($_POST['dates']) ? explode(' - ', $_POST['dates'])[0] : null;
$checkOut = isset($_POST['dates']) ? explode(' - ', $_POST['dates'])[1] : null;

// Prepare Query
$query = "SELECT DISTINCT h.*
          FROM hotels h
          LEFT JOIN rooms r ON h.id = r.hotel_id
          LEFT JOIN bookings b ON r.id = b.room_id
          WHERE h.location LIKE :location";

// Append Date Filtering
if ($checkIn && $checkOut) {
    $query .= " AND (
                (b.check_in IS NULL AND b.check_out IS NULL) OR
                (:checkOut <= b.check_in OR :checkIn >= b.check_out)
              )";
}

$query .= " LIMIT 6"; // Optional: Limit results

// Execute Query
$stmt = $pdo->prepare($query);
$stmt->bindValue(':location', "%$location%", PDO::PARAM_STR);
if ($checkIn && $checkOut) {
    $stmt->bindValue(':checkIn', $checkIn, PDO::PARAM_STR);
    $stmt->bindValue(':checkOut', $checkOut, PDO::PARAM_STR);
}
$stmt->execute();
$hotels = $stmt->fetchAll();

// Return Results
if ($hotels) {
    echo json_encode(['success' => true, 'data' => $hotels]);
} else {
    echo json_encode(['success' => false, 'message' => 'No hotels found for your search criteria.']);
}
?>
