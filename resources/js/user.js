document.querySelectorAll('.reportUser-button').forEach(button => {
    button.addEventListener('click', function () {
        const userId = this.getAttribute('data-user-id');
        const popup = document.getElementById(`reportUser-popup-${userId}`);
        if (popup) {
            popup.classList.remove('hidden');
        }
    });
  });
  
  document.querySelectorAll('.reportUser-popup-close').forEach(button => {
    button.addEventListener('click', function () {
        const userId = this.getAttribute('data-user-id');
        const popup = document.getElementById(`reportUser-popup-${userId}`);
        if (popup) {
            popup.classList.add('hidden');
        }
    });
  });