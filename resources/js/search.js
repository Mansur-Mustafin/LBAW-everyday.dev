const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const searchBarDiv = document.getElementById('search-bar')
const resultsDiv = document.getElementById('search-results')
const baseUrl = searchBarDiv.dataset.url

searchBarDiv.onkeyup = async () => {
    resultsDiv.innerHTML = ''
    const searchQuery = `${baseUrl}/search/${searchBarDiv.value}`

    fetch(searchQuery, {
      method: 'GET',
      headers: {
        'X-CSRF-TOKEN': csrfToken
      }
    })
    .then(response => {
      if (response.ok) {
        return response.json();
      } 
    })
    .then(data => {
      showElements(data["news_posts"],buildPost)
      showElements(data["tags"],buildTag)
      showElements(data["users"],buildUser)
    }) 
    .catch(error => {
      console.log("Error",error)
    }) 
}

const showElements = (elements,buildFunction) => {
    elements.forEach(element => {
        const postResult = document.createElement("div");
        postResult.innerHTML = buildFunction(element)
        resultsDiv.appendChild(postResult)
    });
}

const buildPost = (post) => {
    const url = `${baseUrl}/news/${post.id}`
    return `
            <div class="p-2">
                <a href="${url}" class="">
                    <p>
                        ${post.title}
                    </p>
                    <p class="text-sm text-gray-600 text-nowrap text-ellipsis overflow-hidden">
                        ${post.content}
                    </p>
                </a>
            </div>
    ` 
}

const buildTag = (tag) => {
    const url = "/#" // TODO: Redirect somewhere
    return `
        <div class="p-2">
            <a href="${url}" class="">
                <p>
                    ${tag.name}
                </p>
            </a>
        </div>
    
    `
}

const buildUser = (user) => {
    const url = `${baseUrl}/users/${user.id}`
    return `
        <div class="p-2">
            <a href="${url}" class="">
                <div class="flex gap-1">
                    <p class="align-middle">
                        ${user.public_name}
                        <span class="text-sm text-gray-600 text-nowrap text-ellipsis overflow-hidden align-middle">
                            ${user.username}
                        </span>
                    </p>
                </div>
                <p class="text-sm text-gray-600 text-nowrap text-ellipsis overflow-hidden">
                    ${user.email}
                </p>
            </a>
        </div>
    `
}