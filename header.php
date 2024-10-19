<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Order Entry System</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<header>
    <h1><a href="index.php">Customer Order Entry System</a></h1>
    <form method="POST" action="search.php">
        <input class="search-bar" type="search" placeholder="Search Here" name="query"> 
        <button type="submit" class="search-button">Search</button>
    </form>
</header>

<nav>
    <ul class="nav-content">
        <li><a href="index.php">Home</a></li>
        <li><a href="shoe.php">Shoe</a></li>
        <li><a href="shirt.php">Shirt</a></li>
        <li><a href="trauser.php">Trousers</a></li>
        <li><a href="sweater.php">Sweater</a></li>
        <li><a href="coats.php">Coats</a></li>

        <!-- Display based on whether the user is logged in -->
        <?php if (isset($_SESSION['username'])): ?>
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <li><a href="login.php">Login</a></li>
            <li><a href="signup.php">Sign Up</a></li>
        <?php endif; ?>
        
        <li><a href="form_shoe.php">Order Form</a></li>
    </ul>
</nav>
</body>
</html>
