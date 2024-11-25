<!DOCTYPE html>
<html>
<head>
    <title>Add Hotel</title>
</head>
<body>
    <h2>Add a New Hotel</h2>
    <form action="insert_hotel.php" method="POST">
        <label for="name">Hotel Name:</label>
        <input type="text" id="name" name="name" required><br><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br><br>

        <label for="image_url">Image URL:</label>
        <input type="text" id="image_url" name="image_url"><br><br>

        <label for="city">City:</label>
        <input type="text" id="city" name="city"><br><br>

        <label for="state">State:</label>
        <input type="text" id="state" name="state"><br><br>

        <label for="country">Country:</label>
        <input type="text" id="country" name="country"><br><br>

        <label for="rating">Rating:</label>
        <input type="number" id="rating" name="rating" step="0.1" min="0" max="5"><br><br>

        <label for="latitude">Latitude:</label>
        <input type="text" id="latitude" name="latitude"><br><br>

        <label for="longitude">Longitude:</label>
        <input type="text" id="longitude" name="longitude"><br><br>

        <label for="capacity">Capacity:</label>
        <input type="number" id="capacity" name="capacity" required><br><br>

        <button type="submit">Add Hotel</button>
    </form>
</body>
</html>
