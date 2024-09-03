<?php
include('connection/db.php');
$del = $_GET['del'];

$query = mysqli_query($conn, "DELETE FROM admin_login WHERE id ='$del'");
if ($query) {
    echo "<script> alert('Record has been deleted!')</script>";
    header('Location: Customers.php'); // Corrected the header function call
    exit; // Add exit to prevent further execution of the script
} else {
    echo "<script> alert('Error')</script>";
}
?>
