import { sendAjaxRequest } from './utils';
import { addVoteButtonBehaviour } from './vote';

// Adds Vote Behaviour to Post pages
document.addEventListener('DOMContentLoaded', function () {
  addVoteButtonBehaviour();
});

const deleteTag = async (tagId,baseUrl) => {
  sendAjaxRequest(
    `${baseUrl}/admin/tags/delete/${tagId}`,
    (data) => {
      console.log(data)
      window.location = `${baseUrl}/admin/tags`
    },
    'DELETE'
  )
}


const deleteTagProposal = async (tagProposalId,baseUrl) => {
  sendAjaxRequest(
    `${baseUrl}/admin/tag_proposals/delete/${tagProposalId}`,
    (data) => {
      console.log(data)
      window.location = `${baseUrl}/admin/tag_proposals`
    },
    'DELETE'
  )
}

const acceptTagProposal = async (tagProposalId,baseUrl) => {
  sendAjaxRequest(
    `${baseUrl}/admin/tag_proposals/update/${tagProposalId}`,
    (data) => {
      console.log(data)
      window.location = `${baseUrl}/admin/tag_proposals`
    },
    'PUT'
  )
}

const buildByRequest = async (url, buildUser, resultsDiv) => {
  if (loading) return;
  loading = true;
  if (loadingIcon) loadingIcon.classList.remove('hidden');

  const method = 'GET';
  sendAjaxRequest(
    url,
    (data) => {
      loading = false;
      if (loadingIcon) loadingIcon.classList.add('hidden');
      lastPage = data.last_page;
      if(data.users) {
        data.users.data.forEach((user) => {
          resultsDiv.innerHTML += buildUser(user);
        });
      } else if (data.tags) {
        data.tags.data.forEach((tag) => {
          resultsDiv.innerHTML += buildUser(tag)
        })
        resultsDiv.addEventListener('click',async (e) => {
          e.preventDefault();
          const target = e.target
          if (target.id && target.id.endsWith('-delete-button')) {
            const tagId = target.id.split('-delete-button')[0]
            const baseUrl = target.dataset.baseurl
            console.log(tagId,baseUrl)
            await deleteTag(tagId,baseUrl)
          }
        })
      } else {
        console.log(data)
        data.tag_proposals.data.forEach((tagProposal) => {
          resultsDiv.innerHTML += buildUser(tagProposal)
        })
        resultsDiv.addEventListener('click',async (e) => {
          e.preventDefault();
          const target = e.target
          console.log(target)
          if (target.id && target.id.endsWith('-delete-button')) {
            const tagProposalId = target.id.split('-delete-button')[0]
            const baseUrl = target.dataset.baseurl
            console.log(tagProposalId,baseUrl)
            await deleteTagProposal(tagProposalId,baseUrl)
          }
          if (target.id && target.id.endsWith('-accept-button')) {
            const tagProposalId = target.id.split('-accept-button')[0]
            const baseUrl = target.dataset.baseurl
            console.log(tagProposalId,baseUrl)
            await acceptTagProposal(tagProposalId,baseUrl)
          }
        })
      }
    },
    method
  );
};


const loadingIcon = document.getElementById('loading-icon');
let lastPage = 0;
let loading = false;
let page = 1;

// Posts
const postContainer = document.getElementById('news-posts-container');
if (postContainer) {
  const footer = document.getElementById('profile-footer');
  let newsPageURL = postContainer.dataset.url;
  let lastPage = postContainer.dataset.last_page;

  const loadMoreData = (page) => {
    if (loading) return;
    loading = true;

    if (loadingIcon) loadingIcon.classList.remove('hidden');

    const url = newsPageURL + `?page=${page}`;
    const method = 'GET';
    sendAjaxRequest(
      url,
      (data) => {
        loading = false;
        if (loadingIcon) loadingIcon.classList.add('hidden');
        if (data.news_posts == '') {
          return;
        }
        postContainer.innerHTML += data.news_posts;
        addVoteButtonBehaviour();
      },
      method
    );
  };

  document.addEventListener('scroll', function () {
    let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    let windowHeight = window.innerHeight;
    let documentHeight = document.documentElement.scrollHeight;

    if (scrollTop + windowHeight >= documentHeight - 100) {
      if (page <= lastPage && loading == false) {
        page++;
        loadMoreData(page);
      }
      if (page > lastPage) {
        if (loadingIcon) loadingIcon.classList.add('hidden');
        if (footer) footer.classList.remove('hidden');
      }
    }
  });
}

// Users on Admin Dashboard
const resultsDivAdmin = document.getElementById('admin-search-users-results');
const resultsDivAdminTag = document.getElementById('admin-search-tags-results');
const resultsDivAdminTagProposals = document.getElementById('admin-search-tag-proposals-results');

