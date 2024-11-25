const thumbnailButton = document.getElementById('personalizedFileInput')
const fileInput = document.getElementById('realFileInput')
const deleteThumbnailButton = document.getElementById('deleteThumbnail')
const tagSelector = document.getElementById('tagSelector')
const selectedTags = document.getElementById('selectedTags')
const createForm = document.getElementById('createForm')
const title = document.getElementById('title')

const followersToggle = document.getElementById('toggleTwo')
const hiddenToggle = document.getElementById('hiddenToggle')

if (createForm) {

thumbnailButton.addEventListener('click', function (evt) {
  evt.preventDefault()
  fileInput.click()
})

followersToggle.addEventListener('change', function (evt) {
  hiddenToggle.value = this.checked ? 'true' : 'false'
})

title.addEventListener('change', function (evt) {
  title.style.borderWidth = '0px'
})

fileInput.addEventListener('change', function (evt) {
  const [file] = fileInput.files
  if (file) {
    thumbnailButton.style.backgroundImage = `url(${URL.createObjectURL(file)})`
    thumbnailButton.style.backgroundSize = 'cover'
    thumbnailButton.style.borderWidth = '0px'
    thumbnailButton.innerHTML = ''
    deleteThumbnailButton.style.display = 'block'
  }
})

deleteThumbnailButton.addEventListener('click', function (evt) {
  evt.preventDefault()
  thumbnailButton.style.backgroundImage = ''
  thumbnailButton.innerHTML = 'Thumbnail'
  deleteThumbnailButton.style.display = 'none'
  fileInput.value = ''
})

tagSelector.addEventListener('change', function () {
  const selectedTag = tagSelector.value;
  if (selectedTag) {
      const newTagElement = document.createElement('div');
      newTagElement.dataset.tag = selectedTag;
      newTagElement.classList.add('relative', 'inline-block', 'mr-2');
      newTagElement.innerHTML = `
          <span class="text-md text-input font-medium lowercase bg-white p-2 rounded-md">#${selectedTag.toLowerCase()}</span>
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
  evt.preventDefault()
  let post_tags = [];

  Array.from(selectedTags.children).forEach((child) => {
    post_tags.push(child.dataset.tag);
  });

  if (post_tags.length >= 0) document.getElementById('tagsInput').value = post_tags.join(',');

  if (!fileInput.files.length || !title.value.length) {

    if (!fileInput.files.length) {
      thumbnailButton.style.borderWidth = '1px'
      thumbnailButton.style.borderColor = 'red'
    }

    if (!title.value.length) {
      title.style.borderWidth = '1px'
      title.style.borderColor = 'red'
    }

    return
  }

  // console.log("File Input Value:", fileInput.files);
  // console.log("Title:", title.value);
  // console.log("value:", hiddenToggle.value);
  createForm.submit()
})


}