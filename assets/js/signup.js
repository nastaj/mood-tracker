const signupForm = document.getElementById('signupForm');

function clearErrors() {
    document.querySelectorAll(".error-text").forEach(el => el.textContent = "");
}

async function signupUser() {
    const formData = new FormData(signupForm);

    const res = await fetch('auth/signup.php', {
        method: 'POST',
        body: formData
    });

    console.log(formData);
    const data = await res.json();

    if (data.success) {
        window.location.href = 'home.php';
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
}
