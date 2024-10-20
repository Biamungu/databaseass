<?php
require 'config.php';

$NAME = "";
$EMAIL = "";
$PHONE = "";
$ADDRESS = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $NAME = $_POST["NAME"];
    $EMAIL = $_POST["EMAIL"];
    $PHONE = $_POST["PHONE"];
    $ADDRESS = $_POST["ADDRESS"];

    // Check for empty fields
    if (empty($NAME) || empty($EMAIL) || empty($PHONE) || empty($ADDRESS)) {
        $errorMessage = "All fields are required";
    } else {
        // Add new customer into the database using a direct query
        $sql = "INSERT INTO customers (NAME, EMAIL, PHONE, ADDRESS) VALUES ('$NAME', '$EMAIL', '$PHONE', '$ADDRESS')";
        
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Failed to add customer: " . $connection->error; // Use $connection->error for query errors
        } else {
            $successMessage = "Customer added successfully";
            // Clear the fields
            $NAME = "";
            $EMAIL = "";
            $PHONE = "";
            $ADDRESS = "";

            // Redirect to index.php after successful insertion
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
    <title>Add Customer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container mt-5">
    <h2>Add New Customer</h2>

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

     <button class="btn btn-success" type="submit">Submit</button>
     <a class="btn btn-secondary" href="index.php">Cancel</a>
    </form>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
