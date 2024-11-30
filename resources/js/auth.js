const checkbox = document.getElementById('ageCheckbox');
const errorMessage = document.getElementById('checkboxError');

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
    const passwordField = toggleIcon.previousElementSibling; 

    toggleIcon.addEventListener('click', () => {
        togglePasswordVisibility(passwordField, toggleIcon);
    });
});

const submitButton = document.getElementById('submitButton');

if(submitButton){
submitButton.addEventListener('click', function (event) {
    if (!checkbox.checked) {
        event.preventDefault(); 
        errorMessage.classList.remove('hidden'); 
    } else {
        errorMessage.classList.add('hidden');
    }
}
)};