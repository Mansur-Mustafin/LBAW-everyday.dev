import { redirectToLogin, sendAjaxRequest, toggleDeleteButton } from './utils.js';
import { addVoteButtonBehaviour } from './vote.js';

// Adds Vote Behaviour to Comments
document.addEventListener('DOMContentLoaded', function () {
  addButtonsBehaviour();
});

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

function addCommentHandler(data) {
  const thread = data.thread_id;
  const threadHTML = data.thread;

  const commentSection = document.getElementById('comment-section');

  const threadDiv = commentSection.querySelector(`#comment-${thread}`);

  const noComments = document.getElementById('no-comments');

  if (noComments) noComments.classList.add('hidden');

  if (threadDiv) {
    threadDiv.outerHTML = threadHTML;
  } else {
    const div = document.createElement('div');
    div.innerHTML = threadHTML;
    commentSection.prepend(div);
  }

  addButtonsBehaviour();
  addVoteButtonBehaviour();
  toggleDeleteButton();
}

function editCommentHandler(data) {
  const comment_id = data.comment.id;

  const editForm = document.getElementById('comment-form-' + comment_id);
  const saveButton = document.getElementById('save_button-' + comment_id);
  const commentContent = document.getElementById('comment-content-' + comment_id);
  const editButton = document.getElementById('edit_button-' + comment_id);
  const abortButton = document.getElementById('abort_button-' + comment_id);

  editForm.classList.add('hidden');
  saveButton.classList.add('hidden');
  abortButton.classList.add('hidden');

  editButton.classList.remove('hidden');
  commentContent.innerHTML = data.comment.content;
  commentContent.classList.remove('hidden');
}

const commentForm = document.getElementById('commentForm');

if (commentForm) {
  commentForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const commentInput = document.getElementById('commentInput');
    const commentValue = commentInput.value;
    const post_id = commentInput.dataset.post_id;

    const threadType = commentInput.dataset.thread;

    const url = '/comments';
    const method = 'POST';
    const headers = {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
    };
    const body = JSON.stringify({
      content: commentValue,
      news_post_id: post_id,
      thread: threadType,
    });

    const isAuth = this.dataset.auth;

    if (!isAuth) redirectToLogin();

    commentInput.value = ''; // reset input after submit comment
    sendAjaxRequest(url, addCommentHandler, method, headers, body);
  });
}

function addNestedComment(parent_id) {
  const commentInput = document.getElementById('commentInput');
  const threadType = commentInput.dataset.thread;

  const subCommentInput = document.getElementById(`subCommentInput-${parent_id}`);
  const subCommentInputValue = subCommentInput.value;

  const url = '/comments';
  const method = 'POST';
  const headers = {
    'Content-Type': 'application/json',
    'X-CSRF-TOKEN': csrfToken,
  };
  const body = JSON.stringify({
    content: subCommentInputValue,
    parent_comment_id: parent_id,
    thread: threadType,
  });

  sendAjaxRequest(url, addCommentHandler, method, headers, body);
}

function addButtonsBehaviour() {
  document.querySelectorAll('.sub-comment').forEach(function (element) {
    element.addEventListener('click', function (e) {
      const commentSection = element.parentElement.parentElement.parentElement;

      const form = document.getElementById(`subCommentForm-${commentSection.id.split('-')[1]}`);

      form.classList.add('flex');
      form.classList.remove('hidden');

      commentSection.children[0].style.borderBottom = 0;
      commentSection.children[0].style.borderRadius = 0;

      commentSection.dataset.replies == 'false' ? (commentSection.style.borderBottom = 0) : {}; // removes bottom border for comment with no replies (level 0) due to overflow

      element.style.pointerEvents = 'none';

      form.addEventListener('submit', function (e) {
        e.preventDefault();

        const isAuth = commentSection.dataset.auth;

        if (!isAuth) redirectToLogin();

        addNestedComment(commentSection.id.split('-')[1]);
      });
    });
  });

  document.querySelectorAll('.edit-comment').forEach(function (element) {
    element.addEventListener('click', function () {
      const comment_id = element.id.split('-')[1];

      const editForm = document.getElementById('comment-form-' + comment_id);
      const saveButton = document.getElementById('save_button-' + comment_id);
      const commentContent = document.getElementById('comment-content-' + comment_id);
      const editButton = document.getElementById('edit_button-' + comment_id);
      const commentInput = document.getElementById('comment-input-' + comment_id);

      const abortButton = document.getElementById('abort_button-' + comment_id);

      abortButton.classList.remove('hidden');
      editForm.classList.remove('hidden');
      saveButton.classList.remove('hidden');

      commentContent.classList.add('hidden');
      editButton.classList.add('hidden');

      abortButton.addEventListener('click', function () {
        editForm.classList.add('hidden');
        abortButton.classList.add('hidden');
        saveButton.classList.add('hidden');

        editButton.classList.remove('hidden');
        commentContent.classList.remove('hidden');
      });

      saveButton.addEventListener('click', function () {
        const newComment = commentInput.value.trim();
        const url = `/comments/${comment_id}`;
        const method = 'PUT';
        const headers = {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': csrfToken,
        };
        const body = JSON.stringify({
          content: newComment,
          comment_id: comment_id,
        });
        sendAjaxRequest(url, editCommentHandler, method, headers, body);
      });
    });
  });

  document.querySelectorAll('.delete-comment').forEach(function (element) {
    element.addEventListener('click', function (event) {
      event.preventDefault();
      const comment_id = element.id.split('-')[1];

      const url = '/comments/' + comment_id;
      const method = 'DELETE';
      const comment = document.getElementById('comment-' + comment_id);
      if (!comment.classList.contains('hidden')) {
        sendAjaxRequest(url, (_data) => {}, method);
        comment.classList.add('hidden');
        toggleDeleteButton();
      }
    });
  });

  document.querySelectorAll('.omit-comment').forEach(function (element) {
    element.addEventListener('click', function (event) {
      event.preventDefault();
      const comment_id = element.id.split('-')[2];

      const url = '/comments/' + comment_id + '/omit';
      const method = 'POST';
      sendAjaxRequest(
        url,
        (data) => {
          // sendAjaxRequest catches errors
          const omitComment = document.getElementById('omit-comment-' + comment_id);
          const unOmitComment = document.getElementById('unomit-comment-' + comment_id);

          omitComment.classList.add('hidden');
          unOmitComment.classList.remove('hidden');

          const comment = document.getElementById('comment-' + comment_id);
          comment.classList.add('opacity-50');
        },
        method
      );
    });
  });

  document.querySelectorAll('.unomit-comment').forEach(function (element) {
    element.addEventListener('click', function (event) {
      event.preventDefault();
      const comment_id = element.id.split('-')[2];

      const url = '/comments/' + comment_id + '/unomit';
      const method = 'POST';
      sendAjaxRequest(
        url,
        (data) => {
          // sendAjaxRequest catches errors
          const omitComment = document.getElementById('omit-comment-' + comment_id);
          const unOmitComment = document.getElementById('unomit-comment-' + comment_id);

          omitComment.classList.remove('hidden');
          unOmitComment.classList.add('hidden');

          const comment = document.getElementById('comment-' + comment_id);
          comment.classList.remove('opacity-50');
          comment.classList.add('opacity-100');
        },
        method
      );
    });
  });
}
