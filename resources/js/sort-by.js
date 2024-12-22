document.addEventListener('DOMContentLoaded', () => {
  const sortContainer = document.getElementById('sort-by-container');

  if (sortContainer) {
    const toggleSortButton = document.getElementById('toggle-sort-button');
    const chosenSort = toggleSortButton.querySelector('.sort-button');
    const hiddenSelectedSort = sortContainer.querySelector('input[type=hidden]');
    const sortPopup = document.getElementById('sort-popup');
    const chevronIcon = toggleSortButton.querySelector('svg');

    chosenSort.innerHTML = hiddenSelectedSort.value;

    toggleSortButton.addEventListener('click', () => {
      if (sortPopup.classList.contains('opacity-0')) {
        sortPopup.classList.remove('opacity-0', 'pointer-events-none');
        sortPopup.classList.add('opacity-100');
        chevronIcon.classList.remove('rotate-180');
      } else {
        sortPopup.classList.remove('opacity-100');
        sortPopup.classList.add('opacity-0', 'pointer-events-none');
        chevronIcon.classList.add('rotate-180');
      }
    });

    sortContainer.querySelectorAll('li').forEach((li) => {
      li.addEventListener('click', () => {
        chosenSort.innerHTML = event.currentTarget.innerHTML;

        sortPopup.classList.remove('opacity-100');
        sortPopup.classList.add('opacity-0', 'pointer-events-none');
        chevronIcon.classList.add('rotate-180');
      });
    });
  }
});
