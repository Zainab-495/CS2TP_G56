document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('register-form');
    const errorMsg = document.getElementById('error-msg');

    if (!form) return;

    form.addEventListener('submit', (e) => {
        e.preventDefault();

        const formData = new FormData(form);

        fetch('api/register.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({
                username: formData.get('username'),
                email: formData.get('email'),
                password: formData.get('password'),
                fullName: formData.get('fullName')
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'index.html';
                } else {
                    if (errorMsg) {
                        errorMsg.textContent = data.error || 'Registration failed.';
                        errorMsg.classList.remove('hidden');
                    }
                }
            })
            .catch(err => {
                console.error('Registration error:', err);
                if (errorMsg) {
                    errorMsg.textContent = 'Something went wrong. Please try again.';
                    errorMsg.classList.remove('hidden');
                }
            });
    });
});
