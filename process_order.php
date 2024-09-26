<?php
require 'db.php';

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture customer details
    $customerName = $_POST['customerName'];
    $customerEmail = $_POST['customerEmail'];
    $customerPhone = $_POST['customerPhone'];
    $customerAddress = $_POST['customerAddress'];

    // Capture order details
    $product = $_POST['product'];
    $quantity = $_POST['quantity'];
    $paymentMethod = $_POST['paymentMethod'];
    $shippingMethod = $_POST['shippingMethod'];

    // Prepare and bind customer statement
    $stmt = $conn->prepare("INSERT INTO Customers (customerName, customerEmail, customerPhone, customerAddress) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $customerName, $customerEmail, $customerPhone, $customerAddress);

    if ($stmt->execute()) {
        // Get the last inserted customer ID
        $customerID = $stmt->insert_id;

        // Prepare and bind order statement
        $stmt = $conn->prepare("INSERT INTO Orders (product, quantity, paymentMethod, shippingMethod, customerID) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sissi", $product, $quantity, $paymentMethod, $shippingMethod, $customerID);

        if ($stmt->execute()) {
            echo "Order successfully placed!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>