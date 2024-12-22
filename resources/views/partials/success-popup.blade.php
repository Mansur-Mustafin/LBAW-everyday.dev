@if(session('success'))
  <div id="success-popup"
    class="animate-slide-in flex flex-row justify-start fixed bottom-4 right-4 bg-green-900 text-white p-4 rounded-xl shadow-lg">
    {{ session('success') }}
    <button type="button"
    class="ms-auto -mx-1 -my-1 justify-center items-center flex-shrink-0 rounded-lg p-1.5 inline-flex h-8 w-8 text-gray-200 hover:text-white">
    <span class="sr-only">Close</span>
    @include('partials.svg.cross')
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
    @include('partials.svg.cross')
    </button>
  </div>
@endif


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const handlePopup = (popupId) => {
      const popup = document.getElementById(popupId);
      if (popup) {
        const closeButton = popup.querySelector('button');
        console.log(popup);

        setTimeout(() => dismissPopUp(popup), 4000);
        closeButton.addEventListener('click', () => dismissPopUp(popup));
      }
    }

    const dismissPopUp = (popup) => {
      console.log(popup);

      popup.classList.replace('animate-slide-in', 'animate-slide-out');
      popup.addEventListener('animationend', () => popup.remove(), {
        once: true,
      });
    }

    handlePopup('success-popup');
    handlePopup('error-popup');
  });
</script>