const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const defaultHeaders = {
  'X-CSRF-TOKEN': csrfToken,
  'X-Requested-With': 'XMLHttpRequest',
};

export function encodeForAjax(data) {
  if (data == null) return null;

  const params = [];
  for (const key in data) {
    const value = data[key];
    if (Array.isArray(value)) {
      value.forEach((val) => {
        params.push(encodeURIComponent(key) + '[]=' + encodeURIComponent(val));
      });
    } else {
      params.push(encodeURIComponent(key) + '=' + encodeURIComponent(value));
    }
  }
  return params.join('&');
}

export function sendAjaxRequest(url, handler, method, headers = defaultHeaders, body = undefined) {
  fetch(url, {
    method: method,
    headers: headers,
    body: body,
  })
    .then((response) => {
      if (response.ok) {
        return response.json();
      }
    })
    .then((data) => {
      handler(data);
    })
    .catch((error) => {
      console.log('Error', error);
    });
}

export function redirectToLogin() {
  const currentUrl = window.location.href;

  const loginUrl = `/login?redirect=${encodeURIComponent(currentUrl)}`;

  window.location.href = loginUrl;
}

export function truncateWords(str, maxWords = 10) {
  if (!str) return '';

  const words = str.split(/\s+/); // Split by any whitespace character
  if (words.length > maxWords) {
    return words.slice(0, maxWords).join(' ') + '...';
  }
  return str;
}

export function showSuccessMessage(message) {
  const popup = document.createElement('div');
  popup.id = 'success-popup';
  popup.className = 'fixed bottom-4 right-4 bg-green-900 text-white p-4 rounded-xl shadow-lg';
  popup.innerText = message;

  document.body.appendChild(popup);

  setTimeout(() => {
    popup.classList.add('hidden');
    setTimeout(() => popup.remove(), 1000);
  }, 4000);
}

// not by me
export function uploadBase64Image(dataUrl) {
  const matches = dataUrl.match(/^data:(image\/\w+);base64,(.+)$/);

  const mimeType = matches[1];
  const base64Data = matches[2];

  const byteCharacters = atob(base64Data);
  const byteNumbers = new Array(byteCharacters.length);
  for (let i = 0; i < byteCharacters.length; i++) {
    byteNumbers[i] = byteCharacters.charCodeAt(i);
  }
  const byteArray = new Uint8Array(byteNumbers);
  const blob = new Blob([byteArray], { type: mimeType });

  return blob;
}

export const transformLoadingButton = (button) => {
  console.log(button);

  button.classList.remove('text-input', 'bg-white', 'font-bold', 'px-6', 'py-2');

  button.classList.add(
    'text-gray-100',
    'font-semibold',
    'pr-3',
    'py-1',
    'bg-[#4C4B63]',
    'flex',
    'items-center',
    'justify-center'
  );

  button.disabled = true;

  button.innerHTML = `
      <img class="w-8 h-8" src="/assets/loading-icon.gif" alt="Loading...">
      Sending...
    `;
};

export function copyToClipboard(elem) {
  elem.addEventListener('click', function () {
    navigator.clipboard.writeText(window.location.href).then(() => {
      const feedback = elem.querySelector('.copied-feedback');

      feedback.classList.remove('opacity-0');
      feedback.classList.add('opacity-100');

      setTimeout(() => {
        feedback.classList.add('opacity-0');
        feedback.classList.remove('opacity-100');
      }, 1000);
    });
  });
}

export const toggleDeleteButton = () => {
  const commentSection = document.getElementById('comment-section');
  const voteCountElement = document.querySelector('.vote-container .vote-count');
  const deleteButton = document.getElementById('delete-post-button');

  const hasComments = !(
    commentSection.children[0]?.innerHTML.trim() == '' ||
    commentSection.innerHTML.trim() == '' ||
    commentSection.children[0]?.id == 'no-comments'
  );

  const hasVotes = parseInt(voteCountElement.textContent, 10) != 0;

  if (hasComments || hasVotes) {
    deleteButton?.classList.add('hidden');
  } else {
    deleteButton?.classList.remove('hidden');
  }
};


export const stripHtml = (html) => {
  const div = document.createElement("div");
  div.innerHTML = html;
  return div.textContent || div.innerText || "";
};