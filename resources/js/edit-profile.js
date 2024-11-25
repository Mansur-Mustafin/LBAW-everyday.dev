const editform = document.getElementById("edit-profile")

if (editform) {

const thumbnailButton = document.getElementById("personalizedFileInput");
const fileInput = document.getElementById("realFileInput");
const deleteThumbnailButton = document.getElementById("deleteThumbnail");
const oldImagePath = thumbnailButton.querySelector("img").src;

thumbnailButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  fileInput.click()
});

fileInput.addEventListener("change", function (evt) {
  const file = fileInput.files[0];
  if (file) {
    const imgTag = thumbnailButton.querySelector("img");
    imgTag.src = URL.createObjectURL(file);
    deleteThumbnailButton.style.display = "block";
  }
});

deleteThumbnailButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  const imgTag = thumbnailButton.querySelector("img");
  imgTag.src = oldImagePath;
  fileInput.value = "";
  deleteThumbnailButton.style.display = "none";
});

}

