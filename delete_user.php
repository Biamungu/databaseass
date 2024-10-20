<?php
require 'config.php';

// Get the customer ID from the URL
if (isset($_GET["ID"])) {
    $id = $_GET["ID"]; // Correctly reference the ID from the URL

    // Prepare the SQL statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM CUSTOMERS WHERE ID = ?");
    
    // Bind the ID parameter to the statement
    $stmt->bind_param("i", $id); // "i" indicates the type is integer

    // Execute the statement
    if ($stmt->execute()) {
        // Successfully deleted
        $successMessage = "Customer deleted successfully";
    } else {
        // Error occurred
        $errorMessage = "Error deleting customer: " . $stmt->error;
    }

    $stmt->close(); // Close the statement
}

// Redirect to the index page after attempting deletion
header("Location: admin_board.php");
exit; // Use exit after header to stop script execution
?>