if (resultsDivAdmin || resultsDivAdminTag || resultsDivAdminTagProposals) {
  const searchBar = document.getElementById('admin-search-bar');
  const baseUrl = searchBar.dataset.url;
  let buildFunction;
  let baseQuery;
  let resultsDiv;


  if (resultsDivAdminTag) {
    const buildUserAdminCardTag = (tag) => {
      return `
          <div id="${tag.id}-card" class="flex flex-col border border-gray-700 rounded">
              <div class="flex justify-between p-2">
                <p class="p-5">${tag.name}</p>
              <a href="" id="${tag.id}-delete-button" class="place-content-center m-3" data-baseurl="${baseUrl}">  
                &#10060;
              </a>  
          </div>
          `;
    };
    buildFunction = buildUserAdminCardTag;
    baseQuery = `${baseUrl}/api/search/tags/`;
    resultsDiv = resultsDivAdminTag;
  }
  else if (resultsDivAdmin) {
    const buildUserAdminCardUser = (user) => {
      const adminBadge = `
                  <span class="">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg>
                  </span>
          `;
      const pageUrl = `${baseUrl}/users/${user.id}/posts`;
      const editProfileUrl = `${baseUrl}/admin/users/${user.id}/edit`;
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
                      ${user.is_admin == true ? adminBadge : ''}
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
          `;
    };
    buildFunction = buildUserAdminCardUser
    baseQuery = `${baseUrl}/api/search/users/`;
    resultsDiv = resultsDivAdmin
  } else if (resultsDivAdminTagProposals) {
    const buildUserAdminCardTagProposal = (tagProposal) => {
      return `
          <div id="${tagProposal.id}-card" class="flex border border-gray-700 rounded p-2">
            <div class="flex-grow">
              <p class="text-xl">${tagProposal.name}</p>
              <p class="">${tagProposal.description}</p>
              <p class="text-gray-600">from ${tagProposal.proposer.public_name}
              <span class="">@${tagProposal.proposer.username}</span>
              </p>
            </div>
            ${
              !tagProposal.is_resolved 
              ? `
                <a href="" id="${tagProposal.id}-accept-button" class="text-xl place-content-center m-3" data-baseurl="${baseUrl}">  
                  &#x2705;
                </a>  
                <a href="" id="${tagProposal.id}-delete-button" class="place-content-center m-3" data-baseurl="${baseUrl}">  
                  &#10060;
                </a>  
              `
              : `
                <p class="place-content-center m-3">
                Accepted
                </p>
              `
            }
          </div>
          `;
    };
    buildFunction = buildUserAdminCardTagProposal
    baseQuery = `${baseUrl}/api/search/tag_proposals/`;
    resultsDiv = resultsDivAdminTagProposals
  }


  window.onload = async () => {
    resultsDiv.innerHTML = '';
    page = 1;
    buildByRequest(baseQuery, buildFunction , resultsDiv);
  };

  const loadMoreData = async (page) => {
    buildByRequest(baseQuery+ `${searchBar.value}?page=${page}`, buildFunction , resultsDiv);
  };

  if (searchBar) {
    searchBar.onkeyup = async () => {
      resultsDiv.innerHTML = '';
      page = 1;
      buildByRequest(baseQuery+searchBar.value, buildFunction, resultsDiv);
    };
  }

  document.addEventListener('scroll', function () {
    let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    let windowHeight = window.innerHeight;
    let documentHeight = document.documentElement.scrollHeight;

    if (scrollTop + windowHeight >= documentHeight - 100) {
      if (page <= lastPage && loading == false) {
        page++;
        loadMoreData(page);
      }
      if (page > lastPage) {
        if (loadingIcon) loadingIcon.classList.add('hidden');
      }
    }
  });
}

// Users on Followers/Following Pages
const resultsDivFollow = document.getElementById('users-list');
if (resultsDivFollow) {
  const urlObj = new URL(resultsDivFollow.dataset.url);
  const apiUrl = '/api' + urlObj.pathname;

  const buildUserFollowCard = (user) => {
    let html = `
            <div class="flex items-center border border-gray-700 rounded-xl px-5 py-4 mt-4">
                <img src="${user.profile_image.url}" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover">
                
                <a href="/users/${user.id}/posts" class="w-40">
                    <div class="ml-4">
                        <p class="font-bold text-white">${user.public_name}</p>
                        <p class="text-sm text-gray-500">@${user.username}</p>
                    </div>
                </a>

                <span class="bg-gray-200 text-gray-800 px-3 py-1 ml-4 rounded-full text-sm">${user.rank}</span>
            `;
    if (user.can_follow) {
      html += `
                    <button class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none" 
                            data-user-id="${user.id}" data-action="follow">Follow</button>
                `;
    } else if (user.can_unfollow) {
      html += `
                    <button class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50 hover:border-none" 
                        data-user-id="${user.id}" data-action="unfollow">Unfollow</button>
                `;
    }
    html += `</div>`;
    return html;
  };

  window.onload = async () => {
    resultsDivFollow.innerHTML = '';
    page = 1;
    buildByRequest(apiUrl, buildUserFollowCard, resultsDivFollow);
  };

  const loadMoreData = async (page) => {
    const url = apiUrl + `?page=${page}`;
    buildByRequest(url, buildUserFollowCard, resultsDivFollow);
  };

  document.addEventListener('scroll', function () {
    let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
    let windowHeight = window.innerHeight;
    let documentHeight = document.documentElement.scrollHeight;

    if (scrollTop + windowHeight >= documentHeight - 100) {
      if (page <= lastPage && loading == false) {
        page++;
        loadMoreData(page);
      }
      if (page > lastPage) {
        if (loadingIcon) loadingIcon.classList.add('hidden');
      }
    }
  });
}
