<?php
include('connection/db.php');

$del = $_GET['del'];

$query = mysqli_query($conn, "DELETE FROM job_category WHERE id ='$del'");
if ($query) {
    echo "<script>alert('Record has been deleted!')</script>";
    echo "<script>setTimeout(function(){window.location.href='category.php';}, 1000);</script>";
    exit; // Add exit to prevent further execution of the script
} else {
    echo "<Script>alert('Error')</script>";
}
?>
