<?php
require_once("./PHP/config.php"); // Adjust path if necessary

// Fetch the search term from the query parameter
$search = $_GET['term'] ?? ''; // Dynamic search from query

if (!empty($search)) {
    $stmt = $conn->prepare("SELECT DISTINCT flight_name FROM flight_details WHERE flight_name LIKE ?");
    $likeSearch = '%' . $search . '%';
    $stmt->bind_param("s", $likeSearch);
    $stmt->execute();
    
    $result = $stmt->get_result();
    $suggestions = [];

    // Fetch results and store them in the array
    while ($row = $result->fetch_assoc()) {
        $suggestions[] = $row['flight_name'];
    }
    
    // Send suggestions as JSON
    echo json_encode($suggestions);
    
    $stmt->close();
}
?>
