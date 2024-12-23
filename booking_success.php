<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Request Submitted</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom Animation for Success Icon */
        .success-icon {
            animation: pop-in 0.5s ease-in-out;
        }

        @keyframes pop-in {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        /* Background gradient */
        body {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
        }

        .container {
            margin-top: 10%;
        }

        .card {
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
            background: #fff;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container text-center">
        <div class="card p-5 mx-auto" style="max-width: 600px;">
            <div class="text-center mb-4">
                <!-- Success Icon -->
                <div class="bg-success text-white rounded-circle d-inline-block p-3 success-icon">
                    <i class="bi bi-check-circle" style="font-size: 4rem;"></i>
                </div>
            </div>
            <h1 class="text-success fw-bold">Success!</h1>
            <p class="mt-3">Your booking request has been successfully submitted! The admin will review your request and notify you of their decision shortly.</p>
            <!-- Decorative Divider -->
            <hr class="my-4" style="border-top: 2px dashed #6a11cb;">
            <div class="mt-3">
                <!-- Return to Home Button -->
                <a href="../index.php" class="btn btn-primary btn-lg shadow-sm">Return to Home</a>
                <!-- View Bookings Button -->
                <a href="../my_bookings.php" class="btn btn-outline-success btn-lg shadow-sm">View My Bookings</a>
            </div>
        </div>
    </div>

    <!-- Success Animation -->
    <script>
        // Add bounce effect to the success icon on page load
        const icon = document.querySelector('.success-icon');
        icon.classList.add('animate__animated', 'animate__bounceIn');
    </script>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
