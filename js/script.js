/**
 * Event listener for the signup form.
 * Validates the form before submission to ensure required fields meet specific criteria.
 */
document.getElementById('signup').addEventListener('submit', function(event) {
    /**
     * Validate the username field.
     * Checks if the username is not empty and is between 2 and 255 characters.
     */
    const username = document.getElementById('username').value;
    if (username.trim() === "") {
        alert("Username cannot be empty");
        event.preventDefault();
        return;
    }

    if (username.length < 2 || username.length > 255) {
        alert("Username must be between 2 and 255 characters");
        event.preventDefault();
        return;
    }

    /**
     * Validate the email field.
     * Ensures the email follows a common pattern (simple regex).
     */
    const email = document.getElementById('email').value;
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email regex
    if (!emailPattern.test(email)) {
        alert("Please enter a valid email address");
        event.preventDefault();
        return;
    }
     /**
     * Validate the password field.
     * Checks that the password is at least 8 characters long,
     * contains at least one uppercase letter, one number, and one special symbol.
     */
    const password = document.getElementById('password').value;
    const hasUpperCase = /[A-Z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasSpecialSymbol = /[!@#$%^&*(),.?":{}|<>]/.test(password);

    if (password.length < 8) {
        alert("Password must be at least 8 characters long");
        event.preventDefault();
        return;
    }

    if (!hasUpperCase) {
        alert("Password must contain at least one uppercase letter");
        event.preventDefault();
        return;
    }

    if (!hasNumber) {
        alert("Password must contain at least one number");
        event.preventDefault();
        return;
    }

    if (!hasSpecialSymbol) {
        alert("Password must contain at least one special symbol (e.g., !, @, #, $)");
        event.preventDefault();
        return;
    }
    /**
     * Validate the confirm password field.
     * Checks if the confirm password field is not blank and matches the original password.
     */
    const confirmPassword = document.getElementById('confirm_password').value;

    if (confirmPassword.trim() === "") {
        alert("Confirm password field cannot be blank");
        event.preventDefault();
        return;
    }
    if (confirmPassword !== password) {
        alert("Confirm password does not match the original password");
        event.preventDefault();
        return;
    }

    // If everything is valid, the form can submit
});
