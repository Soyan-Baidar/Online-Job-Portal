<?php
include('connection/db.php');
$del = $_GET['del'];

$query = mysqli_query($conn, "DELETE FROM all_jobs WHERE job_id ='$del'");
if ($query) {
    echo "<script> alert('Record has been deleted!')</script>";
    echo "<script> window.location.href = 'job_create.php'; </script>"; // Redirect using JavaScript
    exit; // Add exit to prevent further execution of the script
} else {
    echo "<script> alert('Error')</script>";
}
?>
