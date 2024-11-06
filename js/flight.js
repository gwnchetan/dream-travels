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

