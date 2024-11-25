const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
const followButtons = document.querySelectorAll('.follow-button');

if (followButtons) {

followButtons.forEach(button => {
    button.addEventListener('click', function(e) {
        e.preventDefault();

        const userId = this.getAttribute('data-user-id');
        const action = this.getAttribute('data-action');
        let url = '';
        let method = '';

        if (action === 'follow') {
            url = `/users/${userId}/follow`;
            method = 'POST';
        } else if (action === 'unfollow') {
            url = `/users/${userId}/unfollow`;
            method = 'DELETE';
        }

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
            },
            credentials: 'same-origin',
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            }
        })
        .then(data => {
            console.log(data);
            // Toggle action and button text
            if (action === 'follow') {
                this.setAttribute('data-action', 'unfollow');
                this.textContent = 'Unfollow';
            } else if (action === 'unfollow') {
                this.setAttribute('data-action', 'follow');
                this.textContent = 'Follow';
            }
        })
        .catch(error => {
            console.log("Error",error)
        });
    });
});

}
