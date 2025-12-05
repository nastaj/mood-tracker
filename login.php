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
<link href="./assets/css/output.css" rel="stylesheet">
<script src="./assets/js/login.js" defer></script>
</head>
<body class="bg-background flex items-center justify-center min-h-screen font-sans">

    <div class="bg-card-bg shadow-xl rounded-2xl w-full max-w-md p-8 flex flex-col items-center">
        <h1 class="text-4xl font-bold text-primary mb-6">Welcome Back</h1>
        <p class="text-text-secondary mb-6 text-center">Log in to continue tracking your mood.</p>

        <form id="loginForm" class="w-full flex flex-col gap-4">
            <div class="flex flex-col">
                <div class="flex justify-between">
                    <label for="email" class="font-medium mb-1">Email</label>
                    <span class="text-red-500 error-text" id="error-email"></span>
                </div>
                <input type="email" id="email" name="email" required
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:outline-none transition">
            </div>

            <div class="flex flex-col">
                <div class="flex justify-between">
                    <label for="password" class="font-medium mb-1">Password</label>
                    <span class="text-red-500 error-text" id="error-password"></span>
                </div>
                <input type="password" id="password" name="password" required
                    class="border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-primary focus:outline-none transition">
            </div>

            <button type="button" onclick="loginUser()"
                class="mt-4 bg-primary hover:bg-secondary text-white font-semibold rounded-lg px-4 py-2 transition hover:cursor-pointer">Login</button>
        </form>

        <p class="text-text-secondary mt-6">Don't have an account? 
            <a href="signup.php" class="text-primary font-semibold hover:underline">Sign up</a>
        </p>
    </div>
</body>
</html>
