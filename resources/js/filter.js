const filter = document.getElementById('filter');

document.addEventListener('DOMContentLoaded', () => {
  document.getElementById('toggle-filter-button').addEventListener('click', () => {
    if (filter.classList.contains('opacity-0')) {
      filter.classList.remove('opacity-0');
      filter.classList.add('opacity-100');
    } else {
      filter.classList.remove('opacity-100');
      filter.classList.add('opacity-0');
    }
  });

  document.getElementById('clear-all-button').addEventListener('click', () => {
    document.querySelectorAll('input[type="checkbox"]').forEach((checkbox) => {
      checkbox.checked = false;
    });
  });

  document.querySelectorAll('.filter-section').forEach((section) => {
    const header = section.querySelector('.filter-header');
    const list = section.querySelector('.filter-list');
    const chevronIcon = header.querySelector('svg');
    const showAllButton = section.querySelector('.show-all-button');
    const listMore = section.querySelector('.filter-list-limit');
    const searchInput = section.querySelector('input[type="text"]');
    const tagItems = section.querySelectorAll('.list-element');

    header.addEventListener('click', () => {
      if (list.style.maxHeight) {
        list.style.maxHeight = null;
        chevronIcon.classList.remove('rotate-180');
      } else {
        if (showAllButton && showAllButton.dataset.value === 'show-less') {
          list.style.maxHeight = list.scrollHeight + listMore.scrollHeight + 'px';
        } else {
          list.style.maxHeight = list.scrollHeight + 'px';
        }

        chevronIcon.classList.add('rotate-180');
      }
    });

    showAllButton.addEventListener('click', () => {
      if (showAllButton.dataset.value === 'show-all') {
        listMore.style.maxHeight = listMore.scrollHeight + 'px';
        list.style.maxHeight = list.scrollHeight + listMore.scrollHeight + 'px';

        showAllButton.textContent = 'Show Less';
        showAllButton.dataset.value = 'show-less';
      } else {
        listMore.style.maxHeight = null;

        showAllButton.textContent = 'Show All';
        showAllButton.dataset.value = 'show-all';
      }
    });

    searchInput.addEventListener('input', (e) => {
      const query = e.target.value.toLowerCase().trim();

      tagItems.forEach((item) => {
        const labelText = item.textContent.toLowerCase();
        if (labelText.includes(query)) {
          item.style.display = 'flex';
        } else {
          item.style.display = 'none';
        }
      });
    });
  });
});
