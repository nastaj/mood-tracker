<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    include '../config/db_connect.php';

    // Retrieve and trim user input
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate input fields
    if ($username === '' || $email === '' || $password === '') {
        $error = 'Please fill in all fields';
    } else {
        // Prepare a statement to check for duplicate emails
        $chk = $conn->prepare('SELECT user_id FROM users WHERE email = ? LIMIT 1');
        $chk->bind_param('s', $email);
        $chk->execute();
        $r = $chk->get_result();

        // Check if the email is already registered
        if ($r && $r->num_rows > 0) {
            $error = 'Email already registered.';
            $chk->close();
            $conn->close();
        } else {
            $chk->close();

            // Hash the password
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Prepare an insert statement for new user registration
            $ins = $conn->prepare('INSERT INTO users (username, password_hash, email, created_at) VALUES (?, ?, ?, NOW())');
            $ins->bind_param('sss', $username, $passwordHash, $email);

            // Execute the insert statement
            if ($ins->execute()) {
                // Get the newly created user ID
                $user_id = $ins->insert_id;

                // Set session variables for the logged-in user
                $_SESSION['user_id']  = $user_id;
                $_SESSION['username'] = $username;
                $_SESSION['email']    = $email;

                $ins->close();
                $conn->close();

                 // Redirect to home page
                header('Location: ../pages/home.php');
                exit();
            } else {
                $error = 'Registration failed: ' . $ins->error;
                $ins->close();
                $conn->close();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>

         <!-- Display error message if exists -->
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <input type="submit" value="Sign Up">
        </form>
        <p>Already have an account? <a href="login.php">Log in here</a>.</p>
    </div>
</body>
</html>