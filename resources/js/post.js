import { copyToClipboard, sendAjaxRequest, transformLoadingButton } from './utils.js';

const tagSelector = document.getElementById('tagSelector');
const selectedTags = document.getElementById('selectedTags');

const createForm = document.getElementById('createForm');
const title = document.getElementById('title');

const tagsSection = document.getElementById('tags-section');

const omitSection = document.getElementById('omit-section')

if (tagsSection) {
  const baseUrl = tagsSection.dataset.url;

  tagsSection.addEventListener('click', (e) => {
    e.preventDefault();

    if (e.target.id.endsWith('-follow')) {
      const tagId = e.target.id.split('-follow')[0];
      const url = `${baseUrl}/tag/store/${tagId}`;
      sendAjaxRequest(url, (data) => {}, 'POST');
      document.getElementById(`${tagId}-follow`).classList.add('hidden');
      document.getElementById(`${tagId}-unfollow`).classList.remove('hidden');
    }
    if (e.target.id.endsWith('-unfollow')) {
      const tagId = e.target.id.split('-unfollow')[0];
      const url = `${baseUrl}/tag/delete/${tagId}`;
      sendAjaxRequest(url, (data) => {}, 'DELETE');
      document.getElementById(`${tagId}-follow`).classList.remove('hidden');
      document.getElementById(`${tagId}-unfollow`).classList.add('hidden');
    }
  });
}

// Omit Post
if(omitSection) {
  const omitButton = document.getElementById('omit-button');
  const unomitButton = document.getElementById('unomit-button');

  const baseUrl = omitSection.dataset.url
  const postId  = omitSection.dataset.post


  omitButton.addEventListener('click',() => {
    omitButton.classList.add('hidden')
    unomitButton.classList.remove('hidden')
    const url = `${baseUrl}/news/${postId}/omit`
    sendAjaxRequest(
      url,
      (_data) => {},
      'PUT'
    )
  })
  unomitButton.addEventListener('click',() => {
    omitButton.classList.remove('hidden')
    unomitButton.classList.add('hidden')
    const url = `${baseUrl}/news/${postId}/unomit`
    sendAjaxRequest(
      url,
      (_data) => {},
      'PUT'
    )
  })
}

// Create Post
if (createForm) {
  title.addEventListener('change', function (evt) {
    title.style.borderWidth = '0px';
  });

  tagSelector.addEventListener('change', function () {
    const selectedTag = tagSelector.value;
    if (selectedTag) {
      const newTagElement = document.createElement('div');
      newTagElement.dataset.tag = selectedTag;
      newTagElement.classList.add('relative', 'inline-block', 'mr-2');
      newTagElement.innerHTML = `
            <span class="text-md text-input font-medium lowercase bg-white px-2 py-1 rounded-md">#${selectedTag.toLowerCase()}</span>
            <button type="button" class="absolute top-0 right-0 transform -translate-y-1/2 translate-x-1/2 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs hover:bg-red-600">
                ×
            </button>
        `;

      const removeButton = newTagElement.querySelector('button');
      removeButton.addEventListener('click', function () {
        selectedTags.removeChild(newTagElement);

        const newOption = document.createElement('option');
        newOption.value = selectedTag;
        newOption.textContent = selectedTag;
        tagSelector.appendChild(newOption);

        delete newTagElement.dataset.tag;
      });

      selectedTags.appendChild(newTagElement);

      for (let i = 0; i < tagSelector.options.length; i++) {
        if (tagSelector.options[i].value === selectedTag) {
          tagSelector.remove(i);
          tagSelector.value = '';
          break;
        }
      }
    }
  });

  createForm.addEventListener('submit', function (evt) {
    evt.preventDefault();

    // call this function after validation
    transformLoadingButton(createForm.querySelector('#post-button'));

    let post_tags = [];

    Array.from(selectedTags.children).forEach((child) => {
      post_tags.push(child.dataset.tag);
    });

    if (post_tags.length >= 0) document.getElementById('tagsInput').value = post_tags.join(',');

    if (!title.value.length) {
      title.style.borderWidth = '1px';
      title.style.borderColor = 'red';
      return;
    }
  });
}

