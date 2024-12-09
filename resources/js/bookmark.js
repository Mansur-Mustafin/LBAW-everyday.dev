import { redirectToLogin, sendAjaxRequest } from './utils';

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

export function addBookmarkButtonBehaviour() {
  const voteContainers = document.querySelectorAll('.vote-container');

  voteContainers.forEach((container) => {
    const authenticated = container.dataset.authenticated === 'true';
    const bookmarkButton = container.querySelector('.bookmark-button');

    if (!bookmarkButton) return;

    if (!authenticated) {
      bookmarkButton.addEventListener('click', redirectToLogin);
    } else {
      bookmarkButton.addEventListener('click', function () {
        toggleBookmark(container);
      });
    }
  });
}

function toggleBookmark(container) {
  const postId = container.dataset.id;
  const isBookmarked = container.dataset.user_bookmark === 'true';

  if (isBookmarked) {
    removeBookmark(postId, container);
  } else {
    addBookmark(postId, container);
  }
}

function addBookmark(postId, container) {
  sendAjaxRequest(
    `/bookmark`,
    (data) => {
      if (data.message === 'Bookmarked') {
        container.dataset.user_bookmark = 'true';
        updateBookmarkUI(container);
      }
    },
    'POST',
    { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
    JSON.stringify({ post_id: postId })
  );
}

function removeBookmark(postId, container) {
  console.log(`/bookmark/${postId}`);
  sendAjaxRequest(
    `/bookmark/${postId}`,
    (data) => {
      if (data.message === 'Bookmark removed') {
        container.dataset.user_bookmark = 'false';
        updateBookmarkUI(container);
      }
    },
    'DELETE'
  );
}

function updateBookmarkUI(container) {
  const postId = container.dataset.id;

  const bookmarkOutline = document.getElementById(`post-bookmark-outline-${postId}`);
  const bookmarkFill = document.getElementById(`post-bookmark-fill-${postId}`);

  bookmarkOutline.classList.toggle('hidden');
  bookmarkFill.classList.toggle('hidden');
}
