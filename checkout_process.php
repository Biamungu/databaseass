<?php
session_start();

// Here, you would typically process the payment and order.
if (!empty($_SESSION['cart'])) {
    // Example: Clear the cart after checkout
    unset($_SESSION['cart']);
    echo "<p>Thank you for your purchase!</p>";
} else {
    echo "<p>Your cart is empty. Please add items to your cart before checking out.</p>";
}
?>
<a href="shoes.php">Continue Shopping</a>
