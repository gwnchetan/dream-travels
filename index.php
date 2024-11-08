<?php
session_start();

// Check if the user is logged in (either through Google or a traditional login)
$isLoggedIn = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

// Determine login type and set the profile image
if (isset($_SESSION['google_logged_in']) && $_SESSION['google_logged_in'] === true) {
    $isLoggedIn = true;
    $profilePicture = $_SESSION['profile_picture']; // Google profile picture
} else {
    $profilePicture = './imgs/default-profile.png'; // Default profile image for traditional login
}

// Combine first and last name for full name display
$userFullName = $isLoggedIn ? ($_SESSION['fname'] . ' ' . $_SESSION['lname']) : null;
$userEmail = $isLoggedIn ? $_SESSION['email'] : null;

?>
<!DOCTYPE html>
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="stylesheet" href="CSS\hotel.css" />
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
                <div class="profile-info">
                    <img src="<?php echo htmlspecialchars($profilePicture); ?>" alt="Profile Picture" class="profile-pic">
                    <p class="profile-name"><?php echo htmlspecialchars($userFullName); ?></p>
                    <p class="profile-email"><?php echo htmlspecialchars($userEmail); ?></p>
                </div>
                <ul class="profile-menu">
                    <li><a href="./bookings.php"><i class="ri-bookmark-line"></i> My Bookings</a></li>
                    <li><a href="./wishlist.php"><i class="ri-heart-line"></i> My Wishlist</a></li>
                    <li><a href="./profilepage.php"><i class="ri-settings-line"></i> Settings</a></li>
                    <li><a href="./help.php"><i class="ri-question-line"></i> Help Center</a></li>
                    <li><a href="./PHP/logout.php" id="logout"><i class="ri-logout-box-line"></i> Sign Out</a></li>
                </ul>
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
          <form>
            <div class="form__group">
              <div class="input__group">
                <input type="text" />
                <label>Location</label>
              </div>
              <p>Where are you going?</p>
            </div>
            <div class="form__group">
              <div class="input__group">
                <input type="date" placeholder="Check In"/>
                <label></label>
              </div>
              <p>Add date</p>
            </div>
            <div class="form__group">
              <div class="input__group">
                <input type="date" placeholder="Check Out" />
                <label></label>
              </div>
              <p>Add date</p>
            </div>
            <div class="form__group">
              <div class="input__group">
                <input type="text" />
                <label>Guests</label>
              </div>
              <p>Add guests</p>
            </div>
          </form>
          <button class="btn"><i class="ri-search-line"></i></button>
        </div>
      </div>
    </header>

    <section class="section__container popular__container">
      <h2 class="section__header">Popular Hotels</h2>
      <div class="popular__grid">
        <div class="popular__card">
          <img src="./imgs/hotel-1.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>The Plaza Hotel</h4>
              <h4>$499</h4>
            </div>
            <p>New York City, USA</p>
          </div>
        </div>
        <div class="popular__card">
          <img src="./imgs/hotel-2.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>Ritz Paris</h4>
              <h4>$549</h4>
            </div>
            <p>Paris, France</p>
          </div>
        </div>
        <div class="popular__card">
          <img src="./imgs/hotel-3.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>The Peninsula</h4>
              <h4>$599</h4>
            </div>
            <p>Hong Kong</p>
          </div>
        </div>
        <div class="popular__card">
          <img src="./imgs/hotel-4.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>Atlantis The Palm</h4>
              <h4>$449</h4>
            </div>
            <p>Dubai, United Arab Emirates</p>
          </div>
        </div>
        <div class="popular__card">
          <img src="./imgs/hotel-5.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>The Ritz-Carlton</h4>
              <h4>$649</h4>
            </div>
            <p>Tokyo, Japan</p>
          </div>
        </div>
        <div class="popular__card">
          <img src=" ./imgs/hotel-6.jpg" alt="popular hotel" />
          <div class="popular__content">
            <div class="popular__card__header">
              <h4>Marina Bay Sands</h4>
              <h4>$549</h4>
            </div>
            <p>Singapore</p>
          </div>
        </div>
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
  </body>

<script>
 document.addEventListener('DOMContentLoaded', function () {
    const profileIcon = document.querySelector('#profile');
    const profileBox = document.querySelector('#profile_box');

    // Toggle profile box visibility on profile icon click
    profileIcon.addEventListener('click', function (event) {
        event.stopPropagation();  // Prevents the event from propagating to document click
        profileBox.style.display = profileBox.style.display === 'block' ? 'none' : 'block';
    });

    // Close profile box if clicked outside of it
    document.addEventListener('click', function (event) {
        if (!profileIcon.contains(event.target) && !profileBox.contains(event.target)) {
            profileBox.style.display = 'none';
        }
    });
});
</script>
</>
</>
