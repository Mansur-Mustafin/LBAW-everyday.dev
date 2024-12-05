const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const defaultHeaders = {
  'X-CSRF-TOKEN': csrfToken,
  'X-Requested-With': 'XMLHttpRequest',
};

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