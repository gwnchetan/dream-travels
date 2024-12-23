<?php
// Include the database connection file
include('./config.php'); // Make sure your config file is correctly included

// Check if the hotel ID is passed in the URL
if (isset($_GET['id'])) {
    $hotelId = $_GET['id'];

    // Prepare the SQL query to delete the hotel from the database
    $query = "DELETE FROM hotels WHERE id = :hotel_id"; // Use 'id' instead of 'hotel_id'

    try {
        // Prepare the statement
        $stmt = $pdo->prepare($query);
        // Bind the hotel ID to the query
        $stmt->bindParam(':hotel_id', $hotelId, PDO::PARAM_INT);

        // Execute the query
        if ($stmt->execute()) {
            // Redirect to a confirmation page or back to the hotels list page
            header('Location: ../admin.php?status=deleted');
            exit();
        } else {
            // Handle any failure in query execution
            echo "Error deleting the hotel.";
        }
    } catch (PDOException $e) {
        // Handle any database connection or query errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // If no hotel ID is provided in the URL, redirect back to the hotel list page
    header('Location: ../admin.php');
    exit();
}
?>
