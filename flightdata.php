<?php
// API URL with the "flights" endpoint
$apiUrl = "http://api.aviationstack.com/v1/flights";

// API Key
$apiKey = "b225692d074398d7d138c87f8f2b148f";

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

    // Display the fetched data on the browser
    echo "<h2>Fetched Flight Data from AviationStack API:</h2>";
    
    // Display the data in a simple table
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>Flight Number</th><th>Airline</th><th>Departure Airport</th><th>Departure Time</th><th>Arrival Airport</th><th>Arrival Time</th></tr>";
    
    // Loop through each flight and display relevant info
    foreach ($data['data'] as $flight) {
        echo "<tr>";
        echo "<td>" . $flight['flight']['iata'] . "</td>";  // Flight number
        echo "<td>" . $flight['airline']['name'] . "</td>";  // Airline name
        echo "<td>" . $flight['departure']['airport'] . " (" . $flight['departure']['iata'] . ")</td>";  // Departure airport
        echo "<td>" . date("Y-m-d H:i:s", strtotime($flight['departure']['scheduled'])) . "</td>";  // Departure time (formatted)
        echo "<td>" . $flight['arrival']['airport'] . " (" . $flight['arrival']['iata'] . ")</td>";  // Arrival airport
        echo "<td>" . date("Y-m-d H:i:s", strtotime($flight['arrival']['scheduled'])) . "</td>";  // Arrival time (formatted)
        echo "</tr>";
    }
    echo "</table>";
}

// Close cURL
curl_close($ch);
?>
