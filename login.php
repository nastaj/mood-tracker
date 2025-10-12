<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header('Location: home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mood Tracker</title>
    <script src="./assets/js/login.js" defer></script>
</head>
<body>
    <h2>Login</h2>
    <div id="error" class="error"></div>

    <form id="loginForm">
        <label>Email:</label>
        <input type="email" name="email" required>

        <label>Password:</label>
        <input type="password" name="password" required>
        
        <button type="button" onclick="loginUser()">Login</button>
    </form>

    <p><a href="signup.php">Don't have an account? Sign up</a></p>
</body>
</html>