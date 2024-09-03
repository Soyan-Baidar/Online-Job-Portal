<?php 
session_start();
include('connection/db.php');

// Check if POST data is set
$login = $_SESSION['email'];

$Job_Title = $_POST['job_title'];
$Description = $_POST['Description'];
$country = $_POST['country'];
$state = $_POST['state'];
$city = $_POST['city'];
$keyword = $_POST['keyword'];
$category = $_POST['category'];


// Prepare and execute the SQL query
$query = mysqli_query($conn, "INSERT INTO all_jobs (customer_email, job_title, description, country, state, city, keyword, category) VALUES ('$login','$Job_Title', '$Description', '$country', '$state', '$city','$keyword','$category')");

if($query){
    echo "<script>alert('Data Inserted Successfully.');</script>";
} else {
    echo "<script>alert('Error');</script>";
}

?>
