const editImage = document.getElementById("edit-image")

function changeImage(fileInput,thumbnailButton,deleteThumbnailButton,buttonAddImage,removeImage) {
  const file = fileInput.files[0];
  if (file) {
    const imgTag = thumbnailButton.querySelector("img");
    imgTag.src = URL.createObjectURL(file);
    deleteThumbnailButton.classList.remove('hidden');
    imgTag.classList.remove('hidden');
    buttonAddImage.classList.add('hidden');
    removeImage.value = 'false';
  }
}

function deleteImage(thumbnailButton,deleteThumbnailButton,buttonAddImage,removeImage) {
  const imgTag = thumbnailButton.querySelector("img");
  imgTag.src = '';
  imgTag.classList.add('hidden');
  buttonAddImage.classList.remove('hidden');
  removeImage.value = 'true';
  deleteThumbnailButton.classList.add('hidden');
}

if (editImage) {
  const thumbnailButton = document.getElementById("personalizedFileInput");
  const buttonAddImage = document.getElementById("buttonAddImage");

  const fileInput = document.getElementById("realFileInput");
  const deleteThumbnailButton = document.getElementById("deleteThumbnail");
  const removeImage =  document.getElementById("fileRemoved");

  thumbnailButton.addEventListener("click", function (evt) {
    evt.preventDefault();
    fileInput.click()
  });
  buttonAddImage.addEventListener("click", function (evt) {
    evt.preventDefault();
    fileInput.click()
  });

  fileInput.addEventListener("change", function (evt) {
    thumbnailButton.classList.remove('hidden')
    changeImage(fileInput,thumbnailButton,deleteThumbnailButton,buttonAddImage,removeImage)
  });

  deleteThumbnailButton.addEventListener("click", function (evt) {
    evt.preventDefault();
    deleteImage(thumbnailButton,deleteThumbnailButton,buttonAddImage,removeImage)
  });
}