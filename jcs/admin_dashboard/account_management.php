<?php

include('conn.php');

// Check if the user is logged in
if (!isset($_SESSION['uid'])) {
    header("Location: login_form.php");  // Redirect to login if not logged in
    exit();
}

// Fetch user details from the database
$user_id = $_SESSION['uid'];
$sql = "SELECT * FROM accounts WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $uid);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Handle form submission (updating user details)
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $sex = $_POST['sex'];
    $address = $_POST['address'];

    // Update user details in the database
    $update_sql = "UPDATE accounts SET fullname = ?, phone_number = ?, sex = ?, address = ? WHERE id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssssi", $first_name, $contact_no, $sex, $address, $user_id);
    if ($update_stmt->execute()) {
        echo '<script>alert("Account updated successfully!");</script>';
        // Refresh the page to reflect updated data
        header("Location: accman.php");
        exit();
    } else {
        echo '<script>alert("Error updating account.");</script>';
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Management</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>  
    <!-- Header Banner -->
    <div class="container-fluid banner">
        <div class="logo"></div>
        <div class="banner-text"> ACCOUNT MANAGEMENT </div>
        <div class="profile-pic"></div>
    </div>

    <!-- Main Layout Wrapper -->
    <div class="main-content">
        <!-- Sidebar -->
        <div class="side-bar">
            <header>
                <h1>MENU</h1>
            </header>
            <div class="menu">
                <div class="item"><a href="admin.html"> Dashboard</a></div>
                <div class="item"><a href="appointment.html">Appointment</a></div>
                <div class="item"><a href="inventory.html">Inventory</a></div>
                <div class="item"><a href="addcourse.html">Add Course</a></div>
                <div class="item"><a href="addquiz.html">Add Quiz</a></div>
                <div class="item"><a href="viewrevs.html">View Reviews</a></div>
            </div>
            <header>
                <h1>TRANSACTION</h1>
            </header>
            <div class="menu">
                <div class="item"><a href="reports.html"> Reports</a></div>
            </div>
            <header>
                <h1>SETTINGS</h1>
            </header>
            <div class="menu">
                <div class="item"><a href="accman.php"> Account Management</a></div>
            </div>
            <div class="menu">
                <div class="item"><a href="#"> Logout</a></div>
            </div>
        </div>

        <!-- Account Content -->
        <div class="acc-content">
            <div class="img-container">
                <!-- Profile Image -->
                <img src="images/sample.jpg" alt="Profile Picture" class="rounded-img">
            </div>
            <div class="acc-detail">
                <h1>ACCOUNT MANAGEMENT</h1>
                <form method="post">
                    <div class="textbox-title"><input type="text" name="first_name" value="<?php echo $user['fullname']; ?>" placeholder="First Name" required></div>
                    <div class="textbox-title"><input type="text" name="last_name" value="<?php echo $user['last_name']; ?>" placeholder="Last Name" required></div>
                    <div class="textbox-title"><input type="text" name="contact_no" value="<?php echo $user['phone_number']; ?>" placeholder="Contact No." required></div>
                    <div class="textbox-title"><input type="text" name="sex" value="<?php echo $user['sex']; ?>" placeholder="Sex" required></div>
                    <div class="textbox-title"><input type="text" name="address" value="<?php echo $user['address']; ?>" placeholder="Address" required></div>
                </form>
            </div>

            <!-- Save and Cancel buttons -->
            <div class="button-container">
                <div class="sbmt-btn"> <button type="submit" class="btn btn-success"> Save </button></div>
                <div class="sbmt-btn"> <button type="button" class="btn btn-danger" onclick="window.location.href='dashboard.php'"> Cancel </button></div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and JavaScript Toggle Logic -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
