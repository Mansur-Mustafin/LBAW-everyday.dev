window.toggleEdit = function() {
    const editButton = document.getElementById('edit-button');
    const saveCancelButtons = document.getElementById('save-cancel-buttons');
    const displaySection = document.getElementById('display-section');
    const editSection = document.getElementById('edit-section');

    displaySection.classList.toggle('hidden');
    editSection.classList.toggle('hidden');
    editButton.classList.toggle('hidden');
    saveCancelButtons.classList.toggle('hidden');
};

const saveButton = document.getElementById('saveButton');
const form = document.getElementById('editForm');

saveButton.addEventListener('click', function(evt) {
    evt.preventDefault()


    const selectedTags = document.getElementById('selectedTags')

    let post_tags = [];

    Array.from(selectedTags.children).forEach((child) => {
        post_tags.push(child.dataset.tag);
    });

    if (post_tags.length > 0) {
        document.getElementById('tagsInput').value = post_tags.join(',');
    }

    form.submit();
});

document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('toggleTagSelector');
    const tagSelectorContainer = document.getElementById('tagSelectorContainer');
    const tagSelector = document.getElementById('tagSelector');
    const selectedTags = document.getElementById('selectedTags');

    toggleButton.addEventListener('click', () => {
        if (tagSelectorContainer.style.display === 'none') {
            tagSelectorContainer.style.display = 'flex';
        } else {
            tagSelectorContainer.style.display = 'none';
        }
    });

    tagSelector.addEventListener('change', function() {
        const selectedTag = tagSelector.value;
        if (selectedTag) {
            const newTagElement = document.createElement('span');
            newTagElement.dataset.tag = selectedTag;
            newTagElement.classList.add('text-md', 'text-gray-400', 'font-medium', 'lowercase', 'bg-input', 'px-3', 'rounded-md');
            newTagElement.textContent = '#' + selectedTag.toLowerCase();

            selectedTags.appendChild(newTagElement)

            

            for (let i = 0; i < tagSelector.options.length; i++) {
                if (tagSelector.options[i].value === selectedTag) {
                    tagSelector.remove(i);
                    tagSelector.value = ''
                    break;
                }
            }
        }
    });
});