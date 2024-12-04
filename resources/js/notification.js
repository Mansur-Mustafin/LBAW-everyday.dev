import { truncateWords } from './utils.js';

if (userId) {
  const pusher = new Pusher(pusherAppKey, {
    cluster: pusherCluster,
    encrypted: true,
  });

  const channel = pusher.subscribe(`user.${userId}`);

  channel.bind('notification-personal', function (data) {
    console.log(`${Object.entries(data.notification)}`);
    displayNotification(data.notification);
  });

  function dismissNotification(element) {
    const notificationElement = element.closest('div.flex');

    if (notificationElement) {
      notificationElement.classList.remove('animate-slide-in');
      notificationElement.classList.add('animate-slide-out');

      notificationElement.addEventListener('animationend', () => {
        notificationElement.remove();
      });
    }
  }

  function displayNotification(notification) {
    const container = document.getElementById('notification-container');

    const notificationElement = document.createElement('div');
    notificationElement.classList.add(
      'w-full',
      'max-w-xs',
      'p-4',
      'text-white',
      'bg-black',
      'rounded-xl',
      'shadow',
      'animate-slide-in',
    );

    let imageSrc = '';
    let triggeredBy = '';
    let text = '';
    let hrefOpen = '#';

    switch (notification.notification_type) {
      case 'VoteNotification':
        imageSrc = notification.vote.user.profile_image.url;
        triggeredBy = notification.vote.user.public_name;
        if (notification.vote.is_upvote) {
          text = 'Upvoted your';
        } else {
          text = 'Downvoted your';
        }
        if (notification.vote.news_post_id != null) {
          text += ' post.';
          hrefOpen = `${notification.vote.news_post_id}`; // Mostro o post onde ele deu upvote
        } else {
          text += ' comment.';
        }
        break;

      case 'CommentNotification':
        imageSrc = notification.comment.author.profile_image.url;
        triggeredBy = notification.comment.author.public_name;
        if (notification.comment.news_post_id != null) {
          text = 'Leaved comment on you post.';
          hrefOpen = `${notification.comment.news_post_id}`;
        } else {
          text = 'Replies on your comment.';
        }
        break;

      case 'FollowNotification':
        imageSrc = notification.follower.profile_image.url;
        triggeredBy = notification.follower.public_name;
        text = 'Followed you';
        hrefOpen = `/users/${notification.follower.id}/posts`;
        break;

      case 'PostNotification':
        imageSrc = notification.news_post.author.profile_image.url;
        triggeredBy = notification.news_post.author.public_name;
        text = `Posted: ${truncateWords(notification.news_post.title, 15)}`;
        hrefOpen = `${notification.news_post_id}`;
        break;

      default:
        break;
    }

    let openButtonHTML =
      hrefOpen == '#'
        ? ''
        : `<a href="${hrefOpen}"
                  class="px-2.5 py-1.5 text-xs font-medium rounded-lg bg-white text-black  hover:bg-purple-950 hover:text-white">Open</a>`;

    notificationElement.innerHTML = `
      <div class="flex gap-2">
          <img class="w-8 h-8 rounded-full"
              src="${imageSrc}"
              alt="Profile Image" />
          <div class="text-sm">
              <span class="mb-1 font-semibold text-gray-900 dark:text-white">${triggeredBy}</span>
              <div class="mb-3">${text}</div>
              ${openButtonHTML}
          </div>
          <button type="button"
              class="ms-auto -mx-1.5 -my-1.5 justify-center items-center flex-shrink-0 rounded-lg p-1.5 inline-flex h-8 w-8 text-gray-500 hover:text-white">
              <span class="sr-only">Close</span>
              <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
              </svg>
          </button>
      </div>
    `;

    const closeButton = notificationElement.querySelector('button');
    closeButton.addEventListener('click', function() {
      dismissNotification(notificationElement);
    });

    container.appendChild(notificationElement);

    // TODO: Powered by OpenAI
    setTimeout(() => {
      notificationElement.classList.remove('animate-slide-in');
      notificationElement.classList.add('animate-slide-out');

      notificationElement.addEventListener('animationend', () => {
        notificationElement.remove();
      });
    }, 5000);
  }

  

}
