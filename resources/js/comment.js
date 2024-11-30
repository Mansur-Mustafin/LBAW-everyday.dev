import { sendAjaxRequest } from '../../public/js/app.js'
import { redirectToLogin, addVoteButtonBehaviour } from './vote.js';

document.addEventListener('DOMContentLoaded', function () {
   addButtonsBehaviour();
});

// TODO: profile image

function editCommentHandler() {
   const response = JSON.parse(this.responseText)

   const comment_id = response.comment.id

   const editForm = document.getElementById("comment-form-" + comment_id)
   const saveButton = document.getElementById("save_button-" + comment_id)
   const commentContent = document.getElementById("comment-content-" + comment_id)
   const editButton = document.getElementById("edit_button-" + comment_id)
   const abortButton = document.getElementById("abort_button-" + comment_id)


   editForm.style.display = 'none'
   saveButton.style.display = 'none'
   abortButton.style.display = 'none'

   editButton.style.display = 'block'
   commentContent.innerHTML = response.comment.content
   commentContent.style.display = 'block'

}

const commentForm = document.getElementById('commentForm');

if (commentForm) {

   commentForm.addEventListener('submit', function (e) {
      e.preventDefault()

      const commentInput = document.getElementById('commentInput')
      const commentValue = commentInput.value
      const post_id = commentInput.dataset.post_id

      const threadType = commentInput.dataset.thread

      const data = {
         content: commentValue,
         news_post_id: post_id,
         thread: threadType
      }

      const isAuth = this.dataset.auth

      if (!isAuth)
         redirectToLogin()

      sendAjaxRequest('POST', '/comments', data, addCommentHandler)
   })

}

function addNestedComment(parent_id) {
   const commentInput = document.getElementById('commentInput')
   const threadType = commentInput.dataset.thread

   const subCommentInput = document.getElementById(`subCommentInput-${parent_id}`)
   const subCommentInputValue = subCommentInput.value

   const data = {
      content: subCommentInputValue,
      parent_comment_id: parent_id,
      thread: threadType
   }

   sendAjaxRequest('POST', '/comments', data, addCommentHandler)
}

function addCommentHandler() {
   const response = JSON.parse(this.responseText)
   const thread = response.thread_id
   const threadHTML = response.thread

   const commentSection = document.getElementById('comment-section')

   const threadDiv = commentSection.querySelector(`#comment-${thread}`);

   const noComments = document.getElementById('no-comments')

   if (noComments) noComments.style.display = 'none'

   if (threadDiv) {
      threadDiv.outerHTML = threadHTML;
   } else {
      const div = document.createElement('div')
      div.innerHTML = threadHTML
      commentSection.prepend(div)
   }

   addButtonsBehaviour()
   addVoteButtonBehaviour()
}

function addButtonsBehaviour() {
   document.querySelectorAll('.sub-comment').forEach(function (element) {
      element.addEventListener('click', function (e) {

         const commentSection = element.parentElement.parentElement.parentElement

         const form = document.getElementById(`subCommentForm-${commentSection.id.split('-')[1]}`)

         form.style.display = "flex"

         commentSection.children[0].style.borderBottom = 0
         commentSection.children[0].style.borderRadius = 0

         commentSection.dataset.replies == 'false' ? commentSection.style.borderBottom = 0 : {} // removes bottom border for comment with no replies (level 0) due to overflow

         element.style.pointerEvents = 'none'

         form.addEventListener('submit', function (e) {
            e.preventDefault()

            const isAuth = commentSection.dataset.auth

            console.log(isAuth)

            if (!isAuth)
               redirectToLogin()

            addNestedComment(commentSection.id.split('-')[1])
         })
      })

   })

   document.querySelectorAll('.edit-comment').forEach(function (element) {
      element.addEventListener('click', function () {
         const comment_id = element.id.split('-')[1]

         const editForm = document.getElementById("comment-form-" + comment_id)
         const saveButton = document.getElementById("save_button-" + comment_id)
         const commentContent = document.getElementById("comment-content-" + comment_id)
         const editButton = document.getElementById("edit_button-" + comment_id)
         const commentInput = document.getElementById("comment-input-" + comment_id)

         const abortButton = document.getElementById("abort_button-" + comment_id)

         abortButton.style.display = 'block'

         abortButton.addEventListener('click', function () {
            editForm.style.display = 'none'
            saveButton.style.display = 'none'

            editButton.style.display = 'block'
            commentContent.style.display = 'block'

            abortButton.style.display = 'none'
         })

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

            sendAjaxRequest('PUT', `/comments/${comment_id}`, data, editCommentHandler)
         })
      })
   })

   document.querySelectorAll('.delete-comment').forEach(function (element) {
      element.addEventListener('click', function (event) {
         event.preventDefault()
         const comment_id = element.id.split('-')[1]
         sendAjaxRequest('DELETE', '/comments/' + comment_id, {}, function () {
            const comment = document.getElementById('comment-' + comment_id)
            const response = JSON.parse(this.responseText)

            if (response.success) {
               comment.remove()
            }
         })
      })
   })
}
