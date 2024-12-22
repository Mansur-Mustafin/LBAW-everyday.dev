import Quill from 'quill';
import { uploadBase64Image, transformLoadingButton, sendAjaxRequest } from './utils';
import 'quill/dist/quill.snow.css';

const createForm = document.getElementById('createForm');
const editForm = document.getElementById('editForm');

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

const content_create = document.getElementById('create-content-input');
const editor_create = document.getElementById('editor-create-container');

const editor_edit = document.getElementById('editor-edit-container');
const content_edit = document.getElementById('edit-content-input');

const saveButton = document.getElementById('saveButton');

const content_images_create = document.getElementById('content-images-create');
const content_images_edit = document.getElementById('content-images-edit');

const toolbarOptions = [
  //   header options
  [{ size: ['huge', 'large', false, 'small'] }],

  // text utilities
  ['bold', 'italic', 'underline', 'strike'],

  // text colors and bg colors
  [{ color: [] }, { background: [] }],

  // lists
  [{ list: 'ordered' }, { list: 'bullet' }, { list: 'check' }, { align: [] }],

  // block quotes and code blocks
  ['blockquote', 'code-block'],

  // media
  ['link', 'image'],
];

if (createForm) {
  // just creates the rich text editor in editor_create div
  const quill = new Quill(editor_create, {
    modules: {
      toolbar: toolbarOptions,
    },
    theme: 'snow',
    placeholder: 'Content*',
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      e.target.blur();
    }
  });

  document
    .querySelector('.ql-toolbar')
    .classList.add('rounded-xl', '!p-4', 'my-4', '!border-1', '!border-gray-700'); // styles the toolbar, ! is important to override the default styles

  document.querySelector('.ql-editor').innerHTML = document.querySelector('#old-content').value;

  // this is the second submit event listener to this form and is the one that submits it.
  // it iterates through all images and replaces the src path to the one created when the image is uploaded.
  createForm.addEventListener('submit', async (evt) => {
    evt.preventDefault();

    const isValid = await validateForm(createForm, false, null);
    if (!isValid) {
      return;
    }

    transformLoadingButton(createForm.querySelector('#post-button'));

    const imagesNotUploaded = Array.from(quill.root.querySelectorAll('img[src^="data:"]'));

    await Promise.all(getImagesPaths(imagesNotUploaded)); // had to do with a promise, otherwise the attribution below would be executed before all the images were uploaded.

    content_images_create.value = imagesNotUploaded
      .map((image) => 'post/' + image.src.split('post/')[1])
      .join(',');

    content_create.value = quill.root.innerHTML; // stores the html in a hidden input to send to laravel

    createForm.submit();
  });
}

if (editForm) {
  const quill = new Quill(editor_edit, {
    modules: {
      toolbar: toolbarOptions,
    },
    theme: 'snow',
  });

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      e.target.blur();
    }
  });

  document
    .querySelector('.ql-toolbar')
    .classList.add('rounded-xl', '!p-4', 'my-4', '!border-1', '!border-gray-700');

  if (saveButton) {
    saveButton.addEventListener('click', async (evt) => {
      evt.preventDefault();

      const isValid = await validateForm(editForm, true, editForm.dataset.post_id);
      if (!isValid) {
        return;
      }

      const imagesNotUploaded = Array.from(quill.root.querySelectorAll('img[src^="data:"]'));

      await Promise.all(getImagesPaths(imagesNotUploaded));

      const images = quill.root.querySelectorAll('img');

      content_images_edit.value = Array.from(images).map(
        (img) => 'post/' + img.src.split('post/')[1]
      );

      content_edit.value = quill.root.innerHTML;
      editForm.submit();
    });
  }
}

// utils

function getImagesPaths(images) {
  return images.map(async (image) => {
    const data = await uploadImage(image.src);
    image.src = data.path;
  });
}

async function uploadImage(source) {
  const url = '/file/upload';
  const method = 'POST';
  const headers = {
    'X-CSRF-TOKEN': csrfToken,
  };

  const blob = uploadBase64Image(source);

  // json stringify does not work here because of the image
  const formData = new FormData();

  // it is impossible to know what is the model_id here, once the post is not created yet. we need to figure out a way to handle this or keep this at 1 to all content photos
  // maybe one way to deal with it is simply not require model_id to be passed at all
  formData.append('image', blob, 'image.png');

  // i had to do my own fetch without sendAjaxRequest because i needed the response to be returned in this function and not in the handler
  try {
    const response = await fetch(url, {
      method: method,
      headers: headers,
      body: formData,
    });

    if (response.ok) {
      return response.json();
    }
  } catch (error) {}
}

const validateForm = async (createForm, isUpdate, postId = null) => {
  const titleInput = createForm.querySelector('#title');
  const titleError = createForm.querySelector('#title-error');

  titleError.classList.add('hidden');
  titleInput.classList.remove('border-red-500', 'border');

  if (titleInput.value.trim() === '') {
    titleError.textContent = 'Title cannot be empty.';
    titleError.classList.remove('hidden');
    titleInput.classList.add('border', 'border-red-500');
    return false;
  }

  const isTitleValid = await checkTitleAvailability(titleInput.value, isUpdate, postId);
  if (!isTitleValid) {
    titleError.textContent = 'A post with this title already exists.';
    titleError.classList.remove('hidden');
    titleInput.classList.add('border', 'border-red-500');
    return false;
  }

  return true;
};

const checkTitleAvailability = (title, isUpdate, postId = null) => {
  return new Promise((resolve, reject) => {
    const payload = { title };
    if (isUpdate && postId) {
      payload.post_id = postId;
    }

    sendAjaxRequest(
      '/check-title',
      (data) => {
        resolve(!data.exists);
      },
      'POST',
      {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      },
      JSON.stringify(payload),
      (errorMessage) => {
        console.error('Error checking title:', errorMessage);
        reject(false);
      }
    );
  });
};
