<?php

include('conn.php'); // Database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_name = $_POST['category_name'];

    $query = "INSERT INTO categories (name) VALUES ('$category_name')";
    if ($conn->query($query) === TRUE) {
        echo '<script>alert("Category Added Successfully");</script>';
        echo '<script>window.location.href="register_item.php";</script>';
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<h2>Add New Category</h2>
<form method="POST">
    <label for="category_name">Category Name:</label>
    <input type="text" name="category_name" required><br>
    <input type="submit" value="Add Category">
</form>
