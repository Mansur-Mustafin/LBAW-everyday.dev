// UPLOAD IMAGES
const editForm = document.getElementById("admin-edit-profile")
if (editForm) {
  const adminToggle = document.getElementById("toggleTwoAdmin")
  const hiddenToggle = document.getElementById('hiddenToggleAdmin')

  adminToggle.addEventListener('change', function (evt) {
    hiddenToggle.value = this.checked ? 'true' : 'false'
  })
}
