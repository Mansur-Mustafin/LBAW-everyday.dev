document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.getElementById('toggleTagSelector');
    const tagSelectorContainer = document.getElementById('tagSelectorContainer');
    const tagSelector = document.getElementById('tagSelector');
    const selectedTags = document.getElementById('selectedTags');
    const saveButton = document.getElementById('saveButton');
    const form = document.getElementById('editForm');

    // TODO: make as a class
    const followersToggle = document.getElementById('toggleTwo')
    const hiddenToggle = document.getElementById('hiddenToggle')

    if (form) {
    
    // TODO: make as a class
    followersToggle.addEventListener('change', function (evt) {
        hiddenToggle.value = this.checked ? 'true' : 'false'
    })
    
    window.toggleEdit = function() {
        const editButton = document.getElementById('edit-button');
        const saveCancelButtons = document.getElementById('save-cancel-buttons');
        const displaySection = document.getElementById('display-section');
        const editSection = document.getElementById('edit-section');
        const selectedTags = document.getElementById('selectedTags'); 
        const tagSelector = document.getElementById('tagSelector');

        displaySection.classList.toggle('hidden');
        editSection.classList.toggle('hidden');
        editButton.classList.toggle('hidden'); 
        saveCancelButtons.classList.toggle('hidden'); 

        const existingTagRemoveButtons = selectedTags.querySelectorAll('button[data-tag]');
        existingTagRemoveButtons.forEach((button) => {
            button.addEventListener('click', function () {
                const tagValue = this.dataset.tag;
                const tagElement = this.parentElement;
                selectedTags.removeChild(tagElement);
        
                const newOption = document.createElement('option');
                newOption.value = tagValue;
                newOption.textContent = tagValue;
                tagSelector.appendChild(newOption);
            });
        });
    };

    toggleButton.addEventListener('click', () => {
        if (tagSelectorContainer.style.display === 'none') {
            tagSelectorContainer.style.display = 'flex';
        } else {
            tagSelectorContainer.style.display = 'none';
        }
    });

    tagSelector.addEventListener('change', function () {
        const selectedTag = tagSelector.value;
        if (selectedTag) {
            const newTagElement = document.createElement('div');
            newTagElement.dataset.tag = selectedTag;
            newTagElement.classList.add('relative', 'inline-block', 'mr-2');
            newTagElement.innerHTML = `
                <span class="text-md text-gray-400 font-medium lowercase bg-input rounded-md">#${selectedTag.toLowerCase()}</span>
                <button type="button" class="absolute top-0 right-0 transform -translate-y-1/2 translate-x-1/2 bg-red-500 text-white rounded-full w-4 h-4 flex items-center justify-center text-xs hover:bg-red-600">
                    ×
                </button>
            `;

            const removeButton = newTagElement.querySelector('button');
            removeButton.addEventListener('click', function () {
                selectedTags.removeChild(newTagElement); 

                const newOption = document.createElement('option');
                newOption.value = selectedTag;
                newOption.textContent = selectedTag;
                tagSelector.appendChild(newOption);

                delete newTagElement.dataset.tag;
            });

            selectedTags.appendChild(newTagElement);

            for (let i = 0; i < tagSelector.options.length; i++) {
                if (tagSelector.options[i].value === selectedTag) {
                    tagSelector.remove(i);
                    tagSelector.value = '';
                    break;
                }
            }
        }
    });

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

    }

});