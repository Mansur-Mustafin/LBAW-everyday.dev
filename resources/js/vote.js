import { redirectToLogin, sendAjaxRequest } from './utils';

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
      container.dataset.vote = '';
      removeVote(voteId, container);
    } else {
      container.dataset.vote = isUpvote ? 'upvote' : 'downvote';
      updateVoteUI(container, isUpvote, 'Vote updated');
      updateVote(voteId, isUpvote, container);
    }
  } else {
    upvoteButton.disabled = true;
    downvoteButton.disabled = true;
    console.log(upvoteButton, downvoteButton);
    updateVoteUI(container, isUpvote, 'Saved');
    submitVote(type, itemId, isUpvote, container, () => {
      upvoteButton.disabled = false;
      downvoteButton.disabled = false;
    });
  }
}

function submitVote(type, id, isUpvote, container, onComplete) {
  const headers = {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': csrfToken,
  };
  const body = JSON.stringify({
    type: type,
    id: id,
    is_upvote: isUpvote,
  });

  sendAjaxRequest(
    '/vote',
    (data) => {
      console.log(data);
      if (data.message === 'Saved') {
        container.dataset.voteId = data.vote_id;
        container.dataset.vote = isUpvote ? 'upvote' : 'downvote';
      }
      if (onComplete) onComplete();
    },
    'POST',
    headers,
    body
  );
}

function removeVote(voteId, container) {
  sendAjaxRequest(
    `/vote/${voteId}`,
    (data) => {
      console.log(data);
    },
    'DELETE'
  );
}

function updateVote(voteId, isUpvote, container) {
  const headers = {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': csrfToken,
  };
  const body = JSON.stringify({
    is_upvote: isUpvote,
  });

  sendAjaxRequest(
    `/vote/${voteId}`,
    (data) => {
      console.log(data);
    },
    'PUT',
    headers,
    body
  );
}

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
