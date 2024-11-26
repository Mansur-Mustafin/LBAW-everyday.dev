// Posts

const postContainer = document.getElementById('news-posts-container')

if (postContainer) {
    const loadingIcon = document.getElementById('loading-icon');
    const footer = document.getElementById('profile-footer')
    let lastPage = postContainer.dataset.last_page
    let newsPageURL = postContainer.dataset.url
    let loading = false;

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    let page = 1;
    let endPage = 1;

    document.addEventListener('scroll', function () {
        let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        let windowHeight = window.innerHeight;
        let documentHeight = document.documentElement.scrollHeight;

        if (scrollTop + windowHeight >= documentHeight - 100) {
            // TODO: Refactor this in the future
            endPage++;
            if (endPage > 4) {
                endPage = 0;
                if (page <= lastPage && loading == false) {
                    page++;
                    loadMoreData(page);
                }
                if (page > lastPage) {
                    if (loadingIcon) loadingIcon.style.display = 'none';
                    if (footer) footer.style.display = 'block'
                }
            }
        }
    })

    function loadMoreData(page) {
        if (loading) return;
        loading = true;

        if (loadingIcon) loadingIcon.style.display = 'block';

        fetch(newsPageURL + `?page=${page}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
            .then(response => {
                loading = false;
                if (loadingIcon) loadingIcon.style.display = 'none';
                return response.json();
            })
            .then(data => {
                if (data.news_posts == "") {
                    return;
                }
                postContainer.innerHTML += data.news_posts
            })
    }
}

// Users
const resultsDiv = document.getElementById("admin-search-users-results")
if (resultsDiv) {
    const searchBar = document.getElementById("admin-search-bar")
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const baseUrl = searchBar.dataset.url
    let loading = false
    let endPage = 1
    let page = 1
    let lastPage = 0
    const loadingIcon = document.getElementById('loading-icon');

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
                <h3 class="text-gray-400 hidden">${user.rank}</h3>
                <h3 class="text-gray-400 hidden">${user.status}</h3>
                <h3 class="text-gray-400">${user.username}</h3>
                <h3 class="text-gray-400">${user.email}</h3>
                </div>
                <a class="flex flex-col p-2 justify-center" href="${editProfileUrl}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
                </a>
            </div>
        </div>
        `
    }

    const buildByRequest = async (url) => {
        if (loading) return
        loading = true
        loadingIcon.style.display = 'block'
        fetch(url, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
            .then(response => {
                loading = false
                loadingIcon.style.display = 'none'
                if (response.ok) {
                    return response.json();
                }
            })
            .then(data => {
                lastPage = data.last_page
                data.users.data.forEach(user => {
                    resultsDiv.innerHTML += buildUser(user)
                });
            })
            .catch(error => {
                console.log("Error", error)
            })
    }

    window.onload = async () => {
        const searchQuery = `${baseUrl}/search/users/`
        resultsDiv.innerHTML = '';
        endPage = 1
        page = 1
        buildByRequest(searchQuery)
    }

    searchBar.onkeyup = async () => {
        const searchQuery = `${baseUrl}/search/users/${searchBar.value}`
        resultsDiv.innerHTML = '';
        endPage = 1
        page = 1
        buildByRequest(searchQuery)
    }

    const loadMoreData = async (page) => {
        const searchQuery = `${baseUrl}/search/users/${searchBar.value}?page=${page}`
        endPage = 1
        buildByRequest(searchQuery)
    }

    document.addEventListener('scroll', function () {
        let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        let windowHeight = window.innerHeight;
        let documentHeight = document.documentElement.scrollHeight;
        loading = false

        if (scrollTop + windowHeight >= documentHeight - 100) {
            // TODO: Refactor this in the future
            endPage++;
            if (endPage > 4) {
                endPage = 0;
                if (page <= lastPage && loading == false) {
                    page++;
                    loadMoreData(page);
                }
                if (page > lastPage) {
                    if (loadingIcon) loadingIcon.style.display = 'none';
                }
            }
        }
    })
}


const usersList = document.getElementById("users-list")
if (usersList) {
    const loadingIcon = document.getElementById('loading-icon');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    const urlObj = new URL(usersList.dataset.url);
    const apiUrl = '/api' + urlObj.pathname;
    let loading = false
    let endPage = 1
    let page = 1
    let lastPage = 0

    const buildUser = (user) => {
        let html = `
            <div class="flex items-center border border-gray-700 rounded-xl px-5 py-4 mt-4">
                <img src="${user.profile_image_path}" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover">
                
                <a href="/users/${user.id}/posts" class="w-40">
                    <div class="ml-4">
                        <p class="font-bold text-white">${user.public_name}</p>
                        <p class="text-sm text-gray-500">@${user.username}</p>
                    </div>
                </a>

                <span class="bg-gray-200 text-gray-800 px-3 py-1 ml-4 rounded-full text-sm">${user.rank}</span>
            `
        if (user.can_follow) {
            html += `
                    <button class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none" 
                            data-user-id="${user.id}" data-action="follow">Follow</button>
                `
        }
        else if (user.can_unfollow) {
            html += `
                    <button class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none" 
                        data-user-id="${user.id}" data-action="unfollow">Unfollow</button>
                `
        }
        html += `</div>`
        return html
    }

    const buildByRequest = async (url) => {
        if (loading) return
        loading = true
        loadingIcon.style.display = 'block'
        fetch(url, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'X-Requested-With': 'XMLHttpRequest',
            }
        })
            .then(response => {
                loading = false
                loadingIcon.style.display = 'none'
                if (response.ok) {
                    return response.json();
                }
            })
            .then(data => {
                console.log(data.users.data)
                lastPage = data.last_page
                data.users.data.forEach(user => {
                    usersList.innerHTML += buildUser(user)
                });
            })
            .catch(error => {
                console.log("Error", error)
            })
    }

    window.onload = async () => {
        usersList.innerHTML = '';
        endPage = 1
        page = 1
        console.log(apiUrl);
        buildByRequest(apiUrl);
    }

    const loadMoreData = async (page) => {
        const searchQuery = `${apiUrl}?page=${page}`
        endPage = 1
        buildByRequest(searchQuery)
    }

    document.addEventListener('scroll', function () {
        let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
        let windowHeight = window.innerHeight;
        let documentHeight = document.documentElement.scrollHeight;
        loading = false

        if (scrollTop + windowHeight >= documentHeight - 100) {
            // TODO: Refactor this in the future
            endPage++;
            if (endPage > 4) {
                endPage = 0;
                if (page <= lastPage && loading == false) {
                    page++;
                    loadMoreData(page);
                }
                if (page > lastPage) {
                    if (loadingIcon) loadingIcon.style.display = 'none';
                }
            }
        }
    })

}