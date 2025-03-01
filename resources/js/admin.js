import { sendAjaxRequest, showMessage, stripHtml, handleDialog } from './utils';

// API Requests
const deleteTag = async (tagId, baseUrl) => {
  sendAjaxRequest(`${baseUrl}/admin/tags/delete/${tagId}`, (data) => {}, 'DELETE');
};
const deleteTagProposal = async (tagProposalId, baseUrl) => {
  sendAjaxRequest(
    `${baseUrl}/admin/tag_proposals/delete/${tagProposalId}`,
    (_data) => {},
    'DELETE'
  );
};
const acceptTagProposal = async (tagProposalId, baseUrl) => {
  sendAjaxRequest(`${baseUrl}/admin/tag_proposals/accept/${tagProposalId}`, (_data) => {}, 'PUT');
};
const acceptUnblockAppeal = async (unblockAppealId, baseUrl) => {
  sendAjaxRequest(
    `${baseUrl}/admin/unblock_appeals/accept/${unblockAppealId}`,
    (_data) => {},
    'PUT'
  );
};
const deleteUnblockAppeal = async (unblockAppealId, baseUrl) => {
  sendAjaxRequest(
    `${baseUrl}/admin/unblock_appeals/delete/${unblockAppealId}`,
    (_data) => {},
    'DELETE'
  );
};
const blockUser = async (userId, baseUrl) => {
  const url = `${baseUrl}/admin/users/${userId}/block`;
  sendAjaxRequest(url, (_data) => {}, 'PUT');
};
const unblockUser = async (userId, baseUrl) => {
  const url = `${baseUrl}/admin/users/${userId}/unblock`;
  sendAjaxRequest(url, (_data) => {}, 'PUT');
};

const unOmitPost = async (postId, baseUrl) => {
  const url = `${baseUrl}/news/${postId}/unomit`;
  sendAjaxRequest(url, (_data) => {}, 'PUT');
};

const unOmitComment = async (commentId, baseUrl) => {
  const url = `${baseUrl}/comments/${commentId}/unomit`;
  sendAjaxRequest(url, (_data) => {}, 'POST');
};

const deleteUser = async (userId, baseUrl) => {
  const url = `${baseUrl}/users/${userId}/anonymize`;
  sendAjaxRequest(
    url,
    (data) => {
      showMessage(data.message);
    },
    'PUT'
  );
};

