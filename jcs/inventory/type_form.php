<?php


include('conn.php'); // Database connection

// Fetch categories to use in the select dropdown
$category_query = "SELECT * FROM categories";
$category_result = $conn->query($category_query);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_id = $_POST['category_id'];
    $type_name = $_POST['type_name'];

    $query = "INSERT INTO instrument_types (category_id, name) VALUES ('$category_id', '$type_name')";
    if ($conn->query($query) === TRUE) {
        echo '<script>alert(" Instrument Added Successfully");</script>';
        echo '<script>window.location.href="register_item.php";</script>';
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<h2>Add New Instrument Type</h2>
<form method="POST">
    <label for="category_id">Select Category:</label>
    <select name="category_id" required>
        <?php while ($row = $category_result->fetch_assoc()) { ?>
            <option value="<?= $row['category_id']; ?>"><?= $row['name']; ?></option>
        <?php } ?>
    </select><br>

    <label for="type_name">Instrument Type Name:</label>
    <input type="text" name="type_name" required><br>

    <input type="submit" value="Add Instrument Type">
</form>
