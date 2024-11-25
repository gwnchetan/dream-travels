<?php
session_start();

// Database connection using PDO
try {
    $dsn = 'mysql:host=localhost;dbname=booking_system;charset=utf8mb4';
    $username = 'root';
    $password = '';
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ];
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if the user is logged in (either through Google or traditional login)
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

// Fetch hotel data from the database
$stmt = $pdo->query("SELECT * FROM hotels LIMIT 6"); // Fetch 6 hotels as an example
$hotels = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="CSS/hotel.css" />
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
      <p>Book Hotels, Flights and stay packages at lowest price.</p>
    </div>
    <div class="booking__container">
    <form action="booking_page.php" method="POST">
        <div class="form__group">
            <div class="input__group">
                <input type="text" name="location" required />
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

<section class="section__container popular__container">
  <h2 class="section__header">Popular Hotels</h2>
  <div class="popular__grid">
    <?php foreach ($hotels as $hotel): ?>
        <div class="popular__card">
            <img src="<?php echo htmlspecialchars($hotel['image_url']); ?>" alt="Hotel Image" />
            <div class="popular__content">
                <div class="popular__card__header">
                    <h4><?php echo htmlspecialchars($hotel['name']); ?></h4>
                    <h4>$<?php echo htmlspecialchars(number_format($hotel['rating'], 1)); ?></h4>
                </div>
                <p><?php echo htmlspecialchars($hotel['location']); ?></p>
            </div>
        </div>
    <?php endforeach; ?>
  </div>
</section>

<section class="client">
  <div class="section__container client__container">
    <h2 class="section__header">What our client say</h2>
    <div class="client__grid">
      <div class="client__card">
        <img src="./imgs/client-1.jpg" alt="client" />
        <p>
          The booking process was seamless, and the confirmation was
          instant. I highly recommend WDM&Co for hassle-free hotel bookings.
        </p>
      </div>
      <div class="client__card">
        <img src="./imgs/client-2.jpg" alt="client" />
        <p>
          The website provided detailed information about hotel, including
          amenities, photos, which helped me make an informed decision.
        </p>
      </div>
      <div class="client__card">
        <img src="./imgs/client-3.jpg" alt="client" />
        <p>
          I was able to book a room within minutes, and the hotel exceeded
          my expectations. I appreciate WDM&Co's efficiency and reliability.
        </p>
      </div>
    </div>
  </div>
</section>


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
</script>
</body>
</html>
