<?php
session_start();
require_once "./PHP/config.php";

// Check if the user is logged in
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;
$profilePicture = $isLoggedIn && isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : './imgs/client-2.jpg';
$userFullName = $isLoggedIn ? $_SESSION['fname'] . ' ' . $_SESSION['lname'] : null;
$userEmail = $isLoggedIn ? $_SESSION['email'] : null;

// Fetch popular hotels for display
$stmt = $pdo->query("SELECT * FROM hotels LIMIT 6");
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
            <a href="#">Cab</a>
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

<footer class="footer">
    <div class="section__container footer__container">
        <p>&copy; 2024 Dreams Travelers. All Rights Reserved.</p>
    </div>
</footer>
<script>
function toggleProfileBox() {
    const profileBox = document.getElementById('profile_box');
    profileBox.style.display = profileBox.style.display === 'block' ? 'none' : 'block';
}
</script>
</body>
</html>
