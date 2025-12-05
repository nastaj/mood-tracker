const form = document.getElementById('loginForm');

function clearErrors() {
    document.querySelectorAll(".error-text").forEach(el => el.textContent = "");
}

async function loginUser() {
    const formData = new FormData(form);

    const res = await fetch('./auth/login.php', {
        method: 'POST',
        body: formData
    });

    // Expect JSON from PHP
    const data = await res.json();

    if (data.success) {
        window.location.href = './home.php';
    } else {
        // Clear previous error messages
        clearErrors();

        // Display new error messages
        for (const field in data.errors) {
            const errorSpan = document.getElementById(`error-${field}`);
            if (errorSpan) {
                errorSpan.textContent = data.errors[field];
            }
        }
    }
};
