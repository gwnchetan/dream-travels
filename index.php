<?php
session_start();
require_once "./PHP/config.php";

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$profilePicture = $isLoggedIn && isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : './imgs/client-2.jpg';
$userFullName = $isLoggedIn ? $_SESSION['fname'] . ' ' . $_SESSION['lname'] : null;
$userEmail = $isLoggedIn ? $_SESSION['email'] : null;

// Fetch popular hotels for display
$stmt = $pdo->query("SELECT * FROM hotels limit 6");
$hotels = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="CSS/hotel.css" />
    <title>Hotel Booking</title>
</head>
<body>
<div id="wrap">
    <nav>
        <div class="nav__logo"><h3>Dreams Travelers</h3></div>
        <div id="option">
            <a href="#">Home</a>
            <a href="./flights.php">Flights</a>
            <a href="./admin.php">Admin</a>
            <div id="profile" style="display: <?= $isLoggedIn ? 'block' : 'none'; ?>;" onclick="toggleProfileBox()">
                <img src="<?= htmlspecialchars($profilePicture); ?>" alt="Profile Picture">
            </div>
            <div id="login_btn" style="display: <?= $isLoggedIn ? 'none' : 'block'; ?>;">
                <a href="./loginpage.php">Login</a>
            </div>
            <div id="profile_box" style="display: none;">
                <div id="profile_border">
                    <div class="profile-info">
                        <img src="<?= htmlspecialchars($profilePicture); ?>" alt="Profile Picture" class="profile-pic">
                        <p class="profile-name"><?= htmlspecialchars($userFullName); ?></p>
                    </div>
                    <p class="profile-email"><?= htmlspecialchars($userEmail); ?></p>
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
                        <input type="text" name="location" id="search-location" autocomplete="off" required />
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
                <img src="<?= htmlspecialchars($hotel['image_url']); ?>" alt="Hotel Image" />
                <div class="popular__content">
                    <div class="popular__card__header">
                        <h4><?= htmlspecialchars($hotel['name']); ?></h4>
                        <h4>$<?= htmlspecialchars(number_format($hotel['rating'], 1)); ?></h4>
                    </div>
                    <p><?= htmlspecialchars($hotel['location']); ?></p>
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

    <section class="section__container">
      <div class="reward__container">
        <p>100+ discount codes</p>
        <h4>Join rewards and discover amazing discounts on your booking</h4>
        <button class="reward__btn">Join Rewards</button>
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
     <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js" integrity="sha512-7eHRwcbYkK4d9g/6tD/mhkf++eoTHwpNM9woBxtPUBWm67zeAfFC+HrdoE2GanKeocly/VxeLvIqwvCdk7qScg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     
<script src="./js/script.js"></script>
</body>
</html>
