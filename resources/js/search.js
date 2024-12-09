import { sendAjaxRequest } from './utils';

const searchBarDiv = document.getElementById('search-bar');
const searchContainer = document.getElementById('search-container');
const resultsDiv = document.getElementById('search-results');
const baseUrl = searchBarDiv ? searchBarDiv.dataset.url : '';
const isAuth = searchBarDiv ? searchBarDiv.dataset.auth : '';
let loading = false;

let clickedInsideResults = false;
resultsDiv.addEventListener('mousedown', () => {
  clickedInsideResults = true;
});

searchBarDiv.addEventListener('blur', () => {
  setTimeout(() => {
    if (!clickedInsideResults) {
      resultsDiv.classList.add('hidden');
      searchContainer.classList.remove('rounded-t-2xl');
      searchContainer.classList.add('rounded-2xl');
    }
    clickedInsideResults = false;
  }, 100); // Delay for links
});

searchBarDiv.addEventListener('focus', () => {
  if (searchBarDiv.dataset.auth) {
    resultsDiv.classList.remove('hidden');
    searchContainer.classList.add('rounded-t-2xl');
    searchContainer.classList.remove('rounded-2xl');
  }
});

searchBarDiv.onkeyup = async () => {
  resultsDiv.classList.remove('hidden');
  if (searchBarDiv.value === '') {
    searchContainer.classList.remove('rounded-t-2xl');
    searchContainer.classList.add('rounded-2xl');
    resultsDiv.innerHTML = '';
    return;
  } else {
    if (searchBarDiv.dataset.auth) {
      searchContainer.classList.remove('rounded-2xl');
      searchContainer.classList.add('rounded-t-2xl');
    }
  }

  if (loading) {
    return;
  }

  const searchQuery = `${baseUrl}/api/search/${searchBarDiv.value}`;
  sendAjaxRequest(
    searchQuery,
    (data) => {
      resultsDiv.innerHTML = '';
      showElements(data['news_posts'], buildPost);
      if (isAuth) {
        showElements(data['tags'], buildTag);
        showElements(data['users'], buildUser);
      }
      if (data['news_posts'].length > 0) {
        addMorePosts(searchBarDiv.value);
      }
    },
    'GET'
  );
};

const showElements = (elements, buildFunction) => {
  elements.forEach((element) => {
    const postResult = document.createElement('div');
    postResult.classList.add('shadow-4xl');
    postResult.classList.add('shadow-white');
    postResult.innerHTML = buildFunction(element);
    resultsDiv.appendChild(postResult);
  });
};

const addMorePosts = (searchQuery) => {
  const morePostsDiv = document.createElement('div');
  const url = `${baseUrl}/search/posts/${searchQuery}`;

  morePostsDiv.innerHTML = `
        <div class="p-2 hover:bg-gray-700 hover:text-white">
            <a href=${url} >
                See more posts
            </a>
        </div>
    `;
  resultsDiv.appendChild(morePostsDiv);
};

const buildPost = (post) => {
  const url = `${baseUrl}/news/${post.id}`;
  return `
            <div class="p-2 hover:bg-gray-700">
                <a href="${url}" class="flex items-center">
                    <p class="bg-red-400 px-3 py-1 h-7 mr-1 rounded-full text-sm">Post</p>
                    <div class="flex-1 min-w-0">
                        <p>
                            ${post.title}
                        </p>
                        <p class="text-sm text-nowrap text-ellipsis overflow-hidden">
                            ${post.content}
                        </p>
                    </div>
                </a>
            </div>
    `;
};

const buildTag = (tag) => {
  const url = `${baseUrl}/search/posts/tags/${tag.name}`;
  return `
        <div class="p-2 hover:bg-gray-700">
            <a href="${url}" class="flex items-center">
                <p class="bg-gray-200 px-3 py-1 h-7 mr-2 rounded-full text-sm text-input">Tag</p>
                <div class="flex-1 min-w-0">
                    <p>
                        ${tag.name}
                    </p>
                </div>
            </a>
        </div>
    
    `;
};

const buildUser = (user) => {
  const url = `${baseUrl}/users/${user.id}/posts`;
  return `
        <div class="p-2 hover:bg-gray-700">
            <a href="${url}" class="flex items-center">
                <p class="bg-green-200 px-3 py-1 h-7 mr-2 rounded-full text-sm text-input">User</p>
                <div class="flex-1 min-w-0">
                    <p class="align-middle">
                        ${user.public_name}
                    </p>
                    <p class="text-sm text-nowrap text-ellipsis overflow-hidden align-middle">
                        ${user.username}
                    </p>
                </div>
            </a>
        </div>
    `;
};
