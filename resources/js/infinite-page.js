import { sendAjaxRequest, encodeForAjax, truncateWords } from './utils';
import { addVoteButtonBehaviour } from './vote';
import { addBookmarkButtonBehaviour } from './bookmark';

// Adds Vote Behaviour to Post pages
document.addEventListener('DOMContentLoaded', function () {
  addVoteButtonBehaviour();
  addBookmarkButtonBehaviour();
});

const loadingIcon = document.getElementById('loading-icon');
let lastPage = 0;
let loading = false;
let page = 1;

const buildByRequest = async (url, buildUser, resultsDiv) => {
  if (loading) return;
  loading = true;
  if (loadingIcon) loadingIcon.classList.remove('hidden');

  const method = 'GET';
  sendAjaxRequest(
    url,
    (data) => {
      loading = false;
      if (loadingIcon) loadingIcon.classList.add('hidden');
      lastPage = data.last_page;
      if (data.data) {
        data.data.forEach((user) => {
          resultsDiv.innerHTML += buildUser(user);
        });
      }
    },
    method
  );
};

// Posts
const postContainer = document.getElementById('news-posts-container');
const noResults = document.getElementById('no-results')

if (postContainer) {
  const filter = document.getElementById('filter');
  const sortByPopup = document.getElementById('sort-popup');
  const newsTitle = document.getElementById('news-page-title');
  const checkboxes = filter?.querySelectorAll('input[type=checkbox]');
  const radios = filter?.querySelectorAll('input[type=radio]');
  const hiddenSelectedSort = sortByPopup?.querySelector('input[type=hidden]');
  let calledLoadMoreData = false;

  const refreshPage = () => {
    noResults.classList.add('hidden')
    postContainer.innerHTML = '';
    page = 1;
    loadMoreData(page);
  };

  const initializeSortByPopup = () => {
    if (!sortByPopup) return;

    sortByPopup.querySelectorAll('ul li').forEach((option) => {
      option.addEventListener('click', (event) => {
        const target = event.target;
        newsTitle.innerHTML = target.dataset.header;
        hiddenSelectedSort.value = target.innerHTML;
        refreshPage();
      });
    });
  };

  const initializeFilter = () => {
    if (!filter) return;
    const clearButton = filter.querySelector('#clear-all-button');

    const clearAllFilters = () => {
      checkboxes.forEach((checkbox) => (checkbox.checked = false));
      radios.forEach((radio) => radio.name === 'date_range' && (radio.checked = true));
      refreshPage();
    };

    checkboxes.forEach((checkbox) => checkbox.addEventListener('change', refreshPage));
    radios.forEach((radio) => radio.addEventListener('change', refreshPage));
    clearButton.addEventListener('click', clearAllFilters);
  };

  window.onload = refreshPage;
  if (filter) {
    initializeFilter();
    initializeSortByPopup();
  }

  const loadMoreData = (page) => {
    calledLoadMoreData = true;

    if (loading) return;

    calledLoadMoreData = false;
    loading = true;
    let url = `${postContainer.dataset.url}?page=${page}`;

    loadingIcon?.classList.remove('hidden');

    if (filter) {
      const filterData = gatherFilterData();
      url += `&${encodeForAjax(filterData)}`;
    }

    sendAjaxRequest(
      url,
      (data) => {
        loading = false;
        loadingIcon?.classList.add('hidden');
        if (data.news_posts == '' && page === 1) {
          noResults.classList.remove('hidden')
          return;
        }
        postContainer.innerHTML += data.news_posts;
        lastPage = data.last_page;

        addVoteButtonBehaviour();
        addBookmarkButtonBehaviour();
        if (calledLoadMoreData) refreshPage();
      },
      'GET'
    );
  };

  const gatherFilterData = () => {
    const data = {};

    checkboxes.forEach((checkbox) => {
      if (checkbox.checked) {
        data[checkbox.name] = data[checkbox.name] || [];
        data[checkbox.name].push(checkbox.value);
      }
    });

    radios.forEach((radio) => {
      if (radio.checked) {
        data[radio.name] = radio.value;
      }
    });

    data[hiddenSelectedSort.name] = hiddenSelectedSort.value;

    return data;
  };

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
        loadingIcon?.classList.add('hidden');
      }
    }
  });
}