// Card Builder Functions
const buildUserCard = (user) => {
  const adminBadge = (status) => `
    <p id=${user.id}-admin-badge class=" text-white bg-purple rounded-xl px-2 text-sm  ${
    status == 'admin' ? '' : 'hidden'
  }">Admin</p> 
  `;
  const blockedBadge = (status) => `
    <p id=${user.id}-blocked-badge class=" text-white bg-purple rounded-xl px-2 text-sm  ${
    status == 'blocked' ? '' : 'hidden'
  }">Blocked</p> 
  `;
  const pendingBadge = (status) => `
    <p id=${user.id}-pending-badge class=" text-white bg-purple rounded-xl px-2 text-sm ${
    status == 'pending' ? '' : 'hidden'
  }">Pending</p> 
  `;
  const pageUrl = `${baseUrl}/users/${user.id}/posts`;
  const editProfileUrl = `${baseUrl}/admin/users/${user.id}/edit`;
  return `
    <div class="flex flex-col p-3 rounded-lg bg-input" id="${user.id}-card">
      <div class="flex justify-between">
        <div class="flex-grow">
          <a href="${pageUrl}" class="text-lg flex place items-center gap-3">
            <span class="max-w-32 tablet:max-w-60 truncate">${user.public_name}</span>
            
            ${adminBadge(user.is_admin ? 'admin' : '')}
            ${blockedBadge(user.status)}
            ${pendingBadge(user.status)}
          </a>
          <div class="flex gap-1 text-sm">
            <h3 class="text-gray-400">@${user.username} · </h3>
            <h3 class="text-gray-400 tablet:max-w-full max-w-24 truncate">${user.email}</h3>
          </div>
         
        </div>
        <div class="flex">
          ${
            !user.is_admin
              ? `
                  <a title="block" id="${
                    user.id
                  }-block-button" data-url="${baseUrl}" class="block-button flex flex-col p-2 justify-center ${
                  user.status != 'blocked' && user.status != 'pending' ? '' : 'hidden'
                }" href="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban">
                      <circle cx="12" cy="12" r="10"/>
                      <path d="m4.9 4.9 14.2 14.2"/>
                    </svg>
                  </a>
                  <a title="unblock" id="${
                    user.id
                  }-unblock-button" data-url="${baseUrl}" class="unblock-button flex flex-col p-2 justify-center ${
                  user.status != 'blocked' ? 'hidden' : ''
                }" href="">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-circle-dashed">
                      <path d="M10.1 2.182a10 10 0 0 1 3.8 0"/>
                      <path d="M13.9 21.818a10 10 0 0 1-3.8 0"/>
                      <path d="M17.609 3.721a10 10 0 0 1 2.69 2.7"/>
                      <path d="M2.182 13.9a10 10 0 0 1 0-3.8"/>
                      <path d="M20.279 17.609a10 10 0 0 1-2.7 2.69"/>
                      <path d="M21.818 10.1a10 10 0 0 1 0 3.8"/>
                      <path d="M3.721 6.391a10 10 0 0 1 2.7-2.69"/>
                      <path d="M6.391 20.279a10 10 0 0 1-2.69-2.7"/>
                    </svg>
                  </a >
                `
              : ''
          }
          <a title="edit" class="flex flex-col p-2 justify-center" href="${editProfileUrl}">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-pencil"><path d="M21.174 6.812a1 1 0 0 0-3.986-3.987L3.842 16.174a2 2 0 0 0-.5.83l-1.321 4.352a.5.5 0 0 0 .623.622l4.353-1.32a2 2 0 0 0 .83-.497z"/><path d="m15 5 4 4"/></svg>
          </a>

          <a title="delete" id="${
            user.id
          }-delete-button" data-url="${baseUrl}" class="delete-button flex flex-col p-2 justify-center" href="">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash hover:stroke-red-600">
              <polyline points="3 6 5 6 21 6"/>
              <path d="M19 6l-1.34 14.22A2 2 0 0 1 15.67 22H8.33a2 2 0 0 1-1.99-1.78L5 6m5 0V4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v2m-7 0h8"/>
            </svg>
          </a>
        </div>
      </div>
    </div>
  `;
};
const buildTagCard = (tag) => {
  return `
      <div id="${tag.id}-card" class="p-3 rounded-xl bg-input">
          <div class="flex justify-between items-center">
            <p class="text-lg">${tag.name}</p>
            <a title="delete" href="" id="${tag.id}-delete-button" class="delete-button place-content-center m-3" data-baseurl="${baseUrl}">  
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x hover:stroke-red-600">
                <path d="M18 6 6 18"/>
                <path d="m6 6 12 12"/>
              </svg>
            </a>  
          </div>
      </div>
  `;
};
const buildTagProposalCard = (tagProposal) => {
  return `
      <div id="${tagProposal.id}-card" class="flex p-3 rounded-xl bg-input">
        <div class="flex-grow">
          <p class="text-lg">${tagProposal.name}</p>
          <p class="text-sm truncate max-w-32 tablet:max-w-60">${tagProposal.description}</p>
          <p class="text-gray-400 text-sm">from ${tagProposal.proposer.public_name} ·
          <span class="">@${tagProposal.proposer.username}</span>
          </p>
        </div>
        <div class="flex">
          <a title="approve" href="" id="${tagProposal.id}-accept-button" class="accept-button text-xl place-content-center m-3" data-baseurl="${baseUrl}">  
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check hover:stroke-green-600">
              <path d="M20 6 9 17l-5-5"/>
            </svg>
          </a>  
          <a title="deny" href="" id="${tagProposal.id}-delete-button" class="delete-button place-content-center m-3" data-baseurl="${baseUrl}">  
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x hover:stroke-red-600">
            <path d="M18 6 6 18"/>
              <path d="m6 6 12 12"/>
            </svg>
          </a>  
        </div>
      </div>
      `;
};
const buildUnblockAppealCard = (unblockAppeal) => {
  const pageUrl = `${baseUrl}/users/${unblockAppeal.user_id}/posts`;
  return `
      <div id="${unblockAppeal.id}-card" class="flex p-3 rounded-lg bg-input">
        <div class="flex flex-col flex-grow ">
          <a href="${pageUrl}" class="text-lg">
            ${unblockAppeal.public_name}
          </a>
          <a class="text-gray-400 text-sm">
            @${unblockAppeal.username}
          </a>
          <p class="text-sm mt-1">${unblockAppeal.description}</p>
        </div>
        ${
          !unblockAppeal.is_resolved
            ? `
            <a title="approve" href="" id="${unblockAppeal.id}-accept-button" class="accept-button text-xl place-content-center m-3" data-baseurl="${baseUrl}">  
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-check hover:stroke-green-600">
                <path d="M20 6 9 17l-5-5"/>
              </svg>
            </a>  
            <a title="deny" href="" id="${unblockAppeal.id}-delete-button" class="delete-button place-content-center m-3 " data-baseurl="${baseUrl}">  
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x hover:stroke-red-600">
                <path d="M18 6 6 18"/>
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
};

