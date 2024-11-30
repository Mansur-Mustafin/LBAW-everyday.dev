const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const defaultHeaders = {
          'X-CSRF-TOKEN': csrfToken,
          'X-Requested-With': 'XMLHttpRequest',
      }  

export function sendAjaxRequest(url,handler,method,headers=defaultHeaders,body=undefined) {
  
  fetch(url,{
    method: method,
    headers: headers,
    body:body
  })
      .then(response => {
          if(response.ok) {
            return response.json();
          }
      })
      .then(data => {
        handler(data)
      })
      .catch(error => {
          console.log("Error", error)
      })
}

export function redirectToLogin() {
    const currentUrl = window.location.href;

    const loginUrl = `/login?redirect=${encodeURIComponent(currentUrl)}`;

    window.location.href = loginUrl;
}

export function changeImage(fileInput,thumbnailButton,deleteThumbnailButton,buttonAddImage,removeImage) {
  const file = fileInput.files[0];
  if (file) {
    const imgTag = thumbnailButton.querySelector("img");
    imgTag.src = URL.createObjectURL(file);
    deleteThumbnailButton.style.display = "block";
    imgTag.classList.remove('hidden');
    buttonAddImage.classList.add('hidden');
    removeImage.value = 'false';
  }
}

export function deleteImage(thumbnailButton,deleteThumbnailButton,buttonAddImage,removeImage) {
  const imgTag = thumbnailButton.querySelector("img");
  imgTag.src = '';
  imgTag.classList.add('hidden');
  buttonAddImage.classList.remove('hidden');
  removeImage.value = 'true';
  deleteThumbnailButton.style.display = "none";
}