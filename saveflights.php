<?php
require_once './php/config.php';

// API URL with the "airports" or relevant endpoint (modify this if needed)
$apiUrl = "http://api.aviationstack.com/v1/airports";
$apiKey = "b225692d074398d7d138c87f8f2b148f"; // Your API key

// Complete API URL with access key
$apiUrlWithKey = $apiUrl . "?access_key=" . $apiKey;

// Initialize cURL
$ch = curl_init();

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $apiUrlWithKey);  // Set the API URL with the key
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return the response as a string

// Execute cURL request and get the response
$response = curl_exec($ch);

// Check if there was an error
if($response === false) {
    echo "Error fetching data: " . curl_error($ch);
} else {
    // Decode the JSON response into an array
    $data = json_decode($response, true);

    // Loop through each airport and insert relevant data into the database
    foreach ($data['data'] as $airport) {
        $airportName = $airport['airport_name'];  // Airport name
        $cityName = $airport['city'];             // City name
        $countryName = $airport['country_name'];  // Country name
        $iataCode = $airport['iata_code'];        // IATA code (optional)

        // Prepare the SQL insert query
        $sql = "INSERT INTO `airport_details` (airport_name, city_name, country_name, iata_code) 
                VALUES (?, ?, ?, ?)";

        // Prepare and bind the statement
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $airportName, $cityName, $countryName, $iataCode);

        // Execute the statement
        if ($stmt->execute()) {
            echo "Data saved successfully for airport: $airportName<br>";
        } else {
            echo "Error saving data for airport: $airportName - " . $stmt->error . "<br>";
        }
    }
}

// Close cURL
curl_close($ch);

// Close the statement and connection
$stmt->close();
$conn->close();
?>
