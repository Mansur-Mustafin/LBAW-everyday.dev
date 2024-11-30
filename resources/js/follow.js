document.addEventListener('DOMContentLoaded', function () {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.addEventListener('click', function (e) {
        const target = e.target;

        if (target && target.classList.contains('follow-button')) {
            e.preventDefault();

            const userId = target.dataset.userId;
            const action = target.dataset.action;
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
                //credentials: 'same-origin',
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                }
            })
            .then(data => {
                console.log(data);
                if (action === 'follow') {
                    target.textContent = 'Unfollow';
                    target.dataset.action = 'unfollow';
                } else if (action === 'unfollow') {
                    target.dataset.action = 'follow';
                    target.textContent = 'Follow';
                }
            })
            .catch(error => {
                console.log("Error",error)
            });
        }
    });
});
