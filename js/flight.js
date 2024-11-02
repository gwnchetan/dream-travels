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
