import { copyToClipboard, sendAjaxRequest } from './utils';

document.addEventListener('DOMContentLoaded', function () {
  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

  document.addEventListener('click', function (e) {
    const target = e.target;

    if (target && target.classList.contains('follow-button')) {
      e.preventDefault();

      const userId = target.dataset.userId;
      const action = target.dataset.action;
      let url = '';
      let method = '';

      if (action === 'follow') {
        url = `/users/${userId}/follow`;
        method = 'POST';
      } else if (action === 'unfollow') {
        url = `/users/${userId}/unfollow`;
        method = 'DELETE';
      }

      sendAjaxRequest(
        url,
        (data) => {
          if (target.id === 'follow-button-refresh' || target.id === 'unfollow-button-refresh') {
            location.reload();
          }
          if (action === 'follow') {
            target.textContent = 'Unfollow';
            target.dataset.action = 'unfollow';
          } else if (action === 'unfollow') {
            target.dataset.action = 'follow';
            target.textContent = 'Follow';
          }
        },
        method
      );
    }
  });
});

const shareProfileButton = document.getElementById('share-profile');

if (shareProfileButton) {
  copyToClipboard(shareProfileButton);
}
