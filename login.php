<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>login.page</title>
</head>
<body>
        
<div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required>
            </div>
            <div class="user-email">
                <label for="email">Emai</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div class="user-password">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div class="submit-button">
                <button type="submit" name="login" class="btn"><a href="index.php">Login</a></button>
            </div>
        </form>
    </div>

   
</body>
</html>