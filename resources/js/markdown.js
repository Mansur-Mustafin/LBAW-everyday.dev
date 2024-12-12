import Quill from 'quill';
import { uploadBase64Image } from './utils';
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
  [{ header: [1, 2, 3] }],

  // text utilities
  ['bold', 'italic', 'underline', 'strike'],

  // text colors and bg colors
  [{ color: [] }, { background: [] }],

  // lists
  [{ list: 'ordered' }, { list: 'bullet' }, { list: 'check' }],

  // block quotes and code blocks
  ['blockquote', 'code-block'],

  // media
  ['link', 'image'],

  // alignment
  [{ align: [] }],
];

if (createForm) {
  // just creates the rich text editor in editor_create div
  const quill = new Quill(editor_create, {
    modules: {
      toolbar: toolbarOptions,
    },
    theme: 'snow',
  });

  document
    .querySelector('.ql-toolbar')
    .classList.add('rounded-xl', '!p-4', 'my-4', '!border-1', '!border-gray-700'); // styles the toolbar, ! is important to override the default styles

  // this is the second submit event listener to this form and is the one that submits it.
  // it iterates through all images and replaces the src path to the one created when the image is uploaded.
  createForm.addEventListener('submit', async (_) => {
    const imagesNotUploaded = Array.from(quill.root.querySelectorAll('img[src^="data:"]'));

    await Promise.all(getImagesPaths(imagesNotUploaded)); // had to do with a promise, otherwise the attribution below would be executed before all the images were uploaded.

    content_images_create.value = imagesNotUploaded
      .map((image) => 'post/' + image.src.split('post/')[1])
      .join(',');

    console.log(content_images_create.value);

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

  document
    .querySelector('.ql-toolbar')
    .classList.add('rounded-xl', '!p-4', 'my-4', '!border-1', '!border-gray-700');

  if (saveButton) {
    saveButton.addEventListener('click', async (_) => {
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
  } catch (error) {
    console.log(error);
  }
}
