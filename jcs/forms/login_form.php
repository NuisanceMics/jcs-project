<?php
include('conn.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate if the email and password are provided
    if (empty($email) || empty($password)) {
        echo '<script> alert("Please enter both email and password."); </script>';
    } else {
        // Check if the email exists in the database
        $sql = "SELECT  email, password, role_id FROM accounts WHERE email = ?";
        $checking = $conn->prepare($sql);
        $checking->bind_param("s", $email);
        $checking->execute();
        $result = $checking->get_result();

        if ($result->num_rows > 0) {
            // User found, verify the password
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                // Password is correct, start the session
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['fullname'] = $user['fullname'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role_id'] = $user['role_id'];

                // Redirect based on user role (for example, Admin or Student)
                if ($user['role_id'] == 1) {  // Assuming role_id 1 is for Admin
                    header('Location: ../admin_dashboard/admin.html');
                } else {
                    header('Location: ../elearning/homepage.html');
                }
                exit();
            } else {
                echo '<script> alert("Incorrect password!"); </script>';
            }
        } else {
            echo '<script> alert("Email not found!"); </script>';
        }

        $stmt->close();
    }
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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

        <!-- Login Form -->
        <div id="loginForm" class="form col-lg-6 col-12 p-4" style="background-color: #ffa07a;">
            <h2 class="text-center text-white mb-4">Log In</h2>
            <form action="" method="post">
                <input class="text-center fs-4" type="email" name="email" placeholder="Email" required>
                <input class="text-center fs-4" type="password" name="password" placeholder="Password" required>
                <div class="d-flex justify-content-center">
                    <button type="submit" class="button">Login</button>
                </div>
                <div class="text-center mt-5">
                    <a href="register_form.php" class="text-decoration-none toggle-link">Don’t have an account?<br>Create account here</a>
                </div>
            </form>
        </div>
    </div>

<!-- Bootstrap JS and JavaScript Toggle Logic -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
