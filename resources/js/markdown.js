import Quill from 'quill';
import 'quill/dist/quill.snow.css';
import 'quill/dist/quill.bubble.css';

const toolbarOptions = [
  // font options
  [{ font: [] }],

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
  ['link', 'image', 'video'],

  // alignment
  [{ align: [] }],
];

const create_editor = document.querySelector('#editor-create-container');
if (create_editor) {
  const quill = new Quill(create_editor, {
    modules: {
      toolbar: toolbarOptions,
    },
    theme: 'snow',
  });

  document
    .querySelector('.ql-toolbar')
    .classList.add('rounded-xl', '!p-4', 'my-4', '!border-1', '!border-gray-700');
}

const edit_editor = document.querySelector('#editor-edit-container');
if (edit_editor) {
  const quill = new Quill(edit_editor, {
    modules: {
      toolbar: toolbarOptions,
    },
    theme: 'snow',
  });

  document
    .querySelector('.ql-toolbar')
    .classList.add('rounded-xl', '!p-4', 'my-4', '!border-1', '!border-gray-700');
}
