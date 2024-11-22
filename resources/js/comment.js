document.getElementById('commentForm').addEventListener('submit', function (e) {
   e.preventDefault()

   const commentInput = document.getElementById('commentInput')

   console.log(1)

   const commentValue = commentInput.value
   const post_id = commentInput.dataset.post_id

   const request = new XMLHttpRequest()
   request.open('POST', '/comments', true)
   request.setRequestHeader('X-CSRF-TOKEN', document.querySelector('meta[name="csrf-token"]').content)
   request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded')

   request.onreadystatechange = function () {
      if (request.status === 201 && request.readyState === 4) { // https://stackoverflow.com/questions/30522565/what-is-meaning-of-xhr-readystate-4

         const user = JSON.parse(request.responseText)['user']
         const comment = JSON.parse(request.responseText)['comment']

         console.log(comment)

         const newComment = document.createElement('div')
         newComment.classList.add('border', 'border-solid', 'border-gray-700', 'rounded-xl', 'flex', 'flex-col')
         newComment.innerHTML = `
               <div class="rounded-xl p-4">
                     <div class="text-sm text-gray-400 flex gap-2">
                        <img src="">
                        <div class="flex flex-col">
                           <h2 class="text-white text-sm font-semibold">${user.public_name}</h2>
                           <h3 class="text-xs text-gray-500">${'@' + user.username} ·
                                 ${'Now'}
                           </h3>
                        </div>
                     </div>
                     <div class="mt-4">
                        ${comment}
                     </div>
                     <div class="mt-3 text-sm flex gap-3">
                        <a class="p-2 rounded-xl cursor-pointer hover:text-cyan-400 hover:bg-cyan-700 hover:bg-opacity-50">
                           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="lucide lucide-message-circle">
                                 <path d="M7.9 20A9 9 0 1 0 4 16.1L2 22Z" />
                           </svg>
                        </a>
                        <a class="p-2 rounded-xl cursor-pointer hover:text-rose-400 hover:bg-rose-700 hover:bg-opacity-50">
                           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="lucide lucide-bookmark-plus">
                                 <path d="m19 21-7-4-7 4V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16z" />
                                 <line x1="12" x2="12" y1="7" y2="13" />
                                 <line x1="15" x2="9" y1="10" y2="10" />
                           </svg> </a>
                        </a>
                        <a class="p-2 rounded-xl cursor-pointer hover:text-purple-400 hover:bg-purple-700 hover:bg-opacity-50">
                           <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none"
                                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                 class="lucide lucide-link">
                                 <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
                                 <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
                           </svg> </a>
                        </a>
                     </div>
         `

         document.getElementById('comment-section').prepend(newComment)

         commentInput.value = ''
      }
   }

   request.send('content=' + encodeURIComponent(commentValue) + '&post_id=' + encodeURIComponent(post_id));
})