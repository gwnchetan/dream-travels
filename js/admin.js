document.addEventListener("DOMContentLoaded", function () {
    // Dashboard, Hotels, and Bookings tab switching
    const dashboardLink = document.getElementById("dashbord");
    const hotelsLink = document.getElementById("hotels");
    const bookingsLink = document.getElementById("bookings"); // Bookings link

    const dashboardPage = document.getElementById("dashbord_page");
    const hotelsPage = document.getElementById("hotels_page");
    const bookingsPage = document.getElementById("bookings_page"); // Bookings page

    // Set default visibility
    dashboardPage.style.display = "block";
    hotelsPage.style.display = "none";
    bookingsPage.style.display = "none";

    // Add click event for the Dashboard link
    dashboardLink.addEventListener("click", function (e) {
        e.preventDefault();
        dashboardPage.style.display = "block";
        hotelsPage.style.display = "none";
        bookingsPage.style.display = "none";
    });

    // Add click event for the Hotels link
    hotelsLink.addEventListener("click", function (e) {
        e.preventDefault();
        dashboardPage.style.display = "none";
        hotelsPage.style.display = "block";
        bookingsPage.style.display = "none";
    });

    // Add click event for the Bookings link
    bookingsLink.addEventListener("click", function (e) {
        e.preventDefault();
        dashboardPage.style.display = "none";
        hotelsPage.style.display = "none";
        bookingsPage.style.display = "block";
    });
});

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.accept, .reject').forEach(button => {
        button.addEventListener('click', () => {
            const hotelId = button.getAttribute('data-hotel-id');
            const action = button.classList.contains('accept') ? 'accept_booking' : 'reject_booking';

            fetch('./admin.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action, hotel_id: hotelId })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    alert(data.message);
                    location.reload();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error.message);
                alert('An error occurred while processing the request.');
            });
            
           
        });
    });
});