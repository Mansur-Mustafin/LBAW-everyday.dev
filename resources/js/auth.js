function togglePasswordVisibility(passwordField, toggleIcon) {
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.textContent = 'visibility';
    } else {
        passwordField.type = 'password';
        toggleIcon.textContent = 'visibility_off';
    }
}

const togglePassword = document.getElementById('toggle-password');
const passwordField = document.getElementById('password');
const togglePasswordConfirm = document.getElementById('toggle-password-confirm');
const passwordFieldConfirm = document.getElementById('password-confirm');

togglePassword.addEventListener('click', () => {
    togglePasswordVisibility(passwordField, togglePassword);
});

togglePasswordConfirm.addEventListener('click', () => {
    togglePasswordVisibility(passwordFieldConfirm, togglePasswordConfirm);
});

