<?php
session_start();
require_once "./PHP/config.php";

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ./loginpage.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $hotel_id = isset($data['hotel_id']) ? intval($data['hotel_id']) : 0;
    $action = isset($data['action']) ? $data['action'] : '';

    if ($hotel_id > 0 && in_array($action, ['accept_booking', 'reject_booking'])) {
        try {
            $status = $action === 'accept_booking' ? 'Accepted' : 'Rejected';
            $stmt = $pdo->prepare("UPDATE hotel_bookings SET status = :status WHERE id = :hotel_id");
            $stmt->execute([':status' => $status, ':hotel_id' => $hotel_id]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Booking status updated successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update booking status.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid input.']);
    }
    exit;
}

// Retrieve user data from the session
$profilePicture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : './imgs/default_profile.jpg';
$userFullName = isset($_SESSION['fname'], $_SESSION['lname']) ? $_SESSION['fname'] . ' ' . $_SESSION['lname'] : 'Unknown User';
$userEmail = isset($_SESSION['email']) ? $_SESSION['email'] : 'No Email Available';

// Database queries for dynamic data
$hotelRequests = [];
$flightRequests = [];
$rooms = [];

try {
    // Fetch hotel booking requests
    $stmt = $pdo->query("
        SELECT 
            hotels.id AS hotel_id, 
            hotels.name AS hotel_name,
            COUNT(hotel_bookings.room_id) AS rooms_booked,
            CONCAT(person.fname, ' ', person.lname) AS customer_name,
            hotel_bookings.status,
            hotel_bookings.is_hidden
        FROM hotel_bookings
        JOIN rooms ON hotel_bookings.room_id = rooms.id
        JOIN hotels ON rooms.hotel_id = hotels.id
        JOIN person ON hotel_bookings.user_id = person.id
        WHERE hotel_bookings.is_hidden = 0
        GROUP BY hotel_bookings.id
    ");
    $hotelRequests = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Fetch available rooms
    $sql = "
        SELECT 
            h.id AS hotel_id,
            h.name AS hotel_name, 
            h.image_url, 
            r.id AS room_id, 
            r.type AS room_type, 
            r.capacity AS room_capacity, 
            r.price AS room_price
        FROM hotels h
        JOIN rooms r ON h.id = r.hotel_id
        WHERE r.availability_status = 'Available'
        ORDER BY h.name
    ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
}

// Handle AJAX delete request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete_hotel') {
    if (isset($_POST['hotel_id']) && is_numeric($_POST['hotel_id'])) {
        $hotel_id = $_POST['hotel_id'];

        try {
            // Delete the hotel record
            $stmt = $pdo->prepare("DELETE FROM hotels WHERE id = :hotel_id");
            $stmt->bindParam(':hotel_id', $hotel_id, PDO::PARAM_INT);
            $stmt->execute();

            // Respond with success or failure
            if ($stmt->rowCount() > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Hotel deleted successfully.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Hotel not found or deletion failed.']);
            }
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid hotel ID.']);
    }
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="./css/admin.css">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.5.0/fonts/remixicon.css" rel="stylesheet" />
</head>
<body>
    <div class="container">
        <!-- Sidebar -->
        <aside>
            <div class="sidebar">
                <div id="wrap_pro">
                    <div id="profile">
                        <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture" />
                    </div>
                    <div id="pro_info">
                        <h4 id="name"><?php echo htmlspecialchars($userFullName); ?></h4>
                        <h4 id="email"><?php echo htmlspecialchars($userEmail); ?></h4>
                    </div>
                </div>
                <a href="#" id="dashbord">
                    <span class="material-symbols-sharp">grid_view</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#" id="bookings">
                    <span class="material-symbols-sharp">person_outline</span>
                    <h3>Bookings</h3>
                </a>
                <a href="#" id="hotels">
                    <span class="material-symbols-sharp">insights</span>
                    <h3>Hotels</h3>
                </a>
                <a href="#" id="flights">
                    <span class="material-symbols-sharp">mail_outline</span>
                    <h3>Flights</h3>
                </a>
                <a href="#" id="settings">
                    <span class="material-symbols-sharp">settings</span>
                    <h3>Settings</h3>
                </a>
                <a href="./PHP/logout.php">
                    <span class="material-symbols-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <main>
            <div id="dashbord_page">
                <h1>Dashboard</h1>
                <!-- Hotel Requests Section -->
                <div class="recent_order">
                    <h2>Hotel Requests</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Hotel Name</th>
                                <th>Rooms Booked</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
    <?php foreach ($hotelRequests as $request): ?>
        <tr>
            <td><?php echo htmlspecialchars($request['hotel_name']); ?></td>
            <td><?php echo htmlspecialchars($request['rooms_booked']); ?></td>
            <td><?php echo htmlspecialchars($request['customer_name']); ?></td>
            <td class="warning"><?php echo htmlspecialchars($request['status']); ?></td>
            <td>
                <?php if ($request['status'] === 'Pending'): ?>
                    <button class="accept" data-hotel-id="<?php echo htmlspecialchars($request['hotel_id']); ?>">Accept</button>
                    <button class="reject" data-hotel-id="<?php echo htmlspecialchars($request['hotel_id']); ?>">Reject</button>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>

                    </table>
                    <a href="#">Show All</a>
                </div>

                <!-- Flight Requests Section -->
                <div class="recent_order">
                    <h2>Flight Requests</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Airline</th>
                                <th>Flight Number</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                <th>Seats Booked</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($flightRequests as $request): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($request['airline_name']); ?></td>
                                    <td><?php echo htmlspecialchars($request['flight_number']); ?></td>
                                    <td><?php echo htmlspecialchars($request['departure_airport']); ?></td>
                                    <td><?php echo htmlspecialchars($request['arrival_airport']); ?></td>
                                    <td><?php echo htmlspecialchars($request['seats_booked']); ?></td>
                                    <td><?php echo htmlspecialchars($request['customer_name']); ?></td>
                                    <td class="warning"><?php echo htmlspecialchars($request['status']); ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="#">Show All</a>
                </div>
            </div>

            <!-- Hotels Page Content -->
            <div id="hotels_page">
                <h1>Listed Hotels</h1>

                <div class="hotel_container">
                    <div class="row">
                        <?php foreach ($rooms as $room): ?>
                            <div class="col">
                                <div class="listing-card" data-hotel-id="<?php echo htmlspecialchars($room['hotel_id']); ?>">
                                    <div id="imgs">
                                        <img src="<?php echo htmlspecialchars($room['image_url']); ?>" alt="Hotel Image">
                                    </div>
                                    <div id="hotel_info">
                                        <h3><?php echo htmlspecialchars($room['hotel_name']); ?></h3>
                                        <p>Room Type: <?php echo htmlspecialchars($room['room_type']); ?></p>
                                        <p>Capacity: <?php echo htmlspecialchars($room['room_capacity']); ?> people</p>
                                        <p id="price">Price: $<?php echo number_format($room['room_price'], 2); ?>/night</p>
                                    </div>
                                    <div class="actions">
                                        <a href="./edit_hotel.php?id=<?php echo htmlspecialchars($room['hotel_id']); ?>">
                                            <button class="edit-hotel">
                                                <i class="ri-edit-box-line"></i> Edit
                                            </button>
                                        </a>
                                        <button class="delete-hotel" data-hotel-id="<?php echo htmlspecialchars($room['hotel_id']); ?>" id="delete">
                                            <i class="ri-delete-bin-6-line"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <a href="#">Show All</a>
            </div>

            <!-- Bookings Page Content -->
            <div id="bookings_page" style="display: none;">
                <h1>Bookings</h1>
                <div class="booking_container">
                <div class="recent_order">
                    <h2>Hotel Requests</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Hotel Name</th>
                                <th>Rooms Booked</th>
                                <th>Customer Name</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($hotelRequests as $request): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($request['hotel_name']); ?></td>
                                    <td><?php echo htmlspecialchars($request['rooms_booked']); ?></td>
                                    <td><?php echo htmlspecialchars($request['customer_name']); ?></td>
                                    <td class="warning"><?php echo htmlspecialchars($request['status']); ?></td>
                                    <td>
                                        <?php if ($request['status'] === 'Pending'): ?>
                                            <button class="accept" data-hotel-id="<?php echo htmlspecialchars($request['hotel_id']); ?>">Accept</button>
                                            <button class="reject" data-hotel-id="<?php echo htmlspecialchars($request['hotel_id']); ?>">Reject</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                                               
                    <h2>All Bookings</h2>
                    <div class="recent_order" id="roomsSection">
                    <h2>Rooms</h2>
                    <table>
                        <thead>
                            <tr>
                                <th>Hotel</th>
                                <th>Room Type</th>
                                <th>Capacity</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($rooms as $room): ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($room['hotel_name']); ?></td>
                                    <td><?php echo htmlspecialchars($room['room_type']); ?></td>
                                    <td><?php echo htmlspecialchars($room['room_capacity']); ?></td>
                                    <td><?php echo htmlspecialchars($room['room_price']); ?></td>
                                    <td>
                                        <button class="delete" data-room-id="<?php echo htmlspecialchars($room['room_id']); ?>">Delete</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                    <p>No bookings to display yet!</p>
                </div>
            </div>
        </main>
    </div>

    <script src="./js/admin.js"></script>
</body>
</html>