const buildOmittedPost = (omittedPost) => {
  const pageUrl = `${baseUrl}/news/${omittedPost.id}`;
  return `
    <div id="${omittedPost.id}-card" class="flex p-3 rounded-lg bg-input">
      <a href="${pageUrl}" class="flex flex-col flex-grow w-full">
        <span class="text-lg truncate max-w-52 tablet:max-w-full">${stripHtml(
          omittedPost.title
        )}</span>
        <div class="text-gray-400 text-sm">
          By ${omittedPost.author.public_name} · @${omittedPost.author.username}
        </div>
      </a>
      <a title="unomit" href="" class="unomit-post-button place-content-center m-3" id="${
        omittedPost.id
      }-unomit-post-button ">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="lucide lucide-eye">
              <path
                  d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
              <circle cx="12" cy="12" r="3" />
          </svg>
      </a>
    </div>
  `;
};

const buildOmittedComment = (omittedComment) => {
  return `
    <div id="${omittedComment.id}-card" class="flex p-3 rounded-lg bg-input">
      <div class="flex flex-col flex-grow w-full">
      <span class="flex items-center gap-1">
        ${omittedComment.public_name}
        <div class="text-gray-400 text-sm">
          · @${omittedComment.username}
        </div>
      </span>
        <p class="max-w-52 tablet:max-w-full tablet:break-all text-ellipsis overflow-hidden text-sm">${omittedComment.content}</p>
      </div>
      <a title="unomit" href="" class="unomit-comment-button place-content-center m-3" id="${omittedComment.id}-unomit-comment-button ">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
              fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round" class="lucide lucide-eye">
              <path
                  d="M2.062 12.348a1 1 0 0 1 0-.696 10.75 10.75 0 0 1 19.876 0 1 1 0 0 1 0 .696 10.75 10.75 0 0 1-19.876 0" />
              <circle cx="12" cy="12" r="3" />
          </svg>
      </a>
    </div>
  `;
};

