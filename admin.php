<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="styles.css">
    <style>
    
    body {
    background-color: #121212; /* Dark background for the dashboard */
    color: #ffffff;
    font-family: Arial, sans-serif;
}

header {
    background-color: #1e1e1e;
    padding: 10px 20px;
    border-radius: 10px;
}

.card {
    border: none;
    border-radius: 10px;
}

.nav-link {
    color: #ffffff !important;
}

.my-listings img {
    height: 200px;
    object-fit: cover;
    border-radius: 10px 10px 0 0;
}
</style>
</head>

<body>
<div class="container-fluid">
    <!-- Header Section -->
    <header class="d-flex justify-content-between align-items-center py-3 border-bottom">
        <div class="d-flex align-items-center">
            <img src="<?= $user['profile_picture'] ?>" alt="Profile Picture" class="rounded-circle me-3" style="width: 50px; height: 50px;">
            <h1 class="h5 mb-0 text-light">Hi, <?= htmlspecialchars($user['name']) ?></h1>
        </div>
        <nav>
            <ul class="nav">
                <li class="nav-item"><a href="#" class="nav-link text-light">Dashboard</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-light">Listings</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-light">Bookings</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-light">Activities</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-light">Earnings</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-light">Reviews</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-light">Settings</a></li>
            </ul>
        </nav>
        <button class="btn btn-primary">+ Add New Listing</button>
    </header>

    <!-- Overview Section -->
    <section class="row mt-4">
        <div class="col-lg-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Total Earnings</h5>
                    <p class="card-text fs-4">$<?= $totalEarnings ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Booked Rooms</h5>
                    <p class="card-text fs-4"><?= $bookedRooms ?> / <?= $totalRooms ?></p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Available Rooms</h5>
                    <p class="card-text fs-4"><?= $availableRooms ?></p>
                </div>
            </div>
        </div>
    </section>

    <!-- Listings Section -->
    <section class="my-listings mt-4">
        <h2 class="h4 mb-3 text-light">My Listings</h2>
        <div class="row">
            <?php foreach ($listings as $listing): ?>
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="<?= $listing['image_url'] ?>" class="card-img-top" alt="<?= htmlspecialchars($listing['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($listing['title']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($listing['address']) ?></p>
                            <p class="card-text text-primary">$<?= $listing['price_per_day'] ?>/day</p>
                            <div class="d-flex justify-content-between">
                                <button class="btn btn-secondary">Edit</button>
                                <button class="btn btn-danger">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
