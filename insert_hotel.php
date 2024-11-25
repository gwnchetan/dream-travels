<?php
// Database connection
require_once './PHP/config.php';

// Check if POST data is set
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $description = $conn->real_escape_string($_POST['description']);
    $location = $conn->real_escape_string($_POST['location']);
    $image_url = $conn->real_escape_string($_POST['image_url']);
    $city = $conn->real_escape_string($_POST['city']);
    $state = $conn->real_escape_string($_POST['state']);
    $country = $conn->real_escape_string($_POST['country']);
    $rating = isset($_POST['rating']) ? (float) $_POST['rating'] : 0;
    $latitude = isset($_POST['latitude']) ? (float) $_POST['latitude'] : null;
    $longitude = isset($_POST['longitude']) ? (float) $_POST['longitude'] : null;
    $capacity = (int) $_POST['capacity'];

    // SQL query to insert data
    $sql = "INSERT INTO hotels (name, description, location, image_url, city, state, country, rating, latitude, longitude, capacity) 
            VALUES ('$name', '$description', '$location', '$image_url', '$city', '$state', '$country', $rating, $latitude, $longitude, $capacity)";

    if ($conn->query($sql) === TRUE) {
        echo "New hotel added successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
