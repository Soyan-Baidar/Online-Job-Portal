<?php
include('connection/db.php');

$del = $_GET['del'];

$query = mysqli_query($conn, "DELETE FROM company WHERE company_id ='$del'");
if ($query) {
    echo "<script> 
            alert('Record has been deleted!');
            window.location.href = 'create_company.php';
          </script>";
    exit; // Add exit to prevent further execution of the script
} else {
    echo "<script> 
            alert('Error');
            window.location.href = 'create_company.php';
          </script>";
}
?>
