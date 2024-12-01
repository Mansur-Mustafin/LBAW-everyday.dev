const toggleTwoDiv = document.getElementsByClassName('toggleTwo')[0]
const hiddenToggle = document.getElementById('hiddenToggle')

if(toggleTwoDiv) {
  const name = toggleTwoDiv.dataset.name ?? ''
  const initialValue = toggleTwoDiv.dataset.initialvalue == 'true'
  const html = `
  <label for="toggleTwo"
      class="flex items-center cursor-pointer select-none text-dark dark:text-white gap-2 text-sm">
      <div class="relative">
          <input type="checkbox" id="toggleTwo" class="peer sr-only" />
          <div class="block h-8 rounded-full dark:bg-dark-2 bg-input w-14"></div>
          <div
              class="absolute w-6 h-6 transition bg-white rounded-full dot dark:bg-dark-4 left-1 top-1 peer-checked:translate-x-full peer-checked:bg-purple-900">
          </div>
      </div>
      ${name}
  </label>
  `
  toggleTwoDiv.innerHTML += html
  const toggleTwo = document.getElementById('toggleTwo')

  toggleTwo.checked = initialValue

  toggleTwo.addEventListener('change', (_event) => {
    hiddenToggle.value = toggleTwo.checked ? 'true' : 'false'
  })
}