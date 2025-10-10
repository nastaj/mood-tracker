const form = document.getElementById('loginForm');
const errorDiv = document.getElementById('error');

async function loginUser() {
    const formData = new FormData(form);

    const res = await fetch('../auth/login.php', {
        method: 'POST',
        body: formData
    });

    // Expect JSON from PHP
    const data = await res.json();

    if (data.success) {
        window.location.href = '../pages/home.php';
    } else {
        errorDiv.textContent = data.message;
    }
};
