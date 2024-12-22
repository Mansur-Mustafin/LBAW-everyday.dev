@if(session('success'))
  <div id="success-popup"
    class="animate-slide-in flex flex-row justify-start fixed bottom-4 right-4 bg-green-900 text-white p-4 rounded-xl shadow-lg">
    {{ session('success') }}
    <button type="button"
    class="ms-auto -mx-1 -my-1 justify-center items-center flex-shrink-0 rounded-lg p-1.5 inline-flex h-8 w-8 text-gray-200 hover:text-white">
    <span class="sr-only">Close</span>
    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
    </svg>
    </button>
  </div>
@endif

@if(session('error'))
  <div id="error-popup"
    class="animate-slide-in flex flex-row justify-start fixed bottom-4 right-4 bg-red-700 text-white p-4 rounded-xl shadow-lg">
    {{ session('error') }}
    <button type="button"
    class="ms-auto -mx-1 -my-1 justify-center items-center flex-shrink-0 rounded-lg p-1.5 inline-flex h-8 w-8 text-gray-200 hover:text-white">
    <span class="sr-only">Close</span>
    <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
      <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
    </svg>
    </button>
  </div>
@endif

<!-- TODO: move this into a file later -->

<script>
  document.addEventListener('DOMContentLoaded', function () {
    const handlePopup = (popupId) => {
      const popup = document.getElementById(popupId);
      if (popup) {
        const closeButton = popup.querySelector('button');

        setTimeout(() => dismissPopUp(popup), 4000);
        closeButton.addEventListener('click', () => dismissPopUp(popup));
      }
    }

    const dismissPopUp = (popup) => {

      popup.classList.replace('animate-slide-in', 'animate-slide-out');
      popup.addEventListener('animationend', () => popup.remove(), {
        once: true,
      });
    }

    handlePopup('success-popup');
    handlePopup('error-popup');
  });
</script>