import { sendAjaxRequest } from './app.js'

document.addEventListener('DOMContentLoaded', function () {
   addButtonsBehaviour();
});

// TODO: profile image

document.querySelectorAll('.edit-comment').forEach(function (element) {
   element.addEventListener('click', function () {
      const comment_id = element.id.split('-')[1]

      const editForm = document.getElementById("comment-form-" + comment_id)
      const saveButton = document.getElementById("save_button-" + comment_id)
      const commentContent = document.getElementById("comment-content-" + comment_id)
      const editButton = document.getElementById("edit_button-" + comment_id)
      const commentInput = document.getElementById("comment-input-" + comment_id)

      commentContent.style.display = 'none'
      editForm.style.display = 'block'

      editButton.style.display = 'none'
      saveButton.style.display = 'block'

      saveButton.addEventListener('click', function () {
         const newComment = commentInput.value.trim()

         const data = {
            content: newComment,
            comment_id: comment_id
         }

         sendAjaxRequest('POST', '/comments/edit', data, editCommentHandler)
      })
   })
})

function editCommentHandler() {
   const response = JSON.parse(this.responseText)

   const comment_id = response.comment.id

   const editForm = document.getElementById("comment-form-" + comment_id)
   const saveButton = document.getElementById("save_button-" + comment_id)
   const commentContent = document.getElementById("comment-content-" + comment_id)
   const editButton = document.getElementById("edit_button-" + comment_id)

   editForm.style.display = 'none'
   saveButton.style.display = 'none'

   editButton.style.display = 'block'
   commentContent.innerHTML = response.comment.content
   commentContent.style.display = 'block'
}

document.getElementById('commentForm').addEventListener('submit', function (e) {
   e.preventDefault()

   const commentInput = document.getElementById('commentInput')
   const commentValue = commentInput.value
   const post_id = commentInput.dataset.post_id

   const data = {
      content: commentValue,
      news_post_id: post_id,
   }

   sendAjaxRequest('POST', '/comments', data, addCommentHandler)
})

function addNestedComment(parent_id) {
   const subCommentInput = document.getElementById(`subCommentInput-${parent_id}`)
   const subCommentInputValue = subCommentInput.value

   const data = {
      content: subCommentInputValue,
      parent_comment_id: parent_id,
   }

   sendAjaxRequest('POST', '/comments', data, addCommentHandler)
}

function addCommentHandler() {
   const response = JSON.parse(this.responseText)
   const thread = response.thread_id
   const threadHTML = response.thread

   const commentSection = document.getElementById('comment-section')

   const threadDiv = commentSection.querySelector(`#comment-${thread}`);

   const commentInput = document.getElementById(`subCommentInput-${commentSection.id.split('-')[1]}`)

   if (commentInput) commentInput.innerHTML = ''

   if (threadDiv) {
      threadDiv.outerHTML = threadHTML;
   } else {
      const div = document.createElement('div')
      div.innerHTML = threadHTML
      commentSection.prepend(div)
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
               placeholder="Share your thoughts" id="subCommentInput-${commentSection.id.split('-')[1]}" />
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