// Users on Followers/Following Pages
const resultsDivFollow = document.getElementById('users-list');
if (resultsDivFollow) {
  const urlObj = new URL(resultsDivFollow.dataset.url);
  const apiUrl = '/api' + urlObj.pathname;

  const buildUserFollowCard = (user) => {
    let html = `
            <div class="flex items-center border border-gray-700 rounded-xl px-5 py-4 mt-4">
                <img src="${user.profile_image.url}" alt="Profile Picture" class="w-12 h-12 rounded-full object-cover">
                
                <a href="/users/${user.id}/posts" class="w-40">
                    <div class="ml-4">
                        <p class="font-bold text-white">${user.public_name}</p>
                        <p class="text-sm text-gray-500">@${user.username}</p>
                    </div>
                </a>

                <span class="bg-gray-200 text-gray-800 px-3 py-1 ml-4 rounded-full text-sm">${user.rank}</span>
            `;
    if (user.can_follow) {
      html += `
                    <button class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple hover:bg-opacity-50 hover:border-none" 
                            data-user-id="${user.id}" data-action="follow">Follow</button>
                `;
    } else if (user.can_unfollow) {
      html += `
                    <button class="follow-button ml-auto justify-end border border-solid text-white bg-background font-bold px-3 py-2 rounded-xl hover:text-purple-400 hover:bg-purple hover:bg-opacity-50 hover:border-none" 
                        data-user-id="${user.id}" data-action="unfollow">Unfollow</button>
                `;
    }
    html += `</div>`;
    return html;
  };

  window.onload = async () => {
    resultsDivFollow.innerHTML = '';
    page = 1;
    buildByRequest(apiUrl, buildUserFollowCard, resultsDivFollow);
  };

  const loadMoreData = async (page) => {
    const url = apiUrl + `?page=${page}`;
    buildByRequest(url, buildUserFollowCard, resultsDivFollow);
  };

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

// Notifications
const resultsDivNotification = document.getElementById('notifications-list');
if (resultsDivNotification) {
  const urlObj = new URL(resultsDivNotification.dataset.url);
  const apiUrl = urlObj.pathname;

  const notificationBoxHTML = ({
    imageSrc,
    triggeredBy,
    text,
    color,
    username,
    time_ago,
    is_viewed,
    type,
  }) => `
    <div class="bg-input p-4 flex flex-col rounded-xl">
      <div class="flex gap-2 items-center justify-between relative">
        <div class="flex gap-2">
          <img src="${imageSrc}"
              alt="Profile Image" class="w-10 h-10 rounded-xl">
          <div class="flex flex-col">
            <span class="font-semibold text-gray-300">${triggeredBy}</span>
            <span class="text-gray-500 text-sm">${username}</span>
          </div>
        </div>
        <div title="${type} notification">
          <svg viewBox="0 0 24 24" width="24" height="24" fill="none" xmlns="http://www.w3.org/2000/svg">
              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
              <g id="SVGRepo_iconCarrier">
                  <path
                      d="M19.3399 14.49L18.3399 12.83C18.1299 12.46 17.9399 11.76 17.9399 11.35V8.82C17.9399 6.47 16.5599 4.44 14.5699 3.49C14.0499 2.57 13.0899 2 11.9899 2C10.8999 2 9.91994 2.59 9.39994 3.52C7.44994 4.49 6.09994 6.5 6.09994 8.82V11.35C6.09994 11.76 5.90994 12.46 5.69994 12.82L4.68994 14.49C4.28994 15.16 4.19994 15.9 4.44994 16.58C4.68994 17.25 5.25994 17.77 5.99994 18.02C7.93994 18.68 9.97994 19 12.0199 19C14.0599 19 16.0999 18.68 18.0399 18.03C18.7399 17.8 19.2799 17.27 19.5399 16.58C19.7999 15.89 19.7299 15.13 19.3399 14.49Z"
                      fill=${color}></path>
                  <path
                      d="M14.8297 20.01C14.4097 21.17 13.2997 22 11.9997 22C11.2097 22 10.4297 21.68 9.87969 21.11C9.55969 20.81 9.31969 20.41 9.17969 20C9.30969 20.02 9.43969 20.03 9.57969 20.05C9.80969 20.08 10.0497 20.11 10.2897 20.13C10.8597 20.18 11.4397 20.21 12.0197 20.21C12.5897 20.21 13.1597 20.18 13.7197 20.13C13.9297 20.11 14.1397 20.1 14.3397 20.07C14.4997 20.05 14.6597 20.03 14.8297 20.01Z"
                      fill=${color}></path>
              </g>
          </svg>
          ${
            is_viewed
              ? ''
              : '<div class="related bg-red-400 rounded-full w-2 h-2 absolute bottom-7 right-0"></div>'
          }
        </div>
      </div>
      <div class="flex justify-between">
        <p class="mt-4">${text}</p>
        <p class="text-gray-500 self-end text-sm">${time_ago}</p>
      </div>
    </div>
  `;

  const notificationHandlers = {
    VoteNotification: ({ vote }) => ({
      imageSrc: vote.user.profile_image.url,
      triggeredBy: vote.user.public_name,
      text: vote.is_upvote
        ? `Upvoted your ${
            vote.news_post_id
              ? `<a class="underline" href="/news/${vote.news_post_id}">post</a>.`
              : 'comment.'
          }`
        : `Downvoted your ${
            vote.news_post_id
              ? `<a class="underline" href="/news/${vote.news_post_id}">post</a>.`
              : 'comment.'
          }`,
      color: '#D264B6',
      username: `<a href="/users/${vote.user.id}/posts">@${vote.user.username}</a>`,
      type: 'vote',
    }),
    CommentNotification: ({ comment }) => ({
      imageSrc: comment.author.profile_image.url,
      triggeredBy: comment.author.public_name,
      text: comment.news_post_id
        ? `Leaved a comment on your <a class="underline" href="/news/${comment.news_post_id}">post</a>.`
        : 'Replied to your comment.',
      color: '#A480CF',
      username: `<a href="/users/${comment.author.id}/posts">@${comment.author.username}</a>`,
      type: 'comment',
    }),
    FollowNotification: ({ follower }) => ({
      imageSrc: follower.profile_image.url,
      triggeredBy: `${follower.public_name}`,
      text: 'Followed you.',
      color: '#779BE7',
      username: `<a href="/users/${follower.id}/posts">@${follower.username}</a>`,
      type: 'follow',
    }),
    PostNotification: ({ news_post }) => ({
      imageSrc: news_post.author.profile_image.url,
      triggeredBy: news_post.author.public_name,
      text: `Posted: <a href="/news/${news_post.id}" class="underline">${truncateWords(
        news_post.title,
        15
      )}</a>`,
      color: '#49B6FF',
      username: `<a href="/users/${news_post.author.id}/posts">@${news_post.author.username}</a>`,
      type: 'post',
    }),
  };

  const buildNotification = (notification) => {
    const handler = notificationHandlers[notification.notification_type];
    const details = handler(notification);
    details.time_ago = notification.time_ago;
    details.is_viewed = notification.is_viewed;
    const html = notificationBoxHTML(details);
    return html;
  };

  window.onload = async () => {
    resultsDivNotification.innerHTML = '';
    page = 1;
    buildByRequest(apiUrl, buildNotification, resultsDivNotification);
  };

  const loadMoreData = async (page) => {
    const url = apiUrl + `?page=${page}`;
    buildByRequest(url, buildNotification, resultsDivNotification);
  };

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
