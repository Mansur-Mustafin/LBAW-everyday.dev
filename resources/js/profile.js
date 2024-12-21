const profileOptions = document.getElementById('profile-options');
const profileOptionsPopup = document.getElementById('profile-options-popup');

profileOptions?.addEventListener('click', (event) => {
  if (profileOptionsPopup.classList.contains('opacity-0')) {
    profileOptionsPopup.classList.remove('opacity-0', 'pointer-events-none');
    profileOptionsPopup.classList.add('opacity-100');
  } else {
    profileOptionsPopup.classList.remove('opacity-100');
    profileOptionsPopup.classList.add('opacity-0', 'pointer-events-none');
  }
});
