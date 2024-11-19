<?php
    session_start();

    $conn = mysqli_connect('localhost','root','','jcs_accounts');

    if ($conn->connect_error){
        die("Connection failed: ". $con->connect_error );
    }
?>