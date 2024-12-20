import { data } from 'autoprefixer';
import { redirectToLogin, showMessage, toggleDeleteButton, sendAjaxRequest } from './utils';

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

export function addVoteButtonBehaviour() {
  const voteContainers = document.querySelectorAll('.vote-container');

  voteContainers.forEach((container) => {
    const authenticated = container.dataset.authenticated === 'true';
    const upvoteButton = container.querySelector('.upvote-button');
    const downvoteButton = container.querySelector('.downvote-button');

    if (!authenticated) {
      upvoteButton.addEventListener('click', redirectToLogin);
      downvoteButton.addEventListener('click', redirectToLogin);
    } else {
      upvoteButton.addEventListener('click', () => handleVote(container, true));
      downvoteButton.addEventListener('click', () => handleVote(container, false));
    }
  });
}

function handleVote(container, isUpvote) {
  const type = container.dataset.type;
  const itemId = container.dataset.id;
  let voteId = container.dataset.voteId;
  const currentVote = container.dataset.vote;
  const upvoteButton = container.querySelector('.upvote-button');
  const downvoteButton = container.querySelector('.downvote-button');

  if (voteId) {
    if ((isUpvote && currentVote === 'upvote') || (!isUpvote && currentVote === 'downvote')) {
      updateVoteUI(container, null, 'Vote removed');
      container.dataset.voteId = '';
      const oldVote = container.dataset.vote == 'upvote';
      container.dataset.vote = '';
      removeVote(voteId, container, oldVote);
    } else {
      container.dataset.vote = isUpvote ? 'upvote' : 'downvote';
      updateVoteUI(container, isUpvote, 'Vote updated');
      updateVote(voteId, isUpvote, container);
    }
  } else {
    upvoteButton.disabled = true;
    downvoteButton.disabled = true;
    updateVoteUI(container, isUpvote, 'Saved');
    submitVote(type, itemId, isUpvote, container, () => {
      upvoteButton.disabled = false;
      downvoteButton.disabled = false;
    });
  }
  toggleDeleteButton();
}

function submitVote(type, id, isUpvote, container, onComplete) {
  const body = JSON.stringify({
    type: type,
    id: id,
    is_upvote: isUpvote,
  });
  sendAjaxRequest(
    '/vote',
    (data) => {
      if (data.success) {
        container.dataset.voteId = data.vote_id;
        container.dataset.vote = isUpvote ? 'upvote' : 'downvote';
      }
      if (onComplete) onComplete();
    },
    'POST',
    {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
    },
    body,
    () => {
      updateVoteUI(container, isUpvote, 'Vote removed');
      showMessage('An error occurred. Please try again.', false);
    }
  );
}

function removeVote(voteId, container, oldVote) {
  sendAjaxRequest(
    `/vote/${voteId}`,
    (_data) => {},
    'DELETE',
    {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
    },
    undefined,
    () => {
      updateVoteUI(container, oldVote, 'Saved');
      showMessage('An error occurred. Please try again.', false);
    }
  );
}

function updateVote(voteId, isUpvote, container) {
  const body = JSON.stringify({
    is_upvote: isUpvote,
  });

  sendAjaxRequest(
    `/vote/${voteId}`,
    (_data) => {},
    'PUT',
    {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
    },
    body,
    () => {
      updateVoteUI(container, !isUpvote, 'Vote updated');
      showMessage('An error occurred. Please try again.', false);
    }
  );
}

// function sendVoteAjaxRequest(url, handler, method, body = undefined) {
//   const headers = {
//     'Content-Type': 'application/json',
//     'X-CSRF-TOKEN': csrfToken,
//   };

//   fetch(url, {
//     method: method,
//     headers: headers,
//     body: body,
//   })
//     .then((response) => {
//       if (response.ok) {
//         return response.json();
//       }
//     })
//     .then((data) => {
//       handler(data);
//     })
//     .catch((error) => {
//       console.log('Error', error);
//     });
// }

function updateVoteUI(container, isUpvote, message) {
  const postId = container.dataset.id;
  const type = container.dataset.type;

  const upvoteOutline = document.getElementById(`${type}-upvote-outline-${postId}`);
  const upvoteFill = document.getElementById(`${type}-upvote-fill-${postId}`);
  const downvoteOutline = document.getElementById(`${type}-downvote-outline-${postId}`);
  const downvoteFill = document.getElementById(`${type}-downvote-fill-${postId}`);
  const voteCountElement = container.querySelector('.vote-count');
  let currentCount = parseInt(voteCountElement.textContent);

  // Reset icons
  upvoteOutline.classList.remove('hidden');
  upvoteFill.classList.add('hidden');
  downvoteOutline.classList.remove('hidden');
  downvoteFill.classList.add('hidden');

  isUpvote = isUpvote ?? container.dataset.vote === 'upvote';
  const changeCount = message == 'Vote updated' ? 2 : 1;

  switch (message) {
    case 'Saved':
    case 'Vote updated':
      if (isUpvote) {
        upvoteOutline.classList.add('hidden');
        upvoteFill.classList.remove('hidden');
        voteCountElement.textContent = currentCount + changeCount;
      } else {
        downvoteOutline.classList.add('hidden');
        downvoteFill.classList.remove('hidden');
        voteCountElement.textContent = currentCount - changeCount;
      }
      break;

    case 'Vote removed':
      if (isUpvote) {
        voteCountElement.textContent = currentCount - changeCount;
      } else {
        voteCountElement.textContent = currentCount + changeCount;
      }

    default:
      break;
  }
}
