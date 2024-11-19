<?php
 require "conn.php";

// Fetch roles from the 'roles' table
$sql = "SELECT id, role FROM roles";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" referrerpolicy="no-referrer" />
    <style>
        .login-container {
            max-width: 800px;
            border-radius: 12px;
            
        }
        .form {
            border-radius: 25px;
        }
        .form input {
            width: 100%;
            height: 40px;
            margin: 10px 5px;
            border-radius: 25px;
            border: none;
            padding: 0 15px;
        }
        .button {
            height: 40px;
            width: 100px;
            border-radius: 25px;
            border: none;
            color: white;
            background-color: tomato;
        }
        .button:hover {
            background-color: white;
            color: black;
        }
        .toggle-link {
            color: rgb(49, 32, 209);
            font-size: 14px;
        }
        /* Responsive adjustments */
        @media (max-width: 576px) {
            .login-container {
                flex-direction: column; /* Stack logo and form */
                padding: 20px;
            }
            .col-6 {
                max-width: 100%;
            }
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100 ">

    <div class="container login-container d-flex flex-lg-row flex-column align-items-center">
        <!-- Logo Section -->
        <div class="col-lg-6 col-12 d-flex align-items-center justify-content-center p-4">
            <img src="logo.png" alt="logo" class="img-fluid">
        </div>

        <!-- Register Form -->
<div id="registerForm" class="form col-lg-6 col-12 p-4" style="background-color: #ffa07a;">
    <h2 class="text-center text-white mb-4">Register</h2>
    <form action="register.php" method="post">
        <input class="text-center fs-4" type="text" name="fullname" placeholder="Fullname" required>
        <input class="text-center fs-4" type="text" name="phone_number" placeholder="PhoneNumber" required>
        <input class="text-center fs-4" type="text" name="address" placeholder="Address" required>
        <input class="text-center fs-4" type="email" name="email" placeholder="Email" required>
        <input class="text-center fs-4" type="password" name="password" placeholder="Password" required>
        <input class="text-center fs-4" type="password" name="confirm_password" placeholder="Confirm Password" required>

        <!-- User Role Selection -->
        <div class="m-4">
            <label for="role_id" class="color-white">Register as:</label>
            <select name="role_id" id="role_id" required>
                <option value="">Select a role</option>
                <?php
                // Loop through the roles and populate the dropdown
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['role'] . "</option>";
                    }
                } else {
                    echo "<option value=''>No roles available</option>";
                }
                ?>
            </select>
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="button">Sign Up</button>
        </div>
        <div class="text-center mt-5">
            <a href="login_form.php" class="text-decoration-none toggle-link">Already have an account?<br>Log in here</a>
        </div>
    </form>
</div>

    </div>

    <!-- Bootstrap JS and JavaScript Toggle Logic -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
