import { truncateWords, showSuccessMessage, sendAjaxRequest } from './utils.js';

// Receive Notification in Real-time
if (userId) {
  const pusher = new Pusher(pusherAppKey, {
    cluster: pusherCluster,
    encrypted: true,
  });

  const channel = pusher.subscribe(`user.${userId}`);

  channel.bind('notification-personal', function (data) {
    displayNotification(data);
  });

  const dismissNotification = (notificationElement) => {
    if (notificationElement) {
      notificationElement.classList.replace('animate-slide-in', 'animate-slide-out');
      notificationElement.addEventListener('animationend', () => notificationElement.remove(), {
        once: true,
      });
    }
  };

  const notificationHandlers = {
    VoteNotification: ({ vote }) => ({
      imageSrc: vote.user.profile_image,
      triggeredBy: vote.user.public_name,
      text: vote.is_upvote
        ? `Upvoted your ${vote.news_post_id ? 'post' : 'comment'}.`
        : `Downvoted your ${vote.news_post_id ? 'post' : 'comment'}.`,
      hrefOpen: vote.news_post_id ? `news/${vote.news_post_id}` : `#`,
    }),
    CommentNotification: ({ comment }) => ({
      imageSrc: comment.author.profile_image,
      triggeredBy: comment.author.public_name,
      text: comment.news_post_id ? 'Leaved a comment on your post.' : 'Replied to your comment.',
      hrefOpen: comment.news_post_id ? `news/${comment.news_post_id}` : `#`,
    }),
    FollowNotification: ({ follower }) => ({
      imageSrc: follower.profile_image,
      triggeredBy: follower.public_name,
      text: 'Followed you.',
      hrefOpen: `/users/${follower.id}/posts`,
    }),
    PostNotification: ({ news_post }) => ({
      imageSrc: news_post.author.profile_image,
      triggeredBy: news_post.author.public_name,
      text: `Posted: ${truncateWords(news_post.title, 15)}`,
      hrefOpen: `news/${news_post.id}`,
    }),
  };

  const generateNotificationHTML = ({ imageSrc, triggeredBy, text, hrefOpen }) => `
    <div class="flex gap-2">
      <img class="w-8 h-8 rounded-full object-cover" src="${imageSrc}" alt="Profile Image" />
      <div class="text-sm">
        <span class="mb-1 font-semibold text-gray-900 dark:text-white">${triggeredBy}</span>
        <div class="mb-3">${text}</div>
        ${
          hrefOpen !== '#'
            ? `<a href="${hrefOpen}" class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-white text-black hover:bg-purple-950 hover:text-white">Open</a>`
            : ''
        }
      </div>
      <button type="button" class="ms-auto -mx-1.5 -my-1.5 justify-center items-center flex-shrink-0 rounded-lg p-1.5 inline-flex h-8 w-8 text-gray-500 hover:text-white">
        <span class="sr-only">Close</span>
        <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
        </svg>
      </button>
    </div>
  `;

  function displayNotification(notification) {
    const container = document.getElementById('notification-container');
    const handler = notificationHandlers[notification.notification_type];

    const details = handler(notification);
    const notificationHTML = generateNotificationHTML(details);

    const notificationElement = document.createElement('div');
    notificationElement.className =
      'w-full max-w-xs p-4 text-white bg-black rounded-xl shadow animate-slide-in';

    notificationElement.innerHTML = notificationHTML;
    container.appendChild(notificationElement);

    const closeButton = notificationElement.querySelector('button');
    closeButton.addEventListener('click', () => dismissNotification(notificationElement));

    setTimeout(() => dismissNotification(notificationElement), 5000);
  }
}

// Notification Settings
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const notificationSettings = document.getElementById('notification-settings');
if (notificationSettings) {
  const notificationSettingsButtons = notificationSettings.querySelector(
    '#notification-settings-buttons'
  );
  const saveButton = notificationSettingsButtons.querySelector('#save-notification-button');
  const cancelButton = notificationSettingsButtons.querySelector('#cancel-notification-button');
  const toggleTwoDivs = document.querySelectorAll('.toggleTwo');

  saveButton.addEventListener('click', (event) => {
    event.preventDefault();

    const settings = {};
    toggleTwoDivs.forEach((div) => {
      const hiddenToggle = div.querySelector('.hiddenToggle');
      const name = hiddenToggle.name;
      const value = hiddenToggle.value === 'true';
      settings[name] = value;
    });

    sendAjaxRequest(
      '/notification-settings',
      (data) => {
        if (data.success) {
          notificationSettingsButtons.classList.add('hidden');
          showSuccessMessage(data.message);
          toggleTwoDivs.forEach((div) => {
            div.dataset.initialvalue =
              div.querySelector('.hiddenToggle').value === 'true' ? 'true' : 'false';
          });
        }
      },
      'PUT',
      { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken },
      JSON.stringify(settings)
    );
  });

  cancelButton.addEventListener('click', (event) => {
    event.preventDefault();

    toggleTwoDivs.forEach((div) => {
      const toggleTwo = div.querySelector('.toggleTwoInput');
      const hiddenToggle = div.querySelector('.hiddenToggle');
      const initialValue = div.dataset.initialvalue === 'true';

      toggleTwo.checked = initialValue;
      hiddenToggle.value = initialValue ? 'true' : 'false';
    });

    notificationSettingsButtons.classList.add('hidden');
  });
}
