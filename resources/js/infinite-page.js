const postContainer = document.getElementById('news-posts-container')

if(postContainer) {
  let lastPage = postContainer.dataset.last_page
  let newsPageURL = postContainer.dataset.url
  let loading = false;

  const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
  let page = 1;
  let endPage = 1;

  document.addEventListener('scroll',function () {
      let scrollTop = document.documentElement.scrollTop || document.body.scrollTop;
      let windowHeight = window.innerHeight;
      let documentHeight = document.documentElement.scrollHeight;

      if(scrollTop + windowHeight >= documentHeight - 100) {
          // TODO: Refactor this in the future
          endPage++;
          if(endPage > 4) {
            endPage = 0;
            if (page <= lastPage && loading == false) {
                page++;
                loadMoreData(page);
            }
          }
      }
  })

  function loadMoreData(page) {
      if (loading) return;
      loading = true;

      fetch(newsPageURL+`?page=${page}`, {
          method: 'GET',
          headers: {
              'X-CSRF-TOKEN':csrfToken,
              'X-Requested-With': 'XMLHttpRequest',
          },
      })
      .then(response => {
          loading = false;
          return response.json();
      })
      .then(data => {
          if(data.news_posts == "") {
              return;
          }
          postContainer.innerHTML += data.news_posts
          console.log(data)
      })
  }
}