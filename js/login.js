document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('login-form');
    const errorMsg = document.getElementById('error-msg');

    if (!form) return;

    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(form);

        fetch('api/login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                username: formData.get('username'),
                password: formData.get('password')
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    const redirect = new URLSearchParams(window.location.search).get('redirect');
                    window.location.href = redirect === 'cart' ? 'cart.html' : 'index.html';
                } else {
                    if (errorMsg) {
                        errorMsg.textContent = data.error || 'Login failed. Please try again.';
                        errorMsg.classList.remove('hidden');
                    }
                }
            })
            .catch(err => {
                console.error('Login error:', err);
                if (errorMsg) {
                    errorMsg.textContent = 'Something went wrong. Please try again.';
                    errorMsg.classList.remove('hidden');
                }
            });
    });
});
