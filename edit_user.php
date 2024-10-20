<?php
require 'config.php';

$ID = "";
$NAME = "";
$EMAIL = "";
$PHONE = "";
$ADDRESS = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Get the customer ID from the URL
    if (!isset($_GET["ID"])) {
        header("Location: ADMIN.php");
        exit; // Use exit after header to stop script execution 
    }

    $ID = $_GET["ID"];
    // Read the rows of the selected customer from the database
    $sql = "SELECT * FROM customers WHERE ID = $ID";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();

    if (!$row) {
        header("Location: ADMIN.php");
        exit; // Use exit after header to stop script execution 
    }

    // Set the customer details
    $NAME = $row['NAME'];
    $EMAIL = $row['EMAIL'];
    $PHONE = $row['PHONE'];
    $ADDRESS = $row['ADDRESS'];
} else {
    // POST request to update customer information
    $ID = $_POST["ID"];
    $NAME = $_POST["NAME"];
    $EMAIL = $_POST["EMAIL"];
    $PHONE = $_POST["PHONE"];
    $ADDRESS = $_POST["ADDRESS"];

    // Check for empty fields
    if (empty($NAME) || empty($EMAIL) || empty($PHONE) || empty($ADDRESS)) {
        $errorMessage = "All fields are required";
    } else {
        $sql = "UPDATE customers SET NAME='$NAME', EMAIL='$EMAIL', PHONE='$PHONE', ADDRESS='$ADDRESS' WHERE ID=$ID";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error; // Use $connection->error for query errors
        } else {
            $successMessage = "Customer updated successfully";
            // Redirect to index.php after successful update
            header("Location: index.php");
            exit; // Use exit after header to stop script execution
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container mt-5">
    <h2>Edit Customer</h2>

    <?php
      if (!empty($errorMessage)) {
         echo "
         <div class='alert alert-warning alert-dismissible fade show' role='alert'>
             <strong>Error:</strong> $errorMessage
             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
         </div>
         ";
      }

      if (!empty($successMessage)) {
         echo "
         <div class='alert alert-success alert-dismissible fade show' role='alert'>
             <strong>Success:</strong> $successMessage
             <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
         </div>
         ";
      }
    ?>
    
    <a class="btn btn-primary" href="index.php" role="button">List of Customers</a> <br><br>
    
    <form method="POST">
        <input type="hidden" name="ID" value="<?php echo htmlspecialchars($ID); ?>">
     <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input class="form-control" type="text" name="NAME" value="<?php echo htmlspecialchars($NAME); ?>" required>
     </div>

     <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input class="form-control" type="email" name="EMAIL" value="<?php echo htmlspecialchars($EMAIL); ?>" required>
     </div>

     <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input class="form-control" type="text" name="PHONE" value="<?php echo htmlspecialchars($PHONE); ?>" required>
     </div>

     <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input class="form-control" type="text" name="ADDRESS" value="<?php echo htmlspecialchars($ADDRESS); ?>" required>
     </div>

     <button class="btn btn-success" type="submit">Update</button>
     <a class="btn btn-secondary" href="index.php">Cancel</a>
    </form>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
