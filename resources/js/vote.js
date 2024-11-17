const upvoteButtons = document.querySelectorAll('.upvote-button');
const downvoteButtons = document.querySelectorAll('.downvote-button');
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


upvoteButtons.forEach(button => {
    button.addEventListener('click', function() {
        const postId = button.dataset.id;
        const voteId = button.dataset.voteId;
        const vote = button.dataset.vote;

        if (voteId && vote === 'upvote') {
            // Remove upvote
            removeVote(voteId, button);
        } else if (voteId && vote === 'downvote') {
            // Change from downvote to upvote
            updateVote(voteId, true, button);
        } else {
            // New upvote
            submitVote('post', postId, true, button);
        }
    });
});


downvoteButtons.forEach(button => {
    button.addEventListener('click', function() {
        const postId = button.dataset.id;
        const voteId = button.dataset.voteId;
        const vote = button.dataset.vote;

        if (voteId && vote === 'downvote') {
            // Remove downvote
            removeVote(voteId, button);
        } else if (voteId && vote === 'upvote') {
            // Change from upvote to downvote
            updateVote(voteId, false, button);
        } else {
            // New downvote
            submitVote('post', postId, false, button);
        }
    });
});





function submitVote(type, id, isUpvote, button) {
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
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Saved') {
            button.dataset.voteId = data.vote_id;
            // updateVoteUI(button, isUpvote, 'Saved');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


function removeVote(voteId, button) {
    fetch(`/vote/${voteId}`, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': csrfToken,
        },
    })
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Vote removed') {
            button.dataset.voteId = '';
            // updateVoteUI(button, null, 'Vote removed');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}


function updateVote(voteId, isUpvote, button) {
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
    .then(response => response.json())
    .then(data => {
        if (data.message === 'Vote updated') {
            button.dataset.voteId = data.vote_id;
            // updateVoteUI(button, isUpvote, 'Vote updated');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
