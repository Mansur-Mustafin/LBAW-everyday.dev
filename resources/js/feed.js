import { sendAjaxRequest } from './utils'

const followTagSection = document.getElementById('follow-tag-section')
const followButton = document.getElementById('follow-tag-button')
const unFollowButton = document.getElementById('unfollow-tag-button')
if(followTagSection && followButton && unFollowButton) {
  const followData = document.getElementById('follow-tag-data')
  const baseUrl = followData.dataset.url
  const tagId = followData.dataset.tagid
  const isFollowed = followData.dataset.isfollowed


  if(isFollowed == "true") {
    followButton.classList.add('hidden')
    unFollowButton.classList.remove('hidden')
  } else {
    followButton.classList.remove('hidden')
    unFollowButton.classList.add('hidden')
  }

  followButton.addEventListener('click', (event) => {
    event.preventDefault()
    const url = `${baseUrl}/tag/store/${tagId}`
    sendAjaxRequest(url,(data)=>{},'POST')
    followButton.classList.add('hidden')
    unFollowButton.classList.remove('hidden')
  })

  unFollowButton.addEventListener('click', (event) => {
    event.preventDefault()
    const url = `${baseUrl}/tag/delete/${tagId}`
    sendAjaxRequest(url,(data)=>{},'DELETE')
    followButton.classList.remove('hidden')
    unFollowButton.classList.add('hidden')
  })
}