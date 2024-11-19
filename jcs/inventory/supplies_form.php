<?php

include('conn.php'); // Database connection

// Fetch categories to use in the select dropdown
$category_query = "SELECT * FROM categories";
$category_result = $conn->query($category_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $supply_name = $_POST['supply_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Handle file upload for the image
    $image = $_FILES['image'];  // Image file from the form
    $image_name = $image['name'];
    $image_tmp_name = $image['tmp_name'];
    $image_size = $image['size'];
    $image_error = $image['error'];

    // Define allowed file types and size limit
    $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
    $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

    if (in_array($image_extension, $allowed_extensions) && $image_error === 0) {
        // Check if the image size is within the allowed limit (e.g., 5MB)
        if ($image_size <= 5000000) {
            // Generate a unique name for the image to avoid overwriting
            $image_new_name = uniqid('', true) . "." . $image_extension;
            $image_upload_path = '../uploads/' . $image_new_name;

            // Move the uploaded image to the 'uploads' directory
            if (move_uploaded_file($image_tmp_name, $image_upload_path)) {
                // Insert data into the database
                $query = "INSERT INTO supplies (category_id, name, price, quantity, image) 
                          VALUES ('$category_id', '$supply_name', '$price', '$quantity', '$image_new_name')";
                
                if ($conn->query($query) === TRUE) {
                    echo '<script>alert("Supply Item Added Successfully");</script>';
                    echo '<script>window.location.href="register_item.php";</script>';
                } else {
                    echo "Error: " . $query . "<br>" . $conn->error;
                }
            } else {
                echo "Error uploading the image.";
            }
        } else {
            echo "Image size is too large. Please upload a smaller file.";
        }
    } else {
        echo "Invalid file type or error during upload.";
    }
}
?>

<h2>Add New Supply</h2>
<form method="POST" enctype="multipart/form-data">
    <label for="category_id">Select Category:</label>
    <select name="category_id" required>
        <?php while ($row = $category_result->fetch_assoc()) { ?>
            <option value="<?= $row['category_id']; ?>"><?= $row['name']; ?></option>
        <?php } ?>
    </select><br>

    <label for="supply_name">Supply Name:</label>
    <input type="text" name="supply_name" required><br>

    <label for="price">Price:</label>
    <input type="text" name="price" required><br>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" required><br>

    <!-- Input for Image Upload -->
    <label for="image">Upload Image:</label>
    <input type="file" name="image" accept="image/*" required><br>

    <input type="submit" value="Add Supply">
</form>
