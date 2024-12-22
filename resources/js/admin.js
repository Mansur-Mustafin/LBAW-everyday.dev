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
  ); // TODO: tem data?
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
const deleteReport = async (reportId, baseUrl) => {
  sendAjaxRequest(
    `${baseUrl}/admin/reports/delete/${reportId}`,
    (data) => {
      console.log(data);
    },
    'DELETE'
  );
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
      console.log(data);
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
                  user.status != 'blocked' ? '' : 'hidden'
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

const buildReportCard = (report) => {
  const typeColors = {
    PostReport: 'bg-blue-200',
    CommentReport: 'bg-green-200',
    UserReport: 'bg-red-200',
  };
  const reportTypeColor = typeColors[report.report_type] || 'bg-gray-200';

  const actionButtons = () => {
    switch (report.report_type) {
      case 'PostReport':
        return `
          <button class="px-2 py-1 text-gray-700 bg-gray-200 rounded-lg hover:bg-red-400">
            Omit Post
          </button>
          <a href="" id="${report.id}-delete-button" class="delete-button place-content-center m-3" data-baseurl="${baseUrl}">  
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x hover:stroke-red-400">
              <path d="M18 6 6 18"/>
              <path d="m6 6 12 12"/>
            </svg>
          </a> 
        `;
      case 'CommentReport':
        return `
          <button class="px-2 py-1 text-gray-700 bg-gray-200 rounded-lg hover:bg-red-400">
            Omit Comment
          </button>
          <a href="" id="${report.id}-delete-button" class="delete-button place-content-center m-3" data-baseurl="${baseUrl}">  
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x hover:stroke-red-400">
              <path d="M18 6 6 18"/>
              <path d="m6 6 12 12"/>
            </svg>
          </a> 
        `;
      case 'UserReport':
        return `
          ${
            report.reported_status === 'blocked'
              ? `
            <div class="px-2 py-1 text-gray-700 bg-gray-200 rounded-lg border-2 border-yellow-400 text-center">
              User is blocked
            </div>
            <a href="" id="${report.id}-${report.reported_user_id}-deleteUser-button" class="deleteUser-button px-2 py-1 text-gray-700 bg-gray-200 rounded-lg hover:bg-red-400" data-baseurl="${baseUrl}">
              Delete User
            </a>
          `
              : `
            <a href="" id="${report.id}-${report.reported_user_id}-block-button" class="block-button px-2 py-1 text-gray-700 bg-gray-200 rounded-lg hover:bg-yellow-400" data-baseurl="${baseUrl}">
              Block User
            </a>
            <a href="" id="${report.id}-${report.reported_user_id}-deleteUser-button" class="deleteUser-button px-2 py-1 text-gray-700 bg-gray-200 rounded-lg hover:bg-red-400" data-baseurl="${baseUrl}">
              Delete User
            </a>
          `
          }
          <a href="" id="${
            report.id
          }-delete-button" class="delete-button place-content-center m-3" data-baseurl="${baseUrl}">  
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x hover:stroke-red-400">
              <path d="M18 6 6 18"/>
              <path d="m6 6 12 12"/>
            </svg>
          </a> 
        `;
      default:
        return `
          <a href="" id="${report.id}-delete-button" class="delete-button place-content-center m-3" data-baseurl="${baseUrl}">  
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-x hover:stroke-red-400">
              <path d="M18 6 6 18"/>
              <path d="m6 6 12 12"/>
            </svg>
          </a> 
        `;
    }
  };

  return `
      <div id="${report.id}-card" class="flex p-2 border rounded border-gray-700 bg-input">
        <div class="flex flex-col flex-grow">
          <h1 class="text-xl">
            ${new Date(report.created_at).toLocaleDateString()}
          </h1>
        
          <p class="text-sm mb-3">
            ${report.description}
          </p>

          <div class="text-xs text-gray-600 flex flex-wrap gap-2">
            <span class="${reportTypeColor} px-2 py-1 rounded-lg">Type: ${report.report_type}</span>
            <span class="bg-gray-200 px-2 py-1 rounded-lg">Reporter: ${
              report.reporter_username
            }</span>
            ${
              report.news_post_id
                ? `<span class="bg-gray-200 px-2 py-1 rounded-lg">Post ID: ${report.news_post_id}</span>`
                : ''
            }
            ${
              report.comment_id
                ? `<span class="bg-gray-200 px-2 py-1 rounded-lg">Comment ID: ${report.comment_id}</span>`
                : ''
            }
            ${
              report.reported_user_id
                ? `<span class="bg-gray-200 px-2 py-1 rounded-lg">User ID: ${report.reported_user_id}</span>`
                : ''
            }
          </div>
        </div>
        
        <div class="flex items-center gap-2">
          ${actionButtons()}
        </div>
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
        <p class="max-w-52 truncate text-sm">${omittedComment.content}</p>
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
          console.log('deleted user:' + userId);
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
        if (tagproposalcard.classList.contains('hidden')) {
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
        if (tagproposalcard.classList.contains('hidden')) {
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
    console.log(targetUnomit);
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
      //reloadData(baseQuery,buildFunction,resultDiv)
    }
  });
};

const addUnomitCommentButtons = (baseQuery, buildFunction, resultDiv) => {
  resultDiv.addEventListener('click', (event) => {
    const targetUnomit = event.target.closest('.unomit-comment-button');
    console.log(targetUnomit);
    if (targetUnomit) {
      event.preventDefault();
      const unomitCommentId = targetUnomit.id.split('-unomit-comment-button')[0];
      unOmitComment(unomitCommentId, baseUrl);
      const omittedCommentCard = document.getElementById(unomitCommentId + '-card');
      omittedCommentCard.classList.add('hidden');
      //reloadData(baseQuery,buildFunction,resultDiv)
    }
  });
};
const addReportButtons = (baseQuery, buildFunction, resultDiv) => {
  resultDiv.addEventListener('click', (event) => {
    const targetDelete = event.target.closest('.delete-button');
    if (targetDelete) {
      event.preventDefault();
      const reportId = targetDelete.id.split('-delete-button')[0];
      deleteReport(reportId, baseUrl);
      reloadData(baseQuery, buildFunction, resultDiv);
    }
    const targetBlock = event.target.closest('.block-button');
    if (targetBlock) {
      event.preventDefault();
      const [reportId, userId] = targetBlock.id.split('-block-button')[0].split('-');
      blockUser(userId, baseUrl);
      deleteReport(reportId, baseUrl);
      reloadData(baseQuery, buildFunction, resultDiv);
    }
    const targetDeleteUser = event.target.closest('.deleteUser-button');
    if (targetDeleteUser) {
      event.preventDefault();
      const [reportId, userId] = targetDeleteUser.id.split('-deleteUser-button')[0].split('-');
      deleteUser(userId, baseUrl);
      deleteReport(reportId, baseUrl);
      reloadData(baseQuery, buildFunction, resultDiv);
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
const reportsDiv = document.getElementById('admin-search-reports-results');
const omittedPostsDiv = document.getElementById('admin-search-omitted-posts-results');
const omittedCommentsDiv = document.getElementById('admin-search-omitted-comments-results');

const reloadData = (baseQuery, buildFunction, resultDiv) => {
  resultDiv.innerHTML = '';
  page = 1;
  build(baseQuery, buildFunction, resultDiv);
};

// Build Cards
if (usersDiv) {
  console.log(usersDiv);
  const baseQuery = baseUrl + '/api/search/users/';
  addInfinitePageBehaviour(baseQuery, buildUserCard, usersDiv);
  addUserButtons(baseQuery, buildUserCard, usersDiv);
}
if (tagsDiv) {
  console.log(tagsDiv);
  const baseQuery = baseUrl + '/api/search/tags/';
  addInfinitePageBehaviour(baseQuery, buildTagCard, tagsDiv);
  addTagButtons(baseQuery, buildTagCard, tagsDiv);
}
if (tagProposalsDiv) {
  console.log(tagProposalsDiv);
  const baseQuery = baseUrl + '/api/search/tag_proposals/';
  addInfinitePageBehaviour(baseQuery, buildTagProposalCard, tagProposalsDiv);
  addTagProposalButtons(baseQuery, buildTagProposalCard, tagProposalsDiv);
}

if (unblockAppealsDiv) {
  console.log(unblockAppealsDiv);
  const baseQuery = baseUrl + '/api/search/unblock_appeals/';
  addInfinitePageBehaviour(baseQuery, buildUnblockAppealCard, unblockAppealsDiv);
  addUnblockAppealButtons(baseQuery, buildUnblockAppealCard, unblockAppealsDiv);
}
if (reportsDiv) {
  console.log(reportsDiv);
  const baseQuery = baseUrl + '/api/search/reports/';
  addInfinitePageBehaviour(baseQuery, buildReportCard, reportsDiv);
  addReportButtons(baseQuery, buildReportCard, reportsDiv);
}

if (omittedPostsDiv) {
  console.log(omittedPostsDiv);
  const baseQuery = baseUrl + '/api/search/omitted_posts/';
  addInfinitePageBehaviour(baseQuery, buildOmittedPost, omittedPostsDiv);
  addUnomitPostButtons(baseQuery, buildOmittedPost, omittedPostsDiv);
}

if (omittedCommentsDiv) {
  console.log(omittedCommentsDiv);
  const baseQuery = baseUrl + '/api/search/omitted_comments/';
  addInfinitePageBehaviour(baseQuery, buildOmittedComment, omittedCommentsDiv);
  addUnomitCommentButtons(baseQuery, buildOmittedComment, omittedCommentsDiv);
}
