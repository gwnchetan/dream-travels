document.addEventListener('DOMContentLoaded', function () {
    const passwordInputs = document.querySelectorAll('.password-container input');
    const showPasswordButtons = document.querySelectorAll('.show-password');
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

    // Form validation for registration form
    registerForm.addEventListener('submit', function (e) {
        const emailField = registerForm.querySelector('input[name="email"]');
        const passwordField = registerForm.querySelector('input[name="password"]');
        const confirmPasswordField = registerForm.querySelector('input[name="confirm_password"]');

        // Check if fields are filled
        if (!emailField.value || !passwordField.value || !confirmPasswordField.value) {
            alert('Please fill out all required fields.');
            e.preventDefault();
            return;
        }

        // Email validation
        const emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
        if (!emailPattern.test(emailField.value)) {
            alert('Please enter a valid email address.');
            e.preventDefault();
            return;
        }

        // Password strength validation
        if (!checkPasswordStrength(passwordField.value)) {
            alert('Your password must be at least 8 characters long and include uppercase, lowercase letters, a number, and a special character.');
            e.preventDefault();
            return;
        }

        // Password match validation
        if (passwordField.value !== confirmPasswordField.value) {
            alert('Passwords do not match.');
            e.preventDefault();
        }
    });

    // Password strength validation function
    function checkPasswordStrength(password) {
        const minLength = /.{8,}/;
        const hasUppercase = /[A-Z]/;
        const hasLowercase = /[a-z]/;
        const hasNumber = /\d/;
        const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/;

        return minLength.test(password) &&
               hasUppercase.test(password) &&
               hasLowercase.test(password) &&
               hasNumber.test(password) &&
               hasSpecialChar.test(password);
    }

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
