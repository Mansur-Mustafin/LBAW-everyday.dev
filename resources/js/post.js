import { toMarkdown } from "./markdown";

const tagSelector = document.getElementById('tagSelector');
const selectedTags = document.getElementById('selectedTags');

const createForm = document.getElementById('createForm');
const title = document.getElementById('title');

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

    createForm.submit();
  });


  const writeButton = document.getElementById('write-button')
  const previewButton = document.getElementById('preview-button')

  const previewArea = document.getElementById('preview-area')
  const writeArea = document.getElementById('write-area')

  writeButton.addEventListener('click', (e) => {
    writeButton.classList.add('bg-input')
    previewButton.classList.remove('bg-input')

    writeArea.classList.add('flex')
    writeArea.classList.remove('hidden')

    previewArea.classList.remove('block')
    previewArea.classList.add('hidden')
  })

  previewButton.addEventListener('click', (e) => {

    const content = writeArea.value

    previewButton.classList.add('bg-input')
    writeButton.classList.remove('bg-input')

    previewArea.classList.remove('hidden')

    previewArea.innerHTML = toMarkdown(content)

    console.log(previewArea.innerHTML)

    writeArea.classList.remove('flex')
    writeArea.classList.add('hidden')
  })

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

      editForm.submit();
    });
  }
}
