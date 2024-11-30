import { redirectToLogin,sendAjaxRequest } from './utils.js';

document.addEventListener('DOMContentLoaded', function () {
   addButtonsBehaviour();
});
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// TODO: profile image

function addCommentHandler(data) {
   const thread = data.thread_id
   const threadHTML = data.thread

   const commentSection = document.getElementById('comment-section')

   const threadDiv = commentSection.querySelector(`#comment-${thread}`);

   const commentInput = document.getElementById(`subCommentInput-${commentSection.id.split('-')[1]}`)

   const noComments = document.getElementById('no-comments')

   if (commentInput) commentInput.innerHTML = ''
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

function editCommentHandler(data) {
   const comment_id = data.comment.id

   const editForm = document.getElementById("comment-form-" + comment_id)
   const saveButton = document.getElementById("save_button-" + comment_id)
   const commentContent = document.getElementById("comment-content-" + comment_id)
   const editButton = document.getElementById("edit_button-" + comment_id)
   const abortButton = document.getElementById("abort_button-" + comment_id)


   editForm.style.display = 'none'
   saveButton.style.display = 'none'
   abortButton.style.display = 'none'

   editButton.style.display = 'block'
   commentContent.innerHTML = data.comment.content
   commentContent.style.display = 'block'

}

const commetForm = document.getElementById('commentForm')
if (commetForm) {

   commetForm.addEventListener('submit', function (e) {
      e.preventDefault()

      const commentInput = document.getElementById('commentInput')
      const commentValue = commentInput.value
      const post_id = commentInput.dataset.post_id

      const threadType = commentInput.dataset.thread

      const url = '/comments'
      const method = 'POST'
      const headers= {
         'Content-Type': 'application/json',
         'X-CSRF-TOKEN': csrfToken,
      }
      const body = JSON.stringify({
         content: commentValue,
         news_post_id: post_id,
         thread: threadType
      })

      const isAuth = this.dataset.auth

      if (!isAuth)
         redirectToLogin()

      sendAjaxRequest(false,url,addCommentHandler,method,headers,body)
   })
}

function addNestedComment(parent_id) {
   const commentInput = document.getElementById('commentInput')
   const threadType = commentInput.dataset.thread

   const subCommentInput = document.getElementById(`subCommentInput-${parent_id}`)
   const subCommentInputValue = subCommentInput.value

   const url = '/comments'
   const method = 'POST'
   const headers= {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': csrfToken,
   }
   const body = JSON.stringify({
      content: subCommentInputValue,
      parent_comment_id: parent_id,
      thread: threadType
   })

   sendAjaxRequest(false,url,addCommentHandler,method,headers,body)
}

function addVoteButtonBehaviour() {
    const voteContainers = document.querySelectorAll('.vote-container');

    voteContainers.forEach(container => {
        const authenticated = container.dataset.authenticated === 'true';
        const upvoteButton = container.querySelector('.upvote-button');
        const downvoteButton = container.querySelector('.downvote-button');

        if (!authenticated) {
            upvoteButton.addEventListener('click', redirectToLogin);
            downvoteButton.addEventListener('click', redirectToLogin);
        } else {
            upvoteButton.addEventListener('click', function () {
                handleVote(container, true);
            });

            downvoteButton.addEventListener('click', function () {
                handleVote(container, false);
            });
        }
    });
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
         editForm.style.display = 'block'
         saveButton.style.display = 'block'

         commentContent.style.display = 'none'
         editButton.style.display = 'none'

         abortButton.addEventListener('click', function () {
            editForm.style.display = 'none'
            abortButton.style.display = 'none'
            saveButton.style.display = 'none'

            editButton.style.display = 'block'
            commentContent.style.display = 'block'
         })

         saveButton.addEventListener('click', function () {
            const newComment = commentInput.value.trim()
            const url = `/comments/${comment_id}`
            const method = 'PUT'
            const headers = {
               'Content-Type': 'application/json',
               'X-CSRF-TOKEN': csrfToken,
            }
            const body = JSON.stringify({
               content: newComment,
               comment_id: comment_id
            })
            sendAjaxRequest(false,url,editCommentHandler,method,headers,body)
         })
      })
   })

   document.querySelectorAll('.delete-comment').forEach(function (element) {
      element.addEventListener('click', function (event) {
         event.preventDefault()
         const comment_id = element.id.split('-')[1]

         const url = '/comments/' + comment_id
         const method = 'DELETE'
         sendAjaxRequest(false,url,(_data) => {
            // sendAjaxRequest catches errors
            const comment = document.getElementById('comment-' + comment_id)
            comment.remove()
         },method)
      })
   })
}
