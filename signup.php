<?php
session_start();

// Include the database connection file
require 'config.php'; // Assuming you have a config.php for database connection

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role']; // Get the user role from the form

    // Basic validation
    if ($password != $confirm_password) {
        $error_message = "Passwords do not match!";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare and bind SQL statement to insert user data
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $hashed_password, $role); // Include role in binding

        if ($stmt->execute()) {
            // Redirect to login page after successful registration
            header("Location: login.php");
            exit();
        } else {
            $error_message = "Error: Could not save user. This might be due to a duplicate username or email.";
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="center-container">
<div class="sing_up">
    <h2 >Sign Up</h2>

    <?php if (isset($error_message)): ?>
        <p style="color:red;"><?php echo $error_message; ?></p>
    <?php endif; ?>

    <!-- Sign-Up Form -->
    <form action="signup.php" method="POST">
        <label for="username">Username:</label><br>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <label for="role">Role:</label><br>
        <select id="role" name="role" required>
            <option value="user">User</option>
            <option value="admin">Admin</option>
        </select><br><br>

        <input type="submit" value="Sign Up">
    </form>

    <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </div>
    </div>
</body>
</html>
