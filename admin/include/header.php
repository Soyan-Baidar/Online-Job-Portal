<?php
session_start();
if($_SESSION['email']==true){

}else{
  header('location: admin_login.php');

}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">

    <title>Job Portal Dashboard</title>
    <!-- icon -->
    
    <!-- datatables css-->
    <link rel = "stylesheet" href ="https://cdn.datatables.net/2.0.2/css/dataTables.dataTables.css">
    <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<!--<script src="JS/admin_login.js"></script>-->


    

    <!-- Custom styles for this template -->
    <link href="styles/admin_dashboard.css" rel="stylesheet">
        <!-- icon -->
   

        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">
        




  </head>

  <body>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2" href="admin_dashboard.php">JB</a>
    <div class="navbar-nav flex-row ml-auto">
        <li class="nav-item">
            <a class="nav-link" href="logout.php">Sign out</a>
        </li>
    </div>
</nav>
