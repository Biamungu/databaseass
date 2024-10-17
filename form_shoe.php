<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Image Upload Form</title>
</head>
<body>
<div class="upload_images">
    <form class="image-upload-form" action="upload_process.php" method="POST" enctype="multipart/form-data">
        <!-- File input for image upload -->
        <label for="image">Select an image:</label>
        <input type="file" name="image" id="image" accept="image/*" required> <br><br>

        <!-- Text input for product name -->
        <label for="name">Name</label>
        <input type="text" name="name" id="name" required><br>

        <!-- Dropdown for category selection -->
        <label for="category">Select the category</label>
        <select name="category" id="category" required>
            <option value="shoes">Shoes</option>
            <option value="t-shirt">T-shirt</option>
            <option value="trousers">Trousers</option>
            <option value="sweater">Sweater</option>
            <option value="coats">Coats</option>
        </select><br>

        <!-- Textarea for description -->
        <label for="description">Description:</label>
        <textarea name="description" id="description" rows="4" required></textarea><br><br>

        <!-- Number input for price -->
        <label for="price">Price:</label>
        <input type="number" name="price" id="price" min="0" step="0.01" required><br><br>

        <!-- Submit button -->
        <button type="submit">Submit</button>
    </form>
</div>

</body>
</html>
