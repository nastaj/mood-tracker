const signupForm = document.getElementById('signupForm');
const errorDiv = document.getElementById('error');

async function signupUser() {
    const formData = new FormData(signupForm);

    const res = await fetch('../auth/signup.php', {
        method: 'POST',
        body: formData
    });

    console.log(formData);
    const data = await res.json();

    if (data.success) {
        window.location.href = '../pages/home.php';
    } else {
        errorDiv.textContent = data.message;
    }
}
