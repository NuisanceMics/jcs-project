<?php

session_start();
$conn = mysqli_connect('localhost','root','','try_db');

if ($conn->connect_error){
    die("Connection failed: ". $con->connect_error );
}
?>