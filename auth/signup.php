<?php
session_start();
header('Content-Type: application/json'); // JSON output

$response = ['success' => false, 'message' => 'Unknown error'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Connect to the database
    include '../config/db_connect.php';

    // Retrieve and trim user input
    $username = trim($_POST['username'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    // Validate input fields
    if ($username === '' || $email === '' || $password === '') {
        $response['message'] = 'Please fill in all fields.';
    } else {
        // Prepare a statement to check for duplicate emails
        $chk = $conn->prepare('SELECT user_id FROM users WHERE email = ? LIMIT 1');
        $chk->bind_param('s', $email);
        $chk->execute();
        $r = $chk->get_result();

        // Check if the email is already registered
        if ($r && $r->num_rows > 0) {
            $response['message'] = 'Email already registered.';
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

                // Respond with success
                $response['success'] = true;
                echo json_encode($response);
                exit();
            } else {
                $response['message'] = 'Registration failed: ' . $ins->error;
                $ins->close();
                $conn->close();
            }
        }
    }
}

echo json_encode($response);
exit();
?>

