<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Create Account</title>
</head>
<body>
        
<div class="container">
    <h2>Create account</h2>
    <form action="login_process.php" method="POST">
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required autocomplete="off">
        </div>
        <div class="user-email">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" required autocomplete="off">
        </div>
        <div class="user-password">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required autocomplete="off">
        </div>
        <div class="submit-button">
            <button type="submit" name="create_account" class="btn">Create Account</button>
        </div>
    </form>
</div>

</body>
</html>
