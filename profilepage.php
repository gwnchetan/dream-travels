<?php
session_start();
include './PHP/config.php';

// Redirect to login if user is not logged in
if (!isset($_SESSION['email'])) {
    header("Location: ./PHP/login.php");
    exit();
}

// Fetch user data based on email
$user_email = $_SESSION['email'];
$query = "SELECT * FROM person WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $user_email);
$stmt->execute();
$result = $stmt->get_result();
$user_data = $result->fetch_assoc();

if (!$user_data) {
    echo "User data not found.";
    exit();
}

// Check if Google or traditional login
$is_google_login = isset($_SESSION['google_login']) && $_SESSION['google_login'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<div class="container mt-5">
    <div class="row">
        <div class="col-md-3">
            <!-- Sidebar with Profile Picture and Options -->
            <div class="card bg-dark text-light p-3">
                <div class="text-center">
                    <img src="<?php echo $is_google_login ? ($user_data['google_profile_picture'] ?? 'default.jpg') : ($user_data['profile_picture'] ?? 'default.jpg'); ?>" alt="Profile Picture" class="rounded-circle img-fluid" style="width: 100px; height: 100px;">
                    <h5 class="mt-2"><?php echo $user_data['fname'] . " " . $user_data['lname']; ?></h5>
                    <p><?php echo $user_data['email']; ?></p>
                    <?php if (!$is_google_login): ?>
                        <button class="btn btn-outline-light btn-sm mb-2">Change</button>
                    <?php endif; ?>
                </div>
                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link text-light" href="#">My Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">My Bookings</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Travelers</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Payment Details</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Wishlist</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">Settings</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="./PHP/delete_profile.php">Delete Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="./PHP/logout.php">Sign Out</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <!-- Profile Information Form -->
            <div class="card bg-dark text-light p-4">
                <h3>Personal Information</h3>

                <!-- Display message after form submission -->
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['msg_type']; ?>">
                        <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>

                <form action="./PHP/update_profile.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="mb-3">
                        <label for="profile_picture" class="form-label">Upload your profile photo</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture" <?php echo $is_google_login ? 'disabled' : ''; ?>>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name" value="<?php echo $user_data['fname'] . ' ' . $user_data['lname']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $user_data['email']; ?>" readonly>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="contact_number" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $user_data['contact_number']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input type="text" class="form-control" id="nationality" name="nationality" value="<?php echo $user_data['nationality']; ?>">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user_data['dob']; ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender">
                                <option value="Male" <?php if ($user_data['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                                <option value="Female" <?php if ($user_data['gender'] == 'Female') echo 'selected'; ?>>Female</option>
                                <option value="Other" <?php if ($user_data['gender'] == 'Other') echo 'selected'; ?>>Other</option>
                            </select>
                        </div>
                    </div>

                    <!-- New Address Fields -->
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="street_address" class="form-label">Street Address</label>
                            <input type="text" class="form-control" id="street_address" name="street_address" value="<?php echo $user_data['street_address']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control" id="city" name="city" value="<?php echo $user_data['city']; ?>">
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="state" class="form-label">State</label>
                            <input type="text" class="form-control" id="state" name="state" value="<?php echo $user_data['state']; ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="postal_code" class="form-label">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" value="<?php echo $user_data['postal_code']; ?>">
                        </div>
                    </div>
                    
                    <div class="mt-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" id="country" name="country" value="<?php echo $user_data['country']; ?>">
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        const contactNumber = document.getElementById("contact_number").value;
        if (contactNumber && !/^[0-9]{10}$/.test(contactNumber)) {
            alert("Enter a valid 10-digit phone number.");
            return false;
        }
        return true;
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
