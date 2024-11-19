<?php
    include('conn.php');


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        a{
            text-decoration: none;
            color: white;
        }
    </style>
</head>
<body>  
    <!-- Header Banner -->
    <div class="container-fluid banner">
        <div class="logo"></div> <!-- Logo container -->
        <div class="banner-text">INVENTORY</div>
        <div class="profile-pic"></div> <!-- Profile picture container -->
    </div>

    <!-- Main Layout Wrapper -->
    <div class="main-content">
        <!-- Sidebar -->
        <div class="side-bar">
            <header>
                <h1>MENU</h1>
            </header>
            <div class="menu">
                <div class="item"><a href="admin.html">Dashboard</a></div>
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
                <div class="item"><a href="reports.html">Reports</a></div>
            </div>

            <header>
                <h1>SETTINGS</h1>
            </header>
            <div class="menu">
                <div class="item"><a href="accman.html">Account Management</a></div>
                <div class="item"><a href="#">Logout</a></div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <div class="title col-sm-3"> INVENTORY</div>
            
            <button class="btn btn-primary"><a href="category_form.php">Add Instrument category</a></button>
            <button class="btn btn-primary"><a href="type_form.php">Add Instrument type</a></button>
            <button class="btn btn-primary"><a href="model_form.php">Add Instrument model</a></button>
            <button class="btn btn-primary"><a href="supplies_form.php">Add Instrument supplies</a></button>
            <button class="btn btn-warning"><a href="add_instrument.php">Add Instrument </a></button>
            
    

        <!--End of Content-->
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
    <script src="script.js"></script>
</body>
</html>