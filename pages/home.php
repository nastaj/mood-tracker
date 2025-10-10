<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mood Tracker | Home</title>
</head>
<body>
    <h1>Welcome to the Mood Tracker Home Page</h1>
    <p>This is a placeholder for the home page content.</p>
</body>
</html>