// Card Button Behaviours
const addUserButtons = (baseQuery, buildFunction, resultDiv) => {
  resultDiv.addEventListener('click', (event) => {
    const targetBlock = event.target.closest('.block-button');
    const targetUnblock = event.target.closest('.unblock-button');

    if (targetBlock) {
      event.preventDefault();
      const userId = targetBlock.id.split('-block-button')[0];
      const blockedBadge = document.getElementById(userId + '-blocked-badge');
      const pendingBadge = document.getElementById(userId + '-pending-badge');
      const actionBlock = () => {
        pendingBadge.classList.add('hidden');
        blockedBadge.classList.remove('hidden');
        const unblockButton = document.getElementById(userId + '-unblock-button');
        blockUser(userId, baseUrl);
        targetBlock.classList.add('hidden');
        unblockButton.classList.remove('hidden');
      };
      actionBlock();
    }
    if (targetUnblock) {
      event.preventDefault();
      const userId = targetUnblock.id.split('-unblock-button')[0];
      const blockedBadge = document.getElementById(userId + '-blocked-badge');
      const actionUnblock = () => {
        blockedBadge.classList.add('hidden');
        const blockButton = document.getElementById(userId + '-block-button');
        unblockUser(userId, baseUrl);
        blockButton.classList.remove('hidden');
        targetUnblock.classList.add('hidden');
      };
      actionUnblock();
    }
    const targetDelete = event.target.closest('.delete-button');
    if (targetDelete) {
      event.preventDefault();
      const userId = targetDelete.id.split('-delete-button')[0];
      const actionDelete = () => {
        const userCard = document.getElementById(userId + '-card');
        if (!userCard.classList.contains('hidden')) {
          deleteUser(userId, baseUrl);
          userCard.classList.add('hidden');
        }
      };
      handleDialog(actionDelete, baseUrl, userId);
    }
  });
};
const addTagButtons = (baseQuery, buildFunction, resultDiv) => {
  resultDiv.addEventListener('click', (event) => {
    const targetDelete = event.target.closest('.delete-button');
    if (targetDelete) {
      event.preventDefault();
      const tagId = targetDelete.id.split('-delete-button')[0];
      const actionDeleteTag = () => {
        const tagCard = document.getElementById(tagId + '-card');
        if (!tagCard.classList.contains('hidden')) {
          deleteTag(tagId, baseUrl);
          tagCard.classList.add('hidden');
        }
      };
      handleDialog(actionDeleteTag, baseUrl, tagId);
    }
  });
};
const addTagProposalButtons = (baseQuery, buildFunction, resultDiv) => {
  resultDiv.addEventListener('click', (event) => {
    const targetAccept = event.target.closest('.accept-button');
    if (targetAccept) {
      event.preventDefault();
      const tagProposalId = targetAccept.id.split('-accept-button')[0];
      const actionAcceptTagProposal = () => {
        const tagproposalcard = document.getElementById(tagProposalId + '-card');
        if (!tagproposalcard.classList.contains('hidden')) {
          acceptTagProposal(tagProposalId, baseUrl);
          tagproposalcard.classList.add('hidden');
        }
      };
      handleDialog(actionAcceptTagProposal, baseUrl, tagProposalId);
    }
    const targetDelete = event.target.closest('.delete-button');
    if (targetDelete) {
      event.preventDefault();
      const tagProposalId = targetDelete.id.split('-delete-button')[0];
      const actionDeleteTagProposal = () => {
        const tagproposalcard = document.getElementById(tagProposalId + '-card');
        if (!tagproposalcard.classList.contains('hidden')) {
          deleteTagProposal(tagProposalId, baseUrl);
          tagproposalcard.classList.add('hidden');
        }
      };
      handleDialog(actionDeleteTagProposal, baseUrl, tagProposalId);
    }
  });
};
const addUnblockAppealButtons = (baseQuery, buildFunction, resultDiv) => {
  resultDiv.addEventListener('click', (event) => {
    const targetAccept = event.target.closest('.accept-button');
    if (targetAccept) {
      event.preventDefault();
      const unblockAppealId = targetAccept.id.split('-accept-button')[0];
      const actionAcceptUnblockAppeal = () => {
        const unblockAppealCard = document.getElementById(unblockAppealId + '-card');
        if (!unblockAppealCard.classList.contains('hidden')) {
          acceptUnblockAppeal(unblockAppealId, baseUrl);
          unblockAppealCard.classList.add('hidden');
        }
      };
      handleDialog(actionAcceptUnblockAppeal, baseUrl, unblockAppealId);
    }
    const targetDelete = event.target.closest('.delete-button');
    if (targetDelete) {
      event.preventDefault();
      const unblockAppealId = targetDelete.id.split('-delete-button')[0];
      const actionDeleteUnblockAppeal = () => {
        const tagproposalcard = document.getElementById(unblockAppealId + '-card');
        if (!tagproposalcard.classList.contains('hidden')) {
          deleteUnblockAppeal(unblockAppealId, baseUrl);
          tagproposalcard.classList.add('hidden');
        }
      };
      handleDialog(actionDeleteUnblockAppeal, baseUrl, unblockAppealId);
    }
  });
};

const addUnomitPostButtons = (baseQuery, buildFunction, resultDiv) => {
  resultDiv.addEventListener('click', (event) => {
    const targetUnomit = event.target.closest('.unomit-post-button');
    if (targetUnomit) {
      event.preventDefault();
      const unomitPostId = targetUnomit.id.split('-unomit-post-button')[0];
      const actionUnomitPost = () => {
        const omittedPostCard = document.getElementById(unomitPostId + '-card');
        if (!omittedPostCard.classList.contains('hidden')) {
          unOmitPost(unomitPostId, baseUrl);
          omittedPostCard.classList.add('hidden');
        }
      };
      handleDialog(actionUnomitPost, baseUrl, unomitPostId);
    }
  });
};

