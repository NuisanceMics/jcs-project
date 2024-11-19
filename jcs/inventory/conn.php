<?php
    session_start();

    $conn = mysqli_connect('localhost','root','','jcs_project');

    if ($conn->connect_error){
        die("Connection failed: ". $con->connect_error );
    }
    
?>