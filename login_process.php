<?php
// Start the session
session_start();
include "config.php"; // Include your database connection

// Function to handle user login
function loginUser($conn, $login, $password) {
    // Prepare the SQL statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ?");
    $stmt->bind_param("ss", $login, $login);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        // Verify the password
        if (password_verify($password, $row['password'])) {
            // Set session variables
            $_SESSION['username'] = $row['username'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role']; // Assuming the role is stored in the database

            // Redirect based on user role
            if ($_SESSION['role'] === 'admin') {
                header("Location: admin_board.php");
            } else {
                header("Location: index.php"); // Redirect regular users to index.php
            }
            exit; // Make sure to call exit after redirection
        } else {
            return "Incorrect password!";
        }
    } else {
        return "User not found!";
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $login = $_POST['login']; // Combined username or email
    $pass = $_POST['password'];

    // Validate inputs
    if (empty($login) || empty($pass)) {
        echo "All fields are required!";
        exit;
    }

    // Call the login function
    $error_message = loginUser($conn, $login, $pass);
    if ($error_message) {
        echo $error_message;
    }
}

// Close the database connection
$conn->close();
?>
