<?php
$servername="localhost:3308";
$username="root";
$password="";
$db="login";

$conn = mysqli_connect($servername,$username,$password,$db);

if($conn->connect_error){
    echo "Connection failed" .$conn->connect_error;
}

 ?>