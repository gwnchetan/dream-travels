<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.4.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="./CSS/flights.css" />
    <title>Dream Travlers</title>
  </head>
  <body>
    <div id="page1">
    <nav id="nav">
      <div class="nav__logo">Dreams Travlers</div>
      <ul class="nav__links">
        <li class="link"><a href="#">Home</a></li>
        <li class="link"><a href="#">Hotels</a></li>
        <li class="link"><a href="#">Cabs</a></li>
        <li class="link"><a href="#">login</a></li>
        
      </ul>
      <button class="btn">Contact</button>
    </nav>

    <header class="section__container header__container">
      <h1 class="section__header">Dreams Travlers<br />Where every journey become new Stroy</h1>
      <img src="./imgs/header.jpg" alt="header" />
    </header>

    <div id="form_cover">
      <form action="">
        <div id="search_menu d-flex justify-content-center align-items-center shadow p-3 mb-5 ">
          <div id="search_icons">
            <div id="trip_info">
              <button type="button" class="btn1" id="oneWay" aria-pressed="false">One way</button>
              <button type="button" class="btn2" id="roundtrip" aria-pressed="false">Roundtrip</button>
            </div>

            <div id="travellers">
              <input
                type="number"
                placeholder="Select Passenger"
                class="passenger_box"
                min="1"
                required
              />

              <select class="passenger_box" required>
                <option value="" disabled selected>Select class</option>
                <option>Economy</option>
                <option>General</option>
                <option>Business</option>
              </select>
            </div>
          </div>

          <div id="flights">
            <div class="search_box">
              <h4>
                From <i class="ri-flight-takeoff-line"></i>
              </h4>
              <input type="text" id="fromLocation" placeholder="Select location" onkeyup="getSuggestions(this.value, 'fromSuggestions')" required />
              <ul id="fromSuggestions" class="suggestions-list"></ul>
            </div>

            <div class="search_box">
              <h4>
                To <i class="ri-flight-land-line"></i>
              </h4>
              <input type="text" id="toLocation" placeholder="Select location" onkeyup="getSuggestions(this.value, 'toSuggestions')" required />
              <ul id="toSuggestions" class="suggestions-list"></ul>
            </div>

            <div class="search_box">
              <h4>Journey date</h4>
              <input type="date" id="j_date" required />
            </div>

            <div class="search_box" id="return-date">
              <h4>Return date</h4>
              <input type="date" id="r_date" />
            </div>
          </div>
          <div id="find">
            <button type="submit">Find</button>
          </div>
        </div>
      </form>
    </div>
