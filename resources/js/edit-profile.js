const editImage = document.getElementById("edit-image")

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
  const file = fileInput.files[0];
  if (file) {
    const imgTag = thumbnailButton.querySelector("img");
    imgTag.src = URL.createObjectURL(file);
    deleteThumbnailButton.style.display = "block";
    imgTag.classList.remove('hidden');
    buttonAddImage.classList.add('hidden');
    removeImage.value = 'false';
  }
});

deleteThumbnailButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  const imgTag = thumbnailButton.querySelector("img");
  imgTag.src = '';
  imgTag.classList.add('hidden');
  buttonAddImage.classList.remove('hidden');
  removeImage.value = 'true';
  deleteThumbnailButton.style.display = "none";
});

}
