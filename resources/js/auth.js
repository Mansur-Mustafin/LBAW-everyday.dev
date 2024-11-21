function togglePasswordVisibility(passwordField, toggleIcon) {
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        toggleIcon.textContent = 'visibility';
    } else {
        passwordField.type = 'password';
        toggleIcon.textContent = 'visibility_off';
    }
}

const toggleIcons = document.querySelectorAll('.toggle-password');

toggleIcons.forEach((toggleIcon) => {
    console.log("hello")
    const passwordField = toggleIcon.previousElementSibling; 

    toggleIcon.addEventListener('click', () => {
        togglePasswordVisibility(passwordField, toggleIcon);
    });
});