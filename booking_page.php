<?php
    session_start();
    require_once "./PHP/config.php";

    // Get search parameters from the URL
    $location = isset($_GET['location']) ? $_GET['location'] : '';
    $check_in = isset($_GET['check_in']) ? $_GET['check_in'] : '';
    $check_out = isset($_GET['check_out']) ? $_GET['check_out'] : '';
    $guests = isset($_GET['guests']) ? $_GET['guests'] : 1;  // Default to 1 guest if not provided

    // Check if the user is logged in
    $isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
    $profilePicture = './imgs/client-2.jpg';

    // Set profile information based on session data if logged in
    if ($isLoggedIn) {
        $profilePicture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : $profilePicture;
        $userFullName = $_SESSION['fname'] . ' ' . $_SESSION['lname'];
        $userEmail = $_SESSION['email'];
    } else {
        $userFullName = $userEmail = null;
    }

    // Prepare the SQL query to fetch hotels matching the location, city, and state
    $query = "
        SELECT * FROM hotels
        WHERE location LIKE :location
        OR city LIKE :city
        OR state LIKE :state
    ";

    // Prepare and execute the query
    $stmt = $pdo->prepare($query);

    // Use the location value for each condition (location, city, and state)
    $locationSearch = '%' . $location . '%';
    $stmt->execute([
        ':location' => $locationSearch,
        ':city' => $locationSearch,
        ':state' => $locationSearch
    ]);

    // Fetch all matching hotels
    $hotels = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Initialize an array to hold rooms for each hotel
    $hotelRooms = [];

    if ($hotels) {
        // For each hotel found, fetch its rooms
        foreach ($hotels as $hotel) {
            $hotelId = $hotel['id']; // Get the hotel's ID

            // Query to fetch rooms for this hotel
            $roomQuery = "SELECT * FROM rooms WHERE hotel_id = :hotel_id";
            $roomStmt = $pdo->prepare($roomQuery);
            $roomStmt->execute([':hotel_id' => $hotelId]);

            // Fetch rooms for the hotel
            $rooms = $roomStmt->fetchAll(PDO::FETCH_ASSOC);
            $hotelRooms[$hotelId] = $rooms; 
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet"/>
        <link rel="stylesheet" href="CSS/hotel.css" />
        <link rel="stylesheet" href="./css/bookingpage.css">
        <title>Hotel</title>
    </head>
    <body>
    <div id="wrap">
        <nav>
            <div class="nav__logo"><h3>Dreams Travelers</h3></div>
            <div id="option">
                <a href="#">Home</a>
                <a href="./flights.php">Flights</a>
                 <!-- Profile section -->
                <div id="profile" style="display: <?php echo $isLoggedIn ? 'block' : 'none'; ?>;" onclick="toggleProfileBox()">
                    <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture">
                </div>
                <div id="login_btn" style="display: <?php echo $isLoggedIn ? 'none' : 'block'; ?>;">
                    <a href="./loginpage.php">Login</a>
                </div>

                <!-- Profile box -->
                <div id="profile_box" style="display: none;">
                    <div id="profile_border">
                        <div class="profile-info">
                            <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture" class="profile-pic">
                            <p class="profile-name"><?php echo htmlspecialchars($userFullName); ?></p>
                        </div>
                        <p class="profile-email"><?php echo htmlspecialchars($userEmail); ?></p>
                        <hr> 
                        <ul class="profile-menu">
                            <li><a href="./profilepage.php"><i class="ri-settings-line"></i> Settings</a></li>
                            <li><a href="./PHP/logout.php" id="logout"><i class="ri-logout-box-line"></i> Sign Out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </div>
    <header class="section__container header__container">
    <div class="header__image__container">
        <div class="header__content">
        <h1>Enjoy Your Dream Vacation</h1>
        <p>Book Hotels, Flights and stay packages at the lowest price.</p>
        </div>
        <div class="booking__container">
        <form action="booking_page.php" method="GET">
                    <div class="form__group">
                        <div class="input__group">
                            <input type="text" name="location" id="search-location" required />
                            <label>Location</label>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="date" name="check_in" required />
                            <label>Check In</label>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="date" name="check_out" required />
                            <label>Check Out</label>
                        </div>
                    </div>
                    <div class="form__group">
                        <div class="input__group">
                            <input type="number" name="guests" required min="1" />
                            <label>Guests</label>
                        </div>
                    </div>
                    <button type="submit" class="btn"><i class="ri-search-line"></i> Find Hotels</button>
                </form>
        </div>
    </div>
    </header>

    <div class="container">
        <!-- Sidebar Section -->
        <aside class="sidebar">
        <h3>Filters</h3>
        <form method="GET" action="">
            <!-- Room Type Filter -->
            <h4>Room Type</h4>
            <ul>
                <li><input type="checkbox" name="room_type[]" value="Hotel"> Hotel</li>
                <li><input type="checkbox" name="room_type[]" value="Apartment"> Apartment</li>
                <li><input type="checkbox" name="room_type[]" value="Resort"> Resort</li>
                <li><input type="checkbox" name="room_type[]" value="Villa"> Villa</li>
                <li><input type="checkbox" name="room_type[]" value="Guest House"> Guest House</li>
            </ul>

            <!-- Price Range Filter -->
            <h4>Price Range</h4>
            <input type="number" name="min_price" placeholder="Min Price" min="0">
            <input type="number" name="max_price" placeholder="Max Price" min="0">

            <!-- Capacity Filter -->
            <h4>Capacity</h4>
            <select name="capacity">
                <option value="">Select Capacity</option>
                <option value="1">1 Person</option>
                <option value="2">2 People</option>
                <option value="3">3 People</option>
                <option value="4">4+ People</option>
            </select>

            <button type="submit" class="btn">Apply Filters</button>
        </form>
    </aside>

        <!-- Hotel Listings Section -->
        <section class="hotel-listings">
            <?php if ($hotels): ?>
                <?php foreach ($hotels as $hotel): ?>
                    <div class="hotel-card">
                        <img src="<?= htmlspecialchars($hotel['image_url']) ?>" alt="Hotel">
                        <div class="hotel-details">
                            <h3 class="hotel-title"><?= htmlspecialchars($hotel['name']) ?></h3>
                            <p class="hotel-location"><?= htmlspecialchars($hotel['location']) ?></p>
                            <div class="hotel-amenities">
                                <?php
                                $amenities = isset($hotel['amenities']) ? explode(',', $hotel['amenities']) : [];
                                foreach ($amenities as $amenity): ?>
                                    <span><?= htmlspecialchars($amenity) ?></span>
                                <?php endforeach; ?>
                            </div>
                            <?php if (isset($hotelRooms[$hotel['id']])): ?>
                                <?php foreach ($hotelRooms[$hotel['id']] as $room): ?>
                                    <div class="room-details">
                                        <p class="room-type"><?= htmlspecialchars($room['type']) ?></p>
                                        <p class="room-price">
                                            <?= isset($room['price']) ? htmlspecialchars($room['price']) : 'N/A' ?> / night
                                        </p>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            <p class="hotel-cancellation">
                                <?php
                                if (isset($hotel['is_free_cancellation']) && $hotel['is_free_cancellation']) {
                                    echo "<span style='color: green;'>Free Cancellation</span>";
                                } else {
                                    echo "<span style='color: red;'>Non-Refundable</span>";
                                }
                                ?>
                            </p>
                            <a href="./room_details.php?id=<?php echo $hotel['id']; ?>&location=<?php echo urlencode($location); ?>&check_in=<?php echo urlencode($check_in); ?>&check_out=<?php echo urlencode($check_out); ?>&guests=<?php echo urlencode($guests); ?>&user_id=<?php echo $_SESSION['user_id']; ?>">
    <button class="select-room-btn">Select Room</button>
</a>


                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No hotels found.</p>
            <?php endif; ?>
        </section>
    </div>
    <footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
          <h3></h3>
          <p>
            we are premier hotel booking website that offers a seamless and
            convenient way to find and book accommodations worldwide.
          </p>
          <p>
            With a user-friendly interface and a vast selection of hotels,
            Dreams Travlers aims to provide a stress-free experience for travelers
            seeking the perfect stay.
          </p>
        </div>
        <div class="footer__col">
          <h4>Company</h4>
          <p>About Us</p>
          <p>Our Team</p>
          <p>Blog</p>
          <p>Book</p>
          <p>Contact Us</p>
        </div>
        <div class="footer__col">
          <h4>Legal</h4>
          <p>FAQs</p>
          <p>Terms & Conditions</p>
          <p>Privacy Policy</p>
        </div>
        <div class="footer__col">
          <h4>Resources</h4>
          <p>Social Media</p>
          <p>Help Center</p>
          <p>Partnerships</p>
        </div>
      </div>
     </footer>


    <script src="JS/script.js"></script>
    </body>
    </html>