const toggleButton = document.getElementById('toggleTagSelector');
const tagSelectorContainer = document.getElementById('tagSelectorContainer');

const saveButton = document.getElementById('saveButton');
const editForm = document.getElementById('editForm');

// Edit Post
if (editForm) {
  window.toggleEdit = function () {
    const editButton = document.getElementById('edit-button');
    const saveCancelButtons = document.getElementById('save-cancel-buttons');
    const displaySection = document.getElementById('display-section');
    const editSection = document.getElementById('edit-section');
    const selectedTags = document.getElementById('selectedTags');
    const tagSelector = document.getElementById('tagSelector');

    displaySection.classList.toggle('hidden');
    editSection.classList.toggle('hidden');
    editButton.classList.toggle('hidden');
    saveCancelButtons.classList.toggle('hidden');

    const existingTagRemoveButtons = selectedTags.querySelectorAll('button[data-tag]');
    existingTagRemoveButtons.forEach((button) => {
      button.addEventListener('click', function () {
        const tagValue = this.dataset.tag;
        const tagElement = this.parentElement;
        selectedTags.removeChild(tagElement);

        const newOption = document.createElement('option');
        newOption.value = tagValue;
        newOption.textContent = tagValue;
        tagSelector.appendChild(newOption);
      });
    });
  };

  toggleButton.addEventListener('click', () => {
    if (tagSelectorContainer.style.display === 'none') {
      tagSelectorContainer.style.display = 'flex';
    } else {
      tagSelectorContainer.style.display = 'none';
    }
  });

  tagSelector.addEventListener('change', function () {
    const selectedTag = tagSelector.value;
    if (selectedTag) {
      const newTagElement = document.createElement('div');
      newTagElement.dataset.tag = selectedTag;
      newTagElement.classList.add('relative', 'inline-block', 'mr-2');
      newTagElement.innerHTML = `
              <span class="text-md text-input font-medium lowercase bg-white px-2 py-1 rounded-md">#${selectedTag.toLowerCase()}</span>
              <button type="button" class="absolute top-0 right-0 transform -translate-y-1/2 translate-x-1/2 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs hover:bg-red-600">
                  ×
              </button>
          `;

      const removeButton = newTagElement.querySelector('button');
      removeButton.addEventListener('click', function () {
        selectedTags.removeChild(newTagElement);

        const newOption = document.createElement('option');
        newOption.value = selectedTag;
        newOption.textContent = selectedTag;
        tagSelector.appendChild(newOption);

        delete newTagElement.dataset.tag;
      });

      selectedTags.appendChild(newTagElement);

      for (let i = 0; i < tagSelector.options.length; i++) {
        if (tagSelector.options[i].value === selectedTag) {
          tagSelector.remove(i);
          tagSelector.value = '';
          break;
        }
      }
    }
  });

  if (saveButton) {
    saveButton.addEventListener('click', function (evt) {
      evt.preventDefault();

      const selectedTags = document.getElementById('selectedTags');

      let post_tags = [];

      Array.from(selectedTags.children).forEach((child) => {
        post_tags.push(child.dataset.tag);
      });

      if (post_tags.length > 0) {
        document.getElementById('tagsInput').value = post_tags.join(',');
      }
    });
  }
}

const shareButton = document.getElementById('share-post');

if (shareButton) {
  copyToClipboard(shareButton);
}

// had to attach the event to the dom because the buttons are being added dynamically
document.addEventListener('click', (event) => {
  // if the click matches the button
  if (event.target.closest('.post-options')) {
    const button = event.target.closest('.post-options');

    const popup = button.parentElement.querySelector('#post-options-popup');
    if (popup) {
      if (popup.classList.contains('opacity-0')) {
        popup.classList.replace('opacity-0', 'opacity-100');
      } else {
        popup.classList.replace('opacity-100', 'opacity-0');
      }
    }
  }
});
