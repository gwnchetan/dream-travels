<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.0.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="hotal.css" />
    <title>Web Design Mastery | Rayal Park</title>
  </head>
  <body>
    <header class="header">
      <nav>
        <div id="icons">
           <a href="#" class="active">Hotels<i class="ri-hotel-line"></i></a>
           <a href="flights.php">Flights<i class="ri-flight-takeoff-line"></i></a>
           <a href="cab.php">Cab<i class="ri-car-line"></i></a>
        </div>
     </nav>
     
      <div class="section__container header__container" id="home">
        <p>Simple - Unique - Friendly</p>
        <h1>Make Yourself At Home<br />In Our <span>Hotel</span>.</h1>
      </div>
    </header>

    <section class="section__container booking__container">
     
      <form action="#" class="booking__form">
        <div class="input__group">
          <span><i class="ri-calendar-2-fill"></i></span>
          <div>
            <label for="check-in">CHECK-IN</label>
            <input type="text" placeholder="Check In" />
          </div>
        </div>
        <div class="input__group">
          <span><i class="ri-calendar-2-fill"></i></span>
          <div>
            <label for="check-out">CHECK-OUT</label>
            <input type="text" placeholder="Check Out" />
          </div>
        </div>
        <div class="input__group">
          <span><i class="ri-user-fill"></i></span>
          <div>
            <label for="guest">GUEST</label>
            <input type="text" placeholder="Guest" />
          </div>
        </div>
        <div class="input__group input__btn">
          <button class="btn">CHECH OUT</button>
        </div>
      </form>
    </section>

    <section class="section__container about__container" id="about">
      <div class="about__image">
        <img src="./imgs/about.jpg" alt="about" />
      </div>
      <div class="about__content">
        <p class="section__subheader">ABOUT US</p>
        <h2 class="section__header">The Best Holidays Start Here!</h2>
        <p class="section__description">
          With a focus on quality accommodations, personalized experiences, and
          seamless booking, our platform is dedicated to ensuring that every
          traveler embarks on their dream holiday with confidence and
          excitement.
        </p>
        <div class="about__btn">
          <button class="btn">Read More</button>
        </div>
      </div>
    </section>

    <section class="section__container room__container">
      <p class="section__subheader">OUR LIVING ROOM</p>
      <h2 class="section__header">The Most Memorable Rest Time Starts Here.</h2>
      <div class="room__grid">
        <div class="room__card">
          <div class="room__card__image">
            <img src="./imgs/room-1.jpg" alt="room" />
            <div class="room__card__icons">
              <span><i class="ri-heart-fill"></i></span>
              <span><i class="ri-paint-fill"></i></span>
              <span><i class="ri-shield-star-line"></i></span>
            </div>
          </div>
          <div class="room__card__details">
            <h4>Deluxe Ocean View</h4>
            <p>
              Bask in luxury with breathtaking ocean views from your private
              suite.
            </p>
            <h5>Starting from <span>$299/night</span></h5>
            <button class="btn">Book Now</button>
          </div>
        </div>
        <div class="room__card">
          <div class="room__card__image">
            <img src="./imgs/room-2.jpg" alt="room" />
            <div class="room__card__icons">
              <span><i class="ri-heart-fill"></i></span>
              <span><i class="ri-paint-fill"></i></span>
              <span><i class="ri-shield-star-line"></i></span>
            </div>
          </div>
          <div class="room__card__details">
            <h4>Executive Cityscape Room</h4>
            <p>
              Experience urban elegance and modern comfort in the heart of the
              city.
            </p>
            <h5>Starting from <span>$199/night</span></h5>
            <button class="btn">Book Now</button>
          </div>
        </div>
        <div class="room__card">
          <div class="room__card__image">
            <img src="./imgs/room-3.jpg" alt="room" />
            <div class="room__card__icons">
              <span><i class="ri-heart-fill"></i></span>
              <span><i class="ri-paint-fill"></i></span>
              <span><i class="ri-shield-star-line"></i></span>
            </div>
          </div>
          <div class="room__card__details">
            <h4>Family Garden Retreat</h4>
            <p>
              Spacious and inviting, perfect for creating cherished memories
              with loved ones.
            </p>
            <h5>Starting from <span>$249/night</span></h5>
            <button class="btn">Book Now</button>
          </div>
        </div>
      </div>
    </section>

    <section class="service" id="service">
      <div class="section__container service__container">
        <div class="service__content">
          <p class="section__subheader">SERVICES</p>
          <h2 class="section__header">Strive Only For The Best.</h2>
          <ul class="service__list">
            <li>
              <span><i class="ri-shield-star-line"></i></span>
              High Class Security
            </li>
            <li>
              <span><i class="ri-24-hours-line"></i></span>
              24 Hours Room Service
            </li>
            <li>
              <span><i class="ri-headphone-line"></i></span>
              Conference Room
            </li>
            <li>
              <span><i class="ri-map-2-line"></i></span>
              Tourist Guide Support
            </li>
          </ul>
        </div>
      </div>
    </section>

    <section class="section__container banner__container">
      <div class="banner__content">
        <div class="banner__card">
          <h4>25+</h4>
          <p>Properties Available</p>
        </div>
        <div class="banner__card">
          <h4>350+</h4>
          <p>Bookings Completed</p>
        </div>
        <div class="banner__card">
          <h4>600+</h4>
          <p>Happy Customers</p>
        </div>
      </div>
    </section>

    <section class="explore" id="explore">
      <p class="section__subheader">EXPLORE</p>
      <h2 class="section__header">What's New Today.</h2>
      <div class="explore__bg">
        <div class="explore__content">
          <p class="section__description">10th MAR 2023</p>
          <h4>A New Menu Is Available In Our Hotel.</h4>
          <button class="btn">Continue</button>
        </div>
      </div>
    </section>

    <footer class="footer" id="contact">
      <div class="section__container footer__container">
        <div class="footer__col">
          <div class="logo">
            <a href="#home"><img src="./imgs/logo.png" alt="logo" /></a>
          </div>
          <p class="section__description">
            Discover a world of comfort, luxury, and adventure as you explore
            our curated selection of hotels.
          </p>
        </div>
        <div class="footer__col">
          <p class="section__subheader">NAVIGATIONS</p>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#about">About Us</a></li>
            <li><a href="#service">Services</a></li>
            <li><a href="#explore">Explore</a></li>
            <li><a href="#contact">Contact Us</a></li>
          </ul>
        </div>
        <div class="footer__col">
          <p class="section__subheader">GET IN TOUCH</p>
          <p class="section__description">
            Stay up to date with our latest offers, and join our newsletter for
            exclusive content.
          </p>
          <form action="">
            <input
              type="email"
              placeholder="Email Address"
              class="footer__input"
            />
            <button class="btn">Subscribe</button>
          </form>
        </div>
      </div>
    </footer>

    </body>
</html>
