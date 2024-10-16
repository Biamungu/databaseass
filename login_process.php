<?php
// Start the session
session_start();
include "config.php";





// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data
    $user = $_POST['username'];
    $email = $_POST['email'];
    $pass = $_POST['password'];

    // Validate inputs
    if (empty($user) || empty($email) || empty($pass)) {
        echo "All fields are required!";
        exit;
    }

    // Hash the password for security
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

    // Check if the user already exists
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Email already registered!";
    } else {
        // Insert new user into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "Account created successfully!";
            // Redirect to login page or another page
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>

