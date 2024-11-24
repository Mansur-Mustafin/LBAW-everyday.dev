import { sendAjaxRequest } from './app.js'

document.addEventListener('DOMContentLoaded', function () {
   addButtonsBehaviour();
});

// TODO: profile image, add comment interaction when a comment is just added

document.getElementById('commentForm').addEventListener('submit', function (e) {
   e.preventDefault()

   const commentInput = document.getElementById('commentInput')
   const commentValue = commentInput.value
   const post_id = commentInput.dataset.post_id

   const data = {
      content: commentValue,
      post_id: post_id,
   }

   sendAjaxRequest('POST', '/comments', data, addCommentHandler)
})

function addCommentHandler() {
   const response = JSON.parse(this.responseText)
   const thread = response.thread_id
   const threadHTML = response.thread

   const commentSection = document.getElementById('comment-section')

   const threadDiv = commentSection.querySelector(`#comment-${thread}`);

   if (threadDiv) {
      threadDiv.outerHTML = threadHTML;
   }

   addButtonsBehaviour()
}

function addButtonsBehaviour() {
   document.querySelectorAll('.sub-comment').forEach(function (element) {
      element.addEventListener('click', function (e) {
         const commentSection = element.parentElement.parentElement.parentElement
         const form = document.createElement('form')
         form.classList.add('flex', 'items-center', '-mt-2')

         form.innerHTML = `
            <input type="text"
               class="outline-none p-4 w-full border border-solid border-gray-700 bg-input rounded-xl hover:border-white hover:border-opacity-70"
               placeholder="Share your thoughts" id="subCommentInput" />
            <button class="-ml-20 px-5 py-2 rounded-xl bg-purple-900" type="submit">Post</button>
         `

         commentSection.children[0].style.borderBottom = 0
         commentSection.children[0].style.borderRadius = 0

         commentSection.dataset.replies == 'false' ? commentSection.style.borderBottom = 0 : {} // removes bottom border for comment with no replies (level 0) due to overflow

         if (commentSection.children.length > 1) { // this adds as a second element, once the first element is always the content
            commentSection.insertBefore(form, commentSection.children[1])
         } else {
            commentSection.appendChild(form)
         }

         element.style.pointerEvents = 'none'

         form.addEventListener('submit', function (e) {
            e.preventDefault()
            addNestedComment(commentSection.id.split('-')[1])
         })
      })
   })
}


function addNestedComment(parent_id) {
   const subCommentInput = document.getElementById('subCommentInput')
   const subCommentInputValue = subCommentInput.value

   const data = {
      content: subCommentInputValue,
      parent_comment_id: parent_id,
   }

   sendAjaxRequest('POST', '/comments', data, addCommentHandler)
}