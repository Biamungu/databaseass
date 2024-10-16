<?php
include 'config.php'; // Database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the image file was uploaded
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        // Validate the file type
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
        $file_type = $_FILES['image']['type'];
        
        if (in_array($file_type, $allowed_types)) {
            // Specify the target directory and file name
            $target_dir = "uploads/";
            $target_file = $target_dir . basename($_FILES['image']['name']);

            // Move the uploaded file to the target directory
            if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                // Get other form data
                $name = $_POST['name'];
                $category = $_POST['category'];
                $description = $_POST['description'];
                $price = $_POST['price'];

                // Insert data into the database
                $sql = "INSERT INTO products (name, category, description, image, price) VALUES ('$name', '$category', '$description', '$target_file', '$price')";
                if (mysqli_query($conn, $sql)) {
                    header("location:index.php");
                } else {
                    echo "Error: " . mysqli_error($conn);
                }
            } else {
                echo "Sorry, your file was not uploaded.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        }
    } else {
        echo "No file was uploaded or there was an upload error.";
    }
}
?>
