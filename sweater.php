<?php
// Include database configuration
include 'config.php';

// Fetch product details from the database
$sql = "SELECT description, image, price, name FROM products where category = 'sweater'"; // Fixed SQL query
$result = mysqli_query($conn, $sql);

// Check for any database connection or query errors
if (!$result) {
    die("Error fetching products: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shirt Page</title>
</head>
<body>

<!-- Header section -->
<?php require 'header.php'; ?>

<main>
    <div class="sweater-item"> <!-- Fixed 'di' to 'div' -->
        <?php
        // Check if any products are returned
        if (mysqli_num_rows($result) > 0) {
            // Loop through each product and display it
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="sweater-content">
                        <!-- Dynamically display product details -->
                        <h1><?php echo htmlspecialchars($row['name']); ?></h1>
                        <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Shirt Image"> <!-- Fixed image src -->
                        <p><?php echo htmlspecialchars($row['description']); ?></p>
                        <h1>K<?php echo htmlspecialchars($row['price']); ?></h1>
                        <button>Buy Now</button>
                    </div>
                <?php
            }
        } else {
            // If no products found
            echo '<p>No products found.</p>';
        }
        ?>
    </div>



</main>

<!-- Footer section -->
<?php include 'footer.php'; ?>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
