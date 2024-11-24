const voteContainers = document.querySelectorAll('.vote-container');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

voteContainers.forEach(container => {
    const authenticated = container.dataset.authenticated === 'true';
    const upvoteButton = container.querySelector('.upvote-button');
    const downvoteButton = container.querySelector('.downvote-button');
    const voteCountElement = container.querySelector('.vote-count');

    if (!authenticated) {
        upvoteButton.addEventListener('click', redirectToLogin);
        downvoteButton.addEventListener('click', redirectToLogin);
    } else {
        upvoteButton.addEventListener('click', function() {
            handleVote(container, true);
        });

        downvoteButton.addEventListener('click', function() {
            handleVote(container, false);
        });
    }
});

function handleVote(container, isUpvote) {
    const type = container.dataset.type;
    const itemId = container.dataset.id;
    let voteId = container.dataset.voteId;
    const currentVote = container.dataset.vote;

    if (voteId) {
        if ((isUpvote && currentVote === 'upvote') || (!isUpvote && currentVote === 'downvote')) {
            removeVote(voteId, container);
        } else {
            updateVote(voteId, isUpvote, container);
        }
    } else {
        submitVote(type, itemId, isUpvote, container);
    }
}

function submitVote(type, id, isUpvote, container) {
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
            redirectToLogin();
        }
    })
    .then(data => {
        if (data.message === 'Saved') {
            container.dataset.voteId = data.vote_id;
            container.dataset.vote = isUpvote ? 'upvote' : 'downvote';
            updateVoteUI(container, isUpvote, 'Saved');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function removeVote(voteId, container) {
    fetch(`/vote/${voteId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else if (response.status === 401) {
            redirectToLogin();
        }
    })
    .then(data => {
        if (data.message === 'Vote removed') {
            updateVoteUI(container, null, 'Vote removed');
            container.dataset.voteId = '';
            container.dataset.vote = '';
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function updateVote(voteId, isUpvote, container) {
    fetch(`/vote/${voteId}`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
        },
        body: JSON.stringify({
            is_upvote: isUpvote,
        }),
    })
    .then(response => {
        if (response.ok) {
            return response.json();
        } else if (response.status === 401) {
            redirectToLogin();
        }
    })
    .then(data => {
        if (data.message === 'Vote updated') {
            container.dataset.vote = isUpvote ? 'upvote' : 'downvote';
            container.dataset.voteId = data.vote_id;
            updateVoteUI(container, isUpvote, 'Vote updated');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}

function updateVoteUI(container, isUpvote, message) {
    const postId = container.dataset.id;
    const upvoteOutline = container.querySelector(`#upvote-outline-${postId}`);
    const upvoteFill = container.querySelector(`#upvote-fill-${postId}`);
    const downvoteOutline = container.querySelector(`#downvote-outline-${postId}`);
    const downvoteFill = container.querySelector(`#downvote-fill-${postId}`);
    const voteCountElement = container.querySelector('.vote-count');

    if (!voteCountElement) {
        console.warn(`Vote count element not found for container with ID: ${postId}`);
    } else {
        let currentCount = parseInt(voteCountElement.textContent);

        if (message === 'Saved') {
            if (isUpvote) {
                voteCountElement.textContent = currentCount + 1;
            } else {
                voteCountElement.textContent = currentCount - 1;
            }
        } else if (message === 'Vote updated') {
            if (isUpvote) {
                voteCountElement.textContent = currentCount + 2;
            } else {
                voteCountElement.textContent = currentCount - 2;
            }
        } else if (message === 'Vote removed') {
            if (container.dataset.vote === 'upvote') {
                voteCountElement.textContent = currentCount - 1;
            } else if (container.dataset.vote === 'downvote') {
                voteCountElement.textContent = currentCount + 1;
            }
        }
    }

    // Reset icons
    upvoteOutline.classList.remove('hidden');
    upvoteFill.classList.add('hidden');
    downvoteOutline.classList.remove('hidden');
    downvoteFill.classList.add('hidden');

    if (message === 'Saved') {
        if (isUpvote) {
            upvoteOutline?.classList.add('hidden');
            upvoteFill?.classList.remove('hidden');
        } else {
            downvoteOutline?.classList.add('hidden');
            downvoteFill?.classList.remove('hidden');
        }
    } else if (message === 'Vote updated') {
        if (isUpvote) {
            upvoteOutline?.classList.add('hidden');
            upvoteFill?.classList.remove('hidden');
        } else {
            downvoteOutline?.classList.add('hidden');
            downvoteFill?.classList.remove('hidden');
        }
    }
}

function redirectToLogin() {
    const currentUrl = window.location.href;

    const loginUrl = `/login?redirect=${encodeURIComponent(currentUrl)}`;

    window.location.href = loginUrl;
}
