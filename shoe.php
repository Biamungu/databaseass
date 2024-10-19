<?php
// Include database configuration
include 'config.php';

// Fetch product details from the database
$sql = "SELECT id, description, image, price, name FROM products WHERE category = 'shoes'";
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
    <title>Shoe Page</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
</head>
<body>

<!-- Header section -->
<?php require 'header.php'; ?>

<main>
    <div class="shoe-item">
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                ?>
                <div class="shoe-content">
                    <h1><?php echo htmlspecialchars($row['name']); ?></h1>
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="Shoe Image">
                    <p><?php echo htmlspecialchars($row['description']); ?></p>
                    <h1>K<?php echo htmlspecialchars($row['price']); ?></h1>

                    <form method="POST" action="checkout.php">
                        <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($row['name']); ?>">
                        <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($row['price']); ?>">
                        <button type="submit">Buy Now</button>
                    </form>
                </div>
                <?php
            }
        } else {
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
