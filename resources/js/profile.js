const profileOptions = document.getElementById('profile-options');
const profileOptionsPopup = document.getElementById('profile-options-popup');

if (profileOptions) {
  profileOptions.addEventListener('click', (event) => {
    if (profileOptionsPopup.classList.contains('opacity-0')) {
      profileOptionsPopup.classList.replace('opacity-0', 'opacity-100');
    } else {
      profileOptionsPopup.classList.replace('opacity-100', 'opacity-0');
    }
  });
}
