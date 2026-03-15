function getCsrfToken() {
  const meta = document.querySelector('meta[name="csrf-token"]');
  return meta ? meta.getAttribute('content') : '';
}

document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('register-form');
    const errorMsg = document.getElementById('error-msg');

    if (!form) return;

    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(form);

        fetch('/register-custom', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': getCsrfToken()
            },
            body: JSON.stringify({
                name: formData.get('fullName') || formData.get('username'),
                email: formData.get('email'),
                password: formData.get('password'),
                password_confirmation: formData.get('password')
            })
        })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    window.location.href = data.redirect || '/';
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
