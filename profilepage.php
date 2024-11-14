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
$stmt = $pdo->prepare($query);
$stmt->execute([$user_email]);
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user_data) {
    echo "User data not found.";
    exit();
}

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
            <div class="card bg-dark text-light p-3" id="card">
            <div class="text-center">
    <img src="<?php echo $is_google_login && !empty($user_data['google_profile_picture']) 
        ? $user_data['google_profile_picture'] 
        : (!empty($user_data['profile_picture']) 
            ? $user_data['profile_picture'] 
            : './imgs/client-2.jpg'); ?>" 
         alt="Profile Picture" 
         class="rounded-circle img-fluid" 
         style="width: 100px; height: 100px;">
         
    <h5 class="mt-2"><?php echo $user_data['fname'] . " " . $user_data['lname']; ?></h5>
    <p><?php echo $user_data['email']; ?></p>
    
    <?php if (!$is_google_login): ?>
        <button class="btn btn-outline-light btn-sm mb-2">Change</button>
    <?php endif; ?>
</div>

                <hr>
                <ul class="nav flex-column">
                    <li class="nav-item"><a class="nav-link text-light" href="./index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link text-light" href="#">My Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="./PHP/delete_profile.php">Delete Profile</a></li>
                    <li class="nav-item"><a class="nav-link text-danger" href="./PHP/logout.php">Sign Out</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-9" id="main">
            <!-- Profile Information Form -->
            <div class="card bg-dark text-light p-4" >
                <h3>Personal Information</h3>
                       
                <?php if (isset($_SESSION['message'])): ?>
                    <div class="alert alert-<?php echo $_SESSION['msg_type']; ?>">
                        <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>

                <form action="./PHP/update_profile.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="row" id="secsion">
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
                        <div class="col-md-4">
                            <label for="contact_number" class="form-label">Mobile Number</label>
                            <input type="text" class="form-control" id="contact_number" name="contact_number" value="<?php echo $user_data['contact_number']; ?>" required>
                        </div>
                        
                        <div class="col-md-4">
                            <label for="dob" class="form-label">Date of Birth</label>
                            <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user_data['dob']; ?>">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="Male" <?php echo ($user_data['gender'] == 'Male') ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo ($user_data['gender'] == 'Female') ? 'selected' : ''; ?>>Female</option>
                                <option value="Other" <?php echo ($user_data['gender'] == 'Other') ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                    </div>

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

                    <h3 class="mt-4">Update Email</h3>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <label for="new_email" class="form-label">Enter your new email</label>
                            <input type="email" class="form-control" id="new_email" name="new_email" placeholder="Enter your new email address" >
                        </div>
                    </div>

                    <h3 class="mt-4">Update Password</h3>
                    <div class="row mt-2">
                        <div class="col-md-4">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter current password" >
                        </div>
                        <div class="col-md-4">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter new password" >
                        </div>
                        <div class="col-md-4">
                            <label for="confirm_password" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm new password" >
                        </div>
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
