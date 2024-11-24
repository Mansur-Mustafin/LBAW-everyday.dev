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

const searchBar = document.getElementById("admin-search-bar")
if(searchBar) {
  const resultsDiv = document.getElementById("admin-search-users-results")
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  const baseUrl = searchBar.dataset.url

  const adminBadge = `
            <span class="">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg>
            </span>
  `


  const buildUser = (user) => {
    const pageUrl = `${baseUrl}/users/${user.id}/posts`
    const editProfileUrl = `${baseUrl}/admin/users/${user.id}/edit`
    return `
      <div class="flex flex-col border border-gray-700 rounded">
          <div class="flex justify-between p-2">
            <div>
              <h2 class="text-2xl flex gap-1">
                <a href="${pageUrl}">
                  ${user.public_name}
                </a>
                <span class="hidden">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                </span>
                <span class="hidden">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-dashed"><path d="M10.1 2.182a10 10 0 0 1 3.8 0"/><path d="M13.9 21.818a10 10 0 0 1-3.8 0"/><path d="M17.609 3.721a10 10 0 0 1 2.69 2.7"/><path d="M2.182 13.9a10 10 0 0 1 0-3.8"/><path d="M20.279 17.609a10 10 0 0 1-2.7 2.69"/><path d="M21.818 10.1a10 10 0 0 1 0 3.8"/><path d="M3.721 6.391a10 10 0 0 1 2.7-2.69"/><path d="M6.391 20.279a10 10 0 0 1-2.69-2.7"/></svg>
                </span>
                ${user.is_admin == true 
                  ? adminBadge
                  : ''}
              </h1>
              <h3 class="text-gray-400 hidden">${user.username}</h3>
              <h3 class="text-gray-400">${user.rank}</h3>
              <h3 class="text-gray-400">${user.email}</h3>
            </div>
            <a class="flex flex-col p-2 justify-center" href="${editProfileUrl}">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
            </a>
          </div>
      </div>
    `
  }

  let loading = false
  searchBar.onkeyup = async () => {
    if(loading) return
    const searchQuery = `${baseUrl}/search/users/${searchBar.value}`
    resultsDiv.innerHTML = '';
    loading = true
    fetch(searchQuery, {
      method: 'GET',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      }
    })
    .then(response => {
      loading = false
      if (response.ok) {
        return response.json();
      } 
    })
    .then(data => {
      data["users"].forEach(user => {
        resultsDiv.innerHTML += buildUser(user)
      });
    }) 
    .catch(error => {
      console.log("Error",error)
    }) 
  }

}