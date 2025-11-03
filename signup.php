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
    <title>Sign Up</title>
    <script src="./assets/js/signup.js" defer></script>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <div id="error" class="error"></div>

        <form id="signupForm">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="button" onclick="signupUser()">Sign Up</button>
        </form>

        <p>Already have an account? <a href="login.php">Log in here</a>.</p>
    </div>
</body>
</html>