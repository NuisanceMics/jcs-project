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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
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
            <div class="title col-sm-3"> INVENTORY </div>
            <div class="row">
                <div class="col-sm-3 box">Registered Instruments</div>
                <div class="col-sm-3 box">Registered Supplies</div>
                <div class="col-sm-3">
                    <button class="btn-add"><a href="../inventory/register_item.php" style="text-decoration:none; color:white;">Add New Items</a></button>
                    
                </div>
            </div>

            <!-- Inventory Table -->
            <div class="inv-tbl">
                <!-- Search bar and button -->
                <div class="search-container">
                    <input type="text" class="form-control search-input" placeholder="Search Items...">
                    <button class="btn-search"><i class="fas fa-search"></i> Search</button>
                </div>

                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Item Name</th>
                            <th>Color</th>
                            <th>Brand</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                        <?php 
                        $sql= "SELECT * FROM product";
                        $result = mysqli_query($conn,$sql);
                        if($result){
                            while($row=mysqli_fetch_assoc($result)){
                                $uid=$row['prod_id'];
                                $prodname=$row['prod_name'];
                                $description=$row['description'];
                                $price=$row['price'];
                                $intrument_type=$row['details'];
                                
                                echo'<tr>
                                        <td = scope="row">'.$uid.'</td>
                                        <td>'.$prodname.'</td>
                                        <td>'.$description.'</td>
                                        <td>'.$price.'</td>
                                        <td>'.$intrument_type.'</td>
                                        <td>
                                        <button class="btn btn-primary btn-sm"><i class="fas fa-edit"></i> Edit</button>
                                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</button>
                                        </td>
                                    </tr>';
                            }
                        }
                        ?>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>