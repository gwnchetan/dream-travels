<?php
// Assuming you have already included your database connection
include_once './php/config.php';

// Initialize $error_message and debugging log
$error_message = '';
$debug_log = '';

// Check if the 'id' parameter is set and valid
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $hotelId = intval($_GET['id']); // Ensure it's an integer

    // Debug: Log hotel ID
    $debug_log .= "Hotel ID fetched from GET: $hotelId\n";

    // Fetch the hotel data from the database
    $query = "SELECT * FROM hotels WHERE id = :hotel_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':hotel_id', $hotelId, PDO::PARAM_INT);
    $stmt->execute();
    $hotel = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the hotel exists
    if (!$hotel) {
        $error_message = 'Hotel not found. Please ensure the provided ID is correct.';
        $debug_log .= "Hotel not found in the database for ID: $hotelId\n";
    } else {
        $debug_log .= "Hotel fetched successfully: " . print_r($hotel, true) . "\n";
    }
} else {
    $error_message = 'Invalid or missing hotel ID. Please provide a valid ID.';
    $debug_log .= "Invalid or missing hotel ID.\n";
}

// Handle the form submission for updating the hotel
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $hotelId = $_POST['id'];
    $hotelName = $_POST['hotel_name'];
    $description = $_POST['description'];
    $location = $_POST['location'];
    $rating = $_POST['rating'];
    $capacity = $_POST['capacity'];
    $imageUrl = $_POST['image_url']; // Changed to accept image URL instead of file
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];

    // Debug: Log POST data
    $debug_log .= "POST data received: " . print_r($_POST, true) . "\n";

    try {
        // Update query
        $updateQuery = "
            UPDATE hotels
            SET 
                name = :name,
                description = :description,
                location = :location,
                rating = :rating,
                capacity = :capacity,
                image_url = :image_url,
                latitude = :latitude,
                longitude = :longitude,
                city = :city,
                state = :state,
                country = :country
            WHERE id = :hotel_id
        ";

        $stmt = $pdo->prepare($updateQuery);
        $stmt->bindParam(':name', $hotelName);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':rating', $rating, PDO::PARAM_INT);
        $stmt->bindParam(':capacity', $capacity, PDO::PARAM_INT);
        $stmt->bindParam(':image_url', $imageUrl);
        $stmt->bindParam(':latitude', $latitude
    );
    $stmt->bindParam(':longitude', $longitude);
    $stmt->bindParam(':city', $city);
    $stmt->bindParam(':state', $state);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':hotel_id', $hotelId, PDO::PARAM_INT);

    if ($stmt->execute()) {
        $debug_log .= "Hotel details updated successfully in the database for ID: $hotelId\n";
    } else {
        $debug_log .= "Failed to update hotel details for ID: $hotelId\n";
    }

    // Redirect or show success message
    header('Location: admin.php?status=success');
    exit();
} catch (PDOException $e) {
    $error_message = 'Error updating hotel: ' . $e->getMessage();
    $debug_log .= "PDOException: " . $e->getMessage() . "\n";
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Hotel Information</title>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="./css/edit_page.css">
</head>
<body>
<div class="container">
    <h2>Edit Hotel Information</h2>

    <?php if ($error_message): ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php elseif ($hotel): ?>
        <div class="form-container">
            <div class="form-field">
                <form action="edit_hotel.php?id=<?php echo htmlspecialchars($hotel['id']); ?>" method="POST">
                    <input type="hidden" name="id" value="<?php echo htmlspecialchars($hotel['id']); ?>">

                    <label for="hotel_name">Hotel Name:</label>
                    <input type="text" id="hotel_name" name="hotel_name" placeholder="Enter Hotel Name" value="<?php echo htmlspecialchars($hotel['name']); ?>" required>

                    <label for="description">Description:</label>
                    <textarea id="description" name="description" placeholder="Provide a detailed description of the hotel" rows="6" maxlength="1000" required><?php echo htmlspecialchars($hotel['description']); ?></textarea>

                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" placeholder="Enter Address or City" value="<?php echo htmlspecialchars($hotel['location']); ?>" required>

                    <label for="rating">Rating:</label>
                    <select id="rating" name="rating" required>
                        <?php for ($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo $i; ?>" <?php echo ($hotel['rating'] == $i) ? 'selected' : ''; ?>><?php echo $i; ?> Star<?php echo ($i > 1) ? 's' : ''; ?></option>
                        <?php endfor; ?>
                    </select>

                    <label for="capacity">Capacity:</label>
                    <input type="number" id="capacity" name="capacity" placeholder="Enter Total Number of Rooms" value="<?php echo htmlspecialchars($hotel['capacity']); ?>" required>

                    <label for="image_url">Image URL:</label>
                    <input type="text" id="image_url" name="image_url" placeholder="Enter Image URL" value="<?php echo htmlspecialchars($hotel['image_url'] ?? ''); ?>" required>

                    <label for="latitude">Latitude:</label>
                    <input type="text" id="latitude" name="latitude" placeholder="Latitude" value="<?php echo htmlspecialchars($hotel['latitude']); ?>" required>

                    <label for="longitude">Longitude:</label>
                    <input type="text" id="longitude" name="longitude" placeholder="Longitude" value="<?php echo htmlspecialchars($hotel['longitude']); ?>" required>

                    <label for="city">City:</label>
                    <input type="text" id="city" name="city" placeholder="City" value="<?php echo htmlspecialchars($hotel['city']); ?>" required>

                    <label for="state">State:</label>
                    <input type="text" id="state" name="state" placeholder="State" value="<?php echo htmlspecialchars($hotel['state']); ?>" required>

                    <label for="country">Country:</label>
                    <input type="text" id="country" name="country" placeholder="Country" value="<?php echo htmlspecialchars($hotel['country']); ?>" required>

                    <button type="submit" class="save-btn">Save Changes</button>
                    <a href="admin.php"><button type="button" class="cancel-btn">Cancel</button></a>
                </form>
            </div>
        </div>
    <?php endif; ?>
    <!-- Debug Log -->
    <div class="debug-log">
        <h3>Debug Log:</h3>
        <pre><?php echo htmlspecialchars($debug_log); ?></pre>
    </div>
</div>
</body>
</html>
