import { handleDialog, sendAjaxRequest, showMessage } from './utils'

const profileOptions = document.getElementById('profile-options');
const profileOptionsPopup = document.getElementById('profile-options-popup');

profileOptions?.addEventListener('click', (event) => {
  if (profileOptionsPopup.classList.contains('opacity-0')) {
    profileOptionsPopup.classList.remove('opacity-0', 'pointer-events-none');
    profileOptionsPopup.classList.add('opacity-100');
  } else {
    profileOptionsPopup.classList.remove('opacity-100');
    profileOptionsPopup.classList.add('opacity-0', 'pointer-events-none');
  }
});


const deleteAccountButtons = document.querySelectorAll('.delete-account-button')
deleteAccountButtons.forEach((deleteAccountButton) => {
  const baseUrl = deleteAccountButton.dataset.url
  const userId  = deleteAccountButton.dataset.user
  const url = baseUrl + '/users/' + userId + '/anonymize'
  deleteAccountButton.addEventListener('click', (event) => {
    event.preventDefault()
    const deleAccountAction = () => {
      sendAjaxRequest(url,(data) => {showMessage(data.message)},'PUT')
      location.reload()
    }
    handleDialog(deleAccountAction,baseUrl,userId)
  })
})