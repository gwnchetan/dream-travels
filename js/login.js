document.addEventListener('DOMContentLoaded', function () {
    const passwordInputs = document.querySelectorAll('.password-container input');
    const showPasswordButtons = document.querySelectorAll('.show-password');
    const emailFields = document.querySelectorAll('input[type="email"]');
    const rememberMeCheckboxes = document.querySelectorAll('#remember-me');
    const loginForm = document.querySelector('#from_part');
    const registerForm = document.querySelector('#regis_from');
    const createAccountLink = document.querySelector('#from1');
    const loginLink = document.querySelector('#from2');

    // Toggle password visibility
    showPasswordButtons.forEach((button, index) => {
        button.addEventListener('click', function () {
            const passwordInput = passwordInputs[index];
            const eyeIcon = button.querySelector('i');
            const isPassword = passwordInput.getAttribute('type') === 'password';
            passwordInput.setAttribute('type', isPassword ? 'text' : 'password');
            eyeIcon.classList.toggle('ri-eye-fill');
            eyeIcon.classList.toggle('ri-eye-off-fill');
        });
    });

    // Form validation
    document.querySelectorAll('form').forEach((form) => {
        form.addEventListener('submit', function (e) {
            const emailField = form.querySelector('input[type="email"]');
            const passwordField = form.querySelector('input[type="password"]');

            if (!emailField.value || !passwordField.value) {
                alert('Please fill out both the email and password fields.');
                e.preventDefault();
                return;
            }

            const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            if (!emailPattern.test(emailField.value)) {
                alert('Please enter a valid email address.');
                e.preventDefault();
            }
        });
    });

    // Remember me functionality
    rememberMeCheckboxes.forEach((checkbox, index) => {
        if (localStorage.getItem('rememberMe' + index) === 'true') {
            emailFields[index].value = localStorage.getItem('email' + index);
            checkbox.checked = true;
        }

        checkbox.closest('form').addEventListener('submit', function () {
            if (checkbox.checked) {
                localStorage.setItem('email' + index, emailFields[index].value);
                localStorage.setItem('rememberMe' + index, 'true');
            } else {
                localStorage.removeItem('email' + index);
                localStorage.removeItem('rememberMe' + index);
            }
        });
    });

    // Function to show the register form with animation
    function showRegisterForm() {
        loginForm.style.transition = "opacity 0.5s ease-in-out, transform 0.5s ease-in-out";
        loginForm.style.opacity = "0";
        loginForm.style.transform = "translateX(-100%)";
        setTimeout(() => {
            loginForm.style.display = "none";
            registerForm.style.display = "block";
            registerForm.style.opacity = "0";
            registerForm.style.transform = "translateX(100%)";
            setTimeout(() => {
                registerForm.style.transition = "opacity 0.5s ease-in-out, transform 0.5s ease-in-out";
                registerForm.style.opacity = "1";
                registerForm.style.transform = "translateX(0)";
            }, 10);
        }, 500);
    }

    // Function to show the login form with animation
    function showLoginForm() {
        registerForm.style.transition = "opacity 0.5s ease-in-out, transform 0.5s ease-in-out";
        registerForm.style.opacity = "0";
        registerForm.style.transform = "translateX(100%)";
        setTimeout(() => {
            registerForm.style.display = "none";
            loginForm.style.display = "block";
            loginForm.style.opacity = "0";
            loginForm.style.transform = "translateX(-100%)";
            setTimeout(() => {
                loginForm.style.transition = "opacity 0.5s ease-in-out, transform 0.5s ease-in-out";
                loginForm.style.opacity = "1";
                loginForm.style.transform = "translateX(0)";
            }, 10);
        }, 500);
    }

    // Event listeners for form switches
    createAccountLink.addEventListener('click', showRegisterForm);
    loginLink.addEventListener('click', showLoginForm);
});
    document.addEventListener("DOMContentLoaded", function () {
        const urlParams = new URLSearchParams(window.location.search);
        const error = urlParams.get('error');
        const success = urlParams.get('success');
        
        if (error || success) {
            // If error is from registration, show registration form
            if (error && error.includes("Email already in use") || error.includes("Passwords do not match")) {
                document.getElementById("from_part").style.display = "none";
                document.getElementById("regis_from").style.display = "block";
            }
        }
    });


// // Initialize Google Login
// window.onload = function () {
//     google.accounts.id.initialize({
//         client_id: '801533048919-jtbtlnmq82adqkmvs1v4etd3apvas3il.apps.googleusercontent.com', // Replace with your actual client ID
//         callback: handleCredentialResponse
//     });
//     google.accounts.id.renderButton(
//         document.getElementById("googleLoginButton"),
//         { theme: "text", size: "xlarge" } // Set theme to "text" for default styling
//     );
// };

// // Handle the response after Google login
// function handleCredentialResponse(response) {
//     // Send the ID token to your server for verification
//     const idToken = response.credential;

//     fetch('../PHP/google_callback.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded',
//         },
//         body: `id_token=${encodeURIComponent(idToken)}`
//     })
//     .then(response => response.json())
//     .then(data => {
//         if (data.success) {
//             // Redirect to the home page if login is successful
//             window.location.href = './index.php';
//         } else {
//             alert('Login failed: ' + data.message);
//         }
//     })
//     .catch(error => {
//         console.error('Error:', error);
//         alert('An error occurred during login.');
//     });
// }

