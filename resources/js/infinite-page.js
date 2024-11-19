const postContainer = document.getElementById('news-posts-container')

if(postContainer) {
  let lastPage = postContainer.dataset.last_page
  let newsPageURL = postContainer.dataset.url

  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  let page = 1;

  document.addEventListener('scroll',function () {
      let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      let windowHeight = window.innerHeight;
      let documentHeight = document.documentElement.scrollHeight;

      if(scrollTop + windowHeight >= documentHeight - 100) {
          page++;
          if (page <= lastPage) {
              console.log(`page ${page}`)
              loadMoreData(page);
          }
      }
  })

  function loadMoreData(page) {
      fetch(newsPageURL+`?page=${page}`, {
          method: 'GET',
          headers: {
              'X-CSRF-TOKEN':csrfToken,
              'X-Requested-With': 'XMLHttpRequest',
          },
      })
      .then(response => {
          return response.json();
      })
      .then(data => {
          if(data.news_posts == "") {
              return;
          }
          postContainer.innerHTML += data.news_posts
      })
  }
}