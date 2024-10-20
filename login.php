<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // You can add the login process here if necessary, but it will be handled in the login_process.php file
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php require "header.php"; ?>

    <h2>Login</h2>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>
    
    <form action="login_process.php" method="POST">
    <label for="login">Username or Email:</label>
    <input type="text" name="login" required autocomplete="off"><br>
    <label for="password">Password:</label>
    <input type="password" name="password" required autocomplete="off"><br>
    <button type="submit">Login</button>
</form>


    <?php include 'footer.php'; ?>
</body>
</html>
