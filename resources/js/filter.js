document.addEventListener('DOMContentLoaded', () => {
  const toggleFilter = (filter) => {
    if (filter.classList.contains('opacity-0')) {
      filter.classList.replace('opacity-0', 'opacity-100');
      filter.classList.remove('pointer-events-none');
    } else {
      filter.classList.replace('opacity-100', 'opacity-0');
      filter.classList.add('pointer-events-none');
    }
  };

  const toggleSection = (list, chevronIcon, showAllButton, listMore) => {
    if (list.style.maxHeight) {
      list.style.maxHeight = null;
      chevronIcon.classList.add('rotate-180');
    } else {
      const extraHeight = showAllButton?.dataset.value === 'show-less' ? listMore.scrollHeight : 0;
      list.style.maxHeight = `${list.scrollHeight + extraHeight}px`;
      chevronIcon.classList.remove('rotate-180');
    }
  };

  const showAll = (list, listMore, showAllButton) => {
    if (showAllButton.dataset.value === 'show-all') {
      listMore.style.maxHeight = `${listMore.scrollHeight}px`;
      list.style.maxHeight = `${list.scrollHeight + listMore.scrollHeight}px`;
      showAllButton.textContent = 'Show Less';
      showAllButton.dataset.value = 'show-less';
    } else {
      listMore.style.maxHeight = null;
      showAllButton.textContent = 'Show All';
      showAllButton.dataset.value = 'show-all';
    }
  };

  const filterSearch = (searchInput, tagItems, showAllButton) => {
    const query = searchInput.value.toLowerCase().trim();

    if (query) {
      if (showAllButton.dataset.value === 'show-all') {
        showAllButton.click();
      }
    } else {
      if (showAllButton.dataset.value === 'show-less') {
        showAllButton.click();
      }
    }

    tagItems.forEach((item) => {
      const labelText = item.textContent.toLowerCase();
      item.style.display = labelText.includes(query) ? 'flex' : 'none';
    });
  };

  document.getElementById('toggle-filter-button')?.addEventListener('click', () => {
    const filter = document.getElementById('filter');
    toggleFilter(filter);
  });

  document.querySelectorAll('.filter-section').forEach((section) => {
    const header = section.querySelector('.filter-header');
    const list = section.querySelector('.filter-list');
    const chevronIcon = header.querySelector('svg');
    const showAllButton = section.querySelector('.show-all-button');
    const listMore = section.querySelector('.filter-list-limit');
    const searchInput = section.querySelector('input[type="text"]');
    const tagItems = section.querySelectorAll('.list-element');

    header?.addEventListener('click', () =>
      toggleSection(list, chevronIcon, showAllButton, listMore)
    );
    showAllButton?.addEventListener('click', () => showAll(list, listMore, showAllButton));
    searchInput?.addEventListener('input', () => filterSearch(searchInput, tagItems, showAllButton));
  });
});
