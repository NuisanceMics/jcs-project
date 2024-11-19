<?php
include('conn.php');

# This condition is for the register form
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fullname = $_POST['fullname'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role_id = $_POST['role_id'];

    # Check if password and confirm password match
    if ($password !== $confirm_password) {
        echo '<script> alert("Password and confirm password do not match"); </script>';
        echo '<script> window.location.href = "register_form.php"; </script>';
        exit();
    }

    # Check if email exists in the database
    $email_check_sql = "SELECT * FROM accounts WHERE email = '$email'";
    $email_check_result = $conn->query($email_check_sql);

    if ($email_check_result->num_rows > 0) {
        echo '<script> alert("Email already exists!"); </script>';
        echo '<script> window.location.href = "register_form.php"; </script>';
    } else {
        # Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        # Insert data into the database
        $sql = "INSERT INTO accounts (fullname, phone_number, address, email, password, role_id) 
                               VALUES('$fullname', '$phone_number', '$address', '$email', '$hashed_password','$role_id')";

        if ($conn->query($sql) === TRUE) {
            echo '<script> alert("New record created successfully"); </script>';
            echo '<script> window.location.href = "login_form.php"; </script>';  # Redirect to login page
        } else {
            echo '<script> alert("Error: ' . $conn->error . '"); </script>';
            echo '<script> window.location.href = "register_form.php"; </script>';
        }
    }
}

$conn->close();
?>
