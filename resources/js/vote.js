const upvoteButtons = document.querySelectorAll('.upvote-button');
const downvoteButtons = document.querySelectorAll('.downvote-button');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

upvoteButtons.forEach(button => {
    button.addEventListener('click', function() {
        const postId = button.dataset.id;

        document.getElementById(`upvote-outline-${postId}`).classList.add('hidden');
        document.getElementById(`upvote-fill-${postId}`).classList.remove('hidden');

        vote(this.dataset.type, this.dataset.id, true, this);
    });
});

downvoteButtons.forEach(button => {
    button.addEventListener('click', function() {
        const postId = button.dataset.id;

        document.getElementById(`downvote-outline-${postId}`).classList.add('hidden');
        document.getElementById(`downvote-fill-${postId}`).classList.remove('hidden');

        vote(this.dataset.type, this.dataset.id, false, this);
    });
});

function vote(type, id, isUpvote, button) {
    console.log(type, id, isUpvote, button);
    
    fetch('/vote', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            type: type,
            id: id,
            is_upvote: isUpvote,
        }),
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else if (response.status === 401) {
            alert('You need to log in to vote.');
        }
    })
    .then(data => {
        if (data && data.message === 'Saved') {
            const voteCountElement = button.parentElement.querySelector('.vote-count');
            const currentCount = parseInt(voteCountElement.textContent);

            if (isUpvote) {
                voteCountElement.textContent = currentCount + 1;
            } else {
                voteCountElement.textContent = currentCount - 1;
            }
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}