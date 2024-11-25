<?php
// Database configuration
require_once './PHP/config.php';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Function to get access token
function getAccessToken($clientId, $clientSecret) {
    $tokenUrl = "https://test.api.amadeus.com/v1/security/oauth2/token";
    $postData = [
        'grant_type' => 'client_credentials',
        'client_id' => $clientId,
        'client_secret' => $clientSecret
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $tokenUrl);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/x-www-form-urlencoded"]);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        die('Curl error: ' . curl_error($ch));
    }
    curl_close($ch);

    $data = json_decode($response, true);
    return $data['access_token'] ?? null;
}

// Function to fetch hotels by city
function fetchHotelsByCity($accessToken, $cityCode) {
    $apiUrl = "https://test.api.amadeus.com/v1/reference-data/locations/hotels/by-city?cityCode=$cityCode";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        "Authorization: Bearer $accessToken",
        "Content-Type: application/json"
    ]);

    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        die('Curl error: ' . curl_error($ch));
    }
    curl_close($ch);

    return json_decode($response, true);
}

// Function to store hotel data in the database
function storeHotelData($pdo, $hotelData) {
    try {
        $sql = "INSERT INTO hotels (name, location, city, state, country, latitude, longitude, created_at, updated_at)
                VALUES (:name, :location, :city, :state, :country, :latitude, :longitude, NOW(), NOW())
                ON DUPLICATE KEY UPDATE updated_at = NOW()";

        $stmt = $pdo->prepare($sql);

        foreach ($hotelData as $hotel) {
            $stmt->execute([
                ':name'      => $hotel['name'],
                ':location'  => $hotel['address']['lines'][0] ?? '',
                ':city'      => $hotel['address']['cityName'] ?? '',
                ':state'     => $hotel['address']['stateCode'] ?? '',
                ':country'   => $hotel['address']['countryCode'] ?? '',
                ':latitude'  => $hotel['geoCode']['latitude'] ?? null,
                ':longitude' => $hotel['geoCode']['longitude'] ?? null,
            ]);
        }

        echo "Hotels stored successfully.<br>";
    } catch (\PDOException $e) {
        die("Error storing data: " . $e->getMessage());
    }
}


$clientId = "3vVMt5AfJYTTsctMen3RhH1PkTIL0ngv";
$clientSecret = "GqVuft41nfJWfWZP";

// City code to search for (e.g., RAJ for Gujarat)
$cityCode = "GUJ";

// Get access token
$accessToken = getAccessToken($clientId, $clientSecret);
if (!$accessToken) {
    die("Failed to authenticate with Amadeus API.");
}

// Fetch hotels in the city
$hotelsData = fetchHotelsByCity($accessToken, $cityCode);

if (!empty($hotelsData['data'])) {
    // Store the hotel data in the database
    storeHotelData($pdo, $hotelsData['data']);
} else {
    echo "No hotels found for city code: $cityCode.";
}
?>
