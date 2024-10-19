<?php
session_start();
require 'config.php';

$search_results = [];
$search_query = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['search_query'])) {
    $search_query = $_POST['search_query'];

    // Only show the search query for debugging if it has been set
    if (!empty($search_query)) {
        echo "Search Query: " . htmlspecialchars($search_query);
    }

    $stmt = $conn->prepare("SELECT * FROM products WHERE name LIKE ? OR description LIKE ?");

    if ($stmt) {
        $search_term = "%" . $search_query . "%";
        $stmt->bind_param("ss", $search_term, $search_term);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $search_results[] = $row;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<header>
    <h1><a href="#">Customer Order Entry System</a></h1>
    <form method="POST" action="search.php">
        <input class="search-bar" type="search" name="search_query" placeholder="Search for products" required>
        <button type="submit" class="search-button">Search</button>
    </form>
</header>

<nav>
    <ul class="nav-content">
        <li><a href="index.php">Home</a></li>
        <li><a href="shoe.php">Shoe</a></li>
        <li><a href="shirt.php">T-Shirt</a></li>
        <li><a href="trauser.php">Trausers</a></li>
        <li><a href="sweater.php">Sweater</a></li>
        <li><a href="coats.php">Coats</a></li>
        <li><a href="login.php">Sign Up</a></li>
        <li><a href="form_shoe.php">Form</a></li>
    </ul>
</nav>

<main>
    <h2>Search Results</h2>

    <?php if (!empty($search_results)): ?>
        <div class="search-results-container">
            <?php foreach ($search_results as $product): ?>
                <div class="search-result-item">
                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p><strong>Price: $<?php echo htmlspecialchars($product['price']); ?></strong></p>
                    <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" width="100">
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>No results found for "<?php echo htmlspecialchars($search_query); ?>"</p>
    <?php endif; ?>
</main>

<footer>
    <!-- Include your footer here -->
</footer>

</body>
</html>
