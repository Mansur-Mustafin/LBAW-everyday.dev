import { tranformLoadingButton } from './utils.js'

document.querySelectorAll('.loading-button').forEach((button) => {
  const form = button.closest('form');
  
  form.addEventListener('submit', (event) => {
    
    if (!form.checkValidity()) {
      event.preventDefault();
      return;
    }

    tranformLoadingButton(button);
  });
});
