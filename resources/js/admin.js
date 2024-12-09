import { sendAjaxRequest } from "./utils"

// API Requests
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
    `${baseUrl}/admin/tag_proposals/accept/${tagProposalId}`,
    (data) => {
      console.log(data)
      window.location = `${baseUrl}/admin/tag_proposals`
    },
    'PUT'
  )
}
const acceptUnblockAppeal = async (unblockAppealId,baseUrl) => {
  sendAjaxRequest(
    `${baseUrl}/admin/unblock_appeals/accept/${unblockAppealId}`,
    (data) => {
      console.log(data)
      window.location = `${baseUrl}/admin/unblock_appeals`
    },
    'PUT'
  )
}
const deleteUnblockAppeal = async (unblockAppealId,baseUrl) => {
  sendAjaxRequest(
    `${baseUrl}/admin/tag_proposals/delete/${unblockAppealId}`,
    (data) => {
      console.log(data)
      window.location = `${baseUrl}/admin/tag_proposals`
    },
    'DELETE'
  )
}
const blockUser = async (userId,baseUrl) => {
  const url = `${baseUrl}/admin/users/${userId}/block`
  sendAjaxRequest(
    url,
    (data) => {
      console.log(data)
      window.location =`${baseUrl}/admin` 
    },
    'PUT'
  )
}
const unblockUser = async (userId,baseUrl) => {
  const url = `${baseUrl}/admin/users/${userId}/unblock`
  sendAjaxRequest(
    url,
    (data) => {
      console.log(data)
      window.location =`${baseUrl}/admin` 
    },
    'PUT'
  )
}

