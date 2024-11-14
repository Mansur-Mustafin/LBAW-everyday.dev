const thumbnailButton = document.getElementById('personalizedFileInput')
const fileInput = document.getElementById('realFileInput')

thumbnailButton.addEventListener('click', function (evt) {
   evt.preventDefault()
   fileInput.click()
})

fileInput.addEventListener('change', function (evt) {
   const [file] = fileInput.files
   console.log("ueue")
   if (file) {
      console.log("ueue")
      thumbnailButton.style.backgroundImage = `url(${URL.createObjectURL(file)})`;
      thumbnailButton.style.backgroundSize = 'cover';
      thumbnailButton.innerHTML = ''
   }
})
