<?php 
include('connection/db.php');

// Check if POST data is set

    $category = $_POST['category'];
    $Description = $_POST['Description'];

    // Prepare and execute the SQL query
    $query = mysqli_query($conn, "INSERT INTO job_category (category, description) VALUES ('$category', '$Description')");

    if($query){
        echo "<script> alert('Data Inserted Successfully.')</script>";
    } else {
        echo "<script> alert('Error')</script>";
    }

?>
