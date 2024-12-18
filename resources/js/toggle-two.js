const toggleTwoDivs = document.querySelectorAll('.toggleTwo');
const admPassword = document.getElementById('admPassword'); // case of demote admin
const notificationSettingsButtons = document.getElementById('notification-settings-buttons');

toggleTwoDivs.forEach((div, index) => {
  const name = div.dataset.name ?? '';
  const initialValue = div.dataset.initialvalue === 'true';

  const hiddenToggle = div.querySelector('.hiddenToggle');

  const toggleId = `toggleTwoInput_${index}`;

  const toggleHTML = `
    <label for="${toggleId}" class="flex items-center cursor-pointer select-none text-dark dark:text-white gap-2 text-sm">
        <div class="relative">
            <input type="checkbox" id="${toggleId}" class="toggleTwoInput peer sr-only">
            <div class="block h-8 rounded-full dark:bg-dark-2 bg-input w-14"></div>
            <div
                class="absolute w-6 h-6 transition bg-white rounded-full dot dark:bg-dark-4 left-1 top-1 peer-checked:translate-x-full peer-checked:bg-purple">
            </div>
        </div>
        ${name}
    </label>
  `;

  div.insertAdjacentHTML('beforeend', toggleHTML);

  const toggleTwo = div.querySelector('.toggleTwoInput');
  toggleTwo.checked = initialValue;

  hiddenToggle.value = initialValue ? 'true' : 'false';

  toggleTwo.addEventListener('change', () => {
    hiddenToggle.value = toggleTwo.checked ? 'true' : 'false';

    if (notificationSettingsButtons) {
      notificationSettingsButtons.classList.remove('hidden');
    }
    if (admPassword && initialValue) {
      admPassword.classList.toggle('hidden');
    }
  });
});
