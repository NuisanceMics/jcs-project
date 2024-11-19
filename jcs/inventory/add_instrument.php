<?php
include('conn.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $serial_number = $_POST['serial_number'];
    $category_id = $_POST['category_id'];
    $type_id = $_POST['type_id'];
    $model_id = $_POST['model_id'];
    $price = $_POST['price'];

    $query = "INSERT INTO instruments (name, serial_number, category_id, type_id, model_id, price) 
              VALUES ('$name', '$serial_number', '$category_id', '$type_id', '$model_id', '$price')";

    if ($conn->query($query) === TRUE) {
        echo "New instrument added successfully!";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
}

?>
<form action="add_instrument.php" method="POST">
    <label for="name">Instrument Name:</label>
    <input type="text" name="name" required><br>

    <label for="serial_number">Serial Number:</label>
    <input type="text" name="serial_number" required><br>

    <label for="category_id">Category ID:</label>
    <input type="text" name="category_id" required><br>

    <label for="type_id">Type ID:</label>
    <input type="text" name="type_id" required><br>

    <label for="model_id">Model ID:</label>
    <input type="text" name="model_id" required><br>

    <label for="price">Price:</label>
    <input type="text" name="price" required><br>

    <input type="submit" value="Add Instrument">
</form>
<table>
    <thead>
        <tr>
            <th>Instrument Name</th>
            <th>Serial Number</th>
            <th>description</th>
            <th>Type</th>
            <th>Model</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $query = "SELECT * FROM instrument_models";
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['serial_number'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
            echo "<td>" . $row['image'] . "</td>";
            echo "<td>" . $row['model_id'] . "</td>";
            echo "<td>" . $row['price'] . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
