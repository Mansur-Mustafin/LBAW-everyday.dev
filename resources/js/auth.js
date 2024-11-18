const hidePassword = (togglePasswordDiv,passwordFieldDiv) => {
    document.getElementById(togglePasswordDiv).addEventListener('click', function () {
        const passwordField = document.getElementById(passwordFieldDiv);
        const eyeIcon = document.getElementById('eye-icon');

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    });
}

if(document.getElementById("toggle-password")) {
    console.log('a')
    hidePassword("toggle-password","password")
}

if(document.getElementById("toggle-password-confirm")) {
    console.log('b')
    hidePassword("toggle-password-confirm","password-confirm")
}

