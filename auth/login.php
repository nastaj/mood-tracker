<?php
// Start the session to manage user login state
session_start();

// Redirect to homepage if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: ../pages/home.php');
    exit();
}

$error = '';

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    include '../config/db_connect.php';

    // Retrieve and trim email and password from POST data
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate that both fields are filled
    if ($email === '' || $password === '') {
        $error = 'Please fill in all fields.';
    } else {
        // Prepare SQL statement to prevent SQL injection
        $stmt = $conn->prepare('SELECT user_id, username, email, password_hash FROM users WHERE email = ? LIMIT 1');
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user was found
        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();
            $storedHash = $user['password_hash'];

            // Verify the provided password against the stored hash
            if (password_verify($password, $storedHash)) {
                // Login success: set session variables
                $_SESSION['user_id']  = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email']    = $user['email'];

                // Redirect to homepage
                header('Location: ../pages/home.php');
                exit();
            }

            // No match found for the password
            $error = 'Invalid email or password.';
        } else {
            // No user found with the provided email
            $error = 'Invalid email or password.';
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/login.css">
    <title>Login - Mood Tracker</title>
</head>
<body>
    <h2>Login</h2>

    <!-- Display error message if there is one -->
    <?php if (!empty($error)): ?>
        <div class="error"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <!-- Submit to the same page -->
    <form method="POST" action="">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>
        
        <button type="submit">Login</button>
    </form>

    <div class="links">
        <p><a href="signup.php">Don't have an account? Sign up</a></p>
    </div>
</body>
</html>