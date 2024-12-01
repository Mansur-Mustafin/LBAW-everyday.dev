@if(session('success'))
   <div id="success-popup" class="fixed bottom-4 right-4 bg-green-900 text-white p-4 rounded-xl shadow-lg">
      {{ session('success') }}
   </div>

   <!-- TODO: move this into a file later -->

   <script>
      document.addEventListener('DOMContentLoaded', function () {
        let successPopup = document.getElementById('success-popup');
        if (successPopup) {
          setTimeout(function () {
            successPopup.classList.add('hidden');
          }, 4000);
        }
      });
   </script>
@endif