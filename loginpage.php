<?php
session_start();
function getUserIpAddress() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        return $_SERVER['REMOTE_ADDR'];
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/login.css">
    <title>Login Page</title>
</head>
<body>
       
<div class="position-absolute w-100">
<?php if (isset($_GET['error'])): ?>
        <div class="alert-container">
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Warning</strong> <?= htmlspecialchars($_GET['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php elseif (isset($_GET['success'])): ?>
        <div class="alert-container">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> <?= htmlspecialchars($_GET['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    <?php endif; ?>
</div>

<div id="page">
    <div id="main">
        <div id="imgs_part">
            <img src="./imgs/login.svg" alt="imgs">
        </div>

        <!-- Login Form -->
        <div id="from_part">
            <h1>Welcome back</h1>
            <p>New here? <a href="#" id="from1">Create an account</a></p>
            <form id="loginForm" method="POST" action="./PHP/login.php">
                <label for="email">Enter email id</label>
                <input type="email" name="email" id="email" placeholder="user@email.com" required>

                <label for="password">Enter password</label>
                <div class="password-container">
                    <input type="password" name="password" id="password" placeholder="••••••••" required>
                    <button type="button" class="show-password"><i class="ri-eye-fill"></i></button>
                </div>

                <div class="form-options">
                    <div id="checkbox">
                        <input type="checkbox" id="remember-me">
                        <label for="remember-me">Remember me?</label>
                    </div>
                    <a href="#" class="forgot-password">Forgot password?</a>
                </div>

                <!-- Hidden fields for IP address and device information -->
                <input type="hidden" id="ipAddress" name="ipAddress">
                <input type="hidden" id="deviceInfo" name="deviceInfo">

                <button type="submit" class="login-btn btn btn-primary">Login</button>
            </form>

            <div class="divider">
                <span> Or sign in with </span>
            </div>

            <button class="social-login google btn btn-light">
                <img src="./imgs/google.svg" alt="Login with Google"> Continue with Google
            </button>
            <button class="social-login facebook btn btn-primary">
                <img src="./imgs/facebook.svg" alt="Facebook Icon"> Continue with Facebook
            </button>
        </div>

        <!-- Registration Form -->
        <div id="regis_from" style="display: none;">
            <h1>Create new account</h1>
            <p>Already a member? <a id="from2" style=" cursor: pointer;">Login</a></p>
            <form method="POST" action="./PHP/registration.php">
                <label for="email">Enter email id</label>
                <input type="email" name="email" placeholder="user@email.com" required>

                <label for="fname">First Name</label>
                <input type="text" name="fname" placeholder="Enter your first name" required>

                <label for="lname">Last Name</label>
                <input type="text" name="lname" placeholder="Enter your last name" required>

                <label for="password">Enter password</label>
                <div class="password-container">
                    <input type="password" name="password" placeholder="" required>
                    <button type="button" class="show-password"><i class="ri-eye-fill"></i></button>
                </div>

                <label for="confirm_password">Confirm password</label>
                <div class="password-container">
                    <input type="password" name="confirm_password" required>
                    <button type="button" class="show-password"><i class="ri-eye-fill"></i></button>
                </div>

                <button type="submit" class="login-btn btn btn-success">Sign up</button>
            </form>

            <div class="divider">
                <span>Or sign in with</span>
            </div>

            <button class="social-login google btn btn-light">
                <img src="./imgs/google.svg" alt="Login with Google"> Continue with Google
            </button>
            <button class="social-login facebook btn btn-primary">
                <img src="./imgs/facebook.svg" alt="Facebook Icon"> Continue with Facebook
            </button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- Custom JS -->
<script>
// Set the IP address using PHP
document.getElementById('ipAddress').value = '<?php echo getUserIpAddress(); ?>';

// Set device information using JavaScript
document.getElementById('deviceInfo').value = JSON.stringify({
    userAgent: navigator.userAgent,
    platform: navigator.platform,
    appVersion: navigator.appVersion
});
</script>
<script src="./js/login.js"></script>
</body>
</html>
