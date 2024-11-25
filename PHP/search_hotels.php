<?php
session_start();
require_once "./PHP/config.php";

// Get search parameters from the GET request
$location = isset($_GET['location']) ? trim($_GET['location']) : '';
$guests = isset($_GET['guests']) ? (int)$_GET['guests'] : 1;

// Prepare the query based on location
$query = "SELECT * FROM hotels WHERE location LIKE :location";
$params = ['location' => "%$location%"];

try {
    // Execute the query
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $hotels = $stmt->fetchAll();

    // Store the results in the session
    $_SESSION['search_results'] = $hotels;

    // Redirect to booking_page.php
    header("Location: booking_page.php");
    exit;
} catch (PDOException $e) {
    // Handle errors
    $_SESSION['search_error'] = "Error fetching hotels: " . $e->getMessage();
    header("Location: booking_page.php");
    exit;
}
