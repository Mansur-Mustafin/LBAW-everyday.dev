import { changeImage, deleteImage } from "./utils";

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
  changeImage(fileInput,thumbnailButton,deleteThumbnailButton,buttonAddImage,removeImage)
});

deleteThumbnailButton.addEventListener("click", function (evt) {
  evt.preventDefault();
  deleteImage(thumbnailButton,deleteThumbnailButton,buttonAddImage,removeImage)
});

}
