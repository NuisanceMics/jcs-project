<?php
// connection.php
session_start();
$conn = mysqli_connect('localhost','root','','try_db');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Predefined color mappings
// the color map have 10 set of color
$color_map = [
    "red" => "#FF0000",
    "blue" => "#0000FF",
    "green" => "#008000",
    "yellow" => "#FFFF00",
    "black" => "#000000",
    "white" => "#FFFFFF",
    "purple" => "#800080",
    "pink" => "#FFC0CB",
    "orange" => "#FFA500",
    "gray" => "#808080"
];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $color_name = strtolower(trim($_POST['color_name']));

    // Validate if the color name exists in the predefined map
    if (array_key_exists($color_name, $color_map)) {
        $color_code = $color_map[$color_name];

        $stmt = $conn->prepare("INSERT INTO colors (color_name, color_code) VALUES (?, ?)");
        $stmt->bind_param("ss", $color_name, $color_code);
        if ($stmt->execute()) {
            $success_message = "Color '$color_name' added successfully!";
        } else {
            $error_message = "Failed to add color.";
        }
        $stmt->close();
    } else {
        $error_message = "Invalid color name. Please enter a valid color (e.g., red, blue, green).";
    }
}

// Fetch colors from the database
$sql = "SELECT color_name, color_code FROM colors";
$result = $conn->query($sql);

$colors = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $colors[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Color Registration</title>
    <style>
        .color-box {
            width: 100px;
            height: 100px;
            margin: 10px;
            display: inline-block;
            text-align: center;
            line-height: 100px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Register a New Color</h1>
    
    <?php if (isset($success_message)) echo "<p style='color: green;'>$success_message</p>"; ?>
    <?php if (isset($error_message)) echo "<p style='color: red;'>$error_message</p>"; ?>

    <form method="POST" action="">
        <label for="color_name">Color Name:</label>
        <input type="text" id="color_name" name="color_name" required placeholder="e.g., blue, red">
        <br>
        <button type="submit">Add Color</button>
    </form>

    <h2>Colors List</h2>
    <?php foreach ($colors as $color): ?>
        <div class="color-box" style="background-color: <?= $color['color_code']; ?>;">
            <?= htmlspecialchars(ucfirst($color['color_name'])); ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