</div>
    <section class="section__container plan__container">
      <p class="subheader">TRAVEL SUPPORT</p>
      <h2 class="section__header">Plan your travel with confidence</h2>
      <p class="description">
        Find help with your bookings and travel plans, and see what to expect
        along your journey.
      </p>
      <div class="plan__grid">
        <div class="plan__content">
          <div class="plan__item">
            <span class="number">01</span>
            <h4>Travel Requirements for Dubai</h4>
            <p>
              Stay informed and prepared for your trip to Dubai with essential
              travel requirements, ensuring a smooth and hassle-free experience in
              this vibrant and captivating city.
            </p>
          </div>
          <div class="plan__item">
            <span class="number">02</span>
            <h4>Multi-risk Travel Insurance</h4>
            <p>
              Comprehensive protection for your peace of mind, covering a range of
              potential travel risks and unexpected situations.
            </p>
          </div>
          <div class="plan__item">
            <span class="number">03</span>
            <h4>Travel Requirements by Destination</h4>
            <p>
              Stay informed and plan your trip with ease, as we provide up-to-date
              information on travel requirements specific to your desired
              destinations.
            </p>
          </div>
        </div>
        <div class="plan__image">
          <img src="./imgs/plan-1.jpg" alt="plan" />
          <img src="./imgs/plan-2.jpg" alt="plan" />
          <img src="./imgs/plan-3.jpg" alt="plan" />
        </div>
      </div>
    </section>

    <section class="memories">
      <div class="section__container memories__container">
        <div class="memories__header">
          <h2 class="section__header">
            Travel to make memories all around the world
          </h2>
          <button class="view__all">View All</button>
        </div>
        <div class="memories__grid">
          <div class="memories__card">
            <span><i class="ri-calendar-2-line"></i></span>
            <h4>Book & Relax</h4>
            <p>
              With "Book and Relax," you can sit back, unwind, and enjoy the
              journey while we take care of everything else.
            </p>
          </div>
          <div class="memories__card">
            <span><i class="ri-shield-check-line"></i></span>
            <h4>Smart Checklist</h4>
            <p>
              Introducing Smart Checklist with us, the innovative solution
              revolutionizing the way you travel with our airline.
            </p>
          </div>
          <div class="memories__card">
            <span><i class="ri-bookmark-2-line"></i></span>
            <h4>Save More</h4>
            <p>
              From discounted ticket prices to exclusive promotions and deals,
              we prioritize affordability without compromising on quality.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="section__container lounge__container">
      <div class="lounge__image">
        <img src="./imgs/lounge-1.jpg" alt="lounge" />
        <img src="./imgs/lounge-2.jpg" alt="lounge" />
      </div>
      <div class="lounge__content">
        <h2 class="section__header">Unaccompanied Minor Lounge</h2>
        <div class="lounge__grid">
          <div class="lounge__details">
            <h4>Experience Tranquility</h4>
            <p>
              Serenity Haven offers a tranquil escape, featuring comfortable
              seating, calming ambiance, and attentive service.
            </p>
          </div>
          <div class="lounge__details">
            <h4>Elevate Your Experience</h4>
            <p>
              Designed for discerning travelers, this exclusive lounge offers
              premium amenities, assistance, and private workspaces.
            </p>
          </div>
          <div class="lounge__details">
            <h4>A Welcoming Space</h4>
            <p>
              Creating a family-friendly atmosphere, The Family Zone is the
              perfect haven for parents and children.
            </p>
          </div>
          <div class="lounge__details">
            <h4>A Culinary Delight</h4>
            <p>
              Immerse yourself in a world of flavors, offering international
              cuisines, gourmet dishes, and carefully curated beverages.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="section__container travellers__container">
      <h2 class="section__header">Best Travellers of the Month</h2>
      <div class="travellers__grid">
        <div class="travellers__card">
          <img src="./imgs/traveller-1.jpg" alt="traveller" />
          <div class="travellers__card__content">
            <img src="./imgs/client-1.jpg" alt="client" />
            <h4>Emily Johnson</h4>
            <p>Dubai</p>
          </div>
        </div>
        <div class="travellers__card">
          <img src="./imgs/traveller-2.jpg" alt="traveller" />
          <div class="travellers__card__content">
            <img src="./imgs/client-2.jpg" alt="client" />
            <h4>David Smith</h4>
            <p>Paris</p>
          </div>
        </div>
        <div class="travellers__card">
          <img src="./imgs/traveller-3.jpg" alt="traveller" />
          <div class="travellers__card__content">
            <img src="./imgs/client-3.jpg" alt="client" />
            <h4>Olivia Brown</h4>
            <p>Singapore</p>
          </div>
        </div>
        <div class="travellers__card">
          <img src="./imgs/traveller-4.jpg" alt="traveller" />
          <div class="travellers__card__content">
            <img src="./imgs/client-4.jpg" alt="client" />
            <h4>Daniel Taylor</h4>
            <p>Malaysia</p>
          </div>
        </div>
      </div>
    </section>

    <section class="subscribe">
      <div class="section__container subscribe__container">
        <h2 class="section__header">Subscribe to Newsletter & Get Latest News</h2>
        <form class="subscribe__form">
          <input type="email" placeholder="Enter your email here" required />
          <button type="submit" class="btn">Subscribe</button>
        </form>
      </div>
    </section>

    <footer class="footer">
      <div class="section__container footer__container">
        <div class="footer__col">
          <h3>Dreams Travlers</h3>
          <p>
            Where Excellence Takes Flight. With a strong commitment to customer
            satisfaction and a passion for air travel, Flivan Airlines offers
            exceptional service and seamless journeys.
          </p>
          <p>
            From friendly smiles to state-of-the-art aircraft, we connect the
            world, ensuring safe, comfortable, and unforgettable experiences.
          </p>
        </div>
        <div class="footer__col">
          <h4>INFORMATION</h4>
          <p>Home</p>
          <p>About</p>
          <p>Offers</p>
          <p>Seats</p>
          <p>Destinations</p>
        </div>
        <div class="footer__col">
          <h4>CONTACT</h4>
          <p>Support</p>
          <p>Media</p>
          <p>Socials</p>
        </div>
      </div>
      <div class="section__container footer__bar">
      <div class="socials">
          <span><i class="ri-facebook-fill"></i></span>
          <span><i class="ri-twitter-fill"></i></span>
          <span><i class="ri-instagram-line"></i></span>
          <span><i class="ri-youtube-fill"></i></span>
        </div>
      </div>
    </footer>

    <!-- External Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Inline JavaScript -->
    <script>
      document.addEventListener("DOMContentLoaded", function () {
        // Navbar scroll effect
        window.addEventListener("scroll", function () {
          var navbar = document.getElementById("nav");
          if (window.scrollY > 0) {
            navbar.classList.add("nav-scrolled");
          } else {
            navbar.classList.remove("nav-scrolled");
          }
        });

        // Trip type toggle
        const oneWayBtn = document.getElementById("oneWay");
        const roundTripBtn = document.getElementById("roundtrip");
        const returnDate = document.getElementById("return-date");

        oneWayBtn.addEventListener("click", function () {
          returnDate.style.display = "none";
          oneWayBtn.classList.add("active");
          roundTripBtn.classList.remove("active");
          oneWayBtn.setAttribute("aria-pressed", "true");
          roundTripBtn.setAttribute("aria-pressed", "false");
        });

        roundTripBtn.addEventListener("click", function () {
          returnDate.style.display = "block";
          roundTripBtn.classList.add("active");
          oneWayBtn.classList.remove("active");
          roundTripBtn.setAttribute("aria-pressed", "true");
          oneWayBtn.setAttribute("aria-pressed", "false");
        });

        // Initialize as One Way by default
        oneWayBtn.click();
      });


      function getSuggestions(searchTerm, suggestionListId) {
    if (searchTerm.length > 1) {  // Only search when 2+ characters entered
        fetch(`fetch_suggestions.php?term=${searchTerm}`)  // Use backticks and dynamic search term
            .then(response => response.json())
            .then(data => {
                let suggestionList = document.getElementById(suggestionListId);
                suggestionList.innerHTML = "";  // Clear previous suggestions

                data.forEach(item => {
                    let listItem = document.createElement('li');
                    listItem.textContent = item;
                    listItem.onclick = function () {
                        document.getElementById(suggestionListId.replace('Suggestions', 'Location')).value = item;
                        suggestionList.innerHTML = "";  // Clear suggestions after selection
                    };
                    suggestionList.appendChild(listItem);
                });
            })
            .catch(error => console.error('Error fetching suggestions:', error));
    }
}


    </script>
  </body>
</html>
