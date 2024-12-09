const filter = document.getElementById('filter');

const toggleFilterButton = document.getElementById('toggle-filter-button');
if (toggleFilterButton) {
  toggleFilterButton.addEventListener('click', () => {
    if (filter.classList.contains('opacity-0')) {
      filter.classList.remove('opacity-0');
      filter.classList.add('opacity-100');
    } else {
      filter.classList.remove('opacity-100');
      filter.classList.add('opacity-0');
    }
  });
}

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.filter-section').forEach((section) => {
    const header = section.querySelector('.filter-header');
    const list = section.querySelector('.filter-list');
    const chevronIcon = header.querySelector('svg');
    const showAllButton = section.querySelector('.show-all-button');
    
    header.addEventListener('click', () => {
      if (list.style.maxHeight) {
        list.style.maxHeight = null;
        chevronIcon.classList.remove('rotate-180');
      } else {
        list.style.maxHeight = list.scrollHeight + 'px';
        chevronIcon.classList.add('rotate-180');
      }
    });

    showAllButton.addEventListener('click', () => {
      if (showAllButton.dataset.value === 'show-all') {
        document.querySelectorAll('li.hidden').forEach((li) => {
          li.classList.remove('hidden');
        });
        list.style.maxHeight = list.scrollHeight + 'px';
        showAllButton.innerHTML = 'Show Less';
        showAllButton.dataset.value = 'show-less';
      } else if (showAllButton.dataset.value === 'show-less') {
        list.style.maxHeight = list.scrollHeight + 'px';
        document.querySelectorAll('li.more-limit').forEach((li) => {
          li.classList.add('hidden');
        });
        list.style.maxHeight = list.scrollHeight + 'px';
        showAllButton.innerHTML = 'Show All';
        showAllButton.dataset.value = 'show-all';
      }
    });
  });
});
