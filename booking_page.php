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
            <a href="#">Cab</a>

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
    <form action="booking_page.php" method="POST">
        <div class="form__group">
            <div class="input__group">
                <input type="text" name="location" id="search-location" autocomplete="off" />
                <label>Location</label>
                <ul id="suggestions" style="display: none;"></ul>
            </div>
        </div>
        <div class="form__group">
            <div class="input__group">
                <input type="date" name="check_in" />
                <label>Check In</label>
            </div>
        </div>
        <div class="form__group">
            <div class="input__group">
                <input type="date" name="check_out" />
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
        <h3>Hotel Type</h3>
        <ul>
            <li><input type="checkbox"> All</li>
            <li><input type="checkbox"> Hotel</li>
            <li><input type="checkbox"> Apartment</li>
            <li><input type="checkbox"> Resort</li>
            <li><input type="checkbox"> Villa</li>
            <li><input type="checkbox"> Guest House</li>
        </ul>
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
                            $amenities = explode(',', $hotel['amenities']);
                            foreach ($amenities as $amenity): ?>
                                <span><?= htmlspecialchars($amenity) ?></span>
                            <?php endforeach; ?>
                        </div>
                        <p class="hotel-price">$<?= htmlspecialchars($hotel['price']) ?> / day</p>
                        <?php if ($hotel['is_free_cancellation']): ?>
                            <p style="color: green;">Free Cancellation</p>
                        <?php else: ?>
                            <p style="color: red;">Non-Refundable</p>
                        <?php endif; ?>
                        <button class="select-room-btn">Select Room</button>
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
     <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
<script>
function toggleProfileBox() {
    const profileBox = document.getElementById('profile_box');
    profileBox.style.display = profileBox.style.display === 'block' ? 'none' : 'block';
}

function displayUserOptions() {
    const isLoggedIn = <?php echo json_encode($isLoggedIn); ?>;
    const profileIcon = document.getElementById('profile');
    const loginButton = document.getElementById('login_btn');

    if (isLoggedIn) {
        profileIcon.style.display = 'block';
        loginButton.style.display = 'none';
    } else {
        profileIcon.style.display = 'none';
        loginButton.style.display = 'block';
    }
}
window.onload = displayUserOptions;

const guestsInput = document.getElementById("guests-input");
    const dropdown = guestsInput.nextElementSibling;

    guestsInput.addEventListener("click", () => {
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    });

    const updateCounter = (type, change) => {
        const element = document.getElementById(type);
        let value = parseInt(element.textContent) + change;

        // Ensure values stay within valid ranges
        if (type === "adults" && value < 1) value = 1;
        if (type === "children" && value < 0) value = 0;
        if (type === "rooms" && value < 1) value = 1;

        element.textContent = value;
        updateGuestsInput();
    };

    const updateGuestsInput = () => {
        const adults = document.getElementById("adults").textContent;
        const children = document.getElementById("children").textContent;
        const rooms = document.getElementById("rooms").textContent;

        guestsInput.value = `${adults} Adults ${children} Children ${rooms} Room${rooms > 1 ? "s" : ""}`;
    };

    // Close dropdown when clicking outside
    document.addEventListener("click", (event) => {
        if (!guestsInput.contains(event.target) && !dropdown.contains(event.target)) {
            dropdown.style.display = "none";
        }
    });

    document.querySelector('.search-btn').addEventListener('click', function (e) {
    e.preventDefault(); // Prevent default form submission

    // Gather form data
    const formData = new FormData(document.querySelector('.booking_container form'));

    // Send AJAX request
    fetch('./php/search_hotels.php', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Display results dynamically (replace hotel listings)
                const hotelListings = document.querySelector('.hotel-listings');
                hotelListings.innerHTML = ''; // Clear current results

                data.data.forEach(hotel => {
                    hotelListings.innerHTML += `
                        <div class="hotel-card">
                            <img src="${hotel.image_url}" alt="Hotel">
                            <div class="hotel-details">
                                <h3 class="hotel-title">${hotel.name}</h3>
                                <p class="hotel-location">${hotel.location}</p>
                                <p class="hotel-price">$${hotel.price} / day</p>
                                <button class="select-room-btn">Select Room</button>
                            </div>
                        </div>`;
                });
            } else {
                alert(data.message); // Show error message
            }
        })
        .catch(error => console.error('Error:', error));
});

</script>

</body>
</html>