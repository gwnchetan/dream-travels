<?php 
require_once "./PHP/config.php"; // Ensure this is the correct path to your config file

// Start the session
session_start();

// Check if user is logged in; otherwise, redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: ./loginpage.php"); // Adjust as per your login page path
    exit();
}

// Retrieve query parameters
$hotelId = isset($_GET['id']) ? $_GET['id'] : null;
$checkInDate = isset($_GET['check_in']) ? $_GET['check_in'] : 'Not specified';
$checkOutDate = isset($_GET['check_out']) ? $_GET['check_out'] : 'Not specified';
$guests = isset($_GET['guests']) ? $_GET['guests'] : null;

// Ensure the hotel ID is provided
if (!$hotelId) {
    die("Hotel ID is missing!");
}

try {
    // Fetch hotel details based on the hotel ID
    $query = "SELECT name, description, image_url FROM hotels WHERE id = :hotel_id";
    $stmt = $pdo->prepare($query);
    $stmt->execute([':hotel_id' => $hotelId]);
    $hotel = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if hotel data was found
    if (!$hotel) {
        die("Hotel not found!");
    }

    // Fetch rooms for the selected hotel
    $roomQuery = "SELECT * FROM rooms WHERE hotel_id = :hotel_id";
    $roomStmt = $pdo->prepare($roomQuery);
    $roomStmt->execute([':hotel_id' => $hotelId]);
    $rooms = $roomStmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare carousel images (fallback to placeholder if no images)
    $carouselImages = $hotel['image_url'] ? [$hotel['image_url']] : ['https://via.placeholder.com/400x200'];

    // Prepare booking summary (using the first room's price as default)
    $roomPrice = $rooms[0]['price'] ?? 0;
    $bookingSummary = [
        'check_in' => $checkInDate,
        'check_out' => $checkOutDate,
        'room_cost' => $roomPrice,
        'taxes' => round($roomPrice * 0.1),
        'total' => $roomPrice + round($roomPrice * 0.1),
    ];
} catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Booking</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Styles */
        body {
            background-color: #f8f9fa;
        }
        .hero-carousel img {
            height: 400px;
            object-fit: cover;
        }
        .room-card img {
            height: 200px;
            object-fit: cover;
        }
        .price-summary {
            position: sticky;
            top: 10px;
        }
        .scroll-up-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 50%;
            display: none;
            z-index: 1000;
            cursor: pointer;
        }
        .scroll-up-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <section class="hero-carousel container mt-4">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <?php foreach ($carouselImages as $index => $image): ?>
                    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?= $index ?>" class="<?= $index === 0 ? 'active' : '' ?>" aria-label="Slide <?= $index + 1 ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($carouselImages as $index => $image): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <img src="<?= htmlspecialchars($image) ?>" class="d-block w-100" alt="Slide">
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mt-5" style="border:2px solid black; border-radius:13px; padding:30px;">
        <div class="row">
            <!-- Hotel Details Section -->
            <div class="col-md-8">
                <h2>Available Rooms</h2>
                
                <!-- Room Selection Section -->
                <?php foreach ($rooms as $room): ?>
                    <div class="room mb-3">
                        <img src="<?= htmlspecialchars($room['image_url'] ?? 'https://via.placeholder.com/400x200') ?>" alt="Room Image" style="width: 400px; height: 200px;">
                        <div class="room-details">
                            <h3><?= htmlspecialchars($hotel['name']) ?></h3>
                            <h5><?= htmlspecialchars($room['type']) ?></h5>
                            <p><?= htmlspecialchars($hotel['description']) ?></p>
                            <p><strong>₹<?= number_format($room['price']) ?>/night</strong></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
                    
            <!-- Price Summary Section -->
            <div class="col-md-4">
                <div class="price-summary p-3 border rounded bg-white shadow">
                    <h4>Booking Summary</h4>
                    <p>Check-in: <span><?= htmlspecialchars($bookingSummary['check_in']) ?></span></p>
                    <p>Check-out: <span><?= htmlspecialchars($bookingSummary['check_out']) ?></span></p>
                    <hr>
                    <p>Room Cost: ₹<?= number_format($bookingSummary['room_cost']) ?></p>
                    <p>Taxes & Fees: ₹<?= number_format($bookingSummary['taxes']) ?></p>
                    <hr>
                    <h5>Total: ₹<?= number_format($bookingSummary['total']) ?></h5>

                    <!-- Send Request Button -->
                    <button class="btn btn-success w-100 mt-3" id="sendRequestBtn" data-bs-toggle="modal" data-bs-target="#bookingRequestModal">Send Request</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal to confirm booking request -->
    <!-- Booking Request Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="bookingModalLabel">Confirm Your Booking Request</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to send a booking request for this room?</p>
        <p><strong>Check-in Date:</strong> <?php echo htmlspecialchars($check_in); ?></p>
        <p><strong>Check-out Date:</strong> <?php echo htmlspecialchars($check_out); ?></p>
        <p><strong>Room Cost:</strong> ₹<?php echo number_format($room_cost, 2); ?> per night</p>
        <p><strong>Taxes & Fees:</strong> ₹<?php echo number_format($taxes, 2); ?></p>
        <hr>
        <p><strong>Total:</strong> ₹<?php echo number_format($total, 2); ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <form action="booking_request.php" method="POST">
          <input type="hidden" name="hotel_id" value="<?php echo htmlspecialchars($hotel_id); ?>">
          <input type="hidden" name="room_id" value="<?php echo htmlspecialchars($room_id); ?>">
          <input type="hidden" name="check_in" value="<?php echo htmlspecialchars($check_in); ?>">
          <input type="hidden" name="check_out" value="<?php echo htmlspecialchars($check_out); ?>">
          <input type="hidden" name="room_cost" value="<?php echo htmlspecialchars($room_cost); ?>">
          <input type="hidden" name="taxes" value="<?php echo htmlspecialchars($taxes); ?>">
          <input type="hidden" name="total" value="<?php echo htmlspecialchars($total); ?>">
          <button type="submit" class="btn btn-primary">Send Request</button>
        </form>
      </div>
    </div>
  </div>
</div>


    <!-- Scroll to Top Button -->
    <button class="scroll-up-btn" id="scrollUpBtn" title="Go to top">&#8593;</button>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Scroll to top functionality
        document.getElementById('scrollUpBtn').addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });

        // Show/hide the scroll-up button
        window.onscroll = function () {
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                document.getElementById('scrollUpBtn').style.display = "block";
            } else {
                document.getElementById('scrollUpBtn').style.display = "none";
            }
        };
    </script>
</body>
</html>
