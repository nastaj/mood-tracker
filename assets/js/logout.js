async function logout() {
    try {
        await fetch('./auth/logout.php', {
            method: 'POST'
        });
        window.location.href = 'login.php';
    } catch (error) {
        console.error(error);
    }
}