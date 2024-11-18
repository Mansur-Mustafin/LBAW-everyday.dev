const thumbnailButton = document.getElementById('personalizedFileInput')
const fileInput = document.getElementById('realFileInput')
const deleteThumbnailButton = document.getElementById('deleteThumbnail')
const tagSelector = document.getElementById('tagSelector')
const selectedTags = document.getElementById('selectedTags')
const createForm = document.getElementById('createForm')

thumbnailButton.addEventListener('click', function (evt) {
   evt.preventDefault()
   fileInput.click()
})

fileInput.addEventListener('change', function (evt) {
   const [file] = fileInput.files
   if (file) {
      thumbnailButton.style.backgroundImage = `url(${URL.createObjectURL(file)})`
      thumbnailButton.style.backgroundSize = 'cover'
      thumbnailButton.innerHTML = ''
      deleteThumbnailButton.style.display = 'block'
   }
})

deleteThumbnailButton.addEventListener('click', function (evt) {
   evt.preventDefault()
   thumbnailButton.style.backgroundImage = ''
   thumbnailButton.innerHTML = 'Thumbnail'
   deleteThumbnailButton.style.display = 'none'
})

tagSelector.addEventListener('change', function () {
   const selectedTag = tagSelector.value

   if (selectedTag) {
      const tagElement = document.createElement('div')
      tagElement.dataset.tag = selectedTag;
      tagElement.textContent = '#' + selectedTag.toLowerCase()
      tagElement.className = 'bg-white rounded-xl p-2 text-input font-semibold text-sm'
      selectedTags.appendChild(tagElement)

      for (let i = 0; i < tagSelector.options.length; i++) {
         if (tagSelector.options[i].value === selectedTag) {
            tagSelector.remove(i);
            tagSelector.value = ''
            break;
         }
      }
   }
})

createForm.addEventListener('submit', function (evt) {
   evt.preventDefault()
   let post_tags = [];

   Array.from(selectedTags.children).forEach((child) => {
      post_tags.push(child.dataset.tag);
   });

   console.log(post_tags)

   document.getElementById('tagsInput').value = post_tags.join(',');

   createForm.submit()
})