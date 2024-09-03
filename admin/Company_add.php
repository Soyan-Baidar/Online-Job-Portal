<?php 
include('connection/db.php');

// Check if POST data is set

    $Company = $_POST['Company'];
    $Description = $_POST['Description'];
    $admin = $_POST['admin'];


    // Prepare and execute the SQL query
    $query = mysqli_query($conn, "INSERT INTO company (company, description,admin) VALUES ('$Company', '$Description','$admin')");

    if($query){
        echo "<script>alert('Data Inserted Successfully.')<script>";
    } else {
        echo "<script>alert('Error')</script>";
    }

?>
