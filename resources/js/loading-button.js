export const tranformLoadingButton = (button) => {
  
  button.classList.remove(
    'text-input',
    'bg-white',
    'font-bold',
    'px-6',
    'py-2',
  )

  button.classList.add(
    'text-gray-100',
    'font-semibold',
    'pr-3',
    'py-1',
    'bg-[#4C4B63]',
    'flex',
    'items-center',
    'justify-center'
  )

  button.disabled = true;

  button.innerHTML = `
      <img class="w-8 h-8" src="/assets/loading-icon.gif" alt="Loading...">
      Sending...
    `;
};

document.addEventListener('DOMContentLoaded', () => {
  document.querySelectorAll('.loading-button').forEach((button) => {    
    button.addEventListener('click', () => {
      const clickedButton = event.target;
      setTimeout(() => {
        tranformLoadingButton(clickedButton);
      }, 0);
    });
  });
});
