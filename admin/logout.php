<?php
session_start();
session_unset();
header('location: admin_login.php'); // corrected header function call

include('connection/db.php');
$query=mysqli_query($conn,"SELECT * FROM admin_login WHERE admin_email='{$_SESSION['email']}' AND admin_type = '2'");
if($query){
    header('location: http://localhost/Summer%20Project/'); // corrected header function call
}else{
    header('location: admin_login.php'); // corrected header function call

}
?>