// Card Builder Functions
const buildUserCard = (user) => {
  const adminBadge = `
    <span class="">
    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shield"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"/></svg>
    </span>
  `;
  const blockedBadge = `
    <span class="">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
    </span>
  `
  const pendingBadge = `
    <span class="">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-dashed"><path d="M10.1 2.182a10 10 0 0 1 3.8 0"/><path d="M13.9 21.818a10 10 0 0 1-3.8 0"/><path d="M17.609 3.721a10 10 0 0 1 2.69 2.7"/><path d="M2.182 13.9a10 10 0 0 1 0-3.8"/><path d="M20.279 17.609a10 10 0 0 1-2.7 2.69"/><path d="M21.818 10.1a10 10 0 0 1 0 3.8"/><path d="M3.721 6.391a10 10 0 0 1 2.7-2.69"/><path d="M6.391 20.279a10 10 0 0 1-2.69-2.7"/></svg>
    </span>
  `
  const pageUrl = `${baseUrl}/users/${user.id}/posts`;
  const editProfileUrl = `${baseUrl}/admin/users/${user.id}/edit`;
  return `
      <div class="flex flex-col p-2">
          <div class="flex justify-between">
              <div class="flex-grow">
                <a href="${pageUrl}" class="text-2xl flex place items-center gap-1">
                  ${user.public_name}
                  ${user.status == 'blocked' ? blockedBadge : ''}    
                  ${user.status == 'pending' ? pendingBadge : ''}    
                  ${user.is_admin == true ? adminBadge : ''}
                </a>
                <h3 class="text-gray-400 hidden">${user.rank}</h3>
                <h3 class="text-gray-400 hidden">${user.status}</h3>
                <h3 class="text-gray-400">${user.username}</h3>
                <h3 class="text-gray-400">${user.email}</h3>
              </div>
              ${
                !user.is_admin 
                ? user.status != 'blocked'
                  ? `
                    <a id="${user.id}-block-button" data-url="${baseUrl}" class="block-button flex flex-col p-2 justify-center" href="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban"><circle cx="12" cy="12" r="10"/><path d="m4.9 4.9 14.2 14.2"/></svg>
                    </a>
                  `
                  : `
                    <a id="${user.id}-unblock-button" data-url="${baseUrl}" class="unblock-button flex flex-col p-2 justify-center" href="">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-dashed"><path d="M10.1 2.182a10 10 0 0 1 3.8 0"/><path d="M13.9 21.818a10 10 0 0 1-3.8 0"/><path d="M17.609 3.721a10 10 0 0 1 2.69 2.7"/><path d="M2.182 13.9a10 10 0 0 1 0-3.8"/><path d="M20.279 17.609a10 10 0 0 1-2.7 2.69"/><path d="M21.818 10.1a10 10 0 0 1 0 3.8"/><path d="M3.721 6.391a10 10 0 0 1 2.7-2.69"/><path d="M6.391 20.279a10 10 0 0 1-2.69-2.7"/></svg>
                    </a >
                  `
                : ''
              }
              <a class="flex flex-col p-2 justify-center" href="${editProfileUrl}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
              </a>
          </div>
      </div>
      `;
}
const buildTagCard = (tag) => {
  return `
      <div id="${tag.id}-card" class="flex flex-col">
          <div class="flex justify-between items-center p-2">
            <p class="text-2xl">${tag.name}</p>
            <a href="" id="${tag.id}-delete-button" class="delete-button place-content-center m-3" data-baseurl="${baseUrl}">  
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/>
                <path d="m6 6 12 12"/>
              </svg>
            </a>  
          </div>
      </div>
  `;
}
const buildTagProposalCard = (tagProposal) => {
  return `
      <div id="${tagProposal.id}-card" class="flex p-2">
        <div class="flex-grow">
          <p class="text-2xl">${tagProposal.name}</p>
          <p class="">${tagProposal.description}</p>
          <p class="text-gray-600">from ${tagProposal.proposer.public_name}
          <span class="">@${tagProposal.proposer.username}</span>
          </p>
        </div>
        ${
          !tagProposal.is_resolved 
          ? `
            <a href="" id="${tagProposal.id}-accept-button" class="accept-button text-xl place-content-center m-3" data-baseurl="${baseUrl}">  
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                <path d="M20 6 9 17l-5-5"/>
              </svg>
            </a>  
            <a href="" id="${tagProposal.id}-delete-button" class="delete-button place-content-center m-3" data-baseurl="${baseUrl}">  
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/>
                <path d="m6 6 12 12"/>
              </svg>
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
}
const buildUnblockAppealCard = (unblockAppeal) => {
  const pageUrl = `${baseUrl}/users/${unblockAppeal.user_id}/posts`;
  return `
      <div id="${unblockAppeal.id}-card" class="flex p-2">
        <div class="flex flex-col flex-grow ">
          <a href="${pageUrl}" class="text-2xl">
            ${unblockAppeal.public_name}
          </a>
          <a class="text-gray-600">
            @${unblockAppeal.username}
          </a>
          <p class="">${unblockAppeal.description}</p>
        </div>
        ${
          !unblockAppeal.is_resolved 
          ? `
            <a href="" id="${unblockAppeal.id}-accept-button" class="accept-button text-xl place-content-center m-3" data-baseurl="${baseUrl}">  
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check">
                <path d="M20 6 9 17l-5-5"/>
              </svg>
            </a>  
            <a href="" id="${unblockAppeal.id}-delete-button" class="delete-button place-content-center m-3" data-baseurl="${baseUrl}">  
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x"><path d="M18 6 6 18"/>
                <path d="m6 6 12 12"/>
              </svg>
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
}

// Card Button Behaviours
const addUserButtons = (resultDiv) => {
  resultDiv.addEventListener('click',(event) => {
    const targetBlock = event.target.closest('.block-button')
    if(targetBlock) {
      event.preventDefault()
      const userId = targetBlock.id.split('-block-button')[0]
      blockUser(userId,baseUrl)
    }
    const targetUnblock = event.target.closest('.unblock-button')
    if(targetUnblock) {
      event.preventDefault()
      const userId = targetUnblock.id.split('-unblock-button')[0]
      unblockUser(userId,baseUrl)
    }
  })
}
const addTagButtons = (resultDiv) => {
  resultDiv.addEventListener('click',(event) => {
    const targetDelete = event.target.closest('.delete-button')
    if(targetDelete) {
      event.preventDefault()
      const tagId = targetDelete.id.split('-delete-button')[0]
      deleteTag(tagId,baseUrl)
    }
  })
}
const addTagProposalButtons = (resultDiv) => {
  resultDiv.addEventListener('click',(event) => {
    const targetAccept = event.target.closest('.accept-button')
    if(targetAccept) {
      event.preventDefault()
      const tagProposalId = targetAccept.id.split('-accept-button')[0]
      acceptTagProposal(tagProposalId,baseUrl)
    }
    const targetDelete = event.target.closest('.delete-button')
    if(targetDelete) {
      event.preventDefault()
      const tagProposalId = targetDelete.id.split('-delete-button')[0]
      deleteTagProposal(tagProposalId,baseUrl)
    }
  })
}
const addUnblockAppealButtons = (resultDiv) => {
  resultDiv.addEventListener('click',(event) => {
    const targetAccept = event.target.closest('.accept-button')
    if(targetAccept) {
      event.preventDefault()
      const unblockAppealId = targetAccept.id.split('-accept-button')[0]
      acceptUnblockAppeal(unblockAppealId,baseUrl)
    }
    const targetDelete = event.target.closest('.delete-button')
    if(targetDelete) {
      event.preventDefault()
      const unblockAppealId = targetDelete.id.split('-delete-button')[0]
      deleteUnblockAppeal(unblockAppealId,baseUrl)
    }
  })
}

// Global Variables
let lastPage      = 0;
let loading       = false;
let page          = 1;
const loadingIcon = document.getElementById('loading-icon');
const searchBar   = document.getElementById('admin-search-bar');
const baseUrl     = searchBar ? searchBar.dataset.url : ''

// Auxiliary Functions
const build = (url, buildCardFunction, resultDiv) => {
  if (loading) return;
  loading = true;
  if (loadingIcon) loadingIcon.classList.remove('hidden');
  sendAjaxRequest(
    url,
    (data) => {
      console.log(data)
      loading = false;
      if (loadingIcon) loadingIcon.classList.add('hidden');
      lastPage = data.last_page;
      data.data.forEach((element) => {
        resultDiv.innerHTML += buildCardFunction(element);
      })
    },
    'GET'
  )
}
const addInfinitePageBehaviour = (baseQuery,buildFunction,resultDiv) => {
  window.onload = async () => {
    resultDiv.innerHTML = '';
    page = 1;
    build(
      baseQuery, 
      buildFunction, 
      resultDiv
    );
  };

  const loadMoreData = async (page) => {
    build(
      baseQuery+`${searchBar.value}?page=${page}`, 
      buildFunction , 
      resultDiv
    );
  };

  if (searchBar) {
    searchBar.onkeyup = async () => {
      resultDiv.innerHTML = '';
      page = 1;
      build(
        baseQuery+searchBar.value,
        buildFunction,
        resultDiv
      );
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

// Result Divs
const usersDiv          = document.getElementById('admin-search-users-results')
const tagsDiv           = document.getElementById('admin-search-tags-results')
const tagProposalsDiv   = document.getElementById('admin-search-tag-proposals-results')
const unblockAppealsDiv = document.getElementById('admin-search-unblock-appeals-results')

// Build Cards
if(usersDiv) {
  console.log(usersDiv)
  const baseQuery = baseUrl+'/api/search/users/'
  addInfinitePageBehaviour(baseQuery,buildUserCard,usersDiv)
  addUserButtons(usersDiv)
}
if(tagsDiv) {
  console.log(tagsDiv)
  const baseQuery = baseUrl+'/api/search/tags/'
  addInfinitePageBehaviour(baseQuery,buildTagCard,tagsDiv)
  addTagButtons(tagsDiv)
}
if(tagProposalsDiv) {
  console.log(tagProposalsDiv)
  const baseQuery = baseUrl+'/api/search/tag_proposals/'
  addInfinitePageBehaviour(baseQuery,buildTagProposalCard,tagProposalsDiv)
  addTagProposalButtons(tagProposalsDiv)
}
if(unblockAppealsDiv) {
  console.log(unblockAppealsDiv)
  const baseQuery = baseUrl+'/api/search/unblock_appeals/'
  addInfinitePageBehaviour(baseQuery,buildUnblockAppealCard,unblockAppealsDiv)
  addUnblockAppealButtons(unblockAppealsDiv)
}