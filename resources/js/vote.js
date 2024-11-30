import { redirectToLogin, sendAjaxRequest } from "./utils";

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

document.addEventListener('DOMContentLoaded', function () {
    addVoteButtonBehaviour();
});

function addVoteButtonBehaviour() {
    const voteContainers = document.querySelectorAll('.vote-container');

    voteContainers.forEach(container => {
        const authenticated = container.dataset.authenticated === 'true';
        const upvoteButton = container.querySelector('.upvote-button');
        const downvoteButton = container.querySelector('.downvote-button');

        if (!authenticated) {
            upvoteButton.addEventListener('click', redirectToLogin);
            downvoteButton.addEventListener('click', redirectToLogin);
        } else {
            upvoteButton.addEventListener('click', function () {
                handleVote(container, true);
            });

            downvoteButton.addEventListener('click', function () {
                handleVote(container, false);
            });
        }
    });
}

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
    const url = '/vote'
    const method = 'POST'
    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
    }
    const body = JSON.stringify({
        type: type,
        id: id,
        is_upvote: isUpvote,
    })

    sendAjaxRequest(url, (data) => {
        if (data.message === 'Saved') {
            container.dataset.voteId = data.vote_id;
            container.dataset.vote = isUpvote ? 'upvote' : 'downvote';
            updateVoteUI(container, isUpvote, 'Saved');
        }
    },method,headers,body)
}

function removeVote(voteId, container) {
    const url = `/vote/${voteId}`
    const method = 'DELETE'

    sendAjaxRequest(url, (data) => {
        if (data.message === 'Vote removed') {
            updateVoteUI(container, null, 'Vote removed');
            container.dataset.voteId = '';
            container.dataset.vote = '';
        }
    },method)
}

function updateVote(voteId, isUpvote, container) {
    const url = `/vote/${voteId}`
    const method = 'PUT'
    const headers = {
        'Content-Type': 'application/json',
        'X-CSRF-TOKEN': csrfToken,
    }
    const body = JSON.stringify({
        is_upvote: isUpvote,
    })

    sendAjaxRequest(url,(data) => {
        if (data.message === 'Vote updated') {
            container.dataset.vote = isUpvote ? 'upvote' : 'downvote';
            container.dataset.voteId = data.vote_id;
            updateVoteUI(container, isUpvote, 'Vote updated');
        }
    },method,headers,body)
}

function updateVoteUI(container, isUpvote, message) {
    const postId = container.dataset.id;
    const type = container.dataset.type;

    const upvoteOutline = document.getElementById(`${type}-upvote-outline-${postId}`);
    const upvoteFill = document.getElementById(`${type}-upvote-fill-${postId}`);
    const downvoteOutline = document.getElementById(`${type}-downvote-outline-${postId}`);
    const downvoteFill = document.getElementById(`${type}-downvote-fill-${postId}`);
    const voteCountElement = container.querySelector('.vote-count');
    let currentCount = parseInt(voteCountElement.textContent);

    // Reset icons
    upvoteOutline.style.display = "block";
    upvoteFill.style.display = "none";
    downvoteOutline.style.display = "block";
    downvoteFill.style.display = "none";

    if (message === 'Saved') {
        if (isUpvote) {
            upvoteOutline.style.display = "none";
            upvoteFill.style.display = "block";
            voteCountElement.textContent = currentCount + 1;
        } else {
            downvoteOutline.style.display = "none";
            downvoteFill.style.display = "block";
            voteCountElement.textContent = currentCount - 1;
        }
    } else if (message === 'Vote updated') {
        if (isUpvote) {
            upvoteOutline.style.display = "none";
            upvoteFill.style.display = "block";
            voteCountElement.textContent = currentCount + 2;
        } else {
            downvoteOutline.style.display = "none";
            downvoteFill.style.display = "block";
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