const addUnomitCommentButtons = (baseQuery, buildFunction, resultDiv) => {
  resultDiv.addEventListener('click', (event) => {
    const targetUnomit = event.target.closest('.unomit-comment-button');
    if (targetUnomit) {
      event.preventDefault();
      const unomitCommentId = targetUnomit.id.split('-unomit-comment-button')[0];
      const actionUnomitComment = () => {
        const omittedCommentCard = document.getElementById(unomitCommentId + '-card');
        if (!omittedCommentCard.classList.contains('hidden')) {
          unOmitComment(unomitCommentId, baseUrl);
          omittedCommentCard.classList.add('hidden');
        }
      };
      handleDialog(actionUnomitComment, baseUrl, unomitCommentId);
    }
  });
};

// Global Variables
let lastPage = 0;
let loading = false;
let page = 1;
const loadingIcon = document.getElementById('loading-icon');
const searchBar = document.getElementById('admin-search-bar');
const baseUrl = searchBar ? searchBar.dataset.url : '';

// Auxiliary Functions
const build = (url, buildCardFunction, resultDiv) => {
  if (loading) return;
  loading = true;
  if (loadingIcon) loadingIcon.classList.remove('hidden');
  sendAjaxRequest(
    url,
    (data) => {
      loading = false;
      if (loadingIcon) loadingIcon.classList.add('hidden');
      lastPage = data.last_page;
      data.data.forEach((element) => {
        resultDiv.innerHTML += buildCardFunction(element);
      });
    },
    'GET'
  );
};
const addInfinitePageBehaviour = (baseQuery, buildFunction, resultDiv) => {
  window.onload = async () => {
    resultDiv.innerHTML = '';
    page = 1;
    build(baseQuery, buildFunction, resultDiv);
  };

  const loadMoreData = async (page) => {
    build(baseQuery + `${searchBar.value}?page=${page}`, buildFunction, resultDiv);
  };

  if (searchBar) {
    searchBar.onkeyup = async () => {
      resultDiv.innerHTML = '';
      page = 1;
      build(baseQuery + searchBar.value, buildFunction, resultDiv);
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
};

// Result Divs
const usersDiv = document.getElementById('admin-search-users-results');
const tagsDiv = document.getElementById('admin-search-tags-results');
const tagProposalsDiv = document.getElementById('admin-search-tag-proposals-results');
const unblockAppealsDiv = document.getElementById('admin-search-unblock-appeals-results');
const omittedPostsDiv = document.getElementById('admin-search-omitted-posts-results');
const omittedCommentsDiv = document.getElementById('admin-search-omitted-comments-results');

// Build Cards
if (usersDiv) {
  const baseQuery = baseUrl + '/api/search/users/';
  addInfinitePageBehaviour(baseQuery, buildUserCard, usersDiv);
  addUserButtons(baseQuery, buildUserCard, usersDiv);
}
if (tagsDiv) {
  const baseQuery = baseUrl + '/api/search/tags/';
  addInfinitePageBehaviour(baseQuery, buildTagCard, tagsDiv);
  addTagButtons(baseQuery, buildTagCard, tagsDiv);
}
if (tagProposalsDiv) {
  const baseQuery = baseUrl + '/api/search/tag_proposals/';
  addInfinitePageBehaviour(baseQuery, buildTagProposalCard, tagProposalsDiv);
  addTagProposalButtons(baseQuery, buildTagProposalCard, tagProposalsDiv);
}

if (unblockAppealsDiv) {
  const baseQuery = baseUrl + '/api/search/unblock_appeals/';
  addInfinitePageBehaviour(baseQuery, buildUnblockAppealCard, unblockAppealsDiv);
  addUnblockAppealButtons(baseQuery, buildUnblockAppealCard, unblockAppealsDiv);
}

if (omittedPostsDiv) {
  const baseQuery = baseUrl + '/api/search/omitted_posts/';
  addInfinitePageBehaviour(baseQuery, buildOmittedPost, omittedPostsDiv);
  addUnomitPostButtons(baseQuery, buildOmittedPost, omittedPostsDiv);
}

if (omittedCommentsDiv) {
  const baseQuery = baseUrl + '/api/search/omitted_comments/';
  addInfinitePageBehaviour(baseQuery, buildOmittedComment, omittedCommentsDiv);
  addUnomitCommentButtons(baseQuery, buildOmittedComment, omittedCommentsDiv);
}
