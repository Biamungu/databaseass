<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>

<header>
    <h1>Your Shopping Cart</h1>
</header>

<main>
    <div class="cart-container">
        <?php if (!empty($_SESSION['cart'])): ?>
            <ul>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <li>
                        <strong><?php echo htmlspecialchars($item['name']); ?></strong><br>
                        Price: K<?php echo htmlspecialchars($item['price']); ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <form action="checkout_process.php" method="POST">
                <button type="submit">Proceed to Checkout</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</main>

<footer>
    <a href="shoes.php">Continue Shopping</a>
</footer>

</body>
</html>
