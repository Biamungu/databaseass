<?php
session_start();
include 'config.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get product information from POST data
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    // You can add your logic to process the order here
    // For example, add it to the shopping cart session
    $_SESSION['cart'][] = [
        'id' => $product_id,
        'name' => $product_name,
        'price' => $product_price,
    ];

    // Redirect to the cart page
    header("Location: cart.php");
    exit;
}

// Close the database connection
mysqli_close($conn);
?>
