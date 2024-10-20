<?php
require 'config.php'; // Include your database configuration file

// Ensure the connection is established
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
   <div class="container mt-5">
    <h2>List of Customers</h2>
    <a class="btn btn-primary" href="create.php" role="button">New Customer</a> <br><br>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            
            // Read all the rows from the database
            $sql = "SELECT * FROM customers";
            $result = $connection->query($sql);

            if (!$result) {
                die("Invalid query: " . $connection->error); // Use $connection->error for query errors
            }
            
            while ($row = $result->fetch_assoc()) {
                echo "
                <tr>
                    <td>{$row['ID']}</td>
                    <td>{$row['NAME']}</td>
                    <td>{$row['EMAIL']}</td>
                    <td>{$row['PHONE']}</td>
                    <td>{$row['ADDRESS']}</td>
                    <td>{$row['created_at']}</td>
                    <td>
                        <a class='btn btn-warning btn-sm' href='edit.php?ID={$row['ID']}'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='delete.php?ID={$row['ID']}'>Delete</a>
                    </td>
                </tr>
                ";
            }

            ?>
        </tbody>
     </table>
   </div>
</body>
</html>
