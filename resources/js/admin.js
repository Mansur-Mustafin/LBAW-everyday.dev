// UPLOAD IMAGES
const editForm = document.getElementById("admin-edit-profile")
if (editForm) {
  const thumbnailButton = document.getElementById("personalizedFileInput");
  const fileInput = document.getElementById("realFileInput");
  const deleteThumbnailButton = document.getElementById("deleteThumbnail");
  const adminToggle = document.getElementById("toggleTwoAdmin")
  const oldImagePath = thumbnailButton.querySelector("img").src;

  adminToggle.addEventListener('change', function (evt) {
    hiddenToggle.value = this.checked ? 'true' : 'false'
  })

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
