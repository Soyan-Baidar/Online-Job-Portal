<?php
$hostURL = "localhost";
$db_username ="root";
$db_password = "";
$db_name = "jobBloom";

$conn = mysqli_connect($hostURL,$db_username,$db_password,$db_name);

if(mysqli_connect_error()){
    echo "Failed.".mysqli_connect_error();

}
